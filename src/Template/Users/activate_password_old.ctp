<?php echo $this->Html->script(['modernizr-2.6.2.min', 'jquery.cookie-1.3.1','selectFx','jquery.validate']);?>
<body class="hold-transition login-page">
    <div class="container-fluid login_bg ">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">
                 <h1 class="text-center">Reset Password</h1>
            </div>
        </div>
    </div>
    
<div class="login-box container-fluid grey_bg padding-tb40">
    <div clas="row">
        <div class="col-lg-6 col-md-6 col-sm-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-12 padding0">
              <div class="login-box-body login_column">
                   <header class="login-header"><span class="text"> </span><span class="loader"></span></header>
                   
                    <?= $this->Flash->render() ?>
                    <?php  echo $this->Form->create("User", ['type' => 'file','id'=>"UserRegisterForm"]); ?> 
					<?php   if (!isset($ident)) { $ident=''; }
						if (!isset($activate)) { $activate=''; } ?>
					<?php echo $this->Form->hidden('ident', array('value'=>$ident)); ?>
					<?php echo $this->Form->hidden('activate', array('value'=>$activate)); ?>
                      <div class="form-group has-feedback">
                       <input type="password" name="password" class="form-control" id="password" placeholder="New Password"/>
                      </div>
                      <div class="form-group has-feedback">
                      <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Confirm New Password"/>
                      </div>	<input type="submit" class="btn btn-primary btn-block btn-flat " style="width:40%" value="Submit"> 
							
							
                    </form>

                
                 
               </div>
       </div>
    </div>
</div>

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