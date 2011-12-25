<?php
class FeedsController extends AppController {

	var $name = 'Feeds';
	var $helpers = array('Javascript');

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
}
