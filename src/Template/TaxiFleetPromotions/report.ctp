<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php
//-- LIST 
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/TaxiFleetPromotions/getTaxiFleetPromotions.json?isLikedUserId=".$user_id."&higestSort=".$higestSort."&country_id=".$country_id."&city_id=".$city_id."&state_id=".$state_id."&car_bus_id=".$car_bus_id,
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
	$taxiFleetPromotions=$List->getTaxiFleetPromotions;
}
//--- COUNTRY STATE & CITY
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."pages/masterCountry",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 39e47dc1-a66a-2347-2fc6-3b5e0160d26d"
  ),
));
$masterCountry = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$countries=array();
$states=array();
$city=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$masterCountry=json_decode($masterCountry);
	$countries=$masterCountry->countryData->ResponseObject;
	$states=$masterCountry->stateData->ResponseObject;
	$city=$masterCountry->cityData->ResponseObject;
}
//-- BUSES LIST 
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/taxi_fleet_car_buses/index.json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: f0bdc3fd-dd35-cc7d-9c8b-a8ebdcf4b05e"
  ),
));
$Result = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$TaxiFleetCarBuses=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
$TaxiFleetCarBuses=json_decode($Result);
$TaxiFleetCarBuses=$TaxiFleetCarBuses->TaxiFleetCarBuses;
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
.hr{
	margin-top:25px !important;
}
	
a:hover,a:focus{
    outline: none !important;
    text-decoration: none !important;
}
.tab .nav-tabs{
    display: inline-block !important;
    background: #F0F0F0 !important;
    border-radius: 50px !important;
    border: none !important;
    padding: 1px !important;
}
.tab .nav-tabs li{
    float: none !important;
    display: inline-block !important;
    position: relative !important;
}
.tab .nav-tabs li a{
    font-size: 16px !important;
    font-weight: 700 !important;
    background: none !important;
    color: #999 !important;
    border: none !important;
    padding: 10px 15px !important;
    border-radius: 50px !important;
    transition: all 0.5s ease 0s !important;
}
.tab .nav-tabs li a:hover{
    background: #1295A2 !important;
    color: #fff !important;
    border: none !important;
}
.tab .nav-tabs li.active a,
.tab .nav-tabs li.active a:focus,
.tab .nav-tabs li.active a:hover{
    border: none !important;
    background: #1295A2 !important;
    color: #fff !important;
}
.tab .tab-content{
    font-size: 14px !important;
    color: #686868 !important;
    line-height: 25px !important;
    text-align: left !important;
    padding: 5px 20px !important;
}
.tab .tab-content h3{
    font-size: 22px !important;
    color: #5b5a5a !important;
} 
fieldset{
	margin:10px !important;
	border-radius: 6px;
}
.col-md-12 {
	margin:5px !important;
}

</style> 
<div  class="container-fluid">
<div class="box box-primary">
	<div class="row equal_column">
		<div class="col-md-12" style="background-color:#"> 
			<br>
			<?php echo  $this->Flash->render() ?>
		</div>
	</div>
	<div class="row" style="padding:5px;">
		<div class="col-md-12">
			<div class="box-header with-border"> 
				<h1 class="box-title" style="color:#057F8A;"><b>Taxi Fleet Promotions</b></h1>
				<div class="box-tools pull-right">
					<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
					<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
				</div>
			</div>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
		    <div id="myModal123" class="modal fade" role="dialog">
			  <div class="modal-dialog " style=" width: 22%;">
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
								<a href="<?php echo $this->Url->build(array('controller'=>'TaxiFleetPromotions','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
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
								  <label class="col-form-label"for=example-text-input>Country</label>
								  </div>
								  <div class=col-md-1>:</div>
								 <div class=col-md-7>
								<?php $options=array();
									foreach($countries as $country)
									{
										$options[] = ['value'=>$country->id,'text'=>$country->country_name];
									};echo $this->Form->input('country_id', ['options' => $options,'class'=>'form-control select2','label'=>false,'empty'=>'Select...']);
								?>
								</div>
							 </div>
							</div>
							<div class="row form-group margin-b10">
								<div class=col-md-12>
									<div class=col-md-3>
										<label class="col-form-label"for=example-text-input>State</label>
									</div>
									<div class=col-md-1>:</div>
									<div class=col-md-7>
									<?php 
										$options=array();
										foreach($states as $st)
										{
											$options[] = ['value'=>$st->id,'text'=>$st->state_name];
										};
										echo $this->Form->input('state_id', ['options' => $options,'class'=>'form-control select2','label'=>false,'empty'=>'Select...']); 
									?> 
									</div>
								 </div>
							 </div>
							<div class="row form-group margin-b10">
								<div class=col-md-12>
								  <div class=col-md-3>
								 <label class="col-form-label" for=example-text-input>City</label>
								 </div>
								<div class=col-md-1>:</div>
								 <div class=col-md-7>
									 <?php 
									$options=array();
									foreach($city->citystatefi as $cty)
									{
										$options[] = ['value'=>$cty->cityid,'text'=>$cty->name];
									};
									echo $this->Form->input('city_id', ['options' =>$options,'class'=>'form-control select2','label'=>false,'empty'=>'Select...']); ?>
								 </div>
								</div>	
							</div>
							<div class="row form-group margin-b10">
								<div class=col-md-12>
								  <div class=col-md-3>
								 <label class="col-form-label" for=example-text-input>Vehicle Type</label>
								 </div>
								<div class=col-md-1>:</div>
								 <div class=col-md-7>
									 <?php 
									$options=array();
									foreach($TaxiFleetCarBuses as $Buses)
									{
										$options[] = ['value'=>$Buses->id,'text'=>$Buses->name];
									};
									echo $this->Form->control('car_bus_id', ['label'=>false,"id"=>"multi_vehicle", "type"=>"select",'options' =>$options, "class"=>"form-control select2","style"=>"height:125px;",'empty'=>'Select...']);?>
								 </div>
								</div>	
							</div>
						  </div>
						<div class="modal-footer">
							<button class="btn btn-primary btn-sm" name="submit" value="Submit" type="submit">Filter</button> 
							<a href="<?php echo $this->Url->build(array('controller'=>'TaxiFleetPromotions','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
						</div>
					</form>
				 </div>
			  </div>
		   </div>
		    <?php $i=1;
			if(!empty($taxiFleetPromotions)){
			foreach ($taxiFleetPromotions as $taxiFleetPromotion){ $i++; ?>
			<fieldset>
				<form method="post">
				<div class="row">
				<div class="col-md-4">
				<?= $this->Html->image('../images/8.jpg',['style'=>'width:100%;']) ?>
				</div>
				<div class="col-md-8">			
					<div class="row">
						<div class="col-md-12">
							<legend><h3><?= h($taxiFleetPromotion->title) ?></h3></legend>
						</div>
						<h4>
							<div class="row col-md-12">
								<ul>
								<li class="col-md-2">Duration</li>		
								<li class="col-md-2"><?= h($taxiFleetPromotion->price_master->week); ?></b></li>
								<li class="col-md-3">User Name</li>		
								<li class="col-md-3"><?= h($taxiFleetPromotion->user->first_name.' '.$taxiFleetPromotion->user->last_name.' ( '.$taxiFleetPromotion->user_rating.' )');?>
								</li>
								</ul>						
							</div><span class="help-block"></span>
							<div class="row col-md-12">
								<ul>
								<li class="col-md-2">Price</li>		
								<li class="col-md-2"><?= h($taxiFleetPromotion->price_master->price);?> &#8377;</li>						
								<li class="col-md-3">Visibility Date</li>		
								<li class="col-md-3"><?= h(date('d-m-Y',strtotime($taxiFleetPromotion->visible_date))); ?></li>
								</ul>						
							</div>
						</h4>
						<span class="help-block"></span>
					<div class="row ">
						<div class="col-md-12">
							<div class="col-md-1">
								<input type="hidden" name="taxifleet_id" value="<?php echo $taxiFleetPromotion->id; ?>">
							<?php
							//pr($taxiFleetPromotion);
								$dataUserId=$taxiFleetPromotion->user_id;
								$isLiked=$taxiFleetPromotion->isLiked;
								$issaved=$taxiFleetPromotion->issaved;
								//-- LIKES DISLIKE
								if($isLiked=='no'){
									echo $this->Form->button('<i class="fa fa-thumbs-up like" > Like</i>',['class'=>'btn btn-primary btn-xs likes','value'=>'button','style'=>'background-color:#1295A2','type'=>'submit','name'=>'LikeEvent']);
								}
								if($isLiked=='yes'){
									echo $this->Form->button('<i class="fa fa-thumbs-down like" > Unlike</i>',['class'=>'btn btn-danger btn-xs likes','value'=>'button','type'=>'submit','name'=>'LikeEvent']);
								}
							?>
							</div>
							<div class="col-md-1">							
							<?php 
							echo $this->Html->link('<i class="fa fa-search"> View</i>','/TaxiFleetPromotions/view/'.$taxiFleetPromotion->id,array('escape'=>false,'class'=>'btn btn-primary btn-xs','style'=>'background-color:#1295A2'));?>
							</div>
							<div class="col-md-1">
							<?php echo $this->Html->link('<i class="fa fa-flag"> Report</i>','#'.$taxiFleetPromotion->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','data-target'=>'#reportmodal'.$taxiFleetPromotion->id,'data-toggle'=>'modal','style'=>'background-color:#1295A2;'));?>
											<!-------Report Modal Start--------->
								<div id="reportmodal<?php echo $taxiFleetPromotion->id;?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md">
										<!-- Modal content-->
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Report</h4>
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
											<div class="col-md-1">
											<?php
												if($dataUserId==$user_id){
												echo $this->Html->link('<i class="fa fa-trash" > Delete</i>','api address'.$taxiFleetPromotion->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','data-target'=>'#deletemodal'.$taxiFleetPromotion->id,'data-toggle'=>'modal'));?>
													<!-------Delete Modal Start--------->
												<div id="deletemodal<?php echo $taxiFleetPromotion->id;?>" class="modal fade" role="dialog">
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
																	<button type="submit" class="btn btn-danger" name="removetaxifleet" value="yes" >Yes</button>
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
							</div>	
						 
						</div>	
					</form>	
				</fieldset>
					
			<?php      }
								} else{
										echo"<tr><th colspan='10' style='text-align:center'>No Record Found</th></tr>";
									}
										?>
									

							<!--<div class="paginator">
								<ul class="pagination">
									<?= $this->Paginator->first('<< ' . __('first')) ?>
									<?= $this->Paginator->prev('< ' . __('previous')) ?>
									<?= $this->Paginator->numbers() ?>
									<?= $this->Paginator->next(__('next') . ' >') ?>
									<?= $this->Paginator->last(__('last') . ' >>') ?>
								</ul>
								<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
							</div>--->
							</div>
						</div>
					</div>
				</div>
				</div>

	<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>	 
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