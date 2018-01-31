  <?php echo $this->Html->script(['jquery.validate']);?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
	var cityData = '<?php echo $allCities; ?>';
	$(document).ready(function () {
		$("#city_name").autocomplete({
			source: JSON.parse(cityData),
			select: function (e, ui) {
				e.preventDefault();
				$("#city_id").val(ui.item.value);
				$(this).val(ui.item.label);
				$("#state_id").val(ui.item.state_id);
				$("#state_name").val(ui.item.state_name);

				$("#country_id").val(ui.item.country_id);
				$("#country_name").val(ui.item.country_name);
			
			}
		});

	});
</script>
  <div id="change_password" class="container-fluid">
    <div class="row equal_column">
      <?php echo $this->element('left_panel');?>
      <div class="right-panel col-lg-9 col-md-9 col-sm-9 col-xs-12 padding0">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 border_bottom">
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                     <h4 class="title">Change Password</h4>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                   <?php echo $this->element('top_link');?>  
              </div>
          </div>
	  <?= $this->Flash->render() ?>
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 right-panel change_password">
          <div class="col-lg-8 col-md-8 col-sm-8 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-12 change_password_column margin-t30 margin-b30">
            <p><!--<strong>This site is currently being refined to serve you better. You will be notified in the next few days, once the website is fully functional</strong>--></p>
            <div class="form">
                <?php  echo $this->Form->create("Users", ['id'=>"UserRegisterForm"]); ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt margin-b10">				
                    <div class="input-field">
                        <label for="from">Current Password
                            <span class="asterisk">
                                  <img src="/img/Asterisk.png" class="img-responsive">
                              </span>    
                        </label>
                        <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Enter Here" autocomplete="off"/>
                    </div>				
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt margin-b10">				
                    <div class="input-field">
                        <label for="from">New Password
                            <span class="asterisk">
                                  <img src="/b2b/img/Asterisk.png" class="img-responsive">
                              </span>    
                        </label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter Here" autocomplete="off"/>
                    </div>				
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt margin-b10">				
                    <div class="input-field">
                        <label for="from">Confirm New Password
                            <span class="asterisk">
                                  <img src="/b2b/img/Asterisk.png" class="img-responsive">
                              </span>    
                        </label>
                        <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Enter Here" autocomplete="off"/>
                    </div>				
                </div>

               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="margi1">
                    <input type="submit" name="submit" class="btn btn-primary btn-block " value="Change">
                  </div>
               </div>
            </form>
            </div>
          </div>
        </div>
     </div>
   </div>
</div>
   


<script>
$('#UserRegisterForm').validate({
	rules: {
		"old_password": {
			required: true
		},
		"password": {
			required: true
		},
		"cpassword": {
			required: true,
			equalTo: "#password"
		}
	},
	messages: {
		"old_password": {
			required: "Please enter current password."
		},
		"password": {
			required: "Please enter password."
		},
		"cpassword": {
			required: "Please enter confirm password.",
			equalTo: "Confirm password should be equal to password."
		}
	},
	ignore: ":hidden:not(select)"
});

</script>