<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php echo $this->Html->script(['jquery.validate']);?>
<?php
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
?>
<style>
	legend {
		text-align:center !important;
		align:center !important;
	}
	fieldset
	{
		border-radius: 7px;
		box-shadow: 0 1px 9px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
	}
	.details {color:#000 !important; font-weight: 400;}	
	li > p{
		color:#96989A !important;
		margin: 0 0 4px !important;
		line-height:17px !important; 	
	}	
		
</style>
<div class="container-fluid" id="finalized_request_list">
<div class="row equal_column" > 
    <div class="col-md-12" > 
		<?php echo $this->element('subheader');?>
		<?php echo  $this->Flash->render() ?>
	</div>
</div>
<div class="box box-primary">
		<div class="box-header with-border"> 
		<h3 class="box-title" style="padding:5px;">Finalized Requests</h3>
			<div class="box-tools pull-right">
				<!--<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>-->
				<a style="font-size:22px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
			</div>
		
</div>
<div class="box-body">
<div class="row">
<div class="" >
<div id="myModal123" class="modal fade form-modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Sorting</h4>
		  </div>
		  <div class="modal-body">
			<table width="90%" class="shotrs">
			<tr>
				<td>
						<a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'finalized-request-list')) ?>?sort=totalbudgethl">Total Budget (High To Low) <span class="arrow"></span></a>
						<a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'finalized-request-list')) ?>?sort=totalbudgetlh"> Total Budget (Low To High)<span class="arrow"></span></a>

						 <a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'finalized-request-list')) ?>?sort=requesttype">Request Type  <span class="arrow"></span></a> </li>
					  </td>
				</tr>
			</table>
		  </div>
		  <div class="modal-footer">
		  </div>
		</div>
  </div>
</div>
 <div id="myModal122" class="modal fade form-modal" role="dialog">
  <div class="modal-dialog" >
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Filter</h4>
      </div>
	 <form method="get" class="filter_box" style="margin-top:5px">
     <div class="modal-body">
	 <div class="row form-group">
		<div class="col-md-12">
		<div class=col-md-4>
			<label for="example-text-input" class="  col-form-label">Agent Name:  </label>
		</div> 
		 <div class=col-md-7>


		  <?php 
		$options=array();
		if(!empty($finalresponse)){
			foreach($finalresponse as $st)
			{ 
				$key[]=$st['user_id'];
				$value[]=$st['first_name'].' '.$st['last_name'];
			};
			$quiqueValue=array_values(array_unique($value)); 
			$quiqueKey=array_values(array_unique($key));
			
			$cv=0; 
			foreach($quiqueKey as $keys){
				$textV=$quiqueValue[$cv];
				$selectoption[] = ['value'=>$keys,'text'=>$textV];
				$cv++;		 
			}
		}
		echo $this->Form->control('agentnamesearch', ['label'=>false,"type"=>"select",'options' =>$selectoption,"class"=>"form-control select2","data-placeholder"=>"Select Multiple ",'empty'=>'Select...','multiple'=>true]);?>
		</div>
		</div>
		</div>
		<div class="row form-group">
			 <div class=col-md-12>
				 <div class=col-md-4>
				 <label class="col-form-label"for=example-text-input>Reference ID:  </label>
				 </div> 
				 <div class=col-md-7>
					<?php echo $this->Form->control('refidsearch', ['label'=>false,"type"=>"select",'options' =>$RefId,"class"=>"form-control select2","data-placeholder"=>"Select Multiple ",'empty'=>'Select...','multiple'=>true]);?>
				 </div>
			 </div>
		</div>

						 <div class="row form-group ">
							<div class=col-md-12>
								 <div class=col-md-4>
								  <label class="col-form-label"for=example-text-input>Request Type:  </label>
								  </div>  
								 <div class=col-md-7>
									<select name="req_typesearch[]" multiple="multiple" class="form-control select2"  data-placeholder='Select Multiple'>
									<option value="1" <?php echo (isset($_GET['req_typesearch']) && $_GET['req_typesearch'] =="1")? '':''; ?>>Package</option>
									<option value="3" <?php echo (isset($_GET['req_typesearch']) && $_GET['req_typesearch'] =="2")? '':''; ?>>Hotel</option>
									<option value="2">Transport</option></select>
								</div>
							 </div>
						</div>
					 
						<div class="row form-group ">
							<div class=col-md-12>
								<div class=col-md-4>
									<label class="col-form-label"for=example-text-input>Total  Budget Range:  </label>
								</div> 
									<div class=col-md-7>
										<select name="budgetsearch" class="form-control"  data-placeholder='Select...'><option value="">Select...</option><option value="0-10000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="0-10000")? '':''; ?>>0-10000</option><option value="10000-30000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="10000-30000")? '':''; ?>>10000-30000</option><option value="30000-50000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="30000-50000")? '':''; ?>>30000-50000</option><option value="50000-100000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="50000-100000")? '':''; ?>>50000-100000</option>
										<option value="100000-100000000000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="100000-100000000000")? '':''; ?>>100000-Above</option>
										</select>
									</div>
								</div>
							  </div>
								<div class="row form-group">
									<div class=col-md-12>
									  <div class=col-md-4>
									 <label class="col-form-label" for=example-text-input>Start Date:  </label>
									 </div> 
									 <div class=col-md-7>
									 <input class="form-control datepickers" data-date-format="dd-mm-yyyy" name=startdatesearch id="datepicker1">
									 </div>
									</div>	
								</div>
								<div class="row form-group">								
									<div class=col-md-12>
										<div class=col-md-4>
										  <label class="col-form-label" for=example-text-input>End Date:  </label>
										</div> 
										<div class=col-md-7>
										<input class="form-control datepickers" data-date-format="dd-mm-yyyy" name=enddatesearch id="datepicker2">
										</div>
									</div>
								</div>
                              <div class="row form-group">
									 <div class=col-md-12>
										 <div class=col-md-4>
										 <label class="col-form-label"for=example-text-input>Pickup City (Transportation):  </label>
										 </div> 
										<div class=col-md-7>
											<select class="form-control select2"  name=pickup_city id=pickup_city>
											   <option value="">Select</option>
											   <?php foreach($allCities1 as $city){?>
											   <option value="<?php echo $city['value'];?>"<?php if(isset($_GET['pickup_city']) AND $_GET['pickup_city']==$city['value']){ echo ''; }?>><?php echo $city['label'];?></option>
											   <?php }?>
											</select>
										</div>
									 </div>
                                 </div>   
							<div class="row form-group">								 
								 <div class=col-md-12>
									 <div class=col-md-4>
									 <label class="col-form-label" for=example-text-input>	Destination City (Packages & Hotels):  </label>
									 </div> 
									<div class="col-md-7">
										<select class="form-control select2" name=destination_city id=destination_city>
										   <option value="">Select</option>
										   <?php foreach($allCities1 as $city){?>
										   <option value="<?php echo $city['value'];?>"<?php if(isset($_GET['destination_city']) AND $_GET['destination_city']==$city['value']){ echo ''; }?>><?php echo $city['label'];?></option>
										   <?php }?>
										</select>
										 
									</div>
								</div>
						  </div>
 						<div class="modal-footer">
							<div class="row form-group">			  
								<div class="col-md-12 text-center">
							 
								   <input type="submit" name="submit" value="Apply"  class="btn btn-primary btn-submit">
								   <a class="btn btn-primary btn-submit" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'finalizedRequestList')) ?>">Reset</a>
								</div>
							</div>
							 
						</div>
					</div>
				</div>
			</div>
		</div>

<?php if(isset($_GET['sort']) && $_GET['sort']=="requesttype") { ?>
<script>
$(document).ready(function(){

$(".req").sort(function (a, b) {
    return parseInt(a.id) > parseInt(b.id);
}).each(function () {
    var elem = $(this);
    elem.remove();
    $(elem).appendTo("#cat");
});

   })
</script>
			<?php } ?>
					<?php  
					if(count($requests) >0) {
						//pr($requests->toArray()); 
					 foreach($requests as $request){
					 $id=$request['id'];
						$totmem = $request['adult'] +   $request['children']; 
					   if(isset($_GET['memberssearch']) && $_GET['memberssearch']!="" && $_GET['memberssearch'] !=$totmem ){
						continue;
					   }
					 ?>
							<div id="cat" >
									<div class="col-md-4" style="padding-top:15px;" id="<?php if($request['category_id']==1){ echo "1";} if($request['category_id']==2){ echo "3";}if($request['category_id']==3){ echo "2";} ?>">
									<?php 
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
				<?php 
					$total_rating=0;
					$rate_count=0;
					$final_rating=0;
					$sql1="Select * from `testimonial` where `user_id`='".$finalresponse[$request['id']]['user_id']."' ";
					$stmt1 = $conn->execute($sql1);
					foreach($stmt1 as $bresul){
						$rate_count++;
						$rating=$bresul['rating'];
						$total_rating+=$rating;
					} 
					if($total_rating>0){
						@$final_rating=round($total_rating/$rate_count);
					}
					 
					?>
							<fieldset>
							<legend><?php echo $image; ?></legend>
							<span style="margin-top:-30px;float:right;"><?php echo $org_created; ?></span>
								<ul>
								<li >
									<p>
										From:  <span class="details"><a href="viewprofile/<?php echo $finalresponse[$request['id']]['user_id']; ?>/1"><?php echo str_replace(';',' ',$allUsers[$finalresponse[$request['id']]['user_id']]); ?></a> 
										<?php if($final_rating>0){ ?>
											<font color="#1295AB"> (<?php echo round($final_rating); ?> <i class="fa fa-star"></i>)</font>
										<?php } ?>
										</span>
									</p>
								 </li>
								  <li >
								 <p>
									Request Type:  <span class="details"><?php  echo $text; ?></span>
								</p>
								</li>
								
								 <li >
									<p>
										<?php 
											$total_budget=round($request['total_budget']);
										?>
										Total Budget:  <span class="details">
										<?php echo ($total_budget)? "Rs. ". ($total_budget): "-- --" ?>
										</span>
									</p>
								</li>
								
								 <li >
									<p>
										<?php 
											$quotation_price=round($finalresponse[$request['id']]['quotation_price']);
										?>
										Quotation Price:  <span class="details">
										<?php echo ($quotation_price)? "Rs. ". ($quotation_price): "-- --" ?>
										</span>
									</p>
								</li>
								
								<li>
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
									$a=$request['city_id']? $allCities[$request['city_id']]:"-- --"; 
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
								?>
								</li>
								
							   <li >
									<p>
										Reference ID:  <span class="details"><?php echo $request['reference_id']; ?></span>
									</p>
								</li>
								<?php if($request['category_id'] == 3 ) { ?>
								<li >
									<p>
										Start Date:  <span class="details"><?php echo ($request['check_in'])?date('d/m/Y',strtotime($request['check_in'])):"-- --"; ?></span>
									</p>
								</li>
								<li >
									<p>
										End Date:  <span class="details"><?php echo ($request['check_out'])?date('d/m/Y',strtotime($request['check_out'])):"-- --"; ?></p></span>
								</li>
								<?php } elseif($request['category_id'] == 1 ) {
										$sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$request['id']."'";
									$stmt = $conn->execute($sql);
									$result = $stmt ->fetch('assoc');	                    	
									?>
								<li >
									<p>
										Start Date:  <span class="details"><?php echo ($request['check_in'])?date('d/m/Y',strtotime($request['check_in'])):"-- --"; ?></span>
									</p>
								</li>
								<li >
									<p>
									<?php if(!empty($result['TopDate'])) { ?>
									End Date:   <span class="details"><?php echo date('d/m/Y',strtotime($result['TopDate'])); ?></span>
									<?php }else{?>
										End Date:   <span class="details"><?php echo ($request['check_out'])?date('d/m/Y',strtotime($request['check_out'])):"-- --"; ?></span>
										<?php }?>
									</p>
								</li>
								<?php } elseif($request['category_id'] == 2 ) {?>
								<li >
									<p>
										Start Date:  <span class="details"><?php echo ($request['start_date'])?date('d/m/Y',strtotime($request['start_date'])):"-- --"; ?>
									</p>
								</li>
								 <li >
									<p>
										End Date:  <span class="details"><?php echo ($request['end_date'])?date('d/m/Y',strtotime($request['end_date'])):"-- --"; ?><span class="budy right" style="display:none;"><a href="#" ><?php echo $this->Html->image('friend-ico.png'); ?></a></span></span>
									</p>
								</li>
								<?php } ?>
								
								 <li>
									<p>
										Members:  <span class="details"><?php echo $request['adult'] +   $request['children']; ?></span>
									</p>
								</li>
								<li>
									<p>Response Comment:  <span class="details">
									<?php echo mb_strimwidth($finalresponse[$request['id']]['comment'], 0, 25, "...");?></span></p>
								 </li>
							</ul>
							<hr></hr>
					 
						<table width="100%" style="text-align:center">
							<tr>
								<td width="33%" style="padding:3px !important;">
									<a style="width:99%" data-toggle="modal"  class="btn btn-success btn-sm" data-target="#myModalchat<?php echo $request['id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'userChat',$request['id'], $finalresponse[$request['id']]['user_id'],3)) ?>"> Chat ( <strong><?php echo $chatdata['chat_count'][$request['id']]; ?> </strong> )</a>                        
								</td>
								<td width="33%" style="padding:3px !important;">
									<a style="width:99%" data-toggle="modal"  class="btn btn-info btn-sm" data-target="#myModal1<?php echo $request['id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'viewdetails',$request['id'])) ?>"> Details</a>
								</td>
								
								<td width="33%" align="left" style="padding:3px !important;">
 									<?php $reviewi = $request['responses'][0]['user_id']."-".$request['id']; ?> 
									<?php 
									if(array_key_exists($finalresponse[$request['id']]['user_id'], $BusinessBuddies)) {?>
										<span style=" width:99%;background-color:#dadadabf;display: inline-block;text-align: center;"  class=" btn-defult btn-sm ">
											Following
										</span>
									<?php } 
									else{ ?>
										<!--a style="width:99%" href="javascript:void(0);" class="businessBuddy btn btn-warning btn-sm" user_id = "<?php //echo $finalresponse[$request['id']]['user_id']; ?>"> Follow User</a-->
										
										<a style="width:99%" data-toggle="modal" class="btn btn-warning btn-sm" data-target="#follow<?php echo $id; ?>" > Follow User </a>
										<!-------Contact Details Modal --------->
										<div id="follow<?php echo $id; ?>" class="modal fade" role="dialog">
											<div class="modal-dialog modal-md" >
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Are you sure you want to follow this user?</h4>
													</div>
													<div class="modal-footer">
													<button type="button"  href="javascript:void(0);" class="businessBuddy btn btn-danger" user_id = "<?php echo $finalresponse[$request['id']]['user_id']; ?>" >Follow</button>
													<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
													</div>
												</div>
											</div>
										</div>
										 
										<?php } ?>
								</td>
							</tr>
						</table>
						<table width="100%" style="text-align:center;">
							<tr>
								<td width="50%" style="padding:3px !important;">
 									<?php $reviewi = $request['responses'][0]['user_id']."-".$request['id']; ?>
									 <a style="width:99%" data-toggle="modal" class="btn btn-successto btn-sm" data-target="#myModal1review<?php echo $request['id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'addtestimonial',  $reviewi )) ?>"> Review </a>
								</td>
								<td width="50%" align="left" style="padding:3px !important;">
									<?php
										$sql="Select count(*) as block_count from blocked_users where blocked_user_id='".$finalresponse[$request['id']]['user_id']."' AND blocked_by='".$request['user']['id']."'";
										$stmt = $conn->execute($sql);
										$bresult = $stmt ->fetch('assoc');
										if($bresult['block_count']>0){
											@$blocked = 1;
										}
										else{
											@$blocked = 0;
										}
									 
									if($blocked==1)
									{ ?>
										 
										<span style="width:99%; background-color:#dadadabf;display: inline-block;text-align: center;"  class=" btn-defult btn-sm ">
										User Blocked </span>
									<?php }
									else
									{ ?>
									<a style="width:99%" data-toggle="modal" class="btn btn-danger btn-sm" data-target="#block<?php echo $request['id']; ?>"  > Block User </a>
									
									<div id="block<?php echo $request['id']; ?>" class="modal fade" role="dialog">
										<div class="modal-dialog modal-md" >
											<!-- Modal content-->
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">
															<font color="black">Are you sure you want to block this user?</font>
														</h4>
													</div>
														<div class="modal-footer">
														<button type="button"  href="javascript:void(0);" class="blockUser btn btn-danger" user_id = "<?php echo $finalresponse[$request['id']]['user_id']; ?>">Block</button>
														<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
														</div>
													</div>
												</div>
									</div>
									<?php } ?>
								</td>
								
							</tr>
						</table>
						
							  
							 <div class="modal fade" id="myModalchat<?php echo $request['id']; ?>" role="dialog">
									<div class="modal-dialog">
									  <!-- Modal content-->
									  <div class="modal-content">
										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal">&times;</button>
										  <h4 class="modal-title">Chat</h4>
										</div>
										<div class="modal-body">
										
										</div>
									  </div>
									</div>
									</div>
									<div class="modal fade" id="myModal1review<?php echo $request['id']; ?>" role="dialog">
										<div class="modal-dialog">
										  <!-- Modal content-->
										  <div class="modal-content">
											<div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal">&times;</button>
											  <h4 class="modal-title">Review</h4>
											</div>
											<div class="modal-body">
											</div>
										  </div>
										</div>
									</div>
									<div class="modal fade" id="myModal1<?php echo $request['id']; ?>" role="dialog">
										<div class="modal-dialog">
										<!-- Modal content-->
										  <div class="modal-content">
											<div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal">&times;</button>
											  <h4 class="modal-title">Details</h4>
											</div>
											<div class="modal-body">
											</div>
										  </div>
										</div>
									</div>
								</fieldset>
							   </div>
							 </div>
							<?php } ?>
						</div>
					</div>
						<div class="pages"></div>
						<?php }else {?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
								<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 text-center box-event">
					<?php if(isset($_GET['req_typesearch'])){ echo "No matching data.";}else{ echo "There are no finalized requests in the mailbox.";}?>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
<?php echo $this->element('footer');?>
<?php echo $this->Html->script(['ap.pagination.js']);?>
<script>
	$(".blockUser").click(function (e) {
		e.preventDefault();
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'blockUser')) ?>";
		var user_id = $(this).attr("user_id");
		 
			$.ajax({
				url:url,
				type: 'POST',
				data: {user_id:user_id}
			}).done(function(result){
				if(result == 1) {
					location.reload();
				}else if(result == 2){
				 
				} else {
					 
				}
			});
		 
	});
	$(".businessBuddy").on('click',function () {
 		var datas = $(this);
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'addBusinessBuddy')) ?>";
		var user_id = $(this).attr("user_id");
		$.ajax({
			url:url,
			type: 'POST',
			data: {user_id:user_id}
		}).done(function(result){
			if(result == 1) {
				location.reload();
			} else {
				alert("There is some problem, please try again.");
			}
		});
	});
	
	$("#responsesWrap").apPagination({
		targets: ".box-event",
		pagesWrap: ".pages",
		ulClass: "pagination",
		perPage: 5,
		nextText: '<i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-right"></i>',
		prevText: '<i class="glyphicon glyphicon-menu-left"></i><i class="glyphicon glyphicon-menu-left"></i>'
	});
$('#UserChatForm').validate({
	rules: {
		"message":  {
			required:  true
		}
	},
	messages: {
		"message":  {
			required:  "Please enter message."
		}
	},
	ignore: ":hidden:not(select)"
});
function f1(res){
	var result = res.split(",");
	$('#chat_request_id').val(result[0]);
	$('#chat_user_id').val(result[1]);
}
</script>