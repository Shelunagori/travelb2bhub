<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/hotel_promotions/getHotelList.json?isLikedUserId=".$user_id,
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
//pr($List); exit;
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
				<h1 class="box-title" style="color:#057F8A;"><?= __('Hotel Promotions :') ?></h1>
				<div class="box-tools pull-right">
					<a style="font-size:20px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
					<a style="font-size:22px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
				</div>
			</div>
	<div class="box-body">
		<div class="row">
            <div id="myModal123" class="modal fade" role="dialog">
				<div class="modal-dialog " style="width: 22%;">
					<!-- Modal content-->
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Sorting</h4>
					  </div>
					  <form method="get" class="filter_box">
					 <div class="modal-body" style="height:200px;">
						<div class="col-md-12 row form-group ">
							<div class="col-md-12">
									 <input class="btn btn-info btn-sm" type="radio" name="sort" value="totalbudgethl"/>
									 <label class="col-form-label" for=example-text-input>
										Total Budget (Hign to Low)</span>
									 </label>
							</div>
                        </div>
						<div class="col-md-12 row form-group ">
							<div class="col-md-12">
									 <input class="btn btn-info btn-sm" type="radio" name="sort" value="totalbudgetlh"/>
									 <label class="col-form-label"for=example-text-input>
										Total Budget (Low to High)</span>
									 </label>
							</div>
                        </div>
						<div class="col-md-12 row form-group ">
							<div class="col-md-12">
									<input class="btn btn-info btn-sm" type="radio" name="sort" value="agentaz"/>
									<label class="col-form-label"for=example-text-input>
										No. of Responses (Hign to Low)</span>
									</label>
							</div>
						</div>
						<div class="col-md-12 row form-group" >
							<div class=col-md-12>
									<input class="btn btn-info btn-sm" type="radio" name="sort" value="agentza"/>
									<label class="col-form-label"for=example-text-input>
										No. of Responses (Low to High)</span>
									</label>
							</div>
						</div>
						<div class="col-md-12 row form-group " style="display:none;">
							<div class=col-md-12>
									<input class="btn btn-info btn-sm" type="radio" name="sort" value="requesttype"/>
									<label class="col-form-label"for=example-text-input>
									Request Type 
									<span class=arrow></span>
									</label>
							</div>
						</div>
					 </div>
					  <div class="modal-footer" style="height:60px;">
						  <div class="row">
								<div class="col-md-12 text-center">
									<input type="submit" name="submit" value="Sort"  class="btn btn-primary btn-submit">
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
						<form class=filter_box>
                        <div class="modal-body">
                            <div class="row form-group margin-b10">
								<div class=col-md-12>
									 <div class=col-md-4>
									  <label class="col-form-label"for=example-text-input>Request Type</label>
									  </div>
									  <div class=col-md-1>:</div>
									 <div class=col-md-7>
										<select name="req_typesearch" class="form-control"><option value="">Select Request Type</option><option value="1" <?php echo (isset($_GET['req_typesearch']) && $_GET['req_typesearch'] =="1")? 'selected':''; ?>>Package</option><option value="3" <?php echo (isset($_GET['req_typesearch']) && $_GET['req_typesearch'] =="2")? 'selected':''; ?>>Hotel</option><option value="2">Transport</option></select>
									</div>
                                 </div>
                                </div>
								<div class="row form-group margin-b10">
									<div class=col-md-12>
										<div class=col-md-4>
											<label class="col-form-label"for=example-text-input>Total Budget</label>
										</div>
										<div class=col-md-1>:</div>
										<div class=col-md-7>
											<select name="budgetsearch" class="form-control"><option value="">Select Total Budget</option><option value="0-10000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="0-10000")? 'selected':''; ?>>0-10000</option><option value="10000-30000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="10000-30000")? 'selected':''; ?>>10000-30000</option><option value="30000-50000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="30000-50000")? 'selected':''; ?>>30000-50000</option><option value="50000-100000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="50000-100000")? 'selected':''; ?>>50000-100000</option>
											<option value="100000-100000000000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="100000-100000000000")? 'selected':''; ?>>100000-Above</option>
											</select>
										</div>
									 </div>
                                 </div>
								<div class="row form-group margin-b10">
									<div class=col-md-12>
									  <div class=col-md-4>
									 <label class="col-form-label" for=example-text-input>Start Date</label>
									 </div>
									<div class=col-md-1>:</div>
									 <div class=col-md-7>
									 <input class=form-control name=startdatesearch value="<?php echo isset($_GET['startdatesearch'])? $_GET['startdatesearch']:''; ?>"id=datepicker1>
									 </div>
									</div>	
								</div>
								<div class="row form-group margin-b10">								
									<div class=col-md-12>
										<div class=col-md-4>
										  <label class="col-form-label" for=example-text-input>End Date</label>
										</div>
										<div class=col-md-1>:</div>
										<div class=col-md-7>
										<input class=form-control name=enddatesearch value="<?php echo isset($_GET['enddatesearch'])? $_GET['enddatesearch']:''; ?>"id=datepicker2>
										</div>
									</div>
								</div>
                              <div class="row form-group margin-b10">
									 <div class=col-md-12>
										 <div class=col-md-4>
										 <label class="col-form-label"for=example-text-input>Reference ID</label>
										 </div>
										<div class=col-md-1>:</div>
										 <div class=col-md-7>
										 <input class=form-control name=refidsearch value="<?php echo isset($_GET['refidsearch'])? $_GET['refidsearch']:''; ?>">
										 </div>
									 </div>
								</div>
                               <div class="row form-group margin-b10">
                                 <div class=col-md-12>
                                 <div class=col-md-4>
								 <label class="col-form-label "for=example-text-input>Members</label>
								 </div>
								 <div class=col-md-1>:</div>
								 <div class=col-md-7>
								 <input class=form-control name=memberssearch value="<?php echo isset($_GET['memberssearch'])? $_GET['memberssearch']:''; ?>">
								 </div>
								</div>
                              </div>                         
                        </div>
                        <div class="modal-footer">
							<button class="btn btn-primary btn-sm" name=submit value=Submit type=submit>Filter</button> 
							<a href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'requestlist')) ?>"class="btn btn-primary btn-sm">Reset</a>
						   <script>
							$(document).ready(function(){
								$("#datepicker1").datepicker({dateFormat:"dd/mm/yy",changeMonth:!0,changeYear:!0,minDate:"<?php echo date("d/m/Y"); ?>",onSelect:function(e){
								$("#datepicker2").datepicker("option","minDate",e),
								$("#datepicker2").val("")}});
								
								$("#datepicker2").datepicker({dateFormat:"dd/mm/yy",changeMonth:!0,changeYear:!0,minDate:"<?php echo date("d/m/y"); ?>",onSelect:function(e){""==$("#datepicker1").val()&&(alert("Please select check-in date first."),$("#datepicker2").val(""))}});
							});
						   </script>
						</div>
						 </form>
                     </div>
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
								<th scope="col"><?= ('Picture') ?></th>
								<th scope="col" class="actions"><?= __('Actions') ?></th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($hotelPromotions as $hotelPromotion): ?>
						<tr>
							<td><?= $this->Number->format($hotelPromotion->id) ?></td>
							<td><?= h($hotelPromotion->user->first_name.' '.$hotelPromotion->user->last_name.'( '.$hotelPromotion->user_rating.' )');?></td>
							<td><?= h($hotelPromotion->hotel_name) ?></td>
							<td><?= h($hotelPromotion->hotel_location) ?></td>
							<td><?= h($hotelPromotion->hotel_category->name) ?></td>
							<td><?php echo $this->Html->image('../'.$hotelPromotion->hotel_pic,['style'=>'height:8%;width:100%;']);?></td>
							<td class="actions" style="width:30%;">
								 <span>
									<?php echo $this->Form->button('<i class="fa fa-thumbs-up"></i>',['class'=>'btn btn-primary btn-md likes','value'=>'button','style'=>'background-color:#1295A2']); ?>
									<a href="<?php echo $this->Url->build(["controller" => "HotelPromotions",'action'=>"view",$hotelPromotion->id]); ?>"><?php echo $this->Form->button('<i class="fa fa-eye"></i>',['class'=>'btn btn-warning btn-md','value'=>'button']); ?></a>
									<?php echo $this->Form->button('<i class="fa fa-flag"></i>',['class'=>'btn btn-info btn-md','value'=>'button']); ?>
									<?php echo $this->Form->button('<i class="fa fa-bookmark"></i>',['class'=>'btn btn-success btn-md','value'=>'button']); ?>
									<?php //echo $this->Html->link('Details','/HotelPromotions/view/'.$hotelPromotion->id,array('escape'=>false,'class'=>'btn btn-primary btn-xs'));?>
									<?php //echo $this->Html->link('Details','/HotelPromotions/view/'.$hotelPromotion->id,array('escape'=>false,'class'=>'btn btn-primary btn-xs'));?>
									<?php //echo $this->Html->link('Follow','api address'.$hotelPromotion->id,array('escape'=>false,'class'=>'btn btn-primary btn-xs'));?>
									<?php //echo $this->Html->link('Report','api address'.$hotelPromotion->id,array('escape'=>false,'class'=>'btn btn-primary btn-xs'));?>
									<?php //echo $this->Html->link('Delete','api address'.$hotelPromotion->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotion->id)));?>
											</span>
										</td>
									</tr>
									<?php endforeach; ?>
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
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
   $(document).ready(function () {
		$(document).on('click','.likes',function()
		{
			var txt;
			var r = confirm("Are You Sure to Like this Promotion !");
			if (r == true) {
				txt = "You Liked this Promotion !";
			} else {
				txt = "You do not Like this promtion!";
			}
			$(".show_msg").text(txt);
		});
   });
</script>
