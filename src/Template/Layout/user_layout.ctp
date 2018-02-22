<!DOCTYPE html>
<html>
<head>
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
	<?php echo $this->Html->css('/assets/demo-styles.css'); ?>
	<?php echo $this->Html->css('https://fonts.googleapis.com/css?family=Poppins'); ?> 	
	<?php
	echo $this->Html->meta(
    'favicon.ico',
    '/images/shortcut_icon/favicon.ico',
    ['type' => 'icon']
);
?>

<style>
body {
	font-family: 'Poppins', sans-serif !important;
}
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
 
fieldset {
	padding: 10px ;
	border: 1px solid #bfb7b7f7;
	margin: 12px;
}
legend{
	margin-left: 20px;	
	 color:#144277; 
	//color:#144277c9; 
	font-size: 17px;
	margin-bottom: 0px;
	border:none;
}
span.select2 {
	width :100% !important;
}
.menu {
	overflow-x:scroll !important;
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
.nav navbar-nav li {color:#848688 !important;}
.skin-blue sidebar-mini.user-panel {
	height: 160px !important;
	
}
.user-panel img
{
	border-radius: 100%;
	height:80px; 
	border: 1px solid #1295A2;
}
.sidebar-collapse .user-panel img
{
	height:35px !important; 
	border-radius: 100%;
	border: 1px solid #1295A2 !important;
} 
.notify {
  white-space: unset !important;
}
.slimScrollDiv
{
	height: 339px !important;	
}
.menu
{
	height: 339px !important;	
}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'dashboard']); ?>" class="logo">
      <span class="logo-mini"><?=  $this->Html->image('/img/mini_logo.png', ['style'=>'width:77%;']) ?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?=  $this->Html->image('/img/main_logo.png', ['style'=>'width:94%;']) ?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php echo $countchat = count($allunreadchat); ?></span>
            </a>
            <ul class="dropdown-menu">
			<li>
			
                <ul class="menu">
				<?php use Cake\Datasource\ConnectionManager; 
					$conn = ConnectionManager::get('default');
					$lastword=  substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1);
					if($countchat > 0) {
						foreach($allunreadchat as $allchat) {
							if($allchat['notification']==1) { 
								if(strpos($allchat['message'],"accepted")){
									$req_id = $allchat['request_id'];
									$sql = "SELECT re.id,rs.id as responseid FROM requests as re inner join `responses` as rs on rs.request_id=re.id 
									where re.id='".$req_id."' and re.status=2";
									$stmt = $conn->execute($sql);
									$results = $stmt ->fetch('assoc');
									$res_userid = 	$allchat['user_id'].'-'.$req_id;
									?>
									<li>
										<a class="notify" href="#">
										  <i class="fa fa-book"></i> <?php echo $allchat['message']; ?>
										</a>
									</li>
									<!--
									<li>
										<a data-target="#myModal1review<?php echo $allchat['id']; ?>" 
									href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'addtestimonial',  $res_userid)) ?>" data-toggle="modal" class="chat_notification chat_message" ><?php echo $allchat['message']; ?></a>
									</li>
									
									<div class="modal fade" id="myModal1review<?php echo $allchat['id']; ?>" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Review</h4>
												</div>
												<div class="modal-body"></div>
											</div>
										</div>
									</div> ---->                        
								<?php 
								}
								else
								{ ?>
									<li>
										<a class="notify" href="#">
										  <i class="fa fa-book"></i> <?php echo $allchat['message']; ?>
										</a>
									</li>
								 <?php 
								} 
							}
							else 
							{ ?>
								<li>
									<?php
									if($allchat['screen_id']==1)
									{
										$c=2;
										$res_text = "Please go to MY RESPONSES to view it.";
									}
									elseif($allchat['screen_id']==2)
									{
										$c=1;
										$res_text = "Please go to CHECK RESPONSES to view it.";
									}
									else{
										$c=0;
										$res_text = "";
									}
									?>
									 
									<a class="notify" href="#">
									<?php 
									$userid = $allchat['user_id'];
									$sql = "SELECT first_name,last_name FROM users	where id='".$userid."'";
									$stmt = $conn->execute($sql);
									$result = $stmt ->fetch('assoc');   
									$name = $result['first_name'].' '.$result['last_name'];?>
									  <i class="fa fa-book"></i> <?php echo "You have received a CHAT MESSAGE from: <span class='rec_name'>$name</span>. $res_text";  ?>
									</a>
									 
									<!--<a data-toggle="modal" class="chat_message" data-target="#myModal<?php echo $allchat['request_id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'userChat', $allchat['request_id'], $allchat["user_id"],$c)) ?>">
									<?php 
									$userid = $allchat['user_id'];
									$sql = "SELECT first_name,last_name FROM users	where id='".$userid."'";
									$stmt = $conn->execute($sql);
									$result = $stmt ->fetch('assoc');   
									$name = $result['first_name'].' '.$result['last_name'];

									echo "You have received a CHAT MESSAGE from: <span class='rec_name'>$name</span>. $res_text"; ?></a>-->
								</li>
								<!--<div class="modal fade" id="myModal<?php echo $allchat['request_id']; ?>" role="dialog">
									<div class="modal-dialog">
									 
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Chat</h4>
											</div>
											<div class="modal-body"></div>
										</div>
									</div>
								</div>-->
								<?php  
							} 
						}
					} 
					else { 
					?>
					<li>
                    <a class="notify" href="#">
                      <i class="fa fa-warning text-yellow"></i> No Notification
                    </a>
                  </li>
				<?php } ?>
              
                  
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!--<img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
              <span class="hidden-xs"><?php echo ucwords(strtolower($MemberName));?></span>
            </a>
            <ul class="dropdown-menu">
              
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
           
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" align="center">
        <div class='imaage'>
          <?php
			if(!empty($profilePic)){
				if(file_exists($this->Html->image('user_docs/'.$loginId.'/'.$profilePic)))
				{
					echo $this->Html->image('user_docs/'.$loginId.'/'.$profilePic, ["class"=>"img-responsive","alt"=>"Profile Pic"]);
				}
				else{
					echo $this->Html->image('no-profile-image.jpg', ["class"=>"img-responsive","alt"=>"Profile Pic"]);
				}
			}
			else
			{
				echo $this->Html->image('no-profile-image.jpg', ["class"=>"img-responsive","alt"=>"Profile Pic"]);
			}
		  ?>
        </div>
        <div class="info">
          <?php echo ucwords(strtolower($MemberName));?>
		  <br>
		  <a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'profileedit']); ?>" class="logo">Edit Profile</a> | &nbsp;
		  <a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'dashboard']); ?>" class="logo">Change Password</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
       <!-- <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li>-->
		<li class="active"><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'dashboard']); ?>"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
		
		<li><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'finalizedRequestList']); ?>"><i class="fa fa-edit"></i> <span>FINALIZED REQUESTS</span></a></li>
		
		<li class=""><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'myFinalResponses']); ?>"><i class="fa fa-book"></i> <span>FINALIZED RESPONSES</span></a></li>
		
		<li class=""><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'businessBuddiesList']); ?>"><i class="fa fa-user"></i> <span>FOLLOWING</span></a></li>
		
		<li class=""><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'removedRequestList']); ?>"><i class="fa fa-trash"></i> <span>REMOVED REQUESTS</span></a></li>
		
		<li class=""><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'blockedUserList']); ?>"><i class="fa fa-group"></i> <span>BLOCKED USERS</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	 <section class="content">
		<div class="row">
		<?= $this->Flash->render() ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	 </section>
</div>
   
  <div class="control-sidebar-bg"></div>
</div>
</div>

<footer class="main-footer hide_print">
    2016 &copy; <a href="http://www.phppoets.com" target="_blank"> PHP POETS IT SOLUTION PRIVATE LTD.</a> All Rights Reserved.
</footer>
`
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