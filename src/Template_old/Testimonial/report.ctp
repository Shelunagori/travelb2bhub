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
<div class="col-md-12" align="right">
	<a style="margin:2px" href="<?php echo $this->Url->build(array('controller'=>'Testimonial','action'=>'excelDownload?Rateing='.$Rateing.'')) ?>" title="Download Excel" class="btn btn-info btn-xs"  ><i class="fa fa-download"></i> Excel</i> </a>
</div>
				<table class="table table-bordered" cellpadding="0" cellspacing="0" id="main_tble">
							<thead>
								<tr style="background-color:#DFD9C4;">
									<th scope="col"><?= __('Sr.No') ?></th>
									<th scope="col"><?= __('User ID') ?></th>
									<th scope="col"><?= __('Username') ?></th>
									<th scope="col"><?= __('Reviewer') ?></th>
									<th scope="col" style="text-align:center"><?= __('Review/Rating') ?></th> 
									<th scope="col"><?= __('Comment') ?></th> 
									<th scope="col"><?= __('Action') ?></th> 
								</tr>
						</thead>
						<tbody>
							<?php $i=1; foreach ($testimonial as $testimonials): ?>
							<tr>
								<td><?php echo $i; ?></td> 
								<td><?= $testimonials->user_id; ?></td>
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
								<td>
									<a style="margin-top:2px" class=" btn btn-info btn-xs" title="Delete User" data-target="#Edit<?php echo $testimonials->id; ?>" data-toggle=modal><i class="fa fa-edit"></i></a>
									<a style="margin-top:2px" class=" btn btn-danger btn-xs" title="Delete User" data-target="#deletemodal<?php echo $testimonials->id; ?>" data-toggle=modal><i class="fa fa-trash"></i></a>
									<div id="Edit<?php echo $testimonials->id; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md" >
			<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Testimonial','action'=>'edit',$testimonials->id)) ?>">
				<div class="modal-content">
					<div class="modal-header">
						<div class="col-md-12">
							<table width="100%" border="0">
								<tr>
									<td><label class="control-label" for="Rating">Rating :</label></td>
									<td>
										<div class="pull-left">
											<input class="star star-5" id="star-5<?php echo $testimonials->id; ?>" type="radio" name="rating" <?php if($rate=="5") {echo "checked";} ?> value="5"/>
											<label class="star star-5" for="star-5<?php echo $testimonials->id; ?>"></label>
											<input class="star star-4" id="star-4<?php echo $testimonials->id; ?>" type="radio" name="rating" <?php if($rate=="4") {echo "checked";} ?> value="4"/>
											<label class="star star-4" for="star-4<?php echo $testimonials->id; ?>"></label>
											<input class="star star-3" id="star-3<?php echo $testimonials->id; ?>" type="radio" name="rating" <?php if($rate=="3") {echo "checked";} ?> value="3"/>
											<label class="star star-3" for="star-3<?php echo $testimonials->id; ?>"></label>
											<input class="star star-2" id="star-2<?php echo $testimonials->id; ?>" type="radio" name="rating" <?php if($rate=="2") {echo "checked";} ?> value="2"/>
											<label class="star star-2" for="star-2<?php echo $testimonials->id; ?>"></label>
											<input class="star star-1" id="star-1<?php echo $testimonials->id; ?>" type="radio" name="rating" <?php if($rate=="1") {echo "checked";} ?> value="1"/>
											<label class="star star-1" for="star-1<?php echo $testimonials->id; ?>"></label>
											<input style="display:none;" type="radio" name="rating" <?php if($rate=="0") {echo "checked";} ?> value="0"/>
										</div>
									</td>
								</tr>
								<tr>
									<td><label class="control-label" for="Comment">Comment :</label></td>
									<td> <textarea name="comment" class="form-control input-large" rows="2"  id="comment"><?php echo $testimonials->comment; ?></textarea> 
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn  btn-sm btn-info">Update</button>
						<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
								</td>
	<div id="deletemodal<?php echo $testimonials->id; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md" >
			<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Testimonial','action'=>'delete',$testimonials->id)) ?>">
				<div class="modal-content">
				  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">
						Are you sure you want to remove this Rating?
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
	
	
							</tr>
							<?php $i++; endforeach; 
 ?>
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