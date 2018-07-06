<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Response'), ['action' => 'edit', $response->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Response'), ['action' => 'delete', $response->id], ['confirm' => __('Are you sure you want to delete # {0}?', $response->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Responses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Response'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Testimonial'), ['controller' => 'Testimonial', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Testimonial'), ['controller' => 'Testimonial', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Chats'), ['controller' => 'UserChats', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Chat'), ['controller' => 'UserChats', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="responses view large-9 medium-8 columns content">
    <h3><?= h($response->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Request') ?></th>
            <td><?= $response->has('request') ? $this->Html->link($response->request->id, ['controller' => 'Requests', 'action' => 'view', $response->request->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $response->has('user') ? $this->Html->link($response->user->id, ['controller' => 'Users', 'action' => 'view', $response->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($response->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quotation Price') ?></th>
            <td><?= $this->Number->format($response->quotation_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Details Shared') ?></th>
            <td><?= $this->Number->format($response->is_details_shared) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($response->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($response->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $response->is_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($response->comment)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Chats') ?></h4>
        <?php if (!empty($response->user_chats)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Request Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Send To User Id') ?></th>
                <th scope="col"><?= __('Message') ?></th>
                <th scope="col"><?= __('Is Read') ?></th>
                <th scope="col"><?= __('Read Date Time') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Notification') ?></th>
                <th scope="col"><?= __('Screen Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($response->user_chats as $userChats): ?>
            <tr>
                <td><?= h($userChats->id) ?></td>
                <td><?= h($userChats->request_id) ?></td>
                <td><?= h($userChats->user_id) ?></td>
                <td><?= h($userChats->send_to_user_id) ?></td>
                <td><?= h($userChats->message) ?></td>
                <td><?= h($userChats->is_read) ?></td>
                <td><?= h($userChats->read_date_time) ?></td>
                <td><?= h($userChats->created) ?></td>
                <td><?= h($userChats->notification) ?></td>
                <td><?= h($userChats->screen_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserChats', 'action' => 'view', $userChats->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserChats', 'action' => 'edit', $userChats->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserChats', 'action' => 'delete', $userChats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userChats->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
