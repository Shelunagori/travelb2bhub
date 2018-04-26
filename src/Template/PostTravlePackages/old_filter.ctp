<div id="myModal123" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-sm">
				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Sorting</h4>
				  </div>
				  <form method="get" class="filter_box">
				  <div class="modal-body" style="height:130px;">
					
					
				</div>
				<div class="modal-footer" style="height:60px;">
					 
				</div>
				</form>
				</div>
				</div>
			</div>
			
			
						<div class="fade modal form-modal" id="myModal122" role="dialog">
			  <div class="modal-dialog modal-md">
				 <div class=modal-content>
					<div class=modal-header>
					   <button class="close" data-dismiss="modal" type="button">&times;</button>
					   <h4 class=modal-title>Filter</h4>
					</div>
					<form class="filter_box" method="get">
					<div class="modal-body ">
					<span class="help-block"></span>
						<div class="row form-group margin-b10">
							<div class=col-md-12>
								 <div class=col-md-4>
								  <label class="col-form-label"for=example-text-input>Country: </label>
								  </div> 
								 <div class=col-md-7>
								<?php $options=array();
									foreach($countries as $country)
									{
										$options[] = ['value'=>$country->id,'text'=>$country->country_name];
									};echo $this->Form->input('country_id', ['options' => $options,'class'=>'form-control select2 cntry','label'=>false,'empty'=>'Select...',"multiple"=> true,'data-placeholder'=>"Select Multiple"]);
								?>
								</div>
							 </div>
							</div>
							<div class="row form-group margin-b10">
							<div class=col-md-12>
								 <div class=col-md-4>
								  <label class="col-form-label"for=example-text-input>City: </label>
								  </div> 
								 <div class="col-md-7" id="mcity">
									<?php
									echo $this->Form->input('city_id', ['options' => array(),'class'=>'form-control select2 cntry','label'=>false,'empty'=>'Select...',"multiple"=> true,'data-placeholder'=>"Select Multiple"]); ?>
								</div>
							 </div>
							</div>
							<div class="row form-group margin-b10">
								<div class=col-md-12>
								  <div class=col-md-4>
								 <label class="col-form-label" for=example-text-input>Select Package Duration: </label>
								 </div> 
								 <div class=col-md-7>
									<select name="" multiple="multiple" class="form-control select2 seleteddata" data-placeholder="Select Multiple">
  										<option value="1">1 N/2 D</option>
										<option value="2">2 N/3 D</option>
										<option value="3">3 N/4 D</option>
										<option value="4">4 N/5 D</option>
										<option value="5">5 N/6 D</option>
										<option value="6">6 N/7 D</option>
										<option value="7">7 N/8 D</option>
										<option value="8">8 N/9 D</option>
										<option value="9">9 N/10 D</option>
										<option value="10">10 N/11 D</option>
										<option value="11">11 N/12 D</option>
										<option value="12">12 N/13 D</option>
										<option value="13">13 N/14 D</option>
										<option value="14">14 N/15 D</option>
										<option value="15">More than 15 Days</option>
									</select>
									<input type="hidden" name="duration_day_night" id="duration">
								 </div>
								</div>	
							</div>
							<div class="row form-group margin-b10">
								<div class=col-md-12>
								  <div class=col-md-4>
								 <label class="col-form-label" for=example-text-input>Select Package Category: </label>
								 </div> 
								 <div class=col-md-7>
									<?php 
										$options=array();
										foreach($cat as $sts)
										{
											$options[] = ['value'=>$sts->id,'text'=>$sts->name];
										};
										echo $this->Form->control('category_id', ['label'=>false,"id"=>"multi_category", "type"=>"select",'options' =>$options, "class"=>"form-control select2","data-placeholder"=>"Select... ","style"=>"height:125px;",'empty'=>'Select...',"multiple"=> true,'data-placeholder'=>"Select Multiple"]);?>
								 </div>
								</div>	
							</div>
							<div class="row form-group margin-b10">
								<div class=col-md-12>
								  <div class=col-md-4>
								 <label class="col-form-label" for=example-text-input>Starting Price: </label>
								 </div> 
								 <div class=col-md-7>
									<select name="starting_price" class="form-control">
										<option value="">Select Total Budget</option>
										<option value="0-5000" >0-5000</option>
										<option value="5000-10000">5000-10000</option>
										<option value="10000-20000">10000-20000</option>
										<option value="20000-30000">20000-30000</option>
										<option value="30000-40000">30000-40000</option>
										<option value="40000-50000">40000-50000</option>
										<option value="50000-100000">50000-100000</option>
										<option value="100000-150000">100000-150000</option>
										<option value="150000-200000">150000-200000</option>
										<option value="100000-100000000000">200000-Above
										</option>
									</select>
								 </div>
								</div>	
							</div>
						  </div>
						<div class="modal-footer">
							<button class="btn btn-info btn-sm" name="submit" value="Submit" type="submit">Filter</button> 
							<a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'report')) ?>"class="btn btn-danger  btn-sm">Reset</a>
						</div>
					</form>
				</div>
			  </div>
			</div>