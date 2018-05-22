<?php
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
/* $file_name='Response List';
 header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$file_name.xls");
header("Content-Type: application/force-download");
header("Cache-Control: post-check=0, pre-check=0", true);  */
 
?> 

<table class="table table-bordered" cellpadding="0" cellspacing="0" id="main_tble" border="1">
	<thead>
		<tr style="background-color:#DFD9C4;">
		<th scope="col"><?= __('Sr.No') ?></th>
		<th scope="col"><?= __('Reference_id') ?></th>
		<th scope="col"><?= __('Agent Name') ?></th>
		<th scope="col"><?= __('Locality') ?></th>
		<th scope="col"><?= __('Total Budget') ?></th>
		<th scope="col"><?= __('Request Type') ?></th>
		<th scope="col"><?= __('Created date') ?></th>
		<th scope="col"><?= __('Start Date') ?></th>
		<th scope="col"><?= __('End Date') ?></th>
		
		<th scope="col"><?= __('Status') ?></th>
		<th scope="col"><?= __('Removed') ?></th>
		<th scope="col"><?= __('City') ?></th> 
	</tr>
	</thead>
	<tbody>
		<?php pr($requests); exit; $i=1;foreach ($requests as $request):
			$status=$request->status;
			$is_deleted=$request->is_deleted;
			if($status==2){ $showStatus="Finalized";}
			if($status==0){ $showStatus="Open";}
			if($is_deleted==0){ $is_deletedShow="Open";}
			if($is_deleted==1){ $is_deletedShow="Removed";}
			
			
				
			$category_id=$request->category_id;
			
			if($category_id == 3 ) { 
				$start_date=date('d-m-Y',strtotime($request->check_in));
				$end_date=date('d-m-Y',strtotime($request->check_out));
							 
			} 
			if($request['category_id'] == 1 ) {
				$sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$request->id."'";
				$stmt = $conn->execute($sql);
				$result = $stmt->fetch('assoc');
				$start_date=date('d-m-Y',strtotime($request->check_in));
				if(!empty($result['TopDate'])) {
					$end_date=date('d-m-Y',strtotime($result['TopDate']));
				}
				else{
					$end_date=date('d-m-Y',strtotime($request->check_out));
				}
						 
			}
			if($request['category_id'] == 2 ) { 
				$start_date=date('d-m-Y',strtotime($request->start_date));
				$end_date=date('d-m-Y',strtotime($request->end_date));
			}
			$total_response=$request->total_response;
			$current_date=strtotime(date('Y-m-d'));
			$start_datess=strtotime(date('Y-m-d',strtotime($start_date))); 
 			if($request['category_id']==2){
				if($start_datess <= $current_date){
					if($total_response==0){
						$is_deletedShow='Expired';
					}
				}
			}
			if($request['category_id']!=2){
				if($start_datess <= $current_date){
					if($total_response==0){
						$is_deletedShow='Expired';
					}
				}
			}
			$adult=$request->adult;
			$children=$request->children;
			$room1=$request->room1;
			$room2=$request->room2;
			$room3=$request->room3;
			$child_with_bed=$request->child_with_bed;
			$child_without_bed=$request->child_without_bed;
			$hotel_rating=$request->hotel_rating;
			$hotel_category=$request->hotel_category;
			if (!empty($hotel_category))
			{
				$result = explode(",", $hotel_category);
 				$hotel_category = array();
				foreach($result as $row1)
				{
					@$hotel_category[]=$hotelCategories[$row1]; 
					$count++;
				}
				echo $hotel_category=implode(', ',$hotel_category);
			}
			$meal_plan=$request->meal_plan;
			$destination_city=$request->destination_city;
			$check_in=$request->check_in;
			$check_out=$request->check_out;
			//---transport_requirement
			$transport_requirement=$request->transport_requirement;
			$pickup_city=$request->pickup_city;
			$pickup_state=$request->pickup_state;
			$pickup_country=$request->pickup_country;
			$pickup_locality=$request->pickup_locality;
			$city_id=$request->city_id;
			$final_locality=$request->final_locality;
			$final_city=$request->final_city;
			$final_state=$request->final_state;
			$final_country=$request->final_country;
			$comment=$request->comment;
			
			 
		?>
		<tr>
			<td><?= $i; ?></td>
			<td><?= h($request->reference_id) ?></td>
			<td><?= h($request->user->first_name.$request->user->last_name) ?></td>
			<td><?= h($request->locality) ?></td>
			<td><?= h($request->total_budget) ?></td>
			<td><?= h($request->category->name) ?></td>
			<td><?= h(date('d-m-Y',strtotime($request->created))); ?></td>
			<td><?php echo $start_date; ?></td>
			<td><?php echo $end_date; ?></td>
			<td><?php echo $showStatus; ?></td>
			<td><?php echo $is_deletedShow; ?></td>
			<td><?= h($request->city->name) ?></td>
		</tr>
		<?php $i++;endforeach; ?>
	</tbody>
</table>
	 
 
 
 