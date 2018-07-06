<?php //echo $this->Html->css('/assets/loader-1.css'); ?>
<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/hotel_promotions/getHotelList.json?isLikedUserId=".$user_id.'&higestSort='.$higestSort.'&category_id='.$category_id.'&search='.$search.'&rating_filter='.$rating_filter.'&starting_price='.$starting_price.'&following='.$following."&submitted_from=web",
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
	$hotelPromotions=$List->getHotelPromotion;
}
//pr($hotelPromotions); 
//-- hotelcategory
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/hotel_categories/HotelCategoriesList.json",
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
$hotelcategory=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$hotelcategory=json_decode($response);
	//pr($hotelcategory);exit;
	$hotelcategory=$hotelcategory->hotelCategories;
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
.col-form-label{
	color:#000 !important;
}

.col-md-4{
	color:#676363;
}

a{
	color:#ac85d6;
}
</style>
<div class="row" >
	<div class="col-md-12">
		
	</div>
</div>
<div  class="container-fluid">
<?php if($roleId==3){?>
<a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'add')) ?>" target="_blank" id="ButtonforaddMore" title="Click Here to add Hotel Promotion"><i class="fa fa-plus"></i></a>
<?php } ?>
	<div class="box box-primary" style="margin-bottom:5px;">
		<div class="row" >
			<div class="col-md-12">
				<div class="box-header with-border"> 
					<span class="box-title" style="color:#057F8A;"><b><?= __('Hotel Promotions') ?></b></span>
					<div class="box-tools pull-right" style="margin-top:-7px;">
						<a style="font-size:15px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
						<a style="font-size:22px" class="btn btn-box-tool" data-target="#demo" data-toggle="collapse" aria-expanded="false"> <i class="fa fa-filter"></i></a>
						<a style="font-size:22px" href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'savedList',$user_id),1);?>"  class="btn btn-box-tool" ><i class="fa fa-bookmark"></i> </a>
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
								<div class="col-md-12" >
									<div class="col-md-12" style="padding-top:8px;">
										<label class="col-form-label"for=example-text-input>Select Hotel Category:  </label>
										<div class="input-field" style="padding-top:8px;">
											<?php $options=array();
												foreach($hotelcategory as $country)
												{
													$options[] = ['value'=>$country->id,'text'=>$country->name];
												};echo $this->Form->input('category_id', ['options' => $options,'class'=>'form-control select2','label'=>false,'empty'=>'Select...','multiple'=>true,'data-placeholder'=>'Select Multiple']);
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="row ">
								<div class="col-md-12">
									<div class="col-md-4" style="padding-top:8px;">
									 <label class="col-form-label" for=example-text-input>Select Hotel Rating: </label>
										 <div class="input-field" style="padding-top:8px;">
											<select name="rating_filter" class="form-control">
												<option value="">Select...</option>
												<option value="1">&#9733;</option>
												<option value="2">&#9733;&#9733;</option>
												<option value="3">&#9733;&#9733;&#9733;</option>
												<option value="4">&#9733;&#9733;&#9733;&#9733;</option>
												<option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>							
											</select>
										 </div>
									</div>	
									<div class="col-md-4" style="padding-top:8px;">
										<label class="col-form-label" for=example-text-input>Room Price Range:  </label>
										<div class="input-field" style="padding-top:8px;">
											<select name="starting_price" class="form-control">
												<option value="">Select</option>
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
									<div class="col-md-4" style="padding-top:8px;">
										<div class="form-group" style="padding-top:12px;">
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
									<a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'report')) ?>"class="btn btn-warning  btn-sm">Reset</a>
									<button class="btn btn-success btn-sm" name="submit" value="Submit" type="submit">Apply</button> 
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
	 <div id="myModal123" class="modal fade" role="dialog">
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
										<a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
									</div>
							  </div>
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
							<div class="modal-body">
								<span class="help-block"></span>

								
								  </div>
								<div class="modal-footer">
									<button class="btn btn-info btn-sm" name="submit" value="Submit" type="submit">Filter</button> 
									<a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
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
					<td width="8%" style="padding-left:5px;"><a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'report')) ?>"class="btn btn-danger btn-sm" style="width:100%">Reset</a>
					</td></tr>
				</table>
			</div>
		</div>
	</div>
</div>
</form>
		<?php $i=1;
			if(!empty($hotelPromotions)){
			foreach ($hotelPromotions as $hotelPromotion){
			?>
		<div class="box-body bbb">	
			<fieldset style="background-color:#fff;">
				<form method="post" class="formSubmit">
				<input type="hidden" name="hotelpromotion_id" value="<?php echo $hotelPromotion->id; ?>">
					<div class="row">
						<div class="col-md-12" style="padding-top:5px;">
							<span style="font-size:16px;">	<?php echo $hotelPromotion->hotel_name.' ( <i class="fa fa-star" style="color:#959595;"></i> '.$hotelPromotion->hotel_rating.' Star Hotel )';?></span>
						</div>
					</div>
					<span class="help-block"></span>
					<div class="row">						
					<div class="col-md-3 rowspace">
					<?= $this->Html->image($hotelPromotion->full_image,['id'=>'myImg','style'=>'width:100%;height:109px;','data-target'=>'#imagemodal'.$hotelPromotion->id,'data-toggle'=>'modal','promotionid'=>$hotelPromotion->id,'userId'=>$user_id,'class'=>'viewCount']) ?>
					<div id="imagemodal<?php echo $hotelPromotion->id;?>" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md">
						<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body" >
								<button type="button" class="close" data-dismiss="modal" style="padding-right:8px !important;">&times;</button>
								<?= $this->Html->image($hotelPromotion->full_image,['style'=>'width:100%;padding:20px;padding-top:0px!important;']) ?>
								</div>
							</div>
						</div>
					</div>
					<hr style="margin-top:4px !important"></hr>
					<div class="row" style="padding-top:5px;">					
						<input type="hidden" name="taxifleet_id" value="<?php echo $hotelPromotion->id; ?>">
								<table  width="100%" style="text-align:center;" >
								<tr>
								<td width="25%" >
										<span><img src="../images/view.png" height="13px"/>
										<?= h($hotelPromotion->total_views);?></span>
									</td>
								<td width="25%">
									<span>
									<?php
									//pr($hotelPromotion);
										$dataUserId=$hotelPromotion->user_id;
										$isLiked=$hotelPromotion->isLiked;
										$issaved=$hotelPromotion->issaved;
										//-- LIKES DISLIKE
										if($isLiked=='no'){
											echo $this->Form->button('<img src="../images/unlike.png" height="15px"/>',['class'=>'likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
											
										}
										if($isLiked=='yes'){
											echo $this->Form->button('<img src="../images/like.png" height="15px"/>',['class'=>' likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#F7F3F4;border:0px;']);
										}?>
								<?= h($hotelPromotion->total_likes);?></span>
								</td>
								<td width="25%">
								<?php 
									//-- Save Unsave
									if($issaved=='1'){
										echo $this->Form->button('<img src="../images/save.png" height="15px"/>',['class'=>' ','value'=>'button','type'=>'submit','name'=>'savehotelpromotion','style'=>'background-color:white;color:black;border:0px;']);
									}
									if($issaved=='0'){
										echo $this->Form->button('<img src="../images/unsave.png" height="15px"/>',['class'=>'','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'savehotelpromotion']);
									}
									?>
									
									<span style="visibility:hidden;">3</span>
								</td>
								<td width="25%">
								<?php echo $this->Html->link('<img src="../images/flag.png" height="15px"/>','#'.$hotelPromotion->id,array('escape'=>false,'class'=>'','data-target'=>'#reportmodal'.$hotelPromotion->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
								<span style="visibility:hidden;">3</span>
								</td>
								</tr>
								</table>
							<!-------Report Modal Start--------->
							<div id="reportmodal<?php echo $hotelPromotion->id;?>" class="modal fade" role="dialog">
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
															<div class="reason_list">
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
												</div>
												<span class="help-block"></span>
											</div>
											<div class="modal-footer" style="height:60px;">
												<input type="submit" class="btn btn-info btn-md" name="report_submit" value="Report">
												<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancel</button>
											</div>
										</div>
									</div>
								</div>
							</div><hr></hr>
						</div><span class="help-block"></span>
							<div class="col-md-9">
								<div class="col-md-5">
										<div class="row rowspace">
											<div class="col-md-12"><label>Category: </label>
												<span><?= h($hotelPromotion->hotel_category->name); ?></span>
											</div>
										</div>
										<div class="row rowspace">
											<div class="col-md-12"><label>Cheapest Room: </label>
											<span style="color:#1295AB">&#8377;<?= (h($hotelPromotion->cheap_tariff)) ?></span>
											</div>
										</div>
									<div class="row rowspace">
										<div class="col-md-12"><label>Most Expensive Room: </label>
										<span style="color:#1295AB">&#8377;<?= (h($hotelPromotion->expensive_tariff)) ?></span>
										</div>
									</div>
								</div>
								<div class="col-md-7">
								<div class="row rowspace">
										<div class="col-md-12 "><label><?= __(' Hotelier') ?>: </label>	
										<span><u>
												<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$hotelPromotion->user_id),1);?>
												<a style="color:#d69d5c;" href="<?php echo $hrefurl; ?>"> 
												<?= h($hotelPromotion->user->first_name.' '.$hotelPromotion->user->last_name);?></u>
												<?php
												if($hotelPromotion->user_rating==0)
												{
													echo "";
												}
												else{
														echo "(".$hotelPromotion->user_rating." <i class='fa fa-star'></i>)";
													}
												?></a>
											</span>
										</div>					
									</div>
									<div class="row rowspace">
										<div class="col-md-12"><label><?= __(' Website') ?>: </label>
										<span ><a style="color:blue;" href="http://<?php echo $hotelPromotion->website; ?>" target="blank"><u><?= h($hotelPromotion->website) ?></u></a> </span>
										</div>
									</div>
									<div class="row rowspace">
										<div class="col-md-12"><label><?= __(' Location') ?>: </label>
										<span ><?= h($hotelPromotion->hotel_location) ?></span>
										</div>
									</div>
									</div>
									<!-----button list-->
							<div class="row" >
								<div class="col-md-12 text-center" style="padding-top:15px;">
									<button class="btn btn-danger btn-md btnlayout viewCount" data-target="#contactdetails<?php echo $hotelPromotion->id;?>" data-toggle="modal"  promotionid="<?php echo $hotelPromotion->id;?>" userId="<?php echo $user_id;?>" type="button">Contact Info</button>
									
									<?php
									if($hotelPromotion->user_id != $user_id){ ?>
										<button class="btn btn-success btn-md btnlayout viewCount" data-target="#ReviewUser<?php echo $hotelPromotion->id;?>" data-toggle="modal" promotionid="<?php echo $hotelPromotion->id;?>" userId="<?php echo $user_id;?>" type="button">Rate User</button>
									<?php	}
									?>
								</div>
<div id="ReviewUser<?php echo $hotelPromotion->id;?>" class="modal fade" role="dialog">
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
											<input class="star star-5" id="star-5<?php echo $hotelPromotion->id; ?>" type="radio" name="rating" <?php if($rate=="5") {echo "checked";} ?> value="5"/>
											<label class="star star-5" for="star-5<?php echo $hotelPromotion->id; ?>"></label>
											<input class="star star-4" id="star-4<?php echo $hotelPromotion->id; ?>" type="radio" name="rating" <?php if($rate=="4") {echo "checked";} ?> value="4"/>
											<label class="star star-4" for="star-4<?php echo $hotelPromotion->id; ?>"></label>
											<input class="star star-3" id="star-3<?php echo $hotelPromotion->id; ?>" type="radio" name="rating" <?php if($rate=="3") {echo "checked";} ?> value="3"/>
											<label class="star star-3" for="star-3<?php echo $hotelPromotion->id; ?>"></label>
											<input class="star star-2" id="star-2<?php echo $hotelPromotion->id; ?>" type="radio" name="rating" <?php if($rate=="2") {echo "checked";} ?> value="2"/>
											<label class="star star-2" for="star-2<?php echo $hotelPromotion->id; ?>"></label>
											<input class="star star-1" id="star-1<?php echo $hotelPromotion->id; ?>" type="radio" name="rating" <?php if($rate=="1") {echo "checked";} ?> value="1"/>
											<label class="star star-1" for="star-1<?php echo $hotelPromotion->id; ?>"></label>
											<input style="display:none;" type="radio" name="rating" <?php if($rate=="0") {echo "checked";} ?> value="0"/>
										</div>
									</td>
								</tr>
								<tr>
								<input type="hidden" name="author_id" value="<?php echo $user_id;?>">
								<input type="hidden" name="promotion_type_id" value="4">
								<input type="hidden" name="user_id" value="<?php echo $hotelPromotion->user_id;?>">
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

									<!------Contact Details Modal --------->
										<div id="contactdetails<?php echo $hotelPromotion->id;?>" class="modal fade" role="dialog">
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
																			<label>Seller Name: </label>
																			<span style="padding-top:2px;">
																				<u>
																					<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$hotelPromotion->user_id),1);?>
																				<a style="color:#d69d5c;" href="<?php echo $hrefurl; ?>"> 
																					<?= h($hotelPromotion->user->first_name.' '.$hotelPromotion->user->last_name);?></u>
																					<?php
																					if($hotelPromotion->user_rating==0)
																					{
																						echo "";
																					}
																					else{
																							echo "(".$hotelPromotion->user_rating." <i class='fa fa-star'></i>)";
																						}
																					?></a>
																				</span>
																			</div>					
																		</div>					
																		<div class="row rowspace">
																			<div class="col-md-12">
																			<label>Mobile No: </label>
																			<span><?= h($hotelPromotion->user->mobile_number);?></span>
																			</div>
																		</div>
																		<div class="row rowspace">
																			<div class="col-md-12">
																				<label>Email: </label>
																				<span><a href="mailto:<?php echo $hotelPromotion->user->email;?>"><?= h($hotelPromotion->user->email);?></a></span>
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
														<!-------Contact Details Modal End--------->	
											</div>
										</div>
										<!----button list end--->
								</div>
							</form>	

					</fieldset>	
				</div>
						
				<?php }
				}
				else {
				echo"<div class='row col-md-12 text-center'><tr><th colspan='10' ><span>No Record Found</span></th></tr></div>";
				}?>
				<div class="maintbl2">
</div>
			</div> 

<div class="col-md-12 text-center loading" id="" style="display:none">
	<?=  $this->Html->image('/img/loading.gif', ['style'=>'width:5%;','id'=>'imageofloagin']) ?> .
</div>
<input type="hidden" id="page" value="2">
<input type="hidden" value="<?php echo $user_id; ?>" id="user_idfornext">
<input type="hidden" value="<?php echo $higestSort; ?>" id="higestSort"> 
<input type="hidden" value="<?php echo $category_id; ?>" id="category_id"> 
<input type="hidden" value="<?php echo $search; ?>" id="search">
<input type="hidden" value="<?php echo $rating_filter; ?>" id="rating_filter">
<input type="hidden" value="<?php echo $following; ?>" id="following">
<input type="hidden" value="<?php echo $starting_price; ?>" id="starting_price">

			<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
			<div id="loader"></div>
			</div>
			<h2><span class="show_msg"></span></h2>
 
</div>
</div>
</div>
</div>
</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script type='text/javascript'>

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
				
 				var starting_price = $("#starting_price").val();
				var rating_filter = $("#rating_filter").val();
				var category_id = $("#category_id").val(); 
				var higestSort = $("#higestSort").val();
				var search = $("#search").val(); 
				var following = $("#following").val();
				var user_id = $("#user_idfornext").val(); 
				$.ajax({
					url: "<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'moredata')) ?>",
					type: "POST",
					data: {
						user_id: user_id,
						higestSort: higestSort, 
						category_id: category_id,
						rating_filter: rating_filter,
						search: search,  
						following: following,   
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
  });
  $(document).on('click','.viewCount',function()
	{
		var promotionid=$(this).attr('promotionid');
		var userId=$(this).attr('userId');
		
		var siteUrl='<?php echo $coreVariable['SiteUrl']; ?>';
		var siteUrls="api/hotel_promotions/getHotelDetails.json?id="+promotionid+"&user_id="+userId;
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
</script>