<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Hotel Promotion Cart'), ['action' => 'edit', $hotelPromotionCart->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Hotel Promotion Cart'), ['action' => 'delete', $hotelPromotionCart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionCart->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Promotion Carts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Promotion Cart'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Promotions'), ['controller' => 'HotelPromotions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Promotion'), ['controller' => 'HotelPromotions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="hotelPromotionCarts view large-9 medium-8 columns content">
    <h3><?= h($hotelPromotionCart->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Hotel Promotion') ?></th>
            <td><?= $hotelPromotionCart->has('hotel_promotion') ? $this->Html->link($hotelPromotionCart->hotel_promotion->id, ['controller' => 'HotelPromotions', 'action' => 'view', $hotelPromotionCart->hotel_promotion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $hotelPromotionCart->has('user') ? $this->Html->link($hotelPromotionCart->user->last_name, ['controller' => 'Users', 'action' => 'view', $hotelPromotionCart->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($hotelPromotionCart->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($hotelPromotionCart->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($hotelPromotionCart->created_on) ?></td>
        </tr>
    </table>
</div>
