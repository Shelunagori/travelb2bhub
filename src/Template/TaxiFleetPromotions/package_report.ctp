<?php //echo $this->Html->css('/assets/loader-1.css'); ?>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php
//-- LIST 
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/TaxiFleetPromotions/getTaxiFleetPromotions.json?isLikedUserId=".$user_id."&higestSort=".$higestSort."&country_id=".$country_id."&city_id=".$city_id."&state_id=".$state_id."&car_bus_id=".$car_bus_id."&search=".$search."&submitted_from=web",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 4f8087cd-6560-4ca6-5539-9499d3c5b967"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$priceMasters=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$List=json_decode($response);
	//pr($List); exit;
	$taxiFleetPromotions=$List->getTaxiFleetPromotions;
}
//--- COUNTRY STATE & CITY
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."pages/masterCountry",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 39e47dc1-a66a-2347-2fc6-3b5e0160d26d"
  ),
));
$masterCountry = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$countries=array();
$states=array();
$city=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$masterCountry=json_decode($masterCountry);
	$countries=$masterCountry->countryData->ResponseObject;
	$states=$masterCountry->stateData->ResponseObject;
	$city=$masterCountry->cityData->ResponseObject;
}
//-- BUSES LIST 
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/taxi_fleet_car_buses/index.json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: f0bdc3fd-dd35-cc7d-9c8b-a8ebdcf4b05e"
  ),
));
$Result = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$TaxiFleetCarBuses=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
$TaxiFleetCarBuses=json_decode($Result);
$TaxiFleetCarBuses=$TaxiFleetCarBuses->TaxiFleetCarBuses;
}
//-- priceMasters
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/price_masters/index.json?promotion_type_id=2",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 4f8087cd-6560-4ca6-5539-9499d3c5b967"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$priceMasters=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$priceMasters=json_decode($response);
	$priceMasters=$priceMasters->PriceMasters;
}

?>
<style>
@media all and (max-width: 410px) {
	/* Logo for Mobile */
	.btnlayout{
		margin-top: 5px !important;
	 }
}
@media all and (min-width: 400px) {
	/* Logo for Mobile */
	.btnlayout{
		//margin-top: -5px !important;
	 }
}
fieldset{
	margin-bottom:5px !important;
	border-radius: 6px;
}
.modal-title{
font-size:20px;	
}

.row{
	line-height:15.0px;
}
.btnlayout{
	border-radius:15px !important;
}
#myImg:hover {opacity: 0.7;}
.bbb{
	padding:0px!important;
	pading-bottom:10px!important;
}
.rowspace{
	padding-top:5px;
	font-size:14px;
	
}
.rowspacemodal{
	padding:10px;
	font-size:14px;
}
hr{
	margin-top: 15px !important;
    margin-bottom: 4px !important;
}

label{
	color:#96989A !important;
	font-weight:100;
}

.col-md-4{
	color:#676363;
}

a{
	color:#ac85d6;
}
.col-form-label{
	color:#000 !important;
}
</style> 
	<div class="row" >
		<div class="col-md-12">
		
		</div>
	</div>
<div  class="container-fluid">
	<div class="box box-primary" style="margin-bottom:5px;">
		<div class="row" >
			<div class="col-md-12">
				<div class="box-header with-border"> 
					<span class="box-title" style="color:#057F8A;"><b>Taxi/Fleet Promotions</b></span>
					<div class="box-tools pull-right" style="margin-top:-5px;">
						<a style="font-size:16px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
						<a style="font-size:23px" class="btn btn-box-tool " data-target="#demo" data-toggle="collapse"> <i class="fa fa-filter" aria-expanded="false"></i></a>
					</div>
				</div>
			</div>
		</div>
		<div class="row collapse"  id="demo" aria-expanded="false">
			<div class="col-md-12">
				<div class="box-header with-border">
				<form class="filter_box" method="get">
					<fieldset><legend>Filter</legend>
						<div class="row " >
							<div class="col-md-12">
								<div class="col-md-6" style="padding-top:8px;">
									<label class="col-form-label" for=example-text-input>City:  </label>
									<div class="input-field" style="padding-top:4px;">
									 <?php 
									$options=array();
									foreach($city->citystatefi as $cty)
									{
										$options[] = ['value'=>$cty->cityid,'text'=>$cty->name];
									};
									echo $this->Form->input('city_id', ['options' =>$options,'class'=>'form-control select2','label'=>false,'empty'=>'Select...','multiple'=>true,'data-placeholder'=>'Select Multiple']); ?>
									</div>
								</div>	
							  <div class="col-md-6" style="padding-top:8px;">
								 <label class="col-form-label" for=example-text-input>State:  </label>
									<div class="input-field" style="padding-top:4px;">
									<?php 
									$options=array();
									foreach($states as $st)
									{
										$options[] = ['value'=>$st->id,'text'=>$st->state_name];
									};
									echo $this->Form->input('state_id', ['options' => $options,'class'=>'form-control select2','label'=>false,'empty'=>'Select...','multiple'=>true,'data-placeholder'=>'Select Multiple']); 
									?> 
									</div>
								</div>	
							</div>
						</div>
						<div class="row ">
							<div class="col-md-12" >
								<div class="col-md-12" style="padding-top:8px;">
									<label class="col-form-label"for=example-text-input>Select Taxt/Fleet Category:  </label>
									<div class="input-field" style="padding-top:4px;">
										<?php 
										$options=array();
										foreach($TaxiFleetCarBuses as $Buses)
										{
											$options[] = ['value'=>$Buses->id,'text'=>$Buses->name];
										};
										echo $this->Form->control('car_bus_id', ['label'=>false,"id"=>"multi_vehicle", "type"=>"select",'options' =>$options, "class"=>"form-control select2","style"=>"height:125px;",'empty'=>'Select...','multiple'=>true,'data-placeholder'=>'Select Multiple']);?>
									</div>
								</div>
							</div>
						</div>
						<hr ></hr>	
							<div class="row ">
								<div class="col-md-12 text-center" style="padding-top:12px;">
									<a href="<?php echo $this->Url->build(array('controller'=>'TaxiFleetPromotions','action'=>'package_report')) ?>"class="btn btn-warning  btn-sm">Reset</a>
									<button class="btn btn-success btn-sm" name="submit" value="Submit" type="submit">Apply</button> 
								</div>
							</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>  
			 <div id="myModal123" class="modal fade" role="dialog" >
			  <div class="modal-dialog modal-sm" >
				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Sorting</h4>
				  </div>
				  <form method="get" class="filter_box">
				  <div class="modal-body" style="height:130px;">
					<div class="col-md-12 row form-group ">
						<div class="col-md-12 radio">
							<label>
								<input class="btn btn-info btn-sm" type="radio" name="higestSort" value="user_rating"/>
								User Rating
							</label>
						</div>
					</div>
					<div class="col-md-12 row form-group ">
						<div class="col-md-12 radio">
							<label>
							<input class="btn btn-info btn-sm" type="radio" name="higestSort" value="total_likes"/>
								 Likes
							</label>
						</div>
					</div>
					 
					
					<div class="col-md-12 row form-group ">
						<div class="col-md-12 radio">
							<label>
								<input class="btn btn-info btn-sm" type="radio" name="higestSort" value="total_views"/>
								 Views
							</label>
						</div>
					</div>
					
				</div>
				<div class="modal-footer" style="height:60px;">
					  <div class="row">
							<div class="col-md-12 text-center">
								<input type="submit" class="btn btn-info btn-sm">
								<a href="<?php echo $this->Url->build(array('controller'=>'TaxiFleetPromotions','action'=>'package_report')) ?>"class="btn btn-danger btn-sm">Reset</a>
							</div>
					  </div>
				</div>
				</form>
				</div>
				</div>
			</div>
			<?php $i=1;
			if(!empty($taxiFleetPromotions)){
			foreach ($taxiFleetPromotions as $taxiFleetPromotion){
				$vehicleList='';
					$x=0;
					foreach($taxiFleetPromotion->taxi_fleet_promotion_rows as $vehicle)
						{
							if($x>=1){
								$vehicleList.=', ';
							}
							$vehicleList.=$vehicle->taxi_fleet_car_bus->name;
							$x++;
						}
						$cityList='';
						$y=0;
						foreach($taxiFleetPromotion->taxi_fleet_promotion_cities as $cities)
							{
								if($y>=1){
									$cityList.=', ';
								}
								@$cityList.=$cities->city->name;
								if($cities->city_id==0){@$cityList.='All Cities';}
								$y++;
							}
						$stateList='';
						$z=0;
						foreach($taxiFleetPromotion->taxi_fleet_promotion_states as $statess)
							{
								if($z>=1){
									$stateList.=', ';
								}
								$stateList.=$statess->state->state_name;
								$z++;
							}
						$i++; ?>
	
	<div class="box-body bbb">	
			<fieldset style="background-color:#fff;">
				<form method="post" class="formSubmit">
					<div class="row">
						<div class="col-md-12" style="padding-top:5px;">
						<span style="font-size:18px;"><?= h($taxiFleetPromotion->title) ?></span>
						<button class="close" style="margin-top: -12px; font-size:20px;font-size: 26px;" type="button" data-target="#remove<?php echo $taxiFleetPromotion->id; ?>" data-toggle=modal>&times;</button>
						</div>
					</div>
					<span class="help-block"></span>
					<div class="row">						
					<div class="col-md-3">
					<?= $this->Html->image($taxiFleetPromotion->full_image,['id'=>'myImg','style'=>'width:100%;height:109px;','data-target'=>'#imagemodal'.$taxiFleetPromotion->id,'data-toggle'=>'modal','promotionid'=>$taxiFleetPromotion->id,'userId'=>$user_id,'class'=>'viewCount']) ?>
					<div id="imagemodal<?php echo $taxiFleetPromotion->id;?>" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md">
						<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body" >
								<button type="button" class="close" data-dismiss="modal" style="padding-right:8px !important;">&times;</button>
								<?= $this->Html->image($taxiFleetPromotion->full_image,['style'=>'width:100%;padding:20px;padding-top:0px!important;']) ?>
								</div>
							</div>
						</div>
					</div>
					<hr style="margin-top:4px !important"></hr>
					<div class="row" style="padding-top:5px;">					
						<input type="hidden" name="taxifleet_id" value="<?php echo $taxiFleetPromotion->id; ?>">
								<table  width="100%" style="text-align:center;" >
								<tr>
								<td width="25%" >
									<span><img src="../images/view.png" height="13px"/>
									<?= h($taxiFleetPromotion->total_views);?></span>
								</td>
								<td width="25%" >
									<span><img src="../images/unlike.png" height="13px"/>
									<?= h($taxiFleetPromotion->total_views);?></span>
								</td>
								<td width="25%" >
									<span><img src="../images/unsave.png" height="14px"/>
									<?= h($taxiFleetPromotion->total_saved);?></span>
								</td>
								<td width="25%" >
									<span><img src="../images/flag.png" height="15px"/>
									<?= h($taxiFleetPromotion->total_flagged);?></span>
								</td>
							</tr>
						</table>
							 
							</div><hr></hr>
						</div>
							<div class="col-md-9">
								<div class="row col-md-12 rowspace" style="padding-top:8px;">
										<div class="col-md-12">
										<label>Category: </label>
										<span ><?= h($vehicleList); ?></span>
										</div>
								</div>
								<div class="col-md-7">
									<div class="row rowspace" >
										<div class="col-md-12"><label ><?= __(' Cities of Operation') ?>: </label>
										<span><?= h($cityList); ?></span>
										</div>
									</div>
									<div class="row rowspace" >
										<div class="col-md-12"><label ><?= __(' States of Operation') ?>: </label>
										<span ><?= h($stateList); ?> </span>
										</div>
									</div>
									<div class="row rowspace">
											<div class="col-md-12 ">
											<label>Date Posted: </label>
											<span style="color:#black">  <?php echo date('d-M-Y',strtotime($taxiFleetPromotion->created_on)) ; ?></span>
											</div>
										</div>
								</div>
								<div class="col-md-5">
									<div class="row rowspace" >
										<div class="col-md-12"><label ><?= __(' Country') ?>: </label>
										<span ><?= h($taxiFleetPromotion->country->country_name); ?> </span>
										</div>
									</div>
									<div class="row rowspace">
										<div class="col-md-12 "><label ><?= __(' Seller') ?>: </label>	
										<span><u>
												<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'adminviewprofile',$taxiFleetPromotion->user_id),1);?>
												<a style="color:#d69d5c" href="<?php echo $hrefurl; ?>">
												<?= h($taxiFleetPromotion->user->first_name.' '.$taxiFleetPromotion->user->last_name);?></u>
												<?php
												if($taxiFleetPromotion->user_rating==0)
												{
													echo "";
												}
												else{
														echo "(".$taxiFleetPromotion->user_rating." <i class='fa fa-star'></i>)";
													}
												?></a>
											</span>
										</div>					
									</div>
									
										<div class="row rowspace">
											<div class="col-md-12">
											<label>Expiring On: </label>
											<span style="color:#FB6542"> <?php echo date('d-M-Y',strtotime($taxiFleetPromotion->visible_date)) ; ?></span>
											</div>
										</div> 
									<!-----button list-->
									<div class="" style="padding-top:15px;">
									<div id="fleetdetail<?php echo $taxiFleetPromotion->id;?>" class="modal fade" role="dialog">
										<div class="modal-dialog modal-md">
										<!-- Modal content-->
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<span class="modal-title">Fleet Details</span>
											  </div>
												<div class="modal-body" >
													<div class="row">
														<div class="col-md-12" >
															<p style="padding:15px;">
														<?php echo $taxiFleetPromotion->fleet_detail; ?></p>
														</div>
													</div>
												</div>
												<div class="modal-footer" >
													<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancel</button>
												</div>
											</div>
										</div>
									</div>
									
									
									
									
									<div id="contactdetails<?php echo $taxiFleetPromotion->id;?>" class="modal fade" role="dialog">
										<div class="modal-dialog modal-sm" >
											<!-- Modal content-->
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
														<span class="modal-title">
														Seller Details
														</span>
														</div>
														<div class="modal-body" style="padding-left:15px!important;">
															<div class="row rowspace">
															<div class="col-md-12">
																<label>
																Seller Name: </label>
																	<span><u>
																	<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'adminviewprofile',$taxiFleetPromotion->user_id),1);?>
																	<a style="color:#d69d5c" href="<?php echo $hrefurl; ?>">
																	<?= h($taxiFleetPromotion->user->first_name.' '.$taxiFleetPromotion->user->last_name);?></u>
																	<?php
																	if($taxiFleetPromotion->user_rating==0)
																	{
																		echo "";
																	}
																	else{
																			echo "(".$taxiFleetPromotion->user_rating." <i class='fa fa-star'></i>)";
																		}
																	?></a>
																</span>
																</div>					
															</div>
															<div class="row rowspace">
																<div class="col-md-12">
																<label>Mobile No: </label>
																<span><?= h($taxiFleetPromotion->user->mobile_number);?></span>
																</div>
															</div>
															<div class="row rowspace">
																<div class="col-md-12">
																	<label>Email: </label>
																	<span><u><a href="mailto:<?php echo $taxiFleetPromotion->user->email;?>"><?= h($taxiFleetPromotion->user->email);?></a></u></span>
																	</div>
																</div>
														</div><span class="help-block"></span>
														<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
														</div>
													</div>
												</div>
											</div>
		
														</div>
													</div>
													<div class="col-md-12 text-center">
			<button style="margin-top:5px;" class="btn btn-info btn-md btnlayout viewCount" data-target="#fleetdetail<?php echo $taxiFleetPromotion->id;?>" promotionid="<?php echo $taxiFleetPromotion->id;?>" userId="<?php echo $user_id;?>" data-toggle="modal" type="button">Fleet Details</button>&nbsp;&nbsp;
			
			<button style="margin-top:5px;" class="btn btn-danger btn-md btnlayout viewCount" data-target="#contactdetails<?php echo $taxiFleetPromotion->id;?>" data-toggle="modal" promotionid="<?php echo $taxiFleetPromotion->id;?>" userId="<?php echo $user_id;?>" type="button">Contact Info</button>&nbsp;&nbsp;
			
			<button style="margin-top:5px;" type="button" class="btn btn-success btn-md btnlayout" data-target="#renew<?php echo $taxiFleetPromotion->id; ?>" data-toggle=modal>Renew </button>&nbsp;&nbsp;

			<a style="margin-top:5px" href="<?php echo $this->Url->build(["controller" => "TaxiFleetPromotions",'action'=>'edit/'.$taxiFleetPromotion->id]); ?>" class="btn btn-successto btn-md btnlayout" >Edit</a>&nbsp;&nbsp;

			<button style="margin-top:5px;" class="btn btn-warning btn-md btnlayout viewCount" data-target="#Priority<?php echo $taxiFleetPromotion->id;?>" data-toggle="modal" type="button">Priority</button>&nbsp;&nbsp;
		</div>
												</div>
											</div>
										</form>
<div id="Priority<?php echo $taxiFleetPromotion->id;?>" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md" >
		<!-- Modal content-->
		<form method="post" class="formSubmit">
			<div class="modal-content">
			  <div class="modal-header" >
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">
						Do you want to set Priority ?
					</h4>
				</div>
				<div class="modal-body">
					<div class="row mainrow" style="padding: 12px;">
						<div class="col-md-12">
							 
							<div class="col-md-6">
								<p for="from">
									Select Position
								</p>
								<div class="input-field">
									<select class="form-control" name="position">
										<option value="">Select...</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11 (Default)</option>
									</select>
								</div>
							</div> 
						</div>
						 
					</div>
				</div>
				<div class="modal-footer" style="height:60px;">
					<button type="submit"  name="setpriority" class=" btn btn-success btn-md" value="yes" >Submit</button>
					<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
				</div>
			</div>
			<input type="hidden" name="texifleet_id" value="<?php echo $taxiFleetPromotion->id; ?>">
		</form>
	</div>
</div>	 										
						<div id="renew<?php echo $taxiFleetPromotion->id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<!-- Modal content-->
								<form method="post" class="formSubmit">
									<div class="modal-content">
									  <div class="modal-header" >
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">
											Do you want to renew promotion ?
											</h4>
										</div>
										<div class="modal-body">
											<div class="row mainrow">
												<div class="col-md-12">
													<div class="col-md-6">
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
													<div class="col-md-6">
														<p for="from">
																	Promotion Amount
																	<span class="required">*</span>
														</p>
														<div class="input-field">
														<?php echo $this->Form->input('payment_amount', ['class'=>'form-control payment_amount','label'=>false,"placeholder"=>"Payment Amount",'readonly'=>'readonly','type'=>'text']);?> 
														</div>
													</div>
												</div>
												<input type="hidden" name="visible_date" class="visible_date" value="">
											</div>
										</div>
										<div class="modal-footer" style="height:60px;">
											<button type="submit"  name="pay_now" class=" btn btn-success btn-md" value="yes" >Pay Now</button>
											<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
										</div>
									</div>
								<input type="hidden" name="texifleet_id" value="<?php echo $taxiFleetPromotion->id; ?>">
								</form>
							</div>
						</div>
						<div id="remove<?php echo $taxiFleetPromotion->id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<!-- Modal content-->
								<form method="post" class="formSubmit">
									<div class="modal-content">
										<div class="modal-header" style="height:100px;">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">
											Are you sure you want to delete this Promotion?
											</h4>
										</div>
										<div class="modal-footer">
											<button type="submit" class=" btn btn-success btn-md" value="yes" name="remove_promotion">Yes</button>
											<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
										</div>
									</div>
									<input type="hidden" name="remove_package_id" value="<?php echo $taxiFleetPromotion->id; ?>"/>
								</form>
							</div>
						</div>
									</fieldset>	
								</div>
								<?php      }
									}
									else{	
										echo"<div class='row col-md-12 text-center'><tr><th colspan='10' ><span>No Record Found</span></th></tr></div>";
									}
									?>
						 
									</div>
								</div>
<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
<div id="loader"></div>
</div>

<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>	 
$(document).ready(function(){
	$(document).on('change','.priceMasters',function()
		{
			var ab=$(this).closest('div').find('.priceMasters option:selected').val();
			//alert(ab);
			if(ab!=0)
			{
			var priceVal=$(this).closest('div').find('.priceMasters option:selected').attr('priceVal');
			var price=$(this).closest('div').find('.priceMasters option:selected').attr('price');
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
			$(this).closest('div.mainrow').find('.visible_date').val(date);
			$(this).closest('div.mainrow').find('.payment_amount').val(price);
			//alert($(this).closest('div.mainrow').html());
			}
			else{
				$(this).closest('div.mainrow').find('.visible_date').val("dd-mm-yyyy");
				$(this).closest('div.mainrow').find('.payment_amount').val(0);
			}
		});
	jQuery("form").submit(function(){
		jQuery("#loader-1").show();
	});
});
</script>