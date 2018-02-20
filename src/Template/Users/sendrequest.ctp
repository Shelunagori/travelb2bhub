<?php echo $this->Html->script(['jquery.validate']);?>
<?= $this->Html->css(['jquery.steps']); ?>
<?php echo $this->Html->script(['modernizr-2.6.2.min', 'jquery.cookie-1.3.1', 'jquery.steps', 'selectFx']); ?>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php echo $this->Html->css(['chosen/chosen']);?>
<?php echo $this->Html->script(['chosen/chosen.jquery']);?>
 <script>
	var cityData = '<?php echo $allCities; ?>';
	$(document).ready(function () {
		$("#city_name").autocomplete({
			source: JSON.parse(cityData),
			select: function (e, ui) {
				e.preventDefault();
				$("#city_id").val(ui.item.value);
				$(this).val(ui.item.label);
				$("#state_id").val(ui.item.state_id);
				$("#state_name").val(ui.item.state_name);
				$("#country_id").val(ui.item.country_id);
				$("#country_name").val(ui.item.country_name);
                                $("#city_id-error").hide();
			}
		});
		$("#h_city_name").autocomplete({
			source: JSON.parse(cityData),
			select: function (e, ui) {
				e.preventDefault();
				$("#h_city_id").val(ui.item.value);
				$(this).val(ui.item.label);
				$("#h_state_id").val(ui.item.state_id);
				$("#h_state_name").val(ui.item.state_name);
				$("#h_country_id").val(ui.item.country_id);
				$("#h_country_name").val(ui.item.country_name);
$("#h_city_id-error").hide();
			}
		});
		$("#pickup_city_name").autocomplete({
			source: JSON.parse(cityData),
			select: function (e, ui) {
				e.preventDefault();
				$("#pickup_city_id").val(ui.item.value);
				$(this).val(ui.item.label);
				$("#pickup_state_id").val(ui.item.state_id);
				$("#pickup_state_name").val(ui.item.state_name);
				$("#pickup_country_id").val(ui.item.country_id);
				$("#pickup_country_name").val(ui.item.country_name);
			}
		});

		$("#t_pickup_city_name").autocomplete({
			source: JSON.parse(cityData),
			select: function (e, ui) {
				e.preventDefault();
				$("#t_pickup_city_id").val(ui.item.value);
				$(this).val(ui.item.label);
				$("#t_pickup_state_id").val(ui.item.state_id);
				$("#t_pickup_state_name").val(ui.item.state_name);
				$("#t_pickup_country_id").val(ui.item.country_id);
				$("#t_pickup_country_name").val(ui.item.country_name);
$("#t_pickup_city_id-error").hide();	
			
			}
		});
		$(document).on('keyup', ".trans_city", function(e){
			e.preventDefault();
			var useFor = $(this).attr("use_for");
			var numCount = $(this).attr("numCount");
			autoComplete(this, useFor, numCount);
		});
		function autoComplete(input, useFor="package", numCount=1){
			$(input).autocomplete({
				source: JSON.parse(cityData),
				select: function (e, ui) {
					e.preventDefault();
					$(this).val(ui.item.label);
					if(useFor=="package") {
						var wrapper = $(".package-stops");
						$(wrapper).find("input:hidden[name='id_package_stop_city["+numCount+"]']").val(ui.item.value);
						$(wrapper).find("input:hidden[name='state_id_package_stop_city["+numCount+"]']").val(ui.item.state_id);
						$(wrapper).find("input:text[name='state_name_package_stop_city["+numCount+"]']").val(ui.item.state_name);
					} else if(useFor=="trasport") {
						var wrapper = $(".transport-stops");
						$(wrapper).find("input:hidden[name='id_trasport_stop_city["+numCount+"]']").val(ui.item.value);
						$(wrapper).find("input:hidden[name='state_id_trasport_stop_city["+numCount+"]']").val(ui.item.state_id);
						$(wrapper).find("input:text[name='state_name_trasport_stop_city["+numCount+"]']").val(ui.item.state_name);
					}
				}
			});
		}
		$("#t_final_city_name").autocomplete({
			source: JSON.parse(cityData),
			select: function (e, ui) {
				e.preventDefault();
				$("#t_final_city_id").val(ui.item.value);
				$(this).val(ui.item.label);
				$("#t_final_state_id").val(ui.item.state_id);
				$("#t_final_state_name").val(ui.item.state_name);
				$("#t_final_country_id").val(ui.item.country_id);
				$("#t_final_country_name").val(ui.item.country_name);
$("#t_final_city_id-error").hide();
			
			}
		});
		$("#p_final_city_name").autocomplete({
			source: JSON.parse(cityData),
			select: function (e, ui) {
				e.preventDefault();
				$("#p_final_city_id").val(ui.item.value);
				$(this).val(ui.item.label);
				$("#p_final_state_id").val(ui.item.state_id);
				$("#p_final_state_name").val(ui.item.state_name);
			
			}
		});

		// Overrides the default autocomplete filter function to search only from the beginning of the string
		$.ui.autocomplete.filter = function (array, term) {
			var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i");
			return $.grep(array, function (value) {
				return matcher.test(value.label);
			});
		};
		$('#datepicker1').datepicker({
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			minDate: '<?php echo date("d/m/Y"); ?>',
			onSelect: function(selected) {
				$( "#datepicker2" ).datepicker( "option", "minDate",selected);
				$('#datepicker2').val("");
			}
		});
		$('#datepicker2').datepicker({
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			minDate: '<?php echo date("d/m/Y"); ?>',
			onSelect: function(selected) {
				var checkInDate = $('#datepicker1').val();
				if(checkInDate == "") {
					alert("Please select check-in date first.");
					$('#datepicker2').val("");
				}
			}
		});

		
		$('#datepicker3').datepicker({
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			minDate: '<?php echo date("d/m/Y"); ?>',
			onSelect: function(selected) {
				$( "#datepicker4" ).datepicker( "option", "minDate",selected);
				$('#datepicker4').val("");
			}
		});
		$('#datepicker4').datepicker({
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			minDate: '<?php echo date("d/m/Y"); ?>',
			onSelect: function(selected) {
				var checkInDate = $('#datepicker3').val();
				if(checkInDate == "") {
					alert("Please select start date first.");
					$('#datepicker4').val("");
				}
			}
		});
		$('#datepicker5').datepicker({
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			minDate: '<?php echo date("d/m/Y"); ?>',
			onSelect: function(selected) {
				$( "#datepicker6" ).datepicker( "option", "minDate",selected);
				$('#datepicker6').val("");
			}
		});
		$('#datepicker6').datepicker({
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			minDate: '<?php echo date("d/m/Y"); ?>',
			onSelect: function(selected) {
				var checkInDate = $('#datepicker5').val();
				if(checkInDate == "") {
					alert("Please select start date first.");
					$('#datepicker6').val("");
				}
			}
		});

		$('#datepicker7').datepicker({
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			minDate: '<?php echo date("d/m/Y"); ?>',
			onSelect: function(selected) {
				$( "#datepicker8" ).datepicker( "option", "minDate",selected);
				$('#datepicker8').val("");
			}
		});
		$('#datepicker8').datepicker({
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			minDate: '<?php echo date("d/m/Y"); ?>',
			onSelect: function(selected) {
				var checkInDate = $('#datepicker7').val();
				if(checkInDate == "") {
					alert("Please select check-in date first.");
					$('#datepicker8').val("");
				}
			}
		});
	});
</script>
<script type="text/javascript">
$(document).ready(function($){
	//$(".chosen-select").chosen();
});
</script>
 
                  <?php echo $this->element('subheader');?>

		<hr class="hr_bordor">
            <div id="tra-sendrequest" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= $this->Flash->render() ?>
                <div class="content">
                    <div class="tab-content">
                        <ul class="nav nav-tabs" >
                            <li class="active" ><a href="#tab2" data-toggle="tab">Package</a></li>
                            <li><a href="#tab1" data-toggle="tab">Hotel</a></li>
                            <li><a id="tabtransport" href="#tab3" data-toggle="tab">Transport</a></li>
                        </ul>
                        <div class="tab-pane" id="tab1">
				                 <?php
                           /*  echo $this->Form->create(null, [
                                'type' => 'file',
                                'url' => ['controller' => 'Users', 'action' => 'sendrequest'], "id"=>"HotelRequestForm"
                            ]); */
                            ?>
							<input autocomplete="off" name="category_id" type="hidden" value="3" class="form-control" id="date-start" placeholder="Reference id"/>
							<div class="form-box">
								<div class="panel-group" id="HotelAccordion" style="background-color:white;">
									<div class="panel panel-default">
                                            <h4 class="panel-title ">
											<fieldset>
												  <legend style="color:#369FA1;"><b>GENERAL REQUIREMENTS:</b></legend>
												<div class="form">
												  <div class="row">
												  <div class="col-md-12">
                                                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
														<div class="input-field">
															<p for="from" >
																Reference ID  
                                                            </p>
															<input name="reference_id" type="text" class="form-control ref2" id="Reference ID" placeholder="Reference ID" autocomplete="off" />
															 
														</div>
													</div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                                        <div class="input-field">
                                                            <p for="from">
																Total Budget  
                                                            </p>
                                                            <input autocomplete="off" name="total_budget" type="number" min="1" class="form-control" id="total_budget" placeholder="Total Budget"/>
                                                        </div>
														</div>
													</div>
													</div> 
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-6">
															<p for="from">Adults</p>
															<div class="col-md-6 input-group">
																<label class="input-group-addon btn" >
																<button type="button" class="fa fa-minus-square" id="btnminus" value=""></button>
																</label>                    
																<input type='text' autocomplete="off" name='children' value='1' class="form-control input-large" id="textcounter"/>	
																<label class="input-group-addon btn" >
																<button type="button" class="fa fa-plus-square" id="btnplus" value=""></button>
																</label>                    
																</div>
																</div>
											   
															<div class="col-md-6">
															<p for="from">Children below 6  </p>
																<div class="col-md-6 input-group">
																<label class="input-group-addon btn" >
																<button type="button" class="fa fa-minus-square" id="btnminus1" value=""></button>
																</label>                    
																 <input type='text' autocomplete="off" name='children' value='1' class="form-control input-large" id="textcounter1"/>	
																<label class="input-group-addon btn">
																<button type="button" class="fa fa-plus-square" id="btnplus1" value=""></button>
																</label>                    
																</div>
															</div>
														</div>
													</div>
													
													</fieldset></h4>
											<h4 class="panel-title ">
											<fieldset>
											<legend style="color:#369FA1;"><b>STAY REQUIREMENTS:</b></legend>
												  <div class="row">
														<div class="col-md-12">
															<div class="col-lg-2">
																<p for="from" >
																	No. of Rooms
																</p>
															</div>
															<div class="col-lg-2">
																<p>Single</p>
																<input name="single_room" type="number" class="form-control s_room"  autocomplete="off" />
															</div>
															<div class="col-lg-2">
																<p>Double</p>
																<input name="single_room" type="number" class="form-control s_room"  autocomplete="off" />
															</div>
															<div class="col-lg-2">
																<p>Tripple</p>
																<input name="single_room" type="number" class="form-control s_room"  autocomplete="off" />
															</div>
															<div class="col-lg-2">
																<p>Child with Bed</p>
																<input name="single_room" type="number" class="form-control s_room"  autocomplete="off" />
															</div>
															<div class="col-lg-2">
																<p>Child without Bed</p>
																<input name="single_room" type="number" class="form-control s_room"  autocomplete="off" />
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
																				<?php 
																				echo $this->Form->control('hotel_category', ["id"=>"h_hotel_category", "type"=>"select", 'options' =>$hotelCategories, "multiple"=>true , "class"=>"select2me form-control input-large"]);?>
																		   </div>
																	</div>
																</div>
															<div class="col-md-4 ">
																<div class="input-field">
																	<p for="from">Meal Plan </p>
																	<div>
																	<select name="meal_plan" class="form-control">
																	<option value="" selected>Select Meal Plan</option>
																	<option value="1">EP - European Plan</option>
																	<option value="2">CP - Contenental Plan</option>
																	<option value="3">MAP - Modified American Plan</option>
																	<option value="4">AP - American Plan</option>
																</select></div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
													<div class="col-md-12">
														<p>Locality</p>
														<input type='text' autocomplete="off" name='mob_no'  placeholder="Enter Locality or Village or Town" class="form-control input-large" />
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-6">
															<div class="input-field">
                                                                <label for="from">Destination City
                                                                </label>
                                                                <input autocomplete="off" type="text" class="form-control" id="h_city_name" name="h_city_name" placeholder="Select City or Nearest City"/>
                                                                <input type='hidden' id='h_city_id' name="h_city_id" />

                                                            </div>
														</div>
														<div class="col-md-6">
															<div class="input-field">
															<label for="from">Destination State</label>
																<input type='hidden' id='h_state_id' name="h_state_id"/>
															<input type="text" class="form-control" id ="h_state_name" name="h_state_name" placeholder="State" readonly/>
															</div>
															</div>
															
														</div>
													</div>
													<div class="row">
													<div class="col-md-12">
													<div class="input-field">
															<label for="from">Destination Country</label>
															<input type="text" class="form-control" id ="h_country_name" name="h_country_name" placeholder="Country" readonly/>
																<input type='hidden' id='h_country_id' name="h_country_id"/>
															</div>
														</div>
													</div>
													<div class="row">
													<div class="col-md-12">
														<div class="col-md-6">
															<div class="input-field">
                                                                <label for="from">Check In 
                                                                     
                                                                </label>
                                                                <input type="text" name="check_in" class="form-control" id="datepicker1" placeholder="dd/mm/yyyy"/>
                                                            </div>
														</div>
														<div class="col-md-6">
															 <div class="input-field">
                                                                <label for="from">Check Out 

                                                                </label>
                                                                <input type="text" autocomplete="off" name="check_out" class="form-control" id="datepicker2" placeholder="dd/mm/yyyy"/>
                                                            </div>
															</div>
															
														</div>
													</div>		
												</div>	 
													
													</fieldset>
													</h4>
															
	                                   

									<div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title ">
                                                <a data-toggle="collapse"  data-parent="#HotelAccordion" href="#HotelComment">
                                                  Comments</a>
                                            </h4>
                                        </div>
										
                                        <div id="HotelComment" class="panel-collapse collapse">
                                            <div class="panel-body">
												<div class="form">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
														<div class="input-field">
															<label for="from">Comment Box</label>
															<textarea name="comment" class="form-control mt" cols="" rows="4"></textarea>
														</div>
													</div> 
												</div>
                                            </div>
                                        </div>
                                    </div>
									<!--panel panel-default-->
								</div>
								<!--panel-group for Hotel-->
								<div class="margi text-center">
									<input type="submit" class="btn btn-primary btn-submit" value="Submit">
								</div>
								
							</div>
							</form>
							<!--Form Box for Hotel-->
							</div>
                        </div>
						<!--Tab pane Hotel end-->
                        <div class="tab-pane active" id="tab2" >
                             <?php
                            echo $this->Form->create(null, [
                                'type' => 'file',
                                'url' => ['controller' => 'Users', 'action' => 'sendrequest'], "id"=>"PackgeRequestForm"
                            ]);
                            ?>
							<input name="category_id" type="hidden" value="1" class="form-control" id="date-start" placeholder="Reference id"/>
							<input type="hidden" name="user_id" value="<?php echo $users['id']; ?>"/>
                            <div class="form-box" >
                                <div class="panel-group" id="accordion" style="background-color:white;">
									<h4 class="panel-title">
										<fieldset>
											  <legend style="color:#369FA1;"><b>GENERAL REQUIREMENTS:</b></legend>
											<div class="form">
												<div class="row">
													<div class="col-md-12">
													  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
															<div class="input-field">
																<p for="from" >
																	Reference ID  
																</p>
																<input name="reference_id" type="text" class="form-control ref2" id="Reference ID" placeholder="Reference ID" autocomplete="off" />
																 
															</div>
														</div>
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
															<div class="input-field">
																<p for="from">
																	Total Budget  
																</p>
																<input autocomplete="off" name="total_budget" type="number" min="1" class="form-control" id="total_budget" placeholder="Total Budget"/>
															</div>
														</div>
													</div>
												</div><br>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-6">
															<p for="from">Adults</p>
															<div class="col-md-6 input-group">
																<label class="input-group-addon btn" >
																<button type="button" class="fa fa-minus-square" id="btnminus" value=""></button>
																</label>                    
																<input type='text' autocomplete="off" name='children' value='1' class="form-control input-large" id="textcounter"/>	
																<label class="input-group-addon btn" >
																<button type="button" class="fa fa-plus-square" id="btnplus" value=""></button>
																</label>                    
															</div>
														</div>
											   
														<div class="col-md-6">
															<p for="from">Children below 6  </p>
																<div class="col-md-6 input-group">
																<label class="input-group-addon btn" >
																<button type="button" class="fa fa-minus-square" id="btnminus1" value=""></button>
																</label>                    
																 <input type='text' autocomplete="off" name='children' value='1' class="form-control input-large" id="textcounter1"/>	
																<label class="input-group-addon btn">
																<button type="button" class="fa fa-plus-square" id="btnplus1" value=""></button>
																</label>                    
																</div>
														</div>
													</div>
												</div>
											</div>
										</fieldset>
									</h4>
									<h4 class="panel-title">
										<fieldset>
											<legend style="color:#369FA1;"><b>STAY REQUIREMENTS:</b></legend>
												<div class="form">
												  <div class="row">
														<div class="col-md-12">
															<div class="col-lg-2">
																<p for="from" >
																	No. of Rooms
																</p>
															</div>
															<div class="col-lg-2">
																<p>Single</p>
																<input name="single_room" type="number" class="form-control s_room"  autocomplete="off" />
															</div>
															<div class="col-lg-2">
																<p>Double</p>
																<input name="single_room" type="number" class="form-control s_room"  autocomplete="off" />
															</div>
															<div class="col-lg-2">
																<p>Tripple</p>
																<input name="single_room" type="number" class="form-control s_room"  autocomplete="off" />
															</div>
															<div class="col-lg-2">
																<p>Child with Bed</p>
																<input name="single_room" type="number" class="form-control s_room"  autocomplete="off" />
															</div>
															<div class="col-lg-2">
																<p>Child without Bed</p>
																<input name="single_room" type="number" class="form-control s_room"  autocomplete="off" />
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
																				<input type='text' autocomplete="off" name='mob_no'  placeholder="mobile No"/>
																		   </div>
																	</div>
																</div>
															<div class="col-md-4 ">
																<div class="input-field">
																	<p for="from">Meal Plan </p>
																	<div><input type='text' autocomplete="off" name='mob_no'  placeholder="Category"/></div>
																</div>
															</div>
														</div>
													</div>
												<div class="row">
													<div class="col-md-12">
														<p>Locality</p>
														<input type='text' autocomplete="off" name='mob_no'  placeholder="Enter Locality or Village or Town" class="form-control input-large" />
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
																		<input type='text' autocomplete="off" name='destination_city'  placeholder="Destination City" class="form-control input-large" />
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
													<div class=" col-md-12">
															<div class="col-md-6">
																<div class="input-field">
																	<p for="from">
																		Check In
																	</p>
																</div>
																<div class="col-md-6 input-group">
																	<input type="text" id="testdate" name="testdate" class="form-control input-large" value="">
																	<label class="input-group-addon btn" for="testdate">
																	<span class="fa fa-calendar"></span>
																	</label>                    
																</div>
															</div>
															<div class="col-md-6">
																<div class="input-field">
																			<p for="from">
																				Check Out
																			</p>
																</div>
																<div class="col-md-6 input-group">
																	<input type="text" id="testdate" name="testdate" class="form-control input-large" value="">
																	<label class="input-group-addon btn" for="testdate">
																	<span class="fa fa-calendar"></span>
																	</label>                    
																</div>
															</div>			
													</div>
												</div>
													<div class="row">
														<div class=" col-md-12">
															<div class="margin text-center">
																<button type="submit" class="btn btn-primary btn-md" value="Submit">Submit</button>	
															</div>
														</div>
													</div>
										</div>
										</fieldset></h4>
										</div>
							</div>
											
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a  data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                                    Stay Requirements</a></h4>
										</div>
									</div>
                                        <div id="collapse2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="form">
                                                  <h4 class="panel-title">
										<fieldset>
											<legend style="color:#369FA1;"><b>STAY REQUIREMENTS:</b></legend>
												<div class="form">
												  <div class="row">
														<div class="col-md-12">
															<div class="col-lg-2">
																<p for="from" >
																	No. of Rooms
																</p>
															</div>
															<div class="col-lg-2">
																<p>Single</p>
																<input name="single_room" type="number" class="form-control s_room"  autocomplete="off" />
															</div>
															<div class="col-lg-2">
																<p>Double</p>
																<input name="single_room" type="number" class="form-control s_room"  autocomplete="off" />
															</div>
															<div class="col-lg-2">
																<p>Tripple</p>
																<input name="single_room" type="number" class="form-control s_room"  autocomplete="off" />
															</div>
															<div class="col-lg-2">
																<p>Child with Bed</p>
																<input name="single_room" type="number" class="form-control s_room"  autocomplete="off" />
															</div>
															<div class="col-lg-2">
																<p>Child without Bed</p>
																<input name="single_room" type="number" class="form-control s_room"  autocomplete="off" />
															</div>
														</div>
													</div>
													<div class="row">
															<div class="col-md-12">
																<div class="col-md-4">
																	<div class="input-field">
																		<label for="from">Hotel Rating</label>

																	</div>
																<div style="display: inline-block; width: px;" >
																	<input style="display:none;" type="radio" checked value="0" name="hotel_rating"/>
																   <input class="star star-5" id="star-5-2" type="radio" value="5" name="hotel_rating"/>
																   <label class="star star-5" for="star-5-2"></label>
																   <input class="star star-4" id="star-4-2" type="radio" value="4" name="hotel_rating"/>
																   <label class="star star-4" for="star-4-2"></label>
																   <input class="star star-3" id="star-3-2" type="radio" value="3" name="hotel_rating"/>
																   <label class="star star-3" for="star-3-2"></label>
																   <input class="star star-2" id="star-2-2" type="radio" value="2" name="hotel_rating"/>
																   <label class="star star-2" for="star-2-2"></label>
																   <input class="star star-1" id="star-1-2" type="radio" value="1" name="hotel_rating"/>
																   <label class="star star-1" for="star-1-2"></label>
																</div>
															</div>
													
                                                        <div class="col-md-4">
                                                            <div class="input-field hotel_category">
                                                                <label for="from">Hotel Category</label>
														<?php echo $this->Form->control('hotel_category', ["id"=>"hotel_category", "type"=>"select", 'options' =>$hotelCategories, "multiple"=>true , "class"=>"select2me form-control chosen-select"]);?>
                                                            </div>
                                                        </div>


														<div class="col-md-4">                                                        
																<div class="input-field">
                                                                <label for="from">Meal Plan</label>
																	<?php echo $this->Form->control('meal_plan', ["type"=>"select", "empty"=>"Select Meal Plan", 'options' =>array("1"=>"EP - European Plan", "2"=>"CP - Contenental Plan", "3"=>"MAP - Modified American Plan", "4"=>"AP - American Plan") , "class"=>"form-control"]);?>
																</div>
															</div>
														</div>
													</div>

                                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
                                                            <div class="input-field">
                                                            <label for="from">Locality</label>
                                                            <input type="text" autocomplete="off" class="form-control" name="locality" id="locality" placeholder="Enter Locality or Village or Town"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                                            <div class="input-field">
                                                                <label for="from">Destination City
                                                                    <span class="asterisk">
                                                                        <img src="../img/Asterisk.png" class="img-responsive">
                                                                    </span>   
                                                                </label>
                                                                <input type="text" class="form-control" id="city_name" name="city_name" placeholder="Select City or Nearest City"/>
                                                                <input type='hidden' id='city_id' name="city_id" />

                                                            </div>
                                                        </div>
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
															<div class="input-field">
															  <label for="from">Destination State</label>
																<input type='hidden' id='state_id' name="state_id"/>
															  <input type="text" class="form-control" id ="state_name" name="state_name" placeholder="State" readonly/>
															</div>
														</div>
												  
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt" style="display:none;">
															<div class="input-field">
															  <label for="from">Destination Country</label>
															  <input type="text" class="form-control" id ="country_name" name="country_name" placeholder="Country" readonly/>
																<input type='hidden' id='country_id' name="country_id"/>
															</div>
														</div>
														<div class="row1">

                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                                                <div class="input-field">
                                                                    <label for="from">Check In 
                                                                        <span class="asterisk">
                                                                            <img src="../img/Asterisk.png" class="img-responsive">
                                                                        </span>   
                                                                    </label>
                                                                    <input autocomplete="off" type="text" name="check_in" class="form-control" id="datepicker7" placeholder="dd/mm/yyyy"/>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                                                <div class="input-field">
                                                                    <label for="from">Check Out 
                                                                        <span class="asterisk">
                                                                            <img src="../img/Asterisk.png" class="img-responsive">
                                                                        </span>   
                                                                    </label>
                                                                    <input autocomplete="off" type="text" name="check_out" class="form-control" id="datepicker8" placeholder="dd/mm/yyyy"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
													</fieldset>
												</h4>
												</div>
											</div>
										</div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt padding0">
                                                                 <div class="input_fields_wrap1">
                                                         </div> 
													<button class="add_field_button2 but ">Add Another Destination</button>
                                                    </div>
                                              
                                             
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse"  data-parent="#accordion" href="#collapse3">
                                                  Transport Requirements</a>
                                            </h4>
                                        </div>
                                        <div id="collapse3" class="panel-collapse collapse">
                                            <div class="panel-body"> <div class="form">
										<div class="destination">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
                                            <div class="input-field">
                                                <label for="from">Transport</label>
                                                <select name="transport_requirement" class="form-control">
																	 <option value="" selected>Select Transport</option>
                                                    <option value="1">Luxury Car</option>
                                                    <option value="2">Sedan</option>
                                                    <option value="3">Innova/ Tavera</option>
                                                    <option value="4">Tempo Traveller</option>
                                                    <option value="5">AC Coach</option>
                                                    <option value="6">Non AC Bus</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                            <div class="input-field">
                                                <label for="from">Start Date</label>
                                                <input autocomplete="off" name="start_date" type="text" class="form-control" id="datepicker3" placeholder="dd/mm/yyyy"/>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                            <div class="input-field">
                                                <label for="from">End Date</label>
                                                <input autocomplete="off" type="text" name="end_date" class="form-control" id="datepicker4" placeholder="dd/mm/yyyy"/>
                                            </div>
                                        </div>

										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
											<div class="input-field">
											  <label for="from">Pickup Locality</label>
											  <input autocomplete="off" type="text" class="form-control" name="pickup_locality" id="pickup_locality" placeholder="Enter Locality or Village or Town"/>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
											<div class="input-field">
												<label for="from">Pickup City</label>
												<input  type="text" class="form-control" id="pickup_city_name" name="pickup_city_name" placeholder="Select City or Nearest City"/>
												<input type='hidden' id='pickup_city_id' name="pickup_city_id" />
												
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt">
											<div class="input-field">
											  <label for="from">Pickup State</label>
												<input type='hidden' id='pickup_state_id' name="pickup_state_id"/>
											  <input type="text" class="form-control" id ="pickup_state_name" name="pickup_state_name" placeholder="Select State" readonly/>
											</div>
										</div>
										<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
											<div class="input-field">
											  <label for="from">Pickup Country</label>
												<input type='hidden' id='pickup_country_id' name="pickup_country_id"/>
											  <input type="hidden" class="form-control" id ="pickup_country_name" name="pickup_country_name" placeholder="Select Country" readonly/>
											</div>
										</div> -->
										<input type='hidden' id='pickup_country_id' name="pickup_country_id"/>
										<input type="hidden" class="form-control" id ="pickup_country_name" name="pickup_country_name" placeholder="Select Country" readonly/>
 <div class="package-stops"></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 mt">
                                             <div class="input_fields_wrap11">
                                                    <button type="button" class="but ap-btn package-stop-add margin-l15">Add Stop</button>
                                             </div>
                                        </div>

									   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
											<div class="input-field">
												<label for="from">Final Locality</label>
												<input autocomplete="off" class="form-control" type="text" placeholder="Enter Locality or Village or Town" name="finalLocality">
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
											<div class="input-field">
												<label for="from">Final City</label>
												<input type="text" class="form-control" id="p_final_city_name" name="p_final_city_name" placeholder="Select City or Nearest City"/>
												<input type='hidden' id='p_final_city_id' name="p_final_city_id" />
												
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
											<div class="input-field">
											<label for="from">Final State</label>
												<input type='hidden' id='p_final_state_id' name="p_final_state_id"/>
											<input type="text" class="form-control" id ="p_final_state_name" name="p_final_state_name" placeholder="Select State" readonly/>
											</div>
										</div>
						</div>
										</div>
										</div>
										</div>
									</div>
									<!-- Add comment tag -->
									<div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse"  data-parent="#accordion" href="#collapse4">
                                                  Comments</a>
                                            </h4>
                                        </div>
                                        <div id="collapse4" class="panel-collapse collapse">
                                            <div class="panel-body">
												<div class="form">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
														<div class="input-field">
															<label for="from">Comment Box</label>
															<textarea name="comment" class="form-control mt" cols="" rows="4"></textarea>
														</div>
													</div> 
												</div>
                                            </div>
                                        </div>
                                    </div>
								  </div>
                                
                                    <div class="margi text-center">
                                        <input type="submit" class="btn btn-primary btn-submit" value="Submit">
                                    </div>
                            </div> </h4>
                         </form>
                        </div>
						<!--Tab 3-->
						<div class="tab-pane" id="tab3">
							<?php
                            echo $this->Form->create(null, [
                                'type' => 'file',
                                'url' => ['controller' => 'Users', 'action' => 'sendrequest'], "id"=>"TransportRequestForm"
                            ]);
                            ?> 
							<input name="category_id" autocomplete="off" type="hidden" value="2" class="form-control" id="date-start" />
                            <!--Form Box for Hotel-->
							<div class="form-box">
								<div class="panel-group" id="TransportAccordion">
									<div class="panel panel-default">
										<div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="gr" data-toggle="collapse" data-parent="#TransportAccordion" href="#TransportlR">General Requirements</a>
                                            </h4>
                                        </div>
										<div id="TransportlR" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="form">
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
														<div class="input-field">
															<label for="from">Reference ID
                                                                 <span class="asterisk">
                                                                        <img src="/img/Asterisk.png" class="img-responsive">
                                                                 </span>   
                                                            </label>

															<input  name="reference_id" type="text" class="form-control ref1" id="reference_id" placeholder="Reference ID" autocomplete="off" />

														</div>
													</div>


													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
														<div class="input-field">
															<label for="from">Total Budget
                                                                <span class="asterisk">
                                                                        <img src="/img/Asterisk.png" class="img-responsive">
                                                                 </span>   
                                                            </label>

															<input name="total_budget" type="number" min="1" class="form-control" id="total_budget" placeholder="Total Budget" autocomplete="off" />

														</div>
													</div>

													<div class="col-xs-12 col-sm-6 col-xs-12 mt">
														<div class="input-field">
															<label for="from">Adults<span class="asterisk">
                                                                        <img src="/img/Asterisk.png" class="img-responsive">
                                                                    </span> </label>

															<div> <input type='button' value='-' class='qtyminus' field='transportAdult' />
																<input type='text' name='transportAdult' value='1' class='qty' autocomplete="off" />
																<input type='button' value='+' class='qtyplus' field='transportAdult' /></div>

														</div>
													</div>

													<div class="col-xs-12 col-sm-6 col-xs-12 mt">
														<div class="input-field">
															<label for="from">Children below 6  </label>
															<div><input type='button' value='-' class='qtyminus1' field='transportChildren' />
																<input type='text' name='transportChildren' value='0' class='qty' autocomplete="off" />
																<input type='button' value='+' class='qtyplus1' field='transportChildren' /></div>
														</div>
													</div>

												</div>
											</div>
										</div>

									</div>
									<!--panel panel-default-->

									<div class="panel panel-default">
										<div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a  data-toggle="collapse" data-parent="#TransportAccordion" href="#TransportStayR">Transport Requirements</a>
                                            </h4>
                                        </div>
										<div id="TransportStayR" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="form">
													<div class="destination">

														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
															<div class="input-field">
																<label for="from">Transport</label>
																<select name="transport_requirement" class="form-control">
																	<option value="" selected>Select Transport</option>
																	<option value="1">Luxury Car</option>
																	<option value="2">Sedan</option>
																	<option value="3">Innova/ Tavera</option>
																	<option value="4">Tempo Traveller</option>
																	<option value="5">AC Coach</option>
																	<option value="6">Non AC Bus</option>
																</select>
															</div>
														</div>
														
														<input type='hidden' id='t_pickup_country_id' name="t_pickup_country_id"/>
														<input type="hidden" class="form-control" id ="t_pickup_country_name" name="t_pickup_country_name" placeholder="Country" readonly/>
														
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                                            <div class="input-field">
                                                                <label for="from">Start Date
                                                                    <span class="asterisk">
                                                                        <img src="/img/Asterisk.png" class="img-responsive">
                                                                 </span>
                                                                </label>
                                                                <input autocomplete="off" name="start_date" type="text" class="form-control" id="datepicker5" placeholder="dd/mm/yyyy"/>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                                            <div class="input-field">
                                                                <label for="from">End Date
                                                                    <span class="asterisk">
                                                                        <img src="/img/Asterisk.png" class="img-responsive">
                                                                 </span>
                                                                </label>
                                                                <input autocomplete="off" type="text" name="end_date" class="form-control" id="datepicker6" placeholder="dd/mm/yyyy"/>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                                            <div class="input-field">
                                                            <label for="from">Pickup Locality
                                                                <span class="asterisk">
                                                                        <img src="/img/Asterisk.png" class="img-responsive">
                                                                 </span>
                                                            </label>
                                                            <input autocomplete="off" type="text" class="form-control" name="pickup_locality" id="pickup_locality" placeholder="Enter Locality or Village or Town"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                                            <div class="input-field">
                                                                <label for="from">Pickup City
                                                                    <span class="asterisk">
                                                                        <img src="/img/Asterisk.png" class="img-responsive">
                                                                 </span>   
                                                                </label>
                                                                <input type="text" class="form-control" id="t_pickup_city_name" name="t_pickup_city_name"  placeholder="Select City or Nearest City"/>
                                                                <input type='hidden' id='t_pickup_city_id' name="t_pickup_city_id" />

                                                            </div>
                                                        </div>										

														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
															<div class="input-field">
															<label for="from">Pickup State</label>
																<input type='hidden' id='t_pickup_state_id' name="t_pickup_state_id"/>
															<input type="text" class="form-control" id ="t_pickup_state_name" name="t_pickup_state_name" placeholder="State" readonly/>
															</div>
														</div>
												
														<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
															<div class="input-field">
															<label for="from">Pickup Country</label>
																<input type='hidden' id='t_pickup_country_id' name="t_pickup_country_id"/>
																<input type="hidden" class="form-control" id ="t_pickup_country_name" name="t_pickup_country_name" placeholder="Select Country" readonly/>
															</div>
														</div> -->
														

														<div class="transport-stops">
															
														</div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														
															<div class="input_fields_wrap1">
                                                                    <button class="but ap-btn transport-stop-add">ADD STOP</button>
                                                             </div> 
														</div>
														<!--<div class="col-xxs-12 text-center">
															<div class="input_fields_wrap">
																<button class="add_field_button but">Add Stop</button>
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
																	<div class="input-field">
																		<label for="from" style="float:left;">Stop Name</label>
																		<input class="form-control" type="text" placeholder="Stop Name" name="stops[]">
																	</div>
																</div>
															</div>
														</div> -->
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
															<div class="input-field">
																<label for="from">Final Locality</label>
																<input class="form-control" type="text" placeholder="Enter Locality or Village or Town" name="finalLocality">
															</div>
														</div>

														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
															<div class="input-field">
																<label for="from">Final City
                                                                    <span class="asterisk">
                                                                        <img src="/img/Asterisk.png" class="img-responsive">
                                                                    </span>   
                                                                </label>
																<input type="text" class="form-control" id="t_final_city_name" name="t_final_city_name" placeholder="Select City or Nearest City"/>
																<input type='hidden' id='t_final_city_id' name="t_final_city_id" />
																
															</div>
														</div>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
															<div class="input-field">
															<label for="from">Final State</label>
																<input type='hidden' id='t_final_state_id' name="t_final_state_id"/>
															<input type="text" class="form-control" id ="t_final_state_name" name="t_final_state_name" placeholder="Select State" readonly/>
															</div>
														</div>
														<input type='hidden' id='t_final_country_id' name="t_final_country_id"/>
														<input type="hidden" class="form-control" id ="t_final_country_name" name="t_final_country_name" placeholder="Select Country" readonly/>
														<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
															<div class="input-field">
															<label for="from">Final Country</label>
																<input type='hidden' id='t_final_country_id' name="t_final_country_id"/>
																<input type="hidden" class="form-control" id ="t_final_country_name" name="t_final_country_name" placeholder="Select Country" readonly/>
															</div>
														</div> -->
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--panel panel-default-->
									<div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse"  data-parent="#TransportAccordion" href="#TransportComment">
                                                  Comments</a>
                                            </h4>
                                        </div>
                                        <div id="TransportComment" class="panel-collapse collapse">
                                            <div class="panel-body">
												<div class="form">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
														<div class="input-field">
															<label for="from">Comment Box</label>
															<textarea name="comment" class="form-control mt" cols="" rows="4"></textarea>
														</div>
													</div> 
												</div>
                                            </div>
                                        </div>
                                    </div>
									<!--panel panel-default-->
								</div>
								<!--panel-group for Hotel-->
								<div class="margi text-center">
									<input type="submit" class="btn btn-primary btn-submit" value="Submit">
								</div>
								
							</div>
							</form>
							<!--Form Box for Hotel-->
                        </div>
						<!-- Tab 3-->
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
jQuery(document).ready(function () {
    	$('#tabtransport').click(function (e) {
    		$('.newdiv').remove();
			$('.remove_field').remove();
    	});
        // This button will increment the value
        $('#btnplus').click(function () {
			 var counter = $('#textcounter').val();
                    counter++ ;
                    $('#textcounter').val(counter);
        });
		$('#btnminus').click(function () {
			 var counter = $('#textcounter').val();
                    counter-- ;
                    $('#textcounter').val(counter);
        });
		 $('#btnplus1').click(function () {
			 var counter1 = $('#textcounter1').val();
                    counter1++ ;
                    $('#textcounter1').val(counter1);
        });
		$('#btnminus1').click(function () {
			 var counter1 = $('#textcounter1').val();
                    counter1-- ;
                    $('#textcounter1').val(counter1);
        });
           
    });

</script>

<script>
    $('.btnNext').click(function () {
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
    });

    $('.btnPrevious').click(function () {
        $('.nav-tabs > .active').prev('li').find('a').trigger('click');
    });
</script>
<script>
    $(document).ready(function () {
        var max_fields = 10;
        var wrapper = $(".input_fields_wrap");
        var add_button5 = $(".add_field_button");
        var packageI = 1;
        $(".package-stop-add").click(function (e) {
        
            e.preventDefault();
            var strHtml = '<div class="stop"><div class="stop-title">Stop ' +packageI+ '</div><div class="row">';
        	strHtml += '<div class="col-sm-6 mt"><div class="input-field"><label for="from">Stop Locality</label><input class="form-control" type="text" placeholder="Enter Locality or Village or Town" name="stops[' +packageI+ ']"></div></div>';
        	strHtml += '<div class="col-sm-6 mt"><div class="input-field"><label for="from">Stop City</label><input class="trans_city form-control" type="text" placeholder="Select City or Nearest City" use_for = "package" numCount = ' +packageI+ ' id="package_stop_city[' +packageI+ ']" name="trasport_stop_city[' +packageI+ ']"><input type="hidden" id="id_package_stop_city[' +packageI+ ']" name="id_package_stop_city[' +packageI+ ']" /></div></div>';
        	strHtml += '<div class="col-sm-6 mt"><div class="input-field"><label for="from">Stop State</label><input type="hidden" id="state_id_package_stop_city[' +packageI+ ']" name="state_id_package_stop_city[' +packageI+ ']"/><input class="form-control" type="text" placeholder="State" id ="state_name_package_stop_city[' +packageI+ ']" name="state_name_package_stop_city[' +packageI+ ']" readonly></div></div></div>';
        	strHtml += '<button class="package_remove_stop">Remove stop</button>';
         strHtml += '</div>';
        $(".package-stops").append(strHtml);
        	packageI++;
        });
        $(document).on("click", ".package_remove_stop", function (e) {
            e.preventDefault();
            packageI--;
            $(this).parent('.stop').slideUp(function(){
				$(this).remove();
var gg = 1;
		$( ".stop-title" ).each(function() {
		var htmlString = 'Stop '+gg;
  		$( this ).text( htmlString );
	    gg++;
		});
			});
        });

        var transI = 1;
        $(".transport-stop-add").click(function(e){
e.preventDefault();
        var strHtml = '<div class="stop"><div class="stop-title">Stop ' +transI+ '</div><div class="row">';
        strHtml += '<div class="col-sm-6 mt"><div class="input-field"><label for="from">Stop Locality</label><input class="form-control" type="text" placeholder="Enter Locality or Village or Town" name="stops[' +transI+ ']"></div></div>';
        strHtml += '<div class="col-sm-6 mt"><div class="input-field"><label for="from">Stop City</label><input class="trans_city form-control" type="text" placeholder="Select City or Nearest City" use_for = "trasport" numCount = ' +transI+ ' id="trasport_stop_city[' +transI+ ']" name="trasport_stop_city[' +transI+ ']"><input type="hidden" id="id_trasport_stop_city[' +transI+ ']" name="id_trasport_stop_city[' +transI+ ']" /></div></div>';
        strHtml += '<div class="col-sm-6 mt"><div class="input-field"><label for="from">Stop State</label><input type="hidden" id="state_id_trasport_stop_city[' +transI+ ']" name="state_id_trasport_stop_city[' +transI+ ']"/><input class="form-control" type="text" placeholder="State" id ="state_name_trasport_stop_city[' +transI+ ']" name="state_name_trasport_stop_city[' +transI+ ']" readonly></div></div></div>';
         strHtml += '<button class="transport_remove_stop but">Remove stop</button>';
         strHtml += '</div>';
         $(".transport-stops").append(strHtml);
         transI++;
        })

        $(document).on("click", ".transport_remove_stop", function (e) {

            e.preventDefault();
            transI--;
            $(this).parent('.stop').slideUp(function(){
				$(this).remove();
var f = 1;
		$( ".stop-title" ).each(function() {
		var htmlString = 'Stop '+f;
  		$( this ).text( htmlString );
	    f++;
		});
			});
        });
        
        
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js"></script>
<script>
	$(window).on("load", function(){
		$("#h_hotel_category").multiselect();
		$("#hotel_category").multiselect();

	});
    $(document).ready(function () {

        var wrapper = $(".input_fields_wrap1");
		$(wrapper).on("click", ".remove_field", function (e) {
            e.preventDefault();
            $(this).parent('div').slideUp(function(){
				$(this).remove();
			});
        });
        var max_fields = 10;
        var add_button = $(".add_field_button2");

        var x = 1;
        $(add_button).click(function (e) {
            e.preventDefault();
			var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'addNewDestinationRow')) ?>";
			var number = Math.floor((Math.random() * 100000) + 1);
			$.ajax({
				url:url,
				type: 'POST',
				data: {"number":number},
				async:false
			}).done(function(result){
				$(wrapper).append(result);

				$(wrapper).find("input[name='hh_room1["+number+"]']").val($("#room1").val());
				$(wrapper).find("input[name='hh_room2["+number+"]']").val($("#room2").val());
				$(wrapper).find("input[name='hh_room3["+number+"]']").val($("#room3").val());
				$(wrapper).find("input[name='hh_child_with_bed["+number+"]']").val($("#child_with_bed").val());
				$(wrapper).find("input[name='hh_child_without_bed["+number+"]']").val($("#child_without_bed").val());
$(".hh_hotel_category").multiselect();
				$(wrapper).find("input:text[name='hh_city_name["+number+"]']").autocomplete({
					source: JSON.parse(cityData),
					select: function (e, ui) {
						e.preventDefault();

						$(this).val(ui.item.label);
						$(wrapper).find("input:hidden[name='hh_city_id["+number+"]']").val(ui.item.value);

						$(wrapper).find("input:hidden[name='hh_state_id["+number+"]']").val(ui.item.state_id);
						$(wrapper).find("input:text[name='hh_state_name["+number+"]']").val(ui.item.state_name);

						$(wrapper).find("input:hidden[name='hh_country_id["+number+"]']").val(ui.item.country_id);
						$(wrapper).find("input:text[name='hh_country_name["+number+"]']").val(ui.item.country_name);
					}
				});
				//$(wrapper).find("input:text[name='hh_check_in["+number+"]']").datepicker();
				//$(wrapper).find("input:text[name='hh_check_out["+number+"]']").datepicker();

				var checkInDatePicker = $(wrapper).find("input:text[name='hh_check_in["+number+"]']");
				var checkOutDatePicker = $(wrapper).find("input:text[name='hh_check_out["+number+"]']");
				//checkInDatePicker.datepicker();
				//checkOutDatePicker.datepicker();

				var lastdate = '';
							
				
				var enddate ='';
				var enddate2 = $('#datepicker8').val();
				var enddate1 = $(".enddate").val();
				if (enddate1 == '' || enddate1==null)
				{
				var enddate =enddate2;
				}else{
				$("#collapse2 .enddate").each(function() {
					if ($(this).val()=='' || $(this).val()==null) {
					x=1	
					}else{
						lastdate = $(this).val();
					}
				});	
				var enddate =enddate1;
				}
				if (lastdate=='' || lastdate==null) {
				var k=1;
				}else{
				enddate	= lastdate;
				}
				checkInDatePicker.datepicker({
					dateFormat: 'dd/mm/yy',
					changeMonth: true,
					changeYear: true,
					//minDate: '<?php echo date("d/m/Y"); ?>',
					minDate: enddate,
					onSelect: function(selected) {
						checkOutDatePicker.datepicker( "option", "minDate",selected);
						checkOutDatePicker.val("");
					}
				});
				checkOutDatePicker.datepicker({
					dateFormat: 'dd/mm/yy',
					changeMonth: true,
					changeYear: true,
					//minDate: '<?php echo date("d/m/Y"); ?>',
					minDate: enddate,
					onSelect: function(selected) {
						var checkInDate = checkInDatePicker.val();
						if(checkInDate == "") {
							alert("Please select check-in date first.");
							checkOutDatePicker.val("");
						}
					}
				});
			});
			return false;
        });
        $(wrapper).on("click", ".remove_field1", function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>


<?php //echo $this->element('footer'); ?>

<script>
	$(function ()
	{
		$("#wizard").steps({
			headerTag: "h2",
			bodyTag: "section",
			transitionEffect: "slideLeft"
		});
	});
</script>		
<script>
$('#PackgeRequestForm').validate({
	rules: {
		"reference_id" : {
			required : true
		},
		"total_budget" : {
			required : true
		},
		"adult":{
		required : true,
		min: 1
		},
		"children":{
		required : true,
		min: 0
		},
		"check_in" : {
			required : true
		},
		"check_out": {
			required : true,
		},
		"city_id": {
			required: true
		},
		
		"pincode": {
			required: true
		}
	},
	messages: {
		"reference_id" : {
			required : "Please enter reference id."
		},
		"total_budget" : {
			required : "Please enter total budget."
		},
		"adult" : {
			required : "Please enter number of adults."
		},
		"children" : {
			required : "Please enter number of children."
		},
		"check_in" : {
			required : "Please select check-in date."
		},
		"check_out": {
			required : "Please select check-out date."
		},
		"city_id": {
			required: "Please select city."
		},
	
		"pincode": {
			required: "Please enter pincode."
		}
	},
	ignore: ""
});
$('#HotelRequestForm').validate({
	rules: {
		"reference_id" : {
			required : true
		},
		"hotelAdult":{
		required : true,
		min: 1
		},
		"hotelChildren":{
			required : true,
		min: 0
		},
		"total_budget" : {
			required : true
		},
		"check_in" : {
			required : true
		},
		"check_out": {
			required : true,
		},
		"h_city_id": {
			required: true
		},
	
	},
	messages: {
		"reference_id" : {
			required : "Please enter reference id."
		},
		"total_budget" : {
			required : "Please enter total budget."
		},
		"hotelAdult" : {
			required : "Please enter number of adults."
		},
		"hotelChildren" : {
			required : "Please enter number of children."
		},
		"check_in" : {
			required : "Please select check-in date."
		},
		"check_out": {
			required : "Please select check-out date."
		},
		"h_city_id": {
			required: "Please select city."
		},
		"locality": {
			required: "Please enter locality."
		}
	},
	ignore: ""
});
$('#TransportRequestForm').validate({
	rules: {
		"reference_id" : {
			required : true
		},
		"total_budget" : {
			required : true
		},
		"transportAdult":{
		required : true,
		min: 1
		},
		"transportChildren":{
		required : true,
		min: 0
		},
		"start_date" : {
			required : true
		},
		"end_date": {
			required : true,
		},
		"t_pickup_city_id": {
			required: true
		},
		"t_final_city_id": {
			required: true
		},
		"pickup_locality": {
			required: true
		}
	},
	messages: {
		"reference_id" : {
			required : "Please enter reference id."
		},
		"total_budget" : {
			required : "Please enter total budget."
		},
		"transportAdult" : {
			required : "Please enter number of adults."
		},
		"transportChildren" : {
			required : "Please enter number of children."
		},
		"start_date" : {
			required : "Please select start date."
		},
		"end_date": {
			required : "Please select end date."
		},
		"t_pickup_city_id": {
			required: "Please select city."
		},
		"t_final_city_id": {
			required: "Please select city."
		},
		"pickup_locality": {
			required: "Please enter locality."
		}
	},
	ignore: ""
});
 
$('#PackgeRequestForm').submit(function(){
if ($("#PackgeRequestForm").valid()) {
$(this).find(':input[type=submit]').prop('disabled', true);
}else{
alert('Please Check All Required Fields.');
}   
});

$('#HotelRequestForm').submit(function(){
if ($("#HotelRequestForm").valid()) {
$(this).find(':input[type=submit]').prop('disabled', true);
}else{
alert('Please Check All Required Fields.');
}   
});

$('#TransportRequestForm').submit(function(){
if ($("#TransportRequestForm").valid()) {
$(this).find(':input[type=submit]').prop('disabled', true);
}else{
alert('Please Check All Required Fields.');
}   
});	

$('#accordion').on('shown.bs.collapse', function () {
	
 $('.ref2').focus()
});
</script>