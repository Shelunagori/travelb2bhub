<div class="responses index large-9 medium-8 columns content">
    <h3><?= __('Responses') ?></h3>
    <table class="table table-bordered" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('request_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quotation_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_details_shared') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($responses as $response): ?>
            <tr>
                <td><?= $this->Number->format($response->id) ?></td>
                <td><?= $response->has('request') ? $this->Html->link($response->request->id, ['controller' => 'Requests', 'action' => 'view', $response->request->id]) : '' ?></td>
                <td><?= $response->has('user') ? $this->Html->link($response->user->first_name.$response->user->last_name, ['controller' => 'Users', 'action' => 'view', $response->user->id]) : '' ?></td>
                <td><?= $this->Number->format($response->quotation_price) ?></td>
                <td><?= $this->Number->format($response->is_details_shared) ?></td>
                <td><?= h($response->created) ?></td>
                <td><?= $this->Number->format($response->status) ?></td>
                <td><?= h($response->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $response->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $response->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $response->id], ['confirm' => __('Are you sure you want to delete # {0}?', $response->id)]) ?>
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
