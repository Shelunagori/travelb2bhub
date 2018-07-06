<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Taxi Fleet Car Bus'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion Rows'), ['controller' => 'TaxiFleetPromotionRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion Row'), ['controller' => 'TaxiFleetPromotionRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="taxiFleetCarBuses index large-9 medium-8 columns content">
    <h3><?= __('Taxi Fleet Car Buses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($taxiFleetCarBuses as $taxiFleetCarBus): ?>
            <tr>
                <td><?= $this->Number->format($taxiFleetCarBus->id) ?></td>
                <td><?= h($taxiFleetCarBus->name) ?></td>
                <td><?= h($taxiFleetCarBus->type) ?></td>
                <td><?= $this->Number->format($taxiFleetCarBus->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $taxiFleetCarBus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $taxiFleetCarBus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $taxiFleetCarBus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxiFleetCarBus->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
