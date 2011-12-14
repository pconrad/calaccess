<!-- index.ctp -->

<?php echo $html->css('users/users.css',null,array("inline"=>false)); ?>

<p>Welcome to CalAccess</p>
<br>
<?php
echo $this->Html->link('OAuth Test',array('controller' => 'users', 'action' => 'oauth_and_test'));
?>
<br>
<?php


echo  "session: " . json_encode($session_val);

?>
<br>
<?php
   
   
   if($usertype == 'admin')
   {
      echo "You are logged in as an administrator.";
   }
   else
   {
      echo "You are logged in as a lowly unpriveledged user.";

   }
?>
