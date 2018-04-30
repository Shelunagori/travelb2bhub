 
<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<b>Requests</b>
					<div class="box-tools pull-right">
						<a style="font-size:19px;  margin-top: -6px;" class="btn btn-box-tool" data-target="#myModal122" data-toggle="collapse"> <i class="fa fa-filter"></i></a>
					</div>
				</div> 
			 <div class="box-body"> 
			 			<div class="box-body">
			<form method="get" class="loadingshow">
				<div class="collapse"  id="myModal122" aria-expanded="false"> 
				<fieldset style="text-align:left;"><legend>Filter</legend>
					<div class="col-md-12 ">
							<div class="col-md-3">
								<label class="control-label">Reference Id</label>
								<?php echo $this->Form->input('RefID',[
								'label' => false,'class'=>'form-control ','placeholder'=>'Enter Reference Id']);?>
							</div>
							 
							<div class="col-md-3">
								<label class="control-label">Select Status</label>
								<select name="status" class="form-control select2" placeholder="Select...">
									<option value="">Select...</option>
									<option value="1">Open</option>
									<option value="2">Finalized</option>
								</select>
							</div>
							<div class="col-md-3">
								<label class="control-label">Remove Status</label>
								<select name="removed" class="form-control select2" placeholder="Select...">
									<option value="">Select...</option>
									<option value="2">Open</option>
									<option value="1">Removed</option>
								</select>
							</div>
							<div class="col-md-3">
								<label class="control-label">Request Type</label>
								<?php echo $this->Form->input('category',['options' =>$CategoriesList,'label' => false,'class'=>'form-control select2','empty'=> 'Select...']);?>	 
							</div>
							<div class="col-md-12" align="center">
								<hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
								<a href="<?php echo $this->Url->build(array('controller'=>'Requests','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
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
							<th scope="col"><?= __('Reference_id') ?></th>
							<th scope="col"><?= __('Agent Name') ?></th>
							<th scope="col"><?= __('Locality') ?></th>
							<th scope="col"><?= __('Total Budget') ?></th>
							<th scope="col"><?= __('Request Type') ?></th>
							<th scope="col"><?= __('Created At') ?></th>
							<th scope="col"><?= __('Status') ?></th>
							<th scope="col"><?= __('Removed') ?></th>
							<th scope="col"><?= __('City') ?></th>
							<!--<th scope="col"><?= __('State') ?></th>-->								
							<!--<th scope="col"><?= __('Pickup State') ?></th>							
							<th scope="col" class="actions"><?= __('Actions') ?></th>-->
						</tr>
					</thead>
        <tbody>
            <?php $i=1;foreach ($requests as $request):
				$status=$request->status;
				$is_deleted=$request->is_deleted;
				if($status==2){ $showStatus="Finalized";}
				if($status==0){ $showStatus="Open";}
				if($is_deleted==0){ $is_deletedShow="Open";}
				if($is_deleted==1){ $is_deletedShow="Removed";}
				
			?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= h($request->reference_id) ?></td>
                <td><?= h($request->user->first_name.$request->user->last_name) ?></td>
                <td><?= h($request->locality) ?></td>
                <td><?= $this->Number->format($request->total_budget) ?></td>
                <td><?= h($request->category->name) ?></td>
				<td><?= h($request->created) ?></td>
				<td><?php echo $showStatus; ?></td>
				<td><?php echo $is_deletedShow; ?></td>
				<td><?= h($request->city->name) ?></td>
				<!--<td><?= h($request->state->state_name) ?></td>-->
				<!--<td><?= h($request->state->state_name) ?></td>
                <td class="actions">
					<?= $this->Html->link(__('View'), ['action' => 'view', $request->id]) ?>
                </td>-->
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
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
jQuery(".loadingshow").submit(function(){
	jQuery("#loader-1").show();
});
</script>