<?php echo $html->css('stories/index.css',null,array("inline"=>false)); ?>

<div class="stories index">
	<h2><?php __('Stories');?></h2>

	<div id='firstStory'>
           <div class='storyBody'>


<!-- vvvvvvvvvvvvvv contents of storyBody below this line  vvvvvvvv -->

<?php echo $stories[0]['Story']['body'] ?>

<!-- ^^^^^^^^^^^^^^ contents of storyBody above this line  ^^^^^^^^ -->


           </div><!--storyBody-->
	   <div class='storyActions'>
		<?php 
			echo $this->Html->link(__('View', true), array('action' => 'view', $stories[0]['Story']['id'])); 
			echo $this->Html->link(__('Edit', true), array('action' => 'edit', $stories[0]['Story']['id'])); 
			echo $this->Html->link(__('Delete', true), array('action' => 'delete', $stories[0]['Story']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $stories[0]['Story']['id']));
		 ?>
	   </div><!-- storyActions -->

        <div id='restOfStories'>
	<?php 
        $i = 0;
	for ($i = 1; $i<(count($stories)); $i++)
        {
        ?>
	   <div class='sideStory'>
           <div class='storyBody'>
<!-----------------------contents of storyBody below this line ------>
<?php echo $stories[$i]['Story']['body'] ?>
<!-----------------------contents of storyBody above this line ------>
           </div><!--storyBody-->
	   <div class='storyActions'>
		<?php 
			echo $this->Html->link(__('View', true), array('action' => 'view', $stories[$i]['Story']['id'])); 
			echo $this->Html->link(__('Edit', true), array('action' => 'edit', $stories[$i]['Story']['id'])); 
			echo $this->Html->link(__('Delete', true), array('action' => 'delete', $stories[$i]['Story']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $stories[$i]['Story']['id']));
		 ?>


           </div>
        <?php
        } // end of for loop for stories 1 through count($stories)-1 
	?>
        </div><!-- restOfStories -->

</div><!-- class: stories index -->