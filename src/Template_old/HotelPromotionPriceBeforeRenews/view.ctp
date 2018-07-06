<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Hotel Promotion Price Before Renews'), ['action' => 'edit', $hotelPromotionPriceBeforeRenews->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Hotel Promotion Price Before Renews'), ['action' => 'delete', $hotelPromotionPriceBeforeRenews->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionPriceBeforeRenews->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Promotion Price Before Renews'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Promotion Price Before Renews'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Promotions'), ['controller' => 'HotelPromotions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Promotion'), ['controller' => 'HotelPromotions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Price Masters'), ['controller' => 'PriceMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Price Master'), ['controller' => 'PriceMasters', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="hotelPromotionPriceBeforeRenews view large-9 medium-8 columns content">
    <h3><?= h($hotelPromotionPriceBeforeRenews->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Hotel Promotion') ?></th>
            <td><?= $hotelPromotionPriceBeforeRenews->has('hotel_promotion') ? $this->Html->link($hotelPromotionPriceBeforeRenews->hotel_promotion->id, ['controller' => 'HotelPromotions', 'action' => 'view', $hotelPromotionPriceBeforeRenews->hotel_promotion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Master') ?></th>
            <td><?= $hotelPromotionPriceBeforeRenews->has('price_master') ? $this->Html->link($hotelPromotionPriceBeforeRenews->price_master->week, ['controller' => 'PriceMasters', 'action' => 'view', $hotelPromotionPriceBeforeRenews->price_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($hotelPromotionPriceBeforeRenews->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($hotelPromotionPriceBeforeRenews->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Visible Date') ?></th>
            <td><?= h($hotelPromotionPriceBeforeRenews->visible_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($hotelPromotionPriceBeforeRenews->created_on) ?></td>
        </tr>
    </table>
</div>
