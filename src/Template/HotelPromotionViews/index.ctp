<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion View'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="hotelPromotionViews index large-9 medium-8 columns content">
    <h3><?= __('Hotel Promotion Views') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hotel_promotion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hotelPromotionViews as $hotelPromotionView): ?>
            <tr>
                <td><?= $this->Number->format($hotelPromotionView->id) ?></td>
                <td><?= $this->Number->format($hotelPromotionView->hotel_promotion_id) ?></td>
                <td><?= $hotelPromotionView->has('user') ? $this->Html->link($hotelPromotionView->user->last_name, ['controller' => 'Users', 'action' => 'view', $hotelPromotionView->user->id]) : '' ?></td>
                <td><?= h($hotelPromotionView->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $hotelPromotionView->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $hotelPromotionView->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $hotelPromotionView->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionView->id)]) ?>
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
