<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Request'), ['action' => 'edit', $request->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Request'), ['action' => 'delete', $request->id], ['confirm' => __('Are you sure you want to delete # {0}?', $request->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Requests'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Ratings'), ['controller' => 'UserRatings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Rating'), ['controller' => 'UserRatings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Responses'), ['controller' => 'Responses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Response'), ['controller' => 'Responses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hotels'), ['controller' => 'Hotels', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel'), ['controller' => 'Hotels', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Request Stops'), ['controller' => 'RequestStops', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request Stop'), ['controller' => 'RequestStops', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="requests view large-9 medium-8 columns content">
    <h3><?= h($request->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $request->has('user') ? $this->Html->link($request->user->id, ['controller' => 'Users', 'action' => 'view', $request->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Locality') ?></th>
            <td><?= h($request->locality) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reference Id') ?></th>
            <td><?= h($request->reference_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Children') ?></th>
            <td><?= h($request->children) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adult') ?></th>
            <td><?= h($request->adult) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Room1') ?></th>
            <td><?= h($request->room1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Room2') ?></th>
            <td><?= h($request->room2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Room3') ?></th>
            <td><?= h($request->room3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Child With Bed') ?></th>
            <td><?= h($request->child_with_bed) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Child Without Bed') ?></th>
            <td><?= h($request->child_without_bed) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hotel Category') ?></th>
            <td><?= h($request->hotel_category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meal Plan') ?></th>
            <td><?= h($request->meal_plan) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transport Requirement') ?></th>
            <td><?= h($request->transport_requirement) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pickup Locality') ?></th>
            <td><?= h($request->pickup_locality) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= $request->has('city') ? $this->Html->link($request->city->id, ['controller' => 'Cities', 'action' => 'view', $request->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Final Locality') ?></th>
            <td><?= h($request->final_locality) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stops') ?></th>
            <td><?= h($request->stops) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Rating') ?></th>
            <td><?= $request->has('user_rating') ? $this->Html->link($request->user_rating->id, ['controller' => 'UserRatings', 'action' => 'view', $request->user_rating->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($request->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category Id') ?></th>
            <td><?= $this->Number->format($request->category_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Final Id') ?></th>
            <td><?= $this->Number->format($request->final_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State Id') ?></th>
            <td><?= $this->Number->format($request->state_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country Id') ?></th>
            <td><?= $this->Number->format($request->country_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Response Id') ?></th>
            <td><?= $this->Number->format($request->response_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Budget') ?></th>
            <td><?= $this->Number->format($request->total_budget) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hotel Rating') ?></th>
            <td><?= $this->Number->format($request->hotel_rating) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Destination City') ?></th>
            <td><?= $this->Number->format($request->destination_city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pickup City') ?></th>
            <td><?= $this->Number->format($request->pickup_city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pickup State') ?></th>
            <td><?= $this->Number->format($request->pickup_state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pickup Country') ?></th>
            <td><?= $this->Number->format($request->pickup_country) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Final City') ?></th>
            <td><?= $this->Number->format($request->final_city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Final State') ?></th>
            <td><?= $this->Number->format($request->final_state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Final Country') ?></th>
            <td><?= $this->Number->format($request->final_country) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($request->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($request->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Check In') ?></th>
            <td><?= h($request->check_in) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Check Out') ?></th>
            <td><?= h($request->check_out) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($request->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($request->end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Accept Date') ?></th>
            <td><?= h($request->accept_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($request->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($request->comment)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Responses') ?></h4>
        <?php if (!empty($request->responses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Request Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Quotation Price') ?></th>
                <th scope="col"><?= __('Is Details Shared') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($request->responses as $responses): ?>
            <tr>
                <td><?= h($responses->id) ?></td>
                <td><?= h($responses->request_id) ?></td>
                <td><?= h($responses->user_id) ?></td>
                <td><?= h($responses->comment) ?></td>
                <td><?= h($responses->quotation_price) ?></td>
                <td><?= h($responses->is_details_shared) ?></td>
                <td><?= h($responses->created) ?></td>
                <td><?= h($responses->status) ?></td>
                <td><?= h($responses->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Responses', 'action' => 'view', $responses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Responses', 'action' => 'edit', $responses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Responses', 'action' => 'delete', $responses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $responses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Hotels') ?></h4>
        <?php if (!empty($request->hotels)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Req Id') ?></th>
                <th scope="col"><?= __('Room1') ?></th>
                <th scope="col"><?= __('Room2') ?></th>
                <th scope="col"><?= __('Room3') ?></th>
                <th scope="col"><?= __('Child With Bed') ?></th>
                <th scope="col"><?= __('Child Without Bed') ?></th>
                <th scope="col"><?= __('Hotel Rating') ?></th>
                <th scope="col"><?= __('Hotel Category') ?></th>
                <th scope="col"><?= __('Meal Plan') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('Locality') ?></th>
                <th scope="col"><?= __('Check In') ?></th>
                <th scope="col"><?= __('Check Out') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($request->hotels as $hotels): ?>
            <tr>
                <td><?= h($hotels->id) ?></td>
                <td><?= h($hotels->user_id) ?></td>
                <td><?= h($hotels->req_id) ?></td>
                <td><?= h($hotels->room1) ?></td>
                <td><?= h($hotels->room2) ?></td>
                <td><?= h($hotels->room3) ?></td>
                <td><?= h($hotels->child_with_bed) ?></td>
                <td><?= h($hotels->child_without_bed) ?></td>
                <td><?= h($hotels->hotel_rating) ?></td>
                <td><?= h($hotels->hotel_category) ?></td>
                <td><?= h($hotels->meal_plan) ?></td>
                <td><?= h($hotels->city_id) ?></td>
                <td><?= h($hotels->state_id) ?></td>
                <td><?= h($hotels->country_id) ?></td>
                <td><?= h($hotels->locality) ?></td>
                <td><?= h($hotels->check_in) ?></td>
                <td><?= h($hotels->check_out) ?></td>
                <td><?= h($hotels->created) ?></td>
                <td><?= h($hotels->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Hotels', 'action' => 'view', $hotels->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Hotels', 'action' => 'edit', $hotels->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Hotels', 'action' => 'delete', $hotels->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotels->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Request Stops') ?></h4>
        <?php if (!empty($request->request_stops)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Request Id') ?></th>
                <th scope="col"><?= __('Locality') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($request->request_stops as $requestStops): ?>
            <tr>
                <td><?= h($requestStops->id) ?></td>
                <td><?= h($requestStops->request_id) ?></td>
                <td><?= h($requestStops->locality) ?></td>
                <td><?= h($requestStops->city_id) ?></td>
                <td><?= h($requestStops->state_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'RequestStops', 'action' => 'view', $requestStops->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'RequestStops', 'action' => 'edit', $requestStops->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'RequestStops', 'action' => 'delete', $requestStops->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requestStops->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
