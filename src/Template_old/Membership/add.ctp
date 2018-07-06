 
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<?php if(!empty($id)){ ?>
					<i class="fa fa-pencil-square-o"></i> <b> Edit Membership </b>
				<?php }else{ ?>
					<i class="fa fa-plus"></i> <b> Add Membership </b>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">	
				<?= $this->Form->create($membership,['id'=>'CityForm']) ?>
					<div class="row col-md-6">
						<div class="col-md-12">
							<label class="control-label">Membership Name <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->input('membership_name',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Membership Name','style'=>'height:34px']);?>
						</div>
					</div>
					<div class="row col-md-6">
						<div class="col-md-12">
							<label class="control-label">Price <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->input('price',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Membership Price']);?>
						</div>
					</div>
					<div class="row col-md-6">
						<div class="col-md-12">
							<label class="control-label">Duration <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->input('duration',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Membership Duration','style'=>'height:34px']);?>
						</div>
					</div>
					<div class="row col-md-6">
						<div class="col-md-12">
							<label class="control-label">Status <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<div class="radio">
									<label>
										<input type="radio" <?php if($membership->status=='1' || empty($membership->status) ){ echo " checked"; } ?> name="status" value="1">Active
									</label>
									<label>
										<input type="radio" <?php if($membership->status=='0'){ echo " checked"; } ?> name="status" value="0">Deactive
									</label>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="row col-md-12">
						<textarea id="description" name="description" hidden=""> <?php echo $membership->description; ?></textarea>
						<div class="col-md-12">
							<label class="control-label">Description </label>
						</div>
						<div class="col-md-12">
							<textarea class="txtEditor"></textarea>
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