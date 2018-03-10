<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion Cart'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hotel Promotions'), ['controller' => 'HotelPromotions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion'), ['controller' => 'HotelPromotions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="hotelPromotionCarts index large-9 medium-8 columns content">
    <h3><?= __('Hotel Promotion Carts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hotel_promotion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hotelPromotionCarts as $hotelPromotionCart): ?>
            <tr>
                <td><?= $this->Number->format($hotelPromotionCart->id) ?></td>
                <td><?= $hotelPromotionCart->has('hotel_promotion') ? $this->Html->link($hotelPromotionCart->hotel_promotion->id, ['controller' => 'HotelPromotions', 'action' => 'view', $hotelPromotionCart->hotel_promotion->id]) : '' ?></td>
                <td><?= $hotelPromotionCart->has('user') ? $this->Html->link($hotelPromotionCart->user->last_name, ['controller' => 'Users', 'action' => 'view', $hotelPromotionCart->user->id]) : '' ?></td>
                <td><?= h($hotelPromotionCart->created_on) ?></td>
                <td><?= $this->Number->format($hotelPromotionCart->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $hotelPromotionCart->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $hotelPromotionCart->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $hotelPromotionCart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionCart->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
