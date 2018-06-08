
<?php  
echo $this->Html->script('/assets/scroll/jquery/jquery-1.10.2.min.js'); 
$counter=$this->Paginator->counter(); 
$counterArray=explode(' ',$counter);
$lastPage=$counterArray[2];
?> 
<script>
	$(function () {  
		$('#fixed_hdr1').fxdHdrCol({
			fixedCols: 3,
			width:     '100%',
			height:    400,
			colModal: [
			   { width: 145, align: 'center' },
			   { width: 50, align: 'center' },
			   { width: 200, align: 'left' },
			   { width: 250, align: 'left' },
			   { width: 80, align: 'left' },
			   { width: 150, align: 'left' },
			   { width: 100, align: 'left' },
			   { width: 200, align: 'center' },
			   { width: 150, align: 'left' },
			   { width: 150, align: 'left' },
			   { width: 80, align: 'left' },
			   { width: 100, align: 'left' },
			   { width: 100, align: 'left' },
			   { width: 250, align: 'center' },
			   { width: 100, align: 'left' },
			   { width: 100, align: 'left' }
			]					
		});	
	});
</script>
<style>
.col-md-3{
	margin-top:5px;
}
</style>
<style>
	.dwrapper #fixed_hdr1 { width: 1500px; }
	#fixed_hdr1 th { font-weight: bold; }
	#fixed_hdr1 th, td { border-width: 1px; border-style: solid; padding: 2px 4px; }

	.dwrapper { padding: 2px; overflow: hidden; vertical-align: top; }
	.dwrapper div.tblWrapper { height: 300px; overflow: auto; margin-top: 10px;}
	.dwrapper div.ft_container { width: 100%; margin-top: 10px; }		

	body { line-height: 1.5em; }
.modal-backdrop.in {
      opacity: 0 !important;  
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
								<select class="form-control select2" multiple='multiple' data-placeholder="Select..." name="role_id[]">
								   <option value="1">Travel Agent</option>
								   <option value="2">Event Planner</option>
								   <option value="3">Hotelier</option>
								</select>
							</div>
							
							<div class="col-md-3">
								<label class="control-label">City</label>
								<select class="form-control select2" multiple="multiple" name="city_id[]" data-placeholder="Select...">
								   <option value="">Select</option>
								   <?php foreach($allCities1 as $city){?>
								   <option value="<?php echo $city['value'];?>"><?php echo $city['label'];?></option>
								   <?php }?>
								</select>
							</div>
							<div class="col-md-3">
								<label class="control-label">State of Operation</label>
								<select class="form-control select2" name="state_id" data-placeholder="Select...">
									<option value="">Select</option>
								   <?php foreach($allState as $citya){?>
								   <option value="<?php echo $citya['value'];?>"><?php echo $citya['state_name'];?></option>
								   <?php }?>
								</select>
							</div>
							<div class="col-md-3">
								<label class="control-label">Country</label>
								 <?php echo $this->Form->control('country', ["type"=>"select",'options' =>$countries, "class"=>"form-control select2",'multiple'=>true,"data-placeholder"=>"Select Options ",'empty'=>'Select Options']);?>
							</div>

						<div class="col-md-12"><hr></hr></div>
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
								<label class="control-label">Records</label>
								<?php echo $this->Form->input('limit_data',[
								'label' => false,'class'=>'form-control ','placeholder'=>'Enter record limit']);?>
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
				<a style="margin:2px" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'excelDownload?first_name='.$first_name.'&last_name='.$last_name.'&email='.$email.'&role_id='.$role_id.'&city_id='.$city_id.'&state_id='.$state_id.'&statusWise='.$statusWise.'&blocked='.$blocked.'&mobile='.$mobile.'&lastlogin='.$lastlogin.'&country='.$country.'')) ?>" title="Download Excel" class="btn btn-info btn-xs"  ><i class="fa fa-download"></i> Excel</i> </a>
			</div>
				<div class="dwrapper">
					<table id="fixed_hdr1">
						<thead>
							<tr>
								<th style="width:147px !important;"><?= ('Action') ?></th> 
								<th style="width:147px !important;"><?= ('S. No.') ?></th> 
								<th style="width:147px !important;"><?= ('Name') ?></th>
								<th style="width:147px !important;"><?= ('email') ?></th>
								<th style="width:147px !important;"><?= ('Mobile') ?></th>
								<th style="width:147px !important;"><?= ('Company Name') ?></th>
								<th style="width:147px !important;"><?= ('Category') ?></th> 
								<th style="width:147px !important;"><?= ('Address') ?></th> 
								<th style="width:147px !important;"><?= ('Locality') ?></th> 
								<th style="width:147px !important;"><?= ('City') ?></th> 
								<th style="width:147px !important;"><?= ('Pincode') ?></th> 
								<th style="width:147px !important;"><?= ('State') ?></th> 
								<th style="width:147px !important;"><?= ('Country') ?></th> 
								<th style="width:147px !important;"><?= ('State of Operation') ?></th> 
								<th style="width:147px !important;"><?= ('Created On') ?></th> 
								<th style="width:147px !important;"><?= ('Last Login') ?></th>
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
								<td style="width:147px !important;">
								<a style="margin-top:2px" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'adminviewprofile/'.$user->id)) ?>" title="View Details" class="btn btn-success btn-xs"  ><i class="fa fa-book"></i></i> </a>
						 
								<?php  echo $this->Html->link('<i class="fa fa-edit"></i>','/Users/adminprofileedit/'.$user->id,array('escape'=>false,'class'=>'btn btn-info btn-xs','title'=>'Edit User','style'=>'margin-top:2px'));?> 
						
								<a style="margin-top:2px" class=" btn btn-danger btn-xs" title="Delete User" data-target="#deletemodal<?php echo $user->id; ?>" data-toggle=modal><i class="fa fa-trash"></i></a>
		
						<?php if($blocked==0){?>
										<a style="margin-top:2px" class=" btn btn-successto btn-xs" title="Block User" data-target="#Block<?php echo $user->id; ?>" data-toggle=modal><i class="fa fa-gavel"></i></a>

						<?php } ?>
						<?php if($blocked==1){?>
								<a style="margin-top:2px" class=" btn btn-successto btn-xs" title="Unblock User" data-target="#unvBlock<?php echo $user->id; ?>" data-toggle=modal><i class="fa fa-gavel"></i></a>
	
						<?php } ?>
						
								<?php  $this->Form->PostLink('<i class="fa fa-trash"></i>','/Users/delete/'.$user->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','title'=>'Delete','confirm' => __('Are you sure you want to delete # {0}?', $user->id)));?>
								</td>
								<td style="width:50px !important;"><?= $x; ?></td> 
								<td style="width:200px !important;"><?= h($user->first_name.' '.$user->last_name) ?></td>
								<td style="width:250px !important;"><?= h($user->email) ?></td>
								<td style="width:80px !important;"><?= h($user->mobile_number) ?></td> 
								<td style="width:150px !important;"><?= h($user->company_name) ?></td> 
								<td style="width:100px !important;"><?php echo $roleShow; ?></td>
								<td style="width:200px !important;"><?php echo $user->address; ?></td>
								<td style="width:150px !important;"> <?php echo $user->locality; ?></td>
								<td style="width:150px !important;"><?= h($user->city->name) ?></td> 
								<td style="width:80px !important;"><?= h($user->pincode) ?></td> 
								<td style="width:100px !important;"><?= h($user->state->state_name) ?></td> 
								<td style="width:100px !important;"><?= h($user->country->country_name) ?></td> 
								<td style="width:250px !important;"><?= h($stateofoperation) ?></td> 
								<td style="width:100px !important;"><?= h(date('d-m-Y',strtotime($user->create_at))) ?></td> 
								<td style="width:100px !important;"><?php if($user->last_login=='0000-00-00 00:00:00' || empty($user->last_login)){ echo "NL";} else { echo date('d-m-Y',strtotime($user->last_login)); } ?></td> 
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>

					<div class="paginator">
						<ul class="pagination">
							 
							<?= $this->Paginator->prev('< ' . __('previous')) ?>
							<?= $this->Paginator->numbers() ?>
							<?= $this->Paginator->next(__('next') . ' >') ?>
							<!--<li><a href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'report?page='.$lastPage))?> " > Last</a></li>-->				 
						</ul>
						<p><?= $this->Paginator->counter() ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<?php  foreach ($users as $user):  ?>
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
<?php endforeach; ?>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
jQuery(".loadingshow").submit(function(){
	jQuery("#loader-1").show();
});
</script>