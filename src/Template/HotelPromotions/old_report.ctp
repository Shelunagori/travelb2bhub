<div class="">
		<div class="col-md-4">
		<?= $this->Html->image($hotelPromotion->full_image,['style'=>'width:100%;height:250px;']) ?>
		</div>
		<div class="col-md-8">
			<input type="hidden" name="hotelpromotion_id" value="<?php echo $hotelPromotion->id; ?>">
			<div class="row">
		<div class="col-md-6 pull-left">
				<h3><?php echo $hotelPromotion->hotel_name;?></h3>
		</div>
		<div class="col-md-6 pull-right text-center">
			<div >
				<div class="col-md-3">
					<i class="fa fa-eye fleet"></i>
					<p><?= h($hotelPromotion->total_views);?><br>Views</p>
				</div>
				<div class="col-md-3">
				<?php
				//pr($taxiFleetPromotion);
					$dataUserId=$hotelPromotion->user_id;
					$isLiked=$hotelPromotion->isLiked;
					$issaved=$hotelPromotion->issaved;
					//-- LIKES DISLIKE
					if($isLiked=='no'){
						echo $this->Form->button('<i class="fa fa-heart-o like fleet" > </i>',['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
					}
					if($isLiked=='yes'){
						echo $this->Form->button('<i class="fa fa-heart-o like unfleet" > </i>',['class'=>'btn  btn-xs likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#F7F3F4;border:0px;']);
					}?>
				<p><?= h($hotelPromotion->total_likes);?><br>Likes</p>
				</div>
				<div class="col-md-3">
					<?php 
					//-- Save Unsave
					if($issaved=='1'){
						echo $this->Form->button('<i class="fa fa-bookmark-o unfleet"></i>',['class'=>'btn  btn-xs  ','value'=>'button','type'=>'submit','name'=>'savehotelpromotion','style'=>'background-color:white;color:black;border:0px;']);
					}
					if($issaved=='0'){
						echo $this->Form->button('<i class="fa fa-bookmark-o fleet"></i>',['class'=>'btn btn-primary btn-xs ','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'savehotelpromotion']);
					}
					?>
					</div>
					<div class="col-md-3">
						<?php echo $this->Html->link('<i class="fa fa-flag-o fleet"></i>','#'.$hotelPromotion->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#reportmodal'.$hotelPromotion->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
					</div>		
					<div style="display:none;">
					<?php 
					if($dataUserId==$user_id){
					echo $this->Html->link('<i class="fa fa-trash" > Delete</i>','api address'.$hotelPromotion->id,array('escape'=>false,'class'=>'btn btn-xs','data-target'=>'#deletemodal'.$hotelPromotion->id,'data-toggle'=>'modal'));?>
							<!-------Delete Modal Start--------->
						<div id="deletemodal<?php echo $hotelPromotion->id;?>" class="modal fade" role="dialog">
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
											<button type="submit" class="btn btn-danger" name="removehotelpromtion" value="yes" >Yes</button>
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
										</div>
								</div>
							</div>
						</div>
					<!-------Delete Modal End--------->
					<?php }?>
					</div>
					
				</div>
			</div>
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
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-3" style="color:black;">
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
												<textarea class="form-control " rows="3" type="text" placeholder="Enter Your Reason..." name="comment"></textarea>	
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer" style="height:60px;">
									<input type="submit" class="btn btn-primary btn-md" name="report_submit" value="Report">
									<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancle</button>
								</div>
							</div>
						</div>
					</div>
			<!-------Report Modal End--------->	
</div>
										<div class="row col-md-12">
											<div class="col-md-3">Seller Name </div><div class="col-md-1">:</div>		
											<div class="col-md-8"><label>
											<?= h($hotelPromotion->user->first_name.' '.$hotelPromotion->user->last_name);?>
											<?php
															if($hotelPromotion->user_rating==0)
															{
																echo "";
															}
															else{
																echo "( ";
																for($i=0;$i<$hotelPromotion->user_rating;$i++)
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
										<div class="row col-md-12">
											<div class="col-md-3">Category</div><div class="col-md-1">:</div>		
											<div class="col-md-8"><label ><?= h($hotelPromotion->hotel_category->name) ?></label>
											</div>
										</div>
										<div class="row col-md-12">
											<div class="col-md-3">Cheap Tariff</div><div class="col-md-1">:</div>		
											<div class="col-md-8"><label style="color:#1295AB">	&#8377;<?= h($hotelPromotion->cheap_tariff) ?></label>
											</div>
										</div>
										<div class="row col-md-12">
											<div class="col-md-3">Expensive Tariff</div><div class="col-md-1">:</div>		
											<div class="col-md-8"><label style="color:#1295AB">&#8377;	<?= h($hotelPromotion->expensive_tariff) ?></label>
											</div>
										</div>
										<div class="row col-md-12">
											<div class="col-md-3">Location</div><div class="col-md-1">:</div>		
											<div class="col-md-8"><label ><?= h($hotelPromotion->hotel_location) ?></label>
											</div>
										</div>
										<div class="row pull-right ">
											<a href="view/<?php echo $hotelPromotion->id; ?>" ><span style="color:#1295A2;border:0px; font-size:22px;" ><b>View Details </b>
											<i class="fa fa-chevron-right" style="font-size:15px;"></i></span></a>
										</div>
									</div>
								</div>
							</div>