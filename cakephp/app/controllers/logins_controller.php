<?php
class LoginsController extends AppController {

  var $name = 'Logins';
  var $helpers = array('Html','Javascript','Form');
  var $components = array('ldapauth');

  // You can continue to just add "helpers" into the array--e.g. if there are helpers Foo, Bar, Fum
  // make the array:

  // var $helpers = array('Javascript', 'Html', 'Foo', 'Bar', 'Fum');


  function index() {
    $this->layout = 'main'; // use main.ctp from view/layouts instead of the default.ctp

    $this->set('title_for_layout', 'Main BSW Page'); 
    // in 1.2 this was $this->pageTitle = 'Main BSW Page'; 

    if ($this->ldapauth->authValidateUser($this->data['Logins']['uid'], $this->data['Logins']['password'] ))
      {

	// @@@ TODO FIGURE OUT HOW TO SET UP SESSION AS BEING LOGGED IN
	// 
	$this -> Session -> write("loggedIn", true);
	$this -> Session -> write("user", $this->data['Logins']['uid']);
      }
    else
      {

	// @@@ FIGURE OUT HOW TO SET UP SESSION AS NOT LOGGED IN...
	$this -> Session -> write("loggedIn", false);
	$this -> Session -> write("user", "");
      }
    
    /*    if($this->Session->read("loggedIn") ) {
      debug("Logged in as ".$this->Session->read("user"));
    }
    else
      {
	debug("Not logged in");
	} */
      
  }

  function logout() {
    $this->Session->destroy();
    $this->redirect(array('action'=>'index'));
    exit();
  }

}
?>