<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content">
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
			<?php if(!empty($id)){ ?>
							 <b> Edit Category </b>
						<?php }else{ ?>
							 <b> Add Category </b>
						<?php } ?>
				
			</div>
			<div class="box-body"> 
				<div class="">
				<?= $this->Form->create($postTravlePackageCategory,['id'=>'CountryForm']) ?>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Category Name</label>
						</div>
						<div class="col-md-8">
							<?php 
							echo $this->Form->input('name',['label' => false,'class'=>'form-control input-medium ','Placeholder'=> 'Enter Category Name']);?>	
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
				<b> View Category List </b>
				<div class="box-tools pull-right">
				<!--	<a style="font-size:19px;  margin-top: -6px;" class="btn btn-box-tool" data-target="#myModal122" data-toggle="collapse"> <i class="fa fa-filter"></i></a>-->
				</div>
			</div> 
		<div class="box-body"> 
		<!--<form method="get" class="loadingshow">
			<div class="collapse"  id="myModal122" aria-expanded="false"> 
			 <fieldset style="text-align:left;"><legend>Filter</button></legend>
				<div class="col-md-12">
					<div class="row"> 
						<div class="col-md-12">
							<label class="control-label">Category name</label>
							<?php //echo $this->Form->input('name',[
							//'label' => false,'class'=>'form-control ','placeholder'=>'Enter Category Name']);?>
						</div>
						<div class="col-md-12" align="center">
							<hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
							<a href="<?php //echo $this->Url->build(array('controller'=>'Countries','action'=>'add')) ?>"class="btn btn-danger btn-sm">Reset</a>
							<label class="control-label col-md-12">&nbsp;</label>
							<?php //	echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success','id'=>'submit_member','name'=>'search_report']); ?> 
						</div> 
					</div>
				</div>
			</div>
			</fieldset>
		</form> -->
			<table class="table table-bordered" cellpadding="0" cellspacing="0">
				<thead>
					<tr style="background-color:#DFD9C4;">
						<th scope="col"><?= ('S.No') ?></th> 
						<th scope="col"><?= ('Category name') ?></th>
						<th scope="col" class="actions"><?= __('Actions') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1;foreach ($postTravlePackageCategoryss as $package_category): ?>
					<tr>
						<td><?php echo $i;?></td> 
						<td><?= h($package_category->name) ?></td>
						<td class="actions">
							<?php echo $this->Html->link('<i class="fa fa-edit"></i>','/PostTravlePackageCategories/add/'.$package_category->id,array('escape'=>false,'class'=>'btn btn-warning btn-xs'));?>
							<a class=" btn btn-danger btn-xs" data-target="#deletemodal<?php echo $package_category->id; ?>" data-toggle=modal><i class="fa fa-trash"></i></a>
									<div id="deletemodal<?php echo $package_category->id; ?>" class="modal fade" role="dialog">
										<div class="modal-dialog modal-md" >
											<form method="post" action="<?php echo $this->Url->build(array('controller'=>'PostTravlePackageCategories','action'=>'delete',$package_category->id)) ?>">
												<div class="modal-content">
												  <div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">
														Are you sure you want to remove this Package Category?
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
						   <?php  $this->Form->PostLink('<i class="fa fa-trash"></i>','/PostTravlePackageCategories/delete/'.$package_category->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','confirm' => __('Are you sure you want to delete # {0}?', $package_category->id)));?>
						</td>
					</tr>
					<?php $i++; endforeach;  ?>
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
	jQuery(".loadingshow").submit(function(){
		jQuery("#loader-1").show();
	});
	// validate signup form on keyup and submit
	$.validator.addMethod("specialChars", function( value, element ) {
		var regex = new RegExp("^[a-zA-Z ]+$");
		var key = value;

		if (!regex.test(key)) {
		   return false;
		}
		return true;
	}, "please use only alphabetic characters");
	 $("#CountryForm").validate({ 
		rules: {
			name: {
				required: true,
				specialChars: true
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