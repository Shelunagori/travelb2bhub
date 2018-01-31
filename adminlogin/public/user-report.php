<?php
include('custom/connection.php');
$currentdate = date("Y-m-d h:i:s");
if(isset($_GET['login_days']))
{
$logindays = '-'.$_GET['login_days'].' day';
}else{
$logindays = '-15 day';
}

$previous_date = date('Y-m-d H:i:s', strtotime($logindays, strtotime($currentdate)));
$sql = "SELECT u.id,u.first_name,u.last_name,u.mobile_number,u.`email`,case u.role_id
        when '1' then 'Travel Agent'
        when '2' then 'Event Planner'
		when '3' then 'Hotelier'
		end as Role,case u.status
        when '0' then 'Inactive'
        when '1' then 'Active'
		end as Status,
		c.name as city_name,s.state_name,u.create_at,u.last_login
		from users u 
		Inner JOIN cities c on c.id=u.city_id
		Inner JOIN states s on s.id=u.state_id
		WHERE u.`last_login` < '".$previous_date."'";
$res= mysql_query($sql,$connection);
$data = array();
while($row = mysql_fetch_assoc($res))
{
	$data[]=$row;
}
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Users.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('ID','First Name', 'Last Name','Mobile Number','Email','Role','Status','City','State','Created At','Last Login'));
if (count($data) > 0) {
    foreach ($data as $req) {
        fputcsv($output, $req);
    }
}
?>