<?php 

$i=1;
					//pr($postTravlePackages); exit;			
					if(!empty($postTravlePackages)){
						foreach ($postTravlePackages as $postTravlePackage): 
							$CategoryList='';
							$x=0;
							foreach($postTravlePackage->post_travle_package_rows as $category)
								{
									if($x>=1){
										$CategoryList.=', ';
									}
									$CategoryList.=$category->post_travle_package_category->name;
									$x++;
								}
											
										
											$cityList='';
											$z=0;
											foreach($postTravlePackage->post_travle_package_cities as $cities)
											{
												if($z>=1){
													$cityList.=', ';
												}
												$cityList.=$cities->city->name;
												$z++;
											}
						?>
	<div class="">
		<div class="row">
 <fieldset style="background-color:#fff;">
	<form method="post">
		<div class="row">
			<div class="col-md-12">
			<span style="font-size:18px;"><b><?= h($postTravlePackage->title) ?></b></span>
			</div>
		</div><span class="help-block"></span>
			<div class="row">						
				<div class="col-md-3">
				<?= $this->Html->image($postTravlePackage->full_image,['id'=>'myImg','style'=>'width:100%;height:150px;']) ?>
				<div class="row">
					<div class="">
						<input type="hidden" name="posttravle_id" value="<?php echo $postTravlePackage->id; ?>">
							<table class="table" width="100%" style="text-align:center;" >
								<tr>
									<td width="25%">
										<i class="fa fa-eye fleet" ></i>
										<p><?= h($postTravlePackage->total_views);?><br>Views</p>
									</td>
									<td width="25%">
										<?php
										//
											$dataUserId=$postTravlePackage->user_id;
											$isLiked=$postTravlePackage->isLiked;
											$issaved=$postTravlePackage->issaved;
											//-- LIKES DISLIKE
											if($isLiked=='no'){
												echo $this->Form->button('<i class="fa fa-heart-o like fleet" > </i>',['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
											}
											if($isLiked=='yes'){
												echo $this->Form->button('<img src="../images/like.png" height="15px"/>',['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#000;border:0px;']);
											}
										?>
										<p style="text-align:center">
											<?php echo $postTravlePackage->total_likes; ?>
											<br> 
											Likes
										</p>
									</td>
									<td width="25%">
										<?php 
											//-- Save Unsave
											if($issaved=='1'){
												echo $this->Form->button('<img src="../images/save.png" height="15px"/>',['class'=>'btn btn-xs','value'=>'button','type'=>'submit','name'=>'saveposttravle','style'=>'background-color:white;color:black;border:0px;']);
											}
											if($issaved=='0'){
												echo $this->Form->button('<i class="fa fa-bookmark-o fleet"></i>',['class'=>'btn  btn-xs','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'saveposttravle']);
											}
											?><p><i style="visibility:hidden;">3<br>Likes</i></p>
									</td>
									<td width="25%">
										<?php echo $this->Html->link('<i class="fa fa-flag-o fleet"></i>','#'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#reportmodal'.$postTravlePackage->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
										<p><i style="visibility:hidden;">3<br>Likes</i></p>
									</td>
										<!--------Hidden Field Delete-------------------> 			
											<div style="display:none;">
												<?php 
												if($dataUserId==$user_id){
													echo $this->Html->link('<i class="fa fa-trash" > Delete</i>','api address'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#deletemodal'.$postTravlePackage->id,'data-toggle'=>'modal'));?>
												<!-------Delete Modal Start--------->
													<div id="deletemodal<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
														<div class="modal-dialog modal-md" >
															<!-- Modal content-->
																<div class="modal-content">
																  <div class="modal-header" style="height:100px;">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																		<h4 class="modal-title">
																		Are You Sure, you want to delete this promotion ?
																		</h4>
																	</div>
																	<div class="modal-footer" style="height:60px;">
																		<button type="submit" class="btn btn-danger" name="removeposttravle" value="yes" >Yes</button>
																		<button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
																	</div>
																</div>
															</div>
														</div>
												<!-------Delete Modal End--------->	
												<?php }?>
											</div>
											
											<div id="reportmodal<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
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
																			<label>
																				Select Reason
																			</label>
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
																			<textarea class="form-control " rows="3" type="text" placeholder="Enter your reason here..." name="comment"></textarea>	
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="modal-footer" style="height:60px;">
																<input type="submit" class="btn btn-info btn-md" name="report_submit" value="Report">
																<button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
															</div>
														</div>
													</div>
												</div>
											</tr>
										</table>
									</div>
						</div>
				</div>
				<!--------------------image modal--------------------->
				<div id="myModal" class="modal1" style="display:none;">
					  <span class="close">&times;</span>
					  <img class="modal-content1" id="img01">
					  <div id="caption"></div>
				</div>
				<!--------------------image modal End--------------------->
				<div class="col-md-9">
					<div class="col-md-5">
						<div class="row ">
							<div class="col-md-4 lbwidth">Seller :</div>		
							<div class="col-md-8 lbwidth11"><label>
							<?php echo $postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name.' ( '.$postTravlePackage->user_rating.'<i class="fa fa-star"></i> )';?>
										
							</label>
							</div>					
						</div>
						<div class="row ">
							<div class="col-md-4 lbwidth">Category :</div>		
							<div class="col-md-8 lbwidth11"><label><?= h($CategoryList); ?></label>
							</div>
						</div>
						<div class="row ">
							<div class="col-md-4 lbwidth">Package Duration :</div>		
							<div class="col-md-8 lbwidth11"><label style="color:#FB6542"><?= h($postTravlePackage->duration_day_night) ?></label>
							</div>
						</div>
						<div class="row ">
							<div class="col-md-4 lbwidth">Valid Till :</div>	
							<div class="col-md-8 lbwidth11"><label><?= h(date('d-M-Y',strtotime($postTravlePackage->valid_date))); ?></label>
							</div>					
						</div>		
					</div>
					<div class="col-md-4">
						<div class="row ">
							<div class="col-md-4 lbwidth">Starting Price :</div>
							<div class="col-md-8 lbwidth11"><label style="color:#1295AB">&#8377; <?php echo number_format(h($postTravlePackage->starting_price)) ;?></label>
							</div>
						</div>
						<div class="row ">
							<div class="col-md-4 lbwidth">Cities :</div>		
							<div class="col-md-8 lbwidth11"><label ><?= h($cityList); ?></label>
							</div>
						</div>
						<div class="row ">
							<div class="col-md-4 lbwidth">Country :</div>		
							<div class="col-md-8 lbwidth11"><label >India<?php //echo $postTravlePackage->country->country_name; ?></label>
							</div>
						</div>
								
					</div>
				<div class="row">						
					<div class="col-md-12 ">
									<i class="btn btn-info btn-md fa fa-book" data-target="#fleetdetail<?php echo $postTravlePackage->id;?>" data-toggle="modal"> Package Details</i>
										<!-------Report Modal Start--------->
										<div id="fleetdetail<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
											<div class="modal-dialog modal-md">
												<!-- Modal content-->
													<div class="modal-content">
													  <div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title">Package Details</h3>
													  </div>
														<div class="modal-body" >
															<span class="help-block"></span>
															<div class="row">
																<div class="col-md-12">
																	<label style="padding:20px;"><?= h($postTravlePackage->package_detail); ?></label>
																</div>
															</div>
														</div>
														<div class="modal-footer" >
															<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancle</button>
														</div>
													</div>
												</div>
											</div>
										<i class="btn btn-info btn-md fa fa-book" data-target="#fleetdetail<?php echo $postTravlePackage->id;?>" data-toggle="modal"> Excluded Details</i>
										<!-------Report Modal Start--------->
										<div id="fleetdetail<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
											<div class="modal-dialog modal-md">
												<!-- Modal content-->
													<div class="modal-content">
													  <div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title">Excluded Details</h3>
													  </div>
														<div class="modal-body" >
															<span class="help-block"></span>
															<div class="row">
																<div class="col-md-12">
																	<label style="padding:20px;"><?= h($postTravlePackage->excluded_detail); ?></label>
																</div>
															</div>
														</div>
														<div class="modal-footer" >
															<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancle</button>
														</div>
													</div>
												</div>
											</div>
										<i class="btn btn-danger btn-md fa fa-phone" data-target="#contactdetails<?php echo $postTravlePackage->id;?>" data-toggle="modal"> Seller Details</i>
												<!-------Contact Details Modal --------->
												<div id="contactdetails<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
													<div class="modal-dialog modal-md" >
														<!-- Modal content-->
															<div class="modal-content">
															  <div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h3 class="modal-title">
																	Seller Details
																	</h3>
																	</div>
																	<div class="modal-body">
																		<span class="help-block"></span>
																		<div class="row">
																			<div class="col-md-12">
																				<div class="col-md-4">Seller Name :</div>
																				<div class="col-md-8">
																					<label>
																					
																						<?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name);?>
																				
																						<?php
																						if($postTravlePackage->user_rating==0)
																						{
																							echo "";
																						}
																						else{
																							echo "( ";
																							for($i=0;$i<$postTravlePackage->user_rating;$i++)
																							{
																								echo "<i class='fa fa-star' style='font-size:10px;color:#959191;'></i>";
																								if($i==0)
																								{
																									echo "";
																								}
																							}
																							echo " )";
																							}
																						?>
																					</label>
																				</div>					
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-12">
																			<div class="col-md-4">Mobile No :</div>
																			<div class="col-md-8">
																			<label><?= h($postTravlePackage->user->mobile_number);?></label>
																			</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-12">
																				<div class="col-md-4">Email :</div>
																				<div class="col-md-8">
																				<label><?= h($postTravlePackage->user->email);?></label>
																				</div>
																			</div>
																		</div>
																		<div class="row" style="display:none;">
																			<div class="col-md-12">
																				<div class="col-md-4">Location :</div>
																				<div class="col-md-8">
																				<label><?= h($postTravlePackage->user->location);?></label>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
																	</div>
																</div>
															</div>
														</div>
											<!-------Contact Details Modal End--------->
						
											</div>
										</div>
				</div>
			</div>

									</form>
								</fieldset>
							</div>
						</div>
					<?php $i++; endforeach; }
						else
						{
							echo"No More Data";
						}		 ?>