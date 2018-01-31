<?php $currentUrl = explode("/",\Cake\Routing\Router::url()); ?>
<style>
	section#header ul.login_bar li .getapp_btn{
	background-color: #218496 !important;
    border-color: #7ab5c0;
    color: #fff;
    padding: 4px 4px;
    -webkit-transition: all .3s linear;
    -moz-transition: all .3s linear;
    -o-transition: all .3s linear;
    -ms-transition: all .2s linear;
    transition: all .2s linear;
	}
	section#header ul.login_bar li .getapp_btn:hover{
	color: #fff;
    background-color: #e37222 !important;
    border-color: transparent;
    -webkit-transform: scale(1.1);
    -moz-transform: scale(1.1);
    -ms-transform: scale(1.1);
    -o-transform: scale(1.1);
    transform: scale(1.1);
	}
</style>
  <section id="fullheader">
  <section id="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="login_bar pull-right">
					 <?php if($login_status=="") {  ?>
                    <li><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'login')) ?>" class="btn btn-default login_btn">Log In</a></li>
                    <li><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'register')) ?>" class="btn btn-default signup_btn">Sign Up</a></li>
                   <?php } else { ?>
                    
							
                    <li><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'logout')) ?>" class="btn btn-default signup_btn">Log Out</a></li>
                   <?php } ?>
<li><a href="https://goo.gl/xvejQQ" target="_blank" class="btn btn-default getapp_btn">Get App <i class="fa fa-android" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section id="menu">
    <nav class="navbar navbar-default">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed mobile_menu" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
             	<a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'home')) ?>" class="logo">
              <?php echo $this->Html->image('b2b-logo.png', array("class" => "img-responsive logo_b2b" )) ; ?>
                </a>
                  <?php if($currentUrl[1]=='users' && $this->request->session()->check('Auth.User.id')) { ?>
            <button type="button" class="navbar-toggle collapsed mobile_sidebar_btn" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <img src="/img/drawer-icon.png" alt="">
              </button>
                <?php } ?>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
					<?php if(!$this->request->session()->check('Auth.User.id')) { ?>
						<li><a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'home')) ?>">Home</a></li>
						<li><a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'memberships')) ?>">Membership</a></li>
					<?php } else { ?>
					<li><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'dashboard')) ?>" >My profile</a></li>
					<?php } ?>
					<?php if(!$this->request->session()->check('Auth.User.id') || $role_idsession == 3) { ?>
                <li><a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'promotions')) ?>">Promote your hotel </a></li>
               <?php } ?>
                <li><a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'aboutus')) ?>">About us</a></li>
               <li><a class="menu" href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'faq')) ?>">FAQs </a></li>
                <li><a class="menu" href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'contactus')) ?>">Contact us</a></li>

              </ul>

              </ul>
            </div><!-- /.navbar-collapse -->
        
          <?php if($currentUrl[1]=='users' && $this->request->session()->check('Auth.User.id')) { ?>
        <div class="navbar-collapse collapse mobile_sidebar" id="bs-example-navbar-collapse-2" aria-expanded="false" style="height: 1px;">
       
              <ul class="nav navbar-nav navbar-right hidden-lg hidden-md hidden-sm visible-xs">
              
              <?php if($this->request->session()->read('Auth.User.role_id') != 3){ ?>
				<li>
                   <div class="list-hotlier-req"><?php echo $this->Html->image('user-plus.png'); ?> <span><?php echo $this->Html->link(__('Finalized Requests'), ["controller"=>"Users", 'action' => 'finalizedRequestList'], ['escape' => false]) ?></span> </div>
                </li>
                <?php } ?>
		<?php if($this->request->session()->read('Auth.User.role_id') == 1) { ?>

                <li>
                   <div class="list-hotlier-req"><?php echo $this->Html->image('finalized-response.png'); ?><span><?php echo $this->Html->link(__('Finalized Responses'), ["controller"=>"Users", 'action' => 'myFinalResponses'], ['escape' => false]) ?></span> </div>
</li><li>
                   <div class="list-hotlier-req"><?php echo $this->Html->image('friend-ico.png'); ?> <span><?php echo $this->Html->link(__('Following'), ["controller"=>"Users", 'action' => 'businessBuddiesList'], ['escape' => false]) ?></span> </div>
                </li>
                 

                 
                  <?php } ?>
<?php if($this->request->session()->read('Auth.User.role_id') == 1 || $this->request->session()->read('Auth.User.role_id') == 2 ){ ?>
<li>
                    <div class="list-hotlier-req"><?php echo $this->Html->image('delete-icon.png'); ?><span><?php echo $this->Html->link(__('Removed Requests'), ["controller"=>"Users", 'action' => 'removedRequestList'], ['escape' => false]) ?></span> </div>
                </li>
 <?php } ?>
 <?php if($this->request->session()->read('Auth.User.role_id') == 3) { ?>
 <li>
                   <div class="list-hotlier-req"><?php echo $this->Html->image('finalized-response.png'); ?><span><?php echo $this->Html->link(__('Finalized Responses'), ["controller"=>"Users", 'action' => 'myFinalResponses'], ['escape' => false]) ?></span> </div>
</li>
                 <li>
                    <div class="list-hotlier-req"><span><?php echo $this->Html->link(__('Promotion Report'), ["controller"=>"Users", 'action' => 'promotionreports',$this->request->session()->read('Auth.User.id')], ['escape' => false]) ?></span> </div>
                </li>
              

                 <li>
                   <div class="list-hotlier-req"><?php echo $this->Html->image('friend-ico.png'); ?> <span><?php echo $this->Html->link(__('Following'), ["controller"=>"Users", 'action' => 'businessBuddiesList'], ['escape' => false]) ?></span> </div>
                </li>
 <?php } ?>
                 <li>
                    <div class="list-hotlier-req"><?php echo $this->Html->image('user-cross.png'); ?> <span><?php echo $this->Html->link(__('Blocked Users'), ["controller"=>"Users", 'action' => 'blockedUserList'], ['escape' => false]) ?></span> </div>
                </li>
 <li>
		<div class="list-hotlier-req  "> <span><?php echo $this->Html->link(__('Edit Profile'), ["controller"=>"Users", 'action' => 'profileedit'], ['escape' => false]) ?></span> </div> </li>
 <li>
              	<div class="list-hotlier-req "><span><?php echo $this->Html->link(__('Change Password'), ["controller"=>"Users", 'action' => 'changePassword'], ['escape' => false]) ?> </span></div>
              	 </li>
              </ul>

            </div>
            <?php } ?>
          </div><!-- /.container-fluid -->
        </nav>
</section>
</section>
<div class="fullpagecontent">
            