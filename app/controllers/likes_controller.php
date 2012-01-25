<?php
class LikesController extends AppController {

	var $name = 'Likes';
	var $helpers = array('Javascript');

	function index() {
		$this->Like->recursive = 0;
		$this->set('likes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid like', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('like', $this->Like->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Like->create();
			if ($this->Like->save($this->data)) {
				$this->Session->setFlash(__('The like has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The like could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Like->User->find('list');
		$jobs = $this->Like->Job->find('list');
		$jobkinds = $this->Like->Jobkind->find('list');
		$feeds = $this->Like->Feed->find('list');
		$this->set(compact('users', 'jobs', 'jobkinds', 'feeds'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid like', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Like->save($this->data)) {
				$this->Session->setFlash(__('The like has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The like could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Like->read(null, $id);
		}
		$users = $this->Like->User->find('list');
		$jobs = $this->Like->Job->find('list');
		$jobkinds = $this->Like->Jobkind->find('list');
		$feeds = $this->Like->Feed->find('list');
		$this->set(compact('users', 'jobs', 'jobkinds', 'feeds'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for like', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Like->delete($id)) {
			$this->Session->setFlash(__('Like deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Like was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
    function admin_index() {
        $this->layout = 'admin';
		$this->Like->recursive = 0;
		$this->set('likes', $this->paginate());
	}

	function admin_view($id = null) {
        $this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Invalid like', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('like', $this->Like->read(null, $id));
	}

	function admin_add() {
        $this->layout = 'admin';
		if (!empty($this->data)) {
			$this->Like->create();
			if ($this->Like->save($this->data)) {
				$this->Session->setFlash(__('The like has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The like could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Like->User->find('list');
		$jobs = $this->Like->Job->find('list');
		$jobkinds = $this->Like->Jobkind->find('list');
		$feeds = $this->Like->Feed->find('list');
		$this->set(compact('users', 'jobs', 'jobkinds', 'feeds'));
	}

	function admin_edit($id = null) {
        $this->layout = 'admin';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid like', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Like->save($this->data)) {
				$this->Session->setFlash(__('The like has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The like could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Like->read(null, $id);
		}
		$users = $this->Like->User->find('list');
		$jobs = $this->Like->Job->find('list');
		$jobkinds = $this->Like->Jobkind->find('list');
		$feeds = $this->Like->Feed->find('list');
		$this->set(compact('users', 'jobs', 'jobkinds', 'feeds'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for like', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Like->delete($id)) {
			$this->Session->setFlash(__('Like deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Like was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
