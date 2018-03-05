<div id="my_final_responses" class="container-fluid">
	<div class="row equal_column">
		<div class="col-md-12" style="background-color:#fff"> 
			<br>
			 
			<?php echo  $this->Flash->render() ?>
		</div>
		<div class="col-md-12" style="background-color:#fff"> 
			<div class="box box-default">
				<div class="box-header with-border"> 
					<h3 class="box-title" style="padding:20px">Event Planner Promotion</h3>
					<div class="box-tools pull-right">
 					</div>
 				</div>
				<div class="box-body">
					<fieldset>
					<legend style="color:#369FA1;"><b> &nbsp; Load Package &nbsp;  </b></legend>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="input-field">
										<p> Company Name </p>
										<input autocomplete="off" type="text" class="form-control" placeholder="Company Name" readonly  value="<?= $users->company_name; ?>"/>
									</div>
								</div>
								 
							</div>
						</div>
					</fieldset>
					<fieldset>
					<legend style="color:#369FA1;"><b> &nbsp; Package Details &nbsp;  </b></legend>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="input-field">
										<p> Company Name </p>
										<input autocomplete="off" type="text" class="form-control" placeholder="Company Name" readonly  value="<?= $users->company_name; ?>"/>
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-field">
										<p> Upload Image of Promotion <span class="required">*</span></p>
										<input autocomplete="off" type="file" class="form-control" name="image" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-field">
										<p> Upload Document </p>
										<input autocomplete="off" type="file" class="form-control" name="document" />
									</div>
								</div>
								
							</div>
						</div>
					</fieldset>
				</div>
			</div>
		</div>
	</div>
</div>
   




<div class="eventPlannerPromotions form large-9 medium-8 columns content">
    <?= $this->Form->create($eventPlannerPromotion) ?>
    <fieldset>
        <legend><?= __('Add Event Planner Promotion') ?></legend>
        <?php
            echo $this->Form->input('country_id');
            echo $this->Form->input('event_detail');
            echo $this->Form->input('image');
            echo $this->Form->input('document');
            echo $this->Form->input('price_master_id', ['options' => $priceMasters]);
            echo $this->Form->input('visible_date');
            echo $this->Form->input('like_count');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('created_on');
            echo $this->Form->input('edited_by');
            echo $this->Form->input('edited_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
