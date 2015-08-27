<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php Yii::app()->bootstrap->register();
	  Yii::app()->getClientScript()->registerCssFile(yii::app()->request->baseUrl.'/css/fontawesome/css/font-awesome.min.css');
      //Yii::app()->getClientScript()->registerCssFile(yii::app()->request->baseUrl.'/css/fontawesome/css/font-awesome.css');
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<!--stylesheet voor font awesome-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fontawesome/css/font-awesome.min.css" />
	  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fontawesome/css/fontawesomeaangepast.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="container" id="page">

	<div id="header">

		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width=100% height=100% background="./images/header.jpg" valign="centre">
				<font><div id="logo"><b><?php echo CHtml::encode(Yii::app()->name); ?></b></div></font></td>
			</tr>
		</table>
	</div><!-- header -->
	<div id="mainmenu">

		<?php $this->widget('zii.widgets.CMenu',
				    array('encodeLabel'=>false,
					  'items' => array(
						array('label'=>'<span class="fa-stack fa-lg" title="Home">
								  <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
								  <i class="fa fa-home fa-stack-1x"></i>
							        </span>',
						      'url'=>array('/site/index')),
						array('label'=>'<span class="fa-stack fa-lg" title="Hike Overzicht">
								  <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
								  <i class="fa fa-compass fa-stack-1x"></i>
							        </span>',
						      'url'=>array('/game/index')),
						array('label'=>'<span class="fa-stack fa-lg" title="Grafiek">
								  <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
								  <i class="fa fa-bar-chart-o fa-stack-1x"></i>
							        </span>',
						      'url'=>array('/chart/index')),
						array('label'=>'<span class="fa-stack fa-lg" title="Hike uitzetten">
								  <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
								  <i class="fa fa-tachometer fa-stack-1x"></i>
							        </span>',
						      'url'=>array('/startup/index')),
						//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
						array('label'=>'<span class="fa-stack fa-lg" title="Contact">
								  <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
								  <i class="fa fa-envelope-o fa-stack-1x"></i>
							        </span>',
						      'url'=>array('/site/contact')),
//						array('label'=>'<span class="fa-stack fa-lg">
//								  <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
//								  <i class="fa fa-unlock-alt fa-stack-1x"></i>
//							       </span>',
//						      'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
//						array('label'=>'<span class="fa-stack fa-lg">
//								  <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
//								  <i class="fa fa-child fa-stack-1x"></i>
//								  <i class="fa fa-stack-60p fa-03x fa-blue">'.Yii::app()->user->name.'</i>
//							       </span>',
//						      'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
						),
						)
				);
		?>

	</div><!-- mainmenu -->
	<div id="breadcrumbs">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
	<?php endif?>
	</div><!-- breadcrumbs -->
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by www.biologenkantoor.nl.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-66849540-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
