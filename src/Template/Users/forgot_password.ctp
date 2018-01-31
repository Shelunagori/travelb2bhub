<style>
    p.p-policy-content {
        line-height: 23px;
        text-align: justify;
    }
    h3.p-policy-head {
        margin-bottom: 50px;
    }

    .policy-details {
        margin-top: 25px;
    }

</style>
  <style>
  .ui-autocomplete {
    max-height: 300px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 300px;
  }
  </style>

 <?=$this->Html->css(['jquery.steps','multiselect','tooltip']); ?>
  <?php echo $this->Html->script(['modernizr-2.6.2.min', 'jquery.cookie-1.3.1','multiselect','jquery.steps','selectFx','jquery.validate']);?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div id="tra-contact">
      <div class="container-fluid login_bg ">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">
                 <h1 class="text-center">Forgot Password</h1>
            </div>
        </div>
    </div>
    <div class=" forgot-box container-fluid grey_bg padding-tb60">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-12">
                
           
                <?= $this->Flash->render() ?>

                <div class="content">                 
                   <?php  echo $this->Form->create("User", ['type' => 'file','id'=>"UserRegisterForm"]); ?>
                    <div id="wizard">
                         <div class="forgot-box-body forgot_column col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <header class="forgot-header">
                       <span class="text">FORGOT </span><span class="loader"></span>
                             </header>
                   <h4 class="forgot-box-msg">Forgot Password</h4>
                        <section class="registartion-wrap">
                            <div class="input-field margin-b20">
                                <label for="from">Email
                                     <span class="asterisk">
                                          <img src="/img/Asterisk.png" class="img-responsive">
                                      </span>    
                                </label>
                                <input type="email" name="email" class="form-control" id="email" />
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </section>

                        
                        <?php  echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
         </div>
      </div>
   </div>
 </div>


<script>
jQuery.validator.addMethod("email", function(value, element) {
value = value.trim();
return this.optional(element) || /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(value);
}, "Please enter a valid email.");
$('#UserRegisterForm').validate({
	rules: {
		"email": {
			required : true,
			email: true
		}
	},
	messages: {
		"email": {
			required : "Please enter email.",
			email : "Please enter valid email."
		}
	}
});
</script>