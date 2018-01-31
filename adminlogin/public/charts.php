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
error_reporting(0);
$start_date = '';
$end_date = '';
$where = "where 1";
if(isset($_GET['start_date']) AND isset($_GET['end_date']))
{
$start_date = $_GET['start_date'];
$startdate = date("Y-m-d", strtotime($start_date));
$end_date = $_GET['end_date'];
$enddate = date("Y-m-d", strtotime($end_date));

$where = "where (create_at BETWEEN '".$startdate."' AND '".$enddate."')";
}


$sql = "Select count(*) as total_count FROM users $where";
$res= mysql_query($sql,$connection);
$row = mysql_fetch_assoc($res);
$total_count = $row['total_count'];


$sql = "Select count(*) as ep_count FROM users $where AND role_id=2";
$res= mysql_query($sql,$connection);
$row = mysql_fetch_assoc($res);
$ep_count = $row['ep_count'];
$ep_percent = $ep_count/$total_count;
$ep_percent_friendly = number_format( $ep_percent * 100, 2 );


$sql = "Select count(*) as ta_count FROM users $where AND role_id=1";
$res= mysql_query($sql,$connection);
$row = mysql_fetch_assoc($res);
$ta_count = $row['ta_count'];
$ta_percent = $ta_count/$total_count;
$ta_percent_friendly = number_format( $ta_percent * 100, 2 );

$sql = "Select count(*) as ht_count FROM users $where AND role_id=3";
$res= mysql_query($sql,$connection);
$row = mysql_fetch_assoc($res);
$ht_count = $row['ht_count'];
$ht_percent = $ht_count/$total_count;
$ht_percent_friendly = number_format( $ht_percent * 100, 2 );

?>
<div class="rpd-dataform inline">
<p><strong>Total User: </strong><?php echo $total_count;?></p>
<p><strong>Total Travel Agents: </strong><?php echo $ta_count;?></p>
<p><strong>Total Hoteliers: </strong><?php echo $ht_count;?></p>
<p><strong>Total Event Planners: </strong><?php echo $ep_count;?></p>
<form method="GET" action="" accept-charset="UTF-8" class="form-inline" role="form">
<label>Select Date Range</label>
<input type="text" name="start_date" placeholder="Start Date" class="form-control" style="width: 15%;" id="dt1" value="<?php echo $start_date;?>">
<input type="text" name="end_date" placeholder="End Date" class="form-control" style="width: 15%;" id="dt2" value="<?php echo $end_date;?>">
<input class="btn btn-primary" type="submit" value="search">
<a href="<?php echo $siteurl;?>adminlogin/public/statistics.php" class="btn btn-default">reset</a>
</form>
</div>
<div id="container" style="min-width: 310px; height: 400px; max-width: 800px; margin: 0 auto"></div>



		<script type="text/javascript">


$(document).ready(function () {

    // Build the chart
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'User Registered'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Register',
            colorByPoint: true,
            data: [{
                name: 'Travel Agents',
                y: <?php echo $ta_percent_friendly;?>
            }, {
                name: 'Event Planners',
                y: <?php echo $ep_percent_friendly;?>
            }, {
                name: 'Hoteliers',
                y: <?php echo $ht_percent_friendly;?>
            }]
        }]
    });
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