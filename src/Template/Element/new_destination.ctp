 
	<div class="destination newdiv">
	<div class="stop col-md-12">
	<hr  style="margin-top: 8px; margin-bottom: 8px;"></hr>
	<div class="Destination-title"> <b> Destination </b></div> 
	<div class="row main_row"> 
	  <div class="row">
			<div class="col-md-12">
			
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
					<div class="input-field">
						<label for="from">No. of Rooms</label>
						<div class="box-room">
							<div class="col-md-7"> Single</div>
							<div class="col-md-5"><input autocomplete="off" name="hh_room1[<?php echo $randomNumber;?>]" type="number" min="0" style="height: 27px;" class="form-control" id="from-place" placeholder="0"/></div>

							<div class="col-md-7"> Double</div>
							<div class="col-md-5"><input autocomplete="off" name="hh_room2[<?php echo $randomNumber;?>]" type="number" min="0" style="height: 27px;" class="form-control" id="from-place" placeholder="0"/></div>

							<div class="col-md-7"> Triple</div>
							<div class="col-md-5"><input autocomplete="off" name="hh_room3[<?php echo $randomNumber;?>]" type="number" min="0" style="height: 27px;" class="form-control" id="from-place" placeholder="0"/></div>

							<div class="col-md-7"> Child with bed</div>
							<div class="col-md-5"><input autocomplete="off" name="hh_child_with_bed[<?php echo $randomNumber;?>]" style="height: 27px;" type="number" min="0" class="form-control" id="from-place" placeholder="0"/></div>

							<div class="col-md-7"> Child without bed</div>
							<div class="col-md-5"><input autocomplete="off" name="hh_child_without_bed[<?php echo $randomNumber;?>]" style="height: 27px;" type="number" min="0" class="form-control" id="from-place" placeholder="0"/></div>
						</div>
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
					<div class="input-field">
						<p>Hotel Rating</p>	
						<div style="width: 200px;" class="stars"> 
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
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
					<div class="input-field hotel_category">
						Hotel Category 
						<?php echo $this->Form->control('hh_hotel_category['.$randomNumber.']', ["id"=>"hotel_category", "type"=>"select", 'options' =>$hotelCategories, "multiple"=>true , "class"=>"form-control select2","data-placeholder"=>"Select Options",]);?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
					<div class="input-field">
						Meal Plan
						<?php echo $this->Form->control('hh_meal_plan['.$randomNumber.']', ["id"=>"h_hotel_category", "type"=>"select",'options' =>$MealPlans, "class"=>"form-control select2","data-placeholder"=>"Select Options "]); ?>
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
						<input require type="text" required="true" name="hh_check_in[<?php echo $randomNumber; ?>]" id="hh_check_in[<?php echo $randomNumber; ?>]" class="form-control datepicker"  data-date-format="dd-mm-yyyy"  placeholder="DD-MM-YYYY"/>                     
					</div>
				</div> 
				<div class="col-md-6">
					<div class="input-field">
					<p for="from">
						Check Out
					</p>
					</div>
					<div class="col-md-12 input-group">
						<input type="text" required="true" name="hh_check_out[<?php echo $randomNumber; ?>]" id ="hh_check_out[<?php echo $randomNumber; ?>]" class="form-control enddate datepicker checkdatefornext"  data-date-format="dd-mm-yyyy"  placeholder="DD-MM-YYYY"/>                     
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div style="margin-top:5px" align="right">
				<a href="java:script(0);" class="remove_field btn btn-danger btn-sm"><i class="fa fa-trash"></i> Remove </a>
			</div>
		</div>
		<span class="help-block"></span>
			
		</div>
	</div>
	</div>
	</div>
	<script>
	$('.select2').select2(); 
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
