 
<style>
#Content{ width:90% !important; margin-left: 5%;}
input:focus {background-color:#FFF !important;}
input[type="password"]:focus {background-color:#FFF !important;}
div.error { display: block !important; } 
label { font-weight:100 !important;}
fieldset
{
	border-radius: 7px;
	box-shadow: 0 3px 9px rgba(0,0,0,0.25), 0 2px 5px rgba(0,0,0,0.22);
}
</style>
<section class="content">
<div class="col-md-12"></div>
      <div class="row">
        <div class="col-md-12">
         <div class="box box-primary">
			<div class="box-header with-border">
              <h3 class="box-title">Requests Trend Lines</h3>
            </div>
			<div class="box-body">
			<form method="get" class="loadingshow">
				<div class="col-md-12">
					
					<div class="col-md-3">
						<div class="form-group ">
						  <label>Select Type:</label>
						  <select name="type" class="form-control type">
							<option value="">Select...</option>
							<option value="1">Weekly</option>
							<option value="2">Montly</option>
							<option value="3">Yearly</option>
							</select>
						</div>
					</div>
					<div class="col-md-3 year">
						<div class="form-group ">
						  <label>Month From:</label>
						  <input type="text" class="form-control monthpicker" placeholder="Select month" name="month_from">
						</div>
					</div>
					<div class="col-md-3 year week">
						<div class="form-group ">
						  <label>Month To:</label>
						  <input type="text" class="form-control monthpicker" placeholder="Select month" name="month_to">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label class="control-label col-md-12">&nbsp;</label>  
							<a href="<?php echo $this->Url->build(array('controller'=>'admins','action'=>'request-statistics')) ?>"class="btn btn-danger btn-sm">Reset</a>
							<?php echo $this->Form->button('Search',['class'=>'btn btn-sm btn-success']); ?> 
						</div>
					</div>	
				</div>
			</form>	
			
				<div class="col-md-12">
				<hr style="margin-top:5px;margin-bottom:5px;"></hr>
				</div>
				<div align="right" class="col-md-12" style="margin-bottom:5px"> 
					<form method="post" target="_blank">
						<textarea name="export_data" hidden ></textarea> <!---->
						<input type="hidden" value="Requests_Report" name="file_name" />
						<button type="submit" formaction="pdf_excel" name="excel" style="margin:10px" class="btn btn-info btn-xs" ><i class="fa fa-download "></i> &nbsp; Excel &nbsp; </button>   
					 </form>
				</div>
				<div class="col-md-12">
					<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
				</div>				
			</div>				
        </div>
             
          </div>            
        </div>
       </div>
   </section>
   
	<div style="" id="data_get" >
 		<table class="table table-striped table-hover table-bordered" border="1" style="display:none" >
			<thead>
				<tr>
					<th>S.No.</th>
					<th>User Category</th>
					<?php foreach($MonthArray as $MName){ ?>
						<th><?php echo $MName; ?></th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<th>Travel Agent</th>
					<?php $x=0; foreach($MonthArray as $MName){  ?>
						<td><?php echo $TAArray[$x]; ?></td>
					<?php $x++; } ?>
				</tr>
				<tr>
					<th>2</th>
					<th>Event Planner</th>
					<?php $x=0; foreach($MonthArray as $MName){  ?>
						<td><?php echo $EPArray[$x]; ?></td>
					<?php $x++; } ?>
				</tr> 
				<tr>
					<th>4</th>
					<th>Total</th>
					<?php $x=0; foreach($MonthArray as $MName){  ?>
						<td><?php echo $TArray[$x]; ?></td>
					<?php $x++; } ?>
				</tr>
			</tbody>
		</table>
	</div>
<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
<div id="loader"></div>
</div> 
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>

<script type="text/javascript">
$(function () {  
    $('#container').highcharts({
        title: {
            text: 'Monthly Requests',
            x: -20 //center
        },
        subtitle: {
           // text: 'Source: travelb2bhub.com.com',
           // x: -20
        },
        xAxis: {
            categories: [<?php echo $MonthName;?>]
        },
        yAxis: {
            title: {
                text: 'No of Requests'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
           //valueSuffix: '°C'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Travel Agent',
            data: [<?php echo $TravelAgentCount;?>]
        }, {
            name: 'Event Planner',
            data: [<?php echo $EventPlannerCount;?>]
        }, {
            name: 'Total',
            data: [<?php echo $TotalRegistration;?>]
        }]
    });
});
 
$(document).ready(function(){ 
	$('.type').on('change',function(){
		if($(this).val()==3){
			$('.year').hide();
		}else {
			$('.year').show();
		} 
	});
}); 
$('textarea[name=export_data]').html($('#data_get').html());
jQuery(".loadingshow").submit(function(){
	jQuery("#loader-1").show();
}); 
</script>