<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $membership->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $membership->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Membership'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="membership form large-9 medium-8 columns content">
    <?= $this->Form->create($membership) ?>
    <fieldset>
        <legend><?= __('Edit Membership') ?></legend>
        <?php
            echo $this->Form->input('membership_name');
            echo $this->Form->input('description');
            echo $this->Form->input('price');
            echo $this->Form->input('duration');
            echo $this->Form->input('status');
            echo $this->Form->input('created_at');
            echo $this->Form->input('updated_at');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
