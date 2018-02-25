 <?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
 <?php echo $this->Html->script(['jquery.validate']);?>
 <style>
	#Content{ width:90% !important; margin-left: 5%;}
	input:focus {background-color:#FFF !important;}
	input[type="password"]:focus {background-color:#FFF !important;}
</style>

<section class="content">
      <div class="row">
        <div class="col-md-12">
         <div class="box box-primary">
			<div class="box-header with-border">
              <h3 class="box-title">Change Password</h3>
            </div>
			<?= $this->Flash->render() ?>
			<?php  echo $this->Form->create("Users", ['id'=>"UserRegisterForm"]); ?>
			
              <div class="box-body">
				<div class="col-md-offset-3 col-md-6">
			  <fieldset>
				<div class="col-md-12">
					<div class="form-group col-md-12">
					  <label>Current Password</label>
					  <input type="password" class="form-control" name="old_password" id="old_password" value=""  placeholder="Current Password">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group col-md-12">
					  <label>New Password</label>
					  <input type="password" class="form-control" name="password" id="password" value=""  placeholder="New Password">
					</div>
				</div>
				<div class="col-md-12">
					 <div class="form-group col-md-12">
					  <label>Confirm New Password</label>
					  <input type="password" class="form-control" name="cpassword" id="cpassword" value=""  placeholder="Confirm New Password">
					</div>				
				</div>
              <div class="">
				<center>
					<button type="submit" class="btn btn-primary">Change</button>
				</center>	
              </div>				
			</fieldset>				
				</div>
				
            </div>

            </form>
          </div>
            
        </div>
         
      </div>
      <!-- /.row -->
    </section>

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
