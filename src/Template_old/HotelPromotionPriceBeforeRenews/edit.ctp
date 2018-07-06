<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $hotelPromotionPriceBeforeRenews->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionPriceBeforeRenews->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Hotel Promotion Price Before Renews'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Hotel Promotions'), ['controller' => 'HotelPromotions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion'), ['controller' => 'HotelPromotions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Price Masters'), ['controller' => 'PriceMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Price Master'), ['controller' => 'PriceMasters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="hotelPromotionPriceBeforeRenews form large-9 medium-8 columns content">
    <?= $this->Form->create($hotelPromotionPriceBeforeRenews) ?>
    <fieldset>
        <legend><?= __('Edit Hotel Promotion Price Before Renews') ?></legend>
        <?php
            echo $this->Form->input('hotel_promotion_id', ['options' => $hotelPromotions]);
            echo $this->Form->input('price_master_id', ['options' => $priceMasters]);
            echo $this->Form->input('price');
            echo $this->Form->input('visible_date');
            echo $this->Form->input('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
