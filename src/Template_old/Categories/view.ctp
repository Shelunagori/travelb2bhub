<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Category'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Pages'), ['controller' => 'Pages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page'), ['controller' => 'Pages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="categories view large-9 medium-8 columns content">
    <h3><?= h($category->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($category->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($category->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Flag') ?></th>
            <td><?= $this->Number->format($category->flag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($category->created_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Pages') ?></h4>
        <?php if (!empty($category->pages)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Category Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Updated At') ?></th>
                <th scope="col"><?= __('Is Mobile') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($category->pages as $pages): ?>
            <tr>
                <td><?= h($pages->id) ?></td>
                <td><?= h($pages->category_id) ?></td>
                <td><?= h($pages->title) ?></td>
                <td><?= h($pages->description) ?></td>
                <td><?= h($pages->created_at) ?></td>
                <td><?= h($pages->updated_at) ?></td>
                <td><?= h($pages->is_mobile) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Pages', 'action' => 'view', $pages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Pages', 'action' => 'edit', $pages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Pages', 'action' => 'delete', $pages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Requests') ?></h4>
        <?php if (!empty($category->requests)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Category Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Final Id') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('Locality') ?></th>
                <th scope="col"><?= __('Reference Id') ?></th>
                <th scope="col"><?= __('Response Id') ?></th>
                <th scope="col"><?= __('Total Budget') ?></th>
                <th scope="col"><?= __('Children') ?></th>
                <th scope="col"><?= __('Adult') ?></th>
                <th scope="col"><?= __('Room1') ?></th>
                <th scope="col"><?= __('Room2') ?></th>
                <th scope="col"><?= __('Room3') ?></th>
                <th scope="col"><?= __('Child With Bed') ?></th>
                <th scope="col"><?= __('Child Without Bed') ?></th>
                <th scope="col"><?= __('Hotel Rating') ?></th>
                <th scope="col"><?= __('Hotel Category') ?></th>
                <th scope="col"><?= __('Meal Plan') ?></th>
                <th scope="col"><?= __('Destination City') ?></th>
                <th scope="col"><?= __('Check In') ?></th>
                <th scope="col"><?= __('Check Out') ?></th>
                <th scope="col"><?= __('Transport Requirement') ?></th>
                <th scope="col"><?= __('Pickup City') ?></th>
                <th scope="col"><?= __('Pickup State') ?></th>
                <th scope="col"><?= __('Pickup Country') ?></th>
                <th scope="col"><?= __('Pickup Locality') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Final Locality') ?></th>
                <th scope="col"><?= __('Final City') ?></th>
                <th scope="col"><?= __('Final State') ?></th>
                <th scope="col"><?= __('Final Country') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Start Date') ?></th>
                <th scope="col"><?= __('End Date') ?></th>
                <th scope="col"><?= __('Stops') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Accept Date') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($category->requests as $requests): ?>
            <tr>
                <td><?= h($requests->id) ?></td>
                <td><?= h($requests->category_id) ?></td>
                <td><?= h($requests->user_id) ?></td>
                <td><?= h($requests->final_id) ?></td>
                <td><?= h($requests->state_id) ?></td>
                <td><?= h($requests->country_id) ?></td>
                <td><?= h($requests->locality) ?></td>
                <td><?= h($requests->reference_id) ?></td>
                <td><?= h($requests->response_id) ?></td>
                <td><?= h($requests->total_budget) ?></td>
                <td><?= h($requests->children) ?></td>
                <td><?= h($requests->adult) ?></td>
                <td><?= h($requests->room1) ?></td>
                <td><?= h($requests->room2) ?></td>
                <td><?= h($requests->room3) ?></td>
                <td><?= h($requests->child_with_bed) ?></td>
                <td><?= h($requests->child_without_bed) ?></td>
                <td><?= h($requests->hotel_rating) ?></td>
                <td><?= h($requests->hotel_category) ?></td>
                <td><?= h($requests->meal_plan) ?></td>
                <td><?= h($requests->destination_city) ?></td>
                <td><?= h($requests->check_in) ?></td>
                <td><?= h($requests->check_out) ?></td>
                <td><?= h($requests->transport_requirement) ?></td>
                <td><?= h($requests->pickup_city) ?></td>
                <td><?= h($requests->pickup_state) ?></td>
                <td><?= h($requests->pickup_country) ?></td>
                <td><?= h($requests->pickup_locality) ?></td>
                <td><?= h($requests->city_id) ?></td>
                <td><?= h($requests->final_locality) ?></td>
                <td><?= h($requests->final_city) ?></td>
                <td><?= h($requests->final_state) ?></td>
                <td><?= h($requests->final_country) ?></td>
                <td><?= h($requests->comment) ?></td>
                <td><?= h($requests->start_date) ?></td>
                <td><?= h($requests->end_date) ?></td>
                <td><?= h($requests->stops) ?></td>
                <td><?= h($requests->status) ?></td>
                <td><?= h($requests->is_deleted) ?></td>
                <td><?= h($requests->accept_date) ?></td>
                <td><?= h($requests->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Requests', 'action' => 'view', $requests->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Requests', 'action' => 'edit', $requests->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Requests', 'action' => 'delete', $requests->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requests->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
