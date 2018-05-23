<?php  
$file_name='User List';
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$file_name.xls");
header("Content-Type: application/force-download");
header("Cache-Control: post-check=0, pre-check=0", true);  

?> 
	<table border="1" >
		<thead>
			<tr>
				<th><?= ('S. No.') ?></th> 
				<th><?= ('Name') ?></th>
				<th><?= ('email') ?></th>
				<th><?= ('Mobile') ?></th>
				<th><?= ('Company Name') ?></th>
				<th><?= ('Category') ?></th> 
				<th><?= ('Address') ?></th> 
				<th><?= ('Locality') ?></th> 
				<th><?= ('City') ?></th> 
				<th><?= ('Pincode') ?></th> 
				<th><?= ('State') ?></th> 
				<th><?= ('Country') ?></th> 
				<th><?= ('State of Operation') ?></th> 
				<th><?= ('Created On') ?></th> 
				<th><?= ('Last Login') ?></th> 				
			</tr>
		</thead>
		<tbody>
			<?php $x=0; foreach ($users as $user): $x++;  
			$role_id=$user->role_id;
			$blocked=$user->blocked;
			if($role_id==1){ $roleShow="Travel Agent";}
			if($role_id==2){ $roleShow="Event Planner";}
			if($role_id==3){ $roleShow="Hotelier";}
			$rowcolor='';
			if($blocked==1){ $rowcolor="#f5d8d8";}
			$selectedPreferenceStates = "";
			$state_name=array();
			if(!empty($user['preference'])) 
			{
				$selectedPreferenceStates = explode(",", $user['preference']);
				
				foreach($selectedPreferenceStates as $operated)
				{
					$state_name[]=$allStates[$operated];
				}
			}
			$stateofoperation='';
			if(!empty($state_name)){$stateofoperation=implode(', ',$state_name);}
			?>
			<tr style="background-color:<?php echo $rowcolor; ?>">
				<td><?= $x; ?></td> 
				<td><?= h($user->first_name.' '.$user->last_name) ?></td>
				<td><?= h($user->email) ?></td>
				<td><?= h($user->mobile_number) ?></td> 
				<td><?= h($user->company_name) ?></td> 
				<td><?php echo $roleShow; ?></td>
				<td><?php echo $user->address; ?></td>
				<td><?php echo $user->locality; ?></td>
				<td><?= h($user->city->name) ?></td> 
				<td><?= h($user->pincode) ?></td> 
				<td><?= h($user->state->state_name) ?></td> 
				<td><?= h($user->country->country_name) ?></td> 
				<td><?= h($stateofoperation) ?></td> 
				<td><?= h(date('d-m-Y',strtotime($user->create_at))) ?></td> 
				<td><?= h(date('d-m-Y',strtotime($user->last_login))) ?></td> 
 			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
