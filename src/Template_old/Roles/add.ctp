<section class="content">
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<?php if(!empty($id)){ ?>
					 <b> Edit Role </b>
				<?php }else{ ?>
					 <b> Add Role </b>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">	
				<?= $this->Form->create($role,['id'=>'CityForm']) ?>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Role Name <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-8">
							<?php echo $this->Form->input('name',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter City Name']);?>
						</div>
					</div>
					<span class="help-block"></span>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Description </label>
						</div>
						<div class="col-md-8">
							<?php echo $this->Form->input('label',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Description']);?>
						</div>
					</div>
					 <span class="help-block"></span>
					 
					<div class="box-footer">
						<div class="row">
							<center>
								<div class="col-md-12">
									<div class="col-md-offset-3 col-md-6">	
										<?php echo $this->Form->button('Submit',['class'=>'btn btn-primary','id'=>'submit_member']); ?>
									</div>
								</div>
							</center>		
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?= $this->Form->end() ?>
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<b> View List </b>
				<div class="box-tools pull-right">
					<a style="font-size:19px;  margin-top: -6px;" class="btn btn-box-tool" data-target="#myModal122" data-toggle="collapse"> <i class="fa fa-filter"></i></a>
				</div>
			</div> 
			<div class="box-body">
			<form method="get">
				<div class="collapse"  id="myModal122" aria-expanded="false"> 
				<fieldset style="text-align:left;"><legend>Filter</legend>
					<div class="col-md-12 ">
						<div class="row"> 
							<div class="col-md-12">
								<label class="control-label">Role</label>
								<?php echo $this->Form->input('roleWise',[
								'label' => false,'class'=>'form-control ','placeholder'=>'Enter Role Name']);?>
							</div>
							 
							<div class="col-md-12" align="center">
								<label class="control-label col-md-12">&nbsp;</label>
								<?php echo $this->Form->button('Search',['class'=>'btn btn-sm btn-success','id'=>'submit_member','name'=>'search_report']); ?> 
							</div> 
						</div>
					</div>
				</fieldset>
				</div>
			</form>
				<table class="table table-bordered" cellpadding="0" cellspacing="0" id="main_tble">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No') ?></th>
							<th scope="col"><?= $this->Paginator->sort('name') ?></th>
							<th scope="col"><?= $this->Paginator->sort('label') ?></th> 
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($roles as $role): ?>
						<tr>
							<td><?= $this->Number->format($role->id) ?></td>
							<td><?= h($role->name) ?></td>
							<td><?= h($role->label) ?></td> 
 							<td class="actions">
								<?php echo $this->Html->link('<i class="fa fa-edit"></i>','/Roles/add/'.$role->id,array('escape'=>false,'class'=>'btn btn-warning btn-xs'));?>
								
								<?php echo $this->Form->PostLink('<i class="fa fa-trash"></i>','/Roles/delete/'.$role->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','confirm' => __('Are you sure you want to delete # {0}?', $role->id)));?>
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
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
jQuery(".loadingshow").submit(function(){
	jQuery("#loader-1").show();
});
$(document).ready(function() {
	// validate signup form on keyup and submit
	 $("#CityForm").validate({ 
		rules: {
			name: {
				required: true
			} 
		},
		submitHandler: function () {
			$("#submit_member").attr('disabled','disabled');

			form.submit();
		}
	}); 

});
</script>