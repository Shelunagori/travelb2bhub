<?php

 if(!empty($duration_day_night)){
	$duration_day_night=explode(',', $duration_day_night);

	foreach($duration_day_night as $daataa){
		if($daataa==1){$duration_day_nights[]='1 N/2 D';}
		if($daataa==2){$duration_day_nights[]='2 N/3 D';}
		if($daataa==3){$duration_day_nights[]='3 N/4 D';}
		if($daataa==4){$duration_day_nights[]='4 N/5 D';}
		if($daataa==5){$duration_day_nights[]='5 N/6 D';}
		if($daataa==6){$duration_day_nights[]='6 N/7 D';}
		if($daataa==7){$duration_day_nights[]='7 N/8 D';}
		if($daataa==8){$duration_day_nights[]='8 N/9 D';}
		if($daataa==9){$duration_day_nights[]='9 N/10 D';}
		if($daataa==10){$duration_day_nights[]='10 N/11 D';}
		if($daataa==11){$duration_day_nights[]='11 N/12 D';}
		if($daataa==12){$duration_day_nights[]='12 N/13 D';}
		if($daataa==13){$duration_day_nights[]='13 N/14 D';}
		if($daataa==14){$duration_day_nights[]='14 N/15 D';}
		if($daataa==15){$duration_day_nights[]='More than 15 Days';}
	}
	if(!empty($duration_day_nights)) {$duration_day_night=implode(',',$duration_day_nights);}
}
 //-- List
 
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/PostTravlePackages/getTravelPackages.json?isLikedUserId=".$user_id."&higestSort=".$higestSort."&country_id=".$country_id."&category_id=".$category_id."&duration_day_night=".$duration_day_night."&starting_price=".$starting_price."&city_id=".$city_id."&search=".$search."&valid_date=".$valid_date."&submitted_from=web",
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
	$postTravlePackages=$List->getTravelPackages;
}
//pr($postTravlePackages); exit;
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
//--- Category
$curl = curl_init();
 
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/post_travle_package_categories/index.json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 39e85539-7745-db54-4f15-121a9d912dc7"
  ),
));
$responsecat = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $Category=json_decode($responsecat);
  $cat=$Category->postTravlePackageCategories;
 
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
	//pr($priceMasters);exit;
	$priceMasters=$priceMasters->PriceMasters;
}
?>
<?php //490pr($postTravlePackages);?>
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
<div class="container-fluid">
<?php if($roleId==1){?>
<a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'add')) ?>" target="_blank" id="ButtonforaddMore" title="Click Here to add Package Promotion"><i class="fa fa-plus"></i></a>
<?php } ?>
	<div class="box box-primary" style="margin-bottom:5px;">
		<div class="row">
			<div class="col-md-12">
				<div class="box-header with-border"> 
					<span class="box-title" style="color:#057F8A;"><b>Package Promotions</b></span>
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
						<div class="row ">
							<div class="col-md-12">
								 <div class="col-md-6" style="padding-top:8px;">
									<label class="col-form-label"for=example-text-input>Country: </label>
									 <div class="input-field" style="padding-top:4px;">
										<?php $options=array();
										foreach($countries as $country)
										{
											$options[] = ['value'=>$country->id,'text'=>$country->country_name];
										};echo $this->Form->input('country_id', ['options' => $options,'class'=>'form-control select2 cntry','label'=>false,'empty'=>'Select...',"multiple"=> true,'data-placeholder'=>"Select Multiple"]);
										?>
									</div>
								</div>
								 <div class="col-md-6" style="padding-top:8px;">
									<label class="col-form-label"for=example-text-input>City: </label>
									 <div class="input-field" id="mcity" style="padding-top:4px;">
										<?php
										echo $this->Form->input('city_id', ['options' => array(),'class'=>'form-control select2 cntry','label'=>false,'empty'=>'Select...',"multiple"=> true,'data-placeholder'=>"Select (Country Selection Required)"]); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="row ">
							<div class="col-md-12">
								<div class="col-md-6" style="padding-top:8px;">
								 <label class="col-form-label" for=example-text-input>Select Package Duration: </label>
								 <div class="input-field" style="padding-top:4px;">
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
								<div class="col-md-6" style="padding-top:8px;">
									<label class="col-form-label" for=example-text-input>Starting Price: </label>
									<div class="input-field" style="padding-top:4px;">
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
							<div class="row ">
								<div class="col-md-12">
									<div class="col-md-6" style="padding-top:8px;">
									 <label class="col-form-label" for=example-text-input>Select Package Category: </label>
									 <div class="input-field" style="padding-top:4px;">
										<?php 
											$options=array();
											foreach($cat as $sts)
											{
												$options[] = ['value'=>$sts->id,'text'=>$sts->name];
											};
											echo $this->Form->control('category_id', ['label'=>false,"id"=>"multi_category", "type"=>"select",'options' =>$options, "class"=>"form-control select2","data-placeholder"=>"Select... ","style"=>"height:125px;",'empty'=>'Select...',"multiple"=> true,'data-placeholder'=>"Select Multiple"]);?>
										 </div>
									</div>	
									<div class="col-md-6 form-group" style="padding-top:8px;">
									<label class="col-form-label" for="from">
										Package Valid Till
									</label>
									<div class="input-field" style="padding-top:4px;">
										<?php echo $this->Form->input('valid_date',['class'=>'form-control date-picker date requiredfield','label'=>false,'data-date-format'=>'dd-mm-yyyy','placeholder'=>'Select Date']);?>
										<label style="display:none" class="helpblock error" > This field is required.</label>
									</div>
								</div>
								</div>	
							</div>
							<hr style="margin-top: 0px !important;margin-bottom: 0px !important;"></hr>	
							<div class="row ">
								<div class="col-md-12 text-center" style="padding-top:12px;">
									<a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'package_report')) ?>"class="btn btn-warning  btn-sm">Reset</a>
									<button class="btn btn-success btn-sm" name="submit" value="Submit" type="submit">Apply</button> 
									</div>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
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
								<a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'package_report')) ?>"class="btn btn-danger  btn-sm">Reset</a>
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
					<td width="8%" style="padding-left:5px;"><a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'package_report')) ?>"class="btn btn-danger btn-sm" style="width:100%">Reset</a>
					</td></tr>
				</table>
			</div>
		</div>
	</div>
</div>
</form>

		<?php $i=1;
					//pr($postTravlePackages); exit;			
					if(!empty($postTravlePackages)){
						foreach ($postTravlePackages as $postTravlePackage): 
							$CategoryList=array();
							foreach($postTravlePackage->post_travle_package_rows as $category)
							{
								$CategoryList[]=$category->post_travle_package_category->name;
							}
							$cityList=array();
							foreach($postTravlePackage->post_travle_package_cities as $cities)
							{
								$cityList[]=$cities->city->name." (".$cities->city->state->state_name.")";
							}
							$countryList=array();
							$p=0;
							foreach($postTravlePackage->post_travle_package_countries as $countries)
							{
								$countryList[]=$countries->country->country_name;
							} 
							$CategoryLists=implode(', ',array_unique($CategoryList));
							$countryLists=implode(', ',array_unique($countryList));
							$cityLists=implode(', ',array_unique($cityList));
						?>

<div class="box-body bbb">
 <fieldset style="background-color:#fff;">
	<form method="post" class="formSubmit">
		<div class="row">
			<div class="col-md-12" style="padding-top:5px;">
				<span style="font-size:17px;"><?= h($postTravlePackage->title) ?></span>
					<button class="close" style="margin-top: -12px; font-size:20px;font-size: 26px;" type="button" data-target="#remove<?php echo $postTravlePackage->id; ?>" data-toggle=modal>&times;</button>
				</div>
			</div> 
			<span class="help-block"></span>
			<div class="row ">						
				<div class="col-md-3">
				<?= $this->Html->image($postTravlePackage->full_image,['id'=>'myImg','style'=>'width:100%;height:80px;','data-target'=>'#imagemodal'.$postTravlePackage->id,'data-toggle'=>'modal','promotionid'=>$postTravlePackage->id,'userId'=>$user_id,'class'=>'viewCount']) ?>
					<div id="imagemodal<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md">
						<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body" >
								<button type="button" class="close" data-dismiss="modal" style="padding-right:8px !important;">&times;</button>
								<?= $this->Html->image($postTravlePackage->full_image,['style'=>'width:100%;padding:20px;padding-top:0px!important;','promotionid'=>$postTravlePackage->id,'userId'=>$user_id,'class'=>'viewCount']) ?>
								</div>
							</div>
						</div>
					</div><hr></hr>
					<div class="row" style="padding-top:5px;">
						<input type="hidden" name="posttravle_id" value="<?php echo $postTravlePackage->id; ?>">
							<table  width="100%" style="text-align:center;" >
								<tr>
									<td width="25%" >
										<span><img src="../images/view.png" height="13px"/>
										<?= h($postTravlePackage->total_views);?></span>
									</td>
									<td width="25%" >
										<span><img src="../images/unlike.png" height="14px"/>
										<?= h($postTravlePackage->total_likes);?></span>
									</td>
									<td width="25%" >
										<span><img src="../images/unsave.png" height="14px"/>
										<?= h($postTravlePackage->total_saved);?></span>
									</td>
									<td width="25%" >
										<span><img src="../images/flag.png" height="15px"/>
										<?= h($postTravlePackage->total_flagged);?></span>
									</td>
								</tr>
							</table>
						</div>	
						<hr></hr>
				</div>		 
										<span class="help-block"></span>
										<div class="col-md-9">
											<div class="row col-md-12 rowspace">
													<div class="col-md-12">
													<label>Category: </label>
													<span ><?= h($CategoryLists); ?></span>
													</div>
											</div>
											<div class="col-md-4">
												<div class="row rowspace">
													<div class="col-md-12 "><label>Package Duration: </label>
													<span style="color:#FB6542;"><?= h($postTravlePackage->duration_day_night) ?></span>
													</div>
												</div>
												<div class="row rowspace">
													<div class="col-md-12 ">
													<label>Starting Price: </label>
													<span style="color:#1295AB">&#8377; <?php echo (h($postTravlePackage->starting_price)) ;?></span>
													</div>
												</div>
												
												<div class="row rowspace">
													<div class="col-md-12 "><label>Seller: </label>
													<span><u>
														<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'adminviewprofile',$postTravlePackage->user_id),1);?>
														<a style="color:#d69d5c" href="<?php echo $hrefurl; ?>">
														<?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name);?></u>
														<?php
														if($postTravlePackage->user_rating==0)
														{
															echo "";
														}
														else{
																echo "(".$postTravlePackage->user_rating." <i class='fa fa-star'></i>)";
															}
														?></a>
													</span>
													</div>					
												</div>
												<div class="row rowspace">
													<div class="col-md-12 ">
													<label>Date Posted: </label>
													<span style="color:#black"> <?php echo date('d-M-Y',strtotime($postTravlePackage->created_on)) ; ?></span>
													</div>
												</div>
												<div class="row rowspace">
													<div class="col-md-12">
													<label>Expiring On: </label>
													<span style="color:#FB6542">  <?php echo date('d-M-Y',strtotime($postTravlePackage->visible_date)) ; ?></span>
													</div>
												</div> 
											</div>
											<div class="col-md-8">
											<div class="row rowspace" >
													<div class="col-md-12"><label>Valid Till: </label>
													<span><?= h(date('d-M-Y',strtotime($postTravlePackage->valid_date))); ?></span>
													</div>					
												</div>	
												<div class="row rowspace" >
													<div class="col-md-12"><label>Cities: </label>
													<span ><?= h($cityLists); ?></span>
													</div>
												</div>
												<div class="row rowspace">
													<div class="col-md-12"><label>Countries: </label>
													<span ><?= h($countryLists);?></span>
													</div>
												</div>
												
												<div class="row rowspace" style="visibility:hidden;">
													<div class="col-md-12">
													<label>Expiring On: </label>
													<span style="color:#FB6542">  <?php echo date('d-M-Y',strtotime($postTravlePackage->visible_date)) ; ?></span>
													</div>
												</div>
												
					<div id="Inclusion<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md">
							<!-- Modal content-->
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<span class="modal-title">Including in Package</span>
								  </div>
									<div class="modal-body" >
										<div class="row ">
											<div class="col-md-12" style="padding:15px;">
											<div class="col-md-12">
												<span ><?= h($postTravlePackage->package_detail); ?></span>
											</div>
											</div>
										</div>
									</div>
									<div class="modal-footer" >
										<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</div>
						</div>
						<div id="Exclusion<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md">
							<!-- Modal content-->
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<span class="modal-title">Excluded from Package</span>
								  </div>
									<div class="modal-body" >
										<div class="row ">
											<div class="col-md-12" style="padding:15px;">
											<div class="col-md-12">
												<span ><?= h($postTravlePackage->excluded_detail); ?></apan>
											</div>
											</div>
										</div>
									</div>
									<div class="modal-footer" >
										<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</div>
						</div>
						<div id="contactdetails<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
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
												<span class="help-block"></span>
												<div class="row" >
													<div class="col-md-12"><label>Seller Name: </label>
													<span style="padding-top:2px;"><u>
															<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'adminviewprofile',$postTravlePackage->user_id),1);?>
															<a style="color:#d69d5c" href="<?php echo $hrefurl; ?>"> 
															<?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name);?></u>
															<?php
															if($postTravlePackage->user_rating==0)
															{
																echo "";
															}
															else{
																	echo "(".$postTravlePackage->user_rating." <i class='fa fa-star'></i>)";
																}
															?></a></span>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
													<label>	Mobile No: </label>
													<span >
													<?= h($postTravlePackage->user->mobile_number);?>
													</span>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<label>Email: </label>
														<span >
														<a href="mailto:<?php echo $postTravlePackage->user->email;?>"><?= h($postTravlePackage->user->email);?></a>
														</span>
													</div>
												</div>
												<div class="row" style="display:none;">
													<div class="col-md-12">
														Location: 
														<div >
														<?= h($postTravlePackage->user->location);?>
														</div>
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
								
										</div>
								<div class="" style="padding-top:15px;">
									<div class="col-md-12 text-center" >
										<button style="margin-top:5px" class="btn btn-info btn-md btnlayout viewCount" data-target="#Inclusion<?php echo $postTravlePackage->id;?>" data-toggle="modal"  promotionid="<?php echo $postTravlePackage->id;?>" userId="<?php echo $user_id;?>" type="button">Inclusions</button>&nbsp;&nbsp;
										
										<button style="margin-top:5px" class="btn btn-warning btn-md btnlayout viewCount" data-target="#Exclusion<?php echo $postTravlePackage->id;?>"   promotionid="<?php echo $postTravlePackage->id;?>" userId="<?php echo $user_id;?>" data-toggle="modal" type="button">Exclusions</button>&nbsp;&nbsp;
										
										<button style="margin-top:5px" class="btn btn-danger btn-md  btnlayout viewCount" data-target="#contactdetails<?php echo $postTravlePackage->id;?>" promotionid="<?php echo $postTravlePackage->id;?>" data-toggle="modal" userId="<?php echo $user_id;?>" type="button">Contact Info</button>
										
										<button style="margin-top:5px;" type="button" class="btn btn-success btn-md btnlayout" data-target="#renew<?php echo $postTravlePackage->id; ?>" data-toggle=modal>Renew</button>&nbsp;&nbsp;
									
										<a style="margin-top:5px" href="<?php echo $this->Url->build(["controller" => "PostTravlePackages",'action'=>'edit/'.$postTravlePackage->id]); ?>" class="btn btn-successto btn-md btnlayout" >Edit Event</a>&nbsp;&nbsp;
										
										
											
									</div>
					<div id="remove<?php echo $postTravlePackage->id; ?>" class="modal fade" role="dialog">
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
										<button type="submit"  class="unfollow btn btn-success btn-md" value="yes" name="removepackage">Yes</button>
										<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
									</div>
								</div>
								<input type="hidden" name="remove_package_id" value="<?php echo $postTravlePackage->id; ?>"/>
							</form>
						</div>
					</div>
					<div id="renew<?php echo $postTravlePackage->id; ?>" class="modal fade" role="dialog">
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
														<label for="from">
															Payment Duration
														</label>
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
														<label for="from">
																	Promotion Amount
														</label>
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
								<input type="hidden" name="post_travel_id" value="<?php echo $postTravlePackage->id; ?>">
								</form>
							</div>
						</div>
									
								</div>
									</div>
								</div>
								</form>
							</fieldset>
						</div>
					<?php $i++; endforeach; }
						else
					{
						echo"<div class='row col-md-12 text-center'><tr><th colspan='10' ><span>No Record Found</span></th></tr></div>";
					}							?>
			<table class="maintbl" width="100%">
				<tbody>
				</tbody>
			</table>
			<div class="col-md-12 text-center loading" style="display:none">
				<?=  $this->Html->image('/img/loading.gif', ['style'=>'width:5%;']) ?> .
			</div>
			<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
				<div id="loader"></div>
				</div>
			</div>
<input type="hidden" id="page" value="2">
<input type="hidden" value="<?php $user_id; ?>" id="user_id">
<input type="hidden" value="<?php $higestSort; ?>" id="higestSort">
<input type="hidden" value="<?php $country_id; ?>" id="country_id">
<input type="hidden" value="<?php $category_id; ?>" id="category_id">
<input type="hidden" value="<?php $duration_day_night; ?>" id="duration_day_night">
<input type="hidden" value="<?php $starting_price; ?>" id="starting_price">
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script type="text/javascript">	
$(document).ready(function(){
 	$(document).on('change','.cntry',function()
	{
		var country_id=$('option:selected', this).val();
		var countries = [];
		$.each($(".cntry option:selected"), function(){
			 countries.push($(this).val());
		});
		var m_data = new FormData();
		m_data.append('country_id',countries);			
		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "PostTravlePackages", "action" => "ajax_city"]); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType:'text',
			success: function(data)
			{
				$('#mcity').html('<select name="city_id[]" multiple="multiple" class="form-control select2 requiredfield max_limit" data-placeholder="Select Multiple" id="multi_city" style="height:125px;">'+data+'</select>');
				$("#multi_city").select2();
			}
		});
	});
	$(document).on('change','.priceMasters',function()
		{
			var ab=$(this).closest('div').find('.priceMasters option:selected').val();
			 
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
