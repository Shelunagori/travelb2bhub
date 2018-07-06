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