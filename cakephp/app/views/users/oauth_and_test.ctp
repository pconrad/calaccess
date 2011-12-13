<!-- oauth_and_test.ctp -->

<?php echo $html->css('users/users.css',null,array("inline"=>false)); ?>

<p>Welcome to CalAccess(OAUTH & TEST)</p>
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
