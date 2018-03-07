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
<?= $this->Form->create($postTravlePackage,['type' => 'file']) ?>
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
															 <?php echo $this->Form->input('company_name',['class'=>'form-control','label'=>false,'autocomplete'=> "off",'placeholder'=>"Company Name",'readonly'=>'readonly','value'=>$users->company_name]);?>
														</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
											<p for="from">
												Package Title
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
													Package Category
													<span class="required">*</span>
												</p>
												<div class="input-field">
													<?php echo $this->Form->control('package_category_id', ['label'=>false,"id"=>"multi_category", "type"=>"select",'options' =>$cat, "multiple"=>true , "class"=>"form-control select2","data-placeholder"=>"Select Category ","style"=>"height:125px;"]);?>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
												<p for="from">
													Valid Till
													<span class="required">*</span>
												</p>
												<div class="input-field input-group">
													 <?php echo $this->Form->input('valid_date1',['class'=>'form-control date-picker date','label'=>false,'data-date-format'=>'dd/mm/yyyy','placeholder'=>'dd/mm/yyyy']);?>
													 <p class="input-group-addon btn" >
													<span class="fa fa-calendar"></span>
													</p>
												</div>
											</div>
										</div>
									</div> 
									<div class="row">
										<div class="col-md-12">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
												<p for="from">
													Duration Night
													<span class="required">*</span>
												</p>
												<div class="input-field">
													 <?php echo $this->Form->input('duration_night',['class'=>'form-control','label'=>false]);?>
													
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
												<p for="from">
													Duration Day
													<span class="required">*</span>
												</p>
												<div class="input-field">
													 <?php echo $this->Form->input('duration_day',['class'=>'form-control','label'=>false]);?>
													
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
												<p for="from">
													Starting Price
													<span class="required">*</span>
												</p>
												<div class="input-field">
													 <?php echo $this->Form->input('starting_price',['class'=>'form-control','label'=>false]);?>
													
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
												<p for="from">
													Currency
													<span class="required">*</span>
												</p>
												<div class="input-field">
													 <?php echo $this->Form->input('currency_id',['options' => $currencies,'class'=>'form-control','label'=>false]);?>
													
												</div>
											</div>
										</div>
									</div> 
									<div class="row">
										<div class="col-md-12">
												<div class="col-md-6">
													<p for="from">
														Package Type
													</p>
													<div class="input-group">
													  <span class="input-group-addon">
															<input type="radio" name="r1" value="1"/>
															<p>India</p> 
														</span>
													   <span class="input-group-addon">
															<input type="radio" name="r1" value="2"/>
															<p>International</p>
													   </span>
													</div>
												</div>
												<div class="col-md-6">
													<p for="from">
														Choose Country
														<span class="required">*</span>
													</p>
													<div class="input-field">
													 <?php echo $this->Form->input('country_id',["class"=>"form-control select2",'options' => $countries,'label'=>false,"empty"=>"Select Country"]);?>
													</div>
												</div>
										</div>
									</div> 
									<div class="row">
										<div class="col-md-12">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
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
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
												<p for="from">
												Package Details				
													<span class="required">*</span>
												</p>
												<div class="input-field">
													 <?php echo $this->Form->input('package_detail',['class'=>'form-control','label'=>false]);?>
													
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
												<p for="from">
													Excluded Details
													<span class="required">*</span>
												</p>
												<div class="input-field">
													 <?php echo $this->Form->input('excluded_detail',['class'=>'form-control','label'=>false]);?>
													
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
									<div class="col-md-4">
										<p for="from">
											Payment Duration
										</p>
										<div class="input-field">
												 
										<?php				 
											$options=array();
											foreach($priceMasters as $Price)
											{
												$options[] = ['value'=>$Price->id,'text'=>$Price->week,'priceVal'=>$Price->week,'price'=>$Price->price];
											};
											echo $this->Form->input('price_master_id',['options'=>$options,'class'=>'form-control priceMasters','label'=>false,'empty'=>'Select ...']);?>
										</div>
									</div>
									<div class="col-md-4">
										<p for="from">
													Visibility Date
													<span class="required">*</span>
										</p>
										<div class="input-field">
										<?php echo $this->Form->input('visible_date', ['data-date-format'=>'dd/mm/yyyy','class'=>'form-control visible_date','label'=>false,"placeholder"=>"Visible Date",'readonly'=>'readonly','type'=>'text']); ?>
										</div>
									</div>
									<div class="col-md-4">
										<p for="from">
													Promotion Amount
													<span class="required">*</span>
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
												<?php echo $this->Form->button('Submit',['class'=>'btn btn-primary btn-submit','value'=>'submit']); ?>
												</center>
												</div>
											</div>
										</div> 
									</div>
						</fieldset>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?= $this->Form->end() ?>
</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
	 
    $(document).ready(function () {
		$(document).on('change','.priceMasters',function()
		{
			var priceVal=$('.priceMasters option:selected').attr('priceVal');
			var price=$('.priceMasters option:selected').attr('price');
			var Result = priceVal.split(" ");
			var Result1 = price.split(" ");
			var weeks=Result[0];
			var price=Result1[0];
			
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
			$('.payment_amount').val(price);
		})
$("#multi_city").multiselect();
$("#multi_states").multiselect();
$("#multi_category").multiselect();
});
</script>
