<section class="content">
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
			<?php if(!empty($id)){ ?>
							<i class="fa fa-pencil-square-o"></i> <b> Edit City </b>
						<?php }else{ ?>
							<i class="fa fa-plus"></i> <b> Add City </b>
						<?php } ?>
				
			</div>
			<div class="box-body"> 
				<div class="form-group">	
				<?= $this->Form->create($city,['id'=>'CityForm']) ?>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">City Name <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-8">
							<?php echo $this->Form->input('name',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter City Name']);?>
						</div>
					</div>
					 
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Select State <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-8">
							<?php 
							echo $this->Form->input('state_id',['options' =>$states,'label' => false,'class'=>'form-control select2','empty'=> 'Select...']);?>	
							<label id="state-id-error" class="error" for="state-id"> </label>
						</div>
					</div>
					
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
				<i class="fa fa-list"></i> <b> View List </b>
			</div> 
			 
		<div class="box-body"> 
				<table class="table table-bordered" cellpadding="0" cellspacing="0" id="main_tble">
					<thead>
						<tr style="background-color:#DFD9C4;">
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('City ') ?></th>
							<th scope="col"><?= __('State') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($cities as $city): ?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?= h($city->name) ?></td>
							<td><?= h($city->state->state_name) ?></td>
							<td class="actions">
									<?php echo $this->Html->link('<i class="fa fa-edit"></i>','/Cities/add/'.$city->id,array('escape'=>false,'class'=>'btn btn-warning btn-xs'));?>
									<?php echo $this->Form->PostLink('<i class="fa fa-trash"></i>','/Cities/delete/'.$city->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','confirm' => __('Are you sure you want to delete # {0}?', $city->id)));?>
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
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function() {
	// validate signup form on keyup and submit
	 $("#CityForm").validate({ 
		rules: {
			name: {
				required: true
			},
			state_iddas: {
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