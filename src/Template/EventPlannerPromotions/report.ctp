<?php

//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/EventPlannerPromotions/getEventPlanners.json?isLikedUserId=".$user_id."&higestSort=".$higestSort."&country_id=".$country_id."&city_id=".$city_id."&state_id=".$state_id,
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
 	$eventPlannerPromotions=$List->getEventPlanners;
}
//pr($eventPlannerPromotions);
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


 ?>
 
<div id="my_final_responses" class="container-fluid">
	<div class="row equal_column">
		<div class="col-md-12" style="background-color:#fff"> 
			<br>
			<?php echo  $this->Flash->render() ?>
		</div>
		<div class="col-md-12" style="background-color:#fff"> 
			<div class="box box-default">
				<div class="box-header with-border"> 
					<h3 class="box-title" style="padding:10px;color:#057F8A;"><b><?= __('Event Planner Promotions') ?></b></h3>
					<div class="box-tools pull-right">
						<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
						<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
 					</div>
 				</div>
				<div class="box-body">
				<!-------SHORTING FILTERING--------->
 			
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
									<a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'report')) ?>"class="btn btn-primary btn-sm">Reset</a>
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
											echo $this->Form->input('state_id', ['options' => $options,'class'=>'form-control select2','label'=>false,"data-placeholder"=>"Select States",'empty'=>'Select...']); 
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
										echo $this->Form->input('city_id', ['options' =>$options,'class'=>'form-control select2','label'=>false,"data-placeholder"=>"Select Cities",'empty'=>'Select...']); ?>
									 </div>
									</div>	
								</div>
                              </div>
							<div class="modal-footer">
								<button class="btn btn-primary btn-sm" name="submit" value="Submit" type="submit">Filter</button> 
								<a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'report')) ?>"class="btn btn-primary btn-sm">Reset</a>
							</div>
						</form>
                     </div>
                  </div>
               </div>
 					<table class="table" cellpadding="0" cellspacing="0">
						<thead>
							 <tr style="background-color:#709090;color:white;">
								<th scope="col"><?= ('Sr.No') ?></th>
								<th scope="col"><?= ('User Name') ?></th>
								<th scope="col"><?= ('Country') ?></th>
								<th scope="col"><?= ('Duration') ?></th>
								<th scope="col"><?= ('Price') ?> (&#8377;)</th>
								<th scope="col"><?= ('Visibility Date') ?></th>
								<th scope="col" class="actions"><?= __('Actions') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;
 						
							if(!empty($eventPlannerPromotions)){
							foreach ($eventPlannerPromotions as $eventPlannerPromotion): ?>
							<tr>
								<td><?= $i; ?></td>
								<td><?= h($eventPlannerPromotion->user->first_name.$eventPlannerPromotion->user->last_name);?></td>
								<td><?= h($eventPlannerPromotion->country->country_name); ?></td>
								<td><?= h($eventPlannerPromotion->price_master->week); ?></td>
								<td><?= h($eventPlannerPromotion->price_master->price); ?></td>
								<td><?= h(date('d-m-Y',strtotime($eventPlannerPromotion->visible_date))); ?></td>	
								<td class="actions" style="width:30%;">
									<form method="POST">
										<span>
											<input type="hidden" name="event_id" value="<?php echo $eventPlannerPromotion->id; ?>">
										  <?php
											//pr($eventPlannerPromotion);
											$dataUserId=$eventPlannerPromotion->user_id;
											$isLiked=$eventPlannerPromotion->isLiked;
											$issaved=$eventPlannerPromotion->issaved;
											//-- LIKES DISLIKE
											if($isLiked=='no'){
												echo $this->Form->button('<i class="fa fa-thumbs-up like" > Like </i>',['class'=>'btn btn-primary btn-xs likes','value'=>'button','style'=>'background-color:#1295A2','type'=>'submit','name'=>'LikeEvent']);
											}
											if($isLiked=='yes'){
												echo $this->Form->button('<i class="fa fa-thumbs-down like" > Dislike </i>',['class'=>'btn btn-primary btn-xs likes','value'=>'button','style'=>'background-color:#d6796e','type'=>'submit','name'=>'LikeEvent']);
											}
										?>	
										<?php 
												echo $this->Html->link('<i class="fa fa-search"> View</i>','/EventPlannerPromotions/view/'.$eventPlannerPromotion->id,array('escape'=>false,'class'=>'btn btn-primary btn-xs'));?>	
									
											<?php // echo $this->Html->link('<i class="fa fa-flag"> Report</i>','#'.$eventPlannerPromotion->id,array('escape'=>false,'class'=>'btn btn-warning btn-xs','data-target'=>'#reportmodal','data-toggle'=>'modal'));?>	
											<?php echo $this->Form->button('<i class="fa fa-flag"> Report</i>',['class'=>'btn btn-primary btn-xs','value'=>'button','data-target'=>'#reportmodal','data-toggle'=>'modal']); ?>
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
										
										<?php 
										if($issaved=='1'){
												echo $this->Form->button('<i class="fa fa-save" > Unsave </i>',['class'=>'btn btn-primary btn-xs ','value'=>'button','style'=>'background-color:#1295A2','type'=>'submit','name'=>'saveeventplanner']);
											}
											if($issaved=='0'){
												echo $this->Form->button('<i class="fa fa-save" > Save </i>',['class'=>'btn btn-primary btn-xs ','value'=>'button','style'=>'background-color:#d6796e','type'=>'submit','name'=>'saveeventplanner']);
											}
										echo $this->Form->button('<i class="fa fa-bookmark"> Save</i>',['class'=>'btn btn-success btn-xs','value'=>'button','data-target'=>'#savemodal','data-toggle'=>'modal']); ?>
											<!-------Save Modal Start--------->
												<div id="savemodal" class="modal fade" role="dialog">
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
																			Are You Sure, this promotion will added to your Cart.
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
										<?php 
										if($dataUserId==$user_id){
											echo $this->Html->link('<i class="fa fa-trash"> Delete</i>','api address'.$eventPlannerPromotion->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','data-target'=>'#deletemodal','data-toggle'=>'modal', $eventPlannerPromotion->id));
											?>
											<div id="deletemodal" class="modal fade" role="dialog">
											  <div class="modal-dialog">
												<!-- Modal content-->
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Are you sure, you want delete this Promotion ?</h4>
												  </div> 
												  <div class="modal-footer">
													<button type="submit" class="btn btn-danger" name="removeEvent" value="yes" >Yes</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												  </div>
												
												</div>
											  </div>
											</div>
										<?php		
										}
										?>
										</span>
									</form>
								</td>
							</tr>
							 <?php $i++;endforeach;
							}
							else
							{
								echo"<tr><th colspan='10' style='text-align:center'>No Record Found</th></tr>";
							}							?>
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
 