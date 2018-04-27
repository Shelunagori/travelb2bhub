 <?php echo $this->Html->script(['jquery.validate']);?>
 <?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
?>
<style>
	legend {
		text-align:center !important;
	}
	fieldset
	{
		border-radius: 7px;
		box-shadow: 0 3px 9px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
	}
	.details {color:#000 !important; font-weight: 400;}	
	li > p{
		color:#96989A !important;
		margin: 0 0 5px !important;
		line-height:17px !important; 
	}
	.col-form-label{
		margin-top: 4px;
		font-weight:100 !important;
	}
</style>
<div id="my_final_responses" class="container-fluid">
	<div class="row equal_column">
		<div class="col-md-12" style="background-color:"> 
 			<?php echo  $this->Flash->render() ?>
		</div>
	</div>
<div class="box box-primary">
	<div class="row">
		<div class="col-md-12">
			<div class="box-header with-border"> 
				<h3 class="box-title" style="padding:5px">Respond To Request</h3>
				<div class="box-tools pull-right">
					<!--<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>-->
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
						<div class="col-md-6">
							<div>
								<label for="example-text-input" class="  col-form-label">Agent Name:  </label>
							</div> 
							<div>
								<?php echo $this->Form->control('agentnamesearch', ['label'=>false,"type"=>"select",'options' =>$selectoption,"class"=>"form-control select2","data-placeholder"=>"Select Multiple ",'empty'=>'Select...','multiple'=>true]);?>
							</div>
						</div>
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
									<option value="1" >Package</option>
									<option value="3" >Hotel</option>
									<option value="2">Transport</option>
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
						
						<div class=col-md-6><br>
							<div >
								<input class="input-checkbox100" type="checkbox" value="1" name="followsearch">
								<label class="col-form-label label-checkbox100" for="ckb1">
									Following
								</label>
							</div>
						</div>                         
					</div>
					
					<div class="col-md-12 text-center">
						<hr></hr>
						<a class="btn btn-danger btn-sm" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'respondtorequest')) ?>">Reset</a>
						<button class="btn btn-info btn-sm" name="submit" value="Submit" type="submit">Apply</button> 
					</div>
				</fieldset>
			</form>
		</div>
<div class="row">
	<div class="col-md-12">
		<div id="myModal123" class="modal fade form-modal" role="dialog">
			<div class="modal-dialog" style=" width: 22%;">
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
	 
 
       <?php 
	  // pr($requests);
		if(count($requests) > 0) {
			$m =0;
			foreach($requests as $request){
				$id=$request['id'];
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
				
				$totmem = $request['adult'] +   $request['children']; 
				if(isset($_GET['memberssearch'])  && $_GET['memberssearch']!="" && $_GET['memberssearch'] !=$totmem ){
					continue;
				}
				if(isset($_GET['followsearch']) && $_GET['followsearch']==1 && !in_array($request['user_id'],$BusinessBuddies)) {
					continue;
				}
				$blockuser_class= "";
				if($data['blockedUser'][$request['id']]==1 OR  $resdata['responsecount'][$request['id']]>=20) { 

				}
				else{
					if($m%3==0) {
						echo ' <div class="clearfix"></div>'; 
					}
				$m++;
			// echo $resdata['responsecount'][$request['id']];
			$created=$request['created'];
			$org_created=date('d-M-Y', strtotime($created));
			?>
			<div class="col-md-4" style="padding-top:15px;">
			<form method="post" class="filter_box">
				<fieldset>
				<legend><?php echo @$image; ?></legend>
				<span style="margin-top:-30px;float:right;"><?php echo $org_created; ?></span>
				<div class="contain">
                 <ul>
					<li class="">
						<p>
							<?php 
								$total_rating=0;
								$rate_count=0;
								$final_rating=0;
								$sql1="Select * from `testimonial` where `user_id`='".$request['user']['id']."' ";
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
					
							Form:  <span class="details"><a href="viewprofile/<?php echo $request['user_id']; ?>"><?php echo $request['user']['first_name']; ?>&nbsp;&nbsp;<?php echo $request['user']['last_name']; ?></a>
							 <?php if($final_rating>0){ ?>
							 <font color="#1295AB">(<?php echo round($final_rating); ?> <i class="fa fa-star"></i>)</font>
							 <?php } ?>
							<?php if(in_array($request['user_id'],$BusinessBuddies)) {  
							//echo $this->Html->image('friend-ico1.png', [ "height"=>20]);
							} ?>
						</p>
					</li>
					<li class="">
						<p>
							Request Type:   <?php echo $text; ?>
						</p>
					</li>
					<li class="">
					<?php 
						$total_budget=round($request['total_budget']);
					
					?>
						<p>
							Total Budget:   <span class="details">&#8377; 
							<?php echo ($total_budget)? "". ($total_budget): "-- --" ?>
						</p>
					</li>
					<li class="">
						<p>
							Reference ID:   <span class="details"><?php echo ($request['reference_id'])? "". $request['reference_id']: "-- --" ?>
						</p>
					</li>
					
					<li class="">
					<?php if($request['category_id']==2){ ?>
						<p>
							Pickup City:  <span class="details"><?php echo ($request['pickup_city'])?$allCities[$request['pickup_city']]:"-- --"; ?><?php echo ($request['pickup_state'])?' ('.$allStates[$request['pickup_state']].')':"";  ?>
						<?php } else { ?>
						<p>
							Destination City:  <span class="details">
							<?php 
							$a=$request['city_id']?$allCities[$request['city_id']]:"-- --"; 
							$b=$request['state_id']?' ('.$allStates[$request['state_id']].')':"";
							echo mb_strimwidth($a.$b, 0,28, "...");?>
						</p>
					<?php } ?>
					</li>
					   <?php if($request['category_id'] == 3 ) { ?>
						<li class="">
                            <p>
                                Start Date:  <span class="details"><?php echo ($request['check_in'])?date('d/m/Y',strtotime($request['check_in'])):"-- --"; ?>
                            </p>
                        </li>
						<li class="">
                            <p>
                                End Date:  <span class="details"> <?php echo ($request['check_out'])?date('d/m/Y',strtotime($request['check_out'])):"-- --"; ?>
                            </p>
                       </li>
					<?php } elseif($request['category_id'] == 1 ) { 
					$sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$request['id']."'";
						$stmt = $conn->execute($sql);
						$result = $stmt->fetch('assoc');					
					?>
						<li class="">
                            <p>
                                Start Date: <span class="details"><?php echo ($request['check_in'])?date('d/m/Y',strtotime($request['check_in'])):"-- --"; ?>
                            </p>
                         </li>
						<li class="">
                        <p>
							<?php if(!empty($result['TopDate'])) { ?>
                        End Date:   <span class="details"><?php echo date('d/m/Y',strtotime($result['TopDate'])); ?>
                        <?php }else{?>
                            End Date:  <span class="details"> <?php echo ($request['check_out'])?date('d/m/Y',strtotime($request['check_out'])):"-- --"; ?>
                            <?php } ?>
                        </p>
                        </li>
					<?php } elseif($request['category_id'] == 2 ) {?>
					<li class="">
                            <p>
                                Start Date:  <span class="details"><?php echo ($request['start_date'])?date('d/m/Y',strtotime($request['start_date'])):"-- --"; ?>
                            </p>
                        </li>
						<li class="">
                            <p>
                                End Date:  <span class="details"><?php echo ($request['end_date'])?date('d/m/Y',strtotime($request['end_date'])):"-- --"; ?>
                            </p>
                        </li>
					<?php } ?>
					<li class="">
                            <p>
                                Members:  <span class="details"><?php echo $request['adult'] + $request['children']; ?>
                           </p>
                   </li>
                <li class=" ">
                     <p>Comment:  <span class="details"><span> 
					 <?php echo mb_strimwidth($request['comment'], 0, 25, "...");?></span></p>
                 </li>
                </ul>
			</div>
				<hr></hr>	  
		 <table width="100%" border="0">
			<tr>
				<td width="50%" style="padding:3px !important;">
				<?php if($users['role_id'] == 3 || $users['role_id'] == 1){
				if(count($request["responses"]) < 20) {?>
				<a style="width:99%" data-toggle="modal" class="btn btn-success btn-sm" data-target="#myModalshow<?php echo $request['id']; ?>" href="javascript:void(0);" onclick="f1('<?php echo $request['id']; ?>');" id="<?php echo $request['id']; ?>"> Show interest</a>
				<?php } } ?>
			 
				<div id="myModalshow<?php echo $request['id']; ?>" class="modal fade form-modal" role="dialog">
				  <div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Show Interest</h4>
					  </div>
					  <?php  echo $this->Form->create("Users", ['type' => 'file', 'url' => ['controller' => 'Users', 'action' => 'addresponse'], 'id'=>"UserResponseForm"]); ?>
					  <div class="modal-body" align="center">   
						
						<input type="hidden" name="request_id" class="request_id" id="request_id" value=""/><br>
						<table width="90%" class="shotrs">
							<tr>
								<td >
									<label class="form-control" style="margin-top:-24px;border: 0px solid !important;">
										Quote price
									</label>
								 </td>
								 <td>
									  <input type="text" class="form-control" id="quotation_price" name="quotation_price" placeholder="Quote your price" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"/><br>
								 </td>
							</tr>
							<tr>
								<td>.
									<label class="form-control" style="margin-top:-30px;border: 0px solid !important;">
										Comment
									</label>
								 </td>
								 <td>
									  <textarea name="comment" class="form-control" id="comment" placeholder="Enter comment here" col="10" row="10"></textarea>
								 </td>
							</tr>
						</table>
					  </div>
					  <div class="modal-footer">
						 <div style="float:right">
							<input type="submit" name="submit" class="btn btn-info btn-sm" width="20px" style="width:70px !important;" value="Submit">
						 </div>
					  </div>
					</div>
				  </div>
				</div>	
			</td>
			<td width="50%" style="padding:3px !important;"> 
				<a style="width:99%" data-toggle="modal" class="btn btn-info btn-sm"  data-target="#myModal1<?php echo $request['id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'viewdetails',$request['id'])) ?>"> Details</a>
			 
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
			</td>
			</tr>
			</table>
			 <table width="100%" border="0">
				<tr>
					<td width="50%" style="padding:3px !important;">
						<?php
						if(array_key_exists($request["user_id"], $BusinessBuddies)) {?>
							 
							<span style=" width:99%;background-color:#dadadabf;display: inline-block;text-align: center;"  class=" btn-defult btn-sm ">
										Following </span>
						<?php } 
						else{ ?>
							 
							<a style="width:99%" data-toggle="modal" class="btn btn-warning btn-sm" data-target="#follow<?php echo $id; ?>" > Follow User </a>
							<!-------Contact Details Modal --------->
							<div id="follow<?php echo $id; ?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-md" >
									<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">
													<font color="black">Are you sure you want to follow the user?</font>
												</h4>
											</div>
												 
												<div class="modal-footer">
												<button type="button"  href="javascript:void(0);" class="businessBuddy btn btn-warning" user_id = "<?php echo $request["user_id"]; ?>" >Follow</button>
												<button type="button" class="btn btn-successto" data-dismiss="modal">Cancel</button>
												</div>
											</div>
										</div>
									</div>
							
							<?php 
						}
						?>
					</td>
					<?php
					$sql="Select count(*) as block_count from blocked_users where blocked_user_id='".$request['user']['id']."' AND blocked_by='".$request['user_id']."'";
					$stmt = $conn->execute($sql);
					$bresult = $stmt ->fetch('assoc'); 
					if($bresult['block_count']>0){
						$blocked = 1;
					}
					else{
						$blocked = 0;
					}
					?>
					<td style="padding:3px !important;" width="50%" >
					<?php 
							if($blocked==1)
							{?>
								<a  style="width:99%" href="javascript:void(0);" class="unblockUser btn btn-danger btn-sm " user_id = "<?php echo $request['user']['id']; ?>">
								Blocked </a>
							<?php }
							else
							{?>
								  
								<a style="width:99%" data-toggle="modal" class="btn btn-danger btn-sm" data-target="#block<?php echo $id; ?>"  > Block User </a>
							<!-------Contact Details Modal --------->
							<div id="block<?php echo $id; ?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-md" >
									<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">
													<h4><font color="black">Are you sure you want to block this user?</font></h4>
												</h4>
											</div>
												<div class="modal-footer">
													<button type="button"  href="javascript:void(0);" class="blockUser btn btn-danger" user_id = "<?php echo $request['user']['id']; ?>">Block</button>
													<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
												</div>
											</div>
										</div>
									</div>
									
							<?php } ?>
					</td>
				</tr>
			</table>	
		</fieldset>
		</form>
		</div>
	 
							<?php  } } ?>
							<div class="pages"></div>
						<?php }
						else { ?>
							<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
								<div class="col-md-12 text-center  ">
									You have not received any requests
								</div>
							</div>
						<?php } ?>
					  </div>
					</div>
				</div>
			</div>
		</div>
<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
<div id="loader"></div>
</div>
 
<script>
$(document).ready(function () {
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
				jQuery(".filter_box").submit(function(){
					jQuery("#loader-1").show();
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
					 
				}
			});
		 
	});
	
	$('.datepicker').datepicker();
});
	$("#responsesWrap").apPagination({
		targets: ".box-event",
		pagesWrap: ".pages",
		ulClass: "pagination",
		perPage: 5,
		nextText: '<i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-right"></i>',
		prevText: '<i class="glyphicon glyphicon-menu-left"></i><i class="glyphicon glyphicon-menu-left"></i>'
	});
$('#UserResponseForm').validate({
	rules: {
		"quotation_price": {
			required: true,
			digits: true
		},
		"comment": {
			required: true
		}
	},
	messages: {
		"quotation_price": {
			required: "Please enter number in quote price.",
			digits: "Please enter valid quote price."
		},
	"comment": {
			required: "Please enter comment."
		}
	},
	ignore: ":hidden:not(select)"
});
function f1(val){
	$('.request_id').val(val);
}
</script>