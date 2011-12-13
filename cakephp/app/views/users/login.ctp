<?php echo $html->css('users/users.css',null,array("inline"=>false)); ?>

<p>Welcome to CalAccess</p>



<h1>UCSB CSIL LDAP login: try your CSIL username/password</h1>

<h2 style="color:red; font-weight:bold">WARNING: if you don't see https, DON'T DO IT!</h2>

<!-- <p><a href="users">Main Page</a></p> --!>

<?php
   echo	$form->create('Users');
   echo	$form->input('uid',array('class'=>'inputText','size'=>'10',
                                 'label'=>'Username', 'maxlength'=>'100',
                                 'value'=>'', 'type'=>'text',
                                 'required' => array('rule'=>'notEmpty',
                                                     'message'=>'Required!')));
   echo	$form->input('password',array('class'=>'inputText','size'=>'10',
                                      'label'=>'Password', 'type'=>'password',
                                      'maxlength'=>'100','value'=>'',
                                      'required' => array('rule'=>'notEmpty',
                                                   'message'=>'Required!')));
   echo $form->end('Submit');
   
?>



</body>
</html>

