<div class="stories form">
<?php echo $javascript->link('fckeditor'); ?>
<?php echo $this->Form->create('Story');?>
	<fieldset>
 		<legend><?php printf(__('Add %s', true), __('Story', true)); ?></legend>
	<?php
		echo $javascript->link('ckeditor/ckeditor', NULL, false);
		echo $this->Form->input('title');

		echo $this->Form->input('body',array('cols'=>60,'rows'=>'10'));
		echo $fck->load('Story.body');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Stories', true)), array('action' => 'index'));?></li>
	</ul>
</div>