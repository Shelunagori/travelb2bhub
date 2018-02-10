<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Admin'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Admin Role'), ['controller' => 'AdminRole', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Admin Role'), ['controller' => 'AdminRole', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="admins index large-9 medium-8 columns content">
    <h3><?= __('Admins') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('password') ?></th>
                <th scope="col"><?= $this->Paginator->sort('activated') ?></th>
                <th scope="col"><?= $this->Paginator->sort('activation_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('activated_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_login') ?></th>
                <th scope="col"><?= $this->Paginator->sort('persist_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reset_password_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('remember_token') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($AdminsRecord as $admin): ?>
            <tr>
                <td><?= $this->Number->format($admin->id) ?></td>
                <td><?= h($admin->email) ?></td>
                <td><?= h($admin->password) ?></td>
                <td><?= h($admin->activated) ?></td>
                <td><?= h($admin->activation_code) ?></td>
                <td><?= h($admin->activated_at) ?></td>
                <td><?= h($admin->last_login) ?></td>
                <td><?= h($admin->persist_code) ?></td>
                <td><?= h($admin->reset_password_code) ?></td>
                <td><?= h($admin->remember_token) ?></td>
                <td><?= h($admin->first_name) ?></td>
                <td><?= h($admin->last_name) ?></td>
                <td><?= h($admin->created_at) ?></td>
                <td><?= h($admin->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $admin->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $admin->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $admin->id], ['confirm' => __('Are you sure you want to delete # {0}?', $admin->id)]) ?>
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
