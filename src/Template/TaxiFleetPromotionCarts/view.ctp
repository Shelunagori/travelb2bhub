<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Taxi Fleet Promotion Cart'), ['action' => 'edit', $taxiFleetPromotionCart->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Taxi Fleet Promotion Cart'), ['action' => 'delete', $taxiFleetPromotionCart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxiFleetPromotionCart->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion Carts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion Cart'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotions'), ['controller' => 'TaxiFleetPromotions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion'), ['controller' => 'TaxiFleetPromotions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="taxiFleetPromotionCarts view large-9 medium-8 columns content">
    <h3><?= h($taxiFleetPromotionCart->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Taxi Fleet Promotion') ?></th>
            <td><?= $taxiFleetPromotionCart->has('taxi_fleet_promotion') ? $this->Html->link($taxiFleetPromotionCart->taxi_fleet_promotion->title, ['controller' => 'TaxiFleetPromotions', 'action' => 'view', $taxiFleetPromotionCart->taxi_fleet_promotion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $taxiFleetPromotionCart->has('user') ? $this->Html->link($taxiFleetPromotionCart->user->last_name, ['controller' => 'Users', 'action' => 'view', $taxiFleetPromotionCart->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($taxiFleetPromotionCart->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($taxiFleetPromotionCart->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($taxiFleetPromotionCart->created_on) ?></td>
        </tr>
    </table>
</div>
