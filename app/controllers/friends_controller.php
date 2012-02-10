<?php
class FriendsController extends AppController {

	var $name = 'Friends';
    var $uses = array('User', 'Friend', 'Feed', 'Like', 'Jobkind', 'Job', 'Level');
    var $components = array('Auth', 'WebApi', 'Timeline');
    var $helpers = array('Javascript');

    function beforeFilter(){
        $this->Auth->userModel = 'User';
        $this->Auth->fields = array('username' => 'email', 'password' => 'password');
        $this->Auth->loginAction = array('action' => 'login');
        $this->Auth->loginRedirect = array('action' => 'index');
        $this->Auth->logoutRedirect = array('action' => 'login');
        $this->Auth->allow('login', 'logout', 'join');
        $this->Auth->loginError = 'email or password is invalid.';
        //$this->Auth->authError = 'Please try logon as admin.';
    }

	function index() {
		$this->Friend->recursive = 0;
		$this->set('friends', $this->paginate());
	}

	function view($id = null) {
        $this->Friend->recursive = -1;
        $this->User->recursive = -1;
        $this->Jobkind->recursive = -1;
        $this->Like->recursive = -1;
        $this->Job->recursive = -1;
        $this->Level->recursive = -1;
        $this->Feed->recursive = 0;
		if (!$id) {
			$this->Session->setFlash(__('Invalid friend', true));
			$this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            $this->data['Friend']['user_id'] = $this->Auth->user('id');
            if($this->data['Friend']['action'] == 'follow') {
	    		$this->Friend->create();
		    	$this->Friend->save($this->data);
            } elseif ($this->data['Friend']['action'] == 'unfollow') {
                $unfollows = $this->Friend->find('all', array('conditions'=>array('Friend.user_id'=>$this->Auth->user('id'), 'Friend.friend_id'=>$this->data['Friend']['friend_id'])));
                foreach($unfollows as $unfollow) {
                    $this->Friend->delete($unfollow['Friend']['id']);
                }
            }
        }
        $follow = $this->Friend->find('count', array('conditions'=>array('Friend.user_id'=>$this->Auth->user('id'), 'Friend.friend_id'=>$id)));
        $followed = false;
        if($follow > 0) $followed = true;
        $friend = $this->User->read(null, $id);
        $jobkind = $this->Jobkind->read(null, $friend['User']['current_jobkind_id']);
        $likecnt = $this->Like->find('count', array('conditions'=>array('Like.user_id'=>$friend['User']['id'])));
        $checkoutcnt = $this->Job->find('count', array('conditions'=>array('Job.user_id'=>$friend['User']['id'], 'Job.checkout IS NOT NULL')));
        $level = $this->Level->find('first', array('conditions'=>array('Level.id'=>$friend['User']['current_level'], 'Level.jobkind_id'=>$friend['User']['current_jobkind_id'])));
        $feeds = $this->Feed->find('all', array('conditions'=>array('Feed.user_id'=>$friend['User']['id']), 'order'=>'Feed.id DESC', 'limit'=>5));
        $timelines = array();
        foreach($feeds as $feed) {
            $feed['Like']['likes'] = $this->Like->find('count', array('conditions'=>array('Like.feed_id'=>$feed['Feed']['id'], 'Like.user_id'=>$feed['Feed']['user_id'])));
            $feed['Like']['comments'] = $this->Like->find('count', array('conditions'=>array('Like.feed_id'=>$feed['Feed']['id'], 'Like.message IS NOT NULL', 'Like.user_id'=>$feed['Feed']['user_id'])));
            $feed['Feed']['created'] = $this->Timeline->getActionTime($feed['Feed']['created']);
            array_push($timelines, $feed);
        }
		$this->set('friend', $friend);
		$this->set('jobkind', $jobkind);
		$this->set('likecnt', $likecnt);
		$this->set('checkoutcnt', $checkoutcnt);
		$this->set('level', $level);
		$this->set('feeds', $timelines);
		$this->set('followed', $followed);
		$this->set('webroot', $this->webroot);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Friend->create();
			if ($this->Friend->save($this->data)) {
				$this->Session->setFlash(__('The friend has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The friend could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Friend->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid friend', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Friend->save($this->data)) {
				$this->Session->setFlash(__('The friend has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The friend could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Friend->read(null, $id);
		}
		$users = $this->Friend->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for friend', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Friend->delete($id)) {
			$this->Session->setFlash(__('Friend deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Friend was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Friend->recursive = 1;
		$this->set('friends', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid friend', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('friend', $this->Friend->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Friend->create();
			if ($this->Friend->save($this->data)) {
				$this->Session->setFlash(__('The friend has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The friend could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Friend->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid friend', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Friend->save($this->data)) {
				$this->Session->setFlash(__('The friend has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The friend could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Friend->read(null, $id);
		}
		$users = $this->Friend->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for friend', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Friend->delete($id)) {
			$this->Session->setFlash(__('Friend deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Friend was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
