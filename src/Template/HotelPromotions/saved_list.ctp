<?php
//-- List

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/HotelPromotionCarts/HotelPromotionCartlist.json?user_id=".$user_id,
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
	$hotelPromotions=$List->hotelPromotionCarts;
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
.col-md-4{
	color:#727e8a;
	 white-space: nowrap;
}
</style>
<div class="row" >
	<div class="col-md-12">
		
	</div>
</div>
<div  class="container-fluid">
	<div class="box box-primary" style="margin-bottom:5px;">
		<div class="row" >
			<div class="col-md-12">
				<div class="box-header with-border"> 
					<span class="box-title" style="color:#057F8A;"><b><?= __('Saved Promotions') ?></b></span>
					
				</div>
			</div>
		</div>
	</div>
	
		<?php $i=1;
				if(!empty($hotelPromotions)){
					//pr($hotelPromotions);exit;
				foreach ($hotelPromotions as $hotelPromotionss){
					$hotelPromotion=$hotelPromotionss->hotel_promotion;
				?>
<div class="box-body bbb">	
			<fieldset style="background-color:#fff;">
				<form method="post" class="formSubmit">
				<input type="hidden" name="hotelpromotion_id" value="<?php echo $hotelPromotion->id; ?>">
					<div class="row">
						<div class="col-md-12" style="padding-top:5px;">
						<span style="font-size:18px;">	<?php echo $hotelPromotion->hotel_name.' ( <i class="fa fa-star" style="color:#efea65;"></i> '.$hotelPromotion->hotel_rating.' Star Hotel )';?></span>
						</div>
					</div>
					<span class="help-block"></span>
					<div class="row">						
					<div class="col-md-3">
					<?= $this->Html->image($hotelPromotion->full_image,['id'=>'myImg','style'=>'width:100%;height:80px;','data-target'=>'#imagemodal'.$hotelPromotion->id,'data-toggle'=>'modal',]) ?>
					<div id="imagemodal<?php echo $hotelPromotion->id;?>" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md">
						<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body" >
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<?= $this->Html->image($hotelPromotion->full_image,['style'=>'width:100%;height:300px;padding:20px;padding-top:0px!important;']) ?>
								</div>
							</div>
						</div>
					</div>
					<hr></hr>
					<div class="row" style="padding-top:5px;">					
						<input type="hidden" name="taxifleet_id" value="<?php echo $hotelPromotion->id; ?>">
								<table  width="100%" style="text-align:center;" >
								<tr>
								<td width="25%" >
								<span>
								<?php echo $Image=$this->Html->image('../images/view.png',['height'=>'15px']);
								?>
										<?= h($hotelPromotionss->total_views);?></span>
									</td>
								<td width="25%">
									<span>
									<?php
									//pr($hotelPromotion);
										$dataUserId=$hotelPromotionss->user_id;
										$isLiked=$hotelPromotionss->isLiked;
										$issaved=$hotelPromotionss->issaved;
										//-- LIKES DISLIKE
										if($isLiked=='no'){
											$Image=$this->Html->image('../images/unlike.png',['height'=>'15px']);
											echo $this->Form->button($Image,['class'=>'likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
											
										}
										if($isLiked=='yes'){
											$Image=$this->Html->image('../images/like.png',['height'=>'15px']);
											echo $this->Form->button($Image,['class'=>' likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#F7F3F4;border:0px;']);
										}?>
								<?= h($hotelPromotionss->total_likes);?></span>
								</td>
								<td width="25%">
								<?php 
									//-- Save Unsave
									if($issaved=='1'){
										$Image=$this->Html->image('../images/save.png',['height'=>'15px']);
										echo $this->Form->button($Image,['class'=>' ','value'=>'button','type'=>'submit','name'=>'savehotelpromotion','style'=>'background-color:white;color:black;border:0px;']);
									}
									if($issaved=='0'){
										$Image=$this->Html->image('../images/unsave.png',['height'=>'15px']);
										echo $this->Form->button($Image,['class'=>'','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'savehotelpromotion']);
									}
									?>
									
									<span style="visibility:hidden;">3</span>
								</td>
								<td width="25%">
								<?php 
								$Image=$this->Html->image('../images/flag.png',['height'=>'15px']);
								echo $this->Html->link($Image,'#'.$hotelPromotion->id,array('escape'=>false,'class'=>'','data-target'=>'#reportmodal'.$hotelPromotion->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
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
															<span class="label1">
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
												<input type="submit" class="btn btn-primary btn-md" name="report_submit" value="Report">
												<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancel</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
							<div class="col-md-9" style="padding-top:5px;">
								<div class="col-md-5">
										<div class="row rowspace">
											<div class="col-md-12"><span style="color:#727e8a;">Category :</span>
												<?= h($hotelPromotion->hotel_category->name); ?>
											</div>
										</div>
										<div class="row rowspace">
											<div class="col-md-12"><span style="color:#727e8a;">Cheapest Room :</span>
											<span style="color:#1295AB">&#8377;<?= number_format(h($hotelPromotion->cheap_tariff)) ?></span>
											</div>
										</div>
									<div class="row rowspace">
										<div class="col-md-12"><span style="color:#727e8a;">Most Expensive Room :</span>
										<span style="color:#1295AB">&#8377;<?= number_format(h($hotelPromotion->expensive_tariff)) ?></span>
										</div>
									</div>
								</div>
								<div class="col-md-7">
								<div class="row rowspace">
										<div class="col-md-12 "><span style="color:#727e8a;"><?= __(' Hotelier') ?> :</span>	
										<span>
										<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$hotelPromotion->user_id),1);?>
										<a href="<?php echo $hrefurl; ?>"> 
										<?php echo $hotelPromotion->user->first_name.' '.$hotelPromotion->user->last_name.' ( '.$hotelPromotionss->user_rating.'<i class="fa fa-star"></i> )';?>
										</a>
										</span>
										</div>					
									</div>
									<div class="row rowspace">
										<div class="col-md-12"><span style="color:#727e8a;"><?= __(' Website') ?> :</span>
										<span ><a style="color:#AD4175;" href="http://<?php echo $hotelPromotion->website; ?>" target="blank"><u><?= h($hotelPromotion->website) ?></u></a> </span>
										</div>
									</div>
									<div class="row rowspace">
										<div class="col-md-12"><span style="color:#727e8a;"><?= __(' Location') ?> :</span>
										<span ><?= h($hotelPromotion->hotel_location) ?></span>
										</div>
									</div>
									</div>
									<!-----button list-->
							<div class="row" >
								<div class="col-md-12 text-center" style="padding-top:15px;">
									<button class="btn btn-danger btn-md btnlayout" data-target="#contactdetails<?php echo $hotelPromotion->id;?>" data-toggle="modal" type="button">Contact Info</button>
								</div>

									<!------Contact Details Modal --------->
										<div id="contactdetails<?php echo $hotelPromotion->id;?>" class="modal fade" role="dialog">
													<div class="modal-dialog modal-md" >
														<!-- Modal content-->
															<div class="modal-content">
															  <div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<span class="modal-title">
																	Seller Details
																	</span>
																	</div>
																	<div class="modal-body">
																		<span class="help-block"></span>
																		<div class="row">
																		<div class="col-md-12">
																			<div class="col-md-4">Seller Name :</div>
																			<div class="col-md-8">
																				<span>
																					<?= h($hotelPromotion->user->first_name.' '.$hotelPromotion->user->last_name);?>
																					<?php
																					if($hotelPromotionss->user_rating==0)
																					{
																						echo "";
																					}
																					else{
																						echo "( ";
																						for($i=0;$i<$hotelPromotionss->user_rating;$i++)
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
																				</span>
																			</div>					
																		</div>
																	</div>
																		<div class="row">
																			<div class="col-md-12">
																			<div class="col-md-4">Mobile No :</div>
																			<div class="col-md-8">
																			<span><?= h($hotelPromotion->user->mobile_number);?></span>
																			</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-12">
																				<div class="col-md-4">Email :</div>
																				<div class="col-md-8">
																				<span><a href="mailto:<?php echo $hotelPromotion->user->email;?>"><?= h($hotelPromotion->user->email);?></a></span>
																				</div>
																			</div>
																		</div>
																		
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
		jQuery(".formSubmit").submit(function(){
						jQuery("#loader-1").show();
					});
  });
</script>