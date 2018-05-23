<style>
.col-md-3{
	margin-top:5px;
}
</style>

<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					 <b>User List</b>
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
							<div class="col-md-3">
								<label class="control-label">First Name</label>
								<?php echo $this->Form->input('first_name',[
								'label' => false,'class'=>'form-control ','placeholder'=>'Enter First Name']);?>
							</div>
							<div class="col-md-3">
								<label class="control-label">Last Name</label>
								<?php echo $this->Form->input('last_name',[
								'label' => false,'class'=>'form-control ','placeholder'=>'Enter Last Name']);?>
							</div>
							<div class="col-md-3">
								<label class="control-label">Email-Id</label>
								<?php echo $this->Form->input('email',[
								'label' => false,'class'=>'form-control ','placeholder'=>'Enter email address']);?>
							</div>
							
							<div class="col-md-3">
								<label class="control-label">Mobile No.</label>
								<?php echo $this->Form->input('mobile',[
								'label' => false,'class'=>'form-control ','placeholder'=>'Enter mobile number']);?>
							</div>
							<div class="col-md-3">
								<label class="control-label">Category</label>
								<select class="form-control select2"  name="role_id">
								   <option value="">Select...</option>
								   <option value="1">Travel Agent</option>
								   <option value="2">Event Planner</option>
								   <option value="3">Hotelier</option>
								</select>
							</div>
							<div class="col-md-3">
								<label class="control-label">Last Login</label>
								<select class="form-control select2"  name="lastlogin">
								   <option value="">Select...</option>
								   <option value="<?php echo date('Y-m-d', strtotime("-7 day"));?>">7 days</option>
								   <option value="<?php echo date('Y-m-d', strtotime("-15 day"));?>">15 Days</option>
								   <option value="<?php echo date('Y-m-d', strtotime("-30 day"));?>">30 Days</option> 
								</select>
							</div>
							<div class="col-md-3">
								<label class="control-label">City</label>
								<select class="form-control select2"  name="city_id">
								   <option value="">Select</option>
								   <?php foreach($allCities1 as $city){?>
								   <option value="<?php echo $city['value'];?>"><?php echo $city['label'];?></option>
								   <?php }?>
								</select>
							</div>
							<div class="col-md-3">
								<label class="control-label">State of Operation</label>
								<select class="form-control select2"  name="state_id">
								   <option value="">Select</option>
								   <?php foreach($allState as $citya){?>
								   <option value="<?php echo $citya['value'];?>"><?php echo $citya['state_name'];?></option>
								   <?php }?>
								</select>
							</div>
							
							<div class="col-md-3">
								<label class="control-label">Select </label>
								<div class="form-group">
									<div class="radio">
										<label><input type="radio" name="statusWise" value="1">Activate</label>
										<label><input type="radio" name="statusWise" value="2">Deactivate</label>
									</div>
								</div>	 
							</div>
							<div class="col-md-3">
								<label class="control-label">Select </label>
								<div class="form-group">
									<div class="radio">
										<label><input type="radio" name="blocked" value="1">Blocked</label>
										<label><input type="radio" name="blocked" value="2">Unblocked</label>
									</div>
								</div>	 
							</div>
							<div class="col-md-12" align="center">
								<a href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
								<?php echo $this->Form->button('Search',['class'=>'btn btn-sm btn-success','id'=>'submit_member','name'=>'search_report']); ?> 
							</div> 
						</div>
					</div>
				</fieldset>
				</div>
			</form>
			<div class="col-md-12" align="right">
				<a style="margin:2px" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'excelDownload?first_name='.$first_name.'&last_name='.$last_name.'&email='.$email.'&role_id='.$role_id.'&city_id='.$city_id.'&state_id='.$state_id.'&statusWise='.$statusWise.'&blocked='.$blocked.'&mobile='.$mobile.'&lastlogin='.$lastlogin.'')) ?>" title="Download Excel" class="btn btn-info btn-xs"  ><i class="fa fa-download"></i> Excel</i> </a>
			</div>
			 
					<table class="table table-bordered" cellpadding="0" cellspacing="0" id="main_tble">
						<thead>
							<tr>
								<th><?= $this->Paginator->sort('id') ?></th> 
								<th><?= ('Name') ?></th>
								<th><?= $this->Paginator->sort('email') ?></th>
								<th><?= ('Mobile') ?></th>
								<th><?= ('Company Name') ?></th>
								<th><?= ('Category') ?></th> 
								<th><?= ('City') ?></th> 
								<th><?= ('State') ?></th> 
								<th><?= ('State of Operation') ?></th> 
								<th width="12%" class="actions"><?= __('Actions') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php $x=0; foreach ($users as $user): $x++;
							$role_id=$user->role_id;
							$blocked=$user->blocked;
							if($role_id==1){ $roleShow="Travel Agent";}
							if($role_id==2){ $roleShow="Event Planner";}
							if($role_id==3){ $roleShow="Hotelier";}
							$rowcolor='';
							if($blocked==1){ $rowcolor="#f5d8d8";}
							$selectedPreferenceStates = "";
							$state_name=array();
							if(!empty($user['preference'])) 
							{
								$selectedPreferenceStates = explode(",", $user['preference']);
								
								foreach($selectedPreferenceStates as $operated)
								{
									$state_name[]=$allStates[$operated];
								}
							}
							$stateofoperation='';
							if(!empty($state_name)){$stateofoperation=implode(', ',$state_name);}
							?>
							<tr style="background-color:<?php echo $rowcolor; ?>">
								<td><?= $x; ?></td> 
								<td><?= h($user->first_name.' '.$user->last_name) ?></td>
								<td><?= h($user->email) ?></td>
								<td><?= h($user->mobile_number) ?></td> 
								<td><?= h($user->company_name) ?></td> 
								<td><?php echo $roleShow; ?></td> 
								<td><?= h($user->city->name) ?></td> 
								<td><?= h($user->state->state_name) ?></td> 
								<td><?= h($stateofoperation) ?></td> 
								<td class="actions">
									 

						<a style="margin-top:2px" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'adminviewprofile/'.$user->id)) ?>" title="View Details" class="btn btn-success btn-xs"  ><i class="fa fa-book"></i></i> </a>
						 
						<?php  echo $this->Html->link('<i class="fa fa-edit"></i>','/Users/adminprofileedit/'.$user->id,array('escape'=>false,'class'=>'btn btn-info btn-xs','title'=>'Edit User','style'=>'margin-top:2px'));?> 
						
						<a style="margin-top:2px" class=" btn btn-danger btn-xs" title="Delete User" data-target="#deletemodal<?php echo $user->id; ?>" data-toggle=modal><i class="fa fa-trash"></i></a>
						<div id="deletemodal<?php echo $user->id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'delete',$user->id)) ?>">
									<div class="modal-content">
									  <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">
											Are you sure you want to remove this User?
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
						<?php if($blocked==0){?>
						<a style="margin-top:2px" class=" btn btn-successto btn-xs" title="Block User" data-target="#Block<?php echo $user->id; ?>" data-toggle=modal><i class="fa fa-gavel"></i></a>
						<div id="Block<?php echo $user->id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'adminBlockUser',$user->id)) ?>">
									<div class="modal-content">
									  <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">
											Are you sure you want to Block this User?
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
						<?php } ?>
						<?php if($blocked==1){?>
						<a style="margin-top:2px" class=" btn btn-successto btn-xs" title="Unblock User" data-target="#unvBlock<?php echo $user->id; ?>" data-toggle=modal><i class="fa fa-gavel"></i></a>
						<div id="unvBlock<?php echo $user->id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'adminUnBlockUser',$user->id)) ?>">
									<div class="modal-content">
									  <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">
											Are you sure you want to unblock this User?
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
						<?php } ?>
						
						<?php  $this->Form->PostLink('<i class="fa fa-trash"></i>','/Users/delete/'.$user->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','title'=>'Delete','confirm' => __('Are you sure you want to delete # {0}?', $user->id)));?>
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
</script>