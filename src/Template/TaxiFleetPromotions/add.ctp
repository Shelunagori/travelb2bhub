<?php
/**
  * @var \App\View\AppView $this
  */
?>
<style>
.hr{
	margin-top:25px !important;
}
/*	
a:hover,a:focus{
    outline: none !important;
    text-decoration: none !important;
}
.tab .nav-tabs{
    display: inline-block !important;
    background: #F0F0F0 !important;
    border-radius: 50px !important;
    border: none !important;
    padding: 1px !important;
}
.tab .nav-tabs li{
    float: none !important;
    display: inline-block !important;
    position: relative !important;
}
.tab .nav-tabs li a{
    font-size: 16px !important;
    font-weight: 700 !important;
    background: none !important;
    color: #999 !important;
    border: none !important;
    padding: 10px 15px !important;
    border-radius: 50px !important;
    transition: all 0.5s ease 0s !important;
}
.tab .nav-tabs li a:hover{
    background: #1295A2 !important;
    color: #fff !important;
    border: none !important;
}
.tab .nav-tabs li.active a,
.tab .nav-tabs li.active a:focus,
.tab .nav-tabs li.active a:hover{
    border: none !important;
    background: #1295A2 !important;
    color: #fff !important;
}
.tab .tab-content{
    font-size: 14px !important;
    color: #686868 !important;
    line-height: 25px !important;
    text-align: left !important;
    padding: 5px 20px !important;
}
.tab .tab-content h3{
    font-size: 22px !important;
    color: #5b5a5a !important;
}*/ 
fieldset{
	margin:10px !important;
}
</style> 
<div class="box-body">
 <?= $this->Form->create($taxiFleetPromotion) ?>
	<div class="row"> 
		<div class="col-md-12"> 
			<div class="form-box">
				<div class="panel-group" style="background-color:white;">
					<div class="panel panel-default">
						<fieldset>
							<legend style="color:#369FA1;"><b><?= __('Load Package') ?></b></legend> 
					<div class="row">
						<div class="col-md-12">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
								<p for="from">
									Company Name
									<span class="required">*</span>
								</p>
								<div class="input-field">
									
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
								<p for="from">
									Promotion Title
									<span class="required">*</span>
								</p>
								<div class="input-field">
									 <?php echo $this->Form->input('title',['class'=>'form-control','label'=>false]);?>
									
								</div>
							</div>
						</div>
					</div> 
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-6">
								<p for="from">
									Upload Image of the Promotion
									<span class="required">*</span>
								</p>
								
								<div class="input-field">
									<?php  echo $this->Form->input('image',['class'=>'form-control','label'=>false,'type'=>'file']); ?>
								</div>
							</div>
							<div class="col-md-6 ">
							<p for="from">
									Upload Document
									<span class="required">*</span>
								</p>
								
								<div class="input-field">
									<?php  echo $this->Form->input('document',['class'=>'form-control','label'=>false,'type'=>'file']); ?>
								</div>
							</div>
						</div>
					</div>
				</fieldset>
				<br>
			<fieldset>
			<legend style="color:#369FA1;"><b><?= __('Package Details') ?></b></legend> 
					<div class="row">
						<div class="col-md-12">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
								<p for="from">
									Vehicle Type
									<span class="required">*</span>
								</p>
								<div class="input-field">
									
									 <?php echo $this->Form->input('promotion_type',['options' => $cat,'class'=>'form-control','label'=>false,"class"=>"form-control select2","empty"=>"Select Vehicle"]);?>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
								<p for="from">
									Promotion Type
									<span class="required">*</span>
								</p>
								<div class="input-field">
									
									 <?php echo $this->Form->input('price_master_id',['options' => $priceMasters,'class'=>'form-control','label'=>false]);?>
								</div>
							</div>
							
						</div>
					</div> 
					<div class="row">
						<div class="col-md-12">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
								<div class="input-field">
									<p for="from">
										Choose Country
										<span class="required">*</span>
									</p>
									<?php echo $this->Form->input('country_id',['class'=>'form-control select2','options' => $countries,'label'=>false,"empty"=>"Select Country"]);?>
								</div>
							</div>
							<div class="col-md-6">
								<p for="from">
											Visibility Date
											<span class="required">*</span>
								</p>
								<div class="input-field">
								 <?php echo $this->Form->input('visible_date1',['class'=>'form-control date-picker','label'=>false,'data-date-format'=>'dd/mm/yyyy','placeholder'=>'dd/mm/yyyy']);?>
								</div>
							</div>
							
							<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
								<div class="input-field">
									<?php  //echo $this->Form->input('visible_date', ['class'=>'form-control input-medium date-picker']); ?>
								</div>
							</div> -->
						</div>
					</div> 
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-6">
								<p for="from">
											Choose State
											<span class="required">*</span>
								</p>
								
								<div class="input-field">
							
									<?php echo $this->Form->control('state_id', ['label'=>false,"id"=>"multi_states", "type"=>"select",'options' =>$states, "multiple"=>true , "class"=>"form-control select2","data-placeholder"=>"Select State","style"=>"height:125px;"]);?>
									
								</div>
							</div>
							<div class="col-md-6">
								<p for="from">
											Choose City
											<span class="required">*</span>
								</p>
								<div class="input-field">
								<?php echo $this->Form->control('city_id', ['label'=>false,"id"=>"multi_city", "type"=>"select",'options' =>$city, "multiple"=>true , "class"=>"form-control select2","data-placeholder"=>"Select City ","style"=>"height:125px;"]);?>
									
								</div>
							</div>
							
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-12">
						<div class="col-md-12">
							<p for="from">
								Fleet Details
								
							</p>
							<div class="input-field">
									<?php echo $this->Form->input('fleet_details',['class'=>'form-control','label'=>false,'rows'=>'5']);?>
								</div>
							</div>
						</div>
					</div>
				</fieldset>
			<br>
					<fieldset>
						<legend style="color:#369FA1;"><b><?= __('Payment ') ?></b></legend> 
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<p for="from">
											Promotion Duration
										</p>
										<div class="input-field">
											<?php  echo $this->Form->input('duration', ['options' => $priceMasters,'class'=>'form-control','label'=>false]); ?>
										</div>
									</div>
									<div class="col-md-6">
									<p for="from">
										Promotion Amount
									</p>
										<div class="input-field">
											<?php  echo $this->Form->input('amount', ['class'=>'form-control','label'=>false]); ?>
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
													<?php echo $this->Form->button('Submit',['class'=>'btn btn-primary btn-submit','value'=>'submit']); ?>
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
		</div>
<?= $this->Form->end() ?>
<script>
	 
    $(document).ready(function () {
$("#multi_city").multiselect();
$("#multi_states").multiselect();
	});
</script>