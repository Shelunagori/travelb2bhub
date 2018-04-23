<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
?>
<style>
 
@media all and (max-width: 1000px) {
	/* Logo for Mobile */
	.tst{
		margin-top: 5px !important;
	 }
}
@media all and (min-width: 1000px) {
	/* Logo for Mobile */
	.tst{
		margin-top: -5px !important;
	 }
}
fieldset
{
	border-radius: 7px;
	box-shadow: 0 1px 9px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}
legend
{
	text-align: center;
}
.requestType {	
	color: #f87200;
    font-weight: 600;
}
.hotel{
	
}
.package{
	 
}
 p {
    color: #96989A !important;
    margin: 0 0 5px !important;
    line-height: 17px !important;
} 

.details {
    color: #000 !important;
    font-weight: 400;
}
.btn-block { width:40% !important;}
.margin {margin-top:5px;}
.shotrs a {margin:5px;;}
.modal-body {padding:2px!important;}
</style>
<div class="container-fluid" id="checkresponses">
    <div class="row equal_column"> 
		<div class="col-md-12" style="background-color:"> 
			  
		</div>
	</div>
	<div class="box box-primary">
		<div class="box-header with-border"> 
			<h3 class="box-title" style="padding:5px">Check Responses </h3>
			
			<div class="box-tools pull-right">
				<!--<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>-->
				<a style="font-size:22px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
			</div>
		</div>
		<div class="box-body">
			<?php 
				//pr($responses->toArray());
				foreach($responses as $ro){
				
					 $reference_id=$ro['request']['reference_id'];
					 $total_budget=$ro['request']['total_budget'];
					 $locality=$ro['request']['locality'];
					 $comment=$ro['request']['comment'];
					 $created=$ro['request']['created'];
					 $check_in=$ro['request']['check_in'];
					 $check_out=$ro['request']['check_out'];
					 $org_check_in=date('d-M-Y', strtotime($check_in));
					 $org_check_out=date('d-M-Y', strtotime($check_out));
					 $adult=$ro['request']['adult'];
					 $children=$ro['request']['children'];
					 $category_id=$ro['request']['category_id'];
					 $members=$adult+$children;
					 if($category_id==1){
						 $category_name="Package";
						 $image1=$this->Html->image('/img/slider/package-icon.png',['style'=>'height:20px']);
						 $text="<span class='packageType'>Package</span>";
						 $dest_show="Destination City";
					 }
					 if($category_id==2){
						 $category_name="Transport";
						 $image1=$this->Html->image('/img/slider/transport-icon.png');
						 $text="<span class='transportType'>Transport</span>";
						 $dest_show="Pickup City";
					 }
					 if($category_id==3){
						 $category_name="Hotel";
						 $image1=$this->Html->image('/img/slider/hotelier-icon.png');
						 $text="<span class='hotelType'>Hotel</span>";
						 $dest_show="Destination City";
					 }
				}
				$org_created=date('d-M-Y', strtotime($created));
				?>
			<fieldset>
				<legend><?php echo $image1; ?></legend>
				<p class="pull-right" style="margin-top:-30px !important;"> <?php echo $org_created; ?></p>
			<div class="col-md-12" style="padding-left:0px !important;">
			<div class="col-md-10" style="padding-left:0px !important;">
			<div class="col-md-12 " style="padding-left:0px !important;">
			 
				<div class="col-md-3" style="padding-left:0px !important;">
						<p>Request Type:   <?php echo $text; ?></p>
				</div>
				<div class="col-md-3" style="padding-left:0px !important;">
						<p>Reference ID:    <span class="details"><?php echo $reference_id; ?></span></p>
				</div>
				<div class="col-md-3" style="padding-left:0px !important;">
						<p>Start Date:   <span class="details"><?php echo $org_check_in; ?></span></p>
				</div>
				<div class="col-md-3" style="padding-left:0px !important;">
						<p>End Date:   <span class="details"><?php echo $org_check_out; ?></span></p>
				</div>
				 
			</div>
			<div class="col-md-12" style="padding-left:0px !important;">
				
				<div class="col-md-3" style="padding-left:0px !important;">
						<p>Total Budget:  <span class="details"><?php echo $total_budget; ?></span></p>
				</div>
				<div class="col-md-3" style="padding-left:0px !important;">
						<p>Members:  <span class="details"><?php echo $members; ?></span></p>
				</div>
				<div class="col-md-3" style="padding-left:0px !important;">
					<?php if($category_id==2){ ?>
						<p>Pickup City:  &nbsp;
							<span class="details">
								<?php echo ($ro['request']['pickup_city'])?$allCities[$ro['request']['pickup_city']]:"-- --"; ?>
								<?php echo ($ro['request']['pickup_state'])?' ('.$allStates[$ro['request']['pickup_state']].')':"";  ?>
							</span>
						</p>
					<?php }else{ ?>
						
						<p>Destination City:  &nbsp;
							<span class="details">
							<?php 
							$a=$ro['request']['city_id']?$allCities[$ro['request']['city_id']]:"-- --"; 
							$b=$ro['request']['state_id']?' ('.$allStates[$ro['request']['state_id']].')':"";
							echo mb_strimwidth($a.$b, 0,28, "...");?>
						 
							</span>
						</p>
						
					<?php } ?>
						
				</div>
				<div class="col-md-3" style="padding-left:0px !important;">
						<p>Comment:  <span class="details"><?php echo $comment; ?></span></p>
				</div>
				 
			</div>
			</div>
			<div class="col-md-2" align="center">
				<a  class="viewdetail btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'viewdetails',$responseid)) ?>"data-target="#myModal1<?php echo $responseid; ?>" data-toggle=modal> Details</a>
			</div>
			</div>
			<div class="col-md-12" align="center" >
				
			</div>
			
			</fieldset>
			 <br>
		<?php
		if(count($responses) >0) {
			foreach($responses as $row){
				if($row['request']['category_id']==1){ 
					$image=$this->Html->image('/img/slider/package-icon.png',['style'=>'height:20px']);
					$text="<span class='requestType'>Package</span>";
					
				} 
				if($row['request']['category_id']==2){
					$image= $this->Html->image('/img/slider/transport-icon.png');
					$text="<span class='requestType'>Transport</span>";
				}
				if($row['request']['category_id']==3){
					$image= $this->Html->image('/img/slider/hotelier-icon.png',['style'=>'height:30px']);
					$text="<span class='requestType'>Hotel</span>";
				} 
				
				$created=$row['created'];
				$org_created=date('d-M-Y', strtotime($created));
				
				?>
				<div class="col-md-12">
					<!--div class="col-md-2" style="width:9.666667%;">
						<?php //echo $image; ?> <br><?php //echo $text; ?>
					</div-->
					
					<div class="col-md-4">
 					<p>From: <span class="details">						
						<?php 
					$total_rating=0;
					$rate_count=0;
					$final_rating=0;
					$sql1="Select * from `testimonial` where `author_id`='".$row['user']['id']."' ";
					$stmt1 = $conn->execute($sql1);
					foreach($stmt1 as $bresul){
						$rate_count++;
						$rating=$bresul['rating'];
						$total_rating+=$rating;
					} 
					if($total_rating>0){
						@$final_rating=$total_rating/$rate_count;
					}
					?>
						<?php 
						if($row['response']['is_details_shared']==1){
								$hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$row['user']['id'],1));                    
						}
						else{
								$hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$row['user']['id'],1));                   
						}
						?>
						<a href="<?php echo $hrefurl; ?>"> <?php echo $row['user']['first_name']; ?>&nbsp;<?php echo $row['user']['last_name']; ?></a>
						<?php if($final_rating>0){ ?>
						<font color="#1295AB">(<?php echo round($final_rating); ?> <i class="fa fa-star"></i>)</font>
						<?php } ?>
						</span></p>
					</div>
					 
					<div class="col-md-2"  >
						<p>Quoted Price: <span class="details"><?php echo ($row['quotation_price'])?"&#8377; ".$row['quotation_price']:"-- --" ?></span></p> 
					</div>
					<div class="col-md-6" align="left">
		 
			<a class="btn btn-warning btn-sm tst" id="chatcounts_<?php echo $row['id'];?>" data-toggle="modal" data-target="#myModal11<?php echo  $row['request']['id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'userChat', $row['request']['id'], $row["user_id"],1)) ?>"> 
			Chat ( <strong><?php echo $data['chat_count'][$row['id']]; ?> </strong> )</a>
			<div class="modal fade" id="myModal11<?php echo  $row['request']['id']; ?>" role="dialog">
				<div class="modal-dialog">
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
			 
				<!---button Share --->
			<?php if($row['is_details_shared'] != 1) { ?>
				<!--a style="padding:5px !important;margin-top:3px;" href="javascript:void(0);" user_id="<?php echo $row['user']['id']; ?>" class="shareDetails btn btn-info btn-xs " request_id = "<?php echo $row['request']['id']; ?>" response_id = "<?php echo $row['id']; ?>">
						Share Details</a-->
						
						<a   data-toggle="modal" class="btn btn-info btn-sm tst" data-target="#share<?php echo $row['id']; ?>" > Share Details </a>
							<!-------Contact Details Modal --------->
							<div id="share<?php echo $row['id']; ?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-md" >
									<!-- Modal content-->
										<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">
														<font color="black">Are you sure you want to share your details with this user?</font>
													</h4>
												</div>
												<div class="modal-footer">
													<button type="button"  href="javascript:void(0);" class="shareDetails btn btn-info" request_id = "<?php echo $row['request']['id']; ?>" user_id="<?php echo $row['user']['id']; ?>" response_id = "<?php echo $row['id']; ?>" >Shared</button>
													<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
												</div>
											</div>
										</div>
									</div>
				<?php }
				else{
					?>
						<span style="background-color:#dadadabf;display: inline-block;text-align: center;border-radius: 6px;    vertical-align: middle;"  class=" btn-defult btn-sm tst">Detail Shared </span> 
					<?php 
				} ?>
				 
				<!---button Follow--->
				<?php
				if( !array_key_exists($row['user']['id'], $BusinessBuddies)) {?>
						<!--a style="padding:5px !important;margin-top:3px;;" href="javascript:void(0);" class="businessBuddy btn btn-successto btn-xs "   user_id = "<?php echo $row['user']['id']; ?>"> Follow</a-->
						
						<a  data-toggle="modal" class="btn btn-successto btn-sm tst" data-target="#follow<?php echo $row['id']; ?>" > Follow User </a>
							<!-------Contact Details Modal --------->
							<div id="follow<?php echo $row['id']; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<!-- Modal content-->
								<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">
												<font color="black">Are you sure you want to follow this user?</font>
											</h4>
										</div>
										<div class="modal-footer">
											<button type="button"  href="javascript:void(0);" class="businessBuddy btn btn-successto" user_id = "<?php echo $row['user']['id']; ?>" >Follow</button>
											<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
										</div>
									</div>
								</div>
							</div>
									
				<?php }
				else {
				?>
					<span style="background-color:#dadadabf;display: inline-block;text-align: center;border-radius: 6px;    vertical-align: middle;"  class=" btn-defult btn-sm tst"> Following </span> 
				<?php }	?>
			 
			
				<!---button Block--->
				<?php
					$sql="Select count(*) as block_count from blocked_users where blocked_user_id='".$row['user']['id']."' AND blocked_by='".$row['request']['user_id']."'";
					$stmt = $conn->execute($sql);
					$bresult = $stmt ->fetch('assoc'); 
					if($bresult['block_count']>0){
						$blocked = 1;
					}
					else{
						$blocked = 0;
					}
					?>	
					
					<!---button Accept Offer--->
							<!--a  href="javascript:void(0);" class="acceptOffer btn btn-success btn-xs " request_id = "<?php //echo $row['request']['id']; ?>" response_id = "<?php //echo $row['id']; ?>">
								Accept Offer</a> -->
								
						<?php $reviewi =  $row['user']['id']."-".$row['request']['id']; ?>
						
							<a   data-toggle="modal" class="btn btn-success btn-sm tst" data-target="#accept<?php echo $row['id']; ?>"  > Accept Offer </a>
							<!-------Contact Details Modal --------->
							<div id="accept<?php echo $row['id']; ?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-md" >
									<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h3 class="modal-title">
													<h4><font color="black">Are you sure you want to Accept Offer ?</font></h4>
												</h3>
											</div>
												<div class="modal-footer">
													<button type="button"  href="javascript:void(0);" class="acceptOffer btn btn-info "request_id = "<?php echo $row['request']['id']; ?>" response_id = "<?php echo $row['id']; ?>">Accept</button>
													<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
												</div>
											</div>
										</div>
									</div>
							 
						 
						<?php 
							if($blocked==1)
							{?>
								<a  href="javascript:void(0);" class="unblockUser btn btn-danger btn-sm tst" user_id = "<?php echo $row['user']['id']; ?>">
								Blocked </a>
							<?php }
							else
							{?>
								<!--a  href="javascript:void(0);" class="blockUser btn btn-danger btn-xs " user_id = "<?php echo $row['id']; ?>">
								Block User </a-->
							
							<a   data-toggle="modal" class="btn btn-danger btn-sm tst" data-target="#block<?php echo $row['id']; ?>"  > Block User </a>
							<!-------Contact Details Modal --------->
							<div id="block<?php echo $row['id']; ?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-md" >
									<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h3 class="modal-title">
													<h4><font color="black">Are you sure you want to block this user ?</font></h4>
												</h3>
											</div>
												<div class="modal-footer">
													<button type="button"  href="javascript:void(0);" class="blockUser btn btn-danger" user_id = "<?php echo $row['user']['id']; ?>">Block</button>
													<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
												</div>
											</div>
										</div>
									</div>
							<?php } ?>
						<!---button Details--->
						
					 
					</div>
				</div>
				<br>
				<br>
				<hr>
			<?php 
			}
		}
		else {
			?>
			<div class="row">
				<div class="col-md-12">
					<?php if(isset($_GET['req_typesearch'])){ echo "No matching data.";}else{ echo "There are no responses in mailbox.";}?>
				</div>
			</div>
		<?php }
		?>
		</div>
	</div>
</div>
						
<!--------------END LAYOUT-------------->
<div id="myModal123" class="modal fade form-modal" role="dialog" style="display:none;">
	<div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Sorting</h4>
	</div>
	<div class="modal-body" align="center"> 
		<table width="90%" class="shotrs">
			<tr>
				<td>
				<a class="btn btn-info btn-xs"href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=totalbudgethl">Total Budget (High To Low) <span class="arrow"></span></a>

				<a class="btn btn-info btn-xs" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=totalbudgetlh"> Total Budget (Low To High)<span class="arrow"></span></a>
				
				<a class="btn btn-info btn-xs" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=quotedpricehl">Quoted Price (High To Low) <span class="arrow"></span></a>
				
				<a class="btn btn-info btn-xs" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=quotedpricelh"> Quoted Price (Low To High)<span class="arrow"></span></a>
				
				<a class="btn btn-info btn-xs" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=chatshl">Chats (High To Low) <span class="arrow"></span></a>
				
				<a class="btn btn-info btn-xs" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=chatslh"> Chats (Low To High)<span class="arrow"></span></a>
				
				<a class="btn btn-info btn-xs" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=chatslh"> Chats (Low To High)<span class="arrow"></span></a>
				
				<a class="btn btn-info btn-xs" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=chatslh"> Chats (Low To High)<span class="arrow"></span></a>
				
				<a class="btn btn-info btn-xs" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=agentaz"> Agent Name (A To Z) <span class="arrow"></span></a>
				
				<a class="btn btn-info btn-xs" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=agentza"> Agent Name (Z To A)<span class="arrow"></span></a>
			</td>
		</tr>
	</table>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</div>
	</div>
	</div>
</div>
	
<div class="fade modal form-modal" id="myModal122" role="dialog">
	  <div class="modal-dialog "  >
		 <div class=modal-content>
			<div class=modal-header>
			   <button class="close" data-dismiss="modal" type="button">&times;</button>
			   <h4 class=modal-title>Filter</h4>
			</div>
			<form class="filter_box" method="get">
				<div class="modal-body">
					<div class="col-md-12">
					   <div class="col-md-12">
						<label for="example-text-input" class=" col-form-label">Agent Name: </label> 
						    
						   <select name="agentname[]" multiple class="form-control select2" data-placeholder='Select Agent Name'>
						   
						   <?php if(!empty($UserResponse)){ 
								foreach($UserResponse as $user){
						   ?>
							<option <?php echo (isset($_GET['agentname']) && $_GET['agentname'] ==$user['user']['id'])? 'selected':''; ?> value="<?php echo $user['user']['id']?>">
								<?php echo $user['user']['first_name'].' '.$user['user']['last_name']?>
							</option>
						   <?php }}?>
						   </select>
					   </div>
					</div>
					
					
					 <div class="col-md-12">
					   <div class="col-md-12">
						 <label for="example-text-input" class=" col-form-label">Select Chat With: </label>
						   <select name="chatwith[]" class="form-control select2" multiple data-placeholder='Select Chat With'>
						   <?php if(!empty($UserResponse)){ 
								foreach($UserResponse as $user){               
						   ?>
						   <option <?php echo (isset($_GET['chatwith']) && $_GET['chatwith'] ==$user['user']['id'])? 'selected':''; ?> value="<?php echo $user['user']['id']?>"><?php echo $user['user']['first_name'].' '.$user['user']['last_name']?></option>
						   <?php }}?>
						   </select>
						</div>
					</div>
					 
					<!--div class="col-md-12">
					  
					   <div class="col-md-12"> 
						 <label for="example-text-input" class=" col-form-label">Reference ID: </label>
						   <input type="text" name="refidsearch" value="<?php echo isset($_GET['refidsearch'])? $_GET['refidsearch']:''; ?>"  class="form-control">
					  </div>
					</div>
						   
						   
					<div class="col-md-12">
					   
					   <div class="col-md-12">
						<label for="example-text-input" class=" col-form-label">Budget: </label> 
						   <select name="budgetsearch" class="form-control"><option value="">Select Budget</option><option value="0-10000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="0-10000")? 'selected':''; ?>>0-10000</option><option value="10000-30000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="10000-30000")? 'selected':''; ?>>10000-30000</option><option value="30000-50000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="30000-50000")? 'selected':''; ?>>30000-50000</option><option value="50000-100000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="50000-100000")? 'selected':''; ?>>50000-100000</option></select>
					   </div>
					</div-->
						   
						   
					<div class="col-md-12">
					   
					   <div class="col-md-12">
						<label for="example-text-input" class=" col-form-label">Quoted Price Range: </label>
						   <select name="quotesearch" class="form-control"><option value="">Select Quoted Price</option><option value="0-10000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="0-10000")? 'selected':''; ?>>0-10000</option><option value="10000-30000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="10000-30000")? 'selected':''; ?>>10000-30000</option><option value="30000-50000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="30000-50000")? 'selected':''; ?>>30000- 50000</option><option value="50000-100000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="50000-100000")? 'selected':''; ?>>50000-100000</option></select>
						</div>
					</div>
					
					 
					<div class="col-md-12">
					   
					   <div class="col-md-12">
							<label for="example-text-input" class=" col-form-label">Following: </label> 
						   <input type="checkbox" name="followsearch" value="1" <?php echo isset($_GET['followsearch'])? "checked":''; ?>  >
					   </div>
				   </div>
					<div class="col-md-12">
					   
					   <div class="col-md-12">
						<label for="example-text-input" class=" col-form-label">Shared Details: </label>
						   <input type="checkbox" name="shared_details" value="1" <?php echo isset($_GET['shared_details'])? "checked":''; ?>  >
					   </div>
				   </div>                           
				</div>
				<div class="modal-footer">
					<button type="submit" name="submit" value="Submit"  class="btn btn-primary btn-submit">Filter</button>
					<a class="btn btn-primary btn-submit" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'checkresponses',$responseid)) ?>">Reset</a>
				</div>
			 </form>
		 </div>
	  </div>
   </div>
</div>
		 
<div class="modal fade" id="myModal2" role="dialog">
	<div class="modal-dialog">
	
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Rating</h4>
		</div>
		<div class="modal-body">
			<div class="form text-center">
				<?php  echo $this->Form->create("Users", ['type' => 'file', 'url' => ['controller' => 'Users', 'action' => 'rateUser'],'onSubmit' => 'return UserRatingForm();', 'id'=>"UserRatingForm"]); ?>
				<input type="hidden" name="rating_request_id" id="rating_request_id">
				<input type="hidden" name="rating_user_id" id="rating_user_id">
				<h2>Select Rating</h2>
				<fieldset id='demo1' class="rating">
					<input class="stars" type="radio" id="star5" name="rating" value="5" />
					<label class = "full" for="star5" title="Awesome - 5 stars"></label>
					<input class="stars" type="radio" id="star4" name="rating" value="4" />
					<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
					<input class="stars" type="radio" id="star3" name="rating" value="3" />
					<label class = "full" for="star3" title="Meh - 3 stars"></label>
					<input class="stars" type="radio" id="star2" name="rating" value="2" />
					<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
					<input class="stars" type="radio" id="star1" name="rating" value="1" />
					<label class = "full" for="star1" title="Sucks big time - 1 star"></label>

				</fieldset>
				<div style='clear:both;'></div>
				<!-- <div class="margi1">
					<input type="submit" name="submit" class="btn btn-primary btn-block " value="Submit">
				</div> -->
				</form>
			</div>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div>
	</div>
</div>
<div class="fade modal"id="myModal1<?php echo $responseid; ?>"role=dialog>
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
<?php if(isset($_GET['sort']) && $_GET['sort']=="chatslh") { ?>
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

<?php if(isset($_GET['sort']) && $_GET['sort']=="chatshl") { ?>
<script>
$(document).ready(function(){

$(".req").sort(function (a, b) {
    return parseInt(a.id) < parseInt(b.id);
}).each(function () {
    var elem = $(this);
    elem.remove();
    $(elem).appendTo("#cat");
});

   })
</script>
<?php } ?>

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
				var url1 = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>";
				
				window.location.href = url1;
			}else if(result == 2){
			 
			} else {
				alert("There is some problem, please try again.");
			}
		});
	});
	
	$(".businessBuddy").click(function (e) {
		e.preventDefault();
		var __this = $(this);
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
	
	$(".acceptOffer").click(function (e) {
		e.preventDefault();
		var __this = $(this);
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'acceptOffer')) ?>";
		var request_id = $(this).attr("request_id");
		var response_id = $(this).attr("response_id");
			$.ajax({
				url:url,
				type: 'POST',
				data: {request_id:request_id, response_id:response_id}
			}).done(function(result){
				if(result == 1) {
					 
					$('#add_review').click();
					var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>";
					 window.location.href=url;
				} else {
					alert("There is some problem, please try again.");
				}
			});
	});
	$(".shareDetails").click(function (e) {
		e.preventDefault();
		var __this = $(this);
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'shareDetails')) ?>";
		var request_id = $(this).attr("request_id");
		var response_id = $(this).attr("response_id");
		var user_id = $(this).attr("user_id");
			$.ajax({
				url:url,
				type: 'POST',
				data: {request_id:request_id, response_id:response_id,user_id:user_id}
			}).done(function(result){
				if(result == 1) {
					 location.reload();
				} else {
					alert("There is some problem, please try again.");
				}
			});
	});
});
</script>
<script>
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
$('#addtestimonial').validate({
	rules: {
		"rating":  {
			required:  true
		}
	},
	messages: {
		"rating":  {
			required:  "Please select rating."
		}
	}
});
function f1(res){
	var result = res.split(",");
	$('#chat_request_id').val(result[0]);
	$('#chat_user_id').val(result[1]);
}
</script>


<script>
// Rating
$(document).ready(function () {
	$("#demo1 .stars").click(function (e) {
		e.preventDefault();
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'rateUser')) ?>";
		var rating = $(this).val();
		var request_id = $("#rating_request_id").val();
		var user_id = $("#rating_user_id").val();
		if(confirm("Are you sure want to rate this user?")) {
			$.ajax({
				url:url,
				type: 'POST',
				data: {request_id:request_id, user_id:user_id, rating:rating}
			}).done(function(result){
				if(result == 1) {
					alert("Thank you for rating.");
					location.reload();
				} else {
					alert("There is some problem, please try again.");
				}
			});
		}
	});
	
	getcheckresponselists(5000);
	function getcheckresponselists(){
		var requestid = "<?php echo $responseid;?>";
	var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'getcheckresponselists')) ?>";
	$.ajax({ url:url,
			 type: 'POST',
			 data: {request_id:requestid}
			}).done(function(result){
		var object = JSON.parse(result);
		$.each(object, function(index, value) {
			var chres_id = "#chatcounts_"+index;
			if(value>0)
			{
			var res_html = ' Chat ( <strong>'+value+'</strong> )';
			$(chres_id).html(res_html);	
			}
			
			});
		});
    setTimeout(getcheckresponselists, 5000);
		}
		
		
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
				var url1 = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>";
				
				window.location.href = url1;
			} else {
				alert("There is some problem, please try again.");
			}
		});
	});
	
});
$('#UserRatingForm').validate({
	rules: {
		"rating":  {
			required:  true
		}
	},
	messages: {
		"rating":  {
			required:  "Please select rating."
		}
	},
	ignore: ":hidden:not(select)"
});


function UserRatingForm() {
    var radios = document.getElementsByName("rating");
    var formValid = false;

    var i = 0;
    while (!formValid && i < radios.length) {
        if (radios[i].checked) formValid = true;
        i++;        
    }

    if (!formValid) alert("Please Select Rating!");
    return formValid;
}	

function f2(res){
	var result = res.split(",");
	$('#rating_request_id').val(result[0]);
	$('#rating_user_id').val(result[1]);
}
</script>