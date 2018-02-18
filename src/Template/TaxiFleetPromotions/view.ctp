<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Taxi Fleet Promotion'), ['action' => 'edit', $taxiFleetPromotion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Taxi Fleet Promotion'), ['action' => 'delete', $taxiFleetPromotion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxiFleetPromotion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Price Masters'), ['controller' => 'PriceMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Price Master'), ['controller' => 'PriceMasters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion Cities'), ['controller' => 'TaxiFleetPromotionCities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion City'), ['controller' => 'TaxiFleetPromotionCities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion Rows'), ['controller' => 'TaxiFleetPromotionRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion Row'), ['controller' => 'TaxiFleetPromotionRows', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion States'), ['controller' => 'TaxiFleetPromotionStates', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion State'), ['controller' => 'TaxiFleetPromotionStates', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="taxiFleetPromotions view large-9 medium-8 columns content">
    <h3><?= h($taxiFleetPromotion->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($taxiFleetPromotion->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= $taxiFleetPromotion->has('country') ? $this->Html->link($taxiFleetPromotion->country->id, ['controller' => 'Countries', 'action' => 'view', $taxiFleetPromotion->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Master') ?></th>
            <td><?= $taxiFleetPromotion->has('price_master') ? $this->Html->link($taxiFleetPromotion->price_master->week, ['controller' => 'PriceMasters', 'action' => 'view', $taxiFleetPromotion->price_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $taxiFleetPromotion->has('user') ? $this->Html->link($taxiFleetPromotion->user->last_name, ['controller' => 'Users', 'action' => 'view', $taxiFleetPromotion->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($taxiFleetPromotion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= $this->Number->format($taxiFleetPromotion->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Document') ?></th>
            <td><?= $this->Number->format($taxiFleetPromotion->document) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Like Count') ?></th>
            <td><?= $this->Number->format($taxiFleetPromotion->like_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($taxiFleetPromotion->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($taxiFleetPromotion->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Visible Date') ?></th>
            <td><?= h($taxiFleetPromotion->visible_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($taxiFleetPromotion->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($taxiFleetPromotion->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Fleet Detail') ?></h4>
        <?= $this->Text->autoParagraph(h($taxiFleetPromotion->fleet_detail)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Taxi Fleet Promotion Cities') ?></h4>
        <?php if (!empty($taxiFleetPromotion->taxi_fleet_promotion_cities)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Taxi Fleet Promotion Id') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($taxiFleetPromotion->taxi_fleet_promotion_cities as $taxiFleetPromotionCities): ?>
            <tr>
                <td><?= h($taxiFleetPromotionCities->id) ?></td>
                <td><?= h($taxiFleetPromotionCities->taxi_fleet_promotion_id) ?></td>
                <td><?= h($taxiFleetPromotionCities->city_id) ?></td>
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
        <table cellpadding="0" cellspacing="0">
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
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Taxi Fleet Promotion Id') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($taxiFleetPromotion->taxi_fleet_promotion_states as $taxiFleetPromotionStates): ?>
            <tr>
                <td><?= h($taxiFleetPromotionStates->id) ?></td>
                <td><?= h($taxiFleetPromotionStates->taxi_fleet_promotion_id) ?></td>
                <td><?= h($taxiFleetPromotionStates->state_id) ?></td>
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
