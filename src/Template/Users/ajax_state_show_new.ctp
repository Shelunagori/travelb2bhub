
<?php if($noofrows==1) {?>
<div class="newColmd4">
	  Destination States
	  <?php echo $this->Form->input('h_state_id',['label' => false,'class'=>'form-control','options'=>$states]);?>
</div>
<?php }
if($noofrows==2)
{
	?>
	<div class=" col-md-6">
	  Final States
	  <?php echo $this->Form->input('p_final_state_id',['label' => false,'class'=>'form-control select2','options'=>$states]);?>
	</div>

	<div class=" col-md-6">
	  Final Country
	  <?php echo $this->Form->input('t_final_country_id',['label' => false,'class'=>'form-control select2','options'=>$countries]);?>
	</div><?php
}
if($noofrows==3)
{
	?>
	<div class="newColmd4">
	  Final States
	  <?php echo $this->Form->input('t_final_state_id',['label' => false,'class'=>'form-control select2','options'=>$states]);?>
	</div>
 
	  <?php echo $this->Form->hidden('t_final_country_id',['label' => false,'class'=>'form-control select2','options'=>$countries]);?>
	  
	 <?php
}
if($noofrows==4)
{
	?>
	<div class="newColmd4">
	<p for="from">
	<?php if($taxboxname=='t_pickup_state_id'){?>
	   Pickup  State 
	<?php }
	else {?> Stop State <?php } ?>
	</p>
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
	<div class="  newColmd4">
	<?php if($taxboxname=='pickup_state_id'){?>
	  <p>Pickup State</p>
	<?php }
	else {?><p>Stop State</p><?php } ?>
	  <?php echo $this->Form->input($taxboxname,['label' => false,'class'=>'form-control select2','options'=>$states]);?>
	</div>
	<div style="display:none">
	<?php echo $this->Form->input('pickup_country_id',['label' => false,'class'=>'form-control select2','options'=>$countries]);?>
	</div>
 	 <?php 
}
if($noofrows==6)
{ 
	?>
	<div class="newColmd4">
	<p>Destination State</p>
	<?php echo $this->Form->input($taxboxname,['label' => false,'class'=>'form-control select2','options'=>$states]);?>
	</div>
	<div style="display:none">
	<?php echo $this->Form->input('country_id',['label' => false,'class'=>'form-control select2','options'=>$countries]);?>
	</div>
 	 <?php 
}
 