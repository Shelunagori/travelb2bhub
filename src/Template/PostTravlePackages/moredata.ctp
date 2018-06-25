<?php 
$i=1;
if(!empty($postTravlePackages)){ ?>
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
<?php 
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
					</div>
					<hr style="margin-top:4px !important"></hr>
					<div class="row" style="padding-top:5px;">
						<input type="hidden" name="posttravle_id" value="<?php echo $postTravlePackage->id; ?>">
						<table  width="100%" style="text-align:center;" >
							<tr>
								<td width="25%" >
									<span><img src="../images/view.png" height="13px"/>
									<?= h($postTravlePackage->total_views);?></span>
								</td>
								<td width="25%">
									<span><?php
										//
										$dataUserId=$postTravlePackage->user_id;
										$isLiked=$postTravlePackage->isLiked;
										$issaved=$postTravlePackage->issaved;
										//-- LIKES DISLIKE
										if($isLiked=='no'){
										echo $this->Form->button('<img src="../images/unlike.png" height="15px"/>',['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
										}
										if($isLiked=='yes'){
										echo $this->Form->button('<img src="../images/like.png" height="15px"/>',['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>' ','style'=>'background-color:white;color:#000;border:0px;']);
										}
										?>
										<?= h($postTravlePackage->total_likes);?>
									</span>
								</td>
								<td width="25%">
									<?php 
									//-- Save Unsave
									if($issaved=='1'){
										echo $this->Form->button('<img src="../images/save.png" height="15px"/>',['class'=>'btn btn-xs','value'=>'button','type'=>'submit','name'=>'saveposttravle','style'=>'background-color:white;color:black;border:0px;']);
									}
									if($issaved=='0'){
										echo $this->Form->button('<img src="../images/unsave.png" height="15px"/>',['class'=>'btn  btn-xs','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'saveposttravle']);
									}
									?>
									<span style="visibility:hidden;">3</span>
								</td>
								<td width="25%">
									<?php echo $this->Html->link('<img src="../images/flag.png" height="15px"/>','#'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#reportmodal'.$postTravlePackage->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
									<span style="visibility:hidden;">3</span>
									<div id="reportmodal<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
										<div class="modal-dialog modal-md">
										<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<span class="modal-title">Report</span>
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
																	echo $this->Form->control('report_reason_id', ['span'=>false, "type"=>"select",'options' =>$options, "class"=>"form-control select2 reason_box","data-placeholder"=>"Select... ","style"=>"height:125px;",'empty'=>"Select..."]);
																	?>
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row report_text"  style="display:none;">
														<div class="col-md-12">
															<div class="col-md-3">
															</div>
															<div class="col-md-9">
																<div >
																	<textarea class="form-control " rows="3" type="text" placeholder="Enter your reason here..." name="comment"></textarea>	
																</div>
															</div>
														</div>
													</div>
													<span class="help-block"></span>
												</div>
												<div class="modal-footer" style="height:60px;">
													<input type="submit" class="btn btn-info btn-md" name="report_submit" value="Report">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
						</table>
					</div>	<hr></hr>
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
									<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$postTravlePackage->user_id),1);?>
									<a style="color:#d69d5c" href="<?php echo $hrefurl; ?>">
									<?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name);?>
									</u>
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
						<div class="row rowspace" >
							<div class="col-md-12"><label>Company Name: </label>
								<span><?= h($postTravlePackage->user->company_name); ?></span>
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
												<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$postTravlePackage->user_id),1);?>
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
						<div id="ReviewUser<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
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
																<input class="star star-5" id="star-5<?php echo $postTravlePackage->id; ?>" type="radio" name="rating" <?php if($rate=="5") {echo "checked";} ?> value="5"/>
																<label class="star star-5" for="star-5<?php echo $postTravlePackage->id; ?>"></label>
																<input class="star star-4" id="star-4<?php echo $postTravlePackage->id; ?>" type="radio" name="rating" <?php if($rate=="4") {echo "checked";} ?> value="4"/>
																<label class="star star-4" for="star-4<?php echo $postTravlePackage->id; ?>"></label>
																<input class="star star-3" id="star-3<?php echo $postTravlePackage->id; ?>" type="radio" name="rating" <?php if($rate=="3") {echo "checked";} ?> value="3"/>
																<label class="star star-3" for="star-3<?php echo $postTravlePackage->id; ?>"></label>
																<input class="star star-2" id="star-2<?php echo $postTravlePackage->id; ?>" type="radio" name="rating" <?php if($rate=="2") {echo "checked";} ?> value="2"/>
																<label class="star star-2" for="star-2<?php echo $postTravlePackage->id; ?>"></label>
																<input class="star star-1" id="star-1<?php echo $postTravlePackage->id; ?>" type="radio" name="rating" <?php if($rate=="1") {echo "checked";} ?> value="1"/>
																<label class="star star-1" for="star-1<?php echo $postTravlePackage->id; ?>"></label>
																<input style="display:none;" type="radio" name="rating" <?php if($rate=="0") {echo "checked";} ?> value="0"/>
															</div>
														</td>
													</tr>
													<tr>
														<input type="hidden" name="author_id" value="<?php echo $user_id;?>">
														<input type="hidden" name="promotion_type_id" value="1">
														<input type="hidden" name="user_id" value="<?php echo $postTravlePackage->user_id;?>">
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
						<div class="row" style="padding-top:15px;">
							<div class="col-md-12 text-center" >
								<button style="margin-top:5px"  class="btn btn-info btn-md btnlayout viewCount" data-target="#Inclusion<?php echo $postTravlePackage->id;?>" data-toggle="modal"  promotionid="<?php echo $postTravlePackage->id;?>" userId="<?php echo $user_id;?>" type="button">Inclusions</button>&nbsp;&nbsp;
								<!-------Report Modal Start--------->
								<button style="margin-top:5px"  class="btn btn-warning btn-md btnlayout viewCount" data-target="#Exclusion<?php echo $postTravlePackage->id;?>"   promotionid="<?php echo $postTravlePackage->id;?>" userId="<?php echo $user_id;?>" data-toggle="modal" type="button">Exclusions</button>&nbsp;&nbsp;
								<button style="margin-top:5px"  class="btn btn-danger btn-md  btnlayout viewCount" data-target="#contactdetails<?php echo $postTravlePackage->id;?>" promotionid="<?php echo $postTravlePackage->id;?>" data-toggle="modal" userId="<?php echo $user_id;?>" type="button">Contact Info</button>&nbsp;&nbsp;
								<?php
								if($postTravlePackage->user_id != $user_id){ ?>
								<button style="margin-top:5px" class="btn btn-success btn-md btnlayout viewCount" data-target="#ReviewUser<?php echo $postTravlePackage->id;?>" data-toggle="modal" promotionid="<?php echo $postTravlePackage->id;?>" userId="<?php echo $user_id;?>" type="button">Rate User</button>&nbsp;&nbsp;
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
<?php $i++; endforeach;
?> 
<div class="maintbl<?php echo $page+1?>"></div><?php 
}?>
