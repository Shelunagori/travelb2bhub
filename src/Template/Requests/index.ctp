<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Request'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Ratings'), ['controller' => 'UserRatings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Rating'), ['controller' => 'UserRatings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Responses'), ['controller' => 'Responses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Response'), ['controller' => 'Responses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hotels'), ['controller' => 'Hotels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hotel'), ['controller' => 'Hotels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Request Stops'), ['controller' => 'RequestStops', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request Stop'), ['controller' => 'RequestStops', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="requests index large-9 medium-8 columns content">
    <h3><?= __('Requests') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('final_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('locality') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reference_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('response_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_budget') ?></th>
                <th scope="col"><?= $this->Paginator->sort('children') ?></th>
                <th scope="col"><?= $this->Paginator->sort('adult') ?></th>
                <th scope="col"><?= $this->Paginator->sort('room1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('room2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('room3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('child_with_bed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('child_without_bed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hotel_rating') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hotel_category') ?></th>
                <th scope="col"><?= $this->Paginator->sort('meal_plan') ?></th>
                <th scope="col"><?= $this->Paginator->sort('destination_city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('check_in') ?></th>
                <th scope="col"><?= $this->Paginator->sort('check_out') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transport_requirement') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pickup_city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pickup_state') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pickup_country') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pickup_locality') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('final_locality') ?></th>
                <th scope="col"><?= $this->Paginator->sort('final_city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('final_state') ?></th>
                <th scope="col"><?= $this->Paginator->sort('final_country') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stops') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('accept_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $request): ?>
            <tr>
                <td><?= $this->Number->format($request->id) ?></td>
                <td><?= $this->Number->format($request->category_id) ?></td>
                <td><?= $request->has('user') ? $this->Html->link($request->user->id, ['controller' => 'Users', 'action' => 'view', $request->user->id]) : '' ?></td>
                <td><?= $this->Number->format($request->final_id) ?></td>
                <td><?= $this->Number->format($request->state_id) ?></td>
                <td><?= $this->Number->format($request->country_id) ?></td>
                <td><?= h($request->locality) ?></td>
                <td><?= h($request->reference_id) ?></td>
                <td><?= $this->Number->format($request->response_id) ?></td>
                <td><?= $this->Number->format($request->total_budget) ?></td>
                <td><?= h($request->children) ?></td>
                <td><?= h($request->adult) ?></td>
                <td><?= h($request->room1) ?></td>
                <td><?= h($request->room2) ?></td>
                <td><?= h($request->room3) ?></td>
                <td><?= h($request->child_with_bed) ?></td>
                <td><?= h($request->child_without_bed) ?></td>
                <td><?= $this->Number->format($request->hotel_rating) ?></td>
                <td><?= h($request->hotel_category) ?></td>
                <td><?= h($request->meal_plan) ?></td>
                <td><?= $this->Number->format($request->destination_city) ?></td>
                <td><?= h($request->check_in) ?></td>
                <td><?= h($request->check_out) ?></td>
                <td><?= h($request->transport_requirement) ?></td>
                <td><?= $this->Number->format($request->pickup_city) ?></td>
                <td><?= $this->Number->format($request->pickup_state) ?></td>
                <td><?= $this->Number->format($request->pickup_country) ?></td>
                <td><?= h($request->pickup_locality) ?></td>
                <td><?= $request->has('city') ? $this->Html->link($request->city->id, ['controller' => 'Cities', 'action' => 'view', $request->city->id]) : '' ?></td>
                <td><?= h($request->final_locality) ?></td>
                <td><?= $this->Number->format($request->final_city) ?></td>
                <td><?= $this->Number->format($request->final_state) ?></td>
                <td><?= $this->Number->format($request->final_country) ?></td>
                <td><?= h($request->start_date) ?></td>
                <td><?= h($request->end_date) ?></td>
                <td><?= h($request->stops) ?></td>
                <td><?= $this->Number->format($request->status) ?></td>
                <td><?= $this->Number->format($request->is_deleted) ?></td>
                <td><?= h($request->accept_date) ?></td>
                <td><?= h($request->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $request->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $request->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $request->id], ['confirm' => __('Are you sure you want to delete # {0}?', $request->id)]) ?>
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
