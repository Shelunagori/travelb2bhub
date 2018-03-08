<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div id="my_final_responses" class="container-fluid">
	<div class="row equal_column">
		<div class="col-md-12" style="background-color:#fff"> 
			<br>
			<?php echo  $this->Flash->render() ?>
		</div>
		<div class="col-md-12" style="background-color:#fff"> 
			<div class="box box-default">
				<div class="box-header with-border"> 
					<h3 class="box-title"><?= __('Taxi Fleet Promotions') ?></h3>
					<div class="box-tools pull-right">
 					</div>
 				</div>
<div class="box-body">
	<table class="table" cellpadding="0" cellspacing="0">
        <thead>
            <tr style="background-color:#709090;color:white">
                <th scope="col"><?= ('Sr.No') ?></th>
				<th scope="col"><?= ('User Name') ?></th>
                <th scope="col"><?= ('Title') ?></th>
                <th scope="col"><?= ('Country') ?></th>
                <th scope="col"><?= ('Duration') ?></th>
                <th scope="col"><?= ('Likes') ?></th>
                <th scope="col"><?= ('Visibility Date') ?></th>
				 <th scope="col"><?= ('Image') ?></th>
                <th scope="col"><?= ('Document') ?></th>
               
               
               
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1;foreach ($taxiFleetPromotions as $taxiFleetPromotion): ?>
            <tr>
                <td><?= $i; ?></td>
				<td><?= h($taxiFleetPromotion->user->first_name.$taxiFleetPromotion->user->last_name);?></td>
                <td><?= h($taxiFleetPromotion->title) ?></td>
                <td><?= h($taxiFleetPromotion->country->country_name); ?></td>
                <td><?= h($taxiFleetPromotion->price_master->week); ?></td>              
                <td><?= $this->Number->format($taxiFleetPromotion->like_count) ?></td>
                <td><?= h($taxiFleetPromotion->visible_date) ?></td>
				<td><?= $this->Number->format($taxiFleetPromotion->image) ?></td>
                <td><?= $this->Number->format($taxiFleetPromotion->document) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $taxiFleetPromotion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $taxiFleetPromotion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $taxiFleetPromotion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxiFleetPromotion->id)]) ?>
                </td>
            </tr>
            <?php $i++;endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
</div>
</div>
</div>
</div>
