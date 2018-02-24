<!DOCTYPE html>
<html lang="en">
<head>
	<title>Travel B2B HUB</title>
	 <?php echo $this->Html->css('/assets/bootstrap/css/bootstrap.min.css'); ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
	<?php echo $this->Html->css('/assets/login/fonts/iconic/css/material-design-iconic-font.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/animate/animate.css'); ?>
	<?php echo $this->Html->css('/assets/login/css-hamburgers/hamburgers.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/animsition/css/animsition.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/select2/select2.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/daterangepicker/daterangepicker.css'); ?>
	<?php echo $this->Html->css('/assets/login/daterangepicker/daterangepicker.css'); ?>
	<?php echo $this->Html->css('/assets/login/css/util.css'); ?>
	<?php echo $this->Html->css('/assets/login/css/main.css'); ?>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('img/login_background.jpg');">
			<div class="wrap-login100" style="background:#0c0a10 !important; width:420px !important;">
				<form class="login100-form validate-form">
					<center>
						<?=  $this->Html->image('/img/mini_logo.png', ['style'=>'width:20%;']) ?>
					</center>
					<span class="login100-form-title p-b-34 p-t-27">
						TRAVEL B2b HUB
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Keep me singed in
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="width: 100%;">
							Login
						</button>
					</div>

					<div class="text-center p-t-90" style="padding-top: 20px;">
						<a class="txt1" href="#">
							Forgot your password?
						</a>
					</div>
					<div class="text-center p-t-90" style="padding-top: 20px;">
						<p>Don't  have an account ?
							<a class="txt1" href="#">
								Sign up
							</a>
						</p>
					</div>					
				</form>
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>

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