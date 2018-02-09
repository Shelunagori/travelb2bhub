<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Testimonial'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Responses'), ['controller' => 'Responses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Response'), ['controller' => 'Responses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="testimonial index large-9 medium-8 columns content">
    <h3><?= __('Testimonial') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('author_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('request_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('response_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($testimonial as $testimonial): ?>
            <tr>
                <td><?= $this->Number->format($testimonial->id) ?></td>
                <td><?= $testimonial->has('user') ? $this->Html->link($testimonial->user->id, ['controller' => 'Users', 'action' => 'view', $testimonial->user->id]) : '' ?></td>
                <td><?= $this->Number->format($testimonial->author_id) ?></td>
                <td><?= $testimonial->has('request') ? $this->Html->link($testimonial->request->id, ['controller' => 'Requests', 'action' => 'view', $testimonial->request->id]) : '' ?></td>
                <td><?= $testimonial->has('response') ? $this->Html->link($testimonial->response->id, ['controller' => 'Responses', 'action' => 'view', $testimonial->response->id]) : '' ?></td>
                <td><?= h($testimonial->updated_at) ?></td>
                <td><?= h($testimonial->created_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $testimonial->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $testimonial->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $testimonial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testimonial->id)]) ?>
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
