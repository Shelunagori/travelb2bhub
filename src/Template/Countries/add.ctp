<section class="content">
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
			<?php if(!empty($id)){ ?>
							<i class="fa fa-pencil-square-o"></i> <b> Edit Country </b>
						<?php }else{ ?>
							<i class="fa fa-plus"></i> <b> Add Country </b>
						<?php } ?>
				
			</div>
			<div class="box-body"> 
				<div class="form-group">
				<?= $this->Form->create($country,['id'=>'CityForm']) ?>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Country Code  </label>
						</div>
						<div class="col-md-8">
							<?php echo $this->Form->control('country_cod',[
							'label' => false,'class'=>'form-control input-medium ','placeholder'=>'Enter Country Code']);?>
						</div>
					</div>
					<span class="help-block"></span>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Country Name</label>
						</div>
						<div class="col-md-8">
							<?php 
							echo $this->Form->input('country_name',['label' => false,'class'=>'form-control input-medium ','required'=>'required','Placeholder'=> 'Enter Country Name']);?>	
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
				<i class="fa fa-list"></i> <b> View Country List </b>
			</div> 
			 
		<div class="box-body"> 
    <table class="table" cellpadding="0" cellspacing="0">
        <thead>
            <tr style="background-color:#DFD9C4;">
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_cod') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($countries as $country): ?>
            <tr>
                <td><?= $this->Number->format($country->id) ?></td>
                <td><?= h($country->country_cod) ?></td>
                <td><?= h($country->country_name) ?></td>
                <td class="actions">
				<?php echo $this->Html->link('<i class="fa fa-edit"></i>','/Countries/add/'.$country->id,array('escape'=>false,'class'=>'btn btn-warning btn-xs'));?>
                   <?php echo $this->Form->PostLink('<i class="fa fa-trash"></i>','/Countries/delete/'.$country->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','confirm' => __('Are you sure you want to delete # {0}?', $country->id)));?>
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

$(document).ready(function() {
	// validate signup form on keyup and submit
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
			form.submit();
		}
	}); 

});
</script>