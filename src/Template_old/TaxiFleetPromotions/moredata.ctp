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
					<button type="submit" name="rate_user" class="btn btn-success btn-md" >Submit</button>
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
			<?php $i++; }
?> 
<div class="maintbl<?php echo $page+1?>"></div><?php 
}?>