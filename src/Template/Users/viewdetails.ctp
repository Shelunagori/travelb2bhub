 <style>
.head_of_popup 
{
 background-color: #eaeaea;
 text-align:left !important;
 padding:5px !important;
}
h3 {
	margin:0px !important;
    font-size: 18px !important;	
}
 
li {
	margin-top: 7px;
	text-align:left
}
ul li b {
	color:#424242;
	text-align:left;
	font-weight:100 !important;
}

</style>
 
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <span style="font-weight: 100;font-size:18px">
			<?php 
			if ($details['category_id'] == 1)
			{ ?>
				Package Details<?php
			} ?><?php

			if ($details['category_id'] == 2)
			{ ?>
				Transport Details<?php
			} ?><?php

			if ($details['category_id'] == 3)
			{ ?>
				Hotel Details<?php
			} ?>
		  </span>
        </div>
        <div class="modal-body">
			<div class="col-md-12">
			<br>
				<div class="head_of_popup"><span style="color:#1295A2;font-weight: 100;font-size:18px">General Requirements</span></div>
				<ul>
					<li class="col-md-6"><p>Reference ID:  &nbsp;<span style="color:#FB6542"><?php
					echo $details['reference_id']; ?></span></li>
 
					<?php $total_budget=round($details['total_budget']);  ?>
					<li class="col-md-6"><p>Total Budget:  &nbsp;
					<span style="color:#1295A2">  &#8377;
						<?php echo ($total_budget)? "". ($total_budget): "-- --" ?>
					</span>
					</li>
  
 					<li class="col-md-6"><p>Adult:  &nbsp; <?php
					echo "<b>".$details['adult']."</b>"; ?></li>
					<li class="col-md-6"><p>Children below 6:  &nbsp; <b><?php
					echo $details['children']; ?></b></li>
				</ul>
			 </div>
			
		<?php
		if ($details['category_id'] == 1 || $details['category_id'] == 3)
		{  
			if ($details['category_id'] == 1)
			{
				if (count($details['hotels']) >= 1)
				{ ?>
			<div class="col-md-12">
					<div class="head_of_popup"><span style="color:#1295A2;font-weight: 100;font-size:18px">Stay Requirements</span></div> 
					<?php
					$ds_count = 1;
					foreach($details['hotels'] as $row)
					{ ?>
					<fieldset>
					<legend style="text-align:left !important; color:#A99E36;"><h5> &nbsp; Destination <?php
						echo $ds_count; ?> &nbsp;  </h5></legend>
						<div class="col-md-12">
						<p>Number of Rooms:</p>
						</div>
 						<ul>
						<table >
						<tr style="background-color:#ECF0F5 !important;">
						<td>
						<li class="col-md-4"><p>Single: &nbsp;
						<b>
						<?php
						if ($row['room1'] != '')
						{
							echo $row['room1'];
						}
						else
						{
							echo "--";
						} ?>
						</b>
						</li>
						<li class="col-md-4"><p>Double: &nbsp;
						<b>
						<?php
						if ($row['room2'] != '')
						{
							echo $row['room2'];
						}
						else
						{
							echo "--";
						} ?></b>
						</li>
						
						
						<li class="col-md-4"><p>Triple: &nbsp;
						<b>
						<?php
						if ($row['room3'] != '')
						{
							echo $row['room3'];
						}
						else
						{
							echo "--";
						} ?>
						</b>
						</li>
						<li class="col-md-6"><p>Child With Bed: &nbsp;
						<b>
						<?php
						if ($row['child_with_bed'] != '')
						{
							echo $row['child_with_bed'];
						}
						else
						{
							echo "-- --";
						} ?>
						</b>
						</li>
						<li class="col-md-6"><p>Child Without Bed: &nbsp;
						<b>
						<?php
						if ($row['child_without_bed'] != '')
						{
							echo $row['child_without_bed'];
						}
						else
						{
							echo "-- --";
						} ?>
						</b>
						</li>
						</td>
						</tr>
						</table>
						<li class="col-md-12"><p>Hotel Category: &nbsp;
						<b>
						<?php
						if (!empty($row['hotel_category']))
						{
							$result = explode(",", $row['hotel_category']);
							$count = 1;
							$hotel_category = array();
							foreach($result as $row1)
							{
 								@$hotel_category[]=$hotelCategories[$row1]; 
 								$count++;
							}
							echo $hotel_category=implode(', ',$hotel_category);
						}
						else
						{
							echo "-- --";
						} ?>
						</b>
						</li>
						<li class="col-md-6"><p>Hotel Rating: &nbsp;
						<?php
						if ($row['hotel_rating'] > 0)
						{
							for ($i = $row['hotel_rating']; $i > 0; $i--)
							{
								echo '<i class="fa fa-star" style="color:#F5EA81;"></i>';
							}
						}
						else
						{
						}
						?>
						</li>
						<li class="col-md-6"><p>Meal: &nbsp;
						<b>
						<?php
						echo ($row['meal_plan']) ? $mealPlanArray[$row['meal_plan']]:  "-- --"; ?>
						</b></li>
						<li class="col-md-6"><p>Check In: &nbsp; <b><?php
						echo ($row['check_in']) ? date("d-m-Y", strtotime($row['check_in'])):  "-- --"; ?>
						</b></li>
						<li class="col-md-6">
							<p>Check Out: &nbsp;<b><?php
						echo ($row['check_out']) ? date("d-m-Y", strtotime($row['check_out'])):  "-- --"; ?>
						</b></li>
						<li class="col-md-6"><p>Locality: &nbsp;<b><?php
						echo ($row['locality']) ? $row['locality']:  "-- --"; ?>
						</b></li>
						<li class="col-md-6">
							<p>Destination City: &nbsp;<b><?php
						echo ($row['city_id']) ? $allCities[$row['city_id']]:  "-- --"; ?>
						</b></li>
						<li class="col-md-6"><p>Destination State: &nbsp;<b><?php
						echo ($row['state_id']) ? $allStates[$row['state_id']]:  "-- --"; ?>
						</b></ul>
					</fieldset>	 
						<?php
						$ds_count++;
					} ?>
				 
				<?php
				} ?> <br />
				</div>
		<div class="col-md-12">
				    <div class="head_of_popup"><span style="color:#1295A2;font-weight: 100;font-size:18px">Transport Requirements</span></div>
			<ul>
				<li class="col-md-12 ">
				<p>Transport: &nbsp;
					<b><?php 
					echo ($details['transport_requirement']) ? $transpoartRequirmentArray[$details['transport_requirement']]:  "-- --"; ?>
				</b></p>
				</li>
				<li class="col-md-6">
				<p>Start Date: &nbsp;<b><?php
					echo ($details['start_date']) ? date("d-m-Y", strtotime($details['start_date'])):  "-- --"; ?>
				</b></p>
				</li>
				<li class="col-md-6">
				<p>End Date: &nbsp;<b><?php
					echo ($details['end_date']) ? date("d-m-Y", strtotime($details['end_date'])):  "-- --"; ?>
				</b></p>
				</li>
				<li class="col-md-12" style="color:#6B7120;margin-top:10px;">
					Pickup Location
					<hr style="margin-bottom:-1px !important;margin-top: 3px!important;" />
				</li>
				<li class="col-md-6">
				<p>Pickup Locality: &nbsp;<b><?php
				echo ($details['pickup_locality']) ? $details['pickup_locality']:  "-- --"; ?>
				</b></p>
				</li>
				<li class="col-md-6">
				<p>Pickup City: &nbsp;<b><?php
				echo ($details['pickup_city']) ? $allCities[$details['pickup_city']]:  "-- --"; ?>
				</b></p>
				</li>
				<li class="col-md-6">
				<p>Pickup State: &nbsp;<b><?php
				echo ($details['pickup_state']) ? $allStates[$details['pickup_state']]:  "-- --"; ?>
				</b></p>
				</li>
				<?php
				if (!empty($details['request_stops']))
				{ ?><?php
					$stop_count = 1;
					foreach($details['request_stops'] as $stops)
					{ ?>
					 
					<li class="col-md-12" style="color:#6B7120;margin-top:10px;">
						Stop <?php	echo $stop_count; ?>
						<hr style="margin-bottom:-1px !important;margin-top: 3px!important;" />
					</li>
						<li class="col-md-6">
							<p>Stop Locality: &nbsp;<b><?php
								echo ($stops['locality']) ? $stops['locality']:  "-- --"; ?>
							</b></p>
						</li>
						<li class="col-md-6">
							<p>Stop City: &nbsp;<b><?php
								echo ($stops['city_id']) ? $allCities[$stops['city_id']]:  "-- --"; ?>
							</b></p>
						</li>
						<li class="col-md-6">
							<p>Stop State: &nbsp;<b><?php
								echo ($stops['state_id']) ? $allStates[$stops['state_id']]:  "-- --"; ?>
							</b></p>
						</li>
						<?php
						$stop_count++;
					}
				} ?>
				<li class="col-md-12" style="color:#6B7120;margin-top:10px;">
					Final Location
					<hr style="margin-bottom:-1px !important;margin-top: 3px!important;" />
				</li>
				<li class="col-md-6">
					<p>Final Locality: &nbsp;<b><?php
						echo ($details['final_locality']) ? $details['final_locality']:  "-- --"; ?>
					</b></p>
				</li>
				<li class="col-md-6">
					<p>Final City: &nbsp;<b><?php
						echo ($details['final_city']) ? $allCities[$details['final_city']]:  "-- --"; ?>
					</b></p>
				</li>
				<li class="col-md-6">
					<p>Final State: &nbsp;<b><?php
						echo ($details['final_state']) ? $allStates[$details['final_state']]:  "-- --"; ?>
					</b></p>
				</li>
			</ul>
		</div>
		<?php
		}
		elseif ($details['category_id'] == '3')
		{ ?>
			<div class="col-md-12">
			<div class="head_of_popup"><span style="color:#1295A2;font-weight: 100;font-size:18px">Stay Requirements</span></div>
			
			<?php
			$ds_count = 1;
			foreach($details['hotels'] as $row)
			{ ?>
				<div class="col-md-12">
					<p>Number of Rooms:</p>
				</div>
				<ul>
					<table >
						<tr style="background-color:#ECF0F5 !important;">
						<td>
					<li class="col-md-4"><p>Single: &nbsp;<b><?php
					if ($row['room1'] != '')
					{
						echo $row['room1'];
					}
					else
					{
						echo "--";
					} ?>
					</b>
					</p>
					</li>
					<li class="col-md-4"><p>Double: &nbsp;<b><?php
					if ($row['room2'] != '')
					{
						echo $row['room2'];
					}
					else
					{
						echo "--";
					} ?>
					</b>
					</p>
					</li>
					<li class="col-md-4"><p>Triple: &nbsp;<b><?php
					if ($row['room3'] != '')
					{
						echo $row['room3'];
					}
					else
					{
						echo "--";
					} ?>
					</b>
					</p>
					</li>
					<li class=" col-md-6 "><p>Child With Bed: &nbsp;<b><?php
					if ($row['child_with_bed'] != '')
					{
						echo $row['child_with_bed'];
					}
					else
					{
						echo "-- --";
					} ?>
					</b>
					</p>
					</li>
					<li class="  col-md-6"><p>Child Without Bed: &nbsp;<b><?php
					if ($row['child_without_bed'] != '')
					{
						echo $row['child_without_bed'];
					}
					else
					{
						echo "-- --";
					} ?></b>
					</p>
					</li>
					</td>
					</tr>
					</table>
					<li class="col-md-12 "><p>Hotel Category: &nbsp;<b><?php
					$hotel_category = array();
					if (!empty($row['hotel_category']))
					{
						$result = explode(",", $row['hotel_category']);
						$count = 1;
						foreach($result as $row1)
						{
							$hotel_category[]=$hotelCategories[$row1];
							$count++;
						}
						echo $hotel_category=implode(', ',$hotel_category);
					}
					else
					{
						echo "-- --";
					} ?>
					</b>
					</p>
					</li>
					<li class="col-md-6 "><p>Hotel Rating: &nbsp;<?php
					if ($row['hotel_rating'] > 0)
					{
						for ($i = $row['hotel_rating']; $i > 0; $i--)
						{
							echo '<i class="fa fa-star" style="color:#F5EA81;"></i>';
						}
					}
					else
					{
					}

					?>
					</p>
					</li>
					<li class="col-md-6  col-offset-right-1">
					<p>Meal: &nbsp;<b><?php
					echo ($row['meal_plan']) ? $mealPlanArray[$row['meal_plan']]:  "-- --"; ?>
					</b></p>
					</li>
					<li class="col-md-6 ">
					<p>Check In: &nbsp;<b><?php
					echo ($row['check_in']) ? date("d-m-Y", strtotime($row['check_in'])):  "-- --"; ?>
					</b></p>
					</li>
					<li class=" col-md-6 ">
					<p>Check Out: &nbsp;<b><?php
					echo ($row['check_out']) ? date("d-m-Y", strtotime($row['check_out'])):  "-- --"; ?>
					</b></p>
					</li>
					<li class="col-md-6 ">
					<p>Locality: &nbsp;<b><?php
					echo ($row['locality']) ? $row['locality']:  "-- --"; ?>
					</b></p>
					</li>
					<li class="col-md-6 ">
					<p>Destination City: &nbsp;<b><?php
					if (empty($row['city_id']))
					{
						echo $allCities[$details['city_id']];
					}
					else
					{
						$allCities[$row['city_id']];
					} ?>
					</b></p>
					</li>
					<li class="col-md-6 "><p>Destination State: &nbsp;<b><?php
					if (empty($row['state_id']))
					{
						echo $allStates[$details['state_id']];
					}
					else
					{
						$allStates[$row['state_id']];
					} ?>
					</b></p>
					</li>
				</ul><?php
				$ds_count++;
			} ?>
			</div><?php
		}
	}
	else
	if ($details['category_id'] == 2)
	{ ?>
		<div class="col-md-12">
		<div class="head_of_popup"><span style="color:#1295A2;font-weight: 100;font-size:18px">Transport Requirements</span></div>
			<ul>
				<li class="col-md-6">
				<p>Transport: &nbsp;<b><?php
					echo ($details['transport_requirement']) ? $transpoartRequirmentArray[$details['transport_requirement']]:  "-- --"; ?>
				</b></p>
				</li>
				<li class="col-md-6">
				<p>Start Date: &nbsp;<b><?php
					echo ($details['start_date']) ? date("d-m-Y", strtotime($details['start_date'])):  "-- --"; ?>
				</b></p>
				</li>
				<li class="col-md-6">
				<p>End Date: &nbsp;<b><?php
					echo ($details['end_date']) ? date("d-m-Y", strtotime($details['end_date'])):  "-- --"; ?>
				</b></p>
				</li>
				
				<li class="col-md-12" style="color:#6B7120;margin-top:10px;">
					Pickup Location
					<hr style="margin-bottom:-1px !important;margin-top: 3px!important;" />
				</li>
				<li class="col-md-6">
				<p>Pickup Locality: &nbsp;<b><?php
					echo ($details['pickup_locality']) ? $details['pickup_locality']:  "-- --"; ?>
				</b></p>
				</li>
				<li class="col-md-6">
				<p>Pickup City: &nbsp;<b><?php
					echo ($details['pickup_city']) ? $allCities[$details['pickup_city']]:  "-- --"; ?>
				</b></p>
				</li>
				<li class="col-md-12">
				<p>Pickup State: &nbsp;<b><?php
					echo ($details['pickup_state']) ? $allStates[$details['pickup_state']]:  "-- --"; ?>
				</b></p>
				</li><?php
				if (!empty($details['request_stops']))
				{ ?><?php
					$stop_count = 1;
					foreach($details['request_stops'] as $stops)
					{ ?>
					
						<li class="col-md-12" style="color:#6B7120;margin-top:10px;">
							Stop <?php echo $stop_count; ?>
							<hr style="margin-bottom:-1px !important;margin-top: 3px!important;" /></li>
						<li class="col-md-6">
							<p>Stop Locality: &nbsp;<b><?php
							echo ($stops['locality']) ? $stops['locality']:  "-- --"; ?>
							</b></p>
						</li>
						<li class="col-md-6">
							<p>Stop City: &nbsp;<b><?php
							echo ($stops['city_id']) ? $allCities[$stops['city_id']]:  "-- --"; ?>
							</b></p>
						</li>
						<li class="col-md-6">
							<p>Stop State: &nbsp;<b><?php
							echo ($stops['state_id']) ? $allStates[$stops['state_id']]:  "-- --"; ?>
							</b></p>
						</li><?php
						$stop_count++;
					}
				} ?>
				<li class="col-md-12" style="color:#6B7120;margin-top:10px;">
					Final Location
					<hr style="margin-bottom:-1px !important;margin-top: 3px!important;" />
				</li>
				<li class="col-md-6">
				<p>Final Locality: &nbsp;<b><?php
				echo ($details['final_locality']) ? $details['final_locality']:  "-- --"; ?>
				</b></p>
				</li>
				<li class="col-md-6">
				<p>Final City: &nbsp;<b><?php
				echo ($details['final_city']) ? $allCities[$details['final_city']]:  "-- --"; ?>
				</b></p>
				</li>
				<li class="col-md-6">
				<p>Final State: &nbsp;<b><?php
				echo ($details['final_state']) ? $allStates[$details['final_state']]:  "-- --"; ?>
				</b></p>
				</li>
			</ul>
		</div>
		<?php
	} 
	
	if (!empty($details['comment']))
	{
		if ($details['category_id'] == 2 || $details['category_id'] == 1)
		{
			$comment_class = "tcomments";
		}
		else
		{
			$comment_class = "comments";
		}

	?>
	
		<div class="col-md-12"><div class="head_of_popup"><span style="color:#1295A2;font-weight: 100;font-size:18px">Comments</span></div>
			<ul>
				<li class="col-md-12  comment text-left">
					<p><b><?php echo $details['comment']; ?>
					</b></p>
				</li>
			</ul>
		</div>
	<?php
	} ?>
	<div class="modal-footer">
		<button class="btn btn-danger btn-sm"data-dismiss=modal type=button>Close</button>
	</div>
</div>
</div>

<div class="fade modal"id=myModal2 role=dialog>
	<div class=modal-dialog>
		<div class=modal-content>
			<div class=modal-header>
				<button class=close data-dismiss=modal type=button>×</button>
				<h4 class=modal-title>Details</h4>
			</div>
			<div class=modal-body>
				<div class="text-center form"><?php
					echo $this->Form->create("Users", ['type' => 'file', 'url' => ['controller' => 'Users', 'action' => 'rateUser'], 'id' => "UserRatingForm"]); ?>
					<input id=rating_request_id name=rating_request_id type=hidden> 
					<input id=rating_user_id name=rating_user_id type=hidden>
					<h2>Select Rating</h2>
					<fieldset class=rating id=demo1>
						<input id=star5 name=rating type=radio class=stars value=5>
						<label class=full for=star5 title="Awesome - 5 stars"></label>
						
						<input id=star4 name=rating type=radio class=stars value=4>
						<label class=full for=star4 title="Pretty good - 4 stars"></label>
						
						<input id=star3 name=rating type=radio class=stars value=3>
						<label class=full for=star3 title="Meh - 3 stars"></label>
						
						<input id=star2 name=rating type=radio class=stars value=2>
						<label class=full for=star2 title="Kinda bad - 2 stars"></label>
						
						<input id=star1 name=rating type=radio class=stars value=1>
						<label class=full for=star1 title="Sucks big time - 1 star"></label>
					</fieldset>
					<div style=clear:both></div>
				</div>
			</div>
			<div class=modal-footer>
				<button class="btn btn-sm btn-danger" data-dismiss=modal type=button>Close</button>
			</div>
		</div>
	</div>
</div> 