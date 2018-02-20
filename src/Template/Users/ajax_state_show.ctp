<div class="form-group col-md-4">
	  <label>States</label>
	  <?php echo $this->Form->input('state_id',['label' => false,'class'=>'form-control select2','options'=>$states]);?>
</div>

<div class="form-group col-md-4">
	  <label>Country</label>
	  <?php echo $this->Form->input('country_id',['label' => false,'class'=>'form-control select2','options'=>$countries]);?>
</div>