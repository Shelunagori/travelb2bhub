
<?php if($noofrows==1) {?>
<div class="form-group col-md-6">
	  <label>Destination States</label>
	  <?php echo $this->Form->input('h_state_id',['label' => false,'class'=>'form-control','options'=>$states]);?>
</div>
<?php }
if($noofrows==2)
{
	?>
	<div class="form-group col-md-6">
	  <label>Final States</label>
	  <?php echo $this->Form->input('p_final_state_id',['label' => false,'class'=>'form-control select2','options'=>$states]);?>
	</div>

	<div class="form-group col-md-6">
	  <label>Final Country</label>
	  <?php echo $this->Form->input('t_final_country_id',['label' => false,'class'=>'form-control select2','options'=>$countries]);?>
	</div><?php
}
if($noofrows==3)
{
	?>
	<div class="form-group col-md-6">
	  <label>Final States</label>
	  <?php echo $this->Form->input('t_final_state_id',['label' => false,'class'=>'form-control select2','options'=>$states]);?>
	</div>
 
	  <?php echo $this->Form->hidden('t_final_country_id',['label' => false,'class'=>'form-control select2','options'=>$countries]);?>
	  
	 <?php
}
if($noofrows==4)
{
	?>
	<div class="form-group col-md-4">
	<?php if($taxboxname=='t_pickup_state_id'){?>
	  <p>Pickup  State</p>
	<?php }
	else {?><p>Stop State</p><?php } ?>
	  <?php echo $this->Form->input($taxboxname,['label' => false,'class'=>'form-control select2','options'=>$states]);?>
	</div>
	<div style="display:none">
	<?php echo $this->Form->input('t_final_country_id',['label' => false,'class'=>'form-control select2','options'=>$countries]);?>
	</div> 
	 <?php
}
if($noofrows==5)
{ 
	?>
	<div class="form-group col-md-4">
	<?php if($taxboxname=='pickup_state_id'){?>
	  <p>Pickup State</p>
	<?php }
	else {?><p>Stop State</p><?php } ?>
	  <?php echo $this->Form->input($taxboxname,['label' => false,'class'=>'form-control select2','options'=>$states]);?>
	</div>
	<div style="display:none">
	<?php echo $this->Form->input('pickup_country_id',['label' => false,'class'=>'form-control select2','options'=>$countries]);?>
	<div class="form-group col-md-4">
 	 <?php 
}
if($noofrows==6)
{ 
	?>
	<div class="form-group col-md-4">
	<p>Destination State</p>
	<?php echo $this->Form->input($taxboxname,['label' => false,'class'=>'form-control select2','options'=>$states]);?>
	</div>
	<div style="display:none">
	<?php echo $this->Form->input('country_id',['label' => false,'class'=>'form-control select2','options'=>$countries]);?>
	<div class="form-group col-md-4">
 	 <?php 
}
 