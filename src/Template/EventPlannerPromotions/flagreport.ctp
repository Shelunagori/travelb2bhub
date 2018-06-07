<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<b>Event Report List</b>
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
							<div class="col-md-4">
								<label class="control-label">Select Reason</label>
								<?php echo $this->Form->input('report_reason_id', ['options' => $report_reason,'class'=>'form-control select2 cntry','label'=>false,'empty'=>'Select...','data-placeholder'=>"Select Reason"]) ?>
							</div>
							<div class="col-md-4">
							<label class="control-label">From</label>
							<?php echo $this->Form->input('start_date',['class'=>'form-control datepickers date ','label'=>false,'data-date-format'=>'dd-mm-yyyy','placeholder'=>'Select Start Date']);?>
							</div>
							<div class="col-md-4">
							<label class="control-label">To</label>
							<?php echo $this->Form->input('end_date',['class'=>'form-control datepickers date ','label'=>false,'data-date-format'=>'dd-mm-yyyy','placeholder'=>'Select End Date']);?>
							</div>
						</div>
						<div class="row"> 
							<div class="col-md-12" align="center">
								<label class="control-label col-md-12">&nbsp;</label> 
								<a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'flagreport')) ?>"class="btn btn-danger btn-sm">Reset</a>
								
								<?php echo $this->Form->button('Search',['class'=>'btn btn-sm btn-success','id'=>'submit_member','name'=>'Search']); ?> 
							</div> 
						</div>
					</div>
				</fieldset>
			</div>
			</form>
<!--<div class="col-md-12" align="right">
	<a style="margin:2px" href="<?php //echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'excelDownload?Rateing='.$Rateing.'')) ?>" title="Download Excel" class="btn btn-info btn-xs"  ><i class="fa fa-download"></i> Excel</i> </a>
</div>-->

				<table class="table table-bordered" cellpadding="0" cellspacing="0" id="main_tble">
							<thead>
								<tr style="background-color:#DFD9C4;">
									<th scope="col"><?= __('Sr.No') ?></th>
									<th scope="col"><?= __('Promotion Title') ?></th>
									<th scope="col"><?= __('Posted By') ?></th>
									<th scope="col"><?= __('Reason') ?></th>
									<th scope="col"><?= __('Comment') ?></th> 
									<th scope="col"><?= __('Reviewer') ?></th>
									<th scope="col"><?= __('Reported On') ?></th> 
								</tr>
						</thead>
						<tbody>
							<?php $i=1; foreach ($eventPlannerPromotion as $eventPlannerPromotionreport): 
							
							//pr($texifleetpromotion->toArray());exit;?>
							<tr>
								<td><?php echo $i; ?></td> 
								<td>
								<?php $hrefurl =  $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'adminedit',$eventPlannerPromotionreport->event_planner_promotion_id),1);?>
								<a href="<?php echo $hrefurl ;?>"><?= $eventPlannerPromotionreport->event_planner_promotion->user->company_name; ?></a></td>
								<td>
								<?php $hrefurl1 =  $this->Url->build(array('controller'=>'Users','action'=>'adminviewprofile',$eventPlannerPromotionreport->event_planner_promotion->user_id),1);?>
								<a href="<?php echo $hrefurl1 ;?>"><?= $eventPlannerPromotionreport->event_planner_promotion->user->first_name.' '.$eventPlannerPromotionreport->event_planner_promotion->user->last_name ?></a></td>
								<td><?= $eventPlannerPromotionreport->report_reason->reason; ?></td>
								<td><?= $eventPlannerPromotionreport->comment; ?></td>
								<td>
								<?php $hrefurl1 =  $this->Url->build(array('controller'=>'Users','action'=>'adminviewprofile',$eventPlannerPromotionreport->user_id),1);?>
								<a href="<?php echo $hrefurl1 ;?>"><?= $eventPlannerPromotionreport->user->first_name.' '.$eventPlannerPromotionreport->user->last_name ?></a></td>
								<td><?php 
								$date=date('d-m-Y',strtotime($eventPlannerPromotionreport->created_on));
								echo $date; ?></td>
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
jQuery(".loadingshow").submit(function(){
	jQuery("#loader-1").show();
});
</script>