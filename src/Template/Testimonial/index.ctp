<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-list"></i> <b>Testimonials List</b>
				</div> 
			 <div class="box-body"> 
				<table class="table table-bordered" cellpadding="0" cellspacing="0" id="main_tble">
							<thead>
								<tr style="background-color:#DFD9C4;">
									<th scope="col"><?= __('Sr.No') ?></th>
									<th scope="col"><?= __('Rating') ?></th>
									<th scope="col"><?= __('User') ?></th>
									<th scope="col"><?= __('Author') ?></th>
									<th scope="col" class="actions"><?= __('Actions') ?></th>
								</tr>
						</thead>
						<tbody>
							<?php $i=1; foreach ($testimonial as $testimonial): ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $testimonial->rating; ?></td>
								<td><?= $testimonial->has('user') ? $this->Html->link($testimonial->user->first_name.$testimonial->user->last_name, ['controller' => 'Users', 'action' => 'view', $testimonial->user->id]) : '' ?></td>
								<td><?= $this->Number->format($testimonial->author_id) ?></td>
								<td class="actions">
									<?php echo $this->Html->link('<i class="fa fa-file"></i>','/Testimonial/view/'.$testimonial->id,array('escape'=>false,'class'=>'btn btn-warning btn-xs'));?>
									
								</td>
							</tr>
							<?php $i++; endforeach; ?>
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
		</div>
	</div>
</div>
</section>