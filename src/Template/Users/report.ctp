<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-list"></i> <b>User List</b>
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
							<tr>
								<th><?= $this->Paginator->sort('id') ?></th> 
								<th><?= ('Name') ?></th>
								<th><?= $this->Paginator->sort('email') ?></th>
								<th><?= ('Mobile') ?></th>
								<th><?= ('Role') ?></th> 
								<th><?= ('City') ?></th> 
								<th><?= ('State') ?></th> 
								<th class="actions"><?= __('Actions') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php $x=0; foreach ($users as $user): $x++;
							$role_id=$user->role_id;
							if($role_id==1){ $roleShow="Travel Agent";}
							if($role_id==2){ $roleShow="Event Planner";}
							if($role_id==3){ $roleShow="Hotelier";}
							?>
							<tr>
								<td><?= $x; ?></td> 
								<td><?= h($user->first_name.' '.$user->last_name) ?></td>
								<td><?= h($user->email) ?></td>
								<td><?= h($user->mobile_number) ?></td> 
								<td><?php echo $roleShow; ?></td> 
								<td><?= h($user->city->name) ?></td> 
								<td><?= h($user->state->state_name) ?></td> 
								<td class="actions">
									 

<!-- The Modal Start-->
<i type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_<?= $user->id ?>">view</i>
<!-- Modal -->
<div id="myModal_<?= $user->id ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <?php
		$role_id=$user->role_id;
		if($role_id==1){ $roleShow="Travel Agent";}
		if($role_id==2){ $roleShow="Event Planner";}
		if($role_id==3){ $roleShow="Hotelier";}
		?>
			<div class="col-md-12">
				<div class="col-md-6">
					Category : <?= $roleShow ?>
				</div>
				<div class="col-md-6">
					Company : <?= $user->company_name ?>
				</div>
				
			</div>
			<br>
			<br>
			<div class="col-md-12">
				<div class="col-md-6">
					First Name : <?= $user->first_name ?>
				</div>
				<div class="col-md-6">
					Last Name : <?= $user->last_name ?>
				</div>
				
			</div>
			<br>
			<br>
			<div class="col-md-12">
				<div class="col-md-6">
					Mobile Number : <?= $user->mobile_number ?>
				</div>
				<div class="col-md-6">
					Email Id : <?= $user->email ?>
				</div>
			</div>
			<br>
			<br>
			<div class="col-md-12">
				<div class="col-md-6">
					Address : <?= $user->address ?>
				</div>
				<div class="col-md-6">
					City : <?= $user->city->name ?>
				</div>
			</div>
			<br>
			<br>
			<div class="col-md-12">
				<div class="col-md-6">
					State : <?= $user->state->state_name ?>
				</div>
				<div class="col-md-6">
					Country : 
				</div>
			</div>
			<br> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
									
									<!-- The Modal End-->
									
									
									<?php echo $this->Html->link('<i class="fa fa-edit"></i>','/Users/add/'.$user->id,array('escape'=>false,'class'=>'btn btn-warning btn-xs')); ?>
									<?php echo $this->Form->PostLink('<i class="fa fa-trash"></i>','/Users/delete/'.$user->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','confirm' => __('Are you sure you want to delete # {0}?', $user->id)));?>
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
			</div>
		</div>
	</div>
</section>