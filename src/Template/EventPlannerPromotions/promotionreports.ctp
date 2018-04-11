<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/EventPlannerPromotions/getEventPlannerReport.json?user_id=".$user_id."&submitted_from=web",
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
	$eventplanners=$List->getEventPlanners;
}
//-- priceMasters
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/price_masters/index.json?promotion_type_id=3",
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
	$priceMasters=json_decode($response);
	//pr($priceMasters);exit;
	$priceMasters=$priceMasters->PriceMasters;
}
?>
<style type="text/css">
.lbwidth{
	color:#716D6F;
	font-weight:bold;
	font-size:16px;
	white-space: nowrap;
	}
fieldset{
	margin-bottom:5px !important;
	border-radius: 6px;
}

.btnlayout{
	border-radius:15px !important;
	width:150px;
	}
#myImg:hover {opacity: 0.7;}
.bbb{
	padding:0px!important;
	pading-bottom:10px!important;
}
</style>
<div class="row" >
	<div class="col-md-12">
	</div>
</div>
<div class="container-fluid">
	<div class="box box-primary" style="margin-bottom:5px;">
		<div class="row">
			<div class="col-md-12">
				<div class="box-header with-border"> 
					<span class="box-title" style="color:#057F8A;"><b><?= __('Event Promotion Reports') ?></b></span>
					<div class="box-tools pull-right" style="margin-top:-5px;">
						<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
						<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php //pr($eventplanners); exit;			
					if(!empty($eventplanners)){
						foreach ($eventplanners as $eventplanners){ 
						?>
	<div class="box-body bbb">
		<fieldset style="background-color:#fff;">
				<div class="row col-md-12" style="padding:25px;">						
					<div class="col-md-4">
						<?= $this->Html->image($eventplanners->full_image,['id'=>'myImg','style'=>'width:100%;height:150px;','data-target'=>'#imagemodal'.$eventplanners->id,'data-toggle'=>'modal',]) ?>
						<div id="imagemodal<?php echo $eventplanners->id;?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body" >
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<?= $this->Html->image($eventplanners->full_image,['style'=>'width:100%;height:300px;padding:20px;padding-top:0px!important;']) ?>
								</div>
							</div>
							</div>
						</div>
					</div>
					<div class="col-md-4"  style="padding-left:30px;">
						<div class="row">
							<div class="col-md-12 ">
							<span style="color:black;font-size:25px;"><?php echo $eventplanners->event_detail?></span>
							</div>
							<div class="col-md-12 lbwidth">
							Likes :
							<a style="color:#1295AB;" href="likers_list/<?php echo $eventplanners->id?>"><label><?php echo $eventplanners->total_likes;?></label></a>
							</div>
							<div class="col-md-12 lbwidth ">
							Views :
							<a  style="color:#1295AB;" href="viewers_list/<?php echo $eventplanners->id?>"><label><?php echo $eventplanners->total_views;?></label></a>
							</div>
							<div class="col-md-12 lbwidth">
							Date Posted :
							<label style="color:black;"><?php echo date('d-M-y',strtotime($eventplanners->created_on));?></label>
							</div>
							<div class="col-md-12 lbwidth">
							Expiring On :
							<label style="color:#FB6542;"><?php echo date('d-M-y',strtotime($eventplanners->visible_date));?></label>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="row col-md-12">
						<label><button type="button" class="btn btn-info btn-lg btnlayout" data-target="#renew<?php echo $eventplanners->id; ?>" data-toggle=modal>Renew</button></label>
						</div>
						<!------------------------- Renew Modal--------------------------->
						<div id="renew<?php echo $eventplanners->id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<!-- Modal content-->
								<form method="post" class="formSubmit">
									<div class="modal-content">
									  <div class="modal-header" >
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h3 class="modal-title">
											Do you want to renew promotion ?
											</h3>
										</div>
									<div class="modal-body" style="height:80px;">
										<br>
											<div class="row mainrow">
												<div class="col-md-12">
													<div class="col-md-4">
														<p for="from">
															Payment Duration
														</p>
														<div class="input-field">
																 
														<?php				 
															$options=array();
															foreach($priceMasters as $Price)
															{
																$options[] = ['value'=>$Price->id,'text'=>$Price->week,'priceVal'=>$Price->week,'price'=>$Price->price];
															};
															echo $this->Form->input('price_master_id',['options'=>$options,'class'=>'form-control priceMasters','label'=>false,'empty'=>'Select ...']);?>
														</div>
													</div>
													<div class="col-md-4">
														<p for="from">
																	Visibility Date
																	<span class="required">*</span>
														</p>
														<div class="input-field">
														<?php echo $this->Form->input('visible_date', ['data-date-format'=>'dd/mm/yyyy','class'=>'form-control visible_date','label'=>false,"placeholder"=>"Visible Date",'readonly'=>'readonly','type'=>'text']); ?>
														</div>
													</div>
													<div class="col-md-4">
														<p for="from">
																	Promotion Amount
																	<span class="required">*</span>
														</p>
														<div class="input-field">
														<?php echo $this->Form->input('payment_amount', ['class'=>'form-control payment_amount','label'=>false,"placeholder"=>"Payment Amount",'readonly'=>'readonly','type'=>'text']);?> 
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer" style="height:60px;">
											<button type="submit"  name="pay_now" class=" btn btn-success btn-md" value="yes" >Pay Now</button>
											<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
											</div>
										</div>
									<input type="hidden" name="event_id" value="<?php echo $eventplanners->id; ?>">
									</form>
								</div>
							</div>
						<div class="row col-md-12">
						<label>
						<button type="button" class="btn btn-danger btn-lg btnlayout" data-target="#remove<?php echo $eventplanners->user_id; ?>" data-toggle=modal>Remove</button>
						</label>
						</div>
						<!------------------------- Remove Modal--------------------------->
						<div id="remove<?php echo $eventplanners->user_id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<!-- Modal content-->
									<div class="modal-content">
									  <div class="modal-header" style="height:100px;">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h3 class="modal-title">
											Are you sure ? You want to delete this
											</h3>
										</div>
										<div class="modal-footer" style="height:60px;">
											<button type="button"  class=" btn btn-success btn-md" value="yes" name="remove_promotion">Yes</button>
											<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
										</div>
									</div>
								</div>
							</div>
						<div class="row col-md-12">
						<label><button type="button" class="btn btn-warning btn-lg btnlayout" data-target="#details<?php echo $eventplanners->user_id; ?>" data-toggle=modal>Details</button></label>
						</div>
						<!------------------------- Details Modal--------------------------->
						<div id="details<?php echo $eventplanners->user_id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<!-- Modal content-->
									<div class="modal-content">
									  <div class="modal-header" >
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h3 class="modal-title">
											Details
											</h3>
										</div>
										<div class="modal-body" >
										
										</div>
										<div class="modal-footer" style="height:60px;">
											<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
										</div>
									</div>
								</div>
							</div>
					</div>
				</div>
				<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
				<div id="loader"></div></div>
		</fieldset>
	</div>
					<?php }} ?>
</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
	 
    $(document).ready(function () {
		$(document).on('change','.priceMasters',function()
		{
			var ab=$(this).closest('div').find('.priceMasters option:selected').val();
			//alert(ab);
			if(ab!=0)
			{
			var priceVal=$(this).closest('div').find('.priceMasters option:selected').attr('priceVal');
			var price=$(this).closest('div').find('.priceMasters option:selected').attr('price');
			var Result = priceVal.split(" ");
			var Result1 = price.split(" ");
			var weeks=Result[0];
			var price=Result1[0];
			var todaydate = new Date(); // Parse date
			for(var x=0; x < weeks; x++){
				todaydate.setDate(todaydate.getDate() + 7); // Add 7 days
			}
			var dd = todaydate .getDate();
			var mm = todaydate .getMonth()+1; //January is 0!
			var yyyy = todaydate .getFullYear();
			if(dd<10){  dd='0'+dd } 
			if(mm<10){  mm='0'+mm } 
			var date = dd+'-'+mm+'-'+yyyy;	
			$(this).closest('div.mainrow').find('.visible_date').val(date);
			$(this).closest('div.mainrow').find('.payment_amount').val(price);
			//alert($(this).closest('div.mainrow').html());
			}
			else{
				$(this).closest('div.mainrow').find('.visible_date').val("dd-mm-yyyy");
				$(this).closest('div.mainrow').find('.payment_amount').val(0);
			}
		})
			jQuery(".formSubmit").submit(function(){
						jQuery("#loader-1").show();
					});
		});
</script>