<!DOCTYPE html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<title>TB2B</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta content="" name="description">
<meta content="" name="author"> 
	<?php echo $this->Html->css('/assets/bootstrap/css/bootstrap.min.css'); ?>
	
	<?php echo $this->Html->css('/assets/plugins/bootstrap-datepicker/css/datepicker3.css'); ?> 
	<?php echo $this->Html->css('/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css'); ?> 
	<?php echo $this->Html->css('/assets/plugins/timepicker/bootstrap-timepicker.min.css'); ?> 
	<?php echo $this->Html->css('/assets/plugins/jquery-validation/demo/css/screen.css'); ?> 
	<?php echo $this->Html->css('/assets/plugins/iCheck/all.css'); ?> 
	<?php echo $this->Html->css('/assets/font-awesome/css/font-awesome.min.css'); ?> 
	<?php echo $this->Html->css('/assets/ionicons/css/ionicons.min.css'); ?> 
	<?php echo $this->Html->css('/assets/plugins/select2/select2.min.css'); ?>
	<?php echo $this->Html->css('/assets/plugins/bootstrap-editable/css/bootstrap-editable.css'); ?>
	<?php echo $this->Html->css('/assets/dist/css/AdminLTE.min.css'); ?>
	<?php echo $this->Html->css('/assets/dist/css/skins/_all-skins.min.css'); ?>
<?php //echo $this->Html->css('/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>
<?php echo $this->Html->css('/assets/plugins/WYSIWYG/editor.css'); ?>
	<?php
	echo $this->Html->meta(
    'favicon.ico',
    '/images/shortcut_icon/favicon.ico',
    ['type' => 'icon']
);
?>

<style>
#grad1 {
    height: 50px;
    background:  #DA0845; /* For browsers that do not support gradients */    
    background: -webkit-linear-gradient(left,  #DA0845 , #DB7E14); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(right,  #DA0845, #DB7E14); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(right,  #DA0845, #DB7E14); /* For Firefox 3.6 to 15 */
    background: linear-gradient(to right,  #DA0845 , #DB7E14); /* Standard syntax (must be last) */
}

.box.box-primary {
    border-top-color: #66cad5 !important;
}

sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a {
    color: #fff;
    background: #66cad5e3;
    border-left-color: #DA3E2E;
}
.required {
	color:#ea3733;
}

body{
	font-family: 'Montserrat';
	color: #606062;

}

</style>
<style>

body{
font-family: 'Montserrat';
font-size:14px;
}
.self-table > tbody > tr > td, .self-table > tr > td
{
border-top:none !important;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    vertical-align:middle !important;
}
label{
	vertical-align: text-top;
}
div.radio div.radio-div:not(:first-child) {
    margin-left: 5px !important;
}
.checkbox, .radio {
margin-bottom: 5px !important;
margin-top: 5px !important;
}

 @media print {
	    .hide_print{
		   display:none;
	   }
   }

</style>
</head>

<body class="hold-transition skin-blue fixed sidebar-mini">
<?php $this->Form->templates([
				'inputContainer' => '{{content}}'
			]); 
		?>
<div id="wrapper">
<header class="main-header no-print" >
   <a href="/ucci/Users/index" class="logo" style="background-color:#DA0845">
   <span class="logo-lg">
   <?=  $this->Html->image('/packages/serverfireteam/panel/img/logo.png', ['style'=>'width:49%;margin-top: -2%;']) ?></span></a>
    <nav class="navbar navbar-static-top"  id="grad1">
    <a href="#" class="hidden-lg hidden-md hidden-sm sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				  <span> <i class="fa fa-setting"></i> Setting</span>
				</a>
				<ul class="dropdown-menu">
					<li>
					  <?php echo $this->Html->link('Edit Profile',['controller' => 'Users', 'action' => 'editprofile', '_full' => true,'class'=>'btn btn-default btn-flat']); ?>
					</li>
					<li>
					  <?php echo $this->Html->link('Change Password',['controller' => 'Users', 'action' => 'changepassword', '_full' => true,'class'=>'btn btn-default btn-flat']); ?>
					</li>
					<li>
					  <?php echo $this->Html->link('Logout',['controller' => 'Users', 'action' => 'logout', '_full' => true,'class'=>'btn btn-default btn-flat']); ?>
					</li>
					
				</ul>
			</li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar no-print">
  <section class="sidebar" >
    
	  
		<ul class="sidebar-menu">
			<?php /*
			 $class_selected='';
			$user_right1="";
			$user_right1 = $this->requestAction(['controller'=>'Users', 'action'=>'UserRights'],['pass'=>array()]);
			
			$user_right=explode(',', $user_right1);
			
			$fetch_menu = $this->requestAction(['controller'=>'Users', 'action'=>'menu'],['pass'=>array()]);
		    $main_menu_arr[]='';
			$page_name=$this->request->params['action'];
             foreach($fetch_menu as $data)
			 {
				if(in_array($data->id, $user_right))
				{
					if(empty($data->main_menu) && empty($data->sub_menu))
					{
						if($page_name==$data['page_name_url'])
						{
							$class_selected='selected';
						}
							
						?>
						<li class="<?php if($page_name==$data['page_name_url']){ echo 'active'; } ?>">
						<?php echo $this->Html->link('<i class="'.$data['icon_class_name'].'"></i>&nbsp;&nbsp;<span class="title">'.$data['name'].'</span><span class="'.$class_selected.'"></span>',array('controller' => $data['controller'], 'action' => $data['page_name_url'], '_full' => true),['escape'=>false]); ?>
						
						</li>
				<?php $class_selected=''; }else{
					if(!in_array($data['main_menu'], $main_menu_arr)){
						$main_menu_arr[]=$data['main_menu'];
						$fetch_menu_submenu = $this->requestAction(['controller'=>'Users', 'action'=>'MenuSubmenu'],['pass'=>array($data['main_menu'])]);		
							foreach($fetch_menu_submenu as $data_value1)
							{ 	
								if($data_value1['page_name_url'] == $page_name)
								{
									$class_active='active';
									$arrow_open='open';
									$class_selected='selected';
								}
							}
						?>
						<li class="treeview<?php  echo @$class_active; ?> ">
								<?php echo $this->Html->link('<i class="'.$data['main_menu_icon'].'"></i>&nbsp;&nbsp;<span class="title">'.$data['main_menu'].'</span><span class="'.$class_selected.'"></span><span class="pull-right-container">
								  <i class="fa fa-angle-left pull-right"></i>
								</span>',array('action' => '#'),['escape'=>false]); ?>
								
								<ul class="treeview-menu">
								<?php
								$class_active='';
								$arrow_open='';
								$class_selected='';
						
						foreach($fetch_menu_submenu as $data_value)
						{
							if(!empty($data_value['sub_menu']))
							{ 
								$fetch_submenu = $this->requestAction(['controller'=>'Users', 'action'=>'submenu'],['pass'=>array($data_value['sub_menu'])]);	
								
								if(!in_array($data_value['sub_menu'], $main_menu_arr))
								{
									$main_menu_arr[]=$data_value['sub_menu'];
										$main_menu_arr_my[]=$data_value['sub_menu'];
										foreach($fetch_submenu as $data_value1)
										{
											if($data_value1['page_name_url'] == $page_name)
											{
												$class_active='active';
												$arrow_open='open';
												$class_selected='selected';
											}
											 
										}
										$x=0;
								foreach($fetch_submenu as $data_submenu)
								{$x++;
										if(in_array($data_submenu['id'], $user_right) && $x==1)
										{  
										?>
										<li class="treeview <?php  echo @$class_active; ?>">
										<?php echo $this->Html->link('<i class="'.$data_value['sub_menu_icon'].'"></i><span class="title">'.$data_value['sub_menu'].'</span><span class="'.$class_selected.'"></span><span class="pull-right-container">
										  <i class="fa fa-angle-left pull-right"></i>
										</span>',array('action' => '#'),['escape'=>false]); ?>
										<ul  class="treeview-menu">
										<?php
										foreach($fetch_submenu as $data_submenu)
										{
											if((in_array($data_submenu['id'], $user_right))&& (!in_array($data_submenu['name'], $main_menu_arr)))
											{
												$main_menu_arr[]=$data_submenu['name'];
											 ?>
											<li class="<?php if($page_name==$data_submenu['page_name_url']){ echo ' active'; } ?>">
											<?php echo $this->Html->link('<i class="'.$data_submenu['icon_class_name'].'"></i><span class="title">'.$data_submenu['name'].'</span>',array('controller' => $data_submenu['controller'], 'action' => $data_submenu['page_name_url'], '_full' => true),['escape'=>false]); ?>
												
											</li>
											<?php
											}
										}
										$class_active='';
										$arrow_open='';
										$class_selected='';
										?>
										</ul>
									</li>
							<?php
						 }}} }else
							{
										if((in_array($data_value['id'], $user_right)) && (!in_array($data_value['name'], $main_menu_arr)))
										{
											$main_menu_arr[]=$data_value['name'];
										 ?>
												<li class="<?php if($page_name==$data_value['page_name_url']){ echo ' active'; } ?>">
												<?php echo $this->Html->link('<i class="'.$data_value['icon_class_name'].'"></i><span class="title">'.$data_value['name'].'</span>',array('controller' => $data_value['controller'], 'action' => $data_value['page_name_url'], '_full' => true),['escape'=>false]); ?>
												</li>
												<?php
						}}} ?>
				</ul>	
							</li>
							<?php
							$class_active='';
							$arrow_open='';
							$class_selected='';
		}}}}	*/ ?>
		<li><a href="#">DashBoard</a></li>		
		<li><a href="<?php echo $this->Url->build(["controller" => "Cities", "action" => "add"]); ?>">City-Master</a></li>		
		<li><a href="<?php echo $this->Url->build(["controller" => "States", "action" => "add"]); ?>">State-Master</a></li>		
		<li><a href="<?php echo $this->Url->build(["controller" => "Countries", "action" => "add"]); ?>">Country-Master</a></li>		
		</ul>
		</section>
	
		</aside>

  
<div class="content-wrapper">
	 <section class="content">
		<div class="row">
		<?= $this->Flash->render() ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	 </section>
</div>
</div>
<footer class="main-footer hide_print">
    2016 &copy; <a href="http://www.phppoets.com" target="_blank"> PHP POETS IT SOLUTION PRIVATE LTD.</a> All Rights Reserved.
</footer>


<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php echo $this->Html->script('/assets/bootstrap/js/bootstrap.min.js'); ?>

<?php echo $this->Html->script('/assets/plugins/jquery-validation/lib/jquery.js'); ?>
<?php echo $this->Html->script('/assets/plugins/jquery-validation/dist/jquery.validate.js'); ?>

<?php echo $this->Html->script('/assets/plugins/slimScroll/jquery.slimscroll.min.js'); ?>
<?php echo $this->Html->script('/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>
<?php echo $this->Html->script('/assets/plugins/bootstrap-daterangepicker/daterangepicker.js'); ?>
<?php echo $this->Html->script('/assets/plugins/timepicker/bootstrap-timepicker.min.js'); ?>
 
<?php echo $this->Html->script('/assets/plugins/select2/select2.full.min.js'); ?>
<?php echo $this->Html->script('/assets/plugins/bootstrap-editable/js/bootstrap-editable.min.js'); ?>
<?php echo $this->Html->script('/assets/plugins/iCheck/icheck.min.js'); ?>


<?php echo $this->Html->script('/assets/plugins/fastclick/fastclick.js'); ?>
<?php echo $this->Html->script('/assets/dist/js/app.min.js'); ?>
<?php echo $this->Html->script('/assets/dist/js/demo.js'); ?>
<?php //echo $this->Html->script('/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>
<?php echo $this->Html->script('/assets/plugins/WYSIWYG/editor.js'); ?>
<script>
 
$('.select2').select2();
$('.date-picker').datepicker({
      autoclose: true
    });
 
<!--$(".wysihtml5textarea").wysihtml5({useLineBreaks: true,tabSpaces: 4});-->
$(".txtEditor").Editor({
'source':true,
'togglescreen':false,
'rm_format':false,
'insert_img':false,
});

$(".timepicker").timepicker({
          showInputs: false
});

</script>

</body>
</html>