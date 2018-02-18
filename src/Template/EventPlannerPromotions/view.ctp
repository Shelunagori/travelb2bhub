<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Event Planner Promotion'), ['action' => 'edit', $eventPlannerPromotion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Event Planner Promotion'), ['action' => 'delete', $eventPlannerPromotion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventPlannerPromotion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Event Planner Promotions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Planner Promotion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Price Masters'), ['controller' => 'PriceMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Price Master'), ['controller' => 'PriceMasters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Event Planner Promotion Cities'), ['controller' => 'EventPlannerPromotionCities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Planner Promotion City'), ['controller' => 'EventPlannerPromotionCities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Event Planner Promotion States'), ['controller' => 'EventPlannerPromotionStates', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Planner Promotion State'), ['controller' => 'EventPlannerPromotionStates', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="eventPlannerPromotions view large-9 medium-8 columns content">
    <h3><?= h($eventPlannerPromotion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($eventPlannerPromotion->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Document') ?></th>
            <td><?= h($eventPlannerPromotion->document) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Master') ?></th>
            <td><?= $eventPlannerPromotion->has('price_master') ? $this->Html->link($eventPlannerPromotion->price_master->week, ['controller' => 'PriceMasters', 'action' => 'view', $eventPlannerPromotion->price_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $eventPlannerPromotion->has('user') ? $this->Html->link($eventPlannerPromotion->user->last_name, ['controller' => 'Users', 'action' => 'view', $eventPlannerPromotion->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($eventPlannerPromotion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country Id') ?></th>
            <td><?= $this->Number->format($eventPlannerPromotion->country_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Like Count') ?></th>
            <td><?= $this->Number->format($eventPlannerPromotion->like_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($eventPlannerPromotion->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Visible Date') ?></th>
            <td><?= h($eventPlannerPromotion->visible_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($eventPlannerPromotion->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($eventPlannerPromotion->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Event Detail') ?></h4>
        <?= $this->Text->autoParagraph(h($eventPlannerPromotion->event_detail)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Event Planner Promotion Cities') ?></h4>
        <?php if (!empty($eventPlannerPromotion->event_planner_promotion_cities)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Event Planner Promotion Id') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($eventPlannerPromotion->event_planner_promotion_cities as $eventPlannerPromotionCities): ?>
            <tr>
                <td><?= h($eventPlannerPromotionCities->id) ?></td>
                <td><?= h($eventPlannerPromotionCities->event_planner_promotion_id) ?></td>
                <td><?= h($eventPlannerPromotionCities->city_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EventPlannerPromotionCities', 'action' => 'view', $eventPlannerPromotionCities->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EventPlannerPromotionCities', 'action' => 'edit', $eventPlannerPromotionCities->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EventPlannerPromotionCities', 'action' => 'delete', $eventPlannerPromotionCities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventPlannerPromotionCities->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Event Planner Promotion States') ?></h4>
        <?php if (!empty($eventPlannerPromotion->event_planner_promotion_states)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Event Planner Promotion Id') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($eventPlannerPromotion->event_planner_promotion_states as $eventPlannerPromotionStates): ?>
            <tr>
                <td><?= h($eventPlannerPromotionStates->id) ?></td>
                <td><?= h($eventPlannerPromotionStates->event_planner_promotion_id) ?></td>
                <td><?= h($eventPlannerPromotionStates->state_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EventPlannerPromotionStates', 'action' => 'view', $eventPlannerPromotionStates->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EventPlannerPromotionStates', 'action' => 'edit', $eventPlannerPromotionStates->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EventPlannerPromotionStates', 'action' => 'delete', $eventPlannerPromotionStates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventPlannerPromotionStates->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
