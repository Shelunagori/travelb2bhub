<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Admin'), ['action' => 'edit', $admin->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Admin'), ['action' => 'delete', $admin->id], ['confirm' => __('Are you sure you want to delete # {0}?', $admin->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Admins'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Admin'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Admin Role'), ['controller' => 'AdminRole', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Admin Role'), ['controller' => 'AdminRole', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="admins view large-9 medium-8 columns content">
    <h3><?= h($admin->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($admin->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($admin->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activation Code') ?></th>
            <td><?= h($admin->activation_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Persist Code') ?></th>
            <td><?= h($admin->persist_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reset Password Code') ?></th>
            <td><?= h($admin->reset_password_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Remember Token') ?></th>
            <td><?= h($admin->remember_token) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($admin->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($admin->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($admin->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activated At') ?></th>
            <td><?= h($admin->activated_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Login') ?></th>
            <td><?= h($admin->last_login) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($admin->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($admin->updated_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activated') ?></th>
            <td><?= $admin->activated ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Permissions') ?></h4>
        <?= $this->Text->autoParagraph(h($admin->permissions)); ?>
    </div>
    <div class="row">
        <h4><?= __('Formemail') ?></h4>
        <?= $this->Text->autoParagraph(h($admin->formemail)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Admin Role') ?></h4>
        <?php if (!empty($admin->admin_role)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col"><?= __('Admin Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($admin->admin_role as $adminRole): ?>
            <tr>
                <td><?= h($adminRole->role_id) ?></td>
                <td><?= h($adminRole->admin_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AdminRole', 'action' => 'view', $adminRole->role_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AdminRole', 'action' => 'edit', $adminRole->role_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AdminRole', 'action' => 'delete', $adminRole->role_id], ['confirm' => __('Are you sure you want to delete # {0}?', $adminRole->role_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
