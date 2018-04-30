<section class="content">
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<?php if(!empty($id)){ ?>
					 <b> Edit State </b>
				<?php }else{ ?>
					 <b> Add State </b>
				<?php } ?>
			</div>
			<div class="box-body"> 
				<div class="">
				<?= $this->Form->create($state,['id'=>'StateForm']) ?>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">State Name <span class="required" aria-required="true"> * </span> </label>
						</div>
						<div class="col-md-8">
							<?php echo $this->Form->control('state_name',[
							'label' => false,'class'=>'form-control input-medium ','placeholder'=>'Enter State Name']);?>
						</div>
					</div>
					<span class="help-block"></span>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Select Country <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-8">
							<?php if(!empty($id)){ 
								echo $this->Form->input('country_id',['options' =>$country,'label' => false,'class'=>'form-control select2','empty'=> 'Select...']);
							}else{ 
								echo $this->Form->input('country_id',['options' =>$country,'label' => false,'class'=>'form-control select2','empty'=> 'Select...','value' => '']);
							} ?>
							<label id="country-id-error" class="error" for="country-id"> </label>
						</div>
					</div>
					<span class="help-block"> </span>
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
					<div class="col-md-12">
						<div class="row"> 
							<div class="col-md-12">
								<label class="control-label">State</label>
								<?php echo $this->Form->input('StateId',[
								'label' => false,'class'=>'form-control ','placeholder'=>'Enter State Name']);?>
							</div>
							<div class="col-md-12">
								<label class="control-label">Select Country</label>
								<?php echo $this->Form->input('CountryName',['options' =>$country,'label' => false,'class'=>'form-control select2','empty'=> 'Select...','value' => '']);?>	 
							</div>
							<div class="col-md-12" align="center">
								<hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
								<a href="<?php echo $this->Url->build(array('controller'=>'States','action'=>'add')) ?>"class="btn btn-danger btn-sm">Reset</a>
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
						<tr style="background-color:#DFD9C4;">
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('State ') ?></th>
							<th scope="col"><?= __('Counry') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($states as $state): ?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?= h($state->state_name) ?></td>
							<td><?= h($state->country->country_name) ?></td>
							<td class="actions">
									<?php echo $this->Html->link('<i class="fa fa-edit"></i>','/States/add/'.$state->id,array('escape'=>false,'class'=>'btn btn-warning btn-xs'));?>
									
									<a class=" btn btn-danger btn-xs" data-target="#deletemodal<?php echo $state->id; ?>" data-toggle=modal><i class="fa fa-trash"></i></a>
									<div id="deletemodal<?php echo $state->id; ?>" class="modal fade" role="dialog">
										<div class="modal-dialog modal-md" >
											<form method="post" action="<?php echo $this->Url->build(array('controller'=>'States','action'=>'delete',$state->id)) ?>">
												<div class="modal-content">
												  <div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">
														Are you sure you want to remove this State?
														</h4>
													</div>
													<div class="modal-footer">
 														<button type="submit" class="btn  btn-sm btn-info">Yes</button>
														<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
													</div>
												</div>
											</form>
										</div>
									</div>
									<?php $this->Form->PostLink('<i class="fa fa-trash"></i>','/States/delete/'.$state->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','confirm' => __('Are you sure you want to delete # {0}?', $state->id)));?>
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
jQuery(".loadingshow").submit(function(){
	jQuery("#loader-1").show();
});
$(document).ready(function() {
	
	// validate signup form on keyup and submit
	 $("#StateForm").validate({ 
		rules: {
			state_name: {
				required: true
			},
			country_id: {
				required: true
			} 
		},
		submitHandler: function () {
			$("#submit_member").attr('disabled','disabled');
			$("#loader-1").show();
			form.submit();
		}
	}); 

});
</script>