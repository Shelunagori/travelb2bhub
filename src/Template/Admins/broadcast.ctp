<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<?php if(!empty($id)){ ?>
					<i class="fa fa-pencil-square-o"></i> <b> BroadCast Message </b>
				<?php }else{ ?>
					<i class="fa fa-plus"></i> <b> Add Message </b>
				<?php } ?>
			</div>
			<div class="box-body"> 
				<div class="form-group">
				<?= $this->Form->create($admin,['id'=>'CityForm']) ?>
					<div class="row">
						<div class="col-md-12">
							<?php echo $this->Form->textarea('first_name',[
							'label' => false,'class'=>'form-control input-small ','placeholder'=>'Enter Message Here','rows'=>'5','cols'=>'50']);?>
						</div>
					</div>
					</div>
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
</section>