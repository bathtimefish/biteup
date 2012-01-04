<?php
class UsersController extends AppController {

	var $name = 'Users';
    var $helpers = array('Javascript');
    var $components = array('Auth', 'WebApi');
    var $uses = array('User', 'Friend');

    function beforeFilter(){
        $this->Auth->userModel = 'User';
        $this->Auth->loginAction = array('action' => 'login');
        $this->Auth->loginRedirect = array('action' => 'index');
        $this->Auth->logoutRedirect = array('action' => 'login');
        $this->Auth->allow('login', 'logout', 'add');
        $this->Auth->loginError = 'username or password is invalid.';
        $this->Auth->authError = 'Please try logon as admin.';
    }

    function toptest() {
            $this->set('async_json_data', json_encode(array('rows'=>array('name'=>'nakashizu', 'userid'=>'1234'))));
            $this->set('userid', $this->Auth->user('id'));
            $this->set('nickname', $this->Auth->user('username'));
    }

    function index() {
        $this->layout = '';
        $this->User->recursive = 0;
        $this->set('user', $this->User->read(null, $this->Auth->user('id')));
    }

    // search friend
    function searchfriend() {
        $this->User->recursive = 0;
        if(!empty($this->data['User']['keyword'])) {
            $this->paginate = array(
                'conditions' => array('User.username like' => '%'.$this->data['User']['keyword'].'%')
            );
            $this->set('users', $this->paginate());
        }
    }

    // list follow Users
    function followusers() {
        $this->Friend->recursive = 1;
        $this->paginate = array(
            'conditions' => array('Friend.user_id' => $this->Auth->user('id'))
        );
        $this->set('users', $this->paginate('Friend'));
    }

    // user follow a friend
    function follow($id = null) {
        $this->Friend->recursive = 0;
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for user', true));
            $this->redirect(array('action'=>'searchfriend'));
        }
        // 既にフォローされているか?
        $followed = $this->Friend->find('first', array('conditions'=>array('Friend.user_id'=>$this->Auth->user('id'), 'Friend.friend_id'=>$id)));
        if(!empty($followed)) {
            $this->Session->setFlash(__('This user is already followed', true));
            $this->redirect(array('action'=>'searchfriend'));
        }
        // Friend データを構成
        $friend = array('Friend' => array('user_id' => $this->Auth->user('id'), 'friend_id' => $id));
        $this->User->create();
        if ($this->User->Friend->save($friend)) {
            $this->Session->setFlash(__('followed!', true));
            $this->redirect(array('action' => 'followusers'));
        } else {
            $this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
        }
    }

    // user unfollow a friend
    function unfollow($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for follower', true));
            $this->redirect(array('action'=>'followusers'));
        }
        $friend = $this->User->Friend->find('first', array('conditions'=>array('Friend.friend_id'=>$id, 'Friend.user_id'=>$this->Auth->user('id'))));
        if($friend) {
            if ($this->User->Friend->delete($friend['Friend']['id'])) {
                $this->Session->setFlash(__('unfollowed!', true));
                $this->redirect(array('action'=>'followusers'));
            }
        }
        $this->Session->setFlash(__('This Friend unfollow is unabled', true));
        $this->redirect(array('action' => 'followusers'));
    }

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

    function add() {
        $this->layout = '';
        if (!empty($this->data)) {
            $this->data['User']['point'] = 0; //アカウント登録時の初期ポイントを設定
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}

    function edit($id = null) {
        if(!$id) $id = $this->Auth->user('id'); //セッションからユーザIDを取得
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
    }


    function login() {
        $this->layout = '';
    }

    function logout() {
        $this->redirect($this->Auth->logout());
    }

    /*** API Contollers ***/

    // user follow a friend
    function api_follow($id = null) {
        $this->autoRender = false;
        $this->Friend->recursive = 0;
        if (!$id) {
            $data = array('success'=>false, 'error'=>'noid');
            $this->WebApi->sendApiResult($data);
            return false;
        }
        // 既にフォローされているか?
        $followed = $this->Friend->find('first', array('conditions'=>array('Friend.user_id'=>$this->Auth->user('id'), 'Friend.friend_id'=>$id)));
        if(!empty($followed)) {
            $data = array('success'=>false, 'error'=>'alreadyfollowed', 'userid'=>$id);
            $this->WebApi->sendApiResult($data);
            return false;
        }
        // Friend データを構成
        $friend = array('Friend' => array('user_id' => $this->Auth->user('id'), 'friend_id' => $id));
        $this->User->create();
        if ($this->User->Friend->save($friend)) {
            $data = array('success'=>true, 'userid'=>$id);
            $this->WebApi->sendApiResult($data);
            return true;
        } else {
            $this->WebApi->sendApiResult(null);
        }
    }

    // user unfollow a friend
    function api_unfollow($id = null) {
        $this->autoRender = false;
        if (!$id) {
            $data = array('success'=>false, 'error'=>'noid');
            $this->WebApi->sendApiResult($data);
            return false;
        }
        $friend = $this->User->Friend->find('first', array('conditions'=>array('Friend.friend_id'=>$id, 'Friend.user_id'=>$this->Auth->user('id'))));
        if($friend) {
            if ($this->User->Friend->delete($friend['Friend']['id'])) {
                $data = array('success'=>true, 'userid'=>$id);
                $this->WebApi->sendApiResult($data);
            }
            return true;
        }
        $this->WebApi->sendApiResult(null);
    }

    //*** Admin Controllers ***

	function admin_index() {
		$this->User->recursive = 0;
        $this->layout = 'admin';
		$this->set('users', $this->paginate());
    }

	function admin_view($id = null) {
        $this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
        $this->layout = 'admin';
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
        $this->layout = 'admin';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
