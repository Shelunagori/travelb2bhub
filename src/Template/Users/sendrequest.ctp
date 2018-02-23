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
				$(this).val(ui.item.p);
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
				$(this).val(ui.item.p);
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
				$(this).val(ui.item.p);
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
				$(this).val(ui.item.p);
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
					$(this).val(ui.item.p);
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
				$(this).val(ui.item.p);
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
				$(this).val(ui.item.p);
				$("#p_final_state_id").val(ui.item.state_id);
				$("#p_final_state_name").val(ui.item.state_name);
			
			}
		});

		// Overrides the default autocomplete filter function to search only from the beginning of the string
		$.ui.autocomplete.filter = function (array, term) {
			var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i");
			return $.grep(array, function (value) {
				return matcher.test(value.p);
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
						<li class="active">
						<a href="#tab2" data-toggle="tab">Package</a></li>
						<li><a href="#tab1" data-toggle="tab">Hotel</a></li>
						<li><a id="tabtransport" href="#tab3" data-toggle="tab">Transport</a>
						</li>
					</ul>
				
<div class="tab-pane" id="tab1">
<?php
 echo $this->Form->create(null, [
	'type' => 'file',
	'url' => ['controller' => 'Users', 'action' => 'sendrequest'], "id"=>"HotelRequestForm"
]);
?>
<input autocomplete="off" name="category_id" type="hidden" value="3" class="form-control" id="date-start" placeholder="Reference id"/>
<div class="form-box">
	<div class="panel-group" id="HotelAccordion" style="background-color:white;">
		<div class="panel panel-default">
				<h4 class="panel-title ">
				<fieldset>
					  <legend style="color:#369FA1;"><b>GENERAL REQUIREMENTS:</b></legend>
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
									<p class="input-group-addon btn" >
									<button type="button" class="fa fa-minus-square" id="btnminus" value=""></button>
									</p>                    
									<input type='text' autocomplete="off" name='children' value='1' class="form-control input-large" id="textcounter"/>	
									<p class="input-group-addon btn" >
									<button type="button" class="fa fa-plus-square" id="btnplus" value=""></button>
									</p>                    
									</div>
									</div>
				   
								<div class="col-md-6">
								<p for="from">Children below 6  </p>
									<div class="col-md-6 input-group">
									<p class="input-group-addon btn" >
									<button type="button" class="fa fa-minus-square" id="btnminus1" value=""></button>
									</p>                    
									 <input type='text' autocomplete="off" name='children' value='1' class="form-control input-large" id="textcounter1"/>	
									<p class="input-group-addon btn">
									<button type="button" class="fa fa-plus-square" id="btnplus1" value=""></button>
									</p>                    
									</div>
								</div>
							</div>
						</div>
					</fieldset>
				</h4>
				<h4 class="panel-title">
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
						</div>
					</fieldset>
				</h4>
						<h4 class="panel-title">
												<fieldset>
													<legend style="color:#369FA1;"><b>Comment Box</b></legend>
											<div class="row">
												<div class="col-md-12">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
														<div class="input-field">
															<p for="from"></p>
															<textarea name="comment" class="form-control mt" cols="" rows="4"></textarea>
														</div>
													</div> 
												</div>
											</div>
												</fieldset>
										</h4>			
											<div class="row">
											<div class="col-md-4"></div>
													<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 mt">
														<div class="input-field">
															<div class="margin text-center">
															<center><input type="submit" class="btn btn-primary btn-submit" value="Submit"></center>
															</div>
														</div>
													</div> 
											</div>
										</div>
									</div>
								</div>
							</div>
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
		<div class="panel panel-default">
			<h4 class="panel-title">
			<fieldset>
				  <legend style="color:#369FA1;"><b>GENERAL REQUIREMENTS:</b></legend>
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
									<p class="input-group-addon btn" >
									<button type="button" class="fa fa-minus-square"  id="btn_pack_minus" value="-"></button>
									</p>
									<input type='text' autocomplete="off" name='children' value='1' class="form-control input-large" id="text_counter_pack"/>
									<p class="input-group-addon btn">
									<button type="button" class="fa fa-plus-square" id="btn_pack_plus" value=""></button>
								   </p>    
								</div>
							</div>
							<div class="col-md-6">
								<p for="from">Children below 6  </p>
									<div class="col-md-6 input-group">
									<p class="input-group-addon btn" >
									<button type="button" class="fa fa-minus-square" id="btn_pack_minus1" value=""></button>
									</p>                    
									 <input type='text' autocomplete="off" name='children' value='1' class="form-control input-large" id="text_counter_pack1"/>	
									<p class="input-group-addon btn">
									<button type="button" class="fa fa-plus-square" id="btn_pack_plus1" value=""></button>
									</p>                    
									</div>
							</div>
						</div>
					</div>
			</fieldset>
		</h4>
		<h4 class="panel-title">
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
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt padding0">
                                     <div class="input_fields_wrap1">
                                      </div> 
									<button class="btn btn-default btn-lg add_field_button2 but ">Add Another Destination</button>
                             </div>
                        </div>
					</fieldset>
				</h4>
								<h4 class="panel-title">
											<fieldset>
													<legend style="color:#369FA1;"><b>Transport</b></legend>
													<div class="row">
														<div class="col-md-12 ">
															<div class="input-field">
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
													</div>
											<div class="row">
											<div class=" col-md-12">
													<div class="col-md-6">
														<div class="input-field">
															<p for="from">
																Start Date
															</p>
														</div>
														<div class="col-md-6 input-group">
															 <input autocomplete="off" name="start_date" type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" id="datepicker3" placeholder="dd-mm-yyyy"/>
															<p class="input-group-addon btn" for="testdate">
															<span class="fa fa-calendar"></span>
															</p>                    
														</div>
													</div>
													<div class="col-md-6">
														<div class="input-field">
																	<p for="from">
																		End Date
																	</p>
														</div>
														<div class="col-md-6 input-group">
															 <input autocomplete="off" name="end_date" type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" id="datepicker4" placeholder="dd-mm-yyyy"/>
															<p class="input-group-addon btn" for="testdate">
															<span class="fa fa-calendar"></span>
															</p>                    
														</div>
													</div>
												</div>
											</div><span class="help-block"></span>
											<div class="row">
												<div class="col-md-12">
												    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mt">
                                                            <div class="input-field">
                                                            <p for="from">Pickup Locality
                                                                
                                                            </p>
                                                            <input autocomplete="off" type="text" class="form-control" name="pickup_locality" id="pickup_locality" placeholder="Enter Locality or Village or Town"/>
                                                            </div>
                                                    </div>
                                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mt">
                                                            <div class="input-field">
                                                                <p for="from">Pickup City
                                                                    
                                                                </p>
                                                                <input type="text" class="form-control" id="t_pickup_city_name" name="t_pickup_city_name"  placeholder="Select City or Nearest City"/>
                                                                <input type='hidden' id='t_pickup_city_id' name="t_pickup_city_id" />

                                                            </div>
                                                    </div>										
												</div>
											</div><span class="help-block"></span>
											<div class="row">
												<div class="col-md-12">
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mt">
															<div class="input-field">
															<p for="from">Pickup State</p>
																<input type='hidden' id='t_pickup_state_id' name="t_pickup_state_id"/>
															<input type="text" class="form-control" id ="t_pickup_state_name" name="t_pickup_state_name" placeholder="State">
															</div>
														</div>
												
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mt">
															<div class="input-field">
															<p for="from">Pickup Country</p>
																<input type='hidden' id='t_pickup_country_id' name="t_pickup_country_id"/>
																<input type="text" class="form-control" id ="t_pickup_country_name" name="t_pickup_country_name" placeholder="Select Country" />
															</div>
														</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
															
																<div class="input_fields_wrap1">
																		<button class="but btn-default btn-lg transport-stop-add">ADD STOP</button>
																 </div> 
														</div>
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
														<!-- <div class="col-xxs-12 text-center">
																<div class="input_fields_wrap">
																	<button class="add_field_button but">Add Stop</button>
																	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
																		<div class="input-field">
																			<p for="from" style="float:left;">Stop Name</p>
																			<input class="form-control" type="text" placeholder="Stop Name" name="stops[]">
																		</div>
																	</div>
																</div>
															</div>  -->
														</div>
												</div>
											</div><span class="help-block"></span>
											<div class="row">
												<div class="col-md-12">
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mt">
														<div class="input-field">
															<p for="from">Final Locality
                                                                </p>
															<input class="form-control" type="text" placeholder="Enter Locality or Village or Town" name="finalLocality"/>
														</div>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mt">
															<div class="input-field">
																<p for="from">Final City
                                                                     
                                                                </p>
																<input type="text" class="form-control" id="t_final_city_name" name="t_final_city_name" placeholder="Select City or Nearest City"/>
																<input type='hidden' id='t_final_city_id' name="t_final_city_id" />
																
															</div>
														</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="col-lg-6 col-md-12 col-sm-6 col-xs-12 mt">
															<div class="input-field">
															<p for="from">Final State</p>
																<input type='hidden' id='t_final_state_id' name="t_final_state_id"/>
															<input type="text" class="form-control" id ="t_final_state_name" name="t_final_state_name" placeholder="Select State" />
															</div>
														</div>
														<input type='hidden' id='t_final_country_id' name="t_final_country_id"/>
														<input type="hidden" class="form-control" id ="t_final_country_name" name="t_final_country_name" placeholder="Select Country" readonly/>
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
															<div class="input-field">
															<p for="from">Final Country</p>
																<input type='hidden' id='t_final_country_id' name="t_final_country_id"/>
																<input type="text" class="form-control" id ="t_final_country_name" name="t_final_country_name" placeholder="Select Country" />
															</div>
														</div>
												</div>
											</div>
											</fieldset>
											</h4>
										<h4 class="panel-title">
												<fieldset>
													<legend style="color:#369FA1;"><b>Comment Box</b></legend>
											<div class="row">
												<div class="col-md-12">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
														<div class="input-field">
															<p for="from"></p>
															<textarea name="comment" class="form-control mt" cols="" rows="4"></textarea>
														</div>
													</div> 
												</div>
											</div>
												</fieldset>
										</h4>			
											<div class="row">
											<div class="col-md-4"></div>
													<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 mt">
														<div class="input-field">
															<div class="margin text-center">
															<center><input type="submit" class="btn btn-primary btn-submit" value="Submit"></center>
															</div>
														</div>
													</div> 
											</div>
																			
									</div>
							
					</div>
				</div>
			</div>
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
								<div class="panel-group" id="TransportAccordion" style="background-color:white;">
									<div class="panel panel-default">
										<h4 class="panel-title">
											<fieldset>
												  <legend style="color:#369FA1;"><b>GENERAL REQUIREMENTS:</b></legend>
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
																	<p class="input-group-addon btn" >
																	<button type="button" class="fa fa-minus-square" id="btn_tran_minus" value=""></button>
																	</p>                    
																	<input type='text' autocomplete="off" name='children' value='1' class="form-control input-large" id="text_trans_counter"/>	
																	<p class="input-group-addon btn" >
																	<button type="button" class="fa fa-plus-square" id="btn_tran_plus" value=""></button>
																	</p>                    
																</div>
															</div>
												   
															<div class="col-md-6">
																<p for="from">Children below 6  </p>
																	<div class="col-md-6 input-group">
																	<p class="input-group-addon btn" >
																	<button type="button" class="fa fa-minus-square" id="btn_tran_minus1" value=""></button>
																	</p>                    
																	 <input type='text' autocomplete="off" name='children' value='1' class="form-control input-large" id="text_trans_counter1"/>	
																	<p class="input-group-addon btn">
																	<button type="button" class="fa fa-plus-square" id="btn_tran_plus1" value=""></button>
																	</p>                    
																	</div>
															</div>
														</div>
													</div>
											</fieldset>
											</h4>
											<h4 class="panel-title">
											<fieldset>
													<legend style="color:#369FA1;"><b>Transport</b></legend>
													<div class="row">
														<div class="col-md-12 ">
															<div class="input-field">
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
													</div>
											<div class="row">
											<div class=" col-md-12">
													<div class="col-md-6">
														<div class="input-field">
															<p for="from">
																Start Date
															</p>
														</div>
														<div class="col-md-6 input-group">
															 <input autocomplete="off" name="start_date" type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" id="datepicker3" placeholder="dd-mm-yyyy"/>
															<p class="input-group-addon btn" for="testdate">
															<span class="fa fa-calendar"></span>
															</p>                    
														</div>
													</div>
													<div class="col-md-6">
														<div class="input-field">
																	<p for="from">
																		End Date
																	</p>
														</div>
														<div class="col-md-6 input-group">
															 <input autocomplete="off" name="end_date" type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" id="datepicker4" placeholder="dd-mm-yyyy"/>
															<p class="input-group-addon btn" for="testdate">
															<span class="fa fa-calendar"></span>
															</p>                    
														</div>
													</div>
												</div>
											</div><span class="help-block"></span>
											<div class="row">
												<div class="col-md-12">
												    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mt">
                                                            <div class="input-field">
                                                            <p for="from">Pickup Locality
                                                                
                                                            </p>
                                                            <input autocomplete="off" type="text" class="form-control" name="pickup_locality" id="pickup_locality" placeholder="Enter Locality or Village or Town"/>
                                                            </div>
                                                    </div>
                                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mt">
                                                            <div class="input-field">
                                                                <p for="from">Pickup City
                                                                    
                                                                </p>
                                                                <input type="text" class="form-control" id="t_pickup_city_name" name="t_pickup_city_name"  placeholder="Select City or Nearest City"/>
                                                                <input type='hidden' id='t_pickup_city_id' name="t_pickup_city_id" />

                                                            </div>
                                                    </div>										
												</div>
											</div><span class="help-block"></span>
											<div class="row">
												<div class="col-md-12">
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mt">
															<div class="input-field">
															<p for="from">Pickup State</p>
																<input type='hidden' id='t_pickup_state_id' name="t_pickup_state_id"/>
															<input type="text" class="form-control" id ="t_pickup_state_name" name="t_pickup_state_name" placeholder="State">
															</div>
														</div>
												
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mt">
															<div class="input-field">
															<p for="from">Pickup Country</p>
																<input type='hidden' id='t_pickup_country_id' name="t_pickup_country_id"/>
																<input type="text" class="form-control" id ="t_pickup_country_name" name="t_pickup_country_name" placeholder="Select Country" />
															</div>
														</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														
															<div class="input_fields_wrap1">
                                                                    <button class="but btn-default btn-lg transport-stop-add">ADD STOP</button>
                                                             </div> 
											</div>
													<!-- <div class="col-xxs-12 text-center">
															<div class="input_fields_wrap">
																<button class="add_field_button but">Add Stop</button>
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
																	<div class="input-field">
																		<p for="from" style="float:left;">Stop Name</p>
																		<input class="form-control" type="text" placeholder="Stop Name" name="stops[]">
																	</div>
																</div>
															</div>
														</div>  -->
												</div>
											</div><span class="help-block"></span>
											<div class="row">
												<div class="col-md-12">
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mt">
														<div class="input-field">
															<p for="from">Final Locality
                                                                  
                                                                </p>
															<input class="form-control" type="text" placeholder="Enter Locality or Village or Town" name="finalLocality"/>
														</div>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mt">
															<div class="input-field">
																<p for="from">Final City
                                                                     
                                                                </p>
																<input type="text" class="form-control" id="t_final_city_name" name="t_final_city_name" placeholder="Select City or Nearest City"/>
																<input type='hidden' id='t_final_city_id' name="t_final_city_id" />
																
															</div>
														</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="col-lg-6 col-md-12 col-sm-6 col-xs-12 mt">
															<div class="input-field">
															<p for="from">Final State</p>
																<input type='hidden' id='t_final_state_id' name="t_final_state_id"/>
															<input type="text" class="form-control" id ="t_final_state_name" name="t_final_state_name" placeholder="Select State" />
															</div>
														</div>
														<input type='hidden' id='t_final_country_id' name="t_final_country_id"/>
														<input type="hidden" class="form-control" id ="t_final_country_name" name="t_final_country_name" placeholder="Select Country" readonly/>
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
															<div class="input-field">
															<p for="from">Final Country</p>
																<input type='hidden' id='t_final_country_id' name="t_final_country_id"/>
																<input type="text" class="form-control" id ="t_final_country_name" name="t_final_country_name" placeholder="Select Country" />
															</div>
														</div>
												</div>
											</div>
											</fieldset>
											</h4>
											<h4 class="panel-title">
												<fieldset>
													<legend style="color:#369FA1;"><b>Comment Box</b></legend>
											<div class="row">
												<div class="col-md-12">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
														<div class="input-field">
															<p for="from"></p>
															<textarea name="comment" class="form-control mt" cols="" rows="4"></textarea>
														</div>
													</div> 
												</div>
											</div>
											</fieldset>
											</h4>
											<div class="row">
											<div class="col-md-4"></div>
													<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 mt">
														<div class="input-field">
															<div class="margin text-center">
															<center><input type="submit" class="btn btn-primary btn-lg btn-submit" value="Submit"></center>
															</div>
														</div>
													</div> 
											</div>	
																							
										</div>
									</div>
								</div>
							</div>		
							<!--Form Box for Hotel-->
                        </div>
					</div>
				</div>
			</hr>
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
		 $('#btn_pack_plus').click(function () {
			 var counter = $('#text_counter_pack').val();
                    counter++ ;
                    $('#text_counter_pack').val(counter);
        });
		$('#btn_pack_minus').click(function () {
			 var counter = $('#text_counter_pack').val();
                    counter-- ;
                    $('#text_counter_pack').val(counter);
        });
		 $('#btn_pack_plus1').click(function () {
			 var counter = $('#text_counter_pack1').val();
                    counter++ ;
                    $('#text_counter_pack1').val(counter);
        });
		$('#btn_pack_minus1').click(function () {
			 var counter = $('#text_counter_pack1').val();
                    counter-- ;
                    $('#text_counter_pack1').val(counter);
        });
		$('#btn_tran_plus').click(function () {
			 var counter = $('#text_trans_counter').val();
                    counter++ ;
                    $('#text_trans_counter').val(counter);
        });
		$('#btn_tran_minus').click(function () {
			 var counter = $('#text_trans_counter').val();
                    counter-- ;
                    $('#text_trans_counter').val(counter);
        });
		 $('#btn_tran_plus1').click(function () {
			 var counter = $('#text_trans_counter1').val();
                    counter++ ;
                    $('#text_trans_counter1').val(counter);
        });
		$('#btn_tran_minus1').click(function () {
			 var counter = $('#text_trans_counter1').val();
                    counter-- ;
                    $('#text_trans_counter1').val(counter);
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
        	strHtml += '<div class="col-sm-6 mt"><div class="input-field"><p for="from">Stop Locality</p><input class="form-control" type="text" placeholder="Enter Locality or Village or Town" name="stops[' +packageI+ ']"></div></div>';
        	strHtml += '<div class="col-sm-6 mt"><div class="input-field"><p for="from">Stop City</p><input class="trans_city form-control" type="text" placeholder="Select City or Nearest City" use_for = "package" numCount = ' +packageI+ ' id="package_stop_city[' +packageI+ ']" name="trasport_stop_city[' +packageI+ ']"><input type="hidden" id="id_package_stop_city[' +packageI+ ']" name="id_package_stop_city[' +packageI+ ']" /></div></div>';
        	strHtml += '<div class="col-sm-6 mt"><div class="input-field"><p for="from">Stop State</p><input type="hidden" id="state_id_package_stop_city[' +packageI+ ']" name="state_id_package_stop_city[' +packageI+ ']"/><input class="form-control" type="text" placeholder="State" id ="state_name_package_stop_city[' +packageI+ ']" name="state_name_package_stop_city[' +packageI+ ']" readonly></div></div></div>';
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
        strHtml += '<div class="col-sm-6 mt"><div class="input-field"><p for="from">Stop Locality</p><input class="form-control" type="text" placeholder="Enter Locality or Village or Town" name="stops[' +transI+ ']"></div></div>';
        strHtml += '<div class="col-sm-6 mt"><div class="input-field"><p for="from">Stop City</p><input class="trans_city form-control" type="text" placeholder="Select City or Nearest City" use_for = "trasport" numCount = ' +transI+ ' id="trasport_stop_city[' +transI+ ']" name="trasport_stop_city[' +transI+ ']"><input type="hidden" id="id_trasport_stop_city[' +transI+ ']" name="id_trasport_stop_city[' +transI+ ']" /></div></div>';
        strHtml += '<div class="col-sm-6 mt"><div class="input-field"><p for="from">Stop State</p><input type="hidden" id="state_id_trasport_stop_city[' +transI+ ']" name="state_id_trasport_stop_city[' +transI+ ']"/><input class="form-control" type="text" placeholder="State" id ="state_name_trasport_stop_city[' +transI+ ']" name="state_name_trasport_stop_city[' +transI+ ']" readonly></div></div></div>';
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

						$(this).val(ui.item.p);
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