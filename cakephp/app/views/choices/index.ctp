<?php echo $html->css('choices/choices.css',null,array("inline"=>false)); ?>

<p>Welcome to the CalAccess website</p>
<?php

 if($this->Session->read("loggedIn")) {
  echo "<p>Logged in as ".$this->Session->read("user")."</p>";
 }	
 else {
   
    echo $this->Html->link('Login',array('controller' => 'logins'));
   
    // echo "<p><a href='logins'>Login</a></p>";
 }


// echo $html->image('main/bswMainBackgroundcroped.jpg', 
//		     array('alt' => 'main background image',
// 		    'id'=>'mainBackgroundImage')
//		    );

 ?> 


