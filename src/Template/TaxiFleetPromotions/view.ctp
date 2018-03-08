<?php
/**
  * @var \App\View\AppView $this
  */
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
					<h3 class="box-title" >TaxiFleet Promotion Details</h3>
					<div class="box-tools pull-right">
 					</div>
 				</div>
<div class="box-body">
	<table class="table" cellpadding="0" cellspacing="0">
        <tr style="background-color:#709090;color:white">
            <th scope="row"><?= __('Image') ?></th>
			<th scope="row"><?= __('Document') ?></th>			
			<th scope="row"><?= __('Cities of Operation') ?></th>			
			<th scope="row"><?= __('States ') ?></th>			
		</tr>
		<tr>
			<td><?= $this->Number->format($taxiFleetPromotion->image) ?></td>
            <td><?= $this->Number->format($taxiFleetPromotion->document) ?></td>
			<td><?= h($taxiFleetPromotion->taxi_fleet_promotion_cities->city_id); ?></td>
			<th scope="row"><?= __('Document') ?></th>
            <td><?= $this->Number->format($taxiFleetPromotion->document) ?></td>
        </tr> 
		<tr>
			<div class="row">
				<h4><?= __('Fleet Detail') ?></h4>
				<?= $this->Text->autoParagraph(h($taxiFleetPromotion->fleet_detail)); ?>
			</div>
        </tr>
       
    </table>
   
    <div class="related">
        <h4><?= __('Related Taxi Fleet Promotion Cities') ?></h4>
        <?php if (!empty($taxiFleetPromotion->taxi_fleet_promotion_cities)): ?>
        <table class="table" cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Taxi Fleet Promotion Id') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php 
			//pr($taxiFleetPromotion->taxi_fleet_promotion_cities);
			foreach ($taxiFleetPromotion->taxi_fleet_promotion_cities as $taxiFleetPromotionCities): ?>
            <tr>
                <td><?= h($taxiFleetPromotionCities->id) ?></td>
                <td><?= h($taxiFleetPromotionCities->taxi_fleet_promotion_id) ?></td>
                <td><?= h($taxiFleetPromotionCities->City->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TaxiFleetPromotionCities', 'action' => 'view', $taxiFleetPromotionCities->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TaxiFleetPromotionCities', 'action' => 'edit', $taxiFleetPromotionCities->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TaxiFleetPromotionCities', 'action' => 'delete', $taxiFleetPromotionCities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxiFleetPromotionCities->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Taxi Fleet Promotion Rows') ?></h4>
        <?php if (!empty($taxiFleetPromotion->taxi_fleet_promotion_rows)): ?>
        <table class="table" cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Taxi Fleet Promotion Id') ?></th>
                <th scope="col"><?= __('Taxi Fleet Car Bus Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($taxiFleetPromotion->taxi_fleet_promotion_rows as $taxiFleetPromotionRows): ?>
            <tr>
                <td><?= h($taxiFleetPromotionRows->id) ?></td>
                <td><?= h($taxiFleetPromotionRows->taxi_fleet_promotion_id) ?></td>
                <td><?= h($taxiFleetPromotionRows->taxi_fleet_car_bus_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TaxiFleetPromotionRows', 'action' => 'view', $taxiFleetPromotionRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TaxiFleetPromotionRows', 'action' => 'edit', $taxiFleetPromotionRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TaxiFleetPromotionRows', 'action' => 'delete', $taxiFleetPromotionRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxiFleetPromotionRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Taxi Fleet Promotion States') ?></h4>
        <?php if (!empty($taxiFleetPromotion->taxi_fleet_promotion_states)): ?>
        <table class="table" cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Taxi Fleet Promotion Id') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php  
			foreach ($taxiFleetPromotion->taxi_fleet_promotion_states as $taxiFleetPromotionStates): ?>
            <tr>
                <td><?= h($taxiFleetPromotionStates->id) ?></td>
                <td><?= h($taxiFleetPromotionStates->taxi_fleet_promotion_id) ?></td>
                <td><?= h($taxiFleetPromotionStates->state->state_name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TaxiFleetPromotionStates', 'action' => 'view', $taxiFleetPromotionStates->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TaxiFleetPromotionStates', 'action' => 'edit', $taxiFleetPromotionStates->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TaxiFleetPromotionStates', 'action' => 'delete', $taxiFleetPromotionStates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxiFleetPromotionStates->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
