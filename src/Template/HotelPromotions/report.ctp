<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/hotel_promotions/getHotelList.json?isLikedUserId=".$user_id.'&higestSort='.$higestSort.'&category_id='.$category_id.'&rating_filter='.$rating_filter,
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
        img {
            cursor: pointer;
        transition: -webkit-transform 0.1s ease
        }
    img:focus {
        -webkit-transform: scale(4);
        -ms-transform: scale(2);
    }
	
fieldset{
	margin:10px !important;
	border-radius: 6px;
}
.col-md-12 {
	margin:5px !important;
}
.fleet{
	font-size:25px;	
	background-color:white;
	color:#909591;
	border:0px;
}
.p{
	color:#909591;
}
</style>
<div class="row" >
	<div class="col-md-12">
		
	</div>
</div>
	<div  class="container-fluid">
		<div class="box box-primary">
			<div class="row" >
				<div class="col-md-12">
					<div class="box-header with-border"> 
						<span class="box-title" style="color:#057F8A;"><b><?= __('Hotel Promotions') ?></b></span>
						<div class="box-tools pull-right" style="margin-top:-5px;">
							<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
							<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
						</div>
					</div>
				</div>
			</div>
	<div class="box-body">
            <div id="myModal123" class="modal fade" role="dialog">
					  <div class="modal-dialog " style="width:22%;">
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
										<input type="submit" class="btn btn-primary btn-sm">
										<a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
									</div>
							  </div>
						</div>
						</form>
						</div>
						</div>
					</div>
            <div class="fade modal form-modal" id="myModal122" role="dialog">
					  <div class="modal-dialog " style="width:35%;" >
						 <div class=modal-content>
							<div class=modal-header>
							   <button class="close" data-dismiss="modal" type="button">&times;</button>
							   <h4 class=modal-title>Filter</h4>
							</div>
							<form class="filter_box" method="get">
							<div class="modal-body">
								<div class="row form-group margin-b10">
									<div class=col-md-12>
										 <div class=col-md-3>
										  <label class="col-form-label"for=example-text-input>Category</label>
										  </div>
										  <div class=col-md-1>:</div>
										 <div class=col-md-7>
										<?php $options=array();
											foreach($hotelcategory as $country)
											{
												$options[] = ['value'=>$country->id,'text'=>$country->name];
											};echo $this->Form->input('category_id', ['options' => $options,'class'=>'form-control select2','label'=>false,'empty'=>'Select...']);
										?>
										</div>
									 </div>
									</div>
									
									<div class="row form-group margin-b10">
										<div class=col-md-12>
										  <div class=col-md-3>
										 <label class="col-form-label" for=example-text-input>Rating</label>
										 </div>
										<div class=col-md-1>:</div>
										 <div class=col-md-7>
											<select name="rating_filter" class="form-control select2">
												<option value="">Select...</option>
												<option>1 </option>
												<option>2</option>
												<option>3</option>
												<option>4</option>
												<option>5</option>							
											</select>
										 </div>
										</div>	
									</div>
								
								  </div>
								<div class="modal-footer">
									<button class="btn btn-primary btn-sm" name="submit" value="Submit" type="submit">Filter</button> 
									<a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
								</div>
							</form>
						</div>
					  </div>
					</div>
					<?php $i=1;
						if(!empty($hotelPromotions)){
						foreach ($hotelPromotions as $hotelPromotion){
						?>
						<div class="row">
							<fieldset>
								<form method="post">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-4">
											<?= $this->Html->image($hotelPromotion->full_image,['style'=>'width:100%;height:250px;']) ?>
											</div>
											<div class="col-md-8">
												<input type="hidden" name="event_id" value="<?php echo $hotelPromotion->id; ?>">
												<div class="row">
													<div class="col-md-6 pull-left">
															<h3><?php echo $hotelPromotion->hotel_name;?></h3>
													</div>
													<div class="col-md-6 pull-right">
														<div class="row col-md-12">
															<div class="col-md-3">
															<?php 
															echo $this->Html->link('<i class="fa fa-eye fleet"></i>','/HotelPromotions/view/'.$hotelPromotion->id,array('escape'=>false,'class'=>'btn btn-primary btn-xs ','style'=>'background-color:white;border:0px;'));?>
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
																	echo $this->Form->button('<i class="fa fa-heart-o like fleet" > </i>',['class'=>'btn btn-danger btn-xs likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#F7F3F4;border:0px;']);
																}
															?>
															</div>
															<div class="col-md-3">
																<?php 
																//-- Save Unsave
																if($issaved=='1'){
																	echo $this->Form->button('<i class="fa fa-bookmark-o fleet"></i>',['class'=>'btn btn-danger btn-xs  ','value'=>'button','type'=>'submit','name'=>'savehotelpromotion','style'=>'background-color:white;color:black;border:0px;']);
																}
																if($issaved=='0'){
																	echo $this->Form->button('<i class="fa fa-bookmark-o fleet"></i>',['class'=>'btn btn-primary btn-xs ','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'savehotelpromotion']);
																}
																?>
																</div>
																<div class="col-md-3">
																	<?php echo $this->Html->link('<i class="fa fa-flag-o fleet"></i>','#'.$hotelPromotion->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','data-target'=>'#reportmodal'.$hotelPromotion->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
																					<!-------Report Modal Start--------->
																		<div id="reportmodal<?php echo $hotelPromotion->id;?>" class="modal fade" role="dialog">
																			<div class="modal-dialog modal-md">
																				<!-- Modal content-->
																					<div class="modal-content">
																					  <div class="modal-header">
																						<button type="button" class="close" data-dismiss="modal">&times;</button>
																						<h3 class="modal-title">Report</h3>
																					  </div>
																						<div class="modal-body" style="height:150px;margin-top:30px;">
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
																										<textarea class="form-control " rows="3" type="text" placeholder="Enter Your Suggestion here..." name="comment"></textarea>	
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="modal-footer" style="height:60px;">
																							<input type="submit" class="btn btn-primary btn-md" name="report_submit" value="Report">
																							<a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'report')) ?>"class="btn btn-danger btn-md">Cancle</a>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	<!-------Report Modal End--------->	
																<div style="display:none;">
																<?php 
																if($dataUserId==$user_id){
																echo $this->Html->link('<i class="fa fa-trash" > Delete</i>','api address'.$hotelPromotion->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','data-target'=>'#deletemodal'.$hotelPromotion->id,'data-toggle'=>'modal'));?>
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
													</div>
													<div class="row col-md-12">
														<div class="col-md-3">Seller Name </div><div class="col-md-1">:</div>		
														<div class="col-md-8"><label><u>
														<?= h($hotelPromotion->user->first_name.' '.$hotelPromotion->user->last_name);?></u>
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
									</form>
								</fieldset>
							</div>
					<?php }
					}
						else {
							echo"<div class='row col-md-12 text-center'><tr><th colspan='10' ><span>No Record Found</span></th></tr></div>";
						}?>
					</div>
				</div>
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
  });
</script>