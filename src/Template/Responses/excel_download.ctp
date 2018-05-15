<?php
$file_name='Response List';
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$file_name.xls");
header("Content-Type: application/force-download");
header("Cache-Control: post-check=0, pre-check=0", true);

?> 
				<table border="1">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No') ?></th>
							<th scope="col"><?= h('Rreference ID') ?></th>
							<th scope="col"><?= h('Request Type') ?></th>
							<th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
							<th scope="col"><?= $this->Paginator->sort('quotation_price') ?></th>
							<th scope="col"><?= ('Detail Shared') ?></th>
							<th scope="col"><?= $this->Paginator->sort('created') ?></th>
							<th scope="col"><?= $this->Paginator->sort('status') ?></th>
							<th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th> 
						</tr>
					</thead>
					<tbody>
						<?php  foreach ($responses as $response): 
							$status= $response->status;
							if($status==0){$showStatus='Open';}
							if($status==1){$showStatus='Finalized';}
							$is_deleted= $response->is_deleted;
							if($is_deleted==0){$showis_deleted='Open';}
							if($is_deleted==1){$showis_deleted='Removed';}
							$is_details_shared= $response->is_details_shared;
							if($is_details_shared==0){$showis_details_shared='Not Shared';}
							if($is_details_shared==1){$showis_details_shared='Shared';}
							$category_id=$response->request->category_id;
							if($category_id==1){ 
								$text="Package";
							} 
							if($category_id==2){
								$text="Transport";
							}
							if($category_id==3){
								$text="Hotel";
							}
						?>
						<tr>
							<td><?= h($response->id) ?></td>
							<td><?= $response->request->reference_id ?></td>
							<td><?= h($text) ?></td>
							<td><?php echo $response->user->first_name.$response->user->last_name; ?></td>
							<td><?= h($response->quotation_price) ?></td>
							<td><?php echo $showis_details_shared; ?></td>
							<td><?= h(date('d-m-Y',strtotime($response->created))) ?></td>
							<td><?php echo $showStatus; ?></td>
							<td><?php echo $showis_deleted; ?></td>
 						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
	 
 