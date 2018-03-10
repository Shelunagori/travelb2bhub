<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $hotelPromotion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotion->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Hotel Promotions'), ['action' => 'index']) ?></li>
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
<div class="hotelPromotions form large-9 medium-8 columns content">
    <?= $this->Form->create($hotelPromotion) ?>
    <fieldset>
        <legend><?= __('Edit Hotel Promotion') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('hotel_name');
            echo $this->Form->input('hotel_location');
            echo $this->Form->input('hotel_category_id', ['options' => $hotelCategories]);
            echo $this->Form->input('cheap_tariff');
            echo $this->Form->input('expensive_tariff');
            echo $this->Form->input('website');
            echo $this->Form->input('status');
            echo $this->Form->input('hotel_pic');
            echo $this->Form->input('payment_status');
            echo $this->Form->input('total_charges');
            echo $this->Form->input('price_master_id', ['options' => $priceMasters]);
            echo $this->Form->input('visible_date');
            echo $this->Form->input('hotel_rating');
            echo $this->Form->input('created_on');
            echo $this->Form->input('updated_on');
            echo $this->Form->input('accept_date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
