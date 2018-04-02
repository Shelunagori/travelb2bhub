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
} 
.details {color:#000 !important; font-weight: 400;}	
.btn-block { width:40% !important;}
.margin {margin-top:5px;}
.shotrs a {margin:5px;;}
.modal-body {padding:2px!important;}
</style>
<div class="container-fluid" id="checkresponses">
    <div class="row equal_column"> 
		<div class="col-md-12" style="background-color:"> 
			<br>
			<?php echo $this->element('subheader');?>
		</div>
	</div>
<div class="box box-primary">
<div class="box-header with-border"> 
	<h3 class="box-title" style="padding:5px">Check Responses</h3>
	<div class="box-tools pull-right">
		<!--<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>-->
		<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
	</div>
</div>
<div class="box-body">
<div id="cat" >
  <div class="row" >
	<div class="col-md-12" >
		<!--<a data-toggle="modal" data-target="#detailModal" href="#" class="btn btn-success btn-xs">Details</a>-->
		
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
		<?php 
		if(count($responses) >0) {
			foreach($responses as $row){ ?>
            <?php if(isset($_GET['sort']) && $_GET['sort']=="requesttype")
			{ ?>
				<div  id="<?php if($row['request']['category_id']==1){ echo "1";} if($row['request']['category_id']==2){ echo "3";}if($row['request']['category_id']==3){ echo "2";} ?>">
			<?php } 
			else 
			{ ?>
				<div class="col-md-12" id="<?php echo $data['chat_count'][$row['id']]; ?>">
		<?php }
				if($row['request']['category_id']==1){ 
					$image=$this->Html->image('/img/slider/package-icon.png');
					$text="<span class='requestType'>Package</span>";
				} 
				if($row['request']['category_id']==2){
					$image= $this->Html->image('/img/slider/transport-icon.png');
					$text="<span class='requestType'>Transport</span>";
				}
				if($row['request']['category_id']==3){
					$image= $this->Html->image('/img/slider/hotelier-icon.png');
					$text="<span class='requestType'>Hotel</span>";
				} 
				
				$created=$row['created'];
				$org_created=date('d-M-Y', strtotime($created));
				?>
		<div class="col-md-2">
		<b>Request Type :</b> <?php echo $text; ?>
		</div>
		<div class="col-md-2">
		<b>Total Budget :</b> <?php echo $row['request']['total_budget']; ?>
		</div>
		<div class="col-md-3">
		<b>Agent Name :</b>

			<?php if($row['response']['is_details_shared']==1){
								$hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$row['user']['id'],1));                    
                        }else{
								$hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$row['user']['id'],1));                   
                        }?>
						<a href="<?php echo $hrefurl; ?>"> <?php echo $row['user']['first_name']; ?>&nbsp;<?php echo $row['user']['last_name']; ?></a>
		</div>
		<div class="col-md-2">
		<b>Quoted Price :</b> <?php echo ($row['quotation_price'])?"&#8377; ".$row['quotation_price']:"-- --" ?>
		</div>
		<div class="col-md-3">
		<ul>
		<li>
									<!---button Chat --->
									<a class="btn btn-warning btn-xs " id="chatcounts_<?php echo $row['id'];?>" data-toggle="modal" data-target="#myModal11<?php echo  $row['request']['id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'userChat', $row['request']['id'], $row["user_id"],1)) ?>"> 
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
											<a  href="javascript:void(0);" user_id="<?php echo $row['user']['id']; ?>" class="shareDetails btn btn-info btn-xs " request_id = "<?php echo $row['request']['id']; ?>" response_id = "<?php echo $row['id']; ?>">
												Share Details</a>
								 
											<?php }
											else{
												?>
													<a  href="javascript:void(0);" class=" btn btn-info btn-xs ">
													Shared</a>
												 
												<?php 
											}	?>
										<!---button Follow--->
											<?php
												if( !array_key_exists($row['user']['id'], $BusinessBuddies)) {?>
													<a href="javascript:void(0);" class="businessBuddy btn btn-xs " style="background-color:#1295A2;color:#FFF;" user_id = "<?php echo $row['user']['id']; ?>"> Follow</a>
											<?php }
												else{
												?>
													<a  href="javascript:void(0);" class="btn btn-xs " style="background-color:#1295A2;color:#FFF; user_id = "<?php echo $row['user']['id']; ?>"> Following</a>
																	<?php	}	?>
												</li>
											<li style="margin-top:5px;">
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
													<?php 
													if($blocked==1)
													{?>
														<a  href="javascript:void(0);" class="unblockUser btn btn-danger btn-xs " user_id = "<?php echo $row['user']['id']; ?>">
														Blocked </a>
													<?php }
													else
													{?>
														<a  href="javascript:void(0);" class="blockUser btn btn-danger btn-xs " user_id = "<?php echo $row['user']['id']; ?>">
														Block User </a>
													<?php } ?>
													<!---button Accept Offer--->
															<a  href="javascript:void(0);" class="acceptOffer btn btn-success btn-xs " request_id = "<?php echo $row['request']['id']; ?>" response_id = "<?php echo $row['id']; ?>">
																Accept Offer</a>
																
														<?php $reviewi =  $row['user']['id']."-".$row['request']['id']; ?>
															<a data-toggle="modal" class="btn btn-info btn-xs" style="display:none;" data-target="#myModal_accept<?php echo $row['id']; ?>" id="add_review" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'addtestimonial',  $reviewi)) ?>">
														Test</a>
														<div class="modal fade" id="myModal_accept<?php echo $row['id']; ?>" role="dialog">
															<div class="modal-dialog">
															  <div class="modal-content">
																<div class="modal-header">
																  <button type="button" class="close" data-dismiss="modal">&times;</button>
																  <h4 class="modal-title">Add Review</h4>
																</div>
																<div class="modal-body">
																</div>
															  </div>
															</div>
														</div>
														<!---button Details--->
														<a  class="viewdetail btn btn-success btn-xs" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'viewdetails',$responseid)) ?>"data-target="#myModal1<?php echo $responseid; ?>" data-toggle=modal> Details</a>
														</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
									</div>
								<?php } 
								
								else 
								{?>
									<div class="row">
										<div class="col-md-12">
											<?php if(isset($_GET['req_typesearch'])){ echo "No matching data.";}else{ echo "There are no responses in mailbox.";}?>
										</div>
									</div>
							<?php } ?>
							</div>
						</div>
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
	
	<div class="fade modal" id="myModal122" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			   <div class="modal-header">
				  <button class="close data-dismiss=modal" type="button">×</button>
				  <h4 class="modal-title">Filter</h4>
			   </div>
			   <div class="modal-body" style="height:300px">
				<form method="get" class="filter_box">
					<div class="col-md-6">
					   <div class="col-md-12">
						<label for="example-text-input" class=" col-form-label">Name: </label> 
						   <input type="text" name="agentname" value="<?php echo isset($_GET['agentname'])? $_GET['agentname']:''; ?>"  class="form-control">
					   </div>
					</div>
					 
				    <div class="col-md-6">
					  
					   <div class="col-md-12"> 
						 <label for="example-text-input" class=" col-form-label">Reference ID: </label>
						   <input type="text" name="refidsearch" value="<?php echo isset($_GET['refidsearch'])? $_GET['refidsearch']:''; ?>"  class="form-control">
					  </div>
					</div>
						   
						   
					<div class="col-md-6">
					   
					   <div class="col-md-12">
						<label for="example-text-input" class=" col-form-label">Budget: </label> 
						   <select name="budgetsearch" class="form-control"><option value="">Select Budget</option><option value="0-10000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="0-10000")? 'selected':''; ?>>0-10000</option><option value="10000-30000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="10000-30000")? 'selected':''; ?>>10000-30000</option><option value="30000-50000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="30000-50000")? 'selected':''; ?>>30000-50000</option><option value="50000-100000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="50000-100000")? 'selected':''; ?>>50000-100000</option></select>
					   </div>
					</div>
						   
						   
					<div class="col-md-6">
					   
					   <div class="col-md-12">
						<label for="example-text-input" class=" col-form-label">Quoted Price: </label>
						   <select name="quotesearch" class="form-control"><option value="">Select Quoted Price</option><option value="0-10000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="0-10000")? 'selected':''; ?>>0-10000</option><option value="10000-30000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="10000-30000")? 'selected':''; ?>>10000-30000</option><option value="30000-50000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="30000-50000")? 'selected':''; ?>>30000- 50000</option><option value="50000-100000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="50000-100000")? 'selected':''; ?>>50000-100000</option></select>
						</div>
					</div>
					<div class="col-md-6">
					  
					   <div class="col-md-12">
						 <label for="example-text-input" class=" col-form-label">Chat With: </label>
						   <select name="chatwith" class="form-control"><option value="">Select Chat With</option>
						   <?php if(!empty($UserResponse)){ 
								foreach($UserResponse as $user){               
						   ?>
						   <option <?php echo (isset($_GET['chatwith']) && $_GET['chatwith'] ==$user['user']['id'])? 'selected':''; ?> value="<?php echo $user['user']['id']?>"><?php echo $user['user']['first_name'].' '.$user['user']['last_name']?></option>
						   <?php }}?>
						   </select>
						</div>
					</div>
					<div class="col-md-6">
					   
					   <div class="col-md-12">
							<label for="example-text-input" class=" col-form-label">Following: </label> 
						   <input type="checkbox" name="followsearch" value="1" <?php echo isset($_GET['followsearch'])? "checked":''; ?>  >
					   </div>
				   </div>
					<div class="col-md-6">
					   
					   <div class="col-md-12">
						<label for="example-text-input" class=" col-form-label">Shared Details: </label>
						   <input type="checkbox" name="shared_details" value="1" <?php echo isset($_GET['shared_details'])? "checked":''; ?>  >
					   </div>
				   </div>
						   
					<div class="col-md-12 text-center">
					<hr></hr>
						<button type="submit" name="submit" value="Submit"  class="btn btn-primary btn-submit">Filter</button>
						<a class="btn btn-primary btn-submit" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'checkresponses',$responseid)) ?>">Reset</a>
					</div>
			   </form>
			   </div>
			</div>
		</div>
	</div>
 	
      

      

      <!--ap filters-->
  
		
		 
		 
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

	<!--modal-->
	 <div class="fade modal"id="detailModal"role=dialog>
		<div class=modal-dialog>
			<div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">
					<?php 
					if ($requestDetails['category_id'] == 1)
					{ ?>
						Package Details<?php
					} ?><?php

					if ($requestDetails['category_id'] == 2)
					{ ?>
						Transport Details<?php
					} ?><?php

					if ($requestDetails['category_id'] == 3)
					{ ?>
						Hotel Details<?php
					} ?>
				  </h4>
				</div>
				<div class="modal-body">
					<fieldset>
						<legend style="text-align:left !important"><h3>General Requirements</h3></legend>
						<ul>
							<li class="col-lg-4 col-md-4 col-sm-4 col-xs-6"><p>Reference ID:&nbsp;<?php
							echo $requestDetails['reference_id']; ?>
							<li class="col-xs-6 col-lg-6 col-md-6 col-sm-6"><p>Total Budget:&nbsp;<?php
							echo $requestDetails['total_budget'] . " Rs."; ?>
							<li class="col-lg-4 col-md-4 col-sm-4 col-xs-6"><p>Adult:&nbsp;<?php
							echo $requestDetails['adult']; ?>
							<li class="col-xs-6 col-lg-6 col-md-6 col-sm-6	"><p>Children below 6:&nbsp;<?php
							echo $requestDetails['children']; ?></li>
						</ul>
					</fieldset>
				<?php
				if ($requestDetails['category_id'] == 1 || $requestDetails['category_id'] == 3)
				{  
					if ($requestDetails['category_id'] == 1)
					{
						if (count($requestDetails['hotels']) >= 1)
						{ ?>
						<fieldset>
							<legend style="text-align:left !important"><h3>Stay Requirements</h3></legend>
							<?php
							$ds_count = 1;
							foreach($requestDetails['hotels'] as $row)
							{ ?>
							<fieldset>
							<legend style="text-align:left !important"><h5>Destination <?php
								echo $ds_count; ?></h5></legend>
								 
								<ul>
								<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p>Single:&nbsp;<?php
								if ($row['room1'] != '')
								{
									echo $row['room1'];
								}
								else
								{
									echo "--";
								} ?><li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p>Double:&nbsp;<?php
								if ($row['room2'] != '')
								{
									echo $row['room2'];
								}
								else
								{
									echo "--";
								} ?><li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p>Triple:&nbsp;<?php
								if ($row['room3'] != '')
								{
									echo $row['room3'];
								}
								else
								{
									echo "--";
								} ?><li class="col-xs-12 col-lg-4 col-md-4 col-sm-4"><p>Child With Bed:&nbsp;<?php
								if ($row['child_with_bed'] != '')
								{
									echo $row['child_with_bed'];
								}
								else
								{
									echo "-- --";
								} ?><li class="col-xs-12 col-sm-6 col-lg-6 col-md-6"><p>Child Without Bed:&nbsp;<?php
								if ($row['child_without_bed'] != '')
								{
									echo $row['child_without_bed'];
								}
								else
								{
									echo "-- --";
								} ?><li class="col-xs-12 col-lg-12 col-md-12 col-sm-12"><p>Hotel Category:&nbsp;<?php
								if (!empty($row['hotel_category']))
								{
									$result = explode(",", $row['hotel_category']);
									$count = 1;
									$hotel_category = "";
									foreach($result as $row1)
									{
										$hotel_category.= "" . $hotelCategories[$row1] . " or ";

										// echo $count.". ".$hotelCategories[$row1].", ";

										$count++;
									}

									echo substr($hotel_category, 0, -3);
								}
								else
								{
									echo "-- --";
								} ?><li class="col-xs-12 col-lg-4 col-md-4 col-sm-4"><p>Hotel Rating:&nbsp;<?php
								if ($row['hotel_rating'] > 0)
								{
									for ($i = $row['hotel_rating']; $i > 0; $i--)
									{
										echo '<i class="fa fa-star"></i>';
									}
								}
								else
								{
								}
		 
				?><li class="col-xs-12 col-sm-6 col-lg-6 col-md-6 col-offset-right-1"><p>Meal:&nbsp;<?php
								echo ($row['meal_plan']) ? $mealPlanArray[$row['meal_plan']] : "-- --"; ?><li class="col-lg-4 col-md-4 col-sm-4 col-xs-6"><p>Check In:&nbsp;<?php
								echo ($row['check_in']) ? date("d/m/Y", strtotime($row['check_in'])) : "-- --"; ?><li class="col-xs-6 col-lg-6 col-md-6 col-sm-6"><p>Check Out:&nbsp;<?php
								echo ($row['check_out']) ? date("d/m/Y", strtotime($row['check_out'])) : "-- --"; ?><li class="col-xs-12 col-lg-4 col-md-4 col-sm-4"><p>Locality:&nbsp;<?php
								echo ($row['locality']) ? $row['locality'] : "-- --"; ?><li class="col-xs-12 col-lg-4 col-md-4 col-sm-4"><p>Destination City:&nbsp;<?php
								echo ($row['city_id']) ? $allCities[$row['city_id']] : "-- --"; ?><li class="col-xs-12 col-lg-4 col-md-4 col-sm-4"><p>Destination State:&nbsp;<?php
								echo ($row['state_id']) ? $allStates[$row['state_id']] : "-- --"; ?>
								</ul>
								</fieldset>
								<?php
								$ds_count++;
							} ?>
						</fieldset>	
						<?php
						}?>
					<fieldset><legend style="text-align:left !important"><h3>Transport Requirements</h3></legend>
					<ul>
						<li class="col-xs-12 col-lg-12 col-md-12 col-sm-6">
						<p>Transport:&nbsp;
							<?php
							echo ($requestDetails['transport_requirement']) ? $transpoartRequirmentArray[$requestDetails['transport_requirement']] : "-- --"; ?>
						</p>
						</li>
						<li class="col-md-6">
						<p>Start Date:&nbsp;<?php
							echo ($requestDetails['start_date']) ? date("d/m/Y", strtotime($requestDetails['start_date'])) : "-- --"; ?>
						</p>
						</li>
						<li class="col-md-6">
						<p>End Date:&nbsp;<?php
							echo ($requestDetails['end_date']) ? date("d/m/Y", strtotime($requestDetails['end_date'])) : "-- --"; ?>
						</p>
						</li>
						<li class="col-md-6">
						<p>Pickup Locality:&nbsp;<?php
						echo ($requestDetails['pickup_locality']) ? $requestDetails['pickup_locality'] : "-- --"; ?>
						</p>
						</li>
						<li class="col-md-6">
						<p>Pickup City:&nbsp;<?php
						echo ($requestDetails['pickup_city']) ? $allCities[$requestDetails['pickup_city']] : "-- --"; ?>
						</p>
						</li>
						<li class="col-md-6">
						<p>Pickup State:&nbsp;<?php
						echo ($requestDetails['pickup_state']) ? $allStates[$requestDetails['pickup_state']] : "-- --"; ?>
						</p>
						</li>
						<?php
						if (!empty($requestDetails['request_stops']))
						{ ?><?php
							$stop_count = 1;
							foreach($requestDetails['request_stops'] as $stops)
							{ ?>
							<fieldset><legend>Stop <?php	echo $stop_count; ?></legend>
								 
								<li class="col-md-6">
									<p>Stop Locality:&nbsp;<?php
										echo ($stops['locality']) ? $stops['locality'] : "-- --"; ?>
									</p>
								</li>
								<li class="col-md-6">
									<p>Stop City:&nbsp;<?php
										echo ($stops['city_id']) ? $allCities[$stops['city_id']] : "-- --"; ?>
									</p>
								</li>
								<li class="col-md-6">
									<p>Stop State:&nbsp;<?php
										echo ($stops['state_id']) ? $allStates[$stops['state_id']] : "-- --"; ?>
									</p>
								</li>
							</fieldset>
								<?php
								$stop_count++;
							}
						} ?>
						
						<li class="col-md-6">
							<p>Final Locality:&nbsp;<?php
								echo ($requestDetails['final_locality']) ? $requestDetails['final_locality'] : "-- --"; ?>
							</p>
						</li>
						<li class="col-md-6">
							<p>Final City:&nbsp;<?php
								echo ($requestDetails['final_city']) ? $allCities[$requestDetails['final_city']] : "-- --"; ?>
							</p>
						</li>
						<li class="col-md-6">
							<p>Final State:&nbsp;<?php
								echo ($requestDetails['final_state']) ? $allStates[$requestDetails['final_state']] : "-- --"; ?>
							</p>
						</li>
					</ul>
					</fieldset>
				<?php
				}
				elseif ($requestDetails['category_id'] == '3')
				{ ?>
					<fieldset><legend style="text-align:left !important"><h3>Stay Requirements</h3></legend>
					<?php
					$ds_count = 1;
					foreach($requestDetails['hotels'] as $row)
					{ ?>
						<ul>
							<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p>Single:&nbsp;<?php
							if ($row['room1'] != '')
							{
								echo $row['room1'];
							}
							else
							{
								echo "--";
							} ?>
							</p>
							</li>
							<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p>Double:&nbsp;<?php
							if ($row['room2'] != '')
							{
								echo $row['room2'];
							}
							else
							{
								echo "--";
							} ?>
							</p>
							</li>
							<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p>Triple:&nbsp;<?php
							if ($row['room3'] != '')
							{
								echo $row['room3'];
							}
							else
							{
								echo "--";
							} ?>
							</p>
							</li>
							<li class="col-xs-12 col-lg-4 col-md-4 col-sm-4"><p>Child With Bed:&nbsp;<?php
							if ($row['child_with_bed'] != '')
							{
								echo $row['child_with_bed'];
							}
							else
							{
								echo "-- --";
							} ?>
							</p>
							</li>
							<li class="col-xs-12 col-sm-6 col-lg-6 col-md-6"><p>Child Without Bed:&nbsp;<?php
							if ($row['child_without_bed'] != '')
							{
								echo $row['child_without_bed'];
							}
							else
							{
								echo "-- --";
							} ?>
							</p>
							</li>
							<li class="col-xs-12 col-lg-12 col-md-12 col-sm-12"><p>Hotel Category:&nbsp;<?php
							if (!empty($row['hotel_category']))
							{
								$result = explode(",", $row['hotel_category']);
								$count = 1;
								$hotel_category = "";
								foreach($result as $row1)
								{
									$hotel_category.= "" . $hotelCategories[$row1] . " or ";
									$count++;
								}
								echo substr($hotel_category, 0, -3);
							}
							else
							{
								echo "-- --";
							} ?>
							</p>
							</li>
							<li class="col-xs-12 col-lg-4 col-md-4 col-sm-4"><p>Hotel Rating:&nbsp;<?php
							if ($row['hotel_rating'] > 0)
							{
								for ($i = $row['hotel_rating']; $i > 0; $i--)
								{
									echo '<i class="fa fa-star"></i>';
								}
							}
							else
							{
							}

							?>
							</p>
							</li>
							<li class="col-xs-12 col-lg-4 col-md-4 col-sm-4 col-offset-right-1">
							<p>Meal:&nbsp;<?php
							echo ($row['meal_plan']) ? $mealPlanArray[$row['meal_plan']] : "-- --"; ?>
							</p>
							</li>
							<li class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
							<p>Check In:&nbsp;<?php
							echo ($row['check_in']) ? date("d/m/Y", strtotime($row['check_in'])) : "-- --"; ?>
							</p>
							</li>
							<li class="col-xs-6 col-lg-6 col-md-6 col-sm-6">
							<p>Check Out:&nbsp;<?php
							echo ($row['check_out']) ? date("d/m/Y", strtotime($row['check_out'])) : "-- --"; ?>
							</p>
							</li>
							<li class="col-xs-12 col-lg-4 col-md-4 col-sm-4">
							<p>Locality:&nbsp;<?php
							echo ($row['locality']) ? $row['locality'] : "-- --"; ?>
							</p>
							</li>
							<li class="col-xs-12 col-lg-4 col-md-4 col-sm-4">
							<p>Destination City:&nbsp;<?php
							if (empty($row['city_id']))
							{
								echo $allCities[$requestDetails['city_id']];
							}
							else
							{
								$allCities[$row['city_id']];
							} ?>
							</p>
							</li>
							<li class="col-xs-12 col-lg-4 col-md-4 col-sm-4"><p>Destination State:&nbsp;<?php
							if (empty($row['state_id']))
							{
								echo $allStates[$requestDetails['state_id']];
							}
							else
							{
								$allStates[$row['state_id']];
							} ?>
							</p>
							</li>
						</ul><?php
						$ds_count++;
					} ?>
					</fieldset><?php
				}
			}
			else
			if ($requestDetails['category_id'] == 2)
			{ ?>
				<fieldset><legend style="text-align:left !important"><h3>Transport Requirements</h3></legend>
					<ul>
						<li class="col-md-6">
						<p>Transport:&nbsp;<?php
							echo ($requestDetails['transport_requirement']) ? $transpoartRequirmentArray[$requestDetails['transport_requirement']] : "-- --"; ?>
						</p>
						</li>
						<li class="col-md-6">
						<p>Start Date:&nbsp;<?php
							echo ($requestDetails['start_date']) ? date("d/m/Y", strtotime($requestDetails['start_date'])) : "-- --"; ?>
						</p>
						</li>
						<li class="col-md-6">
						<p>End Date:&nbsp;<?php
							echo ($requestDetails['end_date']) ? date("d/m/Y", strtotime($requestDetails['end_date'])) : "-- --"; ?>
						</p>
						</li>
						<li class="col-md-6">
						<p>Pickup Locality:&nbsp;<?php
							echo ($requestDetails['pickup_locality']) ? $requestDetails['pickup_locality'] : "-- --"; ?>
						</p>
						</li>
						<li class="col-md-6">
						<p>Pickup City:&nbsp;<?php
							echo ($requestDetails['pickup_city']) ? $allCities[$requestDetails['pickup_city']] : "-- --"; ?>
						</p>
						</li>
						<li class="col-md-6">
						<p>Pickup State:&nbsp;<?php
							echo ($requestDetails['pickup_state']) ? $allStates[$requestDetails['pickup_state']] : "-- --"; ?>
						</p>
						</li><?php
						if (!empty($requestDetails['request_stops']))
						{ ?><?php
							$stop_count = 1;
							foreach($requestDetails['request_stops'] as $stops)
							{ ?>
							<fieldset><legend>Stop <?php echo $stop_count; ?></legend>
								<li class="col-md-6">
									<p>Stop Locality:&nbsp;<?php
									echo ($stops['locality']) ? $stops['locality'] : "-- --"; ?>
									</p>
								</li>
								<li class="col-md-6">
									<p>Stop City:&nbsp;<?php
									echo ($stops['city_id']) ? $allCities[$stops['city_id']] : "-- --"; ?>
									</p>
								</li>
								<li class="col-md-6">
									<p>Stop State:&nbsp;<?php
									echo ($stops['state_id']) ? $allStates[$stops['state_id']] : "-- --"; ?>
									</p>
								</li> 
								</fieldset><?php
								$stop_count++;
							}
						} ?>
						<li class="col-md-6">
						<p>Final Locality:&nbsp;<?php
						echo ($requestDetails['final_locality']) ? $requestDetails['final_locality'] : "-- --"; ?>
						</p>
						</li>
						<li class="col-md-6">
						<p>Final City:&nbsp;<?php
						echo ($requestDetails['final_city']) ? $allCities[$requestDetails['final_city']] : "-- --"; ?>
						</p>
						</li>
						<li class="col-md-6">
						<p>Final State:&nbsp;<?php
						echo ($requestDetails['final_state']) ? $allStates[$requestDetails['final_state']] : "-- --"; ?>
						</p>
						</li>
					</ul>
				</fieldset>
				<?php
			} 
			
			if (!empty($requestDetails['comment']))
			{
				if ($requestDetails['category_id'] == 2 || $requestDetails['category_id'] == 1)
				{
					$comment_class = "tcomments";
				}
				else
				{
					$comment_class = "comments";
				}

			?>
			
									<fieldset><legend style="text-align:left !important"><h3>Comments</h3></legend>
										<ul>
											<li class="col-xs-12 col-lg-12 col-md-12 col-sm-12 comment text-left">
												<p><?php echo $requestDetails['comment']; ?>
												</p>
											</li>
										</ul>
									</fieldset>
									<?php
									} ?>
										<div class="modal-footer">
											<button class="btn btn-default"data-dismiss=modal type=button>Close</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<!--/modal-->
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
		if(confirm("Are you sure want to block this user?")) {
			$.ajax({
				url:url,
				type: 'POST',
				data: {user_id:user_id}
			}).done(function(result){
				if(result == 1) {
					alert("This user has been blocked successfully.");
					location.reload();
				}else if(result == 2){
				alert("This user has already blocked.");
				} else {
					alert("There is some problem, please try again.");
				}
			});
		}
	});
	
	$(".businessBuddy").click(function (e) {
		e.preventDefault();
		var __this = $(this);
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
					__this.parent().remove();
				} else {
					alert("There is some problem, please try again.");
				}
			});
		}
	});
	
	$(".acceptOffer").click(function (e) {
		e.preventDefault();
		var __this = $(this);
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'acceptOffer')) ?>";
		var request_id = $(this).attr("request_id");
		var response_id = $(this).attr("response_id");
		if(confirm("Are you sure want to accept this offer?")) {
			$.ajax({
				url:url,
				type: 'POST',
				data: {request_id:request_id, response_id:response_id}
			}).done(function(result){
				if(result == 1) {
					alert("This offer has been accepted successfully.");
					//$('#myModal_accept').modal('show');
					$('#add_review').click();
					__this.remove();
				} else {
					alert("There is some problem, please try again.");
				}
			});
		}
	});
	$(".shareDetails").click(function (e) {
		e.preventDefault();
		var __this = $(this);
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'shareDetails')) ?>";
		var request_id = $(this).attr("request_id");
		var response_id = $(this).attr("response_id");
		var user_id = $(this).attr("user_id");
		if(confirm("Are you sure want to share your details with this user?")) {
			$.ajax({
				url:url,
				type: 'POST',
				data: {request_id:request_id, response_id:response_id,user_id:user_id}
			}).done(function(result){
				if(result == 1) {
					alert("Your details has been shared successfully.");
					__this.remove();
				} else {
					alert("There is some problem, please try again.");
				}
			});
		}
	});
});
</script>
<script>
$('#UserChatForm').validate({
	rules: {
		"message" : {
			required : true
		}
	},
	messages: {
		"message" : {
			required : "Please enter message."
		}
	},
	ignore: ":hidden:not(select)"
});
$('#addtestimonial').validate({
	rules: {
		"rating" : {
			required : true
		}
	},
	messages: {
		"rating" : {
			required : "Please select rating."
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
$('#UserRatingForm').validate({
	rules: {
		"rating" : {
			required : true
		}
	},
	messages: {
		"rating" : {
			required : "Please select rating."
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