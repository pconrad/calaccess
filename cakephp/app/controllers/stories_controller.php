<?php
class StoriesController extends AppController {

  var $name = 'Stories';

  var $helpers = array('Html', 'Form', 'Javascript', 'Fck');

  function index() {
    $this->Story->recursive = 0;
    $this->set('stories', $this->paginate());
  }

  function view($id = null) {
    if (!$id) {
      $this->Session->setFlash(sprintf(__('Invalid %s', true)
			       , 'story'));
      $this->redirect(array('action' => 'index'));
    }
    $this->set('story', $this->Story->read(null, $id));
    $this->set('stories', $this->paginate());
  }

  function add() {
    if (!empty($this->data)) {
      $this->Story->create();
      if ($this->Story->save($this->data)) {
	$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'story'));
	$this->redirect(array('action' => 'index'));
      } else {
	$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'story'));
      }
    }
  }

  function edit($id = null) {
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(sprintf(__('Invalid %s', true)
				       , 'story'));
      $this->redirect(array('action' => 'index'));
    }
    if (!empty($this->data)) {
      if ($this->Story->save($this->data)) {
	$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'story'));
	$this->redirect(array('action' => 'index'));
      } else {
	$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'story'));
      }
    }
    if (empty($this->data)) {
      $this->data = $this->Story->read(null, $id);
    }
  }

  function delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(sprintf(__('Invalid id for %s'
					  , true), 'story'));
      $this->redirect(array('action'=>'index'));
    }
    if ($this->Story->delete($id)) {
      $this->Session->setFlash(sprintf(__('%s deleted', true)
				       , 'Story'));
      $this->redirect(array('action'=>'index'));
    }
    $this->Session->setFlash(sprintf(__('%s was not deleted', true)
				     , 'Story'));
    $this->redirect(array('action' => 'index'));
  }
}
?>

