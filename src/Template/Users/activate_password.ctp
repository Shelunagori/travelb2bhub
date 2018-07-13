<?php echo $this->Html->script(['modernizr-2.6.2.min', 'jquery.cookie-1.3.1','selectFx','jquery.validate']);?>
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
 
		.p-b-34 { padding-bottom: 10px !important; }
		.login100-form-title { font-size:25px; }
		.wrap-login100 { background:#1f222db8 !important; width:420px !important; padding: 18px 55px 37px 55px; }
		.p-t-27 { padding-top: 10px; }
		.error { color: #ff9898; }
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
		<div class="container-login100 bgdiv" style="background-image: url('../../webroot/assets/login/login_background.jpg');">
			<div class="wrap-login100">
					<center>
						<?=  $this->Html->image('/img/Travel B2B logo.png', ['style'=>'width:50%;']) ?>
					</center>
                    <?php  echo $this->Form->create("User", ['type' => 'file','id'=>"UserRegisterForm",'class'=>'login100-form validate-form']); ?> 
					<?php   if (!isset($ident)) { $ident=''; }
						if (!isset($activate)) { $activate=''; } ?>
					<?php echo $this->Form->hidden('ident', array('value'=>$ident)); ?>
					<?php echo $this->Form->hidden('activate', array('value'=>$activate)); ?>
						</br>					
					<center><span style="color:#fff; font-size: 18px;"> Reset Password </p>
					</span> </center>
					<p style="color:#fff !important;"><?php echo $this->Flash->render(); ?></p>
					<div class="wrap-input100 validate-input" data-validate = "password">
						<input class="input100" autocomplete="off" type="password" name="password" placeholder="New Password">
						<span class="focus-input100" data-placeholder=" "></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "cpassword">
						<input class="input100" autocomplete="off" type="password" name="cpassword" placeholder="Confirm New Password">
						<span class="focus-input100" data-placeholder=" "></span>
					</div>					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="width: 100%;">
							Submit
						</button>
					</div>
					<br />
					
				
					<div class="text-center p-t-90" style="padding-top: 20px;">
						<p style="color:#fff">Already have an account ?
							<a class="txt1" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'login')) ?>" style="color:#5ba7a4;">
								Login
							</a>
						</p>
					</div>						
					<div class="text-center p-t-90" style="padding-top: 20px;">
						<p style="color:#fff">Don't  have an account ?
							<a class="txt1" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'register')) ?>" style="color:#5ba7a4;">
								Sign up
							</a>
						</p>
					</div>					
				<?php echo $this->Form->end();?>
			</div>
		</div>
	</div>
 <?php echo $this->Html->script('/assets/login/jquery/jquery-3.2.1.min.js'); ?>
<?php echo $this->Html->script('/assets/login/animsition/js/animsition.min.js'); ?>
<?php echo $this->Html->script('/assets/login/bootstrap/js/popper.js'); ?>
<?php echo $this->Html->script('/assets/login/bootstrap/js/bootstrap.min.js'); ?>
<?php echo $this->Html->script('/assets/login/select2/select2.min.js'); ?>
<?php echo $this->Html->script('/assets/login/daterangepicker/moment.min.js'); ?>
<?php echo $this->Html->script('/assets/login/daterangepicker/daterangepicker.js'); ?>
<?php echo $this->Html->script('/assets/login/countdowntime/countdowntime.js'); ?>
<?php echo $this->Html->script('/assets/login/js/main.js'); ?>
<script>
$('#UserRegisterForm').validate({
	rules: {
		"password": {
			required: true
		},
		"cpassword": {
			required: true,
			equalTo: "#password"
		}
	},
	messages: {
		"password": {
			required: "Please enter password."
		},
		"cpassword": {
			required: "Please enter confirm password.",
			equalTo: "Confirm password should be equal to password."
		}
		}
	});
</script>
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
</body>
</html>