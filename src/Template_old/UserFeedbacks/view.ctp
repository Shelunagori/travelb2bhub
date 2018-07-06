<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Feedback'), ['action' => 'edit', $userFeedback->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Feedback'), ['action' => 'delete', $userFeedback->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userFeedback->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Feedbacks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Feedback'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userFeedbacks view large-9 medium-8 columns content">
    <h3><?= h($userFeedback->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userFeedback->has('user') ? $this->Html->link($userFeedback->user->last_name, ['controller' => 'Users', 'action' => 'view', $userFeedback->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= h($userFeedback->subject) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userFeedback->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($userFeedback->created_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($userFeedback->comment)); ?>
    </div>
</div>
