<?php  //echo $this->Html->css('/assets/loader-1.css'); ?>
<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/EventPlannerPromotions/getEventPlanners.json?isLikedUserId=".$user_id."&higestSort=".$higestSort."&country_id=".$country_id."&city_id=".$city_id."&state_id=".$state_id."&search=".$search."&submitted_from=web",
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
	//pr($List);exit;
 	$eventPlannerPromotions=$List->getEventPlanners;
}
//pr($eventPlannerPromotions);
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
							 <div class="col-md-6" style="padding-top:8px;">
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
								<div class="col-md-6" style="padding-top:8px;">
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
							 
							</div>
						</div>
						<hr ></hr>	
							<div class="row ">
								<div class="col-md-12 text-center" style="padding-top:12px;">
									<a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'package_report')) ?>"class="btn btn-warning  btn-sm">Reset</a>
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
								<a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'package_report')) ?>"class="btn btn-danger btn-sm">Reset</a>
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
						<td width="8%" style="padding-left:5px;"><a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'package_report')) ?>"class="btn btn-danger btn-sm" style="width:100%">Reset</a>
						</td></tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</form>		
<?php $i=1;
if(!empty($eventPlannerPromotions)){
foreach ($eventPlannerPromotions as $eventPlannerPromotion){
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
		//pr($eventPlannerPromotion);
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
					<?= $this->Html->image($eventPlannerPromotion->full_image,['id'=>'myImg','style'=>'width:100%;height:80px;','data-target'=>'#imagemodal'.$eventPlannerPromotion->id,'data-toggle'=>'modal','promotionid'=>$eventPlannerPromotion->id,'userId'=>$user_id,'class'=>'viewCount']) ?>
					 
					<div id="imagemodal<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md">
						<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body" >
								<button type="button" class="close" data-dismiss="modal" style="padding-right:8px !important;">&times;</button>
								<?= $this->Html->image($eventPlannerPromotion->full_image,['style'=>'width:100%;;padding:20px;padding-top:0px!important;']) ?>
								</div>
							</div>
						</div>
					</div>
					<hr></hr>
					<div class="row" style="padding-top:5px;">					
						<input type="hidden" name="event_id" value="<?php echo $eventPlannerPromotion->id; ?>">
							<table  width="100%" style="text-align:center;" >
								<tr>
								<td width="25%" >
									<span><img src="../images/view.png" height="13px"/>
									<?= h($eventPlannerPromotion->total_views);?></span>
								</td>
								<td width="25%" >
									<span><img src="../images/unlike.png" height="13px"/>
									<?= h($eventPlannerPromotion->total_likes);?></span>
								</td>
								<td width="25%" >
									<span><img src="../images/unsave.png" height="14px"/>
									<?= h($eventPlannerPromotion->total_saved);?></span>
								</td>
								<td width="25%" >
									<span><img src="../images/flag.png" height="15px"/>
									<?= h($eventPlannerPromotion->total_flagged);?></span>
								</td>
							</tr>
						</table>
					</div>
					<hr></hr>
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
							<div class="row rowspace">
								<div class="col-md-12 "><label>Country: </label>
								<span class=""><?= h($eventPlannerPromotion->country->country_name);?></span>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row rowspace">
								<div class="col-md-12 "><label>Created Date: </label>
								<span class=""><?= h(date('d-m-Y',strtotime($eventPlannerPromotion->created_on)));?></span>
								</div>
							</div>
							<div class="row rowspace">
								<div class="col-md-12 "><label>Expiring On: </label>
								<span class=""><?= h(date('d-m-Y',strtotime($eventPlannerPromotion->visible_date)));?></span>
								</div>
							</div>
							<div class="row rowspace">
								<div class="col-md-12 "><label>Event Planner: </label>
									<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'adminviewprofile',$eventPlannerPromotion->user_id),1);?>
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
															<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'adminviewprofile',$eventPlannerPromotion->user_id),1);?>
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
						<div class="col-md-12 text-center">
						<div class="row" style="padding-top:15px;">
							<div class="col-md-12">
								<button style="margin-top:5px" class="btn btn-info btn-md btnlayout" data-target="#eventdetail<?php echo $eventPlannerPromotion->id;?>" data-toggle="modal" promotionid="<?php echo $eventPlannerPromotion->id;?>" userId="<?php echo $user_id;?>" type="button">Planner Details</button>&nbsp;&nbsp;
								
								<button style="margin-top:5px" class="btn btn-success btn-md btnlayout" data-target="#contactdetails<?php echo $eventPlannerPromotion->id;?>" data-toggle="modal" promotionid="<?php echo $eventPlannerPromotion->id;?>" userId="<?php echo $user_id;?>" type="button">Contact Info</button>&nbsp;&nbsp;
								
								<a style="margin-top:5px" href="adminview/<?php echo $eventPlannerPromotion->id; ?>" class="btn btn-warning btn-md btnlayout" > Details</a>&nbsp;&nbsp;
								
								<!--<a style="margin-top:5px" href="<?php echo $this->Url->build(["controller" => "EventPlannerPromotions",'action'=>'adminedit/'.$eventPlannerPromotion->id]); ?>" class="btn btn-successto btn-md btnlayout" >Edit Event</a>&nbsp;&nbsp;-->
								
								<button style="margin-top:5px" type="button" class="btn btn-danger btn-md btnlayout" data-target="#remove<?php echo $eventPlannerPromotion->id; ?>" data-toggle=modal>Remove Event</button>
								<!-------Contact Details Modal --------->
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
				<div id="remove<?php echo $eventPlannerPromotion->id; ?>" class="modal fade" role="dialog">
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
									<div class="modal-footer" >
										<button type="submit"  class="unfollow btn btn-success btn-md" value="yes" name="remove_promotion">Yes</button>
										<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
									</div>
								</div>
								<input type="hidden" name="remove_package_id" value="<?php echo $eventPlannerPromotion->id; ?>"/>
							</form>
						</div>
					</div>

	</fieldset>
</div>
<?php }}					
else
	{
		echo"<div class='row col-md-12 text-center'><tr><th colspan='10' ><span>No Record Found</span></th></tr></div>";
	}							?>
			 
		</div>
		<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
					<div id="loader"></div>
					</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>	 
$(document).ready(function(){
 	jQuery("form").submit(function(){
		jQuery("#loader-1").show();
	});
 });
</script>
