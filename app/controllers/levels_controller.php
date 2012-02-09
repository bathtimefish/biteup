<?php
class LevelsController extends AppController {

	var $name = 'Levels';
	var $helpers = array('Javascript');

	function index() {
		$this->Level->recursive = 0;
		$this->set('levels', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid level', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('level', $this->Level->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Level->create();
			if ($this->Level->save($this->data)) {
				$this->Session->setFlash(__('The level has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The level could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid level', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Level->save($this->data)) {
				$this->Session->setFlash(__('The level has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The level could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Level->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for level', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Level->delete($id)) {
			$this->Session->setFlash(__('Level deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Level was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
    function admin_index() {
        $this->layout = 'admin';
		$this->Level->recursive = 0;
		$this->set('levels', $this->paginate());
	}

	function admin_view($id = null) {
        $this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Invalid level', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('level', $this->Level->read(null, $id));
	}

	function admin_add() {
        $this->layout = 'admin';
		if (!empty($this->data)) {
			$this->Level->create();
			if ($this->Level->save($this->data)) {
				$this->Session->setFlash(__('The level has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The level could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
        $this->layout = 'admin';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid level', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Level->save($this->data)) {
				$this->Session->setFlash(__('The level has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The level could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Level->read(null, $id);
		}
	}

	function admin_delete($id = null) {
        $this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for level', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Level->delete($id)) {
			$this->Session->setFlash(__('Level deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Level was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
