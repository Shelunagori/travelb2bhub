<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-list"></i> <b>Testimonials List</b>
				</div> 
			<div class="box-body"> 
						 
			<form method="get">
				<fieldset><legend><button type="button" class="btn btn-xs btn-info collapsed" data-toggle="collapse" data-target="#demo" aria-expanded="false">Click here to search</button></legend>
					<div class="col-md-12 collapse"  id="demo" aria-expanded="false">
						<div class="row"> 
							<div class="col-md-6">
								<label class="control-label">Select Rating</label>
								<select name="Rateing" class="form-control select2" placeholder="Select...">
									<option value="">Select...</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>	
							</div>
							<div class="col-md-6" align="center">
								<label class="control-label col-md-12">&nbsp;</label>
								<?php echo $this->Form->button('Search',['class'=>'btn btn-sm btn-success','id'=>'submit_member','name'=>'search_report']); ?> 
							</div> 
						</div>
					</div>
				</fieldset>
			</form>

				<table class="table table-bordered" cellpadding="0" cellspacing="0" id="main_tble">
							<thead>
								<tr style="background-color:#DFD9C4;">
									<th scope="col"><?= __('Sr.No') ?></th>
									<th scope="col"><?= __('User') ?></th>
									<th scope="col"><?= __('Author') ?></th>
									<th scope="col"><?= __('Rating') ?></th>
									<th scope="col" class="actions"><?= __('Actions') ?></th>
								</tr>
						</thead>
						<tbody>
							<?php $i=1; foreach ($testimonial as $testimonials): ?>
							<tr>
								<td><?php echo $i; ?></td>
								
								<td><?= $testimonials->user->first_name.' '.$testimonials->user->last_name ?></td>
								<td><?= $testimonials->author->first_name ?></td> 
								<td><?php echo $testimonials->rating; ?></td>
								<td class="actions">
									<?php echo $this->Html->link('<i class="fa fa-file"></i>','/Testimonial/view/'.$testimonials->id,array('escape'=>false,'class'=>'btn btn-warning btn-xs'));?>
									
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