<?php
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/EventPlannerPromotions/getEventPlannersDetails.json?user_id=".$user_id ."&id=".$id,
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
$eventplanner_view=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$List=json_decode($response);
	//pr($List); exit;
	$eventPlannerPromotion=$List->getEventPlannersDetails;
	//pr($hotelPromotion);exit;
}
?>
<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body"> 
					<fieldset>
						<legend style="color:#369FA1;text-align:center;"><b> &nbsp; <?= __('Event Planner Promotion Details ') ?> &nbsp;  </b></legend>
						<div class="box-body">
<?php foreach($eventPlannerPromotion as $eventPlannerPromotion):?>
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-4">
											<?= $this->Html->image('../images/PostTravelPackages/8/test/image/8.jpg',['style'=>'width:300px;height:220px;']) ?>
										</div>
										<div class="col-md-8">
											<div class="row">
												<div class="col-md-2">
													<label><?= __('Seller Name') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($eventPlannerPromotion->user->first_name.' '.$eventPlannerPromotion->user->last_name.'( '.$eventPlannerPromotion->user_rating.' )');?>
												</div>
												<div class="col-md-2">
													<label><?= __('Duration') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($eventPlannerPromotion->price_master->week) ?>
												</div>
											</div>
											<div class="row">
												<div class="col-md-2">
													<label><?= __('total Charges') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($eventPlannerPromotion->price_master->price);?>
												</div>
												<div class="col-md-2">
													<label><?= __('Visible Date') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($eventPlannerPromotion->visible_date) ?>
												</div>
											</div>
       
            <th scope="row"><?= __('Price Master') ?></th>
            <td><?= $eventPlannerPromotion->has('price_master') ? $this->Html->link($eventPlannerPromotion->price_master->week, ['controller' => 'PriceMasters', 'action' => 'view', $eventPlannerPromotion->price_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $eventPlannerPromotion->has('user') ? $this->Html->link($eventPlannerPromotion->user->last_name, ['controller' => 'Users', 'action' => 'view', $eventPlannerPromotion->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($eventPlannerPromotion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country Id') ?></th>
            <td><?= $this->Number->format($eventPlannerPromotion->country_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Like Count') ?></th>
            <td><?= $this->Number->format($eventPlannerPromotion->like_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($eventPlannerPromotion->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Visible Date') ?></th>
            <td><?= h($eventPlannerPromotion->visible_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($eventPlannerPromotion->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($eventPlannerPromotion->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Event Detail') ?></h4>
        <?= $this->Text->autoParagraph(h($eventPlannerPromotion->event_detail)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Event Planner Promotion Cities') ?></h4>
        <?php if (!empty($eventPlannerPromotion->event_planner_promotion_cities)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Event Planner Promotion Id') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($eventPlannerPromotion->event_planner_promotion_cities as $eventPlannerPromotionCities): ?>
            <tr>
                <td><?= h($eventPlannerPromotionCities->id) ?></td>
                <td><?= h($eventPlannerPromotionCities->event_planner_promotion_id) ?></td>
                <td><?= h($eventPlannerPromotionCities->city_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EventPlannerPromotionCities', 'action' => 'view', $eventPlannerPromotionCities->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EventPlannerPromotionCities', 'action' => 'edit', $eventPlannerPromotionCities->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EventPlannerPromotionCities', 'action' => 'delete', $eventPlannerPromotionCities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventPlannerPromotionCities->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Event Planner Promotion States') ?></h4>
        <?php if (!empty($eventPlannerPromotion->event_planner_promotion_states)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Event Planner Promotion Id') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($eventPlannerPromotion->event_planner_promotion_states as $eventPlannerPromotionStates): ?>
            <tr>
                <td><?= h($eventPlannerPromotionStates->id) ?></td>
                <td><?= h($eventPlannerPromotionStates->event_planner_promotion_id) ?></td>
                <td><?= h($eventPlannerPromotionStates->state_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EventPlannerPromotionStates', 'action' => 'view', $eventPlannerPromotionStates->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EventPlannerPromotionStates', 'action' => 'edit', $eventPlannerPromotionStates->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EventPlannerPromotionStates', 'action' => 'delete', $eventPlannerPromotionStates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventPlannerPromotionStates->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div> <?php endforeach; ?>
