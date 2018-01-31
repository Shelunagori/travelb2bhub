<div><hr>
	<div class="destination newdiv">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
			<div class="input-field">
				<label for="from">No. of Rooms</label>

				<div class="box-room">

					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"> <label for="from">Single</label></div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><?php echo $this->Form->control('hh_room1.'.$randomNumber, ["readonly"=>true, "type"=>"number","min"=>0, "class"=>"form-control", 'label' => false, 'div' => false, "placeholder"=>"0"]); ?></div>

					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"> <label for="from">Double</label></div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><?php echo $this->Form->control('hh_room2.'.$randomNumber, ["readonly"=>true, "type"=>"number","min"=>0, "class"=>"form-control", 'label' => false, 'div' => false, "placeholder"=>"0"]); ?></div>

					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"> <label for="from">Triple</label></div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><?php echo $this->Form->control('hh_room3.'.$randomNumber, ["readonly"=>true, "type"=>"number","min"=>0, "class"=>"form-control", 'label' => false, 'div' => false, "placeholder"=>"0"]); ?></div>

					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"> <label for="from">Child with bed</label></div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><?php echo $this->Form->control('hh_child_with_bed.'.$randomNumber, ["readonly"=>true, "type"=>"number","min"=>0, "class"=>"form-control", 'label' => false, 'div' => false, "placeholder"=>"0"]); ?></div>

					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"> <label for="from">Child without bed</label></div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><?php echo $this->Form->control('hh_child_without_bed.'.$randomNumber, ["readonly"=>true, "type"=>"number","min"=>0, "class"=>"form-control", 'label' => false, 'div' => false, "placeholder"=>"0"]); ?></div>


				</div>    

			</div>
		</div>


		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
			<div class="input-field">
				<label for="from">Hotel Rating</label>
				<div style=" width: 252px;" >
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

			<div class="input-field">
				<label for="from">Hotel Category</label>
				<?php 
$cat = "h_hotel_category".$randomNumber;
echo $this->Form->control('hh_hotel_category'.$randomNumber, ["type"=>"select", 'options' =>$hotelCategories, "multiple"=>true , "id"=>$cat , "class"=>"form-control hh_hotel_category", "style"=>"height:63px;"]);?>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">

			<div class="input-field">
				<label for="from">Meal Plan</label>
				<?php echo $this->Form->control('hh_meal_plan.'.$randomNumber, ["type"=>"select", "empty"=>"Select Meal Plan", 'options' =>array("1"=>"EP - European Plan", "2"=>"CP - Contenental Plan", "3"=>"MAP - Modified American Plan", "4"=>"AP - American Plan") , "class"=>"form-control"]);?>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
			<div class="input-field">
			  <label for="from">Locality</label>
			  <input type="text" class="form-control" name="hh_locality[<?php echo $randomNumber; ?>]" placeholder="Enter Here"/>
			</div>
		</div>

	 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
			<div class="input-field">
			<label for="from">Destination City<span class="asterisk">
                                                                        <img src="../img/Asterisk.png" class="img-responsive">
                                                                    </span></label>
				<input type="text" class="form-control" name="hh_city_name[<?php echo $randomNumber; ?>]" id="hh_city_name[<?php echo $randomNumber; ?>]" placeholder="Select city/nearest city"/>
				<input type='hidden' required="true"  value="0" name="hh_city_id[<?php echo $randomNumber; ?>]" id="hh_city_id[<?php echo $randomNumber; ?>]"/>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
			<div class="input-field">
			  <label for="from">Destination State</label>
				<input type='hidden' value="0" name="hh_state_id[<?php echo $randomNumber; ?>]" id="hh_state_id[<?php echo $randomNumber; ?>]"/>
<input type="text" class="form-control" name="hh_state_name[<?php echo $randomNumber; ?>]" id="hh_state_id[<?php echo $randomNumber; ?>]" placeholder="Select State" readonly/>
			</div>
		</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt" style="display:none;">
			<div class="input-field">
			  <label for="from">Destination Country</label>
			  <input type="text" class="form-control" name="hh_country_name[<?php echo $randomNumber; ?>]" id="hh_country_id[<?php echo $randomNumber; ?>]" placeholder="Select Country" readonly/>
				<input type='hidden' value="0" name="hh_country_id[<?php echo $randomNumber; ?>]" id="hh_country_id[<?php echo $randomNumber; ?>]"/>
			</div>
		</div>
		<div class="row1">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
				<div class="input-field">
					<label for="from">Check In <span class="asterisk">
                                                                            <img src="../img/Asterisk.png" class="img-responsive">
                                                                        </span></label>
					<input require type="text" required="true" name="hh_check_in[<?php echo $randomNumber; ?>]" id="hh_check_in[<?php echo $randomNumber; ?>]" class="form-control" placeholder="dd/mm/yyyy"/>
				</div>
			</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
				<div class="input-field">
					<label for="from">Check Out <span class="asterisk">
                                                                            <img src="../img/Asterisk.png" class="img-responsive">
                                                                        </span></label>
					<input type="text" required="true" name="hh_check_out[<?php echo $randomNumber; ?>]" id ="hh_check_out[<?php echo $randomNumber; ?>]" class="form-control enddate" placeholder="dd/mm/yyyy"/>
				</div>
			</div>
		</div>
	</div>

<a href="java:script(0);" class="remove_field btn btn-primary btn-submit">Remove</a>
	<script>
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
