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
?>
<div  class="container-fluid">
	<div class="row equal_column">
		<div class="col-md-12" style="background-color:#fff"> 
			<br>
			<?php echo  $this->Flash->render() ?>
		</div>
		<div class="col-md-12" style="background-color:#fff"> 
			<div class="box box-default">
			<div class="box-header with-border"> 
				<h1 class="box-title" style="padding:10px;color:#057F8A;"><b>Taxi Fleet Promotions</b></h1>
				<div class="box-tools pull-right">
					<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
					<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
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
			
			
	<table class="table" cellpadding="0" cellspacing="0">
        <thead>
            <tr style="background-color:#709090;color:white">
                <th scope="col"><?= ('Sr.No') ?></th>
				<th scope="col"><?= ('User Name') ?></th>
                <th scope="col"><?= ('Title') ?></th>
                <th scope="col"><?= ('Duration') ?></th>
                <th scope="col"><?= ('Visibility Date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1;foreach ($taxiFleetPromotions as $taxiFleetPromotion): ?>
            <tr>
                <td><?= $i; ?></td>
				<td><?= h($taxiFleetPromotion->user->first_name.' '.$taxiFleetPromotion->user->last_name.' ( '.$taxiFleetPromotion->user_rating.' )');?></td>
                <td><?= h($taxiFleetPromotion->title) ?></td>
                <td><?= h($taxiFleetPromotion->price_master->week); ?></td>              
                <td><?= h(date('d-m-Y',strtotime($taxiFleetPromotion->visible_date))); ?></td>
				<td class="actions" >
					 <span>
						<?php echo $this->Form->button('<i class="fa fa-thumbs-up"> Like</i>',['class'=>'btn btn-primary btn-xs likes','value'=>'button','style'=>'background-color:#1295A2']); ?>
							<a href="<?php echo $this->Url->build(["controller" => "TaxiFleetPromotions",'action'=>"view",$taxiFleetPromotion->id]); ?>"><?php echo $this->Form->button('<i class="fa fa-eye"> View</i>',['class'=>'btn btn-primary btn-xs','value'=>'button']); ?></a>
							<?php echo $this->Html->link('<i class="fa fa-flag"> Report</i>','#'.$taxiFleetPromotion->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','data-target'=>'#reportmodal','data-toggle'=>'modal'));?>
											<!-------Report Modal Start--------->
													<div id="reportmodal" class="modal fade" role="dialog">
														<div class="modal-dialog modal-md" >
															<!-- Modal content-->
																<div class="modal-content">
																  <div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title"></h4>
																  </div>
																<form method="get" class="filter_box">
																	<div class="modal-body" style="height:100px;">
																		<div class="col-md-12 row form-group ">
																			<div class="col-md-12 radio">
																				<h3>
																				<label>
																					<select><option>Select Report Reason</option></select>
																				</label>
																				</h3>
																			</div>
																		</div>
																	</div>
																	<div class="modal-footer" style="height:60px;">
																		<input type="submit" class="btn btn-primary btn-md" value="OK">
																		<a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'report')) ?>"class="btn btn-danger btn-md">Cancle</a>
																	</div>
																</form>
															</div>
														</div>
													</div>
											<!-------Report Modal End--------->	
											<?php echo $this->Html->link('<i class="fa fa-bookmark"> Save</i>','#'.$taxiFleetPromotion->id,array('escape'=>false,'class'=>'btn btn-success btn-xs','data-target'=>'#savemodal','data-toggle'=>'modal'));?>
										<!-------Save Modal Start--------->
												<div id="savemodal" class="modal fade" role="dialog">
													<div class="modal-dialog modal-md" >
														<!-- Modal content-->
															<div class="modal-content">
															  <div class="modal-header" style="height:100px;">
																<form method="get" class="filter_box">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title">
																	Are You Sure, to save this promotion in your cart ???
																	</h4>
															</div>
																<div class="modal-footer" style="height:60px;">
																	<input type="submit" class="btn btn-primary btn-md" value="OK">
																	<a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'report')) ?>"class="btn btn-danger btn-md">Cancle</a>
																</div>
																</form>
															</div>
														</div>
													</div>
											<!-------Save Modal End--------->	
					
						<?php echo $this->Html->link('<i class="fa fa-trash" > Delete</i>','api address'.$taxiFleetPromotion->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','data-target'=>'#deletemodal','data-toggle'=>'modal'));?>
							<!-------Delete Modal Start--------->
												<div id="deletemodal" class="modal fade" role="dialog">
													<div class="modal-dialog modal-md" >
														<!-- Modal content-->
															<div class="modal-content">
															  <div class="modal-header" style="height:100px;">
																<form method="get" class="filter_box">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title">
																	Are You Sure, you want to remove this promotion???
																	</h4>
																</div>
																<div class="modal-footer" style="height:60px;">
																	<input type="submit" class="btn btn-primary btn-md" value="OK">
																	<a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'report')) ?>"class="btn btn-danger btn-md">Cancle</a>
																</div>
															</form>
														</div>
													</div>
												</div>
											<!-------Delete Modal End--------->	
					</span>
				</td>
            </tr>
            <?php $i++;endforeach; ?>
        </tbody>
    </table>
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
