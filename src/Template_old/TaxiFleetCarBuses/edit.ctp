<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $taxiFleetCarBus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $taxiFleetCarBus->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Taxi Fleet Car Buses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion Rows'), ['controller' => 'TaxiFleetPromotionRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion Row'), ['controller' => 'TaxiFleetPromotionRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="taxiFleetCarBuses form large-9 medium-8 columns content">
    <?= $this->Form->create($taxiFleetCarBus) ?>
    <fieldset>
        <legend><?= __('Edit Taxi Fleet Car Bus') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('type');
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
