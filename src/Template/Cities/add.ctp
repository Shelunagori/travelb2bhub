<section class="content">

<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
			<?php if(!empty($id)){ ?>
							<i class="fa fa-pencil-square-o"></i> Edit City
						<?php }else{ ?>
							<i class="fa fa-plus"></i> Add City
						<?php } ?>
				
			</div>
			<div class="box-body"> 
				<div class="form-group">
				<?= $this->Form->create($city) ?>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">City Name  </label>
						</div>
						<div class="col-md-8">
							<?php echo $this->Form->control('name',[
							'label' => false,'class'=>'form-control input-medium ','placeholder'=>'Enter City Name']);?>
						</div>
					</div>
					<span class="help-block"></span>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Choose State</label>
						</div>
						<div class="col-md-8">
							<?php 
							echo $this->Form->input('state_id',['options' =>$states,'label' => false,'class'=>'form-control input-sm select2','required'=>'required','empty'=> 'Select...']);?>	
						</div>
					</div>
					<span class="help-block"> </span>
					<div class="box-footer">
					<div class="row">
						<center>
							<div class="col-md-12">
								<div class="col-md-offset-3 col-md-6">	
									<?php echo $this->Form->button('Submit',['class'=>'btn btn-primary']); ?>
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
				City List	 
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
			</div>
		</div>
	</div>
</div>
</section>
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() {

var $rows = $('#main_tble tbody tr');
	$('#search3').on('keyup',function() {
		var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
		var v = $(this).val();
		if(v){ 
			$rows.show().filter(function() {
				var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
	
				return !~text.indexOf(val);
			}).hide();
		}else{
			$rows.show();
		}
	});

});
</script>