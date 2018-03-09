<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/EventPlannerPromotions/getEventPlanners.json?isLikedUserId=".$user_id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 4f8087cd-6560-4ca6-5539-9499d3c5b967"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$priceMasters=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$List=json_decode($response);
	$eventPlannerPromotions=$List->getEventPlanners;
}
//pr($List); exit;
?>
<div id="my_final_responses" class="container-fluid">
	<div class="row equal_column">
		<div class="col-md-12" style="background-color:#fff"> 
			<br>
			<?php echo  $this->Flash->render() ?>
		</div>
		<div class="col-md-12" style="background-color:#fff"> 
			<div class="box box-default">
				<div class="box-header with-border"> 
					<h3 class="box-title"><?= __('Event Planner Promotions') ?></h3>
					<div class="box-tools pull-right">
 					</div>
 				</div>
				<div class="box-body">
					<table class="table" cellpadding="0" cellspacing="0">
						<thead>
							 <tr style="background-color:#709090;color:white;">
								<th scope="col"><?= ('Sr.No') ?></th>
								<th scope="col"><?= ('User Name') ?></th>
								<th scope="col"><?= ('Country') ?></th>
								<th scope="col"><?= ('Duration') ?></th>
								<th scope="col"><?= ('Price') ?> (&#8377;)</th>
								<th scope="col"><?= ('Likes') ?></th>
								<th scope="col"><?= ('Visibility Date') ?></th>
								<th scope="col"><?= ('Image') ?></th>
								<th scope="col" class="actions"><//= __('Actions') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; foreach ($eventPlannerPromotions as $eventPlannerPromotion): ?>
							<tr>
								<td><?= $i; ?></td>
								<td><?= h($eventPlannerPromotion->user->first_name.$eventPlannerPromotion->user->last_name);?></td>
								<td><?= h($eventPlannerPromotion->country->country_name); ?></td>
								<td><?= h($eventPlannerPromotion->price_master->week); ?></td>
								<td><?= h($eventPlannerPromotion->price_master->price); ?></td>
								<td><?= $this->Number->format($eventPlannerPromotion->like_count) ?></td>
								<td><?= h($eventPlannerPromotion->visible_date) ?></td>	
								<td><?php echo "yash";//= h($eventPlannerPromotion->image) ?></td>
								<td class="actions" style="display:none;">
									<?= $this->Html->link(__('View'), ['action' => 'view', $eventPlannerPromotion->id]) ?>
									<?= $this->Html->link(__('Edit'), ['action' => 'edit', $eventPlannerPromotion->id]) ?>
									<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $eventPlannerPromotion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventPlannerPromotion->id)]) ?>
								</td>
							</tr>
							 <?php $i++;endforeach; ?>
						</tbody>
					</table>
					<!--<div class="paginator">
						<ul class="pagination">
							<?= $this->Paginator->first('<< ' . __('first')) ?>
							<?= $this->Paginator->prev('< ' . __('previous')) ?>
							<?= $this->Paginator->numbers() ?>
							<?= $this->Paginator->next(__('next') . ' >') ?>
							<?= $this->Paginator->last(__('last') . ' >>') ?>
						</ul>
						<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
					</div>--->
				</div>
			</div>
		</div>
	</div>
</div>
