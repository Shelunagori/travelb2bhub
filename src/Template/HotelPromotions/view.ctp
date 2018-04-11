<?php
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/hotel_promotions/getHotelDetails.json?user_id=".$user_id ."&id=".$id,
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
$hotel_view=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$List=json_decode($response);
	//pr($List); exit;
	$hotelPromotion=$List->getEventPlannersDetails;
	//pr($hotelPromotion);exit;
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
<style>

.col-md-4{
	
	color:#838784;
	font-weight:bold;
}
.contact{
	border-radius:20px;
	width:130px;
	text-align:center;
	background-color:#1295A2;
}
.fleet{
	font-size:21px;	
	background-color:white;
	color:#909591;
	border:0px;
}
.unfleet{
	font-size:21px;	
	background-color:white;
	color:#d33c44;
	border:0px;
}
p{
	text-align:center;
	font-size:12px;
}
.col-md-3{
	font-weight:bold;
}
</style>
<div class="row" >
	<div class="col-md-12">
		
	</div>
</div>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
					<div class="box-body">
						<?php 
						foreach($hotelPromotion as $hotelPromotion){
							?>
							<form method="post" class="formsubmit">
							<div class="row">
								<input type="hidden" name="hotel_id" value="<?php echo $hotelPromotion->id; ?>"/>
								<div class="col-md-12">
									<h3><?= h($hotelPromotion->hotel_name) ?></h3>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6" >
									<?= $this->Html->image($hotelPromotion->full_image,['style'=>'width:100%;height:300px;']) ?>
							<div class="row" style="padding-top:5px;">
								<table  width="100%" style="text-align:center;" >
									<tr>
									<td width="25%" >
										<span>
										<?= $this->Html->image('../images/view.png',['style'=>'height:15px;']) ?>
										 
										<?= h($hotelPromotion->total_views);?></span>
									</td>
									<td width="25%">
										<span ><?php
										//
											$dataUserId=$hotelPromotion->user_id;
											$isLiked=$hotelPromotion->isLiked;
											$issaved=$hotelPromotion->issaved;
											//-- LIKES DISLIKE
											if($isLiked=='no'){
												echo $this->Form->button($this->Html->image('../images/unlike.png',['style'=>'height:15px;']),['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
											}
											if($isLiked=='yes'){
												echo $this->Form->button($this->Html->image('../images/like.png',['style'=>'height:15px;']),['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#000;border:0px;']);
											}
										?>
										<?= h($hotelPromotion->total_likes);?></span>
									</td>
									<td width="25%">
									<?php 
											//-- Save Unsave
											if($issaved=='1'){
												echo $this->Form->button($this->Html->image('../images/save.png',['style'=>'height:15px;']),['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>' savehotelpromotion','style'=>'background-color:white;color:#000;border:0px;']);
											}
											if($issaved=='0'){
												echo $this->Form->button($this->Html->image('../images/unsave.png',['style'=>'height:15px;']),['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>'savehotelpromotion','style'=>'background-color:white;color:#000;border:0px;']);
											}
											?>
											<span style="visibility:hidden;">3</span>
									</td>
									<td width="25%">
									 
										<?php echo $this->Html->link($this->Html->image('../images/flag.png',['style'=>'height:15px;']),'#'.$hotelPromotion->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#reportmodal'.$hotelPromotion->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
										<span style="visibility:hidden;">3</span>
									</td>
										<!--------Hidden Field Delete-------------------> 			
											<div style="display:none;">
												<?php 
												if($dataUserId==$user_id){
													echo $this->Html->link('<i class="fa fa-trash" > Delete</i>','api address'.$hotelPromotion->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#deletemodal'.$hotelPromotion->id,'data-toggle'=>'modal'));?>
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
																		<button type="submit" class="btn btn-danger" name="removeposttravle" value="yes" >Yes</button>
																		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
																	</div>
																</div>
															</div>
														</div>
												<!-------Delete Modal End--------->	
												<?php }?>
											</div>
											<div id="reportmodal<?php echo $hotelPromotion->id;?>" class="modal fade" role="dialog">
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
																<span class="help-block"></span>
															</div>
															<div class="modal-footer" style="height:60px;">
																<input type="submit" class="btn btn-info btn-md" name="report_submit" value="Report">
																<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
																</div>
															</div>
														</div>
													</div>
												</tr>
											</table>
										</div>
									</div>
										<div class="col-md-6">
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Location') ?>:</div>
													<div class="col-md-8">
														<label >	<?= h($hotelPromotion->hotel_location) ?></label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Hotel Category') ?>:</div>
													<div class="col-md-8">
														<label ><?= h($hotelPromotion->hotel_category->name); ?></label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Website') ?>:</div>
													<div class="col-md-8">
														<label ><?= h($hotelPromotion->website); ?></label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Hotel Rating') ?>:</div>
													<div class="col-md-8">
														<label ><?php
														if($hotelPromotion->hotel_rating==0)
														{
															echo "No Rating";
														}
														else{
															
															for($i=0;$i<$hotelPromotion->hotel_rating;$i++)
															{
																echo "<i class='fa fa-star' style='font-size:10px;color:#959191;'></i> ";
																if($i==0)
																{
																	echo "";
																}
															}
															
															}
													?></label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Promotion Duration') ?>:</div>
													<div class="col-md-8">
														<label style="color:#FB6542"><?=h($hotelPromotion->price_master->week); ?></label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Total Charges') ?>:</div>
													<div class="col-md-8">
														<label style="color:#1295AB"><?= $this->Number->format($hotelPromotion->total_charges) ?> &#8377;</label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Visible Date') ?>:</div>
													<div class="col-md-8">
														<label ><?= date('d-M-Y',strtotime($hotelPromotion->visible_date)); ?></label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4 lbwidth">Seller :</div>		
													<div class="col-md-8 lbwidth11"><label>
													<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$hotelPromotion->user_id),1);?>
													<a href="<?php echo $hrefurl; ?>"> 
													<?php echo $hotelPromotion->user->first_name.' '.$hotelPromotion->user->last_name.' ( '.$hotelPromotion->user_rating.' <i class="fa fa-star"></i> )';?>
													</a>
													</label>
													</div>					
												</div>
												<div class="help-block">
												<div class="row col-md-12 text-center">
											<?php
											echo $this->Html->link('<b>Contact Info</b>','address'.$hotelPromotion->id,array('escape'=>false,'class'=>'btn btn-info btn-md contact','data-target'=>'#contactviews'.$hotelPromotion->id,'data-toggle'=>'modal'));?>
											</div>
												<!-------Contact Details Modal --------->
												<div id="contactviews<?php echo $hotelPromotion->id;?>" class="modal fade" role="dialog">
													<div class="modal-dialog modal-md" >
														<!-- Modal content-->
															<div class="modal-content">
															  <div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title">
																	Seller Details
																	</h4>
																	</div>
																<div class="modal-body">
																	<span class="help-block"></span>
																	<div class="row">
																		<div class="col-md-12">
																			<div class="col-md-4">Seller Name :</div>
																			<div class="col-md-8">
																				<label>
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
																							echo "<i class='fa fa-star' style='font-size:10px;color:#efea65;'></i>";
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
																		<label><?= h($hotelPromotion->user->mobile_number);?></label>
																		</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-12">
																			<div class="col-md-4">Email :</div>
																			<div class="col-md-8">
																			<label><a href="mailto:<?php echo $hotelPromotion->user->email;?>"><?= h($hotelPromotion->user->email);?></a></label>
																			</div>
																		</div>
																	</div>
																	<div class="row" style="display:none;">
																		<div class="col-md-12">
																			<div class="col-md-4">Location :</div>
																			<div class="col-md-8">
																			<label><?= h($hotelPromotion->user->location);?></label>
																			</div>
																		</div>
																	</div>
																</div>
																	<div class="modal-footer" style="height:60px;">
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
									<?php }?>
									</div>
								</div>
							</div>
						</div>
						<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
						<div id="loader"></div></div>
	</section>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script type='text/javascript'>

  $(document).ready(function(){
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
		})
					jQuery(".formsubmit").submit(function(){
						jQuery("#loader-1").show();
					});
  });
</script>
							
					