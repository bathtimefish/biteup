<?php
class FeedsController extends AppController {

 var $name = 'Feeds';
 var $helpers = array('Javascript');
 var $components = array('Auth', 'WebApi');
 var $uses = array('Feed', 'Friend', 'Like', 'Job');

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
  $this->set('feeds', $this->paginate());
 }

 function admin_view($id = null) {
  if (!$id) {
   $this->Session->setFlash(__('Invalid feed', true));
   $this->redirect(array('action' => 'index'));
  }
  $this->set('feed', $this->Feed->read(null, $id));
 }

 function admin_add() {
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
  $this->set('feeds', $this->paginate());
  $friends = $this->Friend->find('all', array('conditions'=> array('user_id'=>$id)));

  $feed_id = '';
  foreach ($friends as $val) {
   $feed_id .= $val['Friend']['friend_id'].',';
  }
  $feed_id = $feed_id.$id;
  $timeline = $this->Feed->find('all', array('order' => 'Feed.created DESC','conditions'=> array("Feed.user_id IN ($feed_id)")));
  $this->set(compact('timeline'));
 }
 
	function detail($feed_id) {
		if (!$feed_id) {
			$this->Session->setFlash(__('Invalid feed', true));
			$this->redirect(array('action' => 'index'));
		}
		$detail = $this->Feed->read('', $feed_id);
		if (!empty($this->data)) {
			$jobs = $this->Job->read('', $detail['Feed']['job_id']);
			$data = array();
			$data['Like']['user_id']    = $detail['Feed']['user_id'];
			$data['Like']['friend_id']  = $this->Auth->user('id');
			$data['Like']['feed_id']    = $feed_id;
			$data['Like']['job_id']     = $detail['Feed']['job_id'];
			$data['Like']['message']    = $this->data['Feed']['message'];
			$data['Like']['jobkind_id'] = $jobs['Job']['jobkind_id'];
			$data['Like']['point']      = 5;
			$this->Like->save($data);
		}
		$this->set('feeds', $this->paginate());
		$likes  = $this->Like->find('all', array('conditions'=> array("Like.feed_id" => $feed_id)));
		$this->set(compact('detail', 'likes'));
	}

}
