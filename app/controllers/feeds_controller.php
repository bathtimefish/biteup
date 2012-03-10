<?php
class FeedsController extends AppController {

 var $name = 'Feeds';
 var $helpers = array('Javascript');
 var $components = array('Auth', 'WebApi', 'Timeline', 'LevelCalc', 'Facebook');
 var $uses = array('Feed', 'Friend', 'Like', 'Job', 'Level');


 function index() {
  $this->Feed->recursive = 0;
  $this->set('feeds', $this->paginate());
 }

 function view($id = null) {
  if (!$id) {
   $this->Session->setFlash(__('Invalid feed', true));
   $this->redirect(array('action' => 'index'));
  }
  $this->set('feed', $this->Feed->read(null, $id));
 }

 function add() {
  if (!empty($this->data)) {
   $this->Feed->create();
   if ($this->Feed->save($this->data)) {
    $this->Session->setFlash(__('The feed has been saved', true));
    $this->redirect(array('action' => 'index'));
   } else {
    $this->Session->setFlash(__('The feed could not be saved. Please, try again.', true));
   }
  }
  $users = $this->Feed->User->find('list');
  $jobs = $this->Feed->Job->find('list');
  $this->set(compact('users', 'jobs'));
 }

 function edit($id = null) {
  if (!$id && empty($this->data)) {
   $this->Session->setFlash(__('Invalid feed', true));
   $this->redirect(array('action' => 'index'));
  }
  if (!empty($this->data)) {
   if ($this->Feed->save($this->data)) {
    $this->Session->setFlash(__('The feed has been saved', true));
    $this->redirect(array('action' => 'index'));
   } else {
    $this->Session->setFlash(__('The feed could not be saved. Please, try again.', true));
   }
  }
  if (empty($this->data)) {
   $this->data = $this->Feed->read(null, $id);
  }
  $users = $this->Feed->User->find('list');
  $jobs = $this->Feed->Job->find('list');
  $this->set(compact('users', 'jobs'));
 }

 function delete($id = null) {
  if (!$id) {
   $this->Session->setFlash(__('Invalid id for feed', true));
   $this->redirect(array('action'=>'index'));
  }
  if ($this->Feed->delete($id)) {
   $this->Session->setFlash(__('Feed deleted', true));
   $this->redirect(array('action'=>'index'));
  }
  $this->Session->setFlash(__('Feed was not deleted', true));
  $this->redirect(array('action' => 'index'));
 }
 function admin_index() {
  $this->Feed->recursive = 0;
  $this->layout = 'admin';
  $this->set('feeds', $this->paginate());
 }

 function admin_view($id = null) {
  $this->layout = 'admin';
  if (!$id) {
   $this->Session->setFlash(__('Invalid feed', true));
   $this->redirect(array('action' => 'index'));
  }
  $this->set('feed', $this->Feed->read(null, $id));
 }

 function admin_add() {
  $this->layout = 'admin';
  if (!empty($this->data)) {
   $this->Feed->create();
   if ($this->Feed->save($this->data)) {
    $this->Session->setFlash(__('The feed has been saved', true));
    $this->redirect(array('action' => 'index'));
   } else {
    $this->Session->setFlash(__('The feed could not be saved. Please, try again.', true));
   }
  }
  $users = $this->Feed->User->find('list');
  $jobs = $this->Feed->Job->find('list');
  $this->set(compact('users', 'jobs'));
 }

 function admin_edit($id = null) {
  $this->layout = 'admin';
  if (!$id && empty($this->data)) {
   $this->Session->setFlash(__('Invalid feed', true));
   $this->redirect(array('action' => 'index'));
  }
  if (!empty($this->data)) {
   if ($this->Feed->save($this->data)) {
    $this->Session->setFlash(__('The feed has been saved', true));
    $this->redirect(array('action' => 'index'));
   } else {
    $this->Session->setFlash(__('The feed could not be saved. Please, try again.', true));
   }
  }
  if (empty($this->data)) {
   $this->data = $this->Feed->read(null, $id);
  }
  $users = $this->Feed->User->find('list');
  $jobs = $this->Feed->Job->find('list');
  $this->set(compact('users', 'jobs'));
 }

 function admin_delete($id = null) {
  if (!$id) {
   $this->Session->setFlash(__('Invalid id for feed', true));
   $this->redirect(array('action'=>'index'));
  }
  if ($this->Feed->delete($id)) {
   $this->Session->setFlash(__('Feed deleted', true));
   $this->redirect(array('action'=>'index'));
  }
  $this->Session->setFlash(__('Feed was not deleted', true));
  $this->redirect(array('action' => 'index'));
 }

 function timeline() {
  $id = $this->Auth->user('id');
  if (!$id) {
   $this->Session->setFlash(__('Invalid feed', true));
   $this->redirect(array('action' => 'index'));
  }
  //フレンドを抽出
  $friends = $this->Friend->find('list', array('conditions'=> array('Friend.user_id'=>$this->Auth->user('id'))));
  if(!empty($friends)) {
      $arybuf = array();
      foreach($friends as $friend) {
          array_push($arybuf, $friend);
      }
      array_push($arybuf, $this->Auth->user('id'));
      $conditions = array('Feed.user_id IN ('.implode(',', $arybuf).')');
      $order = array('Feed.created DESC');
      $limit = 10;
      $feeds = $this->Feed->find('all', array('conditions'=>$conditions, 'order'=>$order, 'limit'=>$limit));
      $timelines = array();
      foreach($feeds as $feed) {
          $feed['Like']['likes'] = $this->Like->find('count', array('conditions'=>array('Like.feed_id'=>$feed['Feed']['id'], 'Like.user_id'=>$feed['Feed']['user_id'])));
          $feed['Like']['comments'] = $this->Like->find('count', array('conditions'=>array('Like.feed_id'=>$feed['Feed']['id'], 'Like.message IS NOT NULL', 'Like.user_id'=>$feed['Feed']['user_id'])));
          $feed['Feed']['created'] = $this->Timeline->getActionTime($feed['Feed']['created']);
          array_push($timelines, $feed);
      }
      $this->set('feeds', $timelines);
  }
  $this->set('title_for_action', 'マイサポーター');
  /*
  $this->set('feeds', $this->paginate());
  $timeline = $this->Timeline->getTimeline($id);
  $this->set(compact('timeline'));
   */
 }

	function detail($feed_id) {
		if (!$feed_id) {
			$this->Session->setFlash(__('Invalid feed', true));
			$this->redirect(array('action' => 'index'));
		}
		$detail = $this->Feed->read('', $feed_id);
        $detail['Feed']['action_time'] = $this->Timeline->getActionTime($detail['Feed']['created']);

        $jobs = $this->Job->read('', $detail['Feed']['job_id']);

        //最新の同業種のLikeを取得
        $like = $this->Like->find('first', array('conditions'=> array("Like.jobkind_id" => $jobs['Job']['jobkind_id'], "Like.friend_id" => $this->Auth->user('id')), 'order'=>'Feed.id DESC'));

        $like_flg = $this->Like->find('first', array('conditions'=> array("Like.feed_id" => $detail['Feed']['id'], "Like.friend_id" => $this->Auth->user('id')))) ? false : true;

        //Feed.job_id==0の場合は汎用メッセージなので $like_flg = false
        if($detail['Feed']['job_id'] == 0) $like_flg = false;

		if (!empty($this->data)) {
			$data = array();
			$data['Like']['user_id']    = $detail['Feed']['user_id'];
			$data['Like']['friend_id']  = $this->Auth->user('id');
			$data['Like']['feed_id']    = $feed_id;
            $data['Like']['job_id']     = $detail['Feed']['job_id'];
            $data['Like']['message']    = $this->Auth->user('username').'さんがおつかれ！と言っています。'."\n";
            if(!empty($this->data['Feed']['message'])) {
                $data['Like']['message'] .= $this->data['Feed']['message'];
            }
			$data['Like']['jobkind_id'] = $jobs['Job']['jobkind_id'];
			$data['Like']['point']      = 5; //オツカレポイント
			$data['Like']['current_point'] = strval(intval($like['Like']['current_point']) + intval($data['Like']['point'])); //現在の職業別ポイントを加算
            $this->Like->save($data);
            $level_uped = $this->LevelCalc->setUserLevel($this->Auth->user('id'), $jobs['Job']['jobkind_id']); //ユーザーのカレントレベル等を変更
            if($level_uped['uped']) { //レベルアップした
                $message = $level_uped['name'].' にレベルアップしました！';
                $feed = array(
                    'user_id' => $this->Auth->user('id'),
                    'job_id' => 0,
                    'message' => $message,
                );
                $this->Feed->create();
                $this->Feed->save($feed);
                $this->Facebook->publish($this->Auth->user('id'), $message);
            }
			$like_flg = false;
		}
        $this->set('feeds', $this->paginate());

        $likes  = $this->Like->find('all', array('order' => 'Like.created DESC','conditions'=> array("Like.feed_id" => $feed_id)));
		foreach ($likes as $key => $val){
			$likes[$key]['Like']['action_time'] = $this->Timeline->getActionTime($val['Like']['created']);
        }
        $this->set(compact('detail', 'likes', 'like_flg'));
        $this->set('title_for_action', $detail['User']['username'].'の詳細');
	}
}
