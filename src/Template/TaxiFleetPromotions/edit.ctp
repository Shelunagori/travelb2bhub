<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $taxiFleetPromotion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $taxiFleetPromotion->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Price Masters'), ['controller' => 'PriceMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Price Master'), ['controller' => 'PriceMasters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion Cities'), ['controller' => 'TaxiFleetPromotionCities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion City'), ['controller' => 'TaxiFleetPromotionCities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion Rows'), ['controller' => 'TaxiFleetPromotionRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion Row'), ['controller' => 'TaxiFleetPromotionRows', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion States'), ['controller' => 'TaxiFleetPromotionStates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion State'), ['controller' => 'TaxiFleetPromotionStates', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="taxiFleetPromotions form large-9 medium-8 columns content">
    <?= $this->Form->create($taxiFleetPromotion) ?>
    <fieldset>
        <legend><?= __('Edit Taxi Fleet Promotion') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('country_id', ['options' => $countries]);
            echo $this->Form->input('fleet_detail');
            echo $this->Form->input('image');
            echo $this->Form->input('document');
            echo $this->Form->input('price_master_id', ['options' => $priceMasters]);
            echo $this->Form->input('like_count');
            echo $this->Form->input('visible_date');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('created_on');
            echo $this->Form->input('edited_by');
            echo $this->Form->input('edited_on');
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
