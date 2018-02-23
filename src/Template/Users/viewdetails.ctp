 <style>
.head_of_popup 
{
 background-color: #E6E7E8;
 text-align:left !important;
 padding:10px !important;
}
h3 {
	margin:0px !important; 
}
.modal-body{
	text-align:left !important;
}
li {
	    margin-top: 7px;
}
ul li b {
	color:#96989A;
}
 </style>
 
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
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
		  </h4>
        </div>
        <div class="modal-body">
			<div class="col-md-12">
				<div class="head_of_popup"><h3>General Requirements</h3></div>
				<ul>
					<li class="col-md-12"><p><b>Reference ID : &nbsp;</b><span style="color:#FB6542"><?php
					echo $details['reference_id']; ?></span>
					<li class="col-md-12"><p><b>Total Budget : &nbsp;</b><span style="color:#1295A2"><?php
					echo $details['total_budget'] . " Rs."; ?></span>
					<li class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><p><b>Adult : &nbsp;</b><?php
					echo $details['adult']; ?>
					<li class="col-xs-6 col-lg-6 col-md-6 col-sm-6	"><p><b>Children below 6 : &nbsp;</b><?php
					echo $details['children']; ?></li>
				</ul>
			 </div>
			<div class="col-md-12">
		<?php
		if ($details['category_id'] == 1 || $details['category_id'] == 3)
		{  
			if ($details['category_id'] == 1)
			{
				if (count($details['hotels']) >= 1)
				{ ?>
					<div class="head_of_popup"><h3>Stay Requirements</h3></div> 
					<?php
					$ds_count = 1;
					foreach($details['hotels'] as $row)
					{ ?>
					 
					<legend style="text-align:left !important; color:#1395A2"><h5>Destination <?php
						echo $ds_count; ?></h5></legend>
						 
						<ul>
						<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p><b>Single :&nbsp;</b><?php
						if ($row['room1'] != '')
						{
							echo $row['room1'];
						}
						else
						{
							echo "--";
						} ?><li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p><b>Double :&nbsp;</b><?php
						if ($row['room2'] != '')
						{
							echo $row['room2'];
						}
						else
						{
							echo "--";
						} ?><li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p><b>Triple :&nbsp;</b><?php
						if ($row['room3'] != '')
						{
							echo $row['room3'];
						}
						else
						{
							echo "--";
						} ?><li class="col-xs-12 col-lg-4 col-md-4 col-sm-4"><p><b>Child With Bed :&nbsp;</b><?php
						if ($row['child_with_bed'] != '')
						{
							echo $row['child_with_bed'];
						}
						else
						{
							echo "-- --";
						} ?><li class="col-xs-12 col-sm-6 col-lg-6 col-md-6"><p><b>Child Without Bed :&nbsp;</b><?php
						if ($row['child_without_bed'] != '')
						{
							echo $row['child_without_bed'];
						}
						else
						{
							echo "-- --";
						} ?><li class="col-xs-12 col-lg-12 col-md-12 col-sm-12"><p><b>Hotel Category :&nbsp;</b><?php
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
						} ?><li class="col-xs-12 col-lg-4 col-md-4 col-sm-4"><p><b>Hotel Rating :&nbsp;</b><?php
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
 
		?><li class="col-xs-12 col-sm-6 col-lg-6 col-md-6 col-offset-right-1"><p><b>Meal :&nbsp;</b><?php
						echo ($row['meal_plan']) ? $mealPlanArray[$row['meal_plan']] : "-- --"; ?><li class="col-lg-4 col-md-4 col-sm-4 col-xs-6"><p><b>Check In :&nbsp;</b><?php
						echo ($row['check_in']) ? date("d/m/Y", strtotime($row['check_in'])) : "-- --"; ?><li class="col-xs-6 col-lg-6 col-md-6 col-sm-6"><p><b>Check Out :&nbsp;</b><?php
						echo ($row['check_out']) ? date("d/m/Y", strtotime($row['check_out'])) : "-- --"; ?><li class="col-xs-12 col-lg-4 col-md-4 col-sm-4"><p><b>Locality :&nbsp;</b><?php
						echo ($row['locality']) ? $row['locality'] : "-- --"; ?><li class="col-xs-12 col-lg-4 col-md-4 col-sm-4"><p><b>Destination City :&nbsp;</b><?php
						echo ($row['city_id']) ? $allCities[$row['city_id']] : "-- --"; ?><li class="col-xs-12 col-lg-4 col-md-4 col-sm-4"><p><b>Destination State :&nbsp;</b><?php
						echo ($row['state_id']) ? $allStates[$row['state_id']] : "-- --"; ?>
						</ul>
						 
						<?php
						$ds_count++;
					} ?>
				 
				<?php
				} ?>
				</div>
				<div class="col-md-12">
				    <div class="head_of_popup"><h3>Transport Requirements</h3></div>
			<ul>
				<li class="col-xs-12 col-lg-12 col-md-12 col-sm-6">
				<p><b>Transport :&nbsp;</b>
					<?php
					echo ($details['transport_requirement']) ? $transpoartRequirmentArray[$details['transport_requirement']] : "-- --"; ?>
				</p>
				</li>
				<li class="col-md-6">
				<p><b>Start Date :&nbsp;</b><?php
					echo ($details['start_date']) ? date("d/m/Y", strtotime($details['start_date'])) : "-- --"; ?>
				</p>
				</li>
				<li class="col-md-6">
				<p><b>End Date :&nbsp;</b><?php
					echo ($details['end_date']) ? date("d/m/Y", strtotime($details['end_date'])) : "-- --"; ?>
				</p>
				</li>
				<li class="col-md-6">
				<p><b>Pickup Locality :&nbsp;</b><?php
				echo ($details['pickup_locality']) ? $details['pickup_locality'] : "-- --"; ?>
				</p>
				</li>
				<li class="col-md-6">
				<p><b>Pickup City :&nbsp;</b><?php
				echo ($details['pickup_city']) ? $allCities[$details['pickup_city']] : "-- --"; ?>
				</p>
				</li>
				<li class="col-md-6">
				<p><b>Pickup State :&nbsp;</b><?php
				echo ($details['pickup_state']) ? $allStates[$details['pickup_state']] : "-- --"; ?>
				</p>
				</li>
				<?php
				if (!empty($details['request_stops']))
				{ ?><?php
					$stop_count = 1;
					foreach($details['request_stops'] as $stops)
					{ ?>
					<fieldset><legend>Stop <?php	echo $stop_count; ?></legend>
						 
						<li class="col-md-6">
							<p><b>Stop Locality :&nbsp;</b><?php
								echo ($stops['locality']) ? $stops['locality'] : "-- --"; ?>
							</p>
						</li>
						<li class="col-md-6">
							<p><b>Stop City :&nbsp;</b><?php
								echo ($stops['city_id']) ? $allCities[$stops['city_id']] : "-- --"; ?>
							</p>
						</li>
						<li class="col-md-6">
							<p><b>Stop State :&nbsp;</b><?php
								echo ($stops['state_id']) ? $allStates[$stops['state_id']] : "-- --"; ?>
							</p>
						</li>
					</fieldset>
						<?php
						$stop_count++;
					}
				} ?>
				
				<li class="col-md-6">
					<p><b>Final Locality :&nbsp;</b><?php
						echo ($details['final_locality']) ? $details['final_locality'] : "-- --"; ?>
					</p>
				</li>
				<li class="col-md-6">
					<p><b>Final City :&nbsp;</b><?php
						echo ($details['final_city']) ? $allCities[$details['final_city']] : "-- --"; ?>
					</p>
				</li>
				<li class="col-md-6">
					<p><b>Final State :&nbsp;</b><?php
						echo ($details['final_state']) ? $allStates[$details['final_state']] : "-- --"; ?>
					</p>
				</li>
			</ul>
			</div>
		<?php
		}
		elseif ($details['category_id'] == '3')
		{ ?>
			<div class="col-md-12">
			<div class="head_of_popup"><h3>Stay Requirements</h3></div>
			
			<?php
			$ds_count = 1;
			foreach($details['hotels'] as $row)
			{ ?>
				<ul>
					<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p><b>Single :&nbsp;</b><?php
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
					<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p><b>Double :&nbsp;</b><?php
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
					<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p><b>Triple :&nbsp;</b><?php
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
					<li class="col-xs-12 col-lg-4 col-md-4 col-sm-4"><p><b>Child With Bed :&nbsp;</b><?php
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
					<li class="col-xs-12 col-sm-6 col-lg-6 col-md-6"><p><b>Child Without Bed :&nbsp;</b><?php
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
					<li class="col-xs-12 col-lg-12 col-md-12 col-sm-12"><p><b>Hotel Category :&nbsp;</b><?php
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
					<li class="col-xs-12 col-lg-4 col-md-4 col-sm-4"><p><b>Hotel Rating :&nbsp;</b><?php
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
					<p><b>Meal :&nbsp;</b><?php
					echo ($row['meal_plan']) ? $mealPlanArray[$row['meal_plan']] : "-- --"; ?>
					</p>
					</li>
					<li class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
					<p><b>Check In :&nbsp;</b><?php
					echo ($row['check_in']) ? date("d/m/Y", strtotime($row['check_in'])) : "-- --"; ?>
					</p>
					</li>
					<li class="col-xs-6 col-lg-6 col-md-6 col-sm-6">
					<p><b>Check Out :&nbsp;</b><?php
					echo ($row['check_out']) ? date("d/m/Y", strtotime($row['check_out'])) : "-- --"; ?>
					</p>
					</li>
					<li class="col-xs-12 col-lg-4 col-md-4 col-sm-4">
					<p><b>Locality :&nbsp;</b><?php
					echo ($row['locality']) ? $row['locality'] : "-- --"; ?>
					</p>
					</li>
					<li class="col-xs-12 col-lg-4 col-md-4 col-sm-4">
					<p><b>Destination City :&nbsp;</b><?php
					if (empty($row['city_id']))
					{
						echo $allCities[$details['city_id']];
					}
					else
					{
						$allCities[$row['city_id']];
					} ?>
					</p>
					</li>
					<li class="col-xs-12 col-lg-4 col-md-4 col-sm-4"><p><b>Destination State :&nbsp;</b><?php
					if (empty($row['state_id']))
					{
						echo $allStates[$details['state_id']];
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
			</div><?php
		}
	}
	else
	if ($details['category_id'] == 2)
	{ ?>
		<div class="col-md-12">
		<div class="head_of_popup"><h3>Transport Requirements</h3></div>
			<ul>
				<li class="col-md-6">
				<p><b>Transport :&nbsp;</b><?php
					echo ($details['transport_requirement']) ? $transpoartRequirmentArray[$details['transport_requirement']] : "-- --"; ?>
				</p>
				</li>
				<li class="col-md-6">
				<p><b>Start Date :&nbsp;</b><?php
					echo ($details['start_date']) ? date("d/m/Y", strtotime($details['start_date'])) : "-- --"; ?>
				</p>
				</li>
				<li class="col-md-6">
				<p><b>End Date :&nbsp;</b><?php
					echo ($details['end_date']) ? date("d/m/Y", strtotime($details['end_date'])) : "-- --"; ?>
				</p>
				</li>
				<li class="col-md-6">
				<p><b>Pickup Locality :&nbsp;</b><?php
					echo ($details['pickup_locality']) ? $details['pickup_locality'] : "-- --"; ?>
				</p>
				</li>
				<li class="col-md-6">
				<p><b>Pickup City :&nbsp;</b><?php
					echo ($details['pickup_city']) ? $allCities[$details['pickup_city']] : "-- --"; ?>
				</p>
				</li>
				<li class="col-md-6">
				<p><b>Pickup State :&nbsp;</b><?php
					echo ($details['pickup_state']) ? $allStates[$details['pickup_state']] : "-- --"; ?>
				</p>
				</li><?php
				if (!empty($details['request_stops']))
				{ ?><?php
					$stop_count = 1;
					foreach($details['request_stops'] as $stops)
					{ ?>
					<fieldset><legend>Stop <?php echo $stop_count; ?></legend>
						<li class="col-md-6">
							<p><b>Stop Locality :&nbsp;</b><?php
							echo ($stops['locality']) ? $stops['locality'] : "-- --"; ?>
							</p>
						</li>
						<li class="col-md-6">
							<p><b>Stop City :&nbsp;</b><?php
							echo ($stops['city_id']) ? $allCities[$stops['city_id']] : "-- --"; ?>
							</p>
						</li>
						<li class="col-md-6">
							<p><b>Stop State :&nbsp;</b><?php
							echo ($stops['state_id']) ? $allStates[$stops['state_id']] : "-- --"; ?>
							</p>
						</li> 
						</fieldset><?php
						$stop_count++;
					}
				} ?>
				<li class="col-md-6">
				<p><b>Final Locality :&nbsp;</b><?php
				echo ($details['final_locality']) ? $details['final_locality'] : "-- --"; ?>
				</p>
				</li>
				<li class="col-md-6">
				<p><b>Final City :&nbsp;</b><?php
				echo ($details['final_city']) ? $allCities[$details['final_city']] : "-- --"; ?>
				</p>
				</li>
				<li class="col-md-6">
				<p><b>Final State :&nbsp;</b><?php
				echo ($details['final_state']) ? $allStates[$details['final_state']] : "-- --"; ?>
				</p>
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
	
		<div class="col-md-12"><div class="head_of_popup"><h3>Comments</h3></div>
			<ul>
				<li class="col-xs-12 col-lg-12 col-md-12 col-sm-12 comment text-left">
					<p><?php echo $details['comment']; ?>
					</p>
				</li>
			</ul>
		</div>
	<?php
	} ?>
	<div class="modal-footer">
		<button class="btn btn-default"data-dismiss=modal type=button>Close</button>
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
				<button class="btn btn-default"data-dismiss=modal type=button>Close</button>
			</div>
		</div>
	</div>
</div>
				
				
				
				
           
		   
 
      
     