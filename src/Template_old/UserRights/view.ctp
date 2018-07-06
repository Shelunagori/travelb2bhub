<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Right'), ['action' => 'edit', $userRight->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Right'), ['action' => 'delete', $userRight->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userRight->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Rights'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Right'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Modules'), ['controller' => 'Modules', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Module'), ['controller' => 'Modules', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userRights view large-9 medium-8 columns content">
    <h3><?= h($userRight->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userRight->has('user') ? $this->Html->link($userRight->user->last_name, ['controller' => 'Users', 'action' => 'view', $userRight->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $userRight->has('role') ? $this->Html->link($userRight->role->name, ['controller' => 'Roles', 'action' => 'view', $userRight->role->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Module') ?></th>
            <td><?= $userRight->has('module') ? $this->Html->link($userRight->module->name, ['controller' => 'Modules', 'action' => 'view', $userRight->module->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userRight->id) ?></td>
        </tr>
    </table>
</div>
