<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Taxi Fleet Car Bus'), ['action' => 'edit', $taxiFleetCarBus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Taxi Fleet Car Bus'), ['action' => 'delete', $taxiFleetCarBus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxiFleetCarBus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Taxi Fleet Car Buses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taxi Fleet Car Bus'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion Rows'), ['controller' => 'TaxiFleetPromotionRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion Row'), ['controller' => 'TaxiFleetPromotionRows', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="taxiFleetCarBuses view large-9 medium-8 columns content">
    <h3><?= h($taxiFleetCarBus->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($taxiFleetCarBus->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($taxiFleetCarBus->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($taxiFleetCarBus->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($taxiFleetCarBus->is_deleted) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Taxi Fleet Promotion Rows') ?></h4>
        <?php if (!empty($taxiFleetCarBus->taxi_fleet_promotion_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Taxi Fleet Promotion Id') ?></th>
                <th scope="col"><?= __('Taxi Fleet Car Bus Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($taxiFleetCarBus->taxi_fleet_promotion_rows as $taxiFleetPromotionRows): ?>
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
</div>
