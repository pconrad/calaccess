<?php
require_once '../src/apiClient.php';
require_once '../src/contrib/apiCalendarService.php';
	
class UsersController extends AppController {

  var $name = 'Users';
  var $helpers = array('Html','Javascript','Form');
  var $components = array('ldapauth');
  // You can continue to just add "helpers" into the array--e.g. if there are helpers Foo, Bar, Fum
  // make the array:

  // var $helpers = array('Javascript', 'Html', 'Foo', 'Bar', 'Fum');
  
  function login() {
	if($this->Session -> read("loggedIn") == true) {
	  $this->redirect(array('action'=>'index'));
	  echo "Redirected to index, you're already logged in.";
	}
	else{
	  $this->layout = 'main'; // use main.ctp from view/layouts instead of the default.ctp
	  $this->set('title_for_layout', 'Login'); 
	  if ($this->ldapauth->authValidateUser($this->data['Users']['uid'], $this->data['Users']['password'] ))
	  {
		$this -> Session -> write("loggedIn", true);
		$this -> Session -> write("user", $this->data['Users']['uid']);
		$this->Redirect("index");
	  }
	  else
	  {
		$this -> Session -> write("loggedIn", false);
		$this -> Session -> write("user", "");
	  }
	}
  }

  function logout() {
    $this->Session->destroy();
    $this->redirect(array('action'=>'login'));
    exit();
  }
  function index(){
	$this->layout = 'main'; // use main.ctp from view/layouts instead of the default.ctp
    $this->set('title_for_layout', 'Index');
	
	if($this->Session -> read("loggedIn") == false) $this->redirect(array('action'=>'login'));
	else{
	  
	  $uid = $this->Session->read('user');
	  $this->set('uid', $uid);
	  $this->set('usertype', 'notadmin');
	  //thefile is the file that stores the list of administrators on disk
	  $thefile = file("/local/home/dab/public_html/calaccess/cakephp/app/administrators.txt");
	  foreach ($thefile as $line) {
		$line = preg_replace("'\s+'", '', $line);
		if ($uid == $line) {
		  $this->set('usertype', 'admin');
		}
	  }
	}
  }
  function oauth_and_test(){	                                                                                                                          
	//session_start();
	$this->layout = 'main'; // use main.ctp from view/layouts instead of the default.ctp
    $this->set('title_for_layout', 'Oauth And Test :D');

	if($this->Session -> read("loggedIn") == false) $this->redirect(array('action'=>'login'));
	else{
	  $uid = $this->Session->read('user');
	  $this->set('uid', $uid);
	  $this->set('usertype', 'notadmin');
	  $usertype = "notadmin";
	  $thefile = file("/local/home/dab/public_html/calaccess/cakephp/app/administrators.txt");
	  foreach ($thefile as $line) {
		$line = preg_replace("'\s+'", '', $line);
		if ($uid == $line) {
		  $this->set('usertype', 'admin');
		  $usertype = "admin";
		}
	  }
	  echo("YAAAAAAAAAAAARRRRRRRRR " . $uid . " " . $usertype . " ");

	  //if($uid != "admin")  $this->redirect(array('action'=>'login'));
	  //else{
	  if(1){	
		$apiClient = new apiClient();
		$apiClient->setUseObjects(true);
		$service = new apiCalendarService($apiClient);
		
		if (isset($_SESSION['oauth_access_token'])) {
		  $apiClient->setAccessToken($_SESSION['oauth_access_token']);
		} else {
		  $token = $apiClient->authenticate();
		  $_SESSION['oauth_access_token'] = $token;
		}
		
		$events = $service->events->listEvents('primary');
		
		while(true) {
		  foreach ($events->getItems() as $event) {
			echo $event->getSummary();
		  }
		  $pageToken = $events->getNextPageToken();
		  if ($pageToken) {
			$optParams = array('pageToken' => $pageToken);
			$events = $service->events->listEvents('primary', $optParams);
			
		  } else {
			break;
		  }
		 }
	  }
	}
	
	/*

	*/
	//using Google OAuth2.0 (with offline access, meaning the google username only needs to be manually authenticated on its first use
	//make request to google, i.e.:
//	
//	https://accounts.google.com/o/oauth2/auth?
//	scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile&
//	state=%2Fprofile&
//	redirect_uri=https%3A%2F%2Foauth2-login-demo.appspot.com%2Fcode&
//	response_type=code&
//	client_id=812741506391.apps.googleusercontent.com&
//	access_type=offline
//	
	
	//if first time, send browser to above URL, user must log in with google creds,
	//	then calaccess will receive refresh token AND access token
	//else if not first time, 
	//receive auth code, use it to exchange for a token
	
	//API access granted
  
//BEGIN EXAMPLE CODE
	
	// In a real application this would use a database, and not a session!
	//session_start();
	//
	//    
	//  $client = new apiClient();
	//  // Visit https://code.google.com/apis/console to generate your
	//  // oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
	//  $client->setClientId('701310813104.apps.googleusercontent.com');
	//  $client->setClientSecret('qwRgv3qYDDK3c_UezJ30MFUK');
	//  $client->setRedirectUri('https://foo.cs.ucsb.edu/dab/calaccess');
	//  $client->setApplicationName("CalAccess");
	//  $calendar = new apiCalendarService($client);
	//  if (isset($_SESSION['access_token'])) {
	//	$client->setAccessToken($_SESSION['access_token']);
	//  } else {
	//	$client->setAccessToken($client->authenticate());
	//  }
	//  $_SESSION['access_token'] = $client->getAccessToken();
	//  
	//  if (isset($_GET['code'])) {
	//	header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
	//  }
	//  echo("ABOUT TO CHECK");
	//  // Make an authenticated request to the Calendar API.
	//  if ($client->getAccessToken()) {
	//	echo("SOMETHING");
	//	//$me = $calendar->list();
	//	//$ident = '<img src="%s"> <a href="%s">%s</a>';
	//	printf("ACCESS TOKEN GRANTED!");
	//  }
	//  else{
	//	echo("SOMETING ELSE");
	//  }
  }


//  }
}
?>