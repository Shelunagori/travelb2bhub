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
$where = "where 1";
if(isset($_POST['request_status']))
{
$request_status = $_POST['request_status'];
if($request_status==2){
	$title_text = "Request Finilized";
$where.=" AND r.status=2"; 
	}elseif($request_status==3)
	{
		$title_text = "Request Removed";
	$where.=" AND r.is_deleted=1";
	}else{
		$title_text = "Request placed";
	$where.=" AND r.status=0";
	}
}else{
	$title_text = "Request placed";
$where.=" AND r.status=0";
}


$date = date('Y/m/d', time());
$timestamp = strtotime($date);
$day = date('l', $timestamp);
$current_year = date("Y");
$current_month = date('m');
if(isset($_POST['time_interval']))
{
	$time_interval = $_POST['time_interval'];
if($time_interval==2){
	if(isset($_POST['sel_year']))
	{
	$current_year = $_POST['sel_year'];
	}
	$sel_year_display="style='display:inline-block;'";
	$sel_month_display="style='display:none;'";
	$total_count_data = "[";
	$t_a_count_data = "[";
	$e_p_count_data = "[";
	for($m=1;$m<=12;$m++)
		{
		$sql = "SELECT COUNT(*) as total_count from requests as r INNER JOIN users as u on u.id=r.user_id $where AND r.`created` BETWEEN '$current_year-$m-01' AND '$current_year-$m-31'";
		$res= mysql_query($sql,$connection);
		$row = mysql_fetch_assoc($res);
		$total_count = $row['total_count'];	
		$total_count_data.= $total_count.",";
			
		$sqlt = "SELECT COUNT(*) as ta_count from requests as r INNER JOIN users as u on u.id=r.user_id $where AND r.`created` BETWEEN '$current_year-$m-01' AND '$current_year-$m-31' AND u.role_id=1";
		$rest = mysql_query($sqlt,$connection);
		$rowt = mysql_fetch_assoc($rest);
		$ta_count = $rowt['ta_count'];
		$t_a_count_data.= $ta_count.",";
		
		//For Event planner
		$sqle = "SELECT COUNT(*) as ep_count from requests as r INNER JOIN users as u on u.id=r.user_id $where AND r.`created` BETWEEN '$current_year-$m-01' AND '$current_year-$m-31' AND u.role_id=2";
		$rese = mysql_query($sqle,$connection);
		$rowe = mysql_fetch_assoc($rese);
		$ep_count = $rowe['ep_count'];
		$e_p_count_data.= $ep_count.",";	
		}
	$total_count_string = rtrim($total_count_data,',');
	$total_count_data = $total_count_string."]";
	
	$t_a_count_string = rtrim($t_a_count_data,',');
	$t_a_count_data = $t_a_count_string."]";
	
	$e_p_count_string = rtrim($e_p_count_data,',');
	$e_p_count_data = $e_p_count_string."]";
	
	$categories = "['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']";
}elseif($time_interval==3)
{
	$sel_month_display="style='display:none;'";
	$sel_year_display="style='display:none;'";
	$start_year= 2017;
	$year_string = "[";
	$total_count_data = "[";
	$t_a_count_data = "[";
	$e_p_count_data = "[";
	for($start_year=2017;$start_year<=2025;$start_year++)
	{
	 	$sql = "SELECT COUNT(*) as total_count from requests as r INNER JOIN users as u on u.id=r.user_id $where AND r.`created` BETWEEN '$start_year-01-01' AND '$start_year-12-31'";
		$res= mysql_query($sql,$connection);
		$row = mysql_fetch_assoc($res);
		$total_count = $row['total_count'];	
		$total_count_data.= $total_count.",";
		
		$sqlt = "SELECT COUNT(*) as ta_count from requests as r INNER JOIN users as u on u.id=r.user_id $where AND r.`created` BETWEEN '$start_year-01-01' AND '$start_year-12-31' AND u.role_id=1";
		$rest = mysql_query($sqlt,$connection);
		$rowt = mysql_fetch_assoc($rest);
		$ta_count = $rowt['ta_count'];
		$t_a_count_data.= $ta_count.",";
		
		//For Event planner
		$sqle = "SELECT COUNT(*) as ep_count from requests as r INNER JOIN users as u on u.id=r.user_id $where AND r.`created` BETWEEN '$start_year-01-01' AND '$start_year-12-31' AND u.role_id=2";
		$rese = mysql_query($sqle,$connection);
		$rowe = mysql_fetch_assoc($rese);
		$ep_count = $rowe['ep_count'];
		$e_p_count_data.= $ep_count.",";
		
	$year_string.= "'".$start_year."',";
	}
	$total_count_string = rtrim($total_count_data,',');
	$total_count_data = $total_count_string."]";
	
	$t_a_count_string = rtrim($t_a_count_data,',');
	$t_a_count_data = $t_a_count_string."]";
	
	$e_p_count_string = rtrim($e_p_count_data,',');
	$e_p_count_data = $e_p_count_string."]";
	
	$year_string1 = rtrim($year_string,',');
	$year_string = $year_string1."]";
$categories = $year_string;
}else{
	if(isset($_POST['sel_month']))
	{
	$current_month = $_POST['sel_month'];
	}
	if(isset($_POST['sel_year']))
	{
	$current_year = $_POST['sel_year'];
	}
	
	$day_31_months = array("1","3","5","7","8","10","12");
	$day_30_months = array("4","6","9","11");
	$day_feb_months = array("2");
	$m = $current_month;
	if(in_array($current_month,$day_31_months))
	{
	$total_day=31; 
	}elseif(in_array($current_month,$day_30_months)){
	$total_day=30; 
	}else{
		if($current_year%4==0){
		$total_day = 29;
		}else{
		$total_day = 28;
		}
	}
	$week_string = "[";
	$total_count_data = "[";
	$t_a_count_data = "[";
	$e_p_count_data = "[";
	for($d=1;$d<=$total_day;$d++)
		{
		$sql = "SELECT COUNT(*) as total_count from requests as r INNER JOIN users as u on u.id=r.user_id $where AND r.`created` BETWEEN '$current_year-$m-$d' AND '$current_year-$m-$d 23:59:00'";
		$res= mysql_query($sql,$connection);
		$row = mysql_fetch_assoc($res);
		$total_count = $row['total_count'];	
		$total_count_data.= $total_count.",";
			
		$sqlt = "SELECT COUNT(*) as ta_count from requests as r INNER JOIN users as u on u.id=r.user_id $where AND r.`created` BETWEEN '$current_year-$m-$d' AND '$current_year-$m-$d 23:59:00' AND u.role_id=1";
		$rest = mysql_query($sqlt,$connection);
		$rowt = mysql_fetch_assoc($rest);
		$ta_count = $rowt['ta_count'];
		$t_a_count_data.= $ta_count.",";
		
		//For Event planner
		$sqle = "SELECT COUNT(*) as ep_count from requests as r INNER JOIN users as u on u.id=r.user_id $where AND r.`created` BETWEEN '$current_year-$m-$d' AND '$current_year-$m-$d 23:59:00' AND u.role_id=2";
		$rese = mysql_query($sqle,$connection);
		$rowe = mysql_fetch_assoc($rese);
		$ep_count = $rowe['ep_count'];
		$e_p_count_data.= $ep_count.",";
			
	$week_string.= "'".$d."',";
		}
	$total_count_string = rtrim($total_count_data,',');
	$total_count_data = $total_count_string."]";
	
	$t_a_count_string = rtrim($t_a_count_data,',');
	$t_a_count_data = $t_a_count_string."]";
	
	$e_p_count_string = rtrim($e_p_count_data,',');
	$e_p_count_data = $e_p_count_string."]";
	
	$week_string1 = rtrim($week_string,',');
	$week_string = $week_string1."]";
	$categories = $week_string;
	$sel_month_display="style='display:inline-block;'";
	$sel_year_display="style='display:inline-block;'";
}
}else{
	if(isset($_POST['sel_month']))
	{
	$current_month = $_POST['sel_month'];
	}
	if(isset($_POST['sel_year']))
	{
	$current_year = $_POST['sel_year'];
	}
	
	$day_31_months = array("1","3","5","7","8","10","12");
	$day_30_months = array("4","6","9","11");
	$day_feb_months = array("2");
	$m = $current_month;
	if(in_array($current_month,$day_31_months))
	{
	$total_day=31; 
	}elseif(in_array($current_month,$day_30_months)){
	$total_day=30; 
	}else{
		if($current_year%4==0){
		$total_day = 29;
		}else{
		$total_day = 28;
		}
	}
	$week_string = "[";
	$total_count_data = "[";
	$t_a_count_data = "[";
	$e_p_count_data = "[";
	for($d=1;$d<=$total_day;$d++)
		{
		$sql = "SELECT COUNT(*) as total_count from requests as r INNER JOIN users as u on u.id=r.user_id $where AND r.`created` BETWEEN '$current_year-$m-$d' AND '$current_year-$m-$d 23:59:00'";
		$res= mysql_query($sql,$connection);
		$row = mysql_fetch_assoc($res);
		$total_count = $row['total_count'];	
		$total_count_data.= $total_count.",";
			
		$sqlt = "SELECT COUNT(*) as ta_count from requests as r INNER JOIN users as u on u.id=r.user_id $where AND r.`created` BETWEEN '$current_year-$m-$d' AND '$current_year-$m-$d 23:59:00' AND u.role_id=1";
		$rest = mysql_query($sqlt,$connection);
		$rowt = mysql_fetch_assoc($rest);
		$ta_count = $rowt['ta_count'];
		$t_a_count_data.= $ta_count.",";
		
		//For Event planner
		$sqle = "SELECT COUNT(*) as ep_count from requests as r INNER JOIN users as u on u.id=r.user_id $where AND r.`created` BETWEEN '$current_year-$m-$d' AND '$current_year-$m-$d 23:59:00' AND u.role_id=2";
		$rese = mysql_query($sqle,$connection);
		$rowe = mysql_fetch_assoc($rese);
		$ep_count = $rowe['ep_count'];
		$e_p_count_data.= $ep_count.",";
			
	$week_string.= "'".$d."',";
		}
	$total_count_string = rtrim($total_count_data,',');
	$total_count_data = $total_count_string."]";
	
	$t_a_count_string = rtrim($t_a_count_data,',');
	$t_a_count_data = $t_a_count_string."]";
	
	$e_p_count_string = rtrim($e_p_count_data,',');
	$e_p_count_data = $e_p_count_string."]";
	
	$week_string1 = rtrim($week_string,',');
	$week_string = $week_string1."]";
	$categories = $week_string;
	$sel_month_display="style='display:inline-block;'";
	$sel_year_display="style='display:inline-block;'";
}

$start_date = '';
$end_date = '';
$where = "where 1";
if(isset($_POST['start_date']) AND isset($_GET['end_date']))
{
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$date = str_replace('/', '-', $start_date);
$startdate = date('Y-m-d', strtotime($date));

$date1 = str_replace('/', '-', $end_date);
$enddate = date('Y-m-d', strtotime($date1));

$where = "where (create_at BETWEEN '".$startdate."' AND '".$enddate."')";
}

?>
<div class="rpd-dataform inline">
<form method="POST" action="" accept-charset="UTF-8" class="form-inline" role="form">
<label>Time interval</label>
<select id="time_interval" class="form-control" name="time_interval">
<option <?php if(!isset($_POST['time_interval'])){ echo 'selected';}?> value="1">Weekly</option>
<option <?php if(isset($_POST['time_interval']) AND $_POST['time_interval']==2){ echo 'selected';}?> value="2">Montly</option>
<option <?php if(isset($_POST['time_interval']) AND $_POST['time_interval']==3){ echo 'selected';}?> value="3">Yearly</option>
</select>

<select <?php echo $sel_month_display;?> name="sel_month" id="sel_month" class="form-control">
<option value="">Select Month</option>
<?php for($a=1;$a<=12;$a++){?>
<option <?php if($a==$current_month){ echo 'selected';}?> value="<?php echo $a;?>"><?php echo $months_data[$a];?></option>
<?php }?>
</select>

<select <?php echo $sel_year_display;?> name="sel_year" id="sel_year" class="form-control">
<option value="">Select Year</option>
<?php for($a=2017;$a<=2025;$a++){?>
<option <?php if($a==$current_year){ echo 'selected';}?> value="<?php echo $a;?>"><?php echo $a;?></option>
<?php }?>
</select>
	
<select id="request_status" class="form-control" name="request_status">
<option <?php if(!isset($_POST['request_status'])){ echo 'selected';}?> value="1">Request Placed</option>
<option <?php if(isset($_POST['request_status']) AND $_POST['request_status']==2){ echo 'selected';}?> value="2">Finalized Request</option>
<option <?php if(isset($_POST['request_status']) AND $_POST['request_status']==3){ echo 'selected';}?> value="3">Removed Request</option>
</select>
<input class="btn btn-primary" type="submit" value="search">
<a href="<?php echo $siteurl;?>adminlogin/public/request.php" class="btn btn-default">reset</a>
</form>
</div>
<div id="container" style="min-width: 310px; height: 400px; max-width: 800px; margin: 0 auto"></div>
<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: '<?php echo $title_text;?>'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: <?php echo $categories;?>
    },
    yAxis: {
        title: {
            text: 'Requests Count'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [
		{
        name: 'Total',
        data: <?php echo $total_count_data;?>
    },{
        name: 'Travel Agent',
        data: <?php echo $t_a_count_data;?>
    }, {
        name: 'Event Planner',
        data: <?php echo $e_p_count_data;?>
    }]
});
		//7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
		
$( "#time_interval" ).change(function() {
  var time_interval =  this.value;
	if(time_interval==1)
		{
		 $("#sel_month").show();
		$("#sel_year").show();
		}else if(time_interval==2){
		$("#sel_month").hide();
		$("#sel_year").show();
		}else{
		 $("#sel_month").hide();
		$("#sel_year").hide();
		}
});
		</script>
</body>