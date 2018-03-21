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
				<h1 class="box-title" style="color:#057F8A; padding:10px"><b><?= __('Hotel Promotions') ?></b></h1>
				<div class="box-tools pull-right">
					<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
					<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
				</div>
			</div>
	<div class="box-body">
		<div class="row">
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
				<table class="table" cellpadding="0" cellspacing="0">
					<thead>
					  <tr style="background-color:#709090;color:white">
							<th scope="col"><?= ('Sr.No') ?></th>
							<th scope="col"><?= ('Seller Name') ?></th>
							<th scope="col"><?= ('Hotel Name') ?></th>
							<th scope="col"><?= ('Location') ?></th>
							<th scope="col"><?= ('Category') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;
						if(!empty($hotelPromotions)){
						foreach ($hotelPromotions as $hotelPromotion): 
						?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?= h($hotelPromotion->user->first_name.' '.$hotelPromotion->user->last_name.'( '.$hotelPromotion->user_rating.' )');?></td>
							<td><?= h($hotelPromotion->hotel_name) ?></td>
							<td><?= h($hotelPromotion->hotel_location) ?></td>
							<td><?= h($hotelPromotion->hotel_category->name) ?></td>
							<td class="actions" style="width:30%;">
							<form method="POST">
								 <span>
									<input type="hidden" name="hotelpromotion_id" value="<?php echo $hotelPromotion->id; ?>">
									<?php
									
										$dataUserId=$hotelPromotion->user_id;
										$isLiked=$hotelPromotion->isLiked;
										//-- LIKES DISLIKE
										if($isLiked=='no'){
											echo $this->Form->button('<i class="fa fa-thumbs-up like" > Likes </i>',['class'=>'btn btn-primary btn-xs likes','value'=>'button','style'=>'background-color:#1295A2','type'=>'submit','name'=>'LikeEvent']);
										}
										if($isLiked=='yes'){
											echo $this->Form->button('<i class="fa fa-thumbs-down like" > Dislikes </i>',['class'=>'btn btn-primary btn-xs likes','value'=>'button','style'=>'background-color:#d6796e','type'=>'submit','name'=>'LikeEvent']);
										}
									?>	
									<?php 
									echo $this->Html->link('<i class="fa fa-search"> View</i>','/HotelPromotions/view/'.$hotelPromotion->id,array('escape'=>false,'class'=>'btn btn-primary btn-xs','style'=>'background-color:#1295A2'));?>	
									<?php echo $this->Html->link('<i class="fa fa-flag"> Report</i>','#'.$hotelPromotion->id,array('escape'=>false,'class'=>'btn  btn-primary btn-xs','data-target'=>'#reportmodal','data-toggle'=>'modal','style'=>'background-color:#1295A2'));?>
											<!-------Report Modal Start--------->
													<div id="reportmodal" class="modal fade" role="dialog">
														<div class="modal-dialog modal-md" >
															<!-- Modal content-->
																<div class="modal-content">
																  <div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title"></h4>
																  </div>
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
																		<a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'report')) ?>"class="btn btn-danger btn-md">Cancle</a>
																	</div>
															</div>
														</div>
													</div>
											<!-------Report Modal End--------->	
									<?php 
										//-- Save Unsave
										 $issaved=$hotelPromotion->issaved;
										if($issaved==1){
												echo $this->Form->button('<i class="fa fa-save" > Unsave </i>',['class'=>'btn btn-danger btn-xs ','value'=>'button','type'=>'submit','name'=>'savehotelpromotion']);
											}
											if($issaved==0){
												echo $this->Form->button('<i class="fa fa-save" > Save </i>',['class'=>'btn btn-primary btn-xs ','value'=>'button','style'=>'background-color:#1295A2','type'=>'submit','name'=>'savehotelpromotion']);
											}
										 ?>
									
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
									</span>
								</form>
							</td>
						</tr>
						<?php $i++;endforeach; }
						else {
							echo"<tr><th colspan='10' style='text-align:center'>No Record Found</th></tr>";
						}?>
					</tbody>
				</table>
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

