<!--<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
<script src="http://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script-->
<script src="<?php echo $siteurl;?>adminlogin/public/packages/serverfireteam/panel/js/jquery-1.11.0.js"></script>
<script src="<?php echo $siteurl;?>adminlogin/public/highcharts/highcharts.js"></script>
<script src="<?php echo $siteurl;?>adminlogin/public/highcharts/exporting.js"></script>

<style>

.code-block-holder pre {
      max-height: 188px;  
      min-height: 188px; 
      overflow: auto;
      border: 1px solid #ccc;
      border-radius: 5px;
}


.tab-btn-holder {
	width: 100%;
	margin: 20px 0 0;
	border-bottom: 1px solid #dfe3e4;
	min-height: 30px;
}

.tab-btn-holder a {
	background-color: #fff;
	font-size: 14px;
	text-transform: uppercase;
	color: #006bb8;
	text-decoration: none;
	display: inline-block;
	*zoom:1; *display:inline;


}

.tab-btn-holder a.active {
	color: #858585;
    padding: 9px 10px 8px;
    border: 1px solid #dfe3e4;
    border-bottom: 1px solid #fff;
    margin-bottom: -1px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    position: relative;
    z-index: 300;
}
</style>

<?php
$start_date = '';
$end_date = '';
$state_sql = "SELECT * FROM states where country_id='101'";
$st_res = mysql_query($state_sql,$connection);

$where = '';
if(isset($_GET['start_date']) AND isset($_GET['end_date']))
{
$start_date = $_GET['start_date'];
$startdate = date("Y-m-d", strtotime($start_date));
$end_date = $_GET['end_date'];
$enddate = date("Y-m-d", strtotime($end_date));
$where = " AND (create_at BETWEEN '".$startdate."' AND '".$enddate."')";
}
//AND FIND_IN_SET ('".$p['pickup_state']."', preference) > 0
$agent_data = "[";
while($st_row=mysql_fetch_assoc($st_res))
{
$state_id = $st_row['id'];
$state_name = $st_row['state_name'];
$sql = "Select count(*) as ta_count FROM users WHERE role_id=1 AND FIND_IN_SET ('".$state_id."', preference) > 0 $where";
$res= mysql_query($sql,$connection);
$row = mysql_fetch_assoc($res);
$ta_count = $row['ta_count'];
$agent_data.="['".$state_name."', $ta_count],";
}
$agent_data.= "]";

?>
<div class="rpd-dataform inline">
<form method="GET" action="" accept-charset="UTF-8" class="form-inline" role="form">
	
</form>
</div>
<div id="container" style="min-width: 310px; height: 400px; max-width: 100%; margin: 0 auto"></div>
<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'column',
		options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            viewDistance: 25,
            depth: 40
        }
    },
    title: {
        text: 'Travel Agents Coverage'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Number of Travel Agents'
        }
    },
    legend: {
        reversed: true
    },
    tooltip: {
        pointFormat: ''
    },
    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },
   
    series: [{
        name: 'Travel Agents',
        data: <?php echo $agent_data;?>,
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
	
	$(document).ready(function () {
    $('#dt1').datepicker({
        dateFormat: "dd/mm/yy"
    });
    $('#dt2').datepicker({
        dateFormat: "dd/mm/yy"
    });
    
    
    var $datepickerStart = $("#datepickerStart");
$datepickerStart.datepicker({
    onSelect: function( selectedDate ) {
        $datepickerStart.datepicker( "option", "minDate", selectedDate );
    }
});
});
		</script>
 
</body>