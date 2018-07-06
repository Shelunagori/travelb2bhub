<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $admin->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $admin->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Admins'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Admin Role'), ['controller' => 'AdminRole', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Admin Role'), ['controller' => 'AdminRole', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="admins form large-9 medium-8 columns content">
    <?= $this->Form->create($admin) ?>
    <fieldset>
        <legend><?= __('Edit Admin') ?></legend>
        <?php
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('permissions');
            echo $this->Form->input('activated');
            echo $this->Form->input('activation_code');
            echo $this->Form->input('activated_at');
            echo $this->Form->input('last_login');
            echo $this->Form->input('persist_code');
            echo $this->Form->input('reset_password_code');
            echo $this->Form->input('remember_token');
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('formemail');
            echo $this->Form->input('created_at');
            echo $this->Form->input('updated_at');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
