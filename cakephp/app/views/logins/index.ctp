<?php echo $html->css('logins/logins.css',null,array("inline"=>false)); ?>

<p>Welcome to the big silly website</p>



<h1>Test of LDAP login---try your CSIL username/password</h1>

<h2 style="color:red; font-weight:bold">WARNING: if you don't see https, don't type in anything!</h2>

<p><a href="choices">Main Page</a></p>

<?php
   echo	$form->create('Logins');
   echo	$form->input('uid',array('class'=>'inputText','size'=>'10','maxlength'=>'100','value'=>''));
   echo	$form->password('password',array('class'=>'inputText','size'=>'10','maxlength'=>'100','value'=>''));
   echo $form->end('Submit');
?>



</body>
</html>

