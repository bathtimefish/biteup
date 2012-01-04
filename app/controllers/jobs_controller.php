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
  $this->set('jobs', $this->paginate());
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
                $this->addFeed();
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
                $this->addFeed();
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
 }

    function add() {
        $this->layout = '';
  if (!empty($this->data)) {
   $this->Job->create();
   if ($this->Job->save($this->data)) {
    $this->Session->setFlash(__('The job has been saved', true));
    $this->redirect(array('action' => 'index'));
   } else {
    $this->Session->setFlash(__('The job could not be saved. Please, try again.', true));
   }
  }
  $jobkinds = $this->Job->Jobkind->find('list');
  $this->set(compact('jobkinds'));
        $this->set('user', $this->Job->User->read(null, $this->Auth->user('id')));
 }

 function edit($id = null) {
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
    function addFeed($data =null) {
        // Add Feed for message
        return false;
    }

    /*** Admin Controllers ***/

 function admin_index() {
  $this->Job->recursive = 0;
  $this->set('jobs', $this->paginate());
 }

 function admin_view($id = null) {
  if (!$id) {
   $this->Session->setFlash(__('Invalid job', true));
   $this->redirect(array('action' => 'index'));
  }
  $this->set('job', $this->Job->read(null, $id));
 }

 function admin_add() {
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
