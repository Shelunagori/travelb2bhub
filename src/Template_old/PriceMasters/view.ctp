<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Price Master'), ['action' => 'edit', $priceMaster->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Price Master'), ['action' => 'delete', $priceMaster->id], ['confirm' => __('Are you sure you want to delete # {0}?', $priceMaster->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Price Masters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Price Master'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Promotion Types'), ['controller' => 'PromotionTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Promotion Type'), ['controller' => 'PromotionTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Event Planner Promotions'), ['controller' => 'EventPlannerPromotions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Planner Promotion'), ['controller' => 'EventPlannerPromotions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Post Travle Packages'), ['controller' => 'PostTravlePackages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post Travle Package'), ['controller' => 'PostTravlePackages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotions'), ['controller' => 'TaxiFleetPromotions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion'), ['controller' => 'TaxiFleetPromotions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="priceMasters view large-9 medium-8 columns content">
    <h3><?= h($priceMaster->week) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Promotion Type') ?></th>
            <td><?= $priceMaster->has('promotion_type') ? $this->Html->link($priceMaster->promotion_type->name, ['controller' => 'PromotionTypes', 'action' => 'view', $priceMaster->promotion_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Week') ?></th>
            <td><?= h($priceMaster->week) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($priceMaster->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($priceMaster->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($priceMaster->is_deleted) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Event Planner Promotions') ?></h4>
        <?php if (!empty($priceMaster->event_planner_promotions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('Event Detail') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Document') ?></th>
                <th scope="col"><?= __('Price Master Id') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Visible Date') ?></th>
                <th scope="col"><?= __('Like Count') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Submitted From') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($priceMaster->event_planner_promotions as $eventPlannerPromotions): ?>
            <tr>
                <td><?= h($eventPlannerPromotions->id) ?></td>
                <td><?= h($eventPlannerPromotions->country_id) ?></td>
                <td><?= h($eventPlannerPromotions->event_detail) ?></td>
                <td><?= h($eventPlannerPromotions->image) ?></td>
                <td><?= h($eventPlannerPromotions->document) ?></td>
                <td><?= h($eventPlannerPromotions->price_master_id) ?></td>
                <td><?= h($eventPlannerPromotions->price) ?></td>
                <td><?= h($eventPlannerPromotions->visible_date) ?></td>
                <td><?= h($eventPlannerPromotions->like_count) ?></td>
                <td><?= h($eventPlannerPromotions->user_id) ?></td>
                <td><?= h($eventPlannerPromotions->created_on) ?></td>
                <td><?= h($eventPlannerPromotions->edited_by) ?></td>
                <td><?= h($eventPlannerPromotions->edited_on) ?></td>
                <td><?= h($eventPlannerPromotions->is_deleted) ?></td>
                <td><?= h($eventPlannerPromotions->submitted_from) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EventPlannerPromotions', 'action' => 'view', $eventPlannerPromotions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EventPlannerPromotions', 'action' => 'edit', $eventPlannerPromotions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EventPlannerPromotions', 'action' => 'delete', $eventPlannerPromotions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventPlannerPromotions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Post Travle Packages') ?></h4>
        <?php if (!empty($priceMaster->post_travle_packages)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Duration Night') ?></th>
                <th scope="col"><?= __('Duration Day') ?></th>
                <th scope="col"><?= __('Valid Date') ?></th>
                <th scope="col"><?= __('Currency Id') ?></th>
                <th scope="col"><?= __('Starting Price') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('Package Detail') ?></th>
                <th scope="col"><?= __('Excluded Detail') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Document') ?></th>
                <th scope="col"><?= __('Price Master Id') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Like Count') ?></th>
                <th scope="col"><?= __('Visible Date') ?></th>
                <th scope="col"><?= __('Duration Day Night') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Submitted From') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($priceMaster->post_travle_packages as $postTravlePackages): ?>
            <tr>
                <td><?= h($postTravlePackages->id) ?></td>
                <td><?= h($postTravlePackages->title) ?></td>
                <td><?= h($postTravlePackages->duration_night) ?></td>
                <td><?= h($postTravlePackages->duration_day) ?></td>
                <td><?= h($postTravlePackages->valid_date) ?></td>
                <td><?= h($postTravlePackages->currency_id) ?></td>
                <td><?= h($postTravlePackages->starting_price) ?></td>
                <td><?= h($postTravlePackages->country_id) ?></td>
                <td><?= h($postTravlePackages->package_detail) ?></td>
                <td><?= h($postTravlePackages->excluded_detail) ?></td>
                <td><?= h($postTravlePackages->image) ?></td>
                <td><?= h($postTravlePackages->document) ?></td>
                <td><?= h($postTravlePackages->price_master_id) ?></td>
                <td><?= h($postTravlePackages->price) ?></td>
                <td><?= h($postTravlePackages->like_count) ?></td>
                <td><?= h($postTravlePackages->visible_date) ?></td>
                <td><?= h($postTravlePackages->duration_day_night) ?></td>
                <td><?= h($postTravlePackages->user_id) ?></td>
                <td><?= h($postTravlePackages->created_on) ?></td>
                <td><?= h($postTravlePackages->edited_by) ?></td>
                <td><?= h($postTravlePackages->edited_on) ?></td>
                <td><?= h($postTravlePackages->is_deleted) ?></td>
                <td><?= h($postTravlePackages->submitted_from) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PostTravlePackages', 'action' => 'view', $postTravlePackages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PostTravlePackages', 'action' => 'edit', $postTravlePackages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PostTravlePackages', 'action' => 'delete', $postTravlePackages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Taxi Fleet Promotions') ?></h4>
        <?php if (!empty($priceMaster->taxi_fleet_promotions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('Fleet Detail') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Document') ?></th>
                <th scope="col"><?= __('Price Master Id') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Like Count') ?></th>
                <th scope="col"><?= __('Visible Date') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Submitted From') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($priceMaster->taxi_fleet_promotions as $taxiFleetPromotions): ?>
            <tr>
                <td><?= h($taxiFleetPromotions->id) ?></td>
                <td><?= h($taxiFleetPromotions->title) ?></td>
                <td><?= h($taxiFleetPromotions->country_id) ?></td>
                <td><?= h($taxiFleetPromotions->fleet_detail) ?></td>
                <td><?= h($taxiFleetPromotions->image) ?></td>
                <td><?= h($taxiFleetPromotions->document) ?></td>
                <td><?= h($taxiFleetPromotions->price_master_id) ?></td>
                <td><?= h($taxiFleetPromotions->price) ?></td>
                <td><?= h($taxiFleetPromotions->like_count) ?></td>
                <td><?= h($taxiFleetPromotions->visible_date) ?></td>
                <td><?= h($taxiFleetPromotions->user_id) ?></td>
                <td><?= h($taxiFleetPromotions->created_on) ?></td>
                <td><?= h($taxiFleetPromotions->edited_by) ?></td>
                <td><?= h($taxiFleetPromotions->edited_on) ?></td>
                <td><?= h($taxiFleetPromotions->is_deleted) ?></td>
                <td><?= h($taxiFleetPromotions->submitted_from) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TaxiFleetPromotions', 'action' => 'view', $taxiFleetPromotions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TaxiFleetPromotions', 'action' => 'edit', $taxiFleetPromotions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TaxiFleetPromotions', 'action' => 'delete', $taxiFleetPromotions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxiFleetPromotions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
