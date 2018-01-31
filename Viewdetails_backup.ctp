
<div class="container-fluid" id="profile" >
	<div class="row tra-section-gray equal_column">

       <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 padding0">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 right-panel pro-top">
		 
			
	
            <hr class="hr_bordor">
			<?php if($details['category_id'] == 1){ ?>
				<h2 class="text-center">Package Details</h2>
			<?php } ?>
			<?php if($details['category_id'] == 2){ ?>
				<h2 class="text-center">Transport Details</h2>
			<?php } ?>
			<?php if($details['category_id'] == 3){ ?>
				<h2 class="text-center">Hotel Details</h2>
			<?php }?>
			<?php if($details['user_id'] != $this->request->session()->read('Auth.User.id')) {?>
				<?php //if(empty($details['final_id'])) { ?>
					<div class="tab text-center ">
						<!-- <a href="<?php //echo $this->Url->build(array('controller'=>'users','action'=>'acceptoffer',$id)) ?>">Accept Offer</a> -->
						<a href="javascript:void(0);" class="blockUser" user_id = "<?php echo $details['user_id']; ?>"> Block User</a>
						<?php if(empty($details["user_rating"])) { ?>
							<a data-toggle="modal" data-target="#myModal2" href="javascript:void(0);" onclick="f2('<?php echo $details['id']; ?>,<?php echo $details['user_id']; ?>');"> Rate User</a>
						<?php } else { ?>
							<a href="javascript:void(0);" onclick="alert('You have already rate this user.')">Rate User</a>
						<?php } ?>
					</div>
				<?php //} ?>
			<?php } ?>
            
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center box-event">
             <ul>
                  <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <p>
                            <b>Reference ID </b><br><?php echo $details['reference_id']; ?>
                       </p>
                   </li>
				 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <p>
                            <b>Total Budget </b><br>   <?php echo $details['total_budget']."/-"; ?>
                       </p>
                 </li>
				 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <p>
                            <b>Members  </b><br> <?php echo $details['adult']; ?>
                     </p>
                 </li>
				 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <p>
                            <b>Children </b> <br> <?php echo $details['children']; ?>
                     </p>
                 </li>
				<?php if($details['category_id'] == 1 || $details['category_id'] == 3){ ?>
                 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <p>
                        <b>Single </b> <br> <?php if($details['room1'] != ''){ echo $details['room1'];}else{ echo "-- --";} ?>
                     </p>
                 </li>
				 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <p>
                        <b>Double </b><br> <?php if($details['room1'] != ''){ echo $details['room1'];}else{ echo "-- --";} ?>
                    </p>
                 </li>
				 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <p>
                            <b>Triple </b><br> <?php if($details['room3'] != ''){ echo $details['room3'];}else{ echo "-- --";} ?>
                     </p>
                 </li>
				 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <p>
                            <b>Child With Bed  </b><br> <?php if($details['child_with_bed'] != ''){ echo $details['child_with_bed'];}else{ echo "-- --";} ?>
                     </p>
                 </li>
				 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <p>
                            <b>Child Without Bed </b> <br><?php if($details['child_without_bed'] != ''){ echo $details['child_without_bed'];}else{ echo "-- --";} ?>
                     </p>
                 </li>
				 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <p>
                            <b>Check In </b> <br><?php echo ($details['check_in'])?date("d/m/Y", strtotime($details['check_in'])):"-- --"; ?>
                     </p>
                 </li>
				 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <p>
                            <b>Check Out  </b> <br><?php echo ($details['check_out'])?date("d/m/Y", strtotime($details['check_out'])):"-- --"; ?>
                     </p>
                 </li>
				 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <p>
                            <b>Destination State </b> <br><?php echo ($details['state_id'])?$allStates[$details['state_id']]:"-- --"; ?>
                     </p>
                 </li>
				 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <p>
                            <b>Destination City </b> <br><?php echo ($details['city_id'])?$allCities[$details['city_id']]:"-- --"; ?>
                     </p>
                 </li>
				 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <p>
                            <b>Locality </b><br> <?php echo ($details['locality'])?$details['locality']:"-- --"; ?>
                     </p>
                 </li>
				 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <p>
                            <b>Hotel Category  :</b> <br>
                            <?php if(!empty($details['hotel_category'])) {
                                $result = explode(",", $details['hotel_category']);
                                $count = 1;
                                foreach($result as $row) {
                                    echo $count.". ".$hotelCategories[$row]."<br>";
                                    $count++;
                                }
                            } else {
                                echo "-- --";	
                            }?>
                        </p>
                  </li>
				  <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <p>
                            <b>Meal</b> <br><?php echo ($details['meal_plan'])?$mealPlanArray[$details['meal_plan']]:"-- --"; ?>
                      </p>
                 </li>
                </ul>
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left comment">
                         <b>Comment :</b> <?php echo $details['comment']; ?>
                     </div>
                 </div>
             </div>
                
             
					<?php if($details['category_id'] == 1){ 
						if(count($details['hotels']) >1) { 
							unset($details['hotels'][0]);?>
            
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">						
                 <h2 class="text-center">Another Destination Details</h2>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center box-event">
							<?php foreach($details['hotels'] as $row) { ?>
								
                                    <ul>
									 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <p>
                                            <b>Single </b> <br> <?php if($row['room1'] != ''){ echo $row['room1'];}else{ echo "-- --";} ?>
                                         </p>
                                    </li>
									<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <p>
                                            <b>Double </b> <br> <?php if($row['room1'] != ''){ echo $row['room1'];}else{ echo "-- --";} ?>
                                         </p>
                                    </li>
									<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <p>
                                            <b>Triple </b> <br> <?php if($row['room3'] != ''){ echo $row['room3'];}else{ echo "-- --";} ?>
                                        </p>
                                    </li>
								    <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <p>
                                            <b>Child With Bed  </b> <br> <?php if($row['child_with_bed'] != ''){ echo $row['child_with_bed'];}else{ echo "-- --";} ?>
                                        </p>
                                    </li>
									<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <p>
                                            <b>Child Without Bed  </b> <br><?php if($row['child_without_bed'] != ''){ echo $row['child_without_bed'];}else{ echo "-- --";} ?>
                                         </p>
                                    </li>
									<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <p>
                                            <b>Check In </b> <br><?php echo ($row['check_in'])?date("d/m/Y", strtotime($row['check_in'])):"-- --"; ?>
                                         </p>
                                    </li>
									<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <p>
                                            <b>Check Out </b> <br><?php echo ($row['check_out'])?date("d/m/Y", strtotime($row['check_out'])):"-- --"; ?>
                                         </p>
                                    </li>
									<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <p>
                                            <b>Destination State </b> <br> <?php echo ($row['state_id'])?$allStates[$row['state_id']]:"-- --"; ?>
                                         </p>
                                    </li>
									<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <p>
                                            <b>Destination City </b> <br> <?php echo ($row['city_id'])?$allCities[$row['city_id']]:"-- --"; ?>
                                        </p>
                                    </li>
									 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <p>
                                            <b>Locality </b> <?php echo ($row['locality'])?$row['locality']:"-- --"; ?>
                                        </p>
                                    </li>
									<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <p>
                                            <b>Hotel Category  :</b> <br>
                                            <?php if(!empty($row['hotel_category'])) {
                                                $result = explode(",", $row['hotel_category']);
                                                $count = 1;
                                                foreach($result as $row1) {
                                                    echo $count.". ".$hotelCategories[$row1]."<br>";
                                                    $count++;
                                                }
                                            } else {
                                                echo "-- --";	
                                            }?>
                                        </p>
                                    </li>
									<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <p>
                                            <b>Meal </b> <br> <?php echo ($row['meal_plan'])?$mealPlanArray[$row['meal_plan']]:"-- --"; ?>
                                        </p>
                                    </li>
                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left comment">
                                 <b>Comment :</b> <?php echo $details['comment']; ?>
                            </div>
                                 </ul>
								
							<?php } ?>
								</div>
                    </div>
						<?php } ?>                   
            
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="text-center">Transport Requirements</h2>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center box-event">
                    <ul>
						 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <p>
                                <b>Vehicle </b> <br><?php echo ($details['transport_requirement'])?$transpoartRequirmentArray[$details['transport_requirement']]:"-- --"; ?>
                             </p>
                         </li>
						 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <p>
                                <b>Start Date </b> <br><?php echo ($details['start_date'])?date("d/m/Y", strtotime($details['start_date'])):"-- --"; ?>
                             </p>
                        </li>
                        <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <p>
                                <b>End Date </b> <br><?php echo ($details['end_date'])?date("d/m/Y", strtotime($details['end_date'])):"-- --"; ?>
                            </p>
                        </li>
						
				        <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <p>
                                <b>Pickup State </b><br> <?php echo ($details['pickup_state'])?$allStates[$details['pickup_state']]:"-- --"; ?>
                            </p>
                        </li>
						<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <p>
                                <b>Pickup City </b> <br> <?php echo ($details['pickup_city'])?$allCities[$details['pickup_city']]:"-- --"; ?>
                            </p>
                        </li>
                        <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <p>
                                <b>Pickup Locality </b> <br><?php echo ($details['pickup_locality'])?$details['pickup_locality']:"-- --"; ?>
                            </p>
                        </li>
						
						<?php if(!empty($details['request_stops'])) { ?>
							<h2>Stops</h2>
							<?php foreach($details['request_stops'] as $stops) {?>
								 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <p>
                                        <b>Stop Locality </b> <br><?php echo ($stops['locality'])?$stops['locality']:"-- --"; ?>
                                     </p>
                                </li>
								<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <p>
                                        <b>Stop City </b><br> <?php echo ($stops['city_id'])?$allCities[$stops['city_id']]:"-- --"; ?>
                                    </p>
                                </li>
								<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <p>
                                        <b>Stop State </b><br> <?php echo ($stops['state_id'])?$allStates[$stops['state_id']]:"-- --"; ?>
                                    </p>
                                </li>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left comment">
                             <b>Comment :</b> <?php echo $details['comment']; ?>
                        </div>
								<hr>
							<?php }
						} ?>
					<?php }
				} else if($details['category_id'] == 2){ ?>
					 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <p>
                                <b>Vehicle </b> <br><?php echo ($details['transport_requirement'])?$transpoartRequirmentArray[$details['transport_requirement']]:"-- --"; ?>
                         </p>
                     </li>
					 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <p>
                                <b>Start Date </b> <br> <?php echo ($details['start_date'])?date("d/m/Y", strtotime($details['start_date'])):"-- --"; ?>
                         </p>
                     </li>
					 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <p>
                                <b>End Date </b> <br><?php echo ($details['end_date'])?date("d/m/Y", strtotime($details['end_date'])):"-- --"; ?>
                         </p>
                     </li>
					 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <p>
                                <b>Pickup State </b> <br><?php echo ($details['pickup_state'])?$allStates[$details['pickup_state']]:"-- --"; ?>
                           </p>
                     </li>
                     <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <p>
                                <b>Pickup City </b> <br><?php echo ($details['pickup_city'])?$allCities[$details['pickup_city']]:"-- --"; ?>
                         </p>
                     </li>
					 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <p>
                                <b>Pickup Locality </b> <br><?php echo ($details['pickup_locality'])?$details['pickup_locality']:"-- --"; ?>
                         </p>
                     </li>
					 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <p>
                                <b>Final State </b> <br><?php echo ($details['final_state'])?$allStates[$details['final_state']]:"-- --"; ?>
                         </p>
                     </li>
					 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <p>
                                <b>Final City </b><br> <?php echo ($details['final_city'])?$allCities[$details['final_city']]:"-- --"; ?>
                         </p>
                     </li>
					<?php if(!empty($details['request_stops'])) { ?>
						<h2>Stops</h2>
						<?php foreach($details['request_stops'] as $stops) {?>
							 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <p>
                                    <b>Stop Locality </b><br> <?php echo ($stops['locality'])?$stops['locality']:"-- --"; ?>
                                 </p>
                            </li>
							 <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <p>
                                    <b>Stop City </b> <br><?php echo ($stops['city_id'])?$allCities[$stops['city_id']]:"-- --"; ?>
                                 </p>
                            </li>
							<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <p>
                                    <b>Stop State </b> <?php echo ($stops['state_id'])?$allStates[$stops['state_id']]:"-- --"; ?>
                                </p>
                            </li>
                          </ul>
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left comment">
                         <b>Comment :</b> <?php echo $details['comment']; ?>
                    </div>
							<hr>
						<?php }
					} ?>
				<?php }?>
              
				
			     </div>
			 </div>
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
					<?php  echo $this->Form->create("Users", ['type' => 'file', 'url' => ['controller' => 'Users', 'action' => 'rateUser'], 'id'=>"UserRatingForm"]); ?>
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



