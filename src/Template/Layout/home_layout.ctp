<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <link rel="shortcut icon" href="/packages/serverfireteam/panel/favicon.ico">
    <link rel="icon" href="/packages/serverfireteam/panel/favicon.ico" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="PHP" >
	<title>TB2B</title>
		<?php echo $this->Html->css('/packages/zofe/rapyd/assets/demo/style.css'); ?> 
		<?php echo $this->Html->css('/packages/zofe/rapyd/assets/datepicker/datepicker3.css'); ?>
		<?php echo $this->Html->css('/packages/zofe/rapyd/assets/autocomplete/autocomplete.css'); ?>
		<?php echo $this->Html->css('/packages/zofe/rapyd/assets/autocomplete/bootstrap-tagsinput.css'); ?>
		<?php echo $this->Html->css('/packages/zofe/rapyd/assets/colorpicker/css/bootstrap-colorpicker.min.css'); ?>
		<?php echo $this->Html->css('/packages/serverfireteam/panel/css/styles.css'); ?>
		<?php echo $this->Html->css('/packages/serverfireteam/panel/font-icon/icomoon/style.css'); ?>
		<?php echo $this->Html->script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'); ?> 
		<?php echo $this->Html->script('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'); ?> 
		<?php echo $this->Html->script('http://fonts.googleapis.com/css?family=Abel');?> 
		  
		<?php echo $this->Html->script('/packages/serverfireteam/panel/js/jquery-1.11.0.js'); ?></script>
		<?php echo $this->Html->css('/packages/zofe/rapyd/assets/select2/select2.css'); ?>
		<?php echo $this->Html->script('/packages/zofe/rapyd/assets/select2/select2.js'); ?></script>
	</head>
	<body class="login Panel">

			<?php echo $this->fetch('content'); ?>
			
		<?php echo $this->Html->script('/packages/serverfireteam/panel/js/bootstrap.min.js'); ?>
		<?php echo $this->Html->script('/packages/serverfireteam/panel/js/sb-admin-2.js'); ?>  
		<?php echo $this->Html->script('/packages/zofe/rapyd/assets/datepicker/bootstrap-datepicker.js'); ?>
		<?php echo $this->Html->script('/packages/zofe/rapyd/assets/datepicker/locales/bootstrap-datepicker.it.js'); ?>
		<?php echo $this->Html->script('/packages/zofe/rapyd/assets/autocomplete/typeahead.bundle.min.js'); ?>
		<?php echo $this->Html->script('/packages/zofe/rapyd/assets/template/handlebars.js'); ?> 
		<?php echo $this->Html->script('/packages/zofe/rapyd/assets/autocomplete/bootstrap-tagsinput.min.js');?>
		<?php echo $this->Html->script('/packages/zofe/rapyd/assets/colorpicker/js/bootstrap-colorpicker.min.js');?>
		<?php echo $this->Html->script('/packages/zofe/rapyd/assets/select2/custom.js'); ?> 
	</body>

	<style>
		.Responses .pull-right a{
			display: none;
		}
		.Requests .pull-right a{
			display: none;
		}
	</style>
</html>
