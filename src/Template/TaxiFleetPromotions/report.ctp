<?php //echo $this->Html->css('/assets/loader-1.css'); ?>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php 
//-- LIST 
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/TaxiFleetPromotions/getTaxiFleetPromotions.json?isLikedUserId=".$user_id."&higestSort=".$higestSort."&country_id=".$country_id."&city_id=".$city_id."&state_id=".$state_id."&car_bus_id=".$car_bus_id."&search=".$search."&following=".$following."&submitted_from=web",
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
$taxiFleetPromotions=array();
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
/// -- REPORT REASON
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/ReportReasons/reportReasonList.json?promotion_type_id=1",
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
	$reasonslist=$List->reasonslist;
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
<?php if($roleId==1){?>
<a href="<?php echo $this->Url->build(array('controller'=>'taxiFleetPromotions','action'=>'add')) ?>" target="_blank" id="ButtonforaddMore" title="Click Here to add Taxi/Fleet Promotion"><i class="fa fa-plus"></i></a>
<?php } ?>
	<div class="box box-primary" style="margin-bottom:5px;">
		<div class="row" >
			<div class="col-md-12">
				<div class="box-header with-border"> 
					<span class="box-title" style="color:#057F8A;"><b>Taxi/Fleet Promotions</b></span>
					<div class="box-tools pull-right" style="margin-top:-5px;">
						<a style="font-size:16px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
						<a style="font-size:23px" class="btn btn-box-tool " data-target="#demo" data-toggle="collapse"> <i class="fa fa-filter" aria-expanded="false"></i></a>
						<a style="font-size:20px" href="<?php echo $this->Url->build(array('controller'=>'TaxiFleetPromotions','action'=>'savedList',$user_id),1);?>" class="btn btn-box-tool" ><i class="fa fa-bookmark"></i></a>
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
								<div class="col-md-8" style="padding-top:8px;">
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
								<div class="col-md-4" style="padding-top:8px;">
									<div class="form-group" style="padding-top:10px;">
									<label class="col-form-label" for=example-text-input>&nbsp;  </label>
										<div class="checkbox">
											<label>
											  <input type="checkbox" name="following" value="following">
											  Following
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr ></hr>	
							<div class="row ">
								<div class="col-md-12 text-center" style="padding-top:12px;">
									<a href="<?php echo $this->Url->build(array('controller'=>'TaxiFleetPromotions','action'=>'report')) ?>"class="btn btn-warning  btn-sm">Reset</a>
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
						<a href="<?php echo $this->Url->build(array('controller'=>'TaxiFleetPromotions','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
					</div>
			  </div>
		</div>
		</form>
		</div>
		</div>
	</div>
<form method="get">
<div class="" style="margin-bottom:5px;">
	<div class="row">
		<div class="col-md-12">
			<div class="">
				<table width="100%"><tr><td width="80%"> 
					<input class="form-control" placeholder="Type Location, State, City etc." name="search"/></td>
					<td width="8%" style="padding-left:5px;"><button style="width:100%" class="btn btn-info btn-sm" name="submit" value="Submit" type="submit">Search</button></td>
					<td width="8%" style="padding-left:5px;"><a href="<?php echo $this->Url->build(array('controller'=>'TaxiFleetPromotions','action'=>'report')) ?>"class="btn btn-danger btn-sm" style="width:100%">Reset</a>
					</td></tr>
				</table>
			</div>
		</div>
	</div>
</div>
</form>
			<?php $i=1;
			if(!empty($taxiFleetPromotions)){
			foreach ($taxiFleetPromotions as $taxiFleetPromotion){
				$vehicleList=array(); 
				foreach($taxiFleetPromotion->taxi_fleet_promotion_rows as $vehicle)
				{
					$vehicleList[]=$vehicle->taxi_fleet_car_bus->name;
				}
				$cityList=array();
				foreach($taxiFleetPromotion->taxi_fleet_promotion_cities as $cities)
				{
					 
					if($cities->city_id==0){@$cityList[]='All Cities';}
					else{
						@$cityList[]=$cities->city->name;
					}
				}
				$stateList=array();
				foreach($taxiFleetPromotion->taxi_fleet_promotion_states as $statess)
				{ 
					$stateList[]=$statess->state->state_name;
				}
				$vehicleLists=implode(', ',array_unique($vehicleList));
				$stateLists=implode(', ',array_unique($stateList));
				$cityLists=implode(', ',array_unique($cityList));
				$i++; ?>
	
	<div class="box-body bbb">	
			<fieldset style="background-color:#fff;">
				<form method="post" class="formSubmit">
					<div class="row">
						<div class="col-md-12" style="padding-top:5px;">
						<span style="font-size:18px;"><?= h($taxiFleetPromotion->title) ?></span>
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
								<td width="25%">
									<span>
									<?php
									//pr($taxiFleetPromotion);
										$dataUserId=$taxiFleetPromotion->user_id;
										$isLiked=$taxiFleetPromotion->isLiked;
										$issaved=$taxiFleetPromotion->issaved;
										//-- LIKES DISLIKE
										if($isLiked=='no'){
											echo $this->Form->button('<img src="../images/unlike.png" height="15px"/>',['class'=>'likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
											
										}
										if($isLiked=='yes'){
											echo $this->Form->button('<img src="../images/like.png" height="15px"/>',['class'=>' likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#F7F3F4;border:0px;']);
										}?>
								<?= h($taxiFleetPromotion->total_likes);?></span>
								</td>
								<td width="25%">
								<?php 
									//-- Save Unsave
									if($issaved=='1'){
										echo $this->Form->button('<img src="../images/save.png" height="15px"/>',['class'=>' ','value'=>'button','type'=>'submit','name'=>'savetaxifleet','style'=>'background-color:white;color:black;border:0px;']);
									}
									if($issaved=='0'){
										echo $this->Form->button('<img src="../images/unsave.png" height="15px"/>',['class'=>'','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'savetaxifleet']);
									}
									?>
									
									<span style="visibility:hidden;">3</span>
								</td>
								<td width="25%">
								<?php echo $this->Html->link('<img src="../images/flag.png" height="15px"/>','#'.$taxiFleetPromotion->id,array('escape'=>false,'class'=>'','data-target'=>'#reportmodal'.$taxiFleetPromotion->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
								<span style="visibility:hidden;">3</span>
								</td>
								</tr>
								</table>
							<!-------Report Modal Start--------->
							<div id="reportmodal<?php echo $taxiFleetPromotion->id;?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-md">
									<!-- Modal content-->
										<div class="modal-content">
										  <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h3 class="modal-title">Report</h3>
										  </div>
											<div class="modal-body" >
											<span class="help-block"></span>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-3">
															<span>
																Select Reason
															</span>
														</div>
														<div class="col-md-9">
															<div class="input-field reason_list">
																<?php 
																	$options=array();
																	foreach($reasonslist as $sts)
																	{
																		$options[] = ['value'=>$sts->id,'text'=>$sts->reason];
																	};
																	echo $this->Form->control('report_reason_id', ['label'=>false, "type"=>"select",'options' =>$options, "class"=>"form-control select2 reason_box","data-placeholder"=>"Select... ","style"=>"height:125px;",'empty'=>"Select..."]);
																?>
															</div>
														</div>
													</div>
												</div><br>
												<div class="row report_text"  style="display:none;">
													<div class="col-md-12">
														<div class="col-md-3">
														</div>
														<div class="col-md-9">
															<div >
															<textarea class="form-control " rows="3" type="text" placeholder="Enter Your Reason here..." name="comment"></textarea>	
															</div>
														</div>
													</div>
												</div><span class="help-block"></span>
											</div>
											<div class="modal-footer" style="height:60px;">
												<input type="submit" class="btn btn-info btn-md" name="report_submit" value="Report">
												<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancel</button>
											</div>
										</div>
									</div>
								</div>
							</div><hr></hr>
						</div>
							<div class="col-md-9">
								<div class="row col-md-12 rowspace" style="padding-top:8px;">
										<div class="col-md-12">
										<label>Category: </label>
										<span ><?= h($vehicleLists); ?></span>
										</div>
								</div>
								<div class="col-md-7">
									<div class="row rowspace" >
										<div class="col-md-12"><label ><?= __(' Cities of Operation') ?>: </label>
										<span><?= h($cityLists); ?></span>
										</div>
									</div>
									<div class="row rowspace" >
										<div class="col-md-12"><label ><?= __(' States of Operation') ?>: </label>
										<span ><?= h($stateLists); ?> </span>
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
												<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$taxiFleetPromotion->user_id),1);?>
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
									<div class="row rowspace" >
										<div class="col-md-12"><label>Company Name: </label>
										<span><?= h($taxiFleetPromotion->user->company_name); ?></span>
										</div>					
									</div>
									
									<!-----button list-->
							
													</div>
<div class="row" style="padding-top:15px;">
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
							<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$taxiFleetPromotion->user_id),1);?>
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
<div id="ReviewUser<?php echo $taxiFleetPromotion->id;?>" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Review/Rating</h3>
			  </div>
				<div class="modal-body" >
					<div class="row">
						<div class="col-md-12 text-center">
							<table width="90%" border="0" height="142px">
								<tr>
									<td><label class="control-label" for="Rating">Rating :</label></td>
									<td>
									<?php $rate=0;?>
										<div class="pull-left">
											<input class="star star-5" id="star-5<?php echo $taxiFleetPromotion->id; ?>" type="radio" name="rating" <?php if($rate=="5") {echo "checked";} ?> value="5"/>
											<label class="star star-5" for="star-5<?php echo $taxiFleetPromotion->id; ?>"></label>
											<input class="star star-4" id="star-4<?php echo $taxiFleetPromotion->id; ?>" type="radio" name="rating" <?php if($rate=="4") {echo "checked";} ?> value="4"/>
											<label class="star star-4" for="star-4<?php echo $taxiFleetPromotion->id; ?>"></label>
											<input class="star star-3" id="star-3<?php echo $taxiFleetPromotion->id; ?>" type="radio" name="rating" <?php if($rate=="3") {echo "checked";} ?> value="3"/>
											<label class="star star-3" for="star-3<?php echo $taxiFleetPromotion->id; ?>"></label>
											<input class="star star-2" id="star-2<?php echo $taxiFleetPromotion->id; ?>" type="radio" name="rating" <?php if($rate=="2") {echo "checked";} ?> value="2"/>
											<label class="star star-2" for="star-2<?php echo $taxiFleetPromotion->id; ?>"></label>
											<input class="star star-1" id="star-1<?php echo $taxiFleetPromotion->id; ?>" type="radio" name="rating" <?php if($rate=="1") {echo "checked";} ?> value="1"/>
											<label class="star star-1" for="star-1<?php echo $taxiFleetPromotion->id; ?>"></label>
											<input style="display:none;" type="radio" name="rating" <?php if($rate=="0") {echo "checked";} ?> value="0"/>
										</div>
									</td>
								</tr>
								<tr>
								<input type="hidden" name="author_id" value="<?php echo $user_id;?>">
								<input type="hidden" name="promotion_type_id" value="2">
								<input type="hidden" name="user_id" value="<?php echo $taxiFleetPromotion->user_id;?>">
									<td><label class="control-label" for="Comment">Comment :</label></td>
									<td> <textarea name="comment" class="form-control input-large" rows="2"  id="comment"></textarea> 
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer" >
					<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
					<button type="submit" name="rate_user" class="btn btn-success btn-md rate_user" >Submit</button>
				</div>
			</div>
		</div>
	</div>		
														<div class="col-md-12 text-center" style="padding-top:10px">
															<button class="btn btn-info btn-md btnlayout viewCount" data-target="#fleetdetail<?php echo $taxiFleetPromotion->id;?>" promotionid="<?php echo $taxiFleetPromotion->id;?>" userId="<?php echo $user_id;?>" data-toggle="modal" type="button">Fleet Details</button>&nbsp;&nbsp;
															<button class="btn btn-danger btn-md btnlayout viewCount" data-target="#contactdetails<?php echo $taxiFleetPromotion->id;?>" data-toggle="modal" promotionid="<?php echo $taxiFleetPromotion->id;?>" userId="<?php echo $user_id;?>" type="button">Contact Info</button>&nbsp;&nbsp;
															<?php
															if($taxiFleetPromotion->user_id != $user_id){ ?>
																<button class="btn btn-success btn-md btnlayout viewCount" data-target="#ReviewUser<?php echo $taxiFleetPromotion->id;?>" data-toggle="modal" promotionid="<?php echo $taxiFleetPromotion->id;?>" userId="<?php echo $user_id;?>" type="button">Rate User</button>&nbsp;&nbsp;
															<?php	}
															?>
														</div>
														</div>
												</div>
											</div>
										</form>	
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
<div class="maintbl2">
</div>
<input type="hidden" id="page" value="2">
<input type="hidden" value="<?php echo $user_id; ?>" id="user_idfornext">
<input type="hidden" value="<?php echo $higestSort; ?>" id="higestSort">
<input type="hidden" value="<?php echo $car_bus_id; ?>" id="car_bus_id">
<input type="hidden" value="<?php echo $state_id; ?>" id="state_id"> 
<input type="hidden" value="<?php echo $search; ?>" id="search">
<input type="hidden" value="<?php echo $city_id; ?>" id="city_id">
<input type="hidden" value="<?php echo $following; ?>" id="following"> 

<div class="col-md-12 text-center loading" id="" style="display:none">
	<?=  $this->Html->image('/img/loading.gif', ['style'=>'width:5%;','id'=>'imageofloagin']) ?> .
</div>
<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
<div id="loader"></div>
</div>

<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>	 
  $(document).ready(function(){
		$(document).on('click','.rate_user',function(){
 			if($(this).closest('div.modal-content').find("input[name='rating']:checked").val() >0 ){
			}
			else
			{
				alert("Please Select Rating.");
				return false;
			}
		});
		$(window).scroll(function() {
			 
			var scrollTop = $(window).scrollTop();
			var docHeight = $(document).height();
			var winHeight = $(window).height();
			var scrollPercent = (scrollTop) / (docHeight - winHeight);
			var scrollPercentRounded = Math.round(scrollPercent*100);
 			if ( scrollPercentRounded > 70 ) {
 				var t = $("#page").val();
				$('.loading').show();
				var user_id = $("#user_idfornext").val(); 
				var higestSort = $("#higestSort").val();
 				var car_bus_id = $("#car_bus_id").val(); 
				var state_id = $("#state_id").val(); 
				var search = $("#search").val();
				var city_id = $("#city_id").val();
				var following = $("#following").val(); 
				$.ajax({
					url: "<?php echo $this->Url->build(array('controller'=>'TaxiFleetPromotions','action'=>'moredata')) ?>",
					type: "POST",
					data: {
						user_id: user_id,
						higestSort: higestSort, 
						state_id: state_id, 
						search: search, 
						city_id: city_id, 
						following: following,   
						car_bus_id: car_bus_id,  
						page: t
					}
				}).done(function(e) {
					 
 					$('.loading').hide();
					if(e!=''){ 
						var pagenew = parseInt(t)+1;
						$('.maintbl'+t).html(e);
						$("#page").val(pagenew);						
					}
					else {  
						$('.loading').html('');
					}
					
				});
			}
		});

	$('.reason_box').on('change', function() {
		  //var b=$(this);
		  var a=$(this).closest("div").find(" option:selected").val();
			if(a == '5')
			  {
				$(".report_text").show();
			  }
			  else
			  {
				$(".report_text").hide();
			  }
		});
		jQuery("form").submit(function(){
			jQuery("#loader-1").show();
		});
	$(document).on('click','.viewCount',function()
	{
		var promotionid=$(this).attr('promotionid');
		var userId=$(this).attr('userId');
		
		var siteUrl='<?php echo $coreVariable['SiteUrl']; ?>';
		var siteUrls="api/TaxiFleetPromotions/getTaxiFleetPromotionsDetails.json?id="+promotionid+"&user_id="+userId;
		var mainUrl=siteUrl+siteUrls; 
		//alert(mainUrl);
		$.ajax({
			url: mainUrl,
			processData: false,
			contentType: false,
			type: 'GET',
			success: function(data)
			{
			}
		});
	});
  });
</script>