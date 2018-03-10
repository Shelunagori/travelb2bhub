<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Hotel Category'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="hotelCategories index large-9 medium-8 columns content">
    <h3><?= __('Hotel Categories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hotelCategories as $hotelCategory): ?>
            <tr>
                <td><?= $this->Number->format($hotelCategory->id) ?></td>
                <td><?= h($hotelCategory->name) ?></td>
                <td><?= $this->Number->format($hotelCategory->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $hotelCategory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $hotelCategory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $hotelCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelCategory->id)]) ?>
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
