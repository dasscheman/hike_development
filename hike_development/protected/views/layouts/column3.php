<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-7">
	<div id="left-sidebar">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-10">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-9 last">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			/*'title'=>'<i class="fa fa-search-plus fa-inverse"></i>',*/
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