<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/PostTravlePackages/getTravelPackages.json?isLikedUserId=".$user_id."&higestSort=".$higestSort."&country_id=".$country_id."&category_id=".$category_id."&duration_day_night=".$duration_day_night."&starting_price=".$starting_price,
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
	$postTravlePackages=$List->getTravelPackages;
}
//pr($postTravlePackages); exit;
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
//--- Category
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/post_travle_package_categories/index.json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 39e85539-7745-db54-4f15-121a9d912dc7"
  ),
));
$responsecat = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $Category=json_decode($responsecat);
  $cat=$Category->postTravlePackageCategories;
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
</style>
<div id="my_final_responses" class="container-fluid">
	<div class="row equal_column">
		<div class="col-md-12" style="background-color:#fff"> 
			<br>
			<?php echo  $this->Flash->render() ?>
		</div>
		<div class="col-md-12" style="background-color:#fff"> 
			<div class="box box-default">
				<div class="box-header with-border"> 
					<h3 class="box-title" style="color:#057F8A;padding:10px"><b><?= __('PostTravle Package Promotions') ?></b></h3>
					<div class="box-tools pull-right">
						<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
						<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
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
										<a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
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
										 <label class="col-form-label" for=example-text-input>Package Category</label>
										 </div>
										<div class=col-md-1>:</div>
										 <div class=col-md-7>
											<?php 
												$options=array();
												foreach($cat as $sts)
												{
													$options[] = ['value'=>$sts->id,'text'=>$sts->name];
												};
												echo $this->Form->control('package_category_id', ['label'=>false,"id"=>"multi_category", "type"=>"select",'options' =>$options, "class"=>"form-control select2","data-placeholder"=>"Select... ","style"=>"height:125px;",'empty'=>'Select...']);?>
										 </div>
										</div>	
									</div>
									<div class="row form-group margin-b10">
										<div class=col-md-12>
										  <div class=col-md-3>
										 <label class="col-form-label" for=example-text-input>Duration Night</label>
										 </div>
										<div class=col-md-1>:</div>
										 <div class=col-md-7>
											<select name="duration_day_night" class="form-control select2">
												<option value="">Select...</option>
												<option>1 Night 2 Days</option>
												<option>2 Night 3 Days</option>
												<option>3 Night 4 Days</option>
												<option>4 Night 5 Days</option>
												<option>5 Night 6 Days</option>
												<option>6 Night 7 Days</option>
												<option>7 Night 8 Days</option>
												<option>8 Night 9 Days</option>
												<option>9 Night 10 Days</option>
												<option>10 Night 11 Days</option>
												<option>11 Night 12 Days</option>
												<option>12 Night 13 Days</option>
												<option>13 Night 14 Days</option>
												<option>14 Night 15 Days</option>
												<option>More than 15 Days</option>
											</select>
										 </div>
										</div>	
									</div>
									<div class="row form-group margin-b10">
										<div class=col-md-12>
										  <div class=col-md-3>
										 <label class="col-form-label" for=example-text-input>Starting Price</label>
										 </div>
										<div class=col-md-1>:</div>
										 <div class=col-md-7>
											 <?php echo $this->Form->input('starting_price',['class'=>'form-control','label'=>false,'placeholder'=>'Starting Price']);?> 
										 </div>
										</div>	
									</div>
								  </div>
								<div class="modal-footer">
									<button class="btn btn-primary btn-sm" name="submit" value="Submit" type="submit">Filter</button> 
									<a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
								</div>
							</form>
						</div>
					  </div>
					</div>
						<table class="table" cellpadding="0" cellspacing="0">
							<thead>
								<tr style="background-color:#709090;color:white;">
									<th scope="col"><?= ('Sr.No') ?></th>
									<th scope="col"><?= ('Seller Name') ?></th>
									<th scope="col"><?= ('Title') ?></th>
									<th scope="col" style="width:%;"><?= ('Category') ?></th>
									<th scope="col"><?= ('Starting Price') ?> (&#8377;)</th>
									<th scope="col"><?= ('Package Duration') ?></th>
									<th scope="col" class="actions" style="text-align:center"><?= __('Actions') ?></th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; 
							if(!empty($postTravlePackages)){
								foreach ($postTravlePackages as $postTravlePackage): 
									$CategoryList='';
									$x=0;
									foreach($postTravlePackage->post_travle_package_rows as $category)
										{
											
											$CategoryList.=$category->post_travle_package_category->name;
											if($x>1){
												$CategoryList.=' , ';
											}
										$x++;}
								?>
								<tr>
									<td ><?php echo $i; ?></td>
									<td  ><?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name.' ('.$postTravlePackage->user_rating.')');?>
									</td>
									<td ><?= h($postTravlePackage->title) ?></td>
									<td ><?= h($CategoryList);?></td>
									<td ><?= h($postTravlePackage->starting_price);?> </td>
									<td ><?= h($postTravlePackage->duration_day_night);?></td>
									<!--<td style="width:20%;">
									<?php //echo $this->Html->image('../images/PostTravelPackages/8/test/image/8.jpg',['style'=>'height:8%;width:100%;','id'=>'myImg']);?></td>
									<div id="myModal" class="modal">
									  <span class="close">&times;</span>
									  <img class="modal-content" id="img01">
									  <div id="caption"></div>
									</div>
									-->
									<td class="actions" style="width:30%;">
									<form method="POST">
									<input type="hidden" name="posttravle_id" value="<?php echo $postTravlePackage->id; ?>">
										<span>
										 <?php
											$dataUserId=$postTravlePackage->user_id;
											$isLiked=$postTravlePackage->isLiked;
											//-- LIKES DISLIKE
											if($isLiked=='no'){
												echo $this->Form->button('<i class="fa fa-thumbs-up like" > Likes </i>',['class'=>'btn btn-primary btn-xs likes','value'=>'button','style'=>'background-color:#1295A2','type'=>'submit','name'=>'LikeEvent']);
											}
											if($isLiked=='yes'){
												echo $this->Form->button('<i class="fa fa-thumbs-down like" > Dislikes </i>',['class'=>'btn btn-primary btn-xs likes','value'=>'button','style'=>'background-color:#d6796e','type'=>'submit','name'=>'LikeEvent']);
											}
										?>	
										 	<?php //echo $this->Form->button('<i class="fa fa-thumbs-up"> Like</i>',['class'=>'btn btn-primary btn-xs likes','value'=>'button','style'=>'background-color:#1295A2']); ?>
											<?php 
												echo $this->Html->link('<i class="fa fa-search"> View</i>','/PostTravlePackages/view/'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn btn-primary btn-xs'));?>
											
											<?php echo $this->Html->link('<i class="fa fa-flag"> Report</i>','#'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn btn-warning btn-xs','data-target'=>'#reportmodal','data-toggle'=>'modal'));?>	
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
																	<a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'report')) ?>"class="btn btn-danger btn-md">Cancle</a>
																</div>
															 
														</div>
													</div>
												</div>
											<!-------Report Modal End--------->	
											<?php echo $this->Html->link('<i class="fa fa-bookmark"> Save</i>','#'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn btn-success btn-xs','data-target'=>'#savemodal','data-toggle'=>'modal'));?>
										<!-------Save Modal Start--------->
												<div id="savemodal" class="modal fade" role="dialog">
													<div class="modal-dialog modal-md" >
														<!-- Modal content-->
															<div class="modal-content">
															  <div class="modal-header" style="height:100px;">
																 
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title">
																	Are You Sure, to save this promotion in your cart ???
																	</h4>
															</div>
																<div class="modal-footer" style="height:60px;">
																	<input type="submit" class="btn btn-primary btn-md" value="OK">
																	<a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'report')) ?>"class="btn btn-danger btn-md">Cancle</a>
																</div>
															 
														</div>
													</div>
												</div>
											<!-------Save Modal End--------->	

											<?php 
											if($dataUserId==$user_id){
												echo $this->Html->link('<i class="fa fa-trash" > Delete</i>','api address'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','data-target'=>'#deletemodal'.$postTravlePackage->id,'data-toggle'=>'modal'));?>
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
										</span>
									</form>
								</td>
							</tr>
							<?php $i++; endforeach; 
							}	else
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
							</div>-->
						</div>
					</div>
				</div>
			</div>
			</div>
	<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
	<script type="text/javascript">	
	document.addEventListener('DOMContentLoaded', function(){
        var imgs = document.querySelectorAll('img');
        Array.prototype.forEach.call(imgs, function(el, i) {
            if (el.tabIndex <= 0) el.tabIndex = 10000;
        });
    });
</script>
