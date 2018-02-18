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
                ['action' => 'delete', $eventPlannerPromotion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $eventPlannerPromotion->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Event Planner Promotions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Price Masters'), ['controller' => 'PriceMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Price Master'), ['controller' => 'PriceMasters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Event Planner Promotion Cities'), ['controller' => 'EventPlannerPromotionCities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event Planner Promotion City'), ['controller' => 'EventPlannerPromotionCities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Event Planner Promotion States'), ['controller' => 'EventPlannerPromotionStates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event Planner Promotion State'), ['controller' => 'EventPlannerPromotionStates', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="eventPlannerPromotions form large-9 medium-8 columns content">
    <?= $this->Form->create($eventPlannerPromotion) ?>
    <fieldset>
        <legend><?= __('Edit Event Planner Promotion') ?></legend>
        <?php
            echo $this->Form->input('country_id');
            echo $this->Form->input('event_detail');
            echo $this->Form->input('image');
            echo $this->Form->input('document');
            echo $this->Form->input('price_master_id', ['options' => $priceMasters]);
            echo $this->Form->input('visible_date');
            echo $this->Form->input('like_count');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('created_on');
            echo $this->Form->input('edited_by');
            echo $this->Form->input('edited_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
