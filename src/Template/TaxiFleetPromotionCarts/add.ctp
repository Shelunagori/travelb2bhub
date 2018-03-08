<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion Carts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotions'), ['controller' => 'TaxiFleetPromotions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion'), ['controller' => 'TaxiFleetPromotions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="taxiFleetPromotionCarts form large-9 medium-8 columns content">
    <?= $this->Form->create($taxiFleetPromotionCart) ?>
    <fieldset>
        <legend><?= __('Add Taxi Fleet Promotion Cart') ?></legend>
        <?php
            echo $this->Form->input('taxi_fleet_promotion_id', ['options' => $taxiFleetPromotions]);
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('created_on');
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
