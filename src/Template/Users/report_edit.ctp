<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<i class="fa fa-pencil-square-o"></i> <b> Edit User </b>
			</div>
			<div class="box-body">
				<div class="form-group">	
				<?= $this->Form->create($users,['id'=>'CityForm']) ?>
					<div class="row col-md-6">
						<div class="col-md-12">
							<label class="control-label">Category <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->input('role_id',[
							'label' => false,'class'=>'form-control select2','options'=>$category,'style'=>'height:34px', 'empty'=>'----Select--Please----']);?>
						</div>
					</div>
					<div class="row col-md-6">
						<div class="col-md-12">
							<label class="control-label">Company <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->input('company_name',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Company Name']);?>
						</div>
					</div>
					<div class="row col-md-6">
						<div class="col-md-12">
							<label class="control-label">First Name <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->input('first_name',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Membership Duration','style'=>'height:34px']);?>
						</div>
					</div>
					<div class="row col-md-6">
						<div class="col-md-12">
							<label class="control-label">Last Name <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->input('last_name',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Membership Duration','style'=>'height:34px']);?>
						</div>
					</div>
					
					
					<div class="row col-md-6">
						<div class="col-md-12">
							<label class="control-label">Mobile No. <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->input('mobile_number',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Membership Duration','style'=>'height:34px']);?>
						</div>
					</div>
					
					<div class="row col-md-6">
						<div class="col-md-12">
							<label class="control-label">Email Id <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->input('email',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Membership Duration','style'=>'height:34px']);?>
						</div>
					</div>
					 
					 <div class="row col-md-6">
						<div class="col-md-12">
							<label class="control-label">Address <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->input('address',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Membership Duration']);?>
						</div>
					</div>
					
					<div class="row col-md-6">
						<div class="col-md-12">
							<label class="control-label">City <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->input('city_id',[
							'label' => false,'class'=>'form-control select2','options'=>$cities,'style'=>'height:34px']);?>
						</div>
					</div>
					
					<div class="row col-md-6">
						<div class="col-md-12">
							<label class="control-label">States <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->input('state_id',[
							'label' => false,'class'=>'form-control select2','options'=>$states,'style'=>'height:34px']);?>
						</div>
					</div>
					
					<div class="row col-md-6">
						<div class="col-md-12">
							<label class="control-label">Country <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->input('country_id',[
							'label' => false,'class'=>'form-control select2','options'=>$countries,'style'=>'height:34px']);?>
						</div>
					</div>
					
					<div class="box-footer">
						<div class="row">
							<center>
							
								<div class="col-md-12">
								<hr></hr>
									<div class="col-md-offset-3 col-md-6">	
										<?php echo $this->Form->button('Submit',['class'=>'btn btn-primary','id'=>'submit_member']); ?>
									</div>
								</div>
							</center>		
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?= $this->Form->end() ?>
</div>
</section>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function() {
	$('.Editor-editor').html($('#description').text());
	$("button:submit").click(function(){  
 		$('#description').text($('.txtEditor').Editor("getText"));
	});
	
	// validate signup form on keyup and submit
	 $("#CityForm").validate({ 
		rules: {
			membership_name: {
				required: true
			},
			price: {
				required: true
			},
			duration: {
				required: true
			}
		},
		submitHandler: function () {
			$("#submit_member").attr('disabled','disabled');
			form.submit();
		}
	}); 

});
</script>