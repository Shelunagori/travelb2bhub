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
					<?= $this->Html->image($eventPlannerPromotion->full_image,['id'=>'myImg','style'=>'width:100%;height:109px;','data-target'=>'#imagemodal'.$eventPlannerPromotion->id,'data-toggle'=>'modal','promotionid'=>$eventPlannerPromotion->id,'userId'=>$user_id,'class'=>'viewCount']) ?>
					 
					<div id="imagemodal<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md">
						<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body">
								<button type="button" class="close" data-dismiss="modal" style="padding-right:8px !important;">&times;</button>
								<?= $this->Html->image($eventPlannerPromotion->full_image,['style'=>'width:100%;;padding:20px;padding-top:0px!important;']) ?>
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
					<button type="submit" name="rate_user" class="btn btn-success btn-md" >Submit</button>
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
								<?php	}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</fieldset>
</div>
<?php }
?> 
<div class="maintbl<?php echo $page+1?>"></div><?php 
}?>