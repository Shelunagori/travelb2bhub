<?php echo $this->Html->script(['modernizr-2.6.2.min', 'jquery.cookie-1.3.1','selectFx','jquery.validate']);?>
<body class="hold-transition login-page">
    <div class="container-fluid login_bg ">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">
                 <h1 class="text-center">Log In</h1>
            </div>
        </div>
    </div>
    
<div class="login-box container-fluid grey_bg padding-tb40">
    <div clas="row">
        <div class="col-lg-6 col-md-6 col-sm-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-12 padding0">
              <div class="login-box-body login_column">
                   <header class="login-header"><span class="text">LOGIN</span><span class="loader"></span></header>
                    <h4 class="login-box-msg">Log in to start your session</h4>
                    <?php echo $this->Flash->render(); ?>
                    <?php  echo $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login'],'id'=>"UserLoginForm"]); ?>
                      <div class="form-group has-feedback">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                      </div>
                      <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                      </div>
							<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
							<input type="hidden" name="redirect_page" value="<?php echo $redirect_page;?>"/>
                    </form>

                <!--    <div class="social-auth-links text-center">
                      <p>- OR -</p>
                      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                        Facebook</a>
                      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                        Google+</a>
                    </div>-->
                 <ul class="forget-register-pass"> 
                     <li class="col-xs-12 col-md-6"><a href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'forgotPassword')) ?>"> Forgot  Password</a></li>
                    <li class="col-xs-12 col-md-6"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'register')) ?>" class="text-center">Register as a new member</a>
                     </li>
                </ul>
               </div>
       </div>
    </div>
</div>
<script>
jQuery.validator.addMethod("email", function(value, element) {
value = value.trim();
return this.optional(element) || /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(value);
}, "Please enter a valid email.");
$('#UserLoginForm').validate({
	rules: {
		"email": {
			required : true,
			email: true
		},"password": {
			required: true
		}
	},
	messages: {
		"email": {
			required : "Please enter email.",
			email : "Please enter valid email."
		},"password": {
			required: "Please enter password."
		}
	}
});
</script>
