<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-17">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-9 last">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<i class="fa fa-20x fa-list-alt fa-inverse"> Menu opties</i>',
		));
		$this->widget('zii.widgets.CMenu',
			      array('encodeLabel'=>false,
				    'items'=>$this->menu,
				    'htmlOptions'=>array('class'=>'operations'),
		));		
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>