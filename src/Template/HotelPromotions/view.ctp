<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Hotel Promotion'), ['action' => 'edit', $hotelPromotion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Hotel Promotion'), ['action' => 'delete', $hotelPromotion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Promotions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Promotion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Categories'), ['controller' => 'HotelCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Category'), ['controller' => 'HotelCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Price Masters'), ['controller' => 'PriceMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Price Master'), ['controller' => 'PriceMasters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Promotion Cities'), ['controller' => 'HotelPromotionCities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Promotion City'), ['controller' => 'HotelPromotionCities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Promotion Likes'), ['controller' => 'HotelPromotionLikes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Promotion Like'), ['controller' => 'HotelPromotionLikes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Promotion Price Before Renews'), ['controller' => 'HotelPromotionPriceBeforeRenews', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Promotion Price Before Renews'), ['controller' => 'HotelPromotionPriceBeforeRenews', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Promotion Reports'), ['controller' => 'HotelPromotionReports', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Promotion Report'), ['controller' => 'HotelPromotionReports', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Promotion Views'), ['controller' => 'HotelPromotionViews', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Promotion View'), ['controller' => 'HotelPromotionViews', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="hotelPromotions view large-9 medium-8 columns content">
    <h3><?= h($hotelPromotion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $hotelPromotion->has('user') ? $this->Html->link($hotelPromotion->user->last_name, ['controller' => 'Users', 'action' => 'view', $hotelPromotion->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hotel Name') ?></th>
            <td><?= h($hotelPromotion->hotel_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hotel Location') ?></th>
            <td><?= h($hotelPromotion->hotel_location) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hotel Category') ?></th>
            <td><?= $hotelPromotion->has('hotel_category') ? $this->Html->link($hotelPromotion->hotel_category->name, ['controller' => 'HotelCategories', 'action' => 'view', $hotelPromotion->hotel_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Website') ?></th>
            <td><?= h($hotelPromotion->website) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Status') ?></th>
            <td><?= h($hotelPromotion->payment_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Master') ?></th>
            <td><?= $hotelPromotion->has('price_master') ? $this->Html->link($hotelPromotion->price_master->week, ['controller' => 'PriceMasters', 'action' => 'view', $hotelPromotion->price_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($hotelPromotion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cheap Tariff') ?></th>
            <td><?= $this->Number->format($hotelPromotion->cheap_tariff) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expensive Tariff') ?></th>
            <td><?= $this->Number->format($hotelPromotion->expensive_tariff) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hotel Pic') ?></th>
            <td><?= $this->Number->format($hotelPromotion->hotel_pic) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Charges') ?></th>
            <td><?= $this->Number->format($hotelPromotion->total_charges) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hotel Rating') ?></th>
            <td><?= $this->Number->format($hotelPromotion->hotel_rating) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Visible Date') ?></th>
            <td><?= h($hotelPromotion->visible_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($hotelPromotion->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated On') ?></th>
            <td><?= h($hotelPromotion->updated_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Accept Date') ?></th>
            <td><?= h($hotelPromotion->accept_date) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Status') ?></h4>
        <?= $this->Text->autoParagraph(h($hotelPromotion->status)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Hotel Promotion Cities') ?></h4>
        <?php if (!empty($hotelPromotion->hotel_promotion_cities)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Hotel Promotion Id') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Charges') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($hotelPromotion->hotel_promotion_cities as $hotelPromotionCities): ?>
            <tr>
                <td><?= h($hotelPromotionCities->id) ?></td>
                <td><?= h($hotelPromotionCities->hotel_promotion_id) ?></td>
                <td><?= h($hotelPromotionCities->city_id) ?></td>
                <td><?= h($hotelPromotionCities->charges) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'HotelPromotionCities', 'action' => 'view', $hotelPromotionCities->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'HotelPromotionCities', 'action' => 'edit', $hotelPromotionCities->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'HotelPromotionCities', 'action' => 'delete', $hotelPromotionCities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionCities->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Hotel Promotion Likes') ?></h4>
        <?php if (!empty($hotelPromotion->hotel_promotion_likes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Hotel Promotion Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($hotelPromotion->hotel_promotion_likes as $hotelPromotionLikes): ?>
            <tr>
                <td><?= h($hotelPromotionLikes->id) ?></td>
                <td><?= h($hotelPromotionLikes->hotel_promotion_id) ?></td>
                <td><?= h($hotelPromotionLikes->user_id) ?></td>
                <td><?= h($hotelPromotionLikes->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'HotelPromotionLikes', 'action' => 'view', $hotelPromotionLikes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'HotelPromotionLikes', 'action' => 'edit', $hotelPromotionLikes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'HotelPromotionLikes', 'action' => 'delete', $hotelPromotionLikes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionLikes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Hotel Promotion Price Before Renews') ?></h4>
        <?php if (!empty($hotelPromotion->hotel_promotion_price_before_renews)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Hotel Promotion Id') ?></th>
                <th scope="col"><?= __('Price Master Id') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Visible Date') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($hotelPromotion->hotel_promotion_price_before_renews as $hotelPromotionPriceBeforeRenews): ?>
            <tr>
                <td><?= h($hotelPromotionPriceBeforeRenews->id) ?></td>
                <td><?= h($hotelPromotionPriceBeforeRenews->hotel_promotion_id) ?></td>
                <td><?= h($hotelPromotionPriceBeforeRenews->price_master_id) ?></td>
                <td><?= h($hotelPromotionPriceBeforeRenews->price) ?></td>
                <td><?= h($hotelPromotionPriceBeforeRenews->visible_date) ?></td>
                <td><?= h($hotelPromotionPriceBeforeRenews->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'HotelPromotionPriceBeforeRenews', 'action' => 'view', $hotelPromotionPriceBeforeRenews->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'HotelPromotionPriceBeforeRenews', 'action' => 'edit', $hotelPromotionPriceBeforeRenews->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'HotelPromotionPriceBeforeRenews', 'action' => 'delete', $hotelPromotionPriceBeforeRenews->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionPriceBeforeRenews->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Hotel Promotion Reports') ?></h4>
        <?php if (!empty($hotelPromotion->hotel_promotion_reports)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Hotel Promotion Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Report Reason Id') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($hotelPromotion->hotel_promotion_reports as $hotelPromotionReports): ?>
            <tr>
                <td><?= h($hotelPromotionReports->id) ?></td>
                <td><?= h($hotelPromotionReports->hotel_promotion_id) ?></td>
                <td><?= h($hotelPromotionReports->user_id) ?></td>
                <td><?= h($hotelPromotionReports->report_reason_id) ?></td>
                <td><?= h($hotelPromotionReports->comment) ?></td>
                <td><?= h($hotelPromotionReports->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'HotelPromotionReports', 'action' => 'view', $hotelPromotionReports->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'HotelPromotionReports', 'action' => 'edit', $hotelPromotionReports->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'HotelPromotionReports', 'action' => 'delete', $hotelPromotionReports->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionReports->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Hotel Promotion Views') ?></h4>
        <?php if (!empty($hotelPromotion->hotel_promotion_views)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Hotel Promotion Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($hotelPromotion->hotel_promotion_views as $hotelPromotionViews): ?>
            <tr>
                <td><?= h($hotelPromotionViews->id) ?></td>
                <td><?= h($hotelPromotionViews->hotel_promotion_id) ?></td>
                <td><?= h($hotelPromotionViews->user_id) ?></td>
                <td><?= h($hotelPromotionViews->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'HotelPromotionViews', 'action' => 'view', $hotelPromotionViews->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'HotelPromotionViews', 'action' => 'edit', $hotelPromotionViews->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'HotelPromotionViews', 'action' => 'delete', $hotelPromotionViews->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionViews->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
