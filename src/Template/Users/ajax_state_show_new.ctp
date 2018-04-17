
<?php if($noofrows==1) {?>
<div class="col-md-4">
	  Destination State
		<?php 
		foreach($states as $key => $value){}
		echo $this->Form->input('s1',['type'=>'text','label' => false,'class'=>'form-control','value'=>$value,'readonly']);?>
		<input type="hidden" name="h_state_id" value="<?php echo $key; ?>">
 </div>
<?php }
if($noofrows==2)
{
	?>
	<div class=" col-md-6">
	  Final State
 	  		<?php 
			foreach($states as $key => $value){}
			echo $this->Form->input('s1',['type'=>'text','label' => false,'class'=>'form-control','value'=>$value,'readonly']);?>
			<input type="hidden" name="p_final_state_id" value="<?php echo $key; ?>">
	</div>

	<div class=" col-md-6">
	Final Country
 		<?php 
		foreach($countries as $keys => $values){}
		echo $this->Form->input('sds',['type'=>'text','label' => false,'class'=>'form-control','value'=>$values,'readonly']);?>
		<input type="hidden" name="t_final_country_id" value="<?php echo $keys; ?>">

	</div><?php
}
if($noofrows==3)
{
	?>
	<div class="col-md-4">
	  Final State
	  <?php 
			foreach($states as $key => $value){}
			echo $this->Form->input('dasd',['type'=>'text','label' => false,'class'=>'form-control','value'=>$value,'readonly']);?>
			<input type="hidden" name="t_final_state_id" value="<?php echo $key; ?>">
	</div>
	  <?php echo $this->Form->hidden('t_final_country_id',['label' => false,'class'=>'form-control select2','options'=>$countries]);?>
	 <?php
}
if($noofrows==4)
{
	?>
	<div class="col-md-4">
	<p for="from">
	<?php if($taxboxname=='t_pickup_state_id'){?>
	   Pickup  State 
	<?php }
	else {?> Stop State <?php } ?>
	</p>
 	   <?php 
		foreach($states as $key => $value){}
		echo $this->Form->input('dasdas',['type'=>'text','label' => false,'class'=>'form-control','value'=>$value,'readonly']);?>
		<input type="hidden" name="<?php echo $taxboxname; ?>" value="<?php echo $key; ?>">
 	</div>
	<div style="display:none">
	<?php echo $this->Form->input('t_final_country_id',['label' => false,'class'=>'form-control select2','options'=>$countries]);?>
	</div> 
	 <?php
}
if($noofrows==5)
{ 
	?>
	<div class="  col-md-4">
	<?php if($taxboxname=='pickup_state_id'){?>
	  <p>Pickup State</p>
	<?php }
	else {?><p>Stop State</p><?php } ?>
	 
	  <?php 
		foreach($states as $key => $value){}
		echo $this->Form->input('dasdas',['type'=>'text','label' => false,'class'=>'form-control','value'=>$value,'readonly']);?>
		<input type="hidden" name="<?php echo $taxboxname; ?>" value="<?php echo $key; ?>">
	</div>
	<div style="display:none">
	<?php echo $this->Form->input('pickup_country_id',['label' => false,'class'=>'form-control select2','options'=>$countries]);?>
	</div>
 	 <?php 
}
if($noofrows==6)
{ 
	?>
	<div class="col-md-4">
	<p>Destination State</p>
	 
	<?php 
		foreach($states as $key => $value){}
		echo $this->Form->input('dasdas',['type'=>'text','label' => false,'class'=>'form-control','value'=>$value,'readonly']);?>
		<input type="hidden" name="<?php echo $taxboxname; ?>" value="<?php echo $key; ?>">
	</div>
	<div style="display:none">
	<?php echo $this->Form->input('country_id',['label' => false,'class'=>'form-control select2','options'=>$countries]);?>
	</div>
 	 <?php 
}
 