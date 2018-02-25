<div class=container-fluid id="business_buddies_list">
<div class="row equal_column" > 
    <div class="col-md-12" style="background-color:#fff"> 
		<br>
		<?php echo $this->element('subheader');?>
		<?php echo  $this->Flash->render() ?>
	</div>
	<div class="col-md-12" style="background-color:#fff"> 
		<div class="box box-default">
			<div class="box-header with-border"> 
				<h3 class="box-title" style="padding:20px">Promotion Report</h3>
				<div class="box-tools pull-right">
				</div>
			</div>
			<div class="box-body">
				<div class="row">
				  <hr class="hr_bordor">
					<div class="col-md-12 col-md-12 col-sm-12 col-xs-12 margin-b20" >	
					<?php if(count($promotionreport)>0){?>
					<div class="text-center" >
						<table class="table-responsive table-bordered table-striped xyz" >
							<thead class="thead-inverse">
								<tr>
									<th width="2%" class="text-center hidden-xs">Sno.</th>
									<th width="10%" class="text-center">Date of Promotion</th>
									<th width="20%" class="text-center">Hotel Name</th>
									<th width="10%" class="text-center">Duration (Months)</th>
									<th width="50%" class="text-center"> Cities </th>
									<th width="8%" class="text-center"> Views </th>
								</tr>
							</thead>
							<tbody>
							<?php $i=1;
							//print_r($promotionreport);
							 foreach($promotionreport as $pr) {  ?>
									<tr>
										<td class="text-center hidden-xs" valign="top" >
											<?php echo $i; ?>
										</td>
										<td class="text-center" valign="top">
											<?php echo date("d/m/Y", strtotime($pr['created_at'])); ?>
										</td>
										<td class="text-center" valign="top">
											<?php echo $pr['hotel_name']; ?>
										</td> 
										<td class="text-center" valign="top">
											<?php echo $pr['duration']; ?></td><td valign="top" class="text-left" >
											<?php if($pr['cities']!==""){
												$cityarray = explode(',',$pr['cities']);
													foreach($cityarray as $cityid){
														$state_id = $allStates[$allCities1[$cityid]];
														$resultstr[] = $allCities[$cityid].' ('.$state_id.')';
													}
												echo implode(", ",$resultstr);
											}
											$resultstr =''; ?>
										</td>
										<td valign="top" class="text-center" style="color: #1c6f7d !important;">
											<strong><?php echo $pr['count']; ?></strong>
										</td>
									</tr>								
									<?php $i++; } ?>
							</tbody>
						</table>
					</div>
			<?php }else{?>
					<p>To promote your hotel  <a style=" color: #1c6f7d;font-weight: 600;text-decoration: underline;" href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'promotions')) ?>">click here</a></p>
					<?php }?>
					</div>
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->element('footer');?>
