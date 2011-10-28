<?php
class ChoicesController extends AppController {

  var $name = 'Choices';
  var $helpers = array('Html','Javascript');

  // You can continue to just add "helpers" into the array--e.g. if there are helpers Foo, Bar, Fum
  // make the array:

  // var $helpers = array('Javascript', 'Html', 'Foo', 'Bar', 'Fum');


  function index() {
    $this->layout = 'main'; // use main.ctp from view/layouts instead of the default.ctp

    $this->set('title_for_layout', 'Main CalAccess Page'); 
    // in 1.2 this was $this->pageTitle = 'Main BSW Page'; 

  }

}
?>