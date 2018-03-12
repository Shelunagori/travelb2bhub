<!DOCTYPE html>
<html>
<head>
  <?php  echo $this->Html->css('/assets/bootstrap/css/bootstrap.min.css'); ?>
	
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
	<?php echo $this->Html->css('https://fonts.googleapis.com/css?family=Raleway'); ?>
 	<?php echo $this->Html->css('//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'); ?> 
	<?php
	echo $this->Html->meta(
    'favicon.ico',
    '/images/shortcut_icon/favicon.ico',
    ['type' => 'icon']
);
?>
<style>
	#country-list{list-style:none;margin-left: 1px;padding:0;width:94%; margin-top: 10px;    position: absolute;
    z-index: 1000;
    background-color: #fff;}
	#country-list li{padding-left: 10px;padding-top: 7px; background: #d8d4d41a ; border: 1px solid #bbb9b9;;top:2px}
	#country-list li:hover{background:#d8d4d4;cursor: pointer;}
	.column_column ul li, .column_helper ul li, .column_visual ul li, .icon_box ul li, .mfn-acc ul li, .ui-tabs-panel ul li, .post-excerpt ul li, .the_content_wrapper ul li{margin-bottom:0px !important}
	#search-box{border: #e2e2e2 1px solid;border-radius:4px;}
	#Content{ width:90% !important; margin-left: 5%;}
  </style>
<style>

.btn-primary.focus, .btn-primary:focus
{
	color:ins
}
body {
	font-family: 'Raleway', sans-serif !important;
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
	margin: 0px;
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
<!--- Star style ---->
<style>
	div.stars {
	  width: 270px;
	  display: inline-block;
	}
	 
	input.star { display: none; }
	 
	label.star {
	  float: right;
	  padding: 10px;
	  font-size: 20px;
	  color: #444;
	  transition: all .2s;
	}
	 input.star:checked ~ label.star:before {
	  content: '\f005';
	  color: #FD4;
	  transition: all .25s;

	}


	input.star-5:checked ~ label.star:before {

	  color: #FE7;

	  text-shadow: 0 0 20px #952;

	}

	input.star-1:checked ~ label.star:before { color: #F62; }
	label.star:hover { transform: rotate(-15deg) scale(1.3); }
	label.star:before {
	  content: '\f006';
	  font-family: FontAwesome;
	}
	.user-panel
	{
		background: #057F8A !important;
		height: 169px;
	}
</style>
<style>
 
.requestType {	
	color: #f87200;
    font-weight: 600;
}
.hotel{
	
}
.package{
	 
}
.contain>p{
	color:#96989A !important;
} 
.details {color:#000 !important; font-weight: 600;}	
.btn-block { width:40% !important;}
.margin {margin-top:5px;}
.shotrs a {margin:5px;;}
.modal-body {padding:0px!important;}
</style>
</head>
<title>Travel B2B Hub</title>
<body class="hold-transition skin-blue sidebar-mini">
<?php 
$page_name=$this->request->params['action'];  
?>
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
            <a href="#" class="dropdown-toggle chat_clear" data-toggle="dropdown">
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
			  <li><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'logout')) ?>" class="btn btn-default signup_btn">Log Out</a></li>
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
			
			if(!empty($profile_pic)){
				//echo $this->Html->image('user_docs/'.$loginId.'/'.$profile_pic, ["class"=>"img-responsive","alt"=>"Profile Pic"]);
				if(file_exists($this->Html->image('user_docs/'.$loginId.'/'.$profile_pic)))
				{
					echo $this->Html->image('user_docs/'.$loginId.'/'.$profile_pic, ["class"=>"img-responsive","alt"=>"Profile Pic"]);
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
		  <a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'profileedit/'.$loginId]); ?>" class="logo">Edit Profile</a> | &nbsp;
		  <a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'change_password']); ?>" class="logo">Reset Password</a>
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
        </li> -->
		
		<li <?php if($page_name=='dashboard'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'dashboard']); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
		<?php
		if($roleId == 1 || $roleId == 2)
		{?>
			<li <?php if($page_name=='sendrequest'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'sendrequest']); ?>"><i class="fa fa-book"></i> <span>Place Request</span></a></li>
			
			<li <?php if($page_name=='requestlist'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'requestlist']); ?>"><i class="fa fa-suitcase"></i> <span>My Request</span></a></li>
		<?php } 
		if($roleId == 1 || $roleId == 3)
		{?>
			<li <?php if($page_name=='respondtorequest'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'respondtorequest']); ?>"><i class="fa fa-book"></i> <span>Respond To Request</span></a></li>
			
			<li <?php if($page_name=='myresponselist'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'myresponselist']); ?>"><i class="fa fa-suitcase"></i> <span>My Responses</span></a></li>
		<?php } ?>
		
		<?php if($roleId==1 || $roleId==2 ) {?>
			<li <?php if($page_name=='finalizedRequestList'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'finalizedRequestList']); ?>"><i class="fa fa-edit"></i> <span>Finalized Requests</span></a></li>
		<?php
		}
		if($roleId==1 || $roleId==3) {
		?>
			<li <?php if($page_name=='myFinalResponses'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'myFinalResponses']); ?>"><i class="fa fa-book"></i> <span>Finalized Responses</span></a></li>
		<?php
		}
		if($roleId==1 || $roleId==3) {
		?>
			<li <?php if($page_name=='businessBuddiesList'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'businessBuddiesList']); ?>"><i class="fa fa-user"></i> <span>Following</span></a></li>
		<?php
		}
		if($roleId==1 || $roleId==2) {
		?>
			<li <?php if($page_name=='removedRequestList'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'removedRequestList']); ?>"><i class="fa fa-trash"></i> <span>Removed Requests</span></a></li>
		<?php
		}
		if($roleId == 3)
		{ ?>
			 
			<li <?php if($page_name=='promotionreports'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'promotionreports',$this->request->session()->read('Auth.User.id')]); ?>"><i class="fa fa-trash"></i> <span>Promotion Report</span></a></li> 
			 
			
		<?php }			
		?>
		<li <?php if($page_name=='blockedUserList'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'blockedUserList']); ?>"><i class="fa fa-group"></i> <span>Blocked Users</span></a></li>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Promotions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li>
			<?php //if($page_name=='add'){ echo 'class="active"';}?><a href="<?php echo $this->Url->build(["controller" => "TaxiFleetPromotions",'action'=>'add']); ?>"><i class="fa fa-book"></i> <span> Taxi Fleet</span></a></li>
			 <li>
			<?php //if($page_name=='add'){ echo 'class="active"';}?><a href="<?php echo $this->Url->build(["controller" => "PostTravlePackages",'action'=>'add']); ?>"><i class="fa fa-book"></i> <span>Post Travel</span></a></li>
			 <li>
			<?php //if($page_name=='add'){ echo 'class="active"';}?><a href="<?php echo $this->Url->build(["controller" => "EventPlannerPromotions",'action'=>'add']); ?>"><i class="fa fa-book"></i> <span> Event Planner</span></a></li>
			<li>
			<?php //if($page_name=='add'){ echo 'class="active"';}?><a href="<?php echo $this->Url->build(["controller" => "HotelPromotions",'action'=>'add']); ?>"><i class="fa fa-book"></i> <span>Hotel Promotions</span></a></li>
          </ul>
        </li>
		
		
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
<script>
$(document).ready(function (){
	$(".chat_clear").on('click',function () {  
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'clearreadChats')) ?>";
		$.ajax({
			url:url,
			type: 'POST',
			data: {clearchat:'1'}
		}).done(function(result){
			if(result == 1) { 
				$(".chat_count").html('0');
			}
		});
	});
});
</script>
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
