<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User Feedback'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="userFeedbacks index large-9 medium-8 columns content">
    <h3><?= __('User Feedbacks') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subject') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userFeedbacks as $userFeedback): ?>
            <tr>
                <td><?= $this->Number->format($userFeedback->id) ?></td>
                <td><?= $userFeedback->has('user') ? $this->Html->link($userFeedback->user->last_name, ['controller' => 'Users', 'action' => 'view', $userFeedback->user->id]) : '' ?></td>
                <td><?= h($userFeedback->subject) ?></td>
                <td><?= h($userFeedback->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userFeedback->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userFeedback->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userFeedback->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userFeedback->id)]) ?>
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
