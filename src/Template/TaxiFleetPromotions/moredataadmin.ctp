<?php $i=1;
			if(!empty($taxiFleetPromotions)){
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
									<?= h($taxiFleetPromotion->total_likes);?></span>
								</td>
								<td width="25%" >
									<span><img src="../images/unsave.png" height="14px"/>
									<?= h($taxiFleetPromotion->total_saved);?></span>
								</td>
								<td width="25%" >
									<span><a target="blank" href="flagreport?promotion_type_id=<?php echo $taxiFleetPromotion->id ;?>"><img src="../images/flag.png" height="15px"/></a>
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
<?php $i++; }
?> 
<div class="maintbl<?php echo $page+1?>"></div><?php 
}?>