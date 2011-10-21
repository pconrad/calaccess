<div class="stories form">
<?php echo $javascript->link('fckeditor'); ?>
<?php echo $this->Form->create('Story');?>
        <fieldset>
                <legend><?php printf(__('Edit %s', true), __('Story', true)); ?></legend>

        <?php
                echo $javascript->link('ckeditor/ckeditor', NULL, false);
                echo $this->Form->input('id');
                echo $this->Form->input('title');

                echo $this->Form->input('body',array('cols'=>'60','rows'=>'10'));
                echo $fck->load('Story.body');
        ?>

	<form enctype="multipart/form-data" action="uploader.php" method="STORY">
	<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
	Choose a file to upload: <input name="uploadedfile" type="file" /><br />
	<input type="submit" value="Upload File" />
	</form>

        </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
        <h3><?php __('Actions'); ?></h3>
        <ul>

                <li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Story.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Story.id'))); ?></li>
                <li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Stories', true)), array('action' => 'index'));?></li>
        </ul>
</div>

