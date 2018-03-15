<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/PostTravlePackages/getTravelPackages.json?isLikedUserId=".$user_id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 4f8087cd-6560-4ca6-5539-9499d3c5b967"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$priceMasters=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$List=json_decode($response);
	//pr($List); exit;
	$postTravlePackages=$List->getTravelPackages;
}
//pr($List); exit;
?>
<div id="my_final_responses" class="container-fluid">
	<div class="row equal_column">
		<div class="col-md-12" style="background-color:#fff"> 
			<br>
			<?php echo  $this->Flash->render() ?>
		</div>
		<div class="col-md-12" style="background-color:#fff"> 
			<div class="box box-default">
				<div class="box-header with-border"> 
					<h3 class="box-title" ><?= __('Post Travle Packages') ?></h3>
					<div class="box-tools pull-right">
 					</div>
 				</div>
				<div class="box-body">
						<table class="table" cellpadding="0" cellspacing="0">
							<thead>
								<tr style="background-color:#709090;color:white;">
									<th scope="col"><?= ('Sr.No') ?></th>
									<th scope="col"><?= ('Seller Name') ?></th>
									<th scope="col"><?= ('Title') ?></th>
									<th scope="col"><?= ('Category') ?></th>
									<th scope="col"><?= ('Image') ?></th>
									<th scope="col" class="actions"><?= __('Actions') ?></th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach ($postTravlePackages as $postTravlePackage): 
									$CategoryList='';
									foreach($postTravlePackage->post_travle_package_rows as $category)
										{
											$x=0;
											$CategoryList.=$category->post_travle_package_category->name;
											if($x>1){
												$CategoryList.=', ';
											}
										}
								?>
								<tr>
									<td><?= $i; ?></td>
									<td><?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name);?>
									</td>
									<td><?= h($postTravlePackage->title) ?></td>
									<td><?= h($CategoryList);?></td>
									<td><?= h($postTravlePackage->image); ?></td>
									<td class="actions" >
										<?= $this->Html->link(__('View'), ['action' => 'view', $postTravlePackage->id]) ?>
										<?= $this->Html->link(__('Edit'), ['action' => 'edit', $postTravlePackage->id]) ?>
										<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $postTravlePackage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackage->id)]) ?> 
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
							<!--<div class="paginator">
								<ul class="pagination">
									<?= $this->Paginator->first('<< ' . __('first')) ?>
									<?= $this->Paginator->prev('< ' . __('previous')) ?>
									<?= $this->Paginator->numbers() ?>
									<?= $this->Paginator->next(__('next') . ' >') ?>
									<?= $this->Paginator->last(__('last') . ' >>') ?>
								</ul>
								<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
							</div>-->
						</div>
					</div>
				</div>
			</div>
		</div>
