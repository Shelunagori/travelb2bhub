<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Testimonial'), ['action' => 'edit', $testimonial->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Testimonial'), ['action' => 'delete', $testimonial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testimonial->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Testimonial'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Testimonial'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Responses'), ['controller' => 'Responses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Response'), ['controller' => 'Responses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="testimonial view large-9 medium-8 columns content">
    <h3><?= h($testimonial->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $testimonial->has('user') ? $this->Html->link($testimonial->user->id, ['controller' => 'Users', 'action' => 'view', $testimonial->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Request') ?></th>
            <td><?= $testimonial->has('request') ? $this->Html->link($testimonial->request->id, ['controller' => 'Requests', 'action' => 'view', $testimonial->request->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Response') ?></th>
            <td><?= $testimonial->has('response') ? $this->Html->link($testimonial->response->id, ['controller' => 'Responses', 'action' => 'view', $testimonial->response->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($testimonial->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Author Id') ?></th>
            <td><?= $this->Number->format($testimonial->author_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($testimonial->updated_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($testimonial->created_at) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($testimonial->comment)); ?>
    </div>
    <div class="row">
        <h4><?= __('Rating') ?></h4>
        <?= $this->Text->autoParagraph(h($testimonial->rating)); ?>
    </div>
    <div class="row">
        <h4><?= __('Status') ?></h4>
        <?= $this->Text->autoParagraph(h($testimonial->status)); ?>
    </div>
</div>
