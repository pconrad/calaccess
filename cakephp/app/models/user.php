<?php 

  // This is an example of how to make a model that doesn't correspond to a database table
  // This allows us to just have URLs that do this, that or the other that are like
  //   bsw/cakephp/choices/main  or bsw/cakephp/choices/help    i.e. things that are not
  // connected to any particular story.   Once we are operating a story, we'll want a URL
  // such as /bsw/cakephp/stories/edit/13  i.e. to edit story number 13

class User extends AppModel
{
  var $name = 'User'; // should be singular
  var $useTable = false; // this is the magic line that says "NO DATABASE TABLE"
}
?>
