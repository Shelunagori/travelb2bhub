<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hotel Categories'), ['controller' => 'HotelCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hotel Category'), ['controller' => 'HotelCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Price Masters'), ['controller' => 'PriceMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Price Master'), ['controller' => 'PriceMasters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hotel Promotion Cities'), ['controller' => 'HotelPromotionCities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion City'), ['controller' => 'HotelPromotionCities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hotel Promotion Likes'), ['controller' => 'HotelPromotionLikes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion Like'), ['controller' => 'HotelPromotionLikes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hotel Promotion Price Before Renews'), ['controller' => 'HotelPromotionPriceBeforeRenews', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion Price Before Renews'), ['controller' => 'HotelPromotionPriceBeforeRenews', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hotel Promotion Reports'), ['controller' => 'HotelPromotionReports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion Report'), ['controller' => 'HotelPromotionReports', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hotel Promotion Views'), ['controller' => 'HotelPromotionViews', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion View'), ['controller' => 'HotelPromotionViews', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="hotelPromotions index large-9 medium-8 columns content">
    <h3><?= __('Hotel Promotions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hotel_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hotel_location') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hotel_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cheap_tariff') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expensive_tariff') ?></th>
                <th scope="col"><?= $this->Paginator->sort('website') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hotel_pic') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_charges') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price_master_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('visible_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hotel_rating') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('accept_date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hotelPromotions as $hotelPromotion): ?>
            <tr>
                <td><?= $this->Number->format($hotelPromotion->id) ?></td>
                <td><?= $hotelPromotion->has('user') ? $this->Html->link($hotelPromotion->user->last_name, ['controller' => 'Users', 'action' => 'view', $hotelPromotion->user->id]) : '' ?></td>
                <td><?= h($hotelPromotion->hotel_name) ?></td>
                <td><?= h($hotelPromotion->hotel_location) ?></td>
                <td><?= $hotelPromotion->has('hotel_category') ? $this->Html->link($hotelPromotion->hotel_category->name, ['controller' => 'HotelCategories', 'action' => 'view', $hotelPromotion->hotel_category->id]) : '' ?></td>
                <td><?= $this->Number->format($hotelPromotion->cheap_tariff) ?></td>
                <td><?= $this->Number->format($hotelPromotion->expensive_tariff) ?></td>
                <td><?= h($hotelPromotion->website) ?></td>
                <td><?= $this->Number->format($hotelPromotion->hotel_pic) ?></td>
                <td><?= h($hotelPromotion->payment_status) ?></td>
                <td><?= $this->Number->format($hotelPromotion->total_charges) ?></td>
                <td><?= $hotelPromotion->has('price_master') ? $this->Html->link($hotelPromotion->price_master->week, ['controller' => 'PriceMasters', 'action' => 'view', $hotelPromotion->price_master->id]) : '' ?></td>
                <td><?= h($hotelPromotion->visible_date) ?></td>
                <td><?= $this->Number->format($hotelPromotion->hotel_rating) ?></td>
                <td><?= h($hotelPromotion->created_on) ?></td>
                <td><?= h($hotelPromotion->updated_on) ?></td>
                <td><?= h($hotelPromotion->accept_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $hotelPromotion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $hotelPromotion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $hotelPromotion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotion->id)]) ?>
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
