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
		.error { color: #ff9898;  }
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
		<div class="container-login100 bgdiv ">
			<div class="wrap-login100 prakash">
					<center>
						<?=  $this->Html->image('/img/Travel B2B logo.png', ['style'=>'width:50%;']) ?>
						<div class="container-login100-form-btn" style="margin-top:15px">
							<?php echo  $this->Flash->render() ?>
						</div>
					</center>
						<br>	
				<?php  echo $this->Form->create("User", ['id'=>"UserRegisterForm",'class'=>'login100-form validate-form']); ?>
					<div class="text-center">
						<span style="color:#fff; font-size: 18px;"> Forgot Password </span>
					</div> <br />
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" maxlength="10" minlength="10"name="mobile_number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required id="pincode">
						<span class="focus-input100" data-placeholder="Mobile No"></span>
						<label id="pincode_error" style="padding-top: -33px;" class="error"></label>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="width: 100%;">
							Submit
						</button>
					</div>
					<br />
					 
				
					<div class="text-center p-t-90" style="padding-top: 20px;">
						<p style="color:#fff">Already have an account?
							<a class="txt1" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'login')) ?>" style="color:#a9d4fa;">
								Login
							</a>
						</p>
					</div>						
					<div class="text-center p-t-90" style="padding-top: 20px;">
						<p style="color:#fff">Don't  have an account?
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
$(document).ready(function(){	
	$('#pincode').keyup(function(){
		var pass=  $('#pincode').val();
		if(pass.length>9){
			$('#pincode_error').html('');
		}
		else{
			$('#pincode_error').html("Mobile no. must be at least ten digits long.");
			return false;
		}		
	});
	$('#pincode').blur(function(){
		var pass=  $('#pincode').val();
		if(pass.length>9){
			$('#pincode_error').html('');
		}
		else{
			$('#pincode_error').html("Mobile no. must be at least ten digits long.");
			$('#pincode').val('');
			return false;
		}		
	});
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