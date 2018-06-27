<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<style>
#Content{ width:90% !important; margin-left: 5%;}
input:focus {background-color:#FFF !important;}
input[type="password"]:focus {background-color:#FFF !important;}
div.error { display: block !important; } 
label { font-weight:100 !important;}
fieldset
{
	border-radius: 7px;
	box-shadow: 0 3px 9px rgba(0,0,02,0.25), 0 2px 5px rgba(0,0,0,0.22);
}
</style>

<section class="content">
<div class="col-md-12"></div>
      <div class="row">
        <div class="col-md-12">
         <div class="box box-primary">
			<div class="box-header with-border">
              <h3 class="box-title">Change Password</h3>
            </div>
			<div class="box-body">

	<div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab"><b>Admin Password</b></a></li>
              <li><a href="#tab_2" data-toggle="tab"><b>Users Password</b></a></li> 
             </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
			  <?php  echo $this->Form->create("Users", ['id'=>"UserRegisterForm"]); ?>
				<div class="col-md-offset-1 ">
					<div class="">
						<div class="form-group ">
						  <label>Current Password</label>
						  <input type="password" class="form-control" name="old_password" id="old_password" value=""  placeholder="Current Password">
						</div>
					</div>
					<div class="">
						<div class="form-group  ">
						  <label>New Password</label>
						  <input type="password" class="form-control"  autocomplete="off" name="password" id="password" value=""  placeholder="New Password">
						</div>
					</div>
					<div class="">
						 <div class="form-group  ">
						  <label>Confirm New Password</label>
						  <input type="password" class="form-control"  autocomplete="off"  name="cpassword" id="cpassword" value=""  placeholder="Confirm New Password">
						</div>				
					</div>
				  <div class="col-md-12">
					<hr></hr>
					<center>
						<button type="submit" name="own_password" class="btn btn-info">Update Password</button>
					</center>	
				  </div>
				</div>
			</form>
              </div>
              <div class="tab-pane" id="tab_2">
			  <?php  echo $this->Form->create("data", ['id'=>"UserRegisterForma"]); ?>
                <div class="col-md-offset-1 ">
					<div class="">
						<div class="form-group ">
						  <label>Select User</label>
						   
						   <?php $selectoption=array();
							foreach($Users as $state){
								$selectoption[] = ['value'=>$state->id,'text'=>$state->first_name.' '.$state->last_name.' ('.$state->email.')'];
							}						   
							echo $this->Form->input('userid',['options' =>$selectoption,'label' => false,'class'=>'form-control select2','empty'=> 'Select...']);?>
						   <label id="userid-error" style="display:none" class="error" for="userid">This field is required.</label>
						</div>
					</div>
					<div class="">
						<div class="form-group  ">
						  <label>New Password</label>
						  <input type="passworda" autocomplete="off" class="form-control" name="new" id="password1" value=""  placeholder="New Password">
						</div>
					</div> 
				  <div class="col-md-12">
					<hr></hr>
					<center>
						<button type="submit" name="other_password" class="btn btn-info">Update Password</button>
					</center>	
				  </div>
				</div>
				</form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END CUSTOM TABS -->








				 
			 	 			
            </div>
            
          </div>            
        </div>
       </div>
   </section>
<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
<div id="loader"></div>
</div>
 <?php echo $this->Html->script(['jquery.validate']);?>   
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
		},
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
		},
	},
	ignore: ":hidden:not(select)",
	submitHandler: function (form) {
		$("#loader-1").show();
		form[0].submit(); 
	}
	
});
</script>
<script>

$('#UserRegisterForma').validate({
	rules: {
		"userid": {
			required: true,
		},
		"new": {
			required: true,
		},
		"newagain": {
			required: true,
			equalTo: "#new"
		}
	},
	messages: {
		"old_password": {
			required: "Please enter current password."
		},
		"new": {
			required: "Please enter password."
		},
		"newagain": {
			required: "Please enter confirm password.",
			equalTo: "Confirm password should be equal to password."
		},
	},
	ignore: ":hidden:not(select)",
	submitHandler: function (form) {
		$("#loader-1").show();
		form[0].submit(); 
	}
	
});
</script>  
