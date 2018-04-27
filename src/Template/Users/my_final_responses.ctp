<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php

use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');

?>
<style>
	legend {
		text-align:center;
	}
	fieldset
	{
		border-radius: 7px;
		box-shadow: 0 3px 9px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
	}
	p {
		color: #96989A !important;
		margin: 0 0 5px !important;
		line-height: 17px !important;
	} 
	.col-form-label{
		margin-top: 4px;
		font-weight:100 !important;
	}
	.details {
		color: #000 !important;
		font-weight: 400;
	}
</style>
<div id="my_final_responses" class="container-fluid">
	<div class="row equal_column">
	<div class="col-md-12" style="background-color:#"> 
		<?php echo  $this->Flash->render() ?>
	</div>
	</div>
<div class="box box-primary">
	<div class="row">
		<div class="col-md-12">
			<div class="box-header with-border"> 
				<h3 class="box-title" style="padding:5px">Finalized Responses</h3>
				<div class="box-tools pull-right">
					<a style="font-size:22px" class="btn btn-box-tool" data-target="#filterpopups" data-toggle="collapse"> <i class="fa fa-filter"></i></a>
				</div>
			</div>
		</div>
		<div id="FilerPopup" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Filter</h4>
			  </div>
			  <form method="get">
			  <div class="modal-body">
				<div class="row" style="margin-top:10px">
					<div class="col-md-12">
					   <label for="example-text-input" class="col-md-3 col-form-label">Agent Name: </label> 
					   <div class="col-md-9">           
						   <?php echo $this->Form->control('agentnamesearch', ['label'=>false,"type"=>"select",'options' =>$selectoption,"class"=>"form-control select2","data-placeholder"=>"Select Multiple ",'empty'=>'Select...','multiple'=>true]); ?>
					   </div>
					</div>
			    </div>
				
				<div class="row" style="margin-top:10px">
					<div class="col-md-12">
					   <label for="example-text-input" class="col-md-3 col-form-label">Reference ID: </label> 
					   <div class="col-md-9">           
						   <?php echo $this->Form->control('refidsearch[]', ['label'=>false,"type"=>"select",'options' =>$RefId,"class"=>"form-control select2","multiple"=>true,"data-placeholder"=>"Select Multiple",'empty'=>'Select...','multiple'=>true]); ?>
					   </div>
					</div>
			    </div>
				  
				 <div class="row" style="margin-top:10px">
					<div class="col-md-12">
					   <label for="example-text-input" class="col-md-3 col-form-label">Request Type: </label> 
					   <div class="col-md-9">           
						    <select name="req_typesearch" multiple="multiple" class="form-control select2" data-placeholder="Select Multiple">
								<option value="1">Package</option>
								<option value="3">Hotel</option>
								<option value="2">Transport</option>
							</select>
					   </div>
					</div>
			    </div>
				  
				  
				<div class="row" style="margin-top:10px">
					<div class="col-md-12">
					   <label for="example-text-input" class="col-md-3 col-form-label">Total Budget Range: </label>
					   <div class="col-md-9">             
						    <select name="budgetsearch" class="form-control">
								<option value="">Select Total Budget</option>
								<option value="0-10000">0-10000</option>
								<option value="10000-30000" >10000-30000</option>
								<option value="30000-50000" >30000-50000</option>
								<option value="50000-100000">50000-100000</option>
							</select>
					   </div>
					</div>
				</div>
				<div class="row" style="margin-top:10px">			   
					<div class="col-md-12">
					   <label for="example-text-input" class="col-md-3 col-form-label">Quoted Price Range: </label> 
					   <div class="col-md-9">            
						<select name="quotesearch" class="form-control">
							<option value="">Select Quoted Price</option>
							<option value="0-10000">0-10000</option>
							<option value="10000-30000">10000-30000</option>
							<option value="30000-50000">30000-50000</option>
							<option value="50000-100000">50000-100000</option>
							<option value="100000-100000000000" >100000-Above</option>
						</select>
					   </div>
					</div>
			    </div>
				
				<div class="row" style="margin-top:10px">
					<div class="col-md-12">
					   <label for="example-text-input" class="col-md-3 col-form-label">Start Date: </label>
					   <div class="col-md-9">           
						    <input  type="text"  class="form-control datepickers" data-date-format="dd-mm-yyyy" name="startdatesearch" id="datepicker1">
					   </div>
					</div>
			    </div>
				
				<div class="row" style="margin-top:10px">
					<div class="col-md-12">
					   <label for="example-text-input" class="col-md-3 col-form-label">End Date: </label> 
					   <div class="col-md-9">           
						   <input  type="text" class="form-control datepickers" data-date-format="dd-mm-yyyy" name
="enddatesearch" id="datepicker2">
					   </div>
					</div>
			    </div>
				
				<div class="row" style="margin-top:10px">
					<div class="col-md-12">
					   <label for="example-text-input" class="col-md-3 col-form-label">Pickup City (Transportation): </label> 
					   <div class="col-md-9">           
						   <select class="form-control select2"  name=pickup_city id=pickup_city>
							   <option value="">Select</option>
							   <?php foreach($allCities1 as $city){?>
							   <option value="<?php echo $city['value'];?>"><?php echo $city['label'];?></option>
							   <?php }?>
							</select>
					   </div>
					</div>
			    </div>
				

			 <div class="row" style="margin-top:10px">
					<div class="col-md-12">
					   <label for="example-text-input" class="col-md-3 col-form-label">Destination City (Packages & Hotels): </label> 
					   <div class="col-md-9">           
						   <select class="form-control select2" name=destination_city id=destination_city>
							   <option value="">Select</option>
							   <?php foreach($allCities1 as $city){?>
							   <option value="<?php echo $city['value'];?>"<?php if(isset($_GET['destination_city']) AND $_GET['destination_city']==$city['value']){ echo 'selected'; }?>><?php echo $city['label'];?></option>
							   <?php }?>
							</select>
					   </div>
					</div>
			    </div>
			 
			  </div>
			  <div class="modal-footer" style="margin-top:10px" align="center">
				<input type="submit" name="submit" value="Submit"  class="btn btn-primary btn-submit">
				<a class="btn btn-primary btn-submit" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'my-final-responses')) ?>">Reset</a>
			  </div>
			  </form>
			</div>

		  </div>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
		<div class=""> 
		<div class="collapse"  id="filterpopups" aria-expanded="false"> 
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
								<label class="col-form-label"for=example-text-input>Total Budget Range:  </label>
							</div> 
							<div >
								<select name="budgetsearch" class="form-control">
									<option value="">Select Total Budget</option>
									<option value="0-10000">0-10000</option>
									<option value="10001-30000">10001-30000</option>
									<option value="30001-50000" >30001-50000</option>
									<option value="50001-100000" >50001-100000</option>
									<option>100001-Above</option>
								</select>
							</div>
						</div>
						<div class=col-md-6>
							<div >
								<label class="col-form-label"for=example-text-input>Quoted Price Range:  </label>
							</div> 
							<div >
								<select name="quotesearch" class="form-control">
									<option value="">Select Quoted Price</option>
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
					</div>
					
					<div class="col-md-12 text-center">
						<hr></hr>
						<a class="btn btn-danger btn-sm" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'respondtorequest')) ?>">Reset</a>
						<button class="btn btn-info btn-sm" name="submit" value="Submit" type="submit">Apply</button> 
					</div>
				</fieldset>
			</form>
		</div>

				
<!------------ Main -------------->	
	<?php 
		if(count($responses) >0) {  
			foreach($responses as $row){
			?>
			<div id="cat" >
			<div class="col-md-4" style="padding-top:15px;">
			<?php 
                
				if($row['request']['category_id']==1){ 
					$image=$this->Html->image('/img/slider/package-icon.png');
					$text="<span class='packageType'>Package</span>";
				} 
				if($row['request']['category_id']==2){
					$image= $this->Html->image('/img/slider/transport-icon.png');
					$text="<span class='transportType'>Transport</span>";
				}
				if($row['request']['category_id']==3){
					$image= $this->Html->image('/img/slider/hotelier-icon.png');
					$text="<span class='hotelType'>Hotel</span>";
				}
				$created=$row['created'];
				$org_created=date('d-M-Y', strtotime($created));
				?>
				<fieldset>
					<legend><?php echo $image; ?></legend>
					<span style="margin-top:-30px;float:right;"><?php echo $org_created; ?></span>
                 <ul>
				 
				 <li >
					<p>
						<?php 
							$total_rating=0;
							$rate_count=0;
							$final_rating=0;
							$sql1="Select * from `testimonial` where `user_id`='".$row['request']['user']['id']."' ";
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
						From:   <a href="viewprofile/<?php echo $row['request']['user_id']; ?>/1"><?php echo str_replace(';',' ',$allUsers[$row['request']['user_id']]); ?></a>
						<?php if($final_rating>0){ ?>
						<font color="#1295AB"> (<?php echo round($final_rating); ?> <i class="fa fa-star"></i>)</font>
						<?php } ?>
					</p>
				</li>
                 <li >
                    <p>
                        Request Type:  <?php echo $text; ?>
                    </p>
                 </li>
				<li >
					<p>
						<?php 
							$total_budget=round($row['request']['total_budget']);
						?>
						Total Budget:   
						<?php //echo ($row['request']['total_budget'])? "Rs. ". $row['request']['total_budget']: "-- --" ?>
						<span class="details"><?php echo ($total_budget)? "Rs. ". ($total_budget): "-- --" ?></span>
					</p>
				 </li>
				 
				<li >
					<p>
					   <?php 
							$quotation_price=round($row['quotation_price']);
						?>
						 Quotation Price:   
						 <?php //echo ($row['quotation_price'])? " Rs. ".$row['quotation_price']:"-- --" ?>
						<span class="details"> <?php echo ($quotation_price)? "Rs. ". ($quotation_price): "-- --" ?></span></p>
				</li>
                <li class="destination">
				   <?php if($row['request']['category_id']==2){ ?>
                  <p>
                   Pickup City:  <span class="details"> <?php echo ($row['request']['pickup_city'])?$allCities[$row['request']['pickup_city']]:"-- --"; ?><?php echo ($row['request']['pickup_state'])?' ('.$allStates[$row['request']['pickup_state']].')':"";  ?></span>

                  <?php } else { ?>
                        <p>
                        Destination City:   <span class="details">
						<?php 
							$a=$row['request']['city_id']?$allCities[$row['request']['city_id']]:"-- --"; 
							$b=$row['request']['state_id']?' ('.$allStates[$row['request']['state_id']].')':"";
							echo mb_strimwidth($a.$b, 0,33, "...");?>
							</span>
                        </p>
                        <?php } ?>
                 </li>
                 <li>
					<p>Reference ID:  &nbsp;
						<span class="details"><?php echo $row['request']['reference_id']; ?></span>
					</p>
                 </li>
				
				<?php if($row['request']['category_id'] == 3 ) { ?>
					<li >
                        <p>
                            Start Date:   <span class="details"><?php echo ($row['request']['check_in'])?date("d/m/Y", strtotime($row['request']['check_in'])):"-- --"; ?></span>
                        </p>
                     </li>
					<li >
                        <p>
                            End Date:   <span class="details"><?php echo ($row['request']['check_out'])?date("d/m/Y", strtotime($row['request']['check_out'])):"-- --"; ?></span>
                        </p>
                    </li>
					<?php } elseif($row['request']['category_id'] == 1 ) {
						$sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$row['request']['id']."'";
						$stmt = $conn->execute($sql);
						$result = $stmt ->fetch('assoc');						
					?>
					<li >
                        <p>
                            Start Date:   <span class="details"><?php echo ($row['request']['check_in'])?date("d/m/Y", strtotime($row['request']['check_in'])):"-- --"; ?></span>
                        </p>
                     </li>
					<li >
                        <p>
                        <?php if(!empty($result['TopDate'])) { ?>
                        End Date:   <span class="details"><?php echo date('d/m/Y',strtotime($result['TopDate'])); ?></span>
                        <?php }else{?>
                        End Date:  <span class="details"><?php echo ($row['request']['check_out'])?date("d/m/Y", strtotime($row['request']['check_out'])):"-- --"; ?></span>
                        <?php }?>
                            
                        </p>
                     </li>
				<?php } elseif($row['request']['category_id'] == 2 ) { ?>
					<li >
                        <p>
                            Start Date:   <span class="details"><?php echo ($row['request']['start_date'])?date("d/m/Y", strtotime($row['request']['start_date'])):"-- --"; ?></span>
                        </p>
                    </li>
					<li >
                        <p>
                            End Date:   <span class="details"><?php echo ($row['request']['end_date'])?date("d/m/Y", strtotime($row['request']['end_date'])):"-- --"; ?></span>
                        </p>
                    </li>
				<?php } ?>
				     <li >
                        <p>
                            Members:   <span class="details"><?php echo $row['request']['adult'] +  $row['request']['children']; ?></span>
                     </p>
					</li>
					<li>
                       <p> Comment:  <span class="details"><?php echo mb_strimwidth($row['comment'], 0, 25, "...");?></span></p>
                    </li>
                   </ul>
				   <hr></hr>
				   <div>
				   <?php $id=$row['id']; ?>
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
<div class="modal fade" id="myModal1<?php echo $id;?>" role="dialog">
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
					<table width="100%" style="text-align:center" class>
							<tr>
								<td width="50%" style="padding:3px !important;">
									<a style="width:99%" data-toggle="modal" class="btn btn-success btn-sm" data-target="#myModalChat<?php echo $id; ?>" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'userChat', $row['request']['id'], $row['request']['user_id'],2)) ?>">
									Chat ( <strong><?php echo $chatdata['chat_count'][$row['id']]; ?> </strong> )</a>
									
								</td>
								<td width="50%" style="padding:3px !important;">
									<a style="width:99%" data-toggle="modal" class="btn btn-info btn-sm" data-target="#myModal1<?php echo $id;?>" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'viewdetails',$row['request']['id'])) ?>"> Details</a>
									
							 </td>
							 </tr>
						</table>
						
						
						 <table width="100%"   class>
							<tr>
								<td width="33%" style="padding:3px !important;">
									<?php
									if(array_key_exists($row['request']['user_id'], $BusinessBuddies)) {?>
										<span style="width:99%;background-color:#dadadabf;display: inline-block;text-align: center;border-radius: 6px;vertical-align: middle;"  class="btn-defult btn-sm tst"> Following </span> 
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
															<font color="black">Are you sure you want to follow this user?</font>
														</h4>
													</div>
														<div class="modal-footer">
														<button type="button"  href="javascript:void(0);" class="businessBuddy btn btn-danger btn-sm" user_id = "<?php echo $row['request']['user_id']; ?>" >Follow</button>
														<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
														</div>
													</div>
												</div>
											</div>
										
										<?php 
									}
									?>
								</td>
								 
							<td width="33%" style="padding:3px !important;">
							<?php
								$sql="Select count(*) as block_count from blocked_users where blocked_user_id='".$row['request']['user']['id']."' AND blocked_by='".$row['user_id']."'";
								$stmt = $conn->execute($sql);
								$bresult = $stmt ->fetch('assoc'); 
								if($bresult['block_count']>0){
									$blocked = 1;
								}
								else{
									$blocked = 0;
								}
							if($blocked==1)
							{?>
								<span style="width:99%;background-color:#dadadabf;display: inline-block;text-align: center;border-radius: 6px;vertical-align: middle;"  class="btn-defult btn-sm tst"> Blocked </span> 
							<?php }
							else
							{ ?>
							<a style="width:99%" data-toggle="modal" class="btn btn-danger btn-sm" data-target="#block<?php echo $id; ?>"  > Block User </a>
							<!-------Contact Details Modal --------->
							<div id="block<?php echo $id; ?>" class="modal fade" role="dialog">
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
													<button type="button"  href="javascript:void(0);" class="blockUser btn btn-danger" user_id = "<?php echo $row['request']['user']['id']; ?>">Block</button>
													<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
												</div>
											</div>
										</div>
									</div>
							<?php } ?>	
								</td>
					
								<td width="33%" style="padding:3px !important;">
									<?php $reviewi =  $row['request']['user_id']."-".$row['request']['id']; ?>
									<a style="width:99%" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal1review<?php echo $row['id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'addtestimonial',  $reviewi)) ?>">Review </a>
									<div class="modal fade" id="myModal1review<?php echo $row['id']; ?>" role="dialog">
										<div class="modal-dialog" align="center">
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
								</td>
							</tr>
						</table>
					</div>
				</fieldset>
			</div>
		<?php } ?>
	</div>
<div class="pages"></div>
		
		<?php 
		}
		else 
		{
			?>
			 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                 <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 text-center box-event">
					<?php if(isset($_GET['agentnamesearch'])){ echo "No matching data.";}else{ echo "There are no finalized responses in the mailbox.";}?>
                </div>
             </div>
		<?php 
		} 
		?>

			</div>
				<div class="modal fade" id="myModal" role="dialog">
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
          </div>
      </div>
    </div>
<script>
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
$(document).ready(function () {
	 $('.datepicker').datepicker();
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
});
</script>