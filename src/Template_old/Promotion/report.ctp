<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-list"></i> <b>Promotions List</b>
				</div> 
				<div class="box-body"> 
				<form method="get">
					<fieldset><legend><button type="button" class="btn btn-xs btn-info collapsed" data-toggle="collapse" data-target="#demo" aria-expanded="false">Click here to search</button></legend>
						<div class="col-md-12 collapse"  id="demo" aria-expanded="false">
							<div class="row"> 
								<div class="col-md-4">
									<label class="control-label">Hotel Name</label>
									<?php echo $this->Form->input('hotelNM',[
									'label' => false,'class'=>'form-control ','placeholder'=>'Enter Hotel Name']);?>
								</div>
								<div class="col-md-3">
									<label class="control-label">Select </label>
									<div class="form-group">
										<div class="radio">
											<label><input type="radio" name="statusWise" value="1">Activate</label>
											<label><input type="radio" name="statusWise" value="2">Deactivate</label>
										</div>
									</div>	 
								</div>
								<div class="col-md-4" align="center">
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
								<th scope="col"><?=__('Sr.No') ?></th>
								<th scope="col"><?=__('Hotelier Name') ?></th>
								<th scope="col"><?=__('Hotelier Email') ?></th>
								<th scope="col"><?=__('Hotel Name') ?></th>
								<th scope="col"><?=__('Duration (In Month)') ?></th>
								<th scope="col"><?=__('Expires On') ?></th>
								<th scope="col"><?=__('Cheap Tariff') ?></th>
								<th scope="col"><?=__('Expensive Tariff') ?></th>
								<th scope="col" class="actions"><?= __('Status') ?></th>
								 
							</tr>
						</thead>
						<tbody>
							<?php $i=1; foreach ($promotion as $promotion): ?>
							<tr>
								<td><?= $i; ?></td>
								<td><?= h($promotion->user->first_name).h($promotion->user->last_name) ?></td>
								<td><?= h($promotion->user->email) ?></td>
								<td><?= h($promotion->hotel_name) ?></td>
								<td><?= h($promotion->duration) ?></td>
								<td><?= h($promotion->expiry_date) ?></td>
								<td><?= $this->Number->format($promotion->cheap_tariff) ?></td>
								<td><?= $this->Number->format($promotion->expensive_tariff) ?></td>
								<td><?php 
								if($promotion->status==1)
								{
									echo "Activate" ;
								}
								else{
									echo "Deactivate";
								}
								?></td>
								 
							</tr>
								<?php $i++;endforeach; ?>
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
