<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<style>
#Content{ width:90% !important; margin-left: 5%;}
input:focus {background-color:#FFF !important;}
input[type="password"]:focus {background-color:#FFF !important;}
div.error { display: block !important; } 
label { font-weight:100 !important;}
</style>

<section class="content">
<div class="col-md-12"></div>
      <div class="row">
        <div class="col-md-12">
         <div class="box box-primary">
			<div class="box-header with-border">
              <h3 class="box-title">Edit Profile</h3>
            </div>
			
			<?php  echo $this->Form->create("Users", ['type' => 'file','id'=>"UserRegisterForm"]); ?>
			<div class="box-body"> 
 				<div class="form-group col-md-6">
					<label>First Name</label>
					<input type="text" class="form-control" name="first_name" value="<?php echo $admins['first_name'] ?>" id="first_name" placeholder="First Name">
                </div>
				<div class="form-group col-md-6">
					<label>Last Name</label>
					<input type="text" class="form-control" name="last_name" value="<?php echo $admins['last_name'] ?>" id="last_name" placeholder="last Name">
                </div>
				<div class="form-group col-md-6">
					<label>Email</label>
					<input type="text" class="form-control" name="email" value="<?php echo $admins['email'] ?>" id="email" placeholder="E-Mail">
                </div>
				<div class="form-group col-md-6">
 					<?php echo $this->Form->input('Profile Picture', ['type' => 'file', 'class' => 'form-control', 'name' => 'profile_pic', "profile_pic"]); ?>
                </div>
				<div class="col-md-12">
					<hr></hr>
					<center>
						<button type="submit" class="btn btn-info">Update Profile</button>
					</center>	
				</div>	 			
             </form>
          </div>            
        </div>
       </div>
   </section> 
<?php echo $this->Html->script(['jquery.validate']);?>   
<script> 
$('#UserRegisterForm').validate({
	rules: {
		"last_name": {
			required: true
		},
		"first_name": {
			required: true
		},
		"email": {
			required: true,
		}
	},
	messages: {
		"first_name": {
			required: "Please enter your First Name."
		},
		"last_name": {
			required: "Please enter your Last Name."
		},
		"email": {
			required: "Please enter your E-Mail Address."
		}
	},
	ignore: ":hidden:not(select)",
	submitHandler: function (form) {
		$("#loader-1").show();
		form[0].submit(); 
	}
});

</script>  
