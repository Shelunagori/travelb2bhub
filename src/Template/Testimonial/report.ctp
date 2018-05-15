<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<b>Review/Rating List</b>
					<div class="box-tools pull-right">
						<a style="font-size:19px;  margin-top: -6px;" class="btn btn-box-tool" data-target="#myModal122" data-toggle="collapse"> <i class="fa fa-filter"></i></a>
					</div>
				</div> 
			<div class="box-body"> 
						 
			<form method="get" class="loadingshow">
			<div class="collapse"  id="myModal122" aria-expanded="false"> 
				<fieldset style="text-align:left;"><legend>Filter</legend>
					<div class="col-md-12 ">
						<div class="row"> 
							<div class="col-md-6">
								<label class="control-label">Select Rating</label>
								<select name="Rateing" class="form-control" placeholder="Select...">
									<option value="">Select...</option>
									<option value="1">&#9733;</option>
									<option value="2">&#9733;&#9733;</option>
									<option value="3">&#9733;&#9733;&#9733;</option>
									<option value="4">&#9733;&#9733;&#9733;&#9733;</option>
									<option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
								</select>	
							</div>
							<div class="col-md-6" align="center">
								<label class="control-label col-md-12">&nbsp;</label> 
								<a href="<?php echo $this->Url->build(array('controller'=>'Testimonial','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
								
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
									<th scope="col"><?= __('Username') ?></th>
									<th scope="col"><?= __('Reviewer') ?></th>
									<th scope="col"><?= __('Review/Rating') ?></th> 
									<th scope="col"><?= __('Comment') ?></th> 
								</tr>
						</thead>
						<tbody>
							<?php $i=1; foreach ($testimonial as $testimonials): ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?= $testimonials->user->first_name.' '.$testimonials->user->last_name ?></td>
								<td><?= $testimonials->author->first_name ?></td> 
								<td style="text-align:center"><?php $rate=$testimonials->rating;
									for($xxs=1;$xxs<=$rate;$xxs++)
									{
											echo " &#9733; ";
									}
									?>
								</td> 
								<td><?php echo $testimonials->comment; ?></td> 
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
</script>