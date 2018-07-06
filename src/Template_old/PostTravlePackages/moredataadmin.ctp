<?php $i=1;
					//pr($postTravlePackages); exit;			
					if(!empty($postTravlePackages)){
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
				<?= $this->Html->image($postTravlePackage->full_image,['id'=>'myImg','style'=>'width:100%;height:109px;','data-target'=>'#imagemodal'.$postTravlePackage->id,'data-toggle'=>'modal','promotionid'=>$postTravlePackage->id,'userId'=>$user_id,'class'=>'viewCount']) ?>
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
					</div><hr style="margin-top:4px !important"></hr>
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
										<span><a target="blank" href="flagreport?promotion_type_id=<?php echo $postTravlePackage->id ;?>"><img src="../images/flag.png" height="15px"/></a>
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
									
										<a style="margin-top:5px" href="<?php echo $this->Url->build(["controller" => "PostTravlePackages",'action'=>'edit/'.$postTravlePackage->id]); ?>" class="btn btn-successto btn-md btnlayout" >Edit </a>&nbsp;&nbsp;
										
										<button style="margin-top:5px;" class="btn btn-warning btn-md btnlayout viewCount" data-target="#Priority<?php echo $postTravlePackage->id;?>" data-toggle="modal" type="button">Priority</button>&nbsp;&nbsp;
											
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
	<div id="Priority<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
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
			<input type="hidden" name="post_travel_id" value="<?php echo $postTravlePackage->id; ?>">
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
					<?php $i++; endforeach; 
?> 
<div class="maintbl<?php echo $page+1?>"></div><?php 
}?>
