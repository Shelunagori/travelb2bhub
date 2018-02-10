<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Admin Role'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Admins'), ['controller' => 'Admins', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Admin'), ['controller' => 'Admins', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="adminRole index large-9 medium-8 columns content">
    <h3><?= __('Admin Role') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('role_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('admin_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($adminRole as $adminRole): ?>
            <tr>
                <td><?= $adminRole->has('role') ? $this->Html->link($adminRole->role->name, ['controller' => 'Roles', 'action' => 'view', $adminRole->role->id]) : '' ?></td>
                <td><?= $adminRole->has('admin') ? $this->Html->link($adminRole->admin->id, ['controller' => 'Admins', 'action' => 'view', $adminRole->admin->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $adminRole->role_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $adminRole->role_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $adminRole->role_id], ['confirm' => __('Are you sure you want to delete # {0}?', $adminRole->role_id)]) ?>
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
