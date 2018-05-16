<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="taxiFleetPromotions form large-9 medium-8 columns content">
    <?= $this->Form->create($taxiFleetPromotion) ?>
    <fieldset>
        <legend><?= __('Edit Taxi Fleet Promotion') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('country_id', ['options' => $countries]);
            echo $this->Form->input('fleet_detail');
            echo $this->Form->input('image');
            echo $this->Form->input('document');
            echo $this->Form->input('price_master_id', ['options' => $priceMasters]);
            echo $this->Form->input('like_count');
            echo $this->Form->input('visible_date');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('created_on');
            echo $this->Form->input('edited_by');
            echo $this->Form->input('edited_on');
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<div class="container-fluid">
	<div class="box box-primary">
			<div class="box-body">
				<?= $this->Form->create($taxiFleetPromotion) ?>
				<div class="row"> 
					<div class="col-md-12"> 
						<div class="form-box">
							<div class="panel-group" style="background-color:white;">
								<div class="panel">
									<fieldset>
										<legend style="color:#369FA1;"><b><?= __('Load Taxi/Fleet Promotion') ?></b></legend> 
								<div class="row">
									<div class="col-md-12">
										<div class="col-lg-4 col-md-4 col-sm-4  mt form-group">
											<p for="from">
												Your Company Name
												<span class="required">*</span>
											</p>
											<div class="input-field">
												 <?php
												 echo $this->Form->input('company_name',['class'=>'form-control requiredfield','label'=>false,'autocomplete'=> "off",'placeholder'=>"Company Name",'readonly'=>'readonly','value'=>$userss['company_name']);?>
												<label style="display:none;" class="helpblock error" > This field is required.</label>
											</div>
										</div>
										<div class="col-md-4 form-group">
											<p for="from">
												Enter Promotion Title
												<span class="required">*</span>
											</p>
											<div class="input-field">
												 <?php echo $this->Form->input('title',['class'=>'form-control requiredfield','label'=>false,'placeholder'=>"Enter Promotion Title"]);?>
												 <label style="display:none;margin-top:-20px;" class="helpblock error" > This field is required.</label>
											</div>
										</div>
										<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
										<input type="hidden" name="submitted_from" value="web">
										<div class="col-md-4 form-group">
											<p for="from">
												Upload Image of Promotion
												<span class="required">*</span>
											</p>
											<div class="input-field">
												<?php  echo $this->Form->input('image',['class'=>'form-control requiredfield','label'=>false,'type'=>'file','onchange'=>'checkCertificate()','id'=>'hotelImg']); ?>
												<label style="display:none" class="helpblock error" > This field is required.</label>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
							 
						<fieldset>
						<legend style="color:#369FA1;"><b><?= __('Area of Operation ') ?></b></legend> 
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6 form-group">
									<p for="from">
										Country
										<span class="required">*</span>
									</p>
									<div class="input-field">
									 <?php $options=array();
										$options[] = ['value'=>'101','text'=>'India'];
										echo $this->Form->input('country_id',["class"=>"form-control requiredfield" ,'options' => $options,'label'=>false]);?>
										<label style="display:none" class="helpblock error" > This field is required.</label>
									</div>
								</div>
								<div class="col-md-6 form-group">
									<p for="from">
												Select States of Operation
												<span class="required">*</span>
									</p>
									
									<div class="input-field">
								
										<?php 
										$options=array();
										foreach($states as $st)
										{
											$options[] = ['value'=>$st->id,'text'=>$st->state_name];
										};
										echo $this->Form->control('state_id', ['label'=>false,"id"=>"multi_states", "type"=>"select",'options' =>$options, "multiple"=>true , "class"=>"form-control select2 requiredfield state_list","data-placeholder"=>"Select Options","style"=>"height:125px;"]);?>
										<label style="display:none" class="helpblock error" > This field is required.</label>
										
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6 form-group" >
									<p for="from">
									Select Option
									</p>
									<div class="input-field">
										 <label class="radio-inline">
										  <input class="city_type" type="radio" name="package_type" value="0" checked="checked"/>All Cities
										</label>
										<label class="radio-inline">
										  <input class="city_type" type="radio" name="package_type" value="1"/>Specific Cities
										</label>
									</div>
								</div>
								<div class="col-md-6  form-group" >
									<p for="from" id="newlist" style="display:none;">
										Select Cities of Operation
										<span class="required">*</span>
									</p>
									<div class="input-field replacedata">
									</div>
								</div>
								
								
							</div>
						</div>
						</fieldset>
						<fieldset>
						<legend style="color:#369FA1;"><b><?= __('Promotion Details') ?></b></legend> 
								<div class="row">
								<div class="col-md-12">
									<div class="col-md-12 form-group">
										<p for="from">
											Select Cars or Buses in the Fleet
											<span class="required">*</span>
										</p>
										<div class="input-field">
											<?php 
											$options=array();
											foreach($priceMasters as $Buses)
											{
												$options[] = ['value'=>$Buses->id,'text'=>$Buses->name];
											};
											echo $this->Form->control('vehicle_type', ['label'=>false,"id"=>"multi_vehicle", "type"=>"select",'options' =>$options, "multiple"=>true , "class"=>"form-control select2 requiredfield","data-placeholder"=>"Select Options ","style"=>"height:125px;"]);?>
											<label style="display:none" class="helpblock error" > This field is required.</label>
										</div>
									</div>
								</div>  
								</div>  
								<div class="row">
									<div class="col-md-12 ">
									<div class="col-md-12 form-group">
										<p for="from">
											Fleet Description
											
										</p>
										<div class="input-field">
											<?php echo $this->Form->input('fleet_detail',['class'=>'form-control requiredfield','label'=>false,'rows'=>'2']);?>
											<label style="display:none" class="helpblock error" > This field is required.</label>
										</div>
									</div>
									</div>
								</div>
							</fieldset> 
								<fieldset>
									<legend style="color:#369FA1;"><b><?= __('Promotion Period ') ?></b></legend> 
										<div class="row">
											<div class="col-md-12">
												<div class="col-md-6 form-group">
													<p for="from">
													Select Duration of Promotion <span class="required">*</span>
													</p>
													<div class="input-field">
															 
													<?php				 
														$options=array();
														foreach($priceMasters as $Price)
														{
														 
															$options[] = ['value'=>$Price->id,'text'=>$Price->week,'priceVal'=>$Price->week,'price'=>$Price->price];
														};
														echo $this->Form->input('price_master_id',['options'=>$options,'class'=>'form-control priceMasters requiredfield select2','label'=>false,'empty'=>'Select ...']);?>
														<?php // echo $this->Form->input('duration', ['options' => $priceMasters,'class'=>'form-control','label'=>false]); ?>
														<label style="display:none" class="helpblock error" > This field is required.</label>
													</div>
												</div>
												<div class="col-md-6 form-group">
													<p for="from">
														Promotion Amount
													</p>
													<div class="input-field">
													<?php echo $this->Form->input('payment_amount', ['class'=>'form-control payment_amount','label'=>false,"placeholder"=>"Payment Amount",'readonly'=>'readonly','type'=>'text']);?> 
													</div>
												</div>
											</div>
										</div>
									</fieldset>
											<div class="row">
												<div class="col-md-12">
													<div class="input-field">
														<div class="margin text-center">
														<center>
														<?php echo $this->Form->button('Submit',['class'=>'btn btn-primary btn-submit','value'=>'submit','style'=>'background-color:#1295A2']); ?>
														</center>
														</div>
													</div>
												</div> 
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
						<input type="hidden" name="visible_date" class="visible_date" value="">
				  <?= $this->Form->end() ?>
			</div>
			<div id="selectbox" style="display:none;"> </div>
		</div>
	</div>
