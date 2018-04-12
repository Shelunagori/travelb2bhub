<!DOCTYPE html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<title>TB2B</title    line-height: 60px;
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta content="" name="description">
<meta content="" name="author">
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
	<?php echo $this->Html->css('/assets/plugins/WYSIWYG/editor.css'); ?>
	<?php echo $this->Html->css('/assets/demo-styles.css'); ?>
	<?php echo $this->Html->css('/assets/loader-1.css'); ?>
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
.slimScrollDiv{
	overflow: inherit !important;
}
.box.box-primary {
    border-top-color: #66cad5 !important;
}
sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a {
    color: #fff;
    background: #FB6542;
    border-left-color: #DA3E2E;
}
.required {
	color:#ea3733;
}
 
 textarea {
	resize: none !important;
}
fieldset {
	padding: 10px ;
	border: 1px solid #bfb7b7f7;
	margin: 0px;
}
legend{
	margin-left: 20px;
	 //color:black; 
	//color:#144277c9;
	font-size: 17px;
	margin-bottom: 0px;
	border:none;
	
}
span.select2 {
	width :100% !important;
} 
h1,h2,h3,h4,h5,h6{
	font-family: 'Raleway', sans-serif !important;
}
</style>
<style>
 
.self-table > tbody > tr > td, .self-table > tr > td
{
border-top:none !important;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    vertical-align:middle !important;
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
	width:100% !important;
} 
.notify {
  white-space: unset !important;
}
.slimScrollDiv
{
	height: 330px !important;	
}
.menu
{
	height: 330px !important;	
}
p {
	margin:0px !important;
}
.select2-container--default .select2-search--inline .select2-search__field
{
	width:100% !important;
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
	  padding: 0 5px;
	  font-size: 31px;
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
	}

	.btn-info
	{
		background-color:#1295A2 !important;
		color:#FFF;
		border-color:#1295A2 !important;
	}
	.btn-danger
	{
		background-color:#FB6542 !important;
		color:#FFF;
		border-color:#FB6542 !important;
	}
	.btn-warning
	{
		background-color:#606062 !important;
		color:#FFF;
		border-color:#606062 !important;
	}
	.btn-success
	{
		background-color:#6FB98F !important;
		color:#FFF;
		border-color:#6FB98F !important;
	}
	.btn-successto
	{
		background-color:#C9A66B !important;
		color:#FFF;
		border-color:#C9A66B !important;
		
	}
	.btn-successto:hover 
	{ 
		color: white;
	}
	.btn-successtoNew
	{
		background-color:#66A5AD !important;
		color:#FFF;
		border-color:#66A5AD !important;
	}
	.btn
	{
		border-radius: 6px;
	}
	textarea {
		resize:none !important;
	}
	 
</style>
<style>
 
.hotelType {	
	color: #0095A1;
    font-weight: 600;
}
.transportType {	
	color: #D7A82F;
    font-weight: 600;
}
.packageType {	
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
.breakline{
	margin-bottom:0px !important;
	margin-top:0px !important;
}

@media all and (max-width: 520px) {
	/* Logo for Mobile */
	.logo-lg {
		width: 220px;
		height: 60px;
		background-image: url(‘http://wordpress.coastalrepro.com/wp-content/uploads/2013/06/coastalcreative-logo-mobile.png’);
		background-size: 250px 47px;
	}
}
@media all and (min-width: 520px) {
	/* Logo for Mobile */
	.logo-lg {
		width: 210px;
		height: 60px;
		background-image: url(‘http://wordpress.coastalrepro.com/wp-content/uploads/2013/06/coastalcreative-logo-mobile.png’);
		background-size: 250px 47px;
	}
}
</style>
</head>

<!--<body class="hold-transition skin-blue fixed sidebar-mini">-->

<body class="hold-transition skin-blue fixed sidebar-mini">
<?php $this->Form->templates([
		'inputContainer' => '{{content}}'
	]); 
?>
<?php 
	$page_name=$this->request->params['action']; 
	$controller=$this->request->params['controller']; 
?>
<div id="wrapper">
	<header class="main-header  no-print">
    <!-- Logo background: #1295a2; -->
    <a style="line-height: 60px;" href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'dashboard']); ?>" class="logo" >
      <span class="logo-mini" style="font-size:0px !important;"><?=  $this->Html->image('/img/mini_logo.png', ['style'=>'width:77%;']) ?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="font-size:0px !important;"><?=  $this->Html->image('/img/main_logo.png', ['style'=>'width:92%;','class'=>'image-responsive']) ?></span>
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
              <span class="label label-warning"><?php echo $chatCount; ?></span>
            </a>
            <ul class="dropdown-menu">
			<li>
                 <ul class="menu" style="height:500px !important;">
				<?php use Cake\Datasource\ConnectionManager; 
					$conn = ConnectionManager::get('default');
					$lastword=  substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1);
					if($chatCount > 0) {
						 
						foreach($NewNotifications as $allchat) {
							$first_name=$allchat->user->first_name;
							$last_name=$allchat->user->last_name;
							$request_id = $allchat['request_id'];
							$send_to_user_id = $allchat['send_to_user_id'];
							$message = $allchat['message'];
							$is_read = $allchat['is_read'];
							$created = $allchat['created'];
							$type = $allchat['type']; 
							$userid = $allchat['user_id'];
							$url='#';
							$org_date=date('d-m-Y h:i:A', strtotime($created));
							$new_date=str_replace(" "," at ",$org_date);
							
							if($type=='Request'){ 
								$url=$this->Url->build(array('controller'=>'users','action'=>'respondtorequest')); 
								$title="New Request Received!";
								$clr="#9975B9";
							}
							
							if($type=='Final Response'){ 
								$url=$this->Url->build(array('controller'=>'users','action'=>'myFinalResponses'));
								$title="Finalized Responses!";
								$clr="#68A225";
							}
							
							if($type=='Detail Share'){ 
								$url=$this->Url->build(array('controller'=>'users','action'=>'myresponselist')); 
								$title="Received Contact Details!";
								$clr="#AA3939";
							}
							
							if($type=='Response'){ 
								$url=$this->Url->build(array('controller'=>'users','action'=>'checkresponses/'.$request_id)); 
								$title="Check Responses";
								$clr="#C9A668";
							}
							if($type=='Chat'){
								$title="Chat";
								$clr="#1295a2";
							}
							if($type=='Announcement'){
								$title="Announcement";
								$clr="#FB6542";
							}
 							
							?>
								<li>
  									<a class="notify" href="<?php echo $url; ?>">
										<div>
										<div style="margin-top:2px;float:right;font-size:10px;">
										<?php echo $new_date; ?></div><br>
											<div>
												<font color="<?php echo $clr; ?>">
													<?php echo $title; ?>
												</font>
											</div>
										<font color="#848688">Sender's Name:</font> <?php echo $first_name.' '.$last_name; echo "<br>"; ?> <font color="#848688">Message:</font> <?php echo $message;  ?>
										</div>
									</a>
 								</li>
 								<?php  
							   
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
             </ul>
          </li>
           
          <li class="dropdown user user-menu">
            <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'logout')) ?>" ><i class="fa fa-power-off "> Log Out </i>  
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
           
        </ul>
      </div>
    </nav>
  </header>
	<aside class="main-sidebar no-print" >
	<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar"> 
      <!-- Sidebar user panel -->
      <div class="user-panel" align="center" style="margin-top:10px" >
        <div class='imaage' >
          <?php
			
			if(!empty($profile_pic)){
				 
				if(file_exists('img/user_docs/'.$loginId.'/'.$profile_pic)>0)
				{
					echo $this->Html->image('user_docs/'.$loginId.'/'.$profile_pic, ["class"=>"img-responsive","alt"=>"Profile Pic",'style'=>"width: 45%;"]);
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
		  </br>
		  <?php if($roleId==1){echo "Travel Agent";}?>
		  <?php if($roleId==2){ echo "Event Planner";}?>
		  <?php if($roleId==3){ echo "Hotelier";}?>
		  <br>
		  <a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'viewprofile/'.$loginId]); ?>" class="logo">My Profile</a> | &nbsp;
		  <a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'change_password']); ?>" class="logo">Reset Password</a>
        </div>
    </div>
    <ul class="sidebar-menu" >
 		
		<li <?php if($page_name=='dashboard'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'dashboard']); ?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
		<hr class="breakline"></hr>
		<?php
		if($roleId == 1 || $roleId == 2)
		{?>
			<li <?php if($page_name=='sendrequest'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'sendrequest']); ?>"><i class="fa fa-paper-plane"></i> <span>Place Request</span></a></li>
			
			<li <?php if($page_name=='requestlist'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'requestlist']); ?>"><i class="fa fa-envelope"></i> <span>My Requests</span></a></li>
		<?php } 
		if($roleId == 1 || $roleId == 3)
		{?>
			<li <?php if($page_name=='respondtorequest'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'respondtorequest']); ?>"><i class="fa fa-mail-reply"></i> <span>Respond To Requests</span></a></li>
			
			<li <?php if($page_name=='myresponselist'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'myresponselist']); ?>"><i class="fa  fa-briefcase"></i> <span>My Responses</span></a></li>
		<?php } ?>
		<hr class="breakline"></hr>
		<?php if($roleId==1 || $roleId==2 ) {?>
			<li <?php if($page_name=='finalizedRequestList'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'finalizedRequestList']); ?>"><i class="fa fa-suitcase"></i> <span>Finalized Requests</span></a></li>
		<?php
		}
		if($roleId==1 || $roleId==3) {
		?>
			<li <?php if($page_name=='myFinalResponses'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'myFinalResponses']); ?>"><i class="fa fa-book"></i> <span>Finalized Responses</span></a></li>
		<?php
		}
		if($roleId==1 || $roleId==2) {
		?>
			<li <?php if($page_name=='removedRequestList'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'removedRequestList']); ?>"><i class="fa fa-trash"></i> <span>Removed Requests</span></a></li>
		<?php
		}?>
		<hr class="breakline"></hr>
		<?php
		if($roleId==1 || $roleId==3 || $roleId==2) {
		?>
			<li <?php if($page_name=='businessBuddiesList'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'businessBuddiesList']); ?>"><i class="fa fa-users"></i> <span>Following</span></a></li>
		<?php
		}
		?>
		
		<li <?php if($page_name=='blockedUserList'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'blockedUserList']); ?>"><i class="fa fa-users"></i> <span>Blocked Users</span></a></li>
		<hr class="breakline"></hr>
		<?php if($roleId==1) { ?>
		<li <?php if($page_name=='add' && $controller=='PostTravlePackages'){ echo 'class="active"';}?>>
			<a href="<?php echo $this->Url->build(["controller" => "PostTravlePackages",'action'=>'add']); ?>"><i class="fa fa-bullhorn"></i> <span>Package Promotions</span></a>
		</li>
		<?php } ?>
		<?php if($roleId==1) { ?>
		<li <?php if($page_name=='add' && $controller=='TaxiFleetPromotions'){ echo 'class="active"';}?>>
			<a href="<?php echo $this->Url->build(["controller" => "TaxiFleetPromotions",'action'=>'add']); ?>"><i class="fa fa-bullhorn"></i> <span>Taxi/Fleet Promotions</span></a>
		</li>
		<?php } ?>
		
		<?php if($roleId==2) {?>
		<li <?php if($page_name=='add' && $controller=='EventPlannerPromotions'){ echo 'class="active"';}?>>
			<a href="<?php echo $this->Url->build(["controller" => "EventPlannerPromotions",'action'=>'add']); ?>"><i class="fa fa-bullhorn"></i> <span> Promote Event Planner</span></a>
		</li>
		
		<li <?php if($page_name=='promotionreports' && $controller=='EventPlannerPromotions'){ echo 'class="active"';}?>>
			<a href="<?php echo $this->Url->build(["controller" => "EventPlannerPromotions",'action'=>'promotionreports']); ?>"><i class="fa fa-book"></i> <span>Promotion Reports</span></a>
		</li>
		<?php } 
		if($roleId==3) { ?>
			<li <?php if($page_name=='add' && $controller=='HotelPromotions'){ echo 'class="active"';}?>><a href="<?php echo $this->Url->build(["controller" => "HotelPromotions",'action'=>'add']); ?>"><i class="fa fa-bullhorn"></i> <span> Promote Your Hotel</span></a></li>
			
			<li <?php if($page_name=='promotionreports' && $controller=='HotelPromotions'){ echo 'class="active"';}?>>
			
				<a href="<?php echo $this->Url->build(["controller" => "HotelPromotions",'action'=>'promotionreports']); ?>"><i class="fa fa-book"></i> <span>Promotion Reports</span></a>
			</li>
		<?php } ?>
		<?php if($roleId==1) { ?>
			<hr class="breakline"></hr>
			<li <?php if($page_name=='promotionreports' && $controller=='PostTravlePackages'){ echo 'class="active"';}?>>
			
				<a href="<?php echo $this->Url->build(["controller" => "PostTravlePackages",'action'=>'promotionreports']); ?>"><i class="fa fa-book"></i> <span>Package Reports</span></a>
			</li>
			<li <?php if($page_name=='promotionreports' && $controller=='TaxiFleetPromotions'){ echo 'class="active"';}?>>
				<a href="<?php echo $this->Url->build(["controller" => "TaxiFleetPromotions",'action'=>'promotionreports']); ?>"><i class="fa fa-book"></i> <span>Taxi/Fleet Reports</span></a>
			</li>
		<?php }
		$WEBURL='';
		if($roleId==1){$WEBURL='travel-agent';}
		if($roleId==2){$WEBURL='event-planner';}
		if($roleId==3){$WEBURL='hotelier';}
		?>
			<hr class="breakline"></hr>
			<li><a target="_blank" href="http://ecotourismrajasthan.com/travelb2bhub/contact/"><i class="fa fa-phone"></i> <span>Contact Us</span></a></li>
			<li><a target="_blank"  href="http://ecotourismrajasthan.com/travelb2bhub/terms-and-conditions/"><i class="fa fa-edit"></i> <span>Terms & Conditions</span></a></li>
			<li><a target="_blank"  href="http://ecotourismrajasthan.com/travelb2bhub/privacy-policy/"><i class="fa fa-lock"></i> <span>Privacy Policy</span></a></li>
			<li><a target="_blank"  href="http://ecotourismrajasthan.com/travelb2bhub/<?php echo $WEBURL; ?>"><i class="fa fa-question-circle"></i> <span>FAQs</span></a></li>
			
	 
      </ul>
    </section>
    <!-- /.sidebar -->
	
	</aside>

  
	<div class="content-wrapper">
		 <section class="content">
			<div class="row">
				<?php echo $this->Flash->render(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		 </section>
	</div>
</div>
<footer class="main-footer hide_print">
    2016 &copy; <a href="http://www.phppoets.com" target="_blank"> PHP POETS IT SOLUTION PRIVATE LTD.</a> All Rights Reserved.
</footer>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function (){
	/*$(".chat_clear").on('click',function () {  
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
	});*/
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
<?php echo $this->Html->script('/assets/dist/js/app.js'); ?>
<?php echo $this->Html->script('/assets/dist/js/demo.js'); ?> 
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