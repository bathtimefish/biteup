<?php
class UsersController extends AppController {

	var $name = 'Users';
    var $helpers = array('Javascript');
    var $components = array('Auth', 'WebApi', 'Facebook');
    var $uses = array('User', 'Friend', 'Feed', 'Like');

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
        $this->set('async_json_data', json_encode(array('rows'=>array('name'=>'nakashizu', 'userid'=>'1234'))));  //仮のasyncデータ
        $friends = $this->Friend->find('list', array('conditions'=> array('Friend.user_id'=>$this->Auth->user('id'))));
        if(!empty($friends)) {
            $arybuf = array();
            foreach($friends as $friend) {
                array_push($arybuf, $friend);
            }
            array_push($arybuf, $this->Auth->user('id'));
            /*
            $this->paginate = array(
                'order' => 'Feed.created DESC',
                'conditions'=> array('Feed.user_id IN ('.implode(',', $arybuf).')'),
                'limit' => 10
            );
            $this->set('feeds', $this->paginate('Feed'));
             */
            $this->Feed->recursive = 1;
            $conditions = array('Feed.user_id IN ('.implode(',', $arybuf).')');
            $order = array('Feed.created DESC');
            $limit = 10;
            $feeds = $this->Feed->find('all', array('conditions'=>$conditions, 'order'=>$order, 'limit'=>$limit));
            $timelines = array();
            $this->Like->recursive = -1;
            foreach($feeds as $feed) {
                $feed['Like']['likes'] = $this->Like->find('count', array('conditions'=>array('Like.feed_id'=>$feed['Feed']['id'])));
                $feed['Like']['comments'] = $this->Like->find('count', array('conditions'=>array('Like.feed_id'=>$feed['Feed']['id'], 'Like.message IS NOT NULL')));
                array_push($timelines, $feed);
            }
            $this->set('feeds', $timelines);
        }
        $this->set('userid', $this->Auth->user('id'));
        $this->set('nickname', $this->Auth->user('username'));
    }
    /*
    function index() {
        $this->layout = '';
        $this->User->recursive = 0;
        $this->set('user', $this->User->read(null, $this->Auth->user('id')));
    }
     */

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

    function join() {
        $this->layout = '';
        if (!empty($this->data)) {
            // 1.join_passwordがある場合、passwordをハッシュ化して格納
            if(!empty($this->data['User']['join_password'])) {
                $this->data["User"]["password"] = $this->Auth->password($this->data['User']['join_password']);
            }
            $this->data['User']['point'] = 0; //アカウント登録時の初期ポイントを設定
            $this->data['User']['current_jobkind_id'] = 0; //アカウント登録時の職業IDを設定
            $this->data['User']['current_level'] = 0; //アカウント登録時のレベルを設定
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
        if(!$id) $id = $this->Auth->user('id'); // get User.id for Auth Session
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
		if ($id) {
			$this->set('user', $this->User->read(null, $id));
		}
        // Facebook 連携
        $fb_uid = null;
        $fb_uid = $this->Facebook->getUser();
        if($fb_uid == 0) {
            $me = $this->Facebook->getMe($this->Auth->user('id'));
            $fb_uid = $me['id'];
        }
        $this->set('fb_uid', $fb_uid);
    }

    function retire($id = null) {
        if(!$id) $id = $this->Auth->user('id');
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
        }
        // リタイヤ処理用画面のリダイレクトが未決定
        /*
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
        }
         */
        /* impl not yet... */
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

    //Facebook認証へのリダイレクト
    function fbauth() {
        $this->autoRender = false;
        if($this->Facebook->getUser()) { //認証OK後 save&redirect
            if($this->Facebook->saveUser($this->Auth->user('id'))) {
                $this->Session->setFlash('Facebook Authorized');
            } else {
                $this->Session->setFlash(__('Error: cannot Authorized to Facebook', true));
            }
            $this->redirect('edit');
        }
        $this->redirect($this->Facebook->getLoginUrl());
    }

    function login() {
        $this->layout = '';
    }

    function logout() {
        $this->redirect($this->Auth->logout());
    }

    /*** API Contollers ***/

    // async data what toppage neeeds.
    function api_index() {
        $this->autoRender = false;
        // set jobs get near checkin

        // set information count for badge
        
        // set now timelines
        $this->Feed->recursive = 1;
        $this->Like->recursive = -1;
        $fields = array('Feed.id', 'Job.jobkind_id', 'User.current_level', 'User.id', 'Feed.message', 'Feed.created');
        $conditions = array('Feed.user_id'=>$this->Auth->user('id'));
        $order = array('Feed.id DESC');
        $limit = 10;
        $feeds = $this->Feed->find('all', array('fields'=>$fields, 'conditions'=>$conditions, 'order'=>$order, 'limit'=>$limit));
        if(!empty($feeds)) {
            $data = array('feeds'=>array());
            foreach($feeds as $feed) {
                $likesCount = $this->Like->find('count', array('conditions'=>array('Like.feed_id'=>$feed['Feed']['id'])));
                $commentCount = $this->Like->find('count', array('conditions'=>array('Like.feed_id'=>$feed['Feed']['id'], 'Like.message IS NOT NULL')));
                $message = $feed['Feed']['message'];
                $row = array(
                    'id' => $feed['Feed']['id'],
                    'jobkind' => $feed['Job']['jobkind_id'],
                    'level' => $feed['User']['current_level'],
                    'userId' => $feed['User']['id'],
                    'body' => $message,
                    'likesCount' => $likesCount,
                    'commentCount' => $commentCount,
                    'created' => $feed['Feed']['created']
                );
                array_push($data['feeds'], $row);
            }
            $this->WebApi->sendApiResult($data);
        }

    }

    // async data what past feeds
    function api_tl($last_feed_id = null) {
        $this->autoRender = false;
        if($last_feed_id) {
            $conditions = array('Feed.id <'=>intval($last_feed_id), 'Feed.user_id'=>$this->Auth->user('id'));
        } else {
            $conditions = array('Feed.user_id'=>$this->Auth->user('id'));
        }
        $order = array('Feed.id DESC');
        $limit = 10;
        $feeds = $this->Feed->find('all', array('conditions'=>$conditions, 'order'=>$order, 'limit'=>$limit));
        if(!empty($feeds)) {
            $data = array('feeds'=>array());
            foreach($feeds as $feed) {
                $likesCount = $this->Like->find('count', array('conditions'=>array('Like.feed_id'=>$feed['Feed']['id'])));
                $commentCount = $this->Like->find('count', array('conditions'=>array('Like.feed_id'=>$feed['Feed']['id'], 'Like.message IS NOT NULL')));
                $message = $feed['Feed']['message'];
                $row = array(
                    'id' => $feed['Feed']['id'],
                    'jobkind' => $feed['Job']['jobkind_id'],
                    'level' => $feed['User']['current_level'],
                    'userId' => $feed['User']['id'],
                    'body' => $message,
                    'likesCount' => $likesCount,
                    'commentCount' => $commentCount,
                    'created' => $feed['Feed']['created']
                );
                array_push($data['feeds'], $row);
            }
            $this->WebApi->sendApiResult($data);
        }
    }

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
