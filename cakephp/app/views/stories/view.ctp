<?php echo $html->css('stories/view.css',null,array("inline"=>false)); ?>



<div class="storiesView">
	<h2><?php __('Stories'); ?></h2>

	<div id='firstStory'>
           <span class='storyTitle' style="font-weight:bold">
<?php echo $story['Story']['title']; ?></span>
           <div class='storyBody'>
<!-- vvvvvvvvvvvvvv contents of storyBody below this line  vvvvvvvv -->

<?php echo $story['Story']['body'] ?>

<!-- ^^^^^^^^^^^^^^ contents of storyBody above this line  ^^^^^^^^ -->

           </div><!--storyBody-->
	   <div class='storyActions'>

<span class="storyAction"><?php 
 echo $this->Html->link(__('View', true), array('action' => 'view', $story['Story']['id']));?></span> 
	&nbsp;
<span class="storyAction"><?php 
 echo $this->Html->link(__('Edit', true), array('action' => 'edit', $story['Story']['id']));?></span>
	&nbsp;
<span class="storyAction"><?php 
 echo $this->Html->link(__('Delete', true), array('action' => 'delete', $story['Story']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $story['Story']['id']));?></span> 

	   </div><!-- storyActions -->
        </div> <!-- firstStory -->

        <div id='allTheStories'>
	<?php 
	for ($i = 0; $i<(count($stories)); $i++)
        {
        ?>
	   
	   <img class='arrow' src="http://foo.cs.ucsb.edu/hamstra/arrow.gif" />
	   <br>
	   <div class='sideStory'>
           <div class='storyTitle'><?php echo $stories[$i]['Story']['title'] ?></div><!--storyTitle-->

	   <div class='storyActions'>

<span class="storyAction"><?php 
 echo $this->Html->link(__('View', true), array('action' => 'view', $stories[$i]['Story']['id']));?></span> 
&nbsp;
<span class="storyAction"><?php 
 echo $this->Html->link(__('Edit', true), array('action' => 'edit', $stories[$i]['Story']['id']));?></span>
&nbsp;
<span class="storyAction"><?php 
 echo $this->Html->link(__('Delete', true), array('action' => 'delete', $stories[$i]['Story']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $stories[$i]['Story']['id']));?></span> 
	   </div><!-- storyActions -->


           </div><!-- sideStory -->
	   <br>
        <?php
        } // end of for loop for all the stories 
	?>
        </div><!-- restOfStories -->

</div><!-- class: stories index -->