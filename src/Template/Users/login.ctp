<!DOCTYPE html>
<html lang="en">
<head>
	<title>Travel B2B HUB</title>
	 <?php echo $this->Html->css('/assets/bootstrap/css/bootstrap.min.css'); ?> 	
	<?php echo $this->Html->css('/assets/login/fonts/iconic/css/material-design-iconic-font.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/animate/animate.css'); ?>
	<?php echo $this->Html->css('/assets/login/css-hamburgers/hamburgers.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/animsition/css/animsition.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/select2/select2.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/daterangepicker/daterangepicker.css'); ?>
	<?php echo $this->Html->css('/assets/login/daterangepicker/daterangepicker.css'); ?>
	<?php echo $this->Html->css('/assets/login/css/util.css'); ?>
	<?php echo $this->Html->css('/assets/login/css/main.css'); ?>
	<?php echo $this->Html->css('https://fonts.googleapis.com/css?family=Raleway'); ?>
	<style>
		.bgdiv { background-image: url('../webroot/assets/login/login_background.jpg'); }
		.p-b-34 { padding-bottom: 10px !important; }
		.login100-form-title { font-size:25px; }
		.wrap-login100 { background:#1f222db8 !important; width:420px !important; padding: 18px 55px 37px 55px; }
		.p-t-27 { padding-top: 10px; }
		.error { color: #ff9898; text-align:center; }
		.alert-warning{ color:#FFF !important;}
		.alert-danger{ width:95% !important;}
		 
		@media only screen and (max-device-width: 480px) {
			div.prakash {
				zoom: 2;
			}
			.input100 {
				font-size: 20px !important;
			}
		}
	</style>
</head>
<body>
	<div class="limiter">
		<div class="container-login100 bgdiv">
			<div class="wrap-login100 main_div prakash">
					<center>
						<?=  $this->Html->image('/img/Travel B2B logo.png', ['style'=>'width:50%;']) ?>
					</center> 
					<div class="container-login100-form-btn" style="margin-top:15px">
						<?php echo  $this->Flash->render() ?>
					</div>
				 
                <?php  echo $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login'],'id'=>"UserLoginForm", 'class'=>'login100-form validate-form']); ?>
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" autocomplete="new-password" name="email" >
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" autocomplete="new-password" name="password" >
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Keep me signed in
						</label>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="width: 100%;">
							Login
						</button>
						<input type="hidden" name="redirect_page" value="<?php echo $redirect_page;?>"/>
					</div>

					<div class="text-center p-t-90" style="padding-top: 20px;"> 
 						<p style="color:#fff">Forgot password?
							<a class="txt1" style="color:#a9d4fa;" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'forgotPassword')) ?>">
							 Click Here
						</a>
						</p>
					</div>
					<div class="text-center p-t-90" style="padding-top: 20px;">
						<p style="color:#fff">Don't  have an account?
							<a class="txt1"  style="color:#a9d4fa;" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'register')) ?>" style="color:#5ba7a4;">
								Sign up
							</a>
						</p>
					</div>					
				<?php echo $this->Form->end();?>
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>
<script type="text/javascript">

	setInterval(function(){ abc(); }, 2000);
		function abc()
		{ 	
			$('#msg_div').fadeOut(300);
			var delay = 300;
			setTimeout(function() {
				$('#msg_div').remove();
			}, delay);
		} 
		
</script> 
<?php echo $this->Html->script('/assets/login/jquery/jquery-3.2.1.min.js'); ?>
<?php echo $this->Html->script('/assets/login/animsition/js/animsition.min.js'); ?>
<?php echo $this->Html->script('/assets/login/bootstrap/js/popper.js'); ?>
<?php echo $this->Html->script('/assets/login/bootstrap/js/bootstrap.min.js'); ?>
<?php echo $this->Html->script('/assets/login/select2/select2.min.js'); ?>
<?php echo $this->Html->script('/assets/login/daterangepicker/moment.min.js'); ?>
<?php echo $this->Html->script('/assets/login/daterangepicker/daterangepicker.js'); ?>
<?php echo $this->Html->script('/assets/login/countdowntime/countdowntime.js'); ?>
<?php echo $this->Html->script('/assets/login/js/main.js'); ?>
</body>
</html>