<div id="my_final_responses" class="container-fluid">
	<div class="row equal_column">
		<div class="col-md-12" style="background-color:#fff"> 
			<br>
			<?php echo  $this->Flash->render() ?>
		</div>
		<?= $this->Form->create($eventPlannerPromotion) ?>
		<div class="col-md-12" style="background-color:#fff"> 
			<div class="box box-default">
				<div class="box-header with-border"> 
					<h3 class="box-title" style="padding:5px">Event Planner Promotion</h3>
					<div class="box-tools pull-right">
 					</div>
 				</div>
				<div class="box-body">
					<fieldset>
					<legend style="color:#369FA1;"><b> &nbsp; Load Package &nbsp;  </b></legend>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-4">
									<p> Company Name </p>
									<?php echo $this->Form->input('company_name',['class'=>'form-control','label'=>false,'autocomplete'=> "off",'placeholder'=>"Company Name",'readonly'=>'readonly','value'=>$users->company_name]);?>
								</div>
								<div class="col-md-4">
									<p> Upload Image of Promotion <span class="required">*</span></p>
									<?php echo $this->Form->file('image',['class'=>'form-control','label'=>false]);?>
								</div>
								<div class="col-md-4">
									<p> Upload Document </p>
 									<?php echo $this->Form->file('document',['class'=>'form-control','label'=>false]);?>
								</div>
							</div>
						</div>
					</fieldset>
					<fieldset>
					<legend style="color:#369FA1;"><b> &nbsp; Package Details &nbsp;  </b></legend>
						<div class="row">
							<div class="col-md-12">
								<!--<div class="col-md-4">
									<p> Country </p>
									<?php echo $this->Form->input('Country', ['options' => $States,'class'=>'form-control select2','label'=>false,'empty'=>'Select...']); ?> 
								</div>---->
								
								<div class="col-md-6">
									<p> States <span class="required">*</span></p>
									<?php echo $this->Form->input('state[]', ['options' => $States,'class'=>'form-control select2','label'=>false,"data-placeholder"=>"Select States",'multiple'=>true]); ?> 										 
								</div>
								<div class="col-md-6">
									<p> Cities of Operation </p>
									<?php echo $this->Form->input('city[]', ['options' =>$Cities,'class'=>'form-control select2','label'=>false,"data-placeholder"=>"Select Cities",'multiple'=>true]); ?> 	 
								</div>
 							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-12">
									<p> Description </p>
									<?php echo $this->Form->textarea('event_detail', ['class'=>'form-control','label'=>false,"placeholder"=>"Please Provide Event Description",'rows'=>3,'style'=>'resize:none']); ?> 	 
								</div>
							</div>
						</div>
					</fieldset>
					<fieldset>
					<legend style="color:#369FA1;"><b> &nbsp; Payment &nbsp;  </b></legend>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6">
									<p> Payment Duration <span class="required">*</span></p>
									<?php 
									 
									 
						$options=array();
						foreach($priceMasters as $Price){
							$options[] = ['value'=>$Price->id,'text'=>$Price->week,'priceVal'=>$Price->week];
						}
									;
									echo $this->Form->input('price_master_id',['options'=>$options,'class'=>'form-control priceMasters','label'=>false,'empty'=>'Select ...']);?>
								</div>
								<div class="col-md-6">
									<p> Visible Date </p>
									<?php echo $this->Form->input('visible_date', ['class'=>'form-control visible_date','label'=>false,"placeholder"=>"Visible Date",'readonly'=>'readonly','type'=>'text']); ?> 	 
								</div>
							</div>
						</div>
					</fieldset>
					<br>
					<div class="row">
						<div class="col-md-12" align="center">
							<?= $this->Form->button(__('Submit'),['class'=>'btn btn-sm btn-success']) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?= $this->Form->end() ?>
	</div>
</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function (){
	$(document).on('change','.priceMasters',function(){
		var priceVal=$('.priceMasters option:selected').attr('priceVal');
		var Result = priceVal.split(" ");
		var weeks=Result[0];
		
		var todaydate = new Date(); // Parse date
		for(var x=0; x < weeks; x++){
			todaydate.setDate(todaydate.getDate() + 7); // Add 7 days
 		}
		var dd = todaydate .getDate();
		var mm = todaydate .getMonth()+1; //January is 0!
		var yyyy = todaydate .getFullYear();
		if(dd<10){  dd='0'+dd } 
		if(mm<10){  mm='0'+mm } 
		var date = dd+'-'+mm+'-'+yyyy;	
		$('.visible_date').val(date);
	})
});
</script>
 
