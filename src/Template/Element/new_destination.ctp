<div>
	<div class="destination newdiv">
	<div class="stop col-md-12"><div class="stop-title"> <b> Destination </b></div><br><div class="row main_row"> 
	
	  <div class="row">
			<div class="col-md-12">
				<div class="col-md-12">
					<p for="from" >
						No. of Rooms
					</p>
				</div>
				<div class="col-lg-2">
					<p>Single</p>
					<?php echo $this->Form->control('hh_room1['.$randomNumber.']', ["id"=>"room1", "type"=>"number","min"=>0, "class"=>"form-control", 'p' => false, 'div' => false, "placeholder"=>"0"]); ?>
				</div>
				<div class="col-lg-2">
					<p>Double</p>
					<?php echo $this->Form->control('hh_room2['.$randomNumber.']', ["id"=>"room2", "type"=>"number","min"=>0, "class"=>"form-control", 'p' => false, 'div' => false, "placeholder"=>"0"]); ?>
				</div>
				<div class="col-lg-2">
					<p>Tripple</p>
					<?php echo $this->Form->control('hh_room3['.$randomNumber.']', ["id"=>"room3", "type"=>"number","min"=>0, "class"=>"form-control", 'p' => false, 'div' => false, "placeholder"=>"0"]); ?>
				</div>
				<div class="col-lg-3">
					<p>Child with Bed</p>
					<?php echo $this->Form->control('hh_child_with_bed['.$randomNumber.']', ["id"=>"child_with_bed", "type"=>"number","min"=>0, "class"=>"form-control", 'p' => false, 'div' => false, "placeholder"=>"0"]); ?>
				</div>
				<div class="col-lg-3">
					<p>Child without Bed</p>
					<?php echo $this->Form->control('hh_child_without_bed['.$randomNumber.']', ["id"=>"child_without_bed", "type"=>"number","min"=>0, "class"=>"form-control", 'p' => false, 'div' => false, "placeholder"=>"0"]); ?>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top:10px">
			<div class="col-md-12">
				<div class="col-md-4">
					<div class="input-field">
						<p for="from">
							Hotel Rating
						</p>
					</div>
					<div class="stars" style="width:auto">
						<input style="display:none;" type="radio" checked value="0" name="hh_hotel_rating[<?php echo $randomNumber; ?>]"/>
					   <input class="star star-5" id="star-5-<?php echo $randomNumber; ?>" type="radio" value="5" name="hh_hotel_rating[<?php echo $randomNumber; ?>]"/>
					   <label class="star star-5" for="star-5-<?php echo $randomNumber; ?>"></label>
					   <input class="star star-4" id="star-4-<?php echo $randomNumber; ?>" type="radio" value="4" name="hh_hotel_rating[<?php echo $randomNumber; ?>]"/>
					   <label class="star star-4" for="star-4-<?php echo $randomNumber; ?>"></label>
					   <input class="star star-3" id="star-3-<?php echo $randomNumber; ?>" type="radio" value="3" name="hh_hotel_rating[<?php echo $randomNumber; ?>]"/>
					   <label class="star star-3" for="star-3-<?php echo $randomNumber; ?>"></label>
					   <input class="star star-2" id="star-2-<?php echo $randomNumber; ?>" type="radio" value="2" name="hh_hotel_rating[<?php echo $randomNumber; ?>]"/>
					   <label class="star star-2" for="star-2-<?php echo $randomNumber; ?>"></label>
					   <input class="star star-1" id="star-1-<?php echo $randomNumber; ?>" type="radio" value="1" name="hh_hotel_rating[<?php echo $randomNumber; ?>]"/>
					   <label class="star star-1" for="star-1-<?php echo $randomNumber; ?>"></label>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="input-field">
						<p for="from">Hotel Catrgory </p>
							<div>
								<?php echo $this->Form->control('hh_hotel_category['.$randomNumber.']', ["id"=>"hotel_category", "type"=>"select", 'options' =>$hotelCategories, "multiple"=>true , "class"=>"form-control select2","data-placeholder"=>"Select Options",]);?>
						   </div>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="input-field">
						<p for="from">Meal Plan </p>
						<div><?php echo $this->Form->control('hh_meal_plan['.$randomNumber.']', ["type"=>"select", "empty"=>"Select Meal Plan", 'options' =>array("1"=>"EP - European Plan", "2"=>"CP - Contenental Plan", "3"=>"MAP - Modified American Plan", "4"=>"AP - American Plan") , "class"=>"form-control"]);?></div>
					</div>
				</div>
			</div>
		</div>
	<div class="row">
		<div class="col-md-12 main_row">
			<div class="col-md-4">
				<p>Locality</p>
				 <input type="text" autocomplete="off" class="form-control" name="hh_locality[<?php echo $randomNumber; ?>]" id="locality" placeholder="Enter Locality,Village or Town"/>
			</div>
			<div class="col-md-4">
					<div class="input-field">
					<p for="from">
						Destination City
					</p>
					</div>
					<div>
						<input type="text" class="form-control city_select ctynamerecord" taxboxname="hh_state_id[<?php echo $randomNumber; ?>]" noofrows="6" name="hh_city_name[<?php echo $randomNumber; ?>]" id="hh_city_name[<?php echo $randomNumber; ?>]" placeholder="Select City or Nearest City"/>
						<input type='hidden' class="ctyIDname" id='hh_city_id' name="hh_city_id[<?php echo $randomNumber; ?>]" />
						<div class="suggesstion-box" style="margin-top:-10px"></div>
					</div>
			</div>
			<div class="stateRpl">
				<div class="col-md-4">
					<div class="input-field">
						<p for="from">
							Destination State
						</p>
					</div>
					<div>
						<input type='hidden' value="0" name="hh_state_id[<?php echo $randomNumber; ?>]" id="hh_state_id[<?php echo $randomNumber; ?>]"/>
						<input type="text" class="form-control" name="hh_state_name[<?php echo $randomNumber; ?>]" id="hh_state_id[<?php echo $randomNumber; ?>]" placeholder="Auto Populated" readonly/>
					</div>
				</div>
			</div>
		</div>
	</div>	 
		<div class="row">
			<div class="col-md-12">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt" style="display:none;">
					<div class="input-field">
						<p for="from">Destination Country</p>
						  <input type="text" class="form-control" name="hh_country_name[<?php echo $randomNumber; ?>]" id="hh_country_id[<?php echo $randomNumber; ?>]" placeholder="Select Country" readonly/>
				<input type='hidden' value="0" name="hh_country_id[<?php echo $randomNumber; ?>]" id="hh_country_id[<?php echo $randomNumber; ?>]"/>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
		<div class=" col-md-12">
				<div class="col-md-6">
					<div class="input-field">
						<p for="from">
							Check In
						</p>
					</div>
					<div class="col-md-12 input-group">
					<input require type="text" required="true" name="hh_check_in[<?php echo $randomNumber; ?>]" id="hh_check_in[<?php echo $randomNumber; ?>]" class="form-control date-picker"  data-date-format="dd-mm-yyyy"  placeholder="DD-MM-YYYY"/>
					<p class="input-group-addon btn">
					<span class="fa fa-calendar"></span>
					</p>                    
					</div>
				</div>
				<div class="col-md-6">
					<div class="input-field">
								<p for="from">
									Check Out
								</p>
					</div>
					<div class="col-md-12 input-group">
						<input type="text" required="true" name="hh_check_out[<?php echo $randomNumber; ?>]" id ="hh_check_out[<?php echo $randomNumber; ?>]" class="form-control enddate date-picker"  data-date-format="dd-mm-yyyy"  placeholder="DD-MM-YYYY"/>
						<p class="input-group-addon btn" >
						<span class="fa fa-calendar"></span>
						</p>                    
					</div>
				</div>
			</div>
		</div><span class="help-block"></span>
	</div>
	</div>
	<div class="col-md-12" align="right">
		<a href="java:script(0);" class="remove_field btn btn-danger btn-sm" style="width:70px;"><i class="fa fa-minus"></i></a>
		<br/><br/><hr></hr>
	</div>
	
	<script>
	$('.select2').select2();
	$('.date-picker').datepicker();
	//var cityData = '<?php //echo $allCities; ?>';
	//$(document).ready(function () {
		/*createAutocompleteCity('<?php echo $randomNumber; ?>')
		$("#h_city_name[<?php echo $randomNumber; ?>]").autocomplete({
			source: JSON.parse(cityData),
			select: function (e, ui) {
				e.preventDefault();
				$("#h_city_id[<?php echo $randomNumber; ?>]").val(ui.item.value);
				$(this).val(ui.item.label);
				$("#h_state_id[<?php echo $randomNumber; ?>]").val(ui.item.state_id);
				$("#h_state_name[<?php echo $randomNumber; ?>]").val(ui.item.state_name);

				$("#h_country_id[<?php echo $randomNumber; ?>]").val(ui.item.country_id);
				$("#h_country_name[<?php echo $randomNumber; ?>]").val(ui.item.country_name);
			
			}
		});*/
	//});
</script>
</div>
