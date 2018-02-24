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
	<style>
		.bgdiv { background-image: url('../webroot/assets/login/login_background.jpg'); }
		.p-b-34 { padding-bottom: 10px !important; }
		.login100-form-title { font-size:25px; }
		.wrap-login100 { background:#0c0a10 !important; width:420px !important; padding: 18px 55px 37px 55px; }
		.p-t-27 { padding-top: 10px; }
		.error { color: #fff; margin-left: 25px; }
		
	</style>
</head>
<body>
	<div class="limiter">
		<div class="container-login100 bgdiv">
			<div class="wrap-login100">
					<center>
						<?=  $this->Html->image('/img/mini_logo.png', ['style'=>'width:20%;']) ?>
					</center>
					<span class="login100-form-title p-b-34 p-t-27">
						TRAVEL B2b HUB
					</span>			
				<?php  echo $this->Form->create("User", ['id'=>"UserRegisterForm",'class'=>'login100-form validate-form']); ?>
					<div class="text-center">
						<p style="color:#fff"> Forgot Password </p>
					</div> <br />
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="width: 100%;">
							Submit
						</button>
					</div>
					<br />
					<p style="color:#fff !important;"><?php echo $this->Flash->render(); ?></p>
				
					<div class="text-center p-t-90" style="padding-top: 20px;">
						<p style="color:#fff">Already have an account ?
							<a class="txt1" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'register')) ?>" style="color:#5ba7a4;">
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