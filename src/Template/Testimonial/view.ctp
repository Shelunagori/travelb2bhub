
<div class="testimonial view large-9 medium-8 columns content">
    <h3><?= h($testimonial->id) ?></h3>
    <table class="table">
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
