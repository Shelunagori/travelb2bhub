<?php
include('custom/connection.php');
$sql = "SELECT u.first_name,u.last_name,u.mobile_number,`email`,case r.category_id
        when '1' then 'Package'
        when '2' then 'Transport'
		when '3' then 'Hotel'
    end as category,r.pickup_city, r.id,r.reference_id,r.total_budget,r.children,r.adult,r.room1,r.room2,r.room3,r.child_with_bed,
	r.child_without_bed,r.hotel_rating,r.created,r.locality
	from requests as r INNER JOIN users as u on u.id=r.user_id
where r.is_deleted=1";
$res= mysql_query($sql,$connection);
$data = array();
$i=0;
while($row = mysql_fetch_assoc($res))
{
	$request_id=$row['id'];
	$query = "SELECT count(*) as total_response FROM responses where request_id='".$request_id."' ";
	$result= mysql_query($query,$connection);
	$rows = mysql_fetch_assoc($result);
	if($rows['total_response']==0)
	{
	if($row['category']=="Transport"){
	$csql= "Select c.id,c.name,s.state_name from cities as c inner join states as s on s.id=c.state_id where c.id='".$row['pickup_city']."'";
	$cresult= mysql_query($csql,$connection);
	$crow = mysql_fetch_assoc($cresult);
	$row['pickup_city']=$crow['name'];
	$row['state']=$crow['state_name'];
	}else{
	$sqlh= "SELECT h.*,c.name as city_name,s.state_name FROM `hotels` as h inner join cities as c on c.id= h.city_id
			INNER join states as s on s.id=c.state_id WHERE h.req_id='".$request_id."'";
	$hresult= mysql_query($sqlh,$connection);
	$citistring = "";
	$statename ="";
		if(mysql_num_rows($hresult)>1){
		while($hrow = mysql_fetch_assoc($hresult))
		{
		$citistring.= $hrow['city_name'].'+';
		
		$statename= $hrow['state_name'];
		}
		}else{
		$sqlh= "SELECT r.city_id,r.state_id,c.name as city_name,s.state_name FROM `requests` as r inner join cities as c on c.id= r.city_id
			INNER join states as s on s.id=r.state_id WHERE r.id='".$request_id."'";
	$hresult= mysql_query($sqlh,$connection);
	$rrow = mysql_fetch_assoc($hresult);
	$citistring.= $rrow['city_name'];
	$statename= $rrow['state_name'];
		}
	$row['pickup_city']=$citistring;
	$row['state']=$statename;	
	}
	$data[]=$row;
	}
	$i++;
}
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Requests.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('First Name', 'Last Name','Mobile Number','Email','category','City','ID','Reference Id','Total Budget','Children','adult','room1','room2','room3','child_with_bed','child_without_bed','hotel_rating','created','Locality','State'));
if (count($data) > 0) {
    foreach ($data as $req) {
        fputcsv($output, $req);
    }
}
?>