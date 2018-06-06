<?php //echo $this->Html->css('/assets/loader-1.css'); ?>
<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/hotel_promotions/getHotelList.json?isLikedUserId=".$user_id.'&higestSort='.$higestSort.'&category_id='.$category_id.'&search='.$search.'&rating_filter='.$rating_filter.'&starting_price='.$starting_price."&submitted_from=web",
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
//-- pricemaster
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/price_masters/index.json?promotion_type_id=4",
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
$pricemasters=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$pricemaster=json_decode($response);
	//pr($pricemaster);exit;
	$pricemasters=$pricemaster->PriceMasters;
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
									<div class="col-md-6" style="padding-top:8px;">
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
									<div class="col-md-6" style="padding-top:8px;">
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
								</div>
							</div>
							<hr ></hr>	
							<div class="row ">
								<div class="col-md-12 text-center" style="padding-top:12px;">
									<a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'package_report')) ?>"class="btn btn-warning  btn-sm">Reset</a>
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
										<a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'package_report')) ?>"class="btn btn-danger btn-sm">Reset</a>
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
					<td width="8%" style="padding-left:5px;"><a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'package_report')) ?>"class="btn btn-danger btn-sm" style="width:100%">Reset</a>
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
						<div class="pull-right">
							<button class="close" style="margin-top: -12px; font-size:20px;font-size: 26px;" type="button" data-target="#remove<?php echo $hotelPromotion->id; ?>" data-toggle=modal>&times;</button>
						</div>
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
								<td width="25%" >
									<span><img src="../images/unlike.png" height="13px"/>
									<?= h($hotelPromotion->total_views);?></span>
								</td>
								<td width="25%" >
									<span><img src="../images/unsave.png" height="14px"/>
									<?= h($hotelPromotion->total_saved);?></span>
								</td>
								<td width="25%" >
									<span><img src="../images/flag.png" height="15px"/>
									<?= h($hotelPromotion->total_flagged);?></span>
								</td>
								</tr>
							</table>
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
										<div class="row rowspace">
											<div class="col-md-12">
											<label>Date Posted: </label>
											<span style="black">  <?php echo date('d-M-Y',strtotime($hotelPromotion->created_on)) ; ?></span>
											</div>
										</div> 
								</div>
								<div class="col-md-7">
								<div class="row rowspace">
										<div class="col-md-12 "><label><?= __(' Hotelier') ?>: </label>	
										<span><u>
												<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'adminviewprofile',$hotelPromotion->user_id),1);?>
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
										<span ><a style="color:blue;" href="<?php echo $hotelPromotion->website; ?>" target="blank"><u><?= h($hotelPromotion->website) ?></u></a> </span>
										</div>
									</div>
									<div class="row rowspace">
										<div class="col-md-12"><label><?= __(' Location') ?>: </label>
										<span ><?= h($hotelPromotion->hotel_location) ?></span>
										</div>
									</div>
									<div class="row rowspace">
										<div class="col-md-12">
										<label>Expiring On: </label>
										<span style="color:#FB6542">  <?php echo date('d-M-Y',strtotime($hotelPromotion->visible_date)) ; ?></span>
										</div>
									</div>
								</div>
									<!-----button list-->
							<div class="row" >
								<div class="col-md-12 text-center" style="padding-top:15px;">
								
									<button style="margin-top:5px" class="btn btn-info btn-md btnlayout viewCount" data-target="#contactdetails<?php echo $hotelPromotion->id;?>" data-toggle="modal"  promotionid="<?php echo $hotelPromotion->id;?>" userId="<?php echo $user_id;?>" type="button">Contact Info</button>&nbsp;&nbsp;
									
									<button  style="margin-top:5px;" type="button" class="btn btn-success btn-md btnlayout" data-target="#renew<?php echo $hotelPromotion->id; ?>" data-toggle=modal>Renew</button>&nbsp;&nbsp;
									
									<a style="margin-top:5px" href="<?php echo $this->Url->build(["controller" => "HotelPromotions",'action'=>'adminedit/'.$hotelPromotion->id]); ?>" class="btn btn-danger btn-md btnlayout" >Edit</a>&nbsp;&nbsp;
									
									<button style="margin-top:5px;" class="btn btn-warning btn-md btnlayout viewCount" data-target="#Priority<?php echo $hotelPromotion->id;?>" data-toggle="modal" type="button">Priority</button>&nbsp;&nbsp;
 								</div>

									
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
																					<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'adminviewprofile',$hotelPromotion->user_id),1);?>
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
<!------Contact Details Modal --------->
<div id="Priority<?php echo $hotelPromotion->id;?>" class="modal fade" role="dialog">
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
			<input type="hidden" name="hotel_id" value="<?php echo $hotelPromotion->id; ?>">
		</form>
	</div>
</div>
<div id="renew<?php echo $hotelPromotion->id; ?>" class="modal fade" role="dialog">
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
															foreach($pricemasters as $Price)
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
								<input type="hidden" name="hotel_id" value="<?php echo $hotelPromotion->id; ?>">
								</form>
							</div>
						</div>
									<div id="remove<?php echo $hotelPromotion->id; ?>" class="modal fade" role="dialog">
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
													<div class="modal-footer" style="height:60px;">
														<button type="submit" name="removepackage"  class="unfollow btn btn-success btn-md" value="yes" name="remove_promotion">Yes</button>
														<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
													</div>
												</div>
												<input type="hidden" name="hotel_id" value="<?php echo $hotelPromotion->id; ?>"/>
											</form>
										</div>
									</div>							
					</fieldset>	
				</div>
						
				<?php }
				}
				else {
				echo"<div class='row col-md-12 text-center'><tr><th colspan='10' ><span>No Record Found</span></th></tr></div>";
				}?>
			</div>
			<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
									<div id="loader"></div>
									</div>
<h2><span class="show_msg"></span></h2>
<!-- <div class="paginator">
<ul class="pagination">
<?= $this->Paginator->prev('< ' . __('previous')) ?>
<?= $this->Paginator->numbers() ?>
<?= $this->Paginator->next(__('next') . ' >') ?>
</ul>
<p><?= $this->Paginator->counter() ?></p>
</div>-->
</div>
</div>
</div>
</div>
</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script type='text/javascript'>
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