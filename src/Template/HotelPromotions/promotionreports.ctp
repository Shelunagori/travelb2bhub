<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/hotel_promotions/getHotelReport.json?user_id=".$user_id."&submitted_from=web",
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
$hotel_promotions=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$List=json_decode($response);
	//pr($List); exit;
	$hotel_promotions=$List->getHotelPromotion;
}
//-- pricemaster
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/price_masters/index.json?promotion_type_id=4",
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
$pricemasters=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$pricemaster=json_decode($response);
	//pr($pricemaster);exit;
	$pricemasters=$pricemaster->PriceMasters;
}
?>
<style type="text/css">
.lbwidth{
	color:#716D6F; 
	font-size:14px;
	white-space: nowrap;
	}
fieldset{
	margin-bottom:5px !important;
	border-radius: 7px;
	box-shadow: 0 1px 0px rgba(0,0,0,0.25), 0 6px 10px rgba(0,0,0,0.22);
}

.btnlayout{
	border-radius:30px !important;
	width:100%;
	}
#myImg:hover {opacity: 0.7;}
.bbb{
	padding:0px!important;
	pading-bottom:10px!important;
}
label {
	font-weight : 300 !important;
}
.btn-defaults {
	background-color: #ffffff !important;
	
	font-size:17px !important;
}
.col-md-12{
	padding-right: 7px !important;
    padding-left: 7px !important;
}
.col-md-6{
	padding-right: 7px !important;
    padding-left: 7px !important;
}
.mainrow{
	padding:12px;
}
</style>
<div class="row" >
	<div class="col-md-12">
	</div>
</div>
<div class="">
	<div class="col-md-12">
	<div class="box box-primary" style="margin-bottom:5px;">
		<div class="row">
			<div class="col-md-12">
				<div class="box-header with-border"> 
					<span class="box-title" style="color:#057F8A;"><b><?= __('Hotel Reports') ?></b></span>
				</div>
			</div>
		</div>
	</div>
	</div>
	<?php //pr($hotel_promotions); exit; 
$m=0;	
					if(!empty($hotel_promotions)){
						foreach ($hotel_promotions as $hotel_promotion){ 
						if($m%2==0) { 
						echo '<div class="clearfix"></div>'; 
						}
						$m++;
						?>
				<div class="col-md-6" >		
	<div class="box-body bbb">
		<fieldset style="background-color:#fff;text-align:center;">
				<div class="row" style="padding:25px;">						
					<div class="col-md-6">
						<?= $this->Html->image($hotel_promotion->full_image,['id'=>'myImg','style'=>'width:96%;height:140px;','data-target'=>'#imagemodal'.$hotel_promotion->id,'data-toggle'=>'modal',]) ?>
						<div id="imagemodal<?php echo $hotel_promotion->id;?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body" >
								<button type="button" class="close" data-dismiss="modal" style="padding-right:8px !important;">&times;</button>
								<?= $this->Html->image($hotel_promotion->full_image,['style'=>'width:100%;height:300px;padding:20px;padding-top:0px!important;']) ?>
								</div>
							</div>
							</div>
						</div>
					</div>
					<div class="col-md-6"  style="padding-left:30px;margin-top:10px;">
						<div class="row">
							<div class="col-md-12 ">
							<span style="color:black;font-size:17px;"><?php echo $hotel_promotion->hotel_name?></span>
							</div>
							<div class="col-md-12 lbwidth" style="margin-top:5px">
							Views :
								<!--<a  style="color:#1295AB;" href="viewers_list/<?php echo $hotel_promotion->id?>"><label><?php echo $hotel_promotion->total_views;?></label></a>--->
								<a type="button" href="viewers_list/<?php echo $hotel_promotion->id; ?>" style="border-radius:10px; width:53px; background-color: #FFF !important;color: #1295AB !important; border: 1px solid; padding-top: 2px;padding-bottom: 3px" class="btn btn-md">
									<?php echo $hotel_promotion->total_views;?>
								</a>
							</div>
							<div class="col-md-12 lbwidth" style="margin-top:5px">
								Likes :
								<a type="button" href="likers_list/<?php echo $hotel_promotion->id ; ?>" style="border-radius:10px; width:53px; background-color: #FFF !important;color: #1295AB !important; border: 1px solid; padding-top: 2px;padding-bottom: 3px" class="btn btn-md">
									<?php echo $hotel_promotion->total_likes;?>
								</a> 
							</div>
							
							<div class="col-md-12 lbwidth" style="margin-top:5px">
							Date Posted :
							<label style="color:black;"><?php echo date('d-M-y',strtotime($hotel_promotion->created_on));?></label>
							</div>
							<div class="col-md-12 lbwidth" style="margin-top:5px">
							Expiring On :
							<label style="color:#FB6542;"><?php echo date('d-M-y',strtotime($hotel_promotion->visible_date));?></label>
							</div>
						</div>
					</div>
					<table class="table" style="width:100%;margin-bottom:0px!important;">
						<tr>
						<td  style="width:33%;">
							<button type="button" class="btn btn-info btn-md btnlayout" data-target="#renew<?php echo $hotel_promotion->id; ?>" data-toggle=modal>Renew</button>
						</td>
						<td  style="width:33%;">
						
							<button type="button" class="btn btn-danger btn-md btnlayout" data-target="#remove<?php echo $hotel_promotion->id; ?>" data-toggle=modal>Remove</button>
							
						</td>
						<td  style="width:33%;">
							<a href="view/<?php echo $hotel_promotion->id; ?>" class="btn btn-warning btn-md btnlayout" >Details</a></label>
						</td>
					</tr>
					</table>
					</div>
			</fieldset>
			<!------------------------- Renew Modal--------------------------->
						<div id="renew<?php echo $hotel_promotion->id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<!-- Modal content-->
								<form method="post" class="formSubmit">
									<div class="modal-content">
									  <div class="modal-header" >
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">
											Do you want to renew promotion ?
											</h4>
										</div>
										<div class="modal-body">
											<div class="row mainrow">
												<div class="col-md-12">
													<div class="col-md-6">
														<p for="from">
															Payment Duration
														</p>
														<div class="input-field">
																 
														<?php				 
															$options=array();
															foreach($pricemasters as $Price)
															{
																$options[] = ['value'=>$Price->id,'text'=>$Price->week,'priceVal'=>$Price->week,'price'=>$Price->price];
															};
															echo $this->Form->input('price_master_id',['options'=>$options,'class'=>'form-control priceMasters','label'=>false,'empty'=>'Select ...']);?>
														</div>
													</div>
													<div class="col-md-6">
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
								<input type="hidden" name="hotel_id" value="<?php echo $hotel_promotion->id; ?>">
								</form>
							</div>
						</div>
						
						<!------------------------- Remove Modal--------------------------->
						<div id="remove<?php echo $hotel_promotion->id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<!-- Modal content-->
								<form method="post" class="formSubmit">
									<div class="modal-content">
									  <div class="modal-header" style="height:100px;">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">
											Are you sure ? You want to delete this Promotion
											</h4>
										</div>
										<div class="modal-footer" style="height:60px;">
											<button type="submit" name="removepackage"  class=" btn btn-success btn-md" value="yes" name="remove_promotion">Yes</button>
											<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
										</div>
									</div>
									<input type="hidden" name="remove_package_id" value="<?php echo $hotel_promotion->id; ?>"/>
								</form>
							</div>
						</div>
		</div>
	</div>
					<?php }} ?>
</div>
<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
									<div id="loader"></div>
									</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
    $(document).ready(function () {
		$(document).on('change','.priceMasters',function()
		{
			var ab=$(this).closest('div').find('.priceMasters option:selected').val();
			if(ab!=0)
			{
			var priceVal=$(this).closest('div').find('.priceMasters option:selected').attr('priceVal');
			var price=$(this).closest('div').find('.priceMasters option:selected').attr('price');
			var Result = priceVal.split(" ");
			var Result1 = price.split(" ");
			var weeks=Result[0];
			var price=Result1[0];
			
			$(this).closest('div.mainrow').find('div .payment_amount').val(price);
			}
			else{
				$(this).closest('div.mainrow').find('div .payment_amount').val(0);
			}
		})
		jQuery(".formSubmit").submit(function(){
						jQuery("#loader-1").show();
					});
		});
</script>