<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
?>
<style>
legend
{
	text-align: center;
}
fieldset
{
	border-radius: 7px;
	box-shadow: 0 3px 9px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}
.requestType {	
	color: #f87200;
    font-weight: 600;
}
.hotel{
	
}
.package{
	 
}
.contain>p{
	color:#96989A !important;
	margin: 0 0 5px !important;
	line-height:17px !important; 
}
.details {color:#000 !important; font-weight: 400;}	
.btn-block { width:40% !important;}
.col-form-label{
	margin-top: 4px;
	font-weight:100 !important;
}
</style>
<div class="container-fluid" id="requestlist">
<div class="row equal_column" > 
    <div class="col-md-12"> 
 		<?php echo  $this->Flash->render() ?>
	</div>
</div>
<div class="box box-primary">
<div class="row">
	<div class="col-md-12">
		<div class="box-header with-border"> 
		<h3 class="box-title" style="padding:5px;">My Requests</h3>
			<div class="box-tools pull-right">
 			<a style="font-size:22px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="collapse"> <i class="fa fa-filter"></i></a>
			</div>
		</div>
	</div>
</div>
<div class="box-body"> 
<div class="collapse"  id="myModal122" aria-expanded="false"> 
	<form class="filter_box" style="padding-right: 15px;padding-left: 15px;" method="get">
		<fieldset><legend style="text-align:left !important;">Filter</legend>
			<div class=""> 
				<div class=col-md-6>
					 <div >
					 <label class="col-form-label"for=example-text-input>Reference ID:  </label>
					 </div>
					 <div >
						<?php echo $this->Form->control('refidsearch', ['label'=>false,"type"=>"select",'options' =>$RefId,"class"=>"form-control select2","multiple"=>true,"data-placeholder"=>"Select Multiple",'empty'=>'Select...']);?>
					</div>
				</div>
				
				<div class=col-md-6>
					 <div >
					  <label class="col-form-label"for=example-text-input>Request Type:  </label>
					  </div> 
					 <div >
						<select name="req_typesearch[]" multiple class="form-control select2" data-placeholder='Select Multiple'>
							<option value="1" <?php echo (isset($_GET['req_typesearch']) && $_GET['req_typesearch'] =="1")? '':''; ?>>Package</option>
							<option value="3" <?php echo (isset($_GET['req_typesearch']) && $_GET['req_typesearch'] =="2")? '':''; ?>>Hotel</option>
							<option value="2">Transport</option>
						</select>
					</div>
				</div> 
				
				<div class=col-md-6>
					<div >
						<label class="col-form-label" for=example-text-input>Start Date:  </label>
					</div> 
					<div >
						<input type="text" class="form-control date-picker" placeholder="Select Date" name=startdatesearch   data-date-format="dd-mm-yyyy">
					</div>
				</div>	 							
				<div class=col-md-6>
					<div >
					  <label class="col-form-label" for=example-text-input>End Date:  </label>
					</div> 
					<div >
					<input type="text" class="form-control date-picker" placeholder="Select Date" name=enddatesearch data-date-format="dd-mm-yyyy">
					</div>
				</div>
			 
				<div class=col-md-6>
					<div >
						<label class="col-form-label"for=example-text-input>Pickup City (Transportation):  </label>
					</div> 
					<div >
						<select class="form-control select2"  name=pickup_city id=pickup_city>
						   <option value="">Select</option>
						   <?php foreach($allCities1 as $city){?>
						   <option value="<?php echo $city['value'];?>"><?php echo $city['label'];?></option>
						   <?php }?>
						</select>
					</div>
				</div> 
				<div class=col-md-6>
					<div >
						<label class="col-form-label" for=example-text-input>Destination City (Packages & Hotels):  </label>
					</div> 
					<div class="">
						<select class="form-control select2" name=destination_city id=destination_city>
						   <option value="">Select</option>
						   <?php foreach($allCities1 as $city){?>
						   <option value="<?php echo $city['value'];?>"><?php echo $city['label'];?></option>
						   <?php }?>
						</select>
					</div>
				</div>
				<div class=col-md-6>
					<div >
						<label class="col-form-label"for=example-text-input>Total Budget Range:  </label>
					</div> 
					<div >
						<select name="budgetsearch" class="form-control">
							<option value="">Select Total Budget</option>
							<option value="0-10000">0-10000</option>
							<option value="10001-30000">10001-30000</option>
							<option value="30001-50000" >30001-50000</option>
							<option value="50001-100000" >50001-100000</option>
							<option value="100001-1000000000">100001-Above</option>
						</select>
					</div>
				</div>
				<div class=col-md-6><br>
					<div >
						<input class="input-checkbox100" type="checkbox" value="resposesnohl" name="sort">
						<label class="col-form-label label-checkbox100" for="ckb1">
							Response (High to Low)
						</label>
					</div>
				</div>                         
			</div>
			
			<div class="col-md-12 text-center">
				<hr></hr>
				<a href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'requestlist')) ?>"class="btn btn-danger btn-sm">Reset</a>
				<button class="btn btn-info btn-sm" name="submit" value="Submit" type="submit">Apply</button> 
			</div>
		</fieldset>
	</form>
</div>
<div id="autorefresh_requestlist">
 	<!----------- Main SHow----------->	
 			<?php
            if(count($requests) >0) {
                $m =0;
				
                foreach($requests as $request){ 
					$totmem = $request['adult'] +   $request['children']; 
					  if(isset($_GET['memberssearch']) && $_GET['memberssearch']!="" && $_GET['memberssearch'] !=$totmem ){
						continue;
					  }
					  if($m%3==0) { 
						echo '<div class="clearfix"></div>'; 
					  }
                  $m++;
                 // pr($request); exit;
				  ?>
				  
               <div id=cat >
					<?php 
					if(isset($_GET['sort']) && $_GET['sort']=="requesttype") {
						?>
						<div class="col-md-4 req" id="<?php if($request['category_id']==1){ echo "1";} if($request['category_id']==2){ echo "3";}if($request['category_id']==3){ echo "2";} ?>" style="padding-top:15px;">
						<?php 
					} 
					else 
					{ ?>
						<div class="col-md-4 req" id="<?php echo $data['responsecount'][$request['id']]; ?>" style="padding-top:15px;">
					<?php 
					}
					 
					if($request['category_id']==1){ 
						$image=$this->Html->image('/img/slider/package-icon.png');
						$text="<span class='packageType'>Package</span>";
					} 
					if($request['category_id']==2){
						$image= $this->Html->image('/img/slider/transport-icon.png');
						$text="<span class='transportType'>Transport</span>";
					}
					if($request['category_id']==3){
						$image= $this->Html->image('/img/slider/hotelier-icon.png');
						$text="<span class='hotelType'>Hotel</span>";
					}
					
					$created=$request['created'];
					$org_created=date('d-M-Y', strtotime($created));
					?>
					<fieldset >
						<legend align="center"><?php echo $image; ?></legend>
					<div class="contain">
							<p class="pull-right" style="margin-top:-30px !important;"> <?php echo $org_created; ?></p>
							<p>Request Type:  &nbsp;<?php echo $text; ?></p>
							<p>Reference ID:  &nbsp;
								<span class="details"><?php echo $request['reference_id']; ?></span>
							</p>
							<p>Total Budget:  &nbsp; 
								<?php 
									$total_budget=round($request['total_budget']);
								?>
								<span class="details">&#8377; 
								<?php echo ($total_budget)? "". ($total_budget): "-- --" ?>
								</span>
							</p>
							<?php
							if($request['category_id']==2){ ?>
								<p>Pickup City:  &nbsp;
									<span class="details"><?php echo ($request['pickup_city'])?$allCities[$request['pickup_city']]:"-- --"; ?><?php echo ($request['pickup_state'])?' ('.$allStates[$request['pickup_state']].')':"";  ?></span>
								</p>
							<?php 
							}
							else
							{?>
								<p>Destination City:  &nbsp;
									<span class="details">
									<?php 
									$a=$request['city_id']?$allCities[$request['city_id']]:"-- --"; 
									$b=$request['state_id']?' ('.$allStates[$request['state_id']].')':"";
									echo mb_strimwidth($a.$b, 0,28, "...");?>
									<?php
										/* if($request['category_id'] == 1){
											if(count($request['hotels']) >1) {
												unset($request['hotels'][0]);?><?php
												foreach($request['hotels'] as $row) { ?>
													<?php echo ($row['city_id'])?', '.$allCities[$row['city_id']]:""; ?>
													<?php echo ($row['state_id'])?' ('.$allStates[$row['state_id']].')':"";  
												}  
											}  
										} */?>
									</span>
								</p>
							<?php
							}
							if($request['category_id'] == 3 ) { ?>
								<p>Start Date:  &nbsp;
									<span class="details"><?php echo ($request['check_in'])?date('d/m/Y',strtotime($request['check_in'])):"-- --"; ?></span>
								</p>
								<p>End Date:  &nbsp;
									<span class="details"><?php echo ($request['check_out'])?date('d/m/Y',strtotime($request['check_out'])):"-- --"; ?></span>
								</p>
							<?php 
							} 
							if($request['category_id'] == 1 ) {
								$sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$request['id']."'";
                                $stmt = $conn->execute($sql);
                                $result = $stmt->fetch('assoc');
							?>
								<p>Start Date:  &nbsp;
									<span class="details"><?php echo ($request['check_in'])?date('d/m/Y',strtotime($request['check_in'])):"-- --"; ?></span>
								</p>
								<p>End Date:  &nbsp;
									<span class="details"><?php if(!empty($result['TopDate'])) { ?><?php echo date('d/m/Y',strtotime($result['TopDate'])); ?><?php }else{?>End Date: <?php echo ($request['check_out'])?date('d/m/Y',strtotime($request['check_out'])):"-- --"; ?><?php }?></span>
								</p>
								
							<?php
							}
							if($request['category_id'] == 2 ) { 
							?>
								<p>Start Date:  &nbsp;
									<span class="details"><?php echo ($request['start_date'])?date('d/m/Y',strtotime($request['start_date'])):"-- --"; ?></span>
								</p>
								<p>End Date:  &nbsp;
									<span class="details"><?php echo ($request['end_date'])?date('d/m/Y',strtotime($request['end_date'])):"-- --"; ?></span>
								</p>
							<?php
							}
							?>
							
							<p>Members:  &nbsp;
								<span class="details"><?php echo $request['adult'] +   $request['children']; ?></span>
							</p>
							<?php 
							$pid=$request['id'];
							?>
							<p>Comment:  &nbsp;
								<span class="details">
								<?php echo mb_strimwidth($request['comment'], 0, 25, "...");?></span>
							</p>
							<hr></hr> 
							 
							<table width="100%" border="0">
							<tr>
								<td width="33%" style="padding:3px !important;">
									<div class="check_responses" id="checkresponse_<?php echo $request['id'];?>">
										<?php if($data['responsecount'][$pid] > 0 ) 
										{ ?>
											 <a style="width:99%;" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$pid)) ?>"class="check_responses_btn btn btn-success btn-sm"> Responses (<strong><?php echo $data['responsecount'][$pid]; ?></strong>) </a>
										  <?php 
										} 
										else 
										{ ?>
											<a style="width:99%;cursor: no-drop !important;" class="check_responses_btn btn btn-warning btn-sm"> No Responses</a>
										<?php 
										} ?>
									</div>
								</td>
								
								<td width="33%" style="padding:3px !important;">
									<a style="width:99%;" class="viewdetail btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'viewdetails',$request['id'])) ?>"data-target="#myModal1<?php echo $request['id']; ?>"data-toggle=modal> Details</a>
									<div class="fade modal"id="myModal1<?php echo $request['id']; ?>"role=dialog>
										<div class=modal-dialog>
											<div class=modal-content>
											   <div class=modal-header>
												  <button class=close data-dismiss=modal type=button>×</button>
												  <h4 class=modal-title>Details</h4>
											   </div>
											   <div class=modal-body></div>
											</div>
										</div>
									</div>
								</td>

								<td width="33%" style="padding:3px !important;">
											<a style="width:99%;" class=" btn btn-danger btn-sm"  request_id="<?php echo $request['id']; ?>"  data-target="#deletemodal<?php echo $request['id']; ?>"data-toggle=modal>Remove</a>
											
													<!-------Delete Modal Start--------->
												<div id="deletemodal<?php echo $request['id']; ?>" class="modal fade" role="dialog">
													<div class="modal-dialog modal-md" >
													<form method="post">
														<!-- Modal content-->
															<div class="modal-content">
															  <div class="modal-header" style="height:100px;">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title">
																	Are you sure you want to remove this request?
																	</h4>
																</div>
																<div class="modal-footer" style="height:60px;">
																	<a request_id="<?php echo $request['id']; ?>" type="button"  href=javascript:void(0); class="removeRequest btn btn-info btn-sm" name="removerequest">Yes</a>
																	<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
																</div>
															</div>
														</form>
													</div>
												</div>
											<!-------Delete Modal End--------->
										
								
								
									<!--<a style="width:99%" class="removeRequest btn btn-danger btn-sm" request_id="<?php //echo $request['id']; ?>" data-target="#delete<?php //echo $request['id']; ?>"data-toggle=modal>Remove</a>
									<div class="fade modal"id="delete<?php //echo $request['id']; ?>"role=dialog>
										<div class=modal-dialog>
											<div class=modal-content>
											   <div class=modal-header>
												  <button class=close data-dismiss=modal type=button>×</button>
												  <h4 class=modal-title>Remove Request</h4>
											   </div>
											   <div class=modal-body></div>
											   
											</div>
										</div>
									</div>-->
								</td>
							</tr>
						</table>
					</fieldset>
                  </div>
                  <?php } ?>
                  <div class=pages></div>
                  <?php }else {?>
                  <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box-event text-center">
<?php if(isset($_GET['req_typesearch'])){ echo "No matching data.";}else{ echo "There is no request in the mailbox.";}?></div>
                  </div>
                  <?php } ?>
				</div>				  
               </div> 
		   </div>
			</div>
		</div>
	</div>
</div>
<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
<div id="loader"></div>
</div>
 
<script>

    $(document).ready(function() {
	jQuery(".filter_box").submit(function(){
		jQuery("#loader-1").show();
	});
        $(".removeRequest").on('click',function(e) {
			$('#ajaxcount').val('100000');
			var box=$(this);
            e.preventDefault();
            var t = $(this).attr("request_id");
            $.ajax({
                url: "<?php echo $this->Url->build(array('controller'=>'users','action'=>'removeRequest')) ?>",
                type: "POST",
                data: {
                    request_id: t
                }
            }).done(function(e) {
                if(e==1){  //$('.modal').toggle();
				location.reload();
					//box.closest('div.col-md-4.req').hide();
				}
             })
        });  
    });
	 
</script>