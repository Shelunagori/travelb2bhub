<section class="content">
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<?php if(!empty($id)){ ?>
					   <b>Edit City  </b>
				<?php }else{ ?>
					   <b> Add City </b>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class=" ">	
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
					<span class="help-block"></span>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Select State <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-8">
							<?php 
							foreach($states as $state){
								$selectoption[] = ['value'=>$state->id,'text'=>$state->state_name,'country_id'=>$state->country_id];
							}
							echo $this->Form->input('state_id',['options' =>$selectoption,'label' => false,'class'=>'form-control select2 selectState','empty'=> 'Select...']);?>	
							<label id="state-id-error" class="error" for="state-id"> </label>
						</div>
					</div>
					<input type="hidden" name="country_id" id="country_id">
					<input type="hidden" name="price" value="2000">
					<input type="hidden" name="category" value="3">
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
				<b>View List</b> 
				<div class="box-tools pull-right">
					<a style="font-size:19px;  margin-top: -6px;" class="btn btn-box-tool" data-target="#myModal122" data-toggle="collapse"> <i class="fa fa-filter"></i></a>
				</div> 
			</div> 
			 
			<div class="box-body">
			<form method="get" class="loadingshow">
			<div class="collapse"  id="myModal122" aria-expanded="false"> 
				<fieldset style="text-align:left;"><legend>Filter</legend>
					<div class="col-md-12">
						<div class="row"> 
							<div class="col-md-12">
								<label class="control-label">City</label>
								<?php echo $this->Form->input('cityid',[
								'label' => false,'class'=>'form-control ','placeholder'=>'Enter City Name']);?>
							</div>
							<div class="col-md-12">
								<label class="control-label">Select State</label>
								<?php $selectoption=array();
							foreach($states as $state){
								$selectoption[] = ['value'=>$state->id,'text'=>$state->state_name,'country_id'=>$state->country_id];
							}
							echo $this->Form->input('stateid',['options' =>$selectoption,'label' => false,'class'=>'form-control select2','empty'=> 'Select...']);?>	 
							</div>
							<div class="col-md-12" align="center">
							<hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
								<a href="<?php echo $this->Url->build(array('controller'=>'Cities','action'=>'add')) ?>"class="btn btn-danger btn-sm">Reset</a>
								<?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success','id'=>'submit_member','name'=>'search_report']); ?>
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
									<?php echo $this->Html->link('<i class="fa fa-edit"></i>','/Cities/add/'.$city->id,array('escape'=>false,'class'=>'btn btn-info btn-xs'));?>
									<a class=" btn btn-danger btn-xs" data-target="#deletemodal<?php echo $city->id; ?>" data-toggle=modal><i class="fa fa-trash"></i></a>
									<div id="deletemodal<?php echo $city->id; ?>" class="modal fade" role="dialog">
										<div class="modal-dialog modal-md" >
											<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Cities','action'=>'delete',$city->id)) ?>">
												<div class="modal-content">
												  <div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">
														Are you sure you want to remove this City?
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
									<?php   $this->Form->PostLink('<i class="fa fa-trash"></i>','/Cities/delete/'.$city->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','confirm' => __('Are you sure you want to delete # {0}?', $city->id)));?>
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
	$(document).on('change','.selectState',function(){
		//var selected=$(this,'option:selected').attr('country_id');
		var selected = $('option:selected', this).attr('country_id');
		$('#country_id').val(selected);
	});
	 $("#CityForm").validate({ 
		rules: {
			name: {
				required: true
			},
			state_id: {
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