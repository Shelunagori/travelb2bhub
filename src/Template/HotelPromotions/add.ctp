<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-plus"></i> <b> Hotel Promotion</b>
				</div> 
				<div class="box-body"> 
					<?= $this->Form->create($hotelPromotion) ?>		
					<fieldset>
						<legend><?= __('Add Hotel Promotion') ?></legend>
							<div class="row">
								<div class="col-md-12">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											Hotel Name
											<span class="required">*</span>
										</p>
										<div class="input-field">
											 <?php echo $this->Form->input('hotel_name',['class'=>'form-control','label'=>false]);?>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											Hotel Category
											<span class="required">*</span>
										</p>
										<div class="input-field">
											 <?php
												echo $this->Form->input('hotel_category_id',['class'=>'form-control select2','options' => $hotelCategories,'label'=>false,"empty"=>"Select Hotel Category"]);?>
										</div>
									</div>
								</div>
							</div> 
							<div class="row">
								<div class="col-md-12">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											Hotel Location
											<span class="required">*</span>
										</p>
										<div class="input-field">
										 <?php echo $this->Form->input('hotel_location',['class'=>'form-control','label'=>false]);?>
											
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											Hotel Website
											<span class="required">*</span>
										</p>
										<div class="input-field">
										 <?php echo $this->Form->input('website',['class'=>'form-control','label'=>false]);?>
											
										</div>
									</div>
									
								</div>
							</div> 
							<div class="row">
								<div class="col-md-12">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											Tariff of Cheapest Room
											<span class="required">*</span>
										</p>
										<div class="input-field">
										 <?php echo $this->Form->input('cheap_tariff',['class'=>'form-control','label'=>false]);?>
											
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											Tariff of Most Expensive Room
											<span class="required">*</span>
										</p>
										<div class="input-field">
											 <?php echo $this->Form->input('expensive_tariff',['class'=>'form-control','label'=>false]);?>
										</div>
									</div>
								</div>
							</div> 
							<div class="row">
								<div class="col-md-12">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											Total Charges
											<span class="required">*</span>
										</p>
										<div class="input-field">
										 <?php echo $this->Form->input('total_charges',['class'=>'form-control','label'=>false]);?>
											
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
										Hotel Rating
											<span class="required">*</span>
										</p>
										<div class="input-field">
										 <?php echo $this->Form->input('hotel_rating',['class'=>'form-control','label'=>false]);?>
											
										</div>
									</div>
									
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											City
											<span class="required">*</span>
										</p>
										<div class="input-field">
										 <?php echo $this->Form->input('total_charges',['class'=>'form-control','label'=>false]);?>
											
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
										Hotel Rating
											<span class="required">*</span>
										</p>
										<div class="input-field">
										 <?php echo $this->Form->input('hotel_rating',['class'=>'form-control','label'=>false]);?>
											
										</div>
									</div>
									
								</div>
							</div> 
							<div class="row">
								<div class="col-md-12">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
											<p for="from">
												Promotion Duration
												<span class="required">*</span>
											</p>
											<div class="input-field">
												 <?php echo $this->Form->input('price_master_id',['class'=>'form-control select2','options' => $priceMasters,'label'=>false]);?>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
											<p for="from">
												Visible Date
												<span class="required">*</span>
											</p>
											<div class="input-field">
										<?php echo $this->Form->input('visible_date', ['data-date-format'=>'dd/mm/yyyy','class'=>'form-control visible_date','label'=>false,"placeholder"=>"Visible Date",'readonly'=>'readonly','type'=>'text']); ?>
										</div>
									</div>
								</div>
							</div> 
							<div class="row">
								<div class="col-md-12">
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											Photograph of the Hotel	
											<span class="required">*</span>
										</p>
										<div class="input-field">
											 <?php echo $this->Form->input('hotel_pic',['class'=>'form-control','label'=>false,'type'=>'file']);?>
										</div>
									</div>
								</div>
							</div> 							
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
</section>
<?= $this->Form->end() ?>