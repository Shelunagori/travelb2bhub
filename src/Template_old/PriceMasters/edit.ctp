<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $priceMaster->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $priceMaster->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Price Masters'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Promotion Types'), ['controller' => 'PromotionTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Promotion Type'), ['controller' => 'PromotionTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Event Planner Promotions'), ['controller' => 'EventPlannerPromotions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event Planner Promotion'), ['controller' => 'EventPlannerPromotions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Post Travle Packages'), ['controller' => 'PostTravlePackages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package'), ['controller' => 'PostTravlePackages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotions'), ['controller' => 'TaxiFleetPromotions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion'), ['controller' => 'TaxiFleetPromotions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="priceMasters form large-9 medium-8 columns content">
    <?= $this->Form->create($priceMaster) ?>
    <fieldset>
        <legend><?= __('Edit Price Master') ?></legend>
        <?php
            echo $this->Form->input('promotion_type_id', ['options' => $promotionTypes]);
            echo $this->Form->input('price');
            echo $this->Form->input('week');
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
