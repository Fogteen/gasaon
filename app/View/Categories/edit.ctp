<div class="categories form">
<?php echo $this->Form->create('Category'); ?>
	<fieldset>
		<legend><?php echo __('Edit Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('des');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Category.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Category.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Categories'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Ebooks'), array('controller' => 'ebooks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Book'), array('controller' => 'ebooks', 'action' => 'add')); ?> </li>
	</ul>
</div>
