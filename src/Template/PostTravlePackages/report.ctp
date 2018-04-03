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
	font-size:10px;
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
				<span class="box-title" style="color:#057F8A;"><b><?= __('PostTravle Package Promotions') ?></b></span>
				<div class="box-tools pull-right" style="margin-top:-5px;">
					<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
					<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
				</div>
			</div>
		</div>
	</div>
		<div class="box-body">
			<div class="row ">
			<div id="myModal123" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-sm">
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
								<input type="submit" class="btn btn-info btn-sm">
								<a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'report')) ?>"class="btn btn-danger  btn-sm">Reset</a>
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
										echo $this->Form->control('category_id', ['label'=>false,"id"=>"multi_category", "type"=>"select",'options' =>$options, "class"=>"form-control select2","data-placeholder"=>"Select... ","style"=>"height:125px;",'empty'=>'Select...']);?>
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
							<button class="btn btn-info btn-sm" name="submit" value="Submit" type="submit">Filter</button> 
							<a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'report')) ?>"class="btn btn-danger  btn-sm">Reset</a>
						</div>
					</form>
				</div>
			  </div>
			</div>
			
			<?php $i=1;
//pr($postTravlePackages); exit;			
					if(!empty($postTravlePackages)){
						foreach ($postTravlePackages as $postTravlePackage): 
							$CategoryList='';
							$x=0;
							foreach($postTravlePackage->post_travle_package_rows as $category)
								{
									if($x>=1){
										$CategoryList.=' , ';
									}
									$CategoryList.=$category->post_travle_package_category->name;
									$x++;
								}
						?>
<fieldset>
	<form method="post">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4">
				<?= $this->Html->image($postTravlePackage->full_image,['style'=>'width:100%;height:250px;']) ?>
				</div>
				<div class="col-md-8">
				<input type="hidden" name="posttravle_id" value="<?php echo $postTravlePackage->id; ?>">
				<div class="row">
					<div class="col-md-6 pull-right text-center ">
						<div class="col-md-3">
						 <i style="font-size: 24px !important;" class="fa fa-eye fleet"></i> 
 						<p>
							<?php echo $postTravlePackage->total_views; ?>
							<br> 
							Views
						</p>
						</div>
						<div class="col-md-3">
						<?php
						//
							$dataUserId=$postTravlePackage->user_id;
							$isLiked=$postTravlePackage->isLiked;
							$issaved=$postTravlePackage->issaved;
							//-- LIKES DISLIKE
							if($isLiked=='no'){
								echo $this->Form->button('<i class="fa fa-heart-o like fleet" > </i>',['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
							}
							if($isLiked=='yes'){
								echo $this->Form->button('<i class="fa fa-heart-o like unfleet" > </i>',['class'=>'btn  btn-xs likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#000;border:0px;']);
							}
						?>
						<p style="text-align:center">
							<?php echo $postTravlePackage->total_likes; ?>
							<br> 
							Likes
						</p>
						</div>
						<div class="col-md-3">
							<?php 
							//-- Save Unsave
							if($issaved=='1'){
								echo $this->Form->button('<i class="fa fa-bookmark-o unfleet"></i>',['class'=>'btn  btn-xs  ','value'=>'button','type'=>'submit','name'=>'saveposttravle','style'=>'background-color:white;color:black;border:0px;']);
							}
							if($issaved=='0'){
								echo $this->Form->button('<i class="fa fa-bookmark-o fleet"></i>',['class'=>'btn  btn-xs ','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'saveposttravle']);
							}
							?>
						</div>
						<div class="col-md-3">
						<?php echo $this->Html->link('<i class="fa fa-flag-o fleet"></i>','#'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#reportmodal'.$postTravlePackage->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
										<!-------Report Modal Start--------->
 						</div>
							<!-------Report Modal End--------->	
							<div style="display:none;">
							<?php 
								if($dataUserId==$user_id){
									echo $this->Html->link('<i class="fa fa-trash" > Delete</i>','api address'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#deletemodal'.$postTravlePackage->id,'data-toggle'=>'modal'));?>
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
							</div>
						 
					</div>
					<div class="col-md-6 pull-left">
						<h3><?= h($postTravlePackage->title) ?></h3>
					</div>
					<div id="reportmodal<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
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
								</div>
								<div class="modal-footer" style="height:60px;">
									<input type="submit" class="btn btn-info btn-md" name="report_submit" value="Report">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
								</div>
							</div>
						</div>
					</div>
					</div>
					<div class="row col-md-12">
						<div class="col-md-3">Duration</div><div class="col-md-1">:</div>		
						<div class="col-md-8"><label style="color:#FB6542">	<?= h($postTravlePackage->duration_day_night) ?></label>
						</div>
					</div>
					<div class="row col-md-12">
						<div class="col-md-3">Starting From</div><div class="col-md-1">:</div>		
						<div class="col-md-8"><label style="color:#1295AB">&#8377; <?php echo number_format(h($postTravlePackage->starting_price)) ;?></label>
						</div>
					</div>
					<div class="row col-md-12">
						<div class="col-md-3">Seller Name </div><div class="col-md-1">:</div>		
						<div class="col-md-8"><label>
						<?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name);?>
									<?php
										if($postTravlePackage->user_rating==0)
										{
											echo "";
										}
										else{
											echo "( ";
											for($i=0;$i<$postTravlePackage->user_rating;$i++)
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
						<div class="col-md-8"><label >	<?= h($CategoryList); ?></label>
						</div>
					</div>
					<div class="row col-md-12">
					<div class="col-md-3" >Visible Date</div><div class="col-md-1">:</div>		
					<div class="col-md-8"><label><?= h(date('d-m-Y',strtotime($postTravlePackage->visible_date))); ?></label>
					</div>					
					</div>			
					<div class="row pull-right ">
					<a href="view/<?php echo $postTravlePackage->id; ?>" ><span style="color:#1295A2;border:0px; font-size:22px;" ><b>View Details </b>
					<i class="fa fa-chevron-right" style="font-size:15px;"></i></span></a>
					</div>
				</div>
			</div>
		</div>
	</form>
</fieldset>
					<?php $i++; endforeach; 
					}	else
					{
						echo"<div class='row col-md-12 text-center'><tr><th colspan='10' ><span>No Record Found</span></th></tr></div>";
					}							?>
			
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
		document.addEventListener('DOMContentLoaded', function(){
        var imgs = document.querySelectorAll('img');
        Array.prototype.forEach.call(imgs, function(el, i) {
            if (el.tabIndex <= 0) el.tabIndex = 10000;
        });
    });
  });
</script>
