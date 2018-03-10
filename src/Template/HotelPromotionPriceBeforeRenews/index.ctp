<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion Price Before Renews'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hotel Promotions'), ['controller' => 'HotelPromotions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion'), ['controller' => 'HotelPromotions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Price Masters'), ['controller' => 'PriceMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Price Master'), ['controller' => 'PriceMasters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="hotelPromotionPriceBeforeRenews index large-9 medium-8 columns content">
    <h3><?= __('Hotel Promotion Price Before Renews') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hotel_promotion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price_master_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('visible_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hotelPromotionPriceBeforeRenews as $hotelPromotionPriceBeforeRenews): ?>
            <tr>
                <td><?= $this->Number->format($hotelPromotionPriceBeforeRenews->id) ?></td>
                <td><?= $hotelPromotionPriceBeforeRenews->has('hotel_promotion') ? $this->Html->link($hotelPromotionPriceBeforeRenews->hotel_promotion->id, ['controller' => 'HotelPromotions', 'action' => 'view', $hotelPromotionPriceBeforeRenews->hotel_promotion->id]) : '' ?></td>
                <td><?= $hotelPromotionPriceBeforeRenews->has('price_master') ? $this->Html->link($hotelPromotionPriceBeforeRenews->price_master->week, ['controller' => 'PriceMasters', 'action' => 'view', $hotelPromotionPriceBeforeRenews->price_master->id]) : '' ?></td>
                <td><?= $this->Number->format($hotelPromotionPriceBeforeRenews->price) ?></td>
                <td><?= h($hotelPromotionPriceBeforeRenews->visible_date) ?></td>
                <td><?= h($hotelPromotionPriceBeforeRenews->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $hotelPromotionPriceBeforeRenews->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $hotelPromotionPriceBeforeRenews->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $hotelPromotionPriceBeforeRenews->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionPriceBeforeRenews->id)]) ?>
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
