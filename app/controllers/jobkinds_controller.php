<?php
class JobkindsController extends AppController {

	var $name = 'Jobkinds';
	var $helpers = array('Javascript');

	function index() {
		$this->Jobkind->recursive = 0;
		$this->set('jobkinds', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid jobkind', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('jobkind', $this->Jobkind->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Jobkind->create();
			if ($this->Jobkind->save($this->data)) {
				$this->Session->setFlash(__('The jobkind has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jobkind could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid jobkind', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Jobkind->save($this->data)) {
				$this->Session->setFlash(__('The jobkind has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jobkind could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Jobkind->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for jobkind', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Jobkind->delete($id)) {
			$this->Session->setFlash(__('Jobkind deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Jobkind was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Jobkind->recursive = 0;
		$this->set('jobkinds', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid jobkind', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('jobkind', $this->Jobkind->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Jobkind->create();
			if ($this->Jobkind->save($this->data)) {
				$this->Session->setFlash(__('The jobkind has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jobkind could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid jobkind', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Jobkind->save($this->data)) {
				$this->Session->setFlash(__('The jobkind has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jobkind could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Jobkind->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for jobkind', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Jobkind->delete($id)) {
			$this->Session->setFlash(__('Jobkind deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Jobkind was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
