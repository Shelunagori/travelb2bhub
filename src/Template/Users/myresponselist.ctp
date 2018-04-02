<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<style>
legend{
	text-align: center;
}
.details {color:#000 !important; font-weight: 400;}	
	li > p{
		color:#96989A !important;
		margin: 0 0 4px !important;
	}
</style>
<?php
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
?>
<div class="container-fluid" id="requestlist">
<div class="row equal_column" > 
    <div class="col-md-12" style="background-color:#"> 
		<br> 
		<?php echo  $this->Flash->render() ?>
	</div>
	</div>
<div class="box box-primary">
		<div class="box-header with-border"> 
			<h3 class="box-title" style="padding:5px">My Responses</h3>
				<div class="box-tools pull-right">
					<!--<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>-->
					<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
				</div>
			</div>
<div class="box-body">
	<div class="row">
	<div class="col-md-12">
		 <div id="myModal123" class="modal fade form-modal" role="dialog">
		  <div class="modal-dialog" style=" width: 20%;">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Sorting</h4>
			  </div>
				<form method="get" class="filter_box">
					<div class="modal-body" style="height:170px;">
						<div class="col-md-12 row form-group ">
							<div class="col-md-12">
									 <input class="btn btn-info btn-sm" type="radio" name="sort" value="totalbudgethl"/>
									 <label class="col-form-label" for=example-text-input>
											Total Budget (Hign to Low)
									 </label>
							</div>
                        </div>
						<div class="col-md-12 row form-group ">
							<div class="col-md-12">
									 <input class="btn btn-info btn-sm" type="radio" name="sort" value="totalbudgetlh"/>
									 <label class="col-form-label"for=example-text-input>
										Total Budget (Low to High)
									 </label>
							</div>
                        </div>
						<div class="col-md-12 row form-group ">
							<div class="col-md-12">
									<input class="btn btn-info btn-sm" type="radio" name="sort" value="agentaz"/>
									<label class="col-form-label"for=example-text-input>
										Agent Name (A To Z)   
									</label>
							</div>
						</div>
						<div class="col-md-12 row form-group ">
							<div class=col-md-12>
									<input class="btn btn-info btn-sm" type="radio" name="sort" value="agentza"/>
									<label class="col-form-label"for=example-text-input>
										Agent Name (Z To A) 
									</label>
							</div>
						</div>
						<div class="col-md-12 row form-group " style="display:none;">
							<div class=col-md-12>
									<input class="btn btn-info btn-sm" type="radio" name="sort" value="requesttype"/>
									<label class="col-form-label"for=example-text-input>
									Request Type 
									
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
<div id="myModal122" class="modal fade form-modal" role="dialog">
  <div class="modal-dialog">
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
			<label for="example-text-input" class="  col-form-label">Agent Name</label>
		</div>
		<div class=col-md-1>:</div>
		 <div class=col-md-7>
		  <input type="text" name="agentnamesearch" value="<?php echo isset($_GET['agentnamesearch'])? $_GET['agentnamesearch']:''; ?>"  class="form-control">
		</div>
		</div>
		</div>
		<div class="row form-group">
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

						 <div class="row form-group ">
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
						<div class="row form-group ">
							<div class=col-md-12>
								 <div class=col-md-4>
								  <label class="col-form-label"for=example-text-input>Chat With </label>
								  </div>
								  <div class=col-md-1>:</div>
								 <div class=col-md-7>
									 <select name="chatwith" class="form-control"><option value="">Select Chat With</option>
									   <?php if(!empty($UserResponse)){ 
											foreach($UserResponse as $user){               
									   ?>
									   <option <?php echo (isset($_GET['chatwith']) && $_GET['chatwith'] ==$user['id'])? 'selected':''; ?> value="<?php echo $user['id']?>"><?php echo $user['first_name'].' '.$user['last_name']?></option>
									   <?php }}?>
									  </select>
								</div>
							 </div>
						</div>
						<div class="row form-group ">
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
								<div class="row form-group">
									<div class=col-md-12>
									  <div class=col-md-4>
									 <label class="col-form-label" for=example-text-input>Start Date</label>
									 </div>
									<div class=col-md-1>:</div>
									 <div class=col-md-7>
									 <input class="form-control datepicker" name=startdatesearch value="<?php echo isset($_GET['startdatesearch'])? $_GET['startdatesearch']:''; ?>" id="datepicker1" data-date-format="dd-mm-yyyy">
									 </div>
									</div>	
								</div>
								<div class="row form-group">								
									<div class=col-md-12>
										<div class=col-md-4>
										  <label class="col-form-label" for=example-text-input>End Date</label>
										</div>
										<div class=col-md-1>:</div>
										<div class=col-md-7>
										<input class="form-control datepicker" name=enddatesearch value="<?php echo isset($_GET['enddatesearch'])? $_GET['enddatesearch']:''; ?>" id="datepicker2" data-date-format="dd-mm-yyyy">
										</div>
									</div>
								</div>
                              <div class="row form-group">
									 <div class=col-md-12>
										 <div class=col-md-4>
										 <label class="col-form-label"for=example-text-input>Pickup City</label>
										 </div>
										<div class=col-md-1>:</div>
										<div class=col-md-7>
											<select class="form-control select2"  name=pickup_city id=pickup_city>
											   <option value="">Select</option>
											   <?php foreach($allCities1 as $city){?>
											   <option value="<?php echo $city['value'];?>"<?php if(isset($_GET['pickup_city']) AND $_GET['pickup_city']==$city['value']){ echo 'selected'; }?>><?php echo $city['label'];?></option>
											   <?php }?>
											</select>
										</div>
									 </div>
                                 </div>   
								<div class="row form-group">								 
									 <div class=col-md-12>
										 <div class=col-md-4>
										 <label class="col-form-label" for=example-text-input>Destination City</label>
										 </div>
										<div class="col-md-1">:</div>
										<div class="col-md-7">
											<select class="form-control select2" name=destination_city id=destination_city>
											   <option value="">Select</option>
											   <?php foreach($allCities1 as $city){?>
											   <option value="<?php echo $city['value'];?>"<?php if(isset($_GET['destination_city']) AND $_GET['destination_city']==$city['value']){ echo 'selected'; }?>><?php echo $city['label'];?></option>
											   <?php }?>
											</select>
											<?php //echo $this->Form->control('preference', ["id"=>"destination_city", "type"=>"select", 'options' =>$allCities2, "class"=>"form-control"]); ?>
										</div>
									</div>
                              </div>
                               <!--<div class="row form-group">
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

							 -->
						  
						 <div class="row form-group">
							<div class="col-md-12">
								<div class=col-md-4>
									<label for="example-text-input" class="  col-form-label">Following</label>
								</div>
								<div class=col-md-1>:</div>
								 <div class=col-md-7>
									<input type="checkbox" name="followsearch" value="1" <?php echo isset($_GET['followsearch'])? "checked":''; ?>  >
								</div>                            
							</div>
						  </div>
						  
						   <div class="row form-group">
							<div class="col-md-12">
								<div class=col-md-4>
									<label for="example-text-input" class="  col-form-label">Shared Details</label>
								</div>
								<div class=col-md-1>:</div>
								 <div class=col-md-7>
									<input type="checkbox" name="followsearch" value="1" <?php echo isset($_GET['is_details_shared'])? "checked":''; ?>  >
								</div>                            
							</div>
						  </div>
						<div class="modal-footer">
							<div class="row form-group">			  
								<div class="col-md-12 text-center">
							 
								   <input type="submit" name="submit" value="Apply"  class="btn btn-primary btn-submit">
								   <a class="btn btn-primary btn-submit" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'myresponselist')) ?>">Reset</a>
								</div>
							</div>
							<script>
									   $('#datepicker1').datepicker({
												dateFormat: 'dd/mm/yy',
												changeMonth: true,
												changeYear: true,
												minDate: '<?php echo date("d/m/Y"); ?>',
												onSelect: function(selected) {
													$( "#datepicker2" ).datepicker( "option", "minDate",selected);
													$('#datepicker2').val("");
												}
											});
											$('#datepicker2').datepicker({
												dateFormat: 'dd/mm/yy',
												changeMonth: true,
												changeYear: true,
												minDate: '<?php echo date("d/m/Y"); ?>',
												onSelect: function(selected) {
													var checkInDate = $('#datepicker1').val();
													if(checkInDate == "") {
														alert("Please select check-in date first.");
														$('#datepicker2').val("");
													}
												}
											});
							</script>
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
 });
</script>
<?php } ?>
       <?php //print_r($blockedUser);
									
		if(count($responses) >0) {
			$total_responses = count($responses);
			$m =0;
			foreach($responses as $response){
			//$blockedUser['blockedUser'][$response['id']]
			$totmem = $response['request']['adult'] +  $response['request']['children']; 
			if(isset($_GET['memberssearch'])  && $_GET['memberssearch']!="" && $_GET['memberssearch'] !=$totmem ){
				continue;
			}
			if(isset($_GET['followsearch']) && $_GET['followsearch']==1 && !in_array($response['request']['user_id'],$BusinessBuddies)) {
				continue;
			}
			if($blockedUser['blockedUser'][$response['id']]==1) { $total_responses--; }else{
			if($m%3==0) { echo '<div class="clearfix"></div>'; }
			$m++;
 			?>
            <div class="col-md-4">
			<?php 
               if($response['request']['category_id']==1){ 
					$image=$this->Html->image('/img/slider/package-icon.png');
					$text="<span class='requestType'>Package</span>";
				} 
				if($response['request']['category_id']==2){
					$image= $this->Html->image('/img/slider/transport-icon.png');
					$text="<span class='requestType'>Transport</span>";
				}
				if($response['request']['category_id']==3){
					$image= $this->Html->image('/img/slider/hotelier-icon.png');
					$text="<span class='requestType'>Hotel</span>";
				} 
				 
				$created=$response['created'];
				$org_created=date('d-M-Y', strtotime($created));
				?>
				<fieldset>
					<legend><?php echo $image; ?></legend>
					 <span style="margin-top:0px;float:right;"><?php echo $org_created; ?></span>
					 <div class="contain">
                 <ul>
				 <li class="">
					<p>
                        <?php if($response['is_details_shared']==1){
								$hrefurl =  "viewprofile/".$response['request']['user_id']."/1";                      
                        }else{
								$hrefurl =  "viewprofile/".$response['request']['user_id']."/";                       
                        }?>
                            To : <span class="details"> <a href="<?php echo $hrefurl;?>"><?php echo $response['request']['user']['first_name']; ?>&nbsp;&nbsp;<?php echo $response['request']['user']['last_name']; ?></a>
							<?php if(in_array($response['request']['user_id'],$BusinessBuddies)) {  echo $this->Html->image('friend-ico1.png', [ "height"=>20]); } ?> 
					
					</p>
				</li>
                 <li>
                    <p>
                        Request Type  : <span class="details"> <?php echo $text; ?>
                    </p>
                 </li>
				<li >
					<p>
						Total Budget : <span class="details"> &#8377; <?php echo ($response['request']['total_budget'])? "Rs. ". $response['request']['total_budget'] :"-- --" ?>
					</p>
				 </li>
				 
				<li class="">
					 <p>Quotation Price : <span class="details"> <?php echo ($response['quotation_price'])? " &#8377; ".$response['quotation_price']:"-- --" ?></p>
				</li>
                <li class=" destination">
				   <?php if($response['request']['category_id']==2){ ?>
                  <p>
                   Pickup City : <span class="details"><span> <?php echo ($response['request']['pickup_city'])?$allCities[$response['request']['pickup_city']]:"-- --"; ?><?php echo ($response['request']['pickup_state'])?' ('.$allStates[$response['request']['pickup_state']].')':"";  ?></span>

                  <?php } else { ?>
                        <p>
                        Destination City : <span class="details"> <span><?php echo ($response['request']['city_id'])?$allCities[$response['request']['city_id']]:"-- --"; ?> <?php echo ($response['request']['state_id'])?' ('.$allStates[$response['request']['state_id']].')':""; ?>
                        <?php if($response['request']['category_id'] == 1){
						if(count($response['request']['hotels']) >1) {
							unset($response['request']['hotels'][0]);
							//unset($details['hotels'][0]);?>
							<?php foreach($response['request']['hotels'] as $rowc) { ?>
							<?php echo ($rowc['city_id'])?','.$allCities[$rowc['city_id']]:""; ?><?php echo ($rowc['state_id'])?' ('.$allStates[$rowc['state_id']].')':""; ?>
							<?php } ?>
							<?php } ?>
							<?php } ?></span>
                        </p>
                        <?php } ?>
                 </li>
				<?php if($response['request']['category_id'] == 3 ) { ?>
					<li class="">
                        <p>
                            Start Date : <span class="details"> <?php echo ($response['request']['check_in'])?date("d/m/Y", strtotime($response['request']['check_in'])):"-- --"; ?>
                        </p>
                     </li>
					<li class="">
                        <p>
                            End Date : <span class="details"> <?php echo ($response['request']['check_out'])?date("d/m/Y", strtotime($response['request']['check_out'])):"-- --"; ?>
                        </p>
                    </li>
				<?php } elseif($response['request']['category_id'] == 1 ) {
					$sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$response['request']['id']."'";
						$stmt = $conn->execute($sql);
						$result = $stmt ->fetch('assoc');						
					?>
					<li class="">
                        <p>
                            Start Date : <span class="details"> <?php echo ($response['request']['check_in'])?date("d/m/Y", strtotime($response['request']['check_in'])):"-- --"; ?>
                        </p>
                     </li>
					<li class="">
                        <p>
                        <?php if(!empty($result['TopDate'])) { ?>
                        End Date : <span class="details"> <?php echo date('d/m/Y',strtotime($result['TopDate'])); ?>
                        <?php }else{?>
                        End Date :<span class="details"> <?php echo ($response['request']['check_out'])?date("d/m/Y", strtotime($response['request']['check_out'])):"-- --"; ?>
                        <?php }?>
                            
                        </p>
                     </li>
				<?php } elseif($response['request']['category_id'] == 2 ) { ?>
					<li class="">
                        <p>
                            Start Date : <span class="details"> <?php echo ($response['request']['start_date'])?date("d/m/Y", strtotime($response['request']['start_date'])):"-- --"; ?>
                        </p>
                    </li>
					<li class="">
                        <p>
                            End Date : <span class="details"> <?php echo ($response['request']['end_date'])?date("d/m/Y", strtotime($response['request']['end_date'])):"-- --"; ?>
                        </p>
                    </li>
				<?php } ?>
				                <li class="">
                        <p>
                            Members : <span class="details"> <?php echo $response['request']['adult'] +  $response['request']['children']; ?>
                     </p>
                 </li>
				 
				
	
					
                   <li class="">
                       <p> Comment :<span class="details"><?php echo mb_strimwidth($response['comment'], 0, 25, "...");?></span></p>
                     </li>
                   </ul>
				   <hr></hr>
				   <div class="">
					<table width="100%" border="0" style="text-align:center">
						<tr>
							<td width="33%">
							<?php $id = $response['request']['id'];
							if( !array_key_exists($response["request"]["user_id"], $BusinessBuddies)) {?>
								<a href="#" style="width:99%" class="btn btn-danger btn-sm"> Following</a>
							<?php } 
							else{ ?>
								<a style="width:99%" href="javascript:void(0);" class="businessBuddy btn btn-danger btn-sm" user_id = "<?php echo $response["request"]["user_id"]; ?>"> Follow User</a><?php 
							}
							?>
							</td>
							<td width="33%">
							<a style="width:99%" data-toggle="modal" class="btn btn-info btn-sm" data-target="#myModal1<?php echo $response['id'];?>" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'viewdetails',$id)) ?>"> Details</a>
							<div class="modal fade" id="myModal1<?php echo $response['id'];?>" role="dialog">
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
						 <?php $userChats = $this->Response->getUserChats($response['request_id']); ?>
						</td>
						<td width="33%">
							<a style="width:99%" data-toggle="modal" class="btn btn-success btn-sm" data-target="#myModalChat<?php echo $id; ?>" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'userChat', $response['request_id'], $response["request"]["user_id"],2)) ?>">
							Chat ( <strong><?php echo $chatdata['chat_count'][$response['id']]; ?> </strong> )</a>
							<div class="modal fade" id="myModalChat<?php echo $id; ?>" role="dialog">
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
							
						</td>
					</tr>
				</table>
				
				<?php if($response['is_details_shared'] == 1) { ?>
				<hr></hr>
					<legend><h5 class="text-center">USER CONTACT DETAIL </h5></legend>
                        <ul>
                       <li class="">
                            <p>
                                <strong>Name :</strong> <?php echo $response['request']['user']['first_name']; ?>&nbsp;&nbsp;<?php echo $response['request']['user']['last_name']; ?>  
                           </p>
                        </li>
						<li class="">
                            <p>
                                <strong>Company Name :</strong> <?php echo ($response['request']['user']['company_name'])?$response['request']['user']['company_name']:"-- --"; ?>
                            </p>
                        </li>
						<li class="">
                            <p>
                                <strong>Email :</strong> <?php echo ($response['request']['user']['email'])?$response['request']['user']['email']:"-- --"; ?>
                            </p>
                        </li>
						<li class="">
                            <p>
                                <strong>Mobile No. :</strong> <?php echo ($response['request']['user']['mobile_number'])?$response['request']['user']['mobile_number']:"-- --"; ?>
                            </p>
                        </li>
						<li class="">
                            <p>
                                <strong>Website :</strong> <?php echo ($response['request']['user']['web_url'])?$response['request']['user']['web_url']:"-- --"; ?>
                            </p>
                        </li>
					 
				<?php  } ?>
				</div>
				</div>
				</fieldset>
                  </div>
               
			 
			<?php  } 
			}?>
			<div class="pages"></div>
			
		<?php }
		
		else {?>
             <div class=" ">
                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 box-event">
					 <?php if(isset($_GET['req_typesearch'])){ echo "No matching data.";}else{ echo "You have not responded to any requests.";}?>
                </div>
            </div>
		<?php } ?>
		
		<?php if(isset($total_responses) AND $total_responses==0){?>
				<div class=" ">
                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 box-event">
					<?php if(isset($_GET['req_typesearch'])){ echo "No matching data.";}else{ echo "You have not responded to any requests.";}?>
                </div>
            </div>
			<?php }?>
			</div>
          </div>
      </div>
    </div>
</div>
</div>
<script>
$(document).ready(function () {
	$('.datepicker').datepicker();
	/*
	$("#responsesWrap").apPagination({
		targets: ".responses-list",
		pagesWrap: ".pages",
		ulClass: "pagination",
		perPage: 5,
		nextText: '<i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-right"></i>',
		prevText: '<i class="glyphicon glyphicon-menu-left"></i><i class="glyphicon glyphicon-menu-left"></i>'
	});
	$(".filter-icon").click(function(e){
		e.preventDefault();
		$(this).parent(".custom-filters-wrap").toggleClass("active");
	});
	*/
	$(".businessBuddy").on('click',function () {
 		var datas = $(this);
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'addBusinessBuddy')) ?>";
		var user_id = $(this).attr("user_id");
		if(confirm("Are you sure want to follow this user?")) {
			$.ajax({
				url:url,
				type: 'POST',
				data: {user_id:user_id}
			}).done(function(result){
				if(result == 1) {
					alert("This user has been added to your following list successfully.");
					datas.parent().remove();
				} else {
					alert("There is some problem, please try again.");
				}
			});
		}
	});
});

$('#UserChatForm').validate({
	rules: {
		"message": {
			required: true
		}
	},
	messages: {
		"message": {
			required: "Please enter message."
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