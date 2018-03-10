<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion Report'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hotel Promotions'), ['controller' => 'HotelPromotions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion'), ['controller' => 'HotelPromotions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="hotelPromotionReports index large-9 medium-8 columns content">
    <h3><?= __('Hotel Promotion Reports') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hotel_promotion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('report_reason_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hotelPromotionReports as $hotelPromotionReport): ?>
            <tr>
                <td><?= $this->Number->format($hotelPromotionReport->id) ?></td>
                <td><?= $hotelPromotionReport->has('hotel_promotion') ? $this->Html->link($hotelPromotionReport->hotel_promotion->id, ['controller' => 'HotelPromotions', 'action' => 'view', $hotelPromotionReport->hotel_promotion->id]) : '' ?></td>
                <td><?= $hotelPromotionReport->has('user') ? $this->Html->link($hotelPromotionReport->user->last_name, ['controller' => 'Users', 'action' => 'view', $hotelPromotionReport->user->id]) : '' ?></td>
                <td><?= $this->Number->format($hotelPromotionReport->report_reason_id) ?></td>
                <td><?= h($hotelPromotionReport->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $hotelPromotionReport->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $hotelPromotionReport->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $hotelPromotionReport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionReport->id)]) ?>
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
