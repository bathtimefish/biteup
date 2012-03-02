<?php
class JobsController extends AppController {

    var $name = 'Jobs';
    var $uses = array('Job', 'Feed');
    var $helpers = array('Javascript');
    var $components = array('Auth', 'WebApi');

    function beforeFilter(){
        $this->Auth->userModel = 'User';
        $this->Auth->loginAction = array('action' => 'login');
        $this->Auth->loginRedirect = array('action' => 'index');
        $this->Auth->logoutRedirect = array('action' => 'login');
        $this->Auth->allow('login', 'logout');
        $this->Auth->loginError = 'username or password is invalid.';
        $this->Auth->authError = 'Please try logon as admin.';
    }

    function index() {
        $this->Job->recursive = 0;
        $this->paginate = array(
            'limit' => 5,
            'order' => array('Job.created DESC'),
            'conditions'=> array('Job.user_id' => $this->Auth->user('id'), 'Job.checkout IS NULL'),
        );
        $pagination = $this->paginate();
        $this->set('jobs', $pagination);
        $this->set('title_for_action', '予定リスト');
    }

    // user check in a job.
    function checkin($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid job', true));
            $this->redirect(array('action' => 'index'));
        }
        $job = $this->Job->read(null, $id);
        if (!empty($job)) {
            $job['Job']['checkin'] = DboSource::expression('Now()');
            if ($this->Job->save($job)) {
                $message = $this->Auth->user('username') . ' just checkin to ' . $job['Job']['name'];
                $this->addFeed($message, $job['Job']['id']);
                $this->Session->setFlash(__('The checkin has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The checkin could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Job->read(null, $id);
        }
        $users = $this->Job->User->find('list');
        $jobkinds = $this->Job->Jobkind->find('list');
        $this->set(compact('users', 'jobkinds'));
    }

    // user check out a job.
    function checkout($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid job', true));
            $this->redirect(array('action' => 'index'));
        }
        $job = $this->Job->read(null, $id);
        if (!empty($job)) {
            $job['Job']['checkout'] = DboSource::expression('Now()');
            if ($this->Job->save($job)) {
                $message = $this->Auth->user('username') . ' just checkout to ' . $job['Job']['name'];
                $this->addFeed($message, $job['Job']['id']);
                $this->Session->setFlash(__('The checkout has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The checkout could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Job->read(null, $id);
        }
        $users = $this->Job->User->find('list');
        $jobkinds = $this->Job->Jobkind->find('list');
        $this->set(compact('users', 'jobkinds'));
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid job', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('job', $this->Job->read(null, $id));
        $this->set('title_for_action', '予定詳細');
    }

    function add() {
        if (!empty($this->data)) {
            $this->data['Job']['user_id'] = $this->Auth->user('id');
            //時間を整形
            $this->data['Job']['startdate']['month'] = sprintf('%02d', $this->data['Job']['startdate']['month']);
            $this->data['Job']['startdate']['day'] = sprintf('%02d', $this->data['Job']['startdate']['day']);
            $this->data['Job']['starttime']['hour'] = sprintf('%02d', $this->data['Job']['starttime']['hour']);
            $this->data['Job']['starttime']['min'] = sprintf('%02d', $this->data['Job']['starttime']['min']);
            $this->data['Job']['jobtime']['hour'] = sprintf('%02d', $this->data['Job']['jobtime']['hour']);
            $this->data['Job']['jobtime']['min'] = sprintf('%02d', $this->data['Job']['jobtime']['min']);
            //仕事名を確定
            if(empty($this->data['Job']['name'])) {
                if(!empty($this->data['Job']['job_selected'])) {
                    $job = $this->Job->read('name', $this->data['Job']['job_selected']);
                    $this->data['Job']['name'] = $job['Job']['name'];
                }
            }
            $this->Job->create();
            if ($this->Job->save($this->data)) {
                $this->Session->setFlash(__('The job has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The job could not be saved. Please, try again.', true));
                var_dump($this->data);
            }
        }
        $jobs = $this->Job->find('list');
        $jobs['new'] = '新しいバイト先を指定'; // 新規登録のためのデータを追加
        $jobkinds = $this->Job->Jobkind->find('list');
        $this->set(compact('jobkinds', 'jobs'));
        $this->set('user', $this->Job->User->read(null, $this->Auth->user('id')));
        $this->set('title_for_action', '予定登録');
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid job', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            //時間を整形
            $this->data['Job']['startdate']['month'] = sprintf('%02d', $this->data['Job']['startdate']['month']);
            $this->data['Job']['startdate']['day'] = sprintf('%02d', $this->data['Job']['startdate']['day']);
            $this->data['Job']['starttime']['hour'] = sprintf('%02d', $this->data['Job']['starttime']['hour']);
            $this->data['Job']['starttime']['min'] = sprintf('%02d', $this->data['Job']['starttime']['min']);
            $this->data['Job']['jobtime']['hour'] = sprintf('%02d', $this->data['Job']['jobtime']['hour']);
            $this->data['Job']['jobtime']['min'] = sprintf('%02d', $this->data['Job']['jobtime']['min']);
            //仕事名を確定
            if(empty($this->data['Job']['name'])) {
                if(!empty($this->data['Job']['job_selected'])) {
                    $job = $this->Job->read('name', $this->data['Job']['job_selected']);
                    $this->data['Job']['name'] = $job['Job']['name'];
                }
            }
            if ($this->Job->save($this->data)) {
                $this->Session->setFlash(__('The job has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                var_dump($this->data);
                $this->Session->setFlash(__('The job could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Job->read(null, $id);
        }
        $jobs = $this->Job->find('list');
        $jobs['new'] = '新しいバイト先を指定'; // 新規登録のためのデータを追加
        $jobkinds = $this->Job->Jobkind->find('list');
        $this->set(compact('jobkinds', 'jobs'));
        $this->set('user', $this->Job->User->read(null, $this->Auth->user('id')));
        $this->set('title_for_action', '予定を編集する');
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for job', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Job->delete($id)) {
            $this->Session->setFlash(__('Job deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Job was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }

    // add Feed data for SNS TimeLines
    function addFeed($message =null, $jobid = null) {
        if(empty($message) || empty($jobid)) {
            $this->log('The Feed data argments not enough', LOG_DEBUG);
        }
        $feed = array('Feed' => array(
            'user_id' => $this->Auth->user('id'),
            'message' => $message,
            'job_id'  => $jobid
        ));
        if (!empty($feed)) {
            if (!$this->Feed->save($feed)) {
                $this->log('Feed was not saved', LOG_DEBUG);
                $this->log($feed, LOG_DEBUG);
            }
        }
    }

 /*** Admin Controllers ***/

 function admin_index() {
  $this->layout = 'admin';
  $this->Job->recursive = 0;
  $this->set('jobs', $this->paginate());
 }

 function admin_view($id = null) {
  $this->layout = 'admin';
  if (!$id) {
   $this->Session->setFlash(__('Invalid job', true));
   $this->redirect(array('action' => 'index'));
  }
  $this->set('job', $this->Job->read(null, $id));
 }

 function admin_add() {
  $this->layout = 'admin';
  if (!empty($this->data)) {
   $this->Job->create();
   if ($this->Job->save($this->data)) {
    $this->Session->setFlash(__('The job has been saved', true));
    $this->redirect(array('action' => 'index'));
   } else {
    $this->Session->setFlash(__('The job could not be saved. Please, try again.', true));
   }
  }
  $users = $this->Job->User->find('list');
  $jobkinds = $this->Job->Jobkind->find('list');
  $this->set(compact('users', 'jobkinds'));
 }

 function admin_edit($id = null) {
  $this->layout = 'admin';
  if (!$id && empty($this->data)) {
   $this->Session->setFlash(__('Invalid job', true));
   $this->redirect(array('action' => 'index'));
  }
  if (!empty($this->data)) {
   if ($this->Job->save($this->data)) {
    $this->Session->setFlash(__('The job has been saved', true));
    $this->redirect(array('action' => 'index'));
   } else {
    $this->Session->setFlash(__('The job could not be saved. Please, try again.', true));
   }
  }
  if (empty($this->data)) {
   $this->data = $this->Job->read(null, $id);
  }
  $users = $this->Job->User->find('list');
  $jobkinds = $this->Job->Jobkind->find('list');
  $this->set(compact('users', 'jobkinds'));
 }

 function admin_delete($id = null) {
  if (!$id) {
   $this->Session->setFlash(__('Invalid id for job', true));
   $this->redirect(array('action'=>'index'));
  }
  if ($this->Job->delete($id)) {
   $this->Session->setFlash(__('Job deleted', true));
   $this->redirect(array('action'=>'index'));
  }
  $this->Session->setFlash(__('Job was not deleted', true));
  $this->redirect(array('action' => 'index'));
 }
}
