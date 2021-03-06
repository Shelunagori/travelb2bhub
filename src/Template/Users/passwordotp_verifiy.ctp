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
			<div class="wrap-login100 prakash">
					<center>
						<?=  $this->Html->image('/img/Travel B2B logo.png', ['style'=>'width:50%;']) ?>
						<div class="container-login100-form-btn" style="margin-top:15px">
							<?php echo  $this->Flash->render() ?>
						</div>
					</center> 
				<?php  echo $this->Form->create("User", ['id'=>"UserRegisterForm",'class'=>'login100-form validate-form']); ?>
					<div class="text-center">
						<p style="color:#fff"> OTP Verification </p>
					</div> <br />
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="mobile_otp" autofocus="on" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required maxlength="4">
						<span class="focus-input100" data-placeholder="Enter OTP"></span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="width: 100%;">
							Submit
						</button>
					</div>
					<br />
					 
					<div class="text-center p-t-90"  id="demo" style="padding-top: 20px;color:#fff;">
						<p style="color:#fff">Otp resend?
							<a class="txt1" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'otp_resend/'.$dummy_user_id.'?r=1')) ?>" style="color:#a9d4fa;">
								 Re-Send
							</a>
						</p>
					</div>
					<div class="text-center p-t-90" style="padding-top: 20px;">
						<p style="color:#fff">Already have an account?
							<a class="txt1" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'login')) ?>" style="color:#a9d4fa;">
								Login
							</a>
						</p>
					</div>						
					<div class="text-center p-t-90" style="padding-top: 20px;">
						<p style="color:#fff">Don't  have an account ?
							<a class="txt1" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'register')) ?>" style="color:#a9d4fa;">
								Sign up
							</a>
						</p>
					</div>					
				<?php echo $this->Form->end();?>
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php echo $this->Html->script('/assets/login/animsition/js/animsition.min.js'); ?>
<?php echo $this->Html->script('/assets/login/bootstrap/js/popper.js'); ?>
<?php echo $this->Html->script('/assets/login/bootstrap/js/bootstrap.min.js'); ?>

<?php echo $this->Html->script('/assets/plugins/select2/select2.full.min.js'); ?>
<?php echo $this->Html->script('/assets/login/daterangepicker/moment.min.js'); ?>
<?php echo $this->Html->script('/assets/login/daterangepicker/daterangepicker.js'); ?>
<?php echo $this->Html->script('/assets/login/countdowntime/countdowntime.js'); ?>
<?php echo $this->Html->script('/assets/login/js/main.js'); ?>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?> 
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
<script> 
	// Set the date we're counting down to
	var countDownDate = new Date();
	countDownDate.setMinutes(countDownDate.getMinutes() + 1);
	// Update the count down every 1 second
	var x = setInterval(function() {
		// Get todays date and time
		var now = new Date().getTime();
		
		// Find the distance between now an the count down date
		var distance = countDownDate - now;
		// Time calculations for days, hours, minutes and seconds
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		 
 		$('#demo').html("Please wait till "+seconds + "s ");
		 
		if (distance < 1) {
			clearInterval(x);
			$('#demo').html('<p style="color:#fff">Otp resend ?<a class="txt1" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'otp_resend/'.$dummy_user_id.'?r=1')) ?>" style="color:#a9d4fa;"> Re-Send</a></p>');
		}
	}, 1000); 
</script> 

</body>
</html>