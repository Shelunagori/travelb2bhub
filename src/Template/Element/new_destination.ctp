<div><hr>
	<div class="destination newdiv">
					  <div class="row">
							<div class="col-md-12">
								<div class="col-lg-2">
									<p for="from" >
										No. of Rooms
									</p>
								</div>
								<div class="col-lg-2">
									<p>Single</p>
									<?php echo $this->Form->control('room1', ["id"=>"room1", "type"=>"number","min"=>0, "class"=>"form-control", 'p' => false, 'div' => false, "placeholder"=>"0"]); ?>
								</div>
								<div class="col-lg-2">
									<p>Double</p>
									<?php echo $this->Form->control('room2', ["id"=>"room2", "type"=>"number","min"=>0, "class"=>"form-control", 'p' => false, 'div' => false, "placeholder"=>"0"]); ?>
								</div>
								<div class="col-lg-2">
									<p>Tripple</p>
									<?php echo $this->Form->control('room3', ["id"=>"room3", "type"=>"number","min"=>0, "class"=>"form-control", 'p' => false, 'div' => false, "placeholder"=>"0"]); ?>
								</div>
								<div class="col-lg-2">
									<p>Child with Bed</p>
									<?php echo $this->Form->control('child_with_bed', ["id"=>"child_with_bed", "type"=>"number","min"=>0, "class"=>"form-control", 'p' => false, 'div' => false, "placeholder"=>"0"]); ?>
								</div>
								<div class="col-lg-2">
									<p>Child without Bed</p>
									<?php echo $this->Form->control('child_without_bed', ["id"=>"child_without_bed", "type"=>"number","min"=>0, "class"=>"form-control", 'p' => false, 'div' => false, "placeholder"=>"0"]); ?>
								</div>
							</div>
						</div>
						<div class="row">
								<div class="col-md-12">
									<div class="col-md-4">
										<div class="input-field">
											<p for="from">
												Hotel Rating
											</p>
										</div>
										<div>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<div class="col-md-4 ">
										<div class="input-field">
											<p for="from">Hotel Catrgory </p>
												<div>
													<?php echo $this->Form->control('hotel_category', ["id"=>"hotel_category", "type"=>"select", 'options' =>$hotelCategories, "multiple"=>true , "class"=>"form-control chosen-select"]);?>

											   </div>
										</div>
									</div>
								<div class="col-md-4 ">
									<div class="input-field">
										<p for="from">Meal Plan </p>
										<div><?php echo $this->Form->control('meal_plan', ["type"=>"select", "empty"=>"Select Meal Plan", 'options' =>array("1"=>"EP - European Plan", "2"=>"CP - Contenental Plan", "3"=>"MAP - Modified American Plan", "4"=>"AP - American Plan") , "class"=>"form-control"]);?></div>
									</div>
								</div>
							</div>
						</div>
					<div class="row">
						<div class="col-md-12">
							<p>Locality</p>
						 <input type="text" autocomplete="off" class="form-control" name="locality" id="locality" placeholder="Enter Locality or Village or Town"/>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-6">
									<div class="input-field">
									<p for="from">
										Destination City
									</p>
									</div>
									<div>
											<input type="text" class="form-control" id="city_name" name="city_name" placeholder="Select City or Nearest City"/>
                                             <input type='hidden' id='city_id' name="city_id" />
									</div>
							</div>
							<div class="col-md-6">
								<div class="input-field">
									<p for="from">
												Destination Source
									</p>
								</div>
								<div>
									<input type='text' autocomplete="off" name='destination_source'  placeholder="Destination Source" class="form-control input-large" />
								</div>
							</div>
						</div>
					</div>	 
						<div class="row">
							<div class="col-md-12">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt" style="display:none;">
									<div class="input-field">
										<p for="from">Destination Country</p>
										<input type="text" class="form-control" id ="country_name" name="country_name" placeholder="Country" readonly/>
										<input type='hidden' id='country_id' name="country_id"/>
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
									<div class="col-md-6 input-group">
									<input autocomplete="off" type="text" name="check_in" class="form-control date-picker" id="datepicker7" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy"/>
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
									<div class="col-md-6 input-group">
										<input autocomplete="off" type="text" name="check_out" class="form-control date-picker" id="datepicker8" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" />
										<p class="input-group-addon btn" >
										<span class="fa fa-calendar"></span>
										</p>                    
									</div>
								</div>
							</div>
						</div><span class="help-block"></span>
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
