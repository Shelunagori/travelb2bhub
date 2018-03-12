        <?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
        <script>
         $(document).ready(function(){			
			$("#city").on('change', function() {
			   //var price = $('#city selected').val();
				var price=$("#city option:selected").val();
				var countries=[];
				$.each($("#city option:selected"), function(){            
					countries.push($(this).val());				 
				});
			   if(countries.length>0){
			   prices = '"'+countries+'"';
			   alert(prices);
			   prices = String(countries);
			   if (prices.indexOf(",") > -1)
			   {   
			   $('#hiddencharges').val('');
			   $('#charges').val('');
			   $('#charges1').html('0');
				arr = prices.split(',');
				for(i=0; i < arr.length; i++){
				checkcitystatus(arr[i]);
				charges1(arr[i]);
				}
			   }else{
			   if (countries==null) {
			   $('#hiddencharges').val('');
			   $('#charges').val('');
			   $('#charges1').html('0');
			   }else{
			 checkcitystatus(countries);
				 charges(countries);
				// $('option:selected', this).remove();
				}
				}
			   }
			});
           $(".previewform").click(function(){
           var hotel_category =  $("#hotel_categories").find('option:selected').text();
             $('#hotelname').html($('#hotel_name').val());
             $('#hoteltype').html(hotel_category);
         	 $('#hotellocation').html(  $('#hotel_location').val());
             $('#hotelprice').html($('#cheap_tariff').val() + '-'+ $('#expensive_tariff').val());
             $('#hotelwebsite').html( $('#website').val());
             });
        

         $(".imgInp").change(function(){
    readURL(this);
});
            });
            function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
        
       
        
            $('#hotelimage').attr('src', e.target.result);
            
        }

        reader.readAsDataURL(input.files[0]);
    }
}
 </script>
 <?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>

<?php
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
?>
<style>
	legend {
		text-align:center;
	}
</style>

	<div id="my_final_responses" class="container-fluid">
	<div class="row equal_column">
	<div class="col-md-12" style="background-color:#fff"> 
		<br>
		<?php echo $this->element('subheader');?>
		<?php echo  $this->Flash->render() ?>
	</div>
	<div class="col-md-12" style="background-color:#fff"> 
     <div class="box box-default">
	<div class="box-header with-border"> 
		<h3 class="box-title" style="padding:20px">Promote your hotel</h3>
		<div class="box-tools pull-right">
			
		</div>
	</div>
	<div class="box-body">
		<div class="row">
		<center>
			<div class="col-md-12">
					<div class="box-body">
						<div>
							<div class="form-group col-md-12">
								  <div class="col-md-12">
										<h3>Promotions will be free till</h3>
										<a href="#" class="unfollow btn btn-success btn-sm"> 31st March 2018</a>
									</div>
						 
							</div>
						</div>
					</div>
				 
				</div>
			</center>	
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  margin-b15 padding-lr7per"> 
              <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                          Why promote your hotel at TravelB2BHub?
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                      <div class="panel-body" style="margin-left:20px;">
                          <h5>Promoting your Hotel on TravelB2BHub helps you:</h5>
                          <ol>
								<li>
									<strong>
										1. Increase your reach:
									</strong>
										Increase your business by connecting with new Travel Agents/ Event Planners to build lasting relationships.
								</li>
								<li>
									<strong> 
										2. Do Targeted Marketing: 
									</strong>
										Pick specific cities where you want to drive business from, or reach new cities where you didn’t previously have a marketing presence.
								</li>
								<li>
									<strong> 
										3. Analyze your promotion’s performance: 
									</strong>
										On your personal profile, you will be able to see how your promotion is performing, and the number/ type of people/regions responded to your promotions initiative.
								</li>
								<li>
									<strong> 
										4. Pay nominal price: 
									</strong>
										Do all of the above at a small fraction of the cost of attending Travel and Tourism Fairs, or using sales reps.
								</li>
                          </ol>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                          How it works?
                        </a>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                      <div class="panel-body">
                          <p>You, as a <strong>Hotelier/ Hotel’s representative,</strong> may pick the cities where you want your promotional coverage. The Hotel’s Photo and details will be featured on the TravelB2BHub profiles of all the Travel Agents and Event Planners from the chosen cities for a set time period. </p>
                          <p>In order to provide transparency in what the promoter will get for their investment, they will be able to see the count of Travel Agents and Event Planners present in each city before they finalize the payment.</p>
                          <p>After initiating promotions, the performance statistics of the initiative will be available on the Hotelier’s TravelB2BHub profile.</p>
                      </div>
                    </div>
                  </div>
                  <?php if($userId=="" || (isset($userDetails->id) && $userDetails->role_id!=3) ) { ?>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                          Getting Started?
                        </a>
                      </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                      <div class="panel-body">
                          <h5>There is an easy four step process to promote your hotel on TravelB2BHub:</h5>
                          
                          
                          <ul class="getting_started">
                          <?php $redirect_url = "/pages/promotions"; ?>
                              <li><strong>Step 1: </strong>Click on <a href=" <?php echo $this->Url->build(array('controller'=>'users','action'=>'login','?' => array('redirect' => $redirect_url)));?>">Promote your Hotel</a> (you must be a registered Hotelier on TravelB2BHub)</li>
                               <li><strong>Step 2: </strong> Fill a short Form with your Hotel’s details and target cities where you want Travel Agents/ Event Planners to see your promotion.</li>
                               <li><strong>Step 3: </strong>Review your Advertisement and Finalize it.</li>
                               <li><strong>Step 4: </strong>Submit and Make Payments.</li>
                          </ul>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
               </div>
            </div>
        </div>
    </div>


 <?php if($userId!="" || (isset($userDetails->id) && $userDetails->role_id==3) ) { 

          ?>
    <div class="container-fluid grey_bg">
        <div class="row">
            <!-- Pricing -->
            <div  >
         
            <?php  echo $this->Form->create("Promotions", ['type' => 'file', 'class'=> 'form-horizontal', 'url' => ['controller' => 'Promotions', 'action' => 'addPromotion'], 'onSubmit' => 'return submiton();', 'id'=>"PromotionForm"]); ?>
                <fieldset class="promotion_form margin-b50">
					<legend>
						<h3 class="text-center  margin-b50">
							Promotion Form
						</h3>
					</legend>

		       <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="user_id">User Name</label>  
                  <div class="col-md-5">
                  <input id="user_name" name="user_name" placeholder="User Name" readonly class="form-control input-md" required="" value="<?php echo $userDetails->first_name; ?> <?php echo $userDetails->last_name; ?>" type="text">
                  <input id="user_id" name="user_id"  class="form-control input-md" required="" value="<?php echo $userDetails->id; ?> " type="hidden">
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="hotel_name">Hotel Name</label>  
                  <div class="col-md-5">
                  <input readonly id="hotel_name" value="<?php echo $userDetails->company_name; ?>" name="hotel_name" placeholder="Hotel Name" class="form-control input-md" required="" type="text">

                  </div>
                </div>

                    <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="hotel_type">Hotel Type</label>  
                  <div class="col-md-5">
                 <?php
                        $selectedCetegories = (!empty($users['hotel_categories']))? explode(",",$users['hotel_categories']):"";
                        echo $this->Form->control('hotel_categories', ["id"=>"hotel_categories", "type"=>"select", "empty"=>"Select Hotel Categories", 'options' =>$hotelCategories, "value"=>$userDetails->hotel_categories , "class"=>"form-control chosen-select"]);?>

                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="cheap_tariff">Tariff of Cheapest Room</label>  
                  <div class="col-md-5">
                  <input id="cheap_tariff" name="cheap_tariff" placeholder="Minimum Tariff" class="form-control input-md" required="" type="number">

                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="expensive_tariff">Tariff of Most Expensive Room</label>
                  <div class="col-md-5">
                  <input id="expensive_tariff" name="expensive_tariff" placeholder="Maximum Tariff" class="form-control input-md" required="" type="number">

                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="website">Hotel Website</label>  
                  <div class="col-md-5">
                  <input id="website" name="website" value="" placeholder="Enter Your Website" class="form-control input-md" required="" type="url">

                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label" for="website">Location</label>  
                  <div class="col-md-5">
                  <input id="hotel_location" name="hotel_location" value="" placeholder="Enter Your Hotel Location (City, State)" class="form-control input-md" required="" type="url">

                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label" for="charges">City</label>  
                  <div class="col-md-5 col-xs-12" style="z-index: 1;">
                    <select multiple="multiple" class="form-control select2" id="city" name="city[]">
                    <?php foreach($allCities as $city){
							if($city['usercount']>0){                    
                     ?>
                    <option value="<?php echo $city['value'].'-'.$city['price'];?>">
                    <?php echo $city['label'].' ('.$city['state_name'].') ('.$city['usercount'].')'; ?>
                    </option>
                    <?php } }?>
                    </select>
                   </div>
                   <!--div class="col-md-3 btn_cart">
                    <a class="btn inline" href="#">
                      <h4>Total </h4>
                      <h5 id="charges1">0</h5>
                      </a>
                    </div-->
                </div>
				  <div class="form-group">
                  <label class="col-md-4 control-label" for="duration"></label>  
                   <div class="col-md-5 btn_cart">
                    <a class="btn inline" href="#">
                      Total 
                      <span id="charges1">0</span>
                      </a>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label" for="duration">Duration (in Months, 1 Month = 30 days)</label>  
                  <div class="col-md-5">
                  <input id="duration" value="1" min="1" name="duration" placeholder="Duration (in Months, 1 Month = 30 days)" class="form-control input-md" required="" type="number">

                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label" for="charges">Charges</label>  
                  <div class="col-md-5">
                  <input id="charges" name="charges" placeholder="Charges" class="form-control input-md" required="" type="text" readonly>
                  <input id="hiddencharges" name="hiddencharges" placeholder="Charges" class="form-control input-md" required="" type="hidden">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label" for="charges">Photograph of the Hotel </label>  
                  <div class="col-md-5">
                  <?php echo $this->Form->input('', ['type' => 'file', 'class' => 'form-control imgInp', 'id' => 'hotelImg', 'name' => 'hotel_pic', 'onchange' => 'checkCertificate()']); ?>
                  <span style="color: red;font-size: 13px;"><b>File Type:</b> jpeg/jpg/png</span>&nbsp;&nbsp;&nbsp;<span style="color: red;font-size: 13px;"><b>Max Size:</b> 2 MB</span>
                  </div>
                </div>                    
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <div class="form-group margin-t30 margin-b15 text-center">
                      <ul class="btn_on_prmotion"> 
                          <!--li class="col-lg-4 col-md-4 col-sm-5 col-lg-offset-2 col-md-offset-2 col-sm-offset-1 col-xs-12">
                              <input type="submit" name="submitpromotion" id="sbmtpromotion" class="btn btn-primary btn-block" value="Submit ">
                          </li-->
                          <li class="col-lg-4 col-md-4 col-sm-5 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-1">   
                              <a class="btn btn-primary btn-block previewform" onclick="return submiton();" data-toggle="modal"   href="#">Preview</a>                  
                          </li>                          
                        </ul>                 
                    </div>
                </div>
                <!-- Text input-->

                </fieldset>
               	 </form>
                 <?php } ?>
            </div>
        </div>
      </div>
 <!--div style='display:none'>
			<div id='inline_content' style='padding:10px; background:#fff;'>
		
			<div class="hotelimage" ><img width="100%" class="" src="../img/travel-advertisement.jpg"  id="hotelimage"></div>
			<div>Hotel Name: <span class="hotelname" id="hotelname"></span></div>
			
			<div>Minimum and Maximum Price: <span class="hotelprice" id="hotelprice"></span></div>
			<div>Location: <span class="hotellocation" id="hotellocation"></span></div>
			<div>Website: <span class="hotelwebsite" id="hotelwebsite"></span></div>
			
		
		<input type="submit" name="submitpromotion" id="sbmtpromotion" class="btn btn-primary btn-submit" value="Submit "/>
		
         
			</div>
		</div-->
			  <div class="modal fade form-modal" id="previewmodal" role="dialog">
				<div class="modal-dialog">
				
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-body">
					 <div class="hotelimage" ><img width="100%" class="" src="../img/travel-advertisement.jpg"  id="hotelimage"></div>
						<div>Hotel Name: <span class="hotelname" id="hotelname"></span></div>
						<div>Hotel Type: <span class="hoteltype" id="hoteltype"></span></div>
						<div>Minimum and Maximum Price: <span class="hotelprice" id="hotelprice"></span></div>
						<div>Location: <span class="hotellocation" id="hotellocation"></span></div>
						<div>Website: <span class="hotelwebsite" id="hotelwebsite"></span></div>
						
					</div>
					<div class="modal-footer">
					<input type="submit" name="submitpromotion" id="sbmtpromotion" class="btn btn-primary btn-submit" value="Submit "/>
					  <button type="button" class="btn btn-default closepreview" data-dismiss="modal">Close</button>
					</div>
				  </div>
				</div>
			  </div>	
			</div>
		</div>
	</div>
</div>  
  <?php //echo $this->Html->script(['jquery.validate']);?>
  <?php //echo $this->Html->css(['select2/select2']);?>
  <?php //echo $this->Html->script(['select2/select2']);?>
   	<script>
function checkcitystatus(price)
{
	var url = "<?php echo $this->Url->build(array('controller'=>'Promotions','action'=>'checkcitystatus')) ?>";
	price1 = String(price);	
	var fields = price1.split('-');
	var city_id = fields[0];
	var user_id = $('#user_id').val();
	var duration = $('#duration').val();
	$.ajax({
		url:url,
		type: 'POST',
		data: {city_id:city_id,user_id:user_id,duration:duration}
	}).done(function(result){
		if (result==1) {
		var a;					
		}else{
			alert(result);
			$('#city option[value="'+price+'"]').remove();
			removecharges(price);
			//$('option:selected', "#city").remove();
			
		}
	});
}

function charges1(price){
price = String(price);
var price = price.substr(price.indexOf("-") + 1);
if(price==""){ price =0;}
duration = $('#duration').val();
if(duration==""){duration = 1 }
getcharge = $('#charges').val();
if(getcharge==""){getcharge = 0; }
totalcharge =  (parseInt(getcharge)) + (parseInt(price) * parseInt(duration))	;
$('#charges').val(totalcharge);
hiddencharges = $('#hiddencharges').val();
if(hiddencharges==""){hiddencharges = 0; }
totalcharge1 =  parseInt(hiddencharges)+ parseInt(price);
$('#hiddencharges').val(totalcharge1);
$('#charges1').html(totalcharge1);
$('#charges2').html(totalcharge1);
}	

function charges(price){
	price = String(price);
	var price = price.substr(price.indexOf("-") + 1);
	if(price==""){ price =0;}
	duration = $('#duration').val();
	if(duration==""){duration = 1 }
	getcharge = $('#charges').val();
	if(getcharge==""){getcharge = 0; }
	//totalcharge =  (parseInt(getcharge)) + (parseInt(price) * parseInt(duration))	;
	totalcharge =  (parseInt(getcharge)) + 6(parseInt(price) * parseInt(duration))	;
	$('#charges').val(totalcharge)
	hiddencharges = $('#hiddencharges').val()
	if(hiddencharges==""){hiddencharges = 0; }
	totalcharge1 =  parseInt(hiddencharges)+ parseInt(price);
	$('#hiddencharges').val(totalcharge1)
	$('#charges1').html(totalcharge1)
	$('#charges2').html(totalcharge1)
}

function removecharges(price){
price = String(price);
var price = price.substr(price.indexOf("-") + 1)

if(price==""){ price =0;}
duration = $('#duration').val();
if(duration==""){duration = 1 }
getcharge = $('#charges').val();
if(getcharge==""){getcharge = 0; }
totalcharge =  (parseInt(getcharge)) - (parseInt(price) * parseInt(duration))	;
$('#charges').val(totalcharge)
hiddencharges = $('#hiddencharges').val()
if(hiddencharges==""){hiddencharges = 0; }
totalcharge1 =  parseInt(hiddencharges)- parseInt(price);
$('#hiddencharges').val(totalcharge1)
$('#charges1').html(totalcharge1)
$('#charges2').html(totalcharge1)
}	

			
$('#select-all').click(function(){
  $('#city').multiSelect('select_all');
  return false;
});
$('#deselect-all').click(function(){
  $('#city').multiSelect('deselect_all');
  return false;
});
$( "#duration" ).change(function() {
 duration = $('#duration').val();
 getcharge = $('#hiddencharges').val();
 totalcharge = duration * getcharge;
 if(duration!=""){
 $('#charges').val(totalcharge)
 }
});
$( "#duration" ).keyup(function() {
 duration = $('#duration').val();
 getcharge = $('#hiddencharges').val();
 totalcharge = duration * getcharge;
 if(duration!=""){
 $('#charges').val(totalcharge)
 }
});

$("#city").select2({
width: '100%',placeholder: "Select cities for promotions"
		 
		 });
</script>

<script type="text/javascript">
function checkCertificate() {
    var file = document.getElementById("hotelImg");
    var file_name = file.value;
    var extension = file_name.split('.').pop().toLowerCase();
    var size = file.files[0].size;
    var allowedFormats = ["jpeg", "jpg", "png"];

    if (!(allowedFormats.indexOf(extension) > -1)) {
        alert("Enter a jpg/jpeg/pdf/png file");

        document.getElementById("sbmtpromotion").disabled = true;
        return false;
    } else if (((size / 1024) / 1024) > 2) {
        alert("Your file should be less than 2MB");
        return false;
    } else {
        document.getElementById("sbmtpromotion").disabled = false;
    }
}
$( "#sbmtpromotion" ).click(function() {
$( "#PromotionForm" ).submit();
$('#sbmtpromotion').attr('disabled','disabled');
});

function submiton()
{
	if($("#user_name").val()=="")
	{
		alert("Please enter User Name");
		$("#user_name").focus();
		return false;
	} 
	
	if($("#hotel_name").val()=="")
	{
		alert("Please enter  Hotel Name");
		$("#hotel_name").focus();
		return false;
	} 
	
	  
	if($("#hotel_categories").val()=="")
	{
		alert("Please select Hotel Type");
		$("#hotel_categories").focus();
		return false;
	} 
	  
	if($("#cheap_tariff").val()=="")
	{
		alert("Please select Tariff of Cheapest Room");
		$("#cheap_tariff").focus();
		return false;
	} 
	  
	if($("#expensive_tariff").val()=="")
	{
		alert("Please select Tariff of Most Expensive Room");
		$("#expensive_tariff").focus();
		return false;
	} 
	  
	if($("#website").val()=="")
	{
		alert("Please enter Hotel Website");
		$("#website").focus();
		return false;
	} 
	if($("#hotel_location").val()=="")
	{
		alert("Please enter Hotel Location");
		$("#hotel_location").focus();
		return false;
	} 
	  
	if($("#city").val()=="" || $("#city").val()==null)
	{
		alert("Please select City");
		$("#city").focus();
		return false;
	}
	
	if($("#duration").val()=="")
	{
		alert("Please select Duration (in Months)");
		$("#duration").focus();
		return false;
	}

	if($(".imgInp").val()=="")
	{
		alert("Please upload Photograph of the Hotel");
		$(".imgInp").focus();
		return false;
	}
	$('body').addClass('modal-open'); 
	$("#previewmodal").addClass("in");
	$("#previewmodal").show();
	//$('#previewmodal').modal('show'); 
	return true;
}
$( ".closepreview" ).click(function() {
$('body').removeClass('modal-open');
$("#previewmodal").removeClass("in");
	$("#previewmodal").hide(); 
});

</script>