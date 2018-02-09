<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Response'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Testimonial'), ['controller' => 'Testimonial', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Testimonial'), ['controller' => 'Testimonial', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Chats'), ['controller' => 'UserChats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Chat'), ['controller' => 'UserChats', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="responses index large-9 medium-8 columns content">
    <h3><?= __('Responses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('request_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quotation_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_details_shared') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($responses as $response): ?>
            <tr>
                <td><?= $this->Number->format($response->id) ?></td>
                <td><?= $response->has('request') ? $this->Html->link($response->request->id, ['controller' => 'Requests', 'action' => 'view', $response->request->id]) : '' ?></td>
                <td><?= $response->has('user') ? $this->Html->link($response->user->id, ['controller' => 'Users', 'action' => 'view', $response->user->id]) : '' ?></td>
                <td><?= $this->Number->format($response->quotation_price) ?></td>
                <td><?= $this->Number->format($response->is_details_shared) ?></td>
                <td><?= h($response->created) ?></td>
                <td><?= $this->Number->format($response->status) ?></td>
                <td><?= h($response->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $response->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $response->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $response->id], ['confirm' => __('Are you sure you want to delete # {0}?', $response->id)]) ?>
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
