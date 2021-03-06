<?php  //echo $this->Html->css('/assets/loader-1.css'); ?>
<?php 
$cdn_path = $awsFileLoad->cdnPath();
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/EventPlannerPromotions/getEventPlanners.json?isLikedUserId=".$user_id."&higestSort=".$higestSort."&country_id=".$country_id."&city_id=".$city_id."&state_id=".$state_id."&search=".$search."&following=".$following."&submitted_from=web",
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
$eventPlannerPromotions=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$List=json_decode($response);
	//pr($List);exit;
 	$eventPlannerPromotions=$List->getEventPlanners;
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
<style type="text/css">
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
	line-height:15.0px;rowspace
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
<div class="container-fluid">
<?php if($roleId==2){?>
<a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'add')) ?>" target="_blank" id="ButtonforaddMore" title="Click Here to add Event Planner Promotion"><i class="fa fa-plus"></i></a>
<?php } ?>
	<div class="box box-primary" style="margin-bottom:5px;">
		<div class="row">
			<div class="col-md-12">
				<div class="box-header with-border"> 
					<span class="box-title" style="color:#057F8A;"><b><?= __('Event Planner') ?></b></span>
					<div class="box-tools pull-right" style="margin-top:-5px;">
						<a style="font-size:20px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
						<a style="font-size:20px" class="btn btn-box-tool" data-target="#demo" data-toggle="collapse" aria-expanded="false"> <i class="fa fa-filter"></i></a>
						<a style="font-size:20px" href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'savedList',$user_id),1);?>"  class="btn btn-box-tool" ><i class="fa fa-bookmark"></i> </a>
					</div>
				</div>
			</div>
		</div>
		<div class="row collapse"  id="demo" aria-expanded="false">
			<div class="col-md-12">
				<div class="box-header with-border">
				<form class="filter_box" method="get">
					<fieldset><legend>Filter</legend>
						<div class="row">
							<div class="col-md-12">
							 <div class="col-md-5" style="padding-top:8px;">
								 <label class="col-form-label" for=example-text-input>State:  </label>
									<div class="input-field" style="padding-top:8px;">
									<?php 
										$options=array();
										foreach($states as $st)
										{
											$options[] = ['value'=>$st->id,'text'=>$st->state_name];
										};
										echo $this->Form->input('state_id', ['options' => $options,'class'=>'form-control select2','label'=>false,"data-placeholder"=>"Select States",'empty'=>'Select...','multiple'=>true,'data-placeholder'=>'Select Multiple']); 
									?> 
									</div>
								</div>	
								<div class="col-md-5" style="padding-top:8px;">
									<label class="col-form-label" for=example-text-input>City:  </label>
									<div class="input-field" style="padding-top:8px;">
									<?php 
										$options=array();
										foreach($city->citystatefi as $cty)
										{
											$options[] = ['value'=>$cty->cityid,'text'=>$cty->name];
										};
										echo $this->Form->input('city_id', ['options' =>$options,'class'=>'form-control select2','label'=>false,"data-placeholder"=>"Select Cities",'empty'=>'Select...','multiple'=>true,'data-placeholder'=>'Select Multiple']); ?>
									</div>
								</div>	
								<div class="col-md-2" style="padding-top:8px;">
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
									<a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'report')) ?>"class="btn btn-warning  btn-sm">Reset</a>
									<button class="btn btn-success btn-sm" name="submit" value="Submit" type="submit">Apply</button> 
								</div>
							</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<!-------SHORTING FILTERING--------->
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
								<a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
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
						<td width="8%" style="padding-left:5px;"><a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'report')) ?>"class="btn btn-danger btn-sm" style="width:100%">Reset</a>
						</td></tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</form>		
<?php $i=0;
if(!empty($eventPlannerPromotions)){
foreach ($eventPlannerPromotions as $eventPlannerPromotion){$i++;
		$cityList=array();
		foreach($eventPlannerPromotion->event_planner_promotion_cities as $cities)
		{ 
			
			if($cities->city_id==0){@$cityList[]='All Cities';}
			else{
				@$cityList[]=$cities->city->name;
			}
		}
		
		$stateList=array();
		foreach($eventPlannerPromotion->event_planner_promotion_states as $states)
		{
			$stateList[]=$states->state->state_name;
		}
		$stateLists=implode(', ',array_unique($stateList));
		$cityLists=implode(', ',array_unique($cityList));
	?>
	<div class="box-body bbb">	
		<fieldset style="background-color:#fff;">
			<form method="post" class="formSubmit">
			<input type="hidden" name="event_id" value="<?php echo $eventPlannerPromotion->id; ?>">
				<div class="row">
					<div class="col-md-12" style="padding-top:5px;">
					<span style="font-size:18px;"><?php echo $eventPlannerPromotion->user->company_name; ?></span>
					</div>
					</div>
					<span class="help-block"></span>
				<div class="row">
					<div class="col-md-3">
					<?= $this->Html->image($cdn_path.$eventPlannerPromotion->image,['id'=>'myImg','style'=>'width:100%;height:109px;','data-target'=>'#imagemodal'.$eventPlannerPromotion->id,'data-toggle'=>'modal','promotionid'=>$eventPlannerPromotion->id,'userId'=>$user_id,'class'=>'viewCount']) ?>
					 
					<div id="imagemodal<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md">
						<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body">
								<button type="button" class="close" data-dismiss="modal" style="padding-right:8px !important;">&times;</button>
								<?= $this->Html->image($cdn_path.$eventPlannerPromotion->image,['style'=>'width:100%;;padding:20px;padding-top:0px!important;']) ?>
								</div>
							</div>
						</div>
					</div>
					<hr style="margin-top:4px !important"></hr>
					<div class="row" style="padding-top:5px;">					
						<input type="hidden" name="event_id" value="<?php echo $eventPlannerPromotion->id; ?>">
						<table  width="100%" style="text-align:center;" >
								<tr>
								<td width="25%" >
									<span><img src="../images/view.png" height="13px"/>
									<?= h($eventPlannerPromotion->total_views);?></span>
								</td>
								<td width="25%">
								<span><?php
									$dataUserId=$eventPlannerPromotion->user_id;
									$isLiked=$eventPlannerPromotion->isLiked;
									$issaved=$eventPlannerPromotion->issaved;
									//-- LIKES DISLIKE
									if($isLiked=='no'){
										echo $this->Form->button('<img src="../images/unlike.png" height="15px"/>',['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
									}
									if($isLiked=='yes'){
										echo $this->Form->button('<img src="../images/like.png" height="15px"/>',['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#F7F3F4;border:0px;']);
									}
									?>
									<?php echo $eventPlannerPromotion->total_likes; ?>
								</span>
								</td>
								<td width="25%">
									<?php 
									//-- Save Unsave
									if($issaved=='1'){
										echo $this->Form->button('<img src="../images/save.png" height="15px"/>',['class'=>'btn  btn-xs  ','value'=>'button','type'=>'submit','name'=>'saveeventplanner','style'=>'background-color:white;color:black;border:0px;']);
									}
									if($issaved=='0'){
										echo $this->Form->button('<img src="../images/unsave.png" height="15px"/>',['class'=>'btn btn-primary btn-xs ','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'saveeventplanner']);
									}
									?>
									<span style="visibility:hidden;">3</span>
								</td>
								<td width="25%">
									<?php echo $this->Html->link('<img src="../images/flag.png" height="15px"/>','#'.$eventPlannerPromotion->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#reportmodal'.$eventPlannerPromotion->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
								<span style="visibility:hidden;">3</span>
								</td>
							</tr>
							<div id="reportmodal<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md">
										<!-- Modal content-->
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h3 class="modal-title">Report</h3>
											  </div>
												<div class="modal-body">
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
																<textarea class="form-control " rows="3" type="text" placeholder="Enter Your Suggestion here..." name="comment"></textarea>	
																</div>
															</div>
														</div>
													</div>
													<span class="help-block"></span>
												</div>
												<div class="modal-footer" style="height:60px;">
													<input type="submit" class="btn btn-info btn-md" name="report_submit" value="Report">
													<button type="button" class="btn btn-danger btn-default" data-dismiss="modal">Cancel</button>
												</div>
											</div>
										</div>
									</div>
							<!-------Report Modal End--------->	
						</table>
					</div><hr></hr>
					</div>
					<div class="col-md-9 " style="padding-top:5px;">
						<div class="col-md-6">
							<div class="row rowspace">
								<div class="col-md-12 "><label>Cities of Operation: </label>
								<span ><?= h($cityLists); ?></span>
								</div>
							</div>
							<div class="row rowspace">
								<div class="col-md-12 "><label>States of Operation: </label>
								<span class=""><?= h($stateLists); ?></span>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row rowspace">
									<div class="col-md-12 "><label>Country: </label>
									<span class=""><?= h($eventPlannerPromotion->country->country_name);?></span>
									</div>
								</div>
								<div class="row rowspace">
									<div class="col-md-12"><label>Event Planner: </label>
										<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$eventPlannerPromotion->user_id),1);?>
											<u><a style="color:#d69d5c;" href="<?php echo $hrefurl; ?>"> 
												<?= h($eventPlannerPromotion->user->first_name.' '.$eventPlannerPromotion->user->last_name);?></u>
										
												<?php
												if($eventPlannerPromotion->user_rating==0)
												{
													echo "";
												}
												else{
														echo "(".$eventPlannerPromotion->user_rating." <i class='fa fa-star'></i>)";
													}
												?> Event Planner </a>
											</span>

									</div>
								</div>
							</div>
<div id="contactdetails<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm" >
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h3 class="modal-title">
			Seller Details
			</h3>
			</div>
			<div class="modal-body" style="padding-left:15px!important;">
				<div class="row rowspace">
					<div class="col-md-12">
						<label>Seller Name: </label>
							<span style="padding-top:2px;">
							<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$eventPlannerPromotion->user_id),1);?>
							<u><a style="color:#d69d5c;" href="<?php echo $hrefurl; ?>"> 
								<?= h($eventPlannerPromotion->user->first_name.' '.$eventPlannerPromotion->user->last_name);?></u>
						
								<?php
								if($eventPlannerPromotion->user_rating==0)
								{
									echo "";
								}
								else{
										echo "(".$eventPlannerPromotion->user_rating." <i class='fa fa-star'></i>)";
									}
								?></a>
						</span>
					</div>					
				</div>
				<div class="row rowspace">
					<div class="col-md-12" >
					<label>Mobile No: </label>
					<span class="label11"><?= h($eventPlannerPromotion->user->mobile_number);?></span>
					</div>
				</div>
				<div class="row rowspace">
					<div class="col-md-12" style="padding-top:2px;">
						<label>Email: </label>
						<span class="label11"><a href="mailto:<?php echo $eventPlannerPromotion->user->email;?>"><?= h($eventPlannerPromotion->user->email);?></a></span>
					</div>
				</div>
				<span class="help-block"></span>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>
<div id="eventdetail<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Event Planner Details</h3>
			  </div>
				<div class="modal-body" >
					<div class="row">
						<div class="col-md-12">
							<p style="padding:15px;"><?= h($eventPlannerPromotion->event_detail); ?></p>
						</div>
					</div>
				</div>
				<div class="modal-footer" >
					<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<div id="ReviewUser<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
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
											<input class="star star-5" id="star-5<?php echo $eventPlannerPromotion->id; ?>" type="radio" name="rating" <?php if($rate=="5") {echo "checked";} ?> value="5"/>
											<label class="star star-5" for="star-5<?php echo $eventPlannerPromotion->id; ?>"></label>
											<input class="star star-4" id="star-4<?php echo $eventPlannerPromotion->id; ?>" type="radio" name="rating" <?php if($rate=="4") {echo "checked";} ?> value="4"/>
											<label class="star star-4" for="star-4<?php echo $eventPlannerPromotion->id; ?>"></label>
											<input class="star star-3" id="star-3<?php echo $eventPlannerPromotion->id; ?>" type="radio" name="rating" <?php if($rate=="3") {echo "checked";} ?> value="3"/>
											<label class="star star-3" for="star-3<?php echo $eventPlannerPromotion->id; ?>"></label>
											<input class="star star-2" id="star-2<?php echo $eventPlannerPromotion->id; ?>" type="radio" name="rating" <?php if($rate=="2") {echo "checked";} ?> value="2"/>
											<label class="star star-2" for="star-2<?php echo $eventPlannerPromotion->id; ?>"></label>
											<input class="star star-1" id="star-1<?php echo $eventPlannerPromotion->id; ?>" type="radio" name="rating" <?php if($rate=="1") {echo "checked";} ?> value="1"/>
											<label class="star star-1" for="star-1<?php echo $eventPlannerPromotion->id; ?>"></label>
											<input style="display:none;" type="radio" name="rating" <?php if($rate=="0") {echo "checked";} ?> value="0"/>
										</div>
									</td>
								</tr>
								<tr>
								<input type="hidden" name="author_id" value="<?php echo $user_id;?>">
								<input type="hidden" name="promotion_type_id" value="3">
								<input type="hidden" name="user_id" value="<?php echo $eventPlannerPromotion->user_id;?>">
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
<div id="Following<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h3 class="modal-title">Are you sure you want to follow the user?</h3>
		  </div>
		  <div class="modal-footer" >
				<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
				<button type="submit" name="follow_user" class="btn btn-success btn-md" >Follow</button>
			</div>
		</div>
	</div>
</div>	
						<div class="col-md-12 text-center">
						<div class="row" style="padding-top:15px;">
							<div class="col-md-12">
								<button class="btn btn-info btn-md btnlayout viewCount" data-target="#eventdetail<?php echo $eventPlannerPromotion->id;?>" data-toggle="modal" promotionid="<?php echo $eventPlannerPromotion->id;?>" userId="<?php echo $user_id;?>" type="button">Planner Details</button>&nbsp;&nbsp;
								<button class="btn btn-danger btn-md btnlayout viewCount" data-target="#contactdetails<?php echo $eventPlannerPromotion->id;?>" data-toggle="modal" promotionid="<?php echo $eventPlannerPromotion->id;?>" userId="<?php echo $user_id;?>" type="button">Contact Info</button>
								<?php
									if($eventPlannerPromotion->user_id != $user_id){ ?>
										<button class="btn btn-success btn-md btnlayout viewCount" data-target="#ReviewUser<?php echo $eventPlannerPromotion->id;?>" data-toggle="modal" promotionid="<?php echo $eventPlannerPromotion->id;?>" userId="<?php echo $user_id;?>" type="button">Rate User</button>
								<?php	 
									if($eventPlannerPromotion->isfollows==0){ ?>
										<button class="btn btn-successto btn-md btnlayout viewCount" data-target="#Following<?php echo $eventPlannerPromotion->id;?>" data-toggle="modal" promotionid="<?php echo $eventPlannerPromotion->id;?>" userId="<?php echo $user_id;?>" type="button">Follow User</button>&nbsp;&nbsp;
									<?php } 
									else {?>
										<span style=";background-color:#dadadabf;display: inline-block;text-align: center;cursor: no-drop !important;"  class="btn btn-defult btn-md btnlayout viewCount"> Following </span>
									<?php }
									}									?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</fieldset>
</div>
<?php }}					
else
	{
		echo"<div class='row col-md-12 text-center'><tr><th colspan='10' ><span>No Record Found</span></th></tr></div>";
	}							?>
		<div class="maintbl2">
 			</div>
			<div class="col-md-12 text-center loading" id="" style="display:none">
				<?=  $this->Html->image('/img/loading.gif', ['style'=>'width:5%;','id'=>'imageofloagin']) ?> .
			</div>	 
		</div>
		 
<input type="hidden" id="page" value="2">
<input type="hidden" value="<?php echo $user_id; ?>" id="user_idfornext">
<input type="hidden" value="<?php echo $higestSort; ?>" id="higestSort">
<input type="hidden" value="" id="country_id">
<input type="hidden" value="<?php echo $state_id; ?>" id="state_id"> 
<input type="hidden" value="<?php echo $search; ?>" id="search">
<input type="hidden" value="<?php echo $city_id; ?>" id="city_id">
<input type="hidden" value="<?php echo $following; ?>" id="following"> 	
		
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
	<?php if($i>9){ ?>
		$(window).scroll(function() { 
			var scrollTop = $(window).scrollTop();
			var docHeight = $(document).height();
			var winHeight = $(window).height();
			var scrollPercent = (scrollTop) / (docHeight - winHeight);
			var scrollPercentRounded = Math.round(scrollPercent*100);
 			if ( scrollPercentRounded > 70 ) {
 				var t = $("#page").val();
				$('.loading').show();
				 
 				var starting_price = $("#starting_price").val();
				var duration_day_night = $("#duration_day_night").val();
				var category_id = $("#category_id").val();
				var country_id = $("#country_id").val();
				var higestSort = $("#higestSort").val();
				var search = $("#search").val();
				var city_id = $("#city_id").val();
				var following = $("#following").val();
				var valid_date = $("#valid_date").val();
				var user_id = $("#user_idfornext").val(); 
				$.ajax({
					url: "<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'moredata')) ?>",
					type: "POST",
					data: {
						user_id: user_id,
						higestSort: higestSort,
						country_id: country_id,
						category_id: category_id,
						duration_day_night: duration_day_night,
						search: search, 
						city_id: city_id, 
						following: following, 
						valid_date: valid_date, 
						starting_price: starting_price,  
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
	<?php } ?>
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
		var siteUrls="api/EventPlannerPromotions/getEventPlannersDetails.json?id="+promotionid+"&user_id="+userId;
		var mainUrl=siteUrl+siteUrls; 
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
