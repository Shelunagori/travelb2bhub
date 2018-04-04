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
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

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
.col-md-3{
	
	color:#838784;
	font-weight:bold;
}
.lbwidth{
	color:#838784;
	font-weight:bold;
	font-size:13px;
	}
	.lbwidth11{
	font-size:13px;
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
	</div>
		<?php $i=1;
				if(!empty($hotelPromotions)){
				foreach ($hotelPromotions as $hotelPromotion){
				?>
	<div class="">
		<div class="row">
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

	<fieldset style="background-color:#fff;">
		<form method="post">
			<div class="row">
				<div class="col-md-12">
				<span style="font-size:18px;"><b><?= h($hotelPromotion->hotel_name) ?></b></span>
				</div>
		</div><span class="help-block"></span>
		<div class="row">						
			<div class="col-md-3">
			<?= $this->Html->image($hotelPromotion->full_image,['id'=>'myImg','style'=>'width:100%;height:150px;']) ?>
			</div>
			<!--------------------image modal--------------------->
			<div id="myModal" class="modal1" style="display:none;">
				  <span class="close">&times;</span>
				  <img class="modal-content1" id="img01">
				  <div id="caption"></div>
			</div>
			<!--------------------image modal End--------------------->
			<div class="col-md-9">
				
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