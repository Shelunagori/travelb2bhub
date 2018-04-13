<?php //echo $this->Html->css('/assets/loader-1.css'); ?>
<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/hotel_promotions/getHotelList.json?isLikedUserId=".$user_id.'&higestSort='.$higestSort.'&category_id='.$category_id.'&rating_filter='.$rating_filter."&submitted_from=web",
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
	//font-weight: 100;
}

.col-md-4{
	color:#000000;
	font-weight:600;
	padding-top:5px;
	 white-space: nowrap;
}
label{
	//font-weight: 100;
}
a{
	color:#ac85d6;
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
					<span class="box-title" style="color:#057F8A;"><b><?= __('Hotel Promotions') ?></b></span>
					<div class="box-tools pull-right" style="margin-top:-7px;">
						<a style="font-size:15px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
						<a style="font-size:22px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
						<a style="font-size:22px" href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'savedList',$user_id),1);?>"  class="btn btn-box-tool" ><i class="fa fa-bookmark"></i> </a>
					</div>
				</div>
			</div>
		</div>
	</div>
	 <div id="myModal123" class="modal fade" role="dialog">
					  <div class="modal-dialog modal-sm" >
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
					  <div class="modal-dialog modal-md">
						 <div class=modal-content>
							<div class=modal-header>
							   <button class="close" data-dismiss="modal" type="button">&times;</button>
							   <h4 class=modal-title>Filter</h4>
							</div>
							<form class="filter_box" method="get">
							<div class="modal-body">
								<span class="help-block"></span>
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
					<div class="col-md-3 rowspace">
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
										<span><img src="../images/view.png" height="13px"/>
										<?= h($hotelPromotion->total_views);?></span>
									</td>
								<td width="25%">
									<span>
									<?php
									//pr($hotelPromotion);
										$dataUserId=$hotelPromotion->user_id;
										$isLiked=$hotelPromotion->isLiked;
										$issaved=$hotelPromotion->issaved;
										//-- LIKES DISLIKE
										if($isLiked=='no'){
											echo $this->Form->button('<img src="../images/unlike.png" height="15px"/>',['class'=>'likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
											
										}
										if($isLiked=='yes'){
											echo $this->Form->button('<img src="../images/like.png" height="15px"/>',['class'=>' likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#F7F3F4;border:0px;']);
										}?>
								<?= h($hotelPromotion->total_likes);?></span>
								</td>
								<td width="25%">
								<?php 
									//-- Save Unsave
									if($issaved=='1'){
										echo $this->Form->button('<img src="../images/save.png" height="15px"/>',['class'=>' ','value'=>'button','type'=>'submit','name'=>'savehotelpromotion','style'=>'background-color:white;color:black;border:0px;']);
									}
									if($issaved=='0'){
										echo $this->Form->button('<img src="../images/unsave.png" height="15px"/>',['class'=>'','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'savehotelpromotion']);
									}
									?>
									
									<span style="visibility:hidden;">3</span>
								</td>
								<td width="25%">
								<?php echo $this->Html->link('<img src="../images/flag.png" height="15px"/>','#'.$hotelPromotion->id,array('escape'=>false,'class'=>'','data-target'=>'#reportmodal'.$hotelPromotion->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
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
							<div class="col-md-9" >
								<div class="col-md-5">
										<div class="row rowspace">
											<div class="col-md-12"><span style="color:#676363;font-weight:600;">Category :</span>
												<span><?= h($hotelPromotion->hotel_category->name); ?></span>
											</div>
										</div>
										<div class="row rowspace">
											<div class="col-md-12"><span style="color:#676363;font-weight:600;">Cheapest Room :</span>
											<span style="color:#1295AB">&#8377;<?= (h($hotelPromotion->cheap_tariff)) ?></span>
											</div>
										</div>
									<div class="row rowspace">
										<div class="col-md-12"><span style="color:#676363;font-weight:600;">Most Expensive Room :</span>
										<span style="color:#1295AB">&#8377;<?= (h($hotelPromotion->expensive_tariff)) ?></span>
										</div>
									</div>
								</div>
								<div class="col-md-7">
								<div class="row rowspace">
										<div class="col-md-12 "><span style="color:#676363;font-weight:600;"><?= __(' Hotelier') ?> :</span>	
										<span>
										<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$hotelPromotion->user_id),1);?>
										<a href="<?php echo $hrefurl; ?>"> 
										<?php echo "<u>".$hotelPromotion->user->first_name.' '.$hotelPromotion->user->last_name.'</u> ( '.$hotelPromotion->user_rating.'<i class="fa fa-star"></i> )';?>
										</a>
										</span>
										</div>					
									</div>
									<div class="row rowspace">
										<div class="col-md-12"><span style="color:#676363;font-weight:600;"><?= __(' Website') ?> :</span>
										<span ><a style="color:blue;" href="http://<?php echo $hotelPromotion->website; ?>" target="blank"><u><?= h($hotelPromotion->website) ?></u></a> </span>
										</div>
									</div>
									<div class="row rowspace">
										<div class="col-md-12"><span style="color:#676363;font-weight:600;"><?= __(' Location') ?> :</span>
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
																				<span><u><a href="mailto:<?php echo $hotelPromotion->user->email;?>"><?= h($hotelPromotion->user->email);?></a></u></span>
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
			<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
									<div id="loader"></div>
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