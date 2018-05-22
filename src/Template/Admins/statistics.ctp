 
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
              <h3 class="box-title">Statistics</h3>
            </div>
			
	 
			<div class="box-body">
			<form method="get" class="loadingshow">
				<div class="col-md-12">
					<div class="col-md-4">
						<div class="form-group ">
						  <label>Month From</label>
						  <input type="text" class="form-control monthpicker" placeholder="Select month" name="month_from">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group ">
						  <label>Month To</label>
						  <input type="text" class="form-control monthpicker" placeholder="Select month" name="month_to">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						  <label class="control-label col-md-12">&nbsp;</label>  
							<a href="<?php echo $this->Url->build(array('controller'=>'admins','action'=>'statistics')) ?>"class="btn btn-danger btn-sm">Reset</a>
							<?php echo $this->Form->button('Search',['class'=>'btn btn-sm btn-success']); ?> 
						</div>
					</div>	
				</div>
			</form>	
			
				<div class="col-md-12">
				<hr style="margin-top:5px;margin-bottom:5px;"></hr>
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
<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
<div id="loader"></div>
</div> 
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script type="text/javascript">
$(function () {  
    $('#container').highcharts({
        title: {
            text: 'Monthly Registrations',
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
                text: 'No of Registrations'
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
            name: 'Hotelier',
            data: [<?php echo $HotelierCount;?>]
        }, {
            name: 'Total',
            data: [<?php echo $TotalRegistration;?>]
        }]
    });
});
</script> 

