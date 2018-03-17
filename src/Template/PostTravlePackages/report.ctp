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
					<h3 class="box-title" style="color:#057F8A "><?= __('PostTravle Package Promotions :') ?></h3>
					<div class="box-tools pull-right">
						<a style="font-size:20px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
						<a style="font-size:22px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
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
								<?php $i=1; 
								foreach ($postTravlePackages as $postTravlePackage): 
									$CategoryList='';
									$x=0;
									foreach($postTravlePackage->post_travle_package_rows as $category)
										{
											
											$CategoryList.=$category->post_travle_package_category->name;
											if($x>1){
												$CategoryList.=' , ';
											}
										$x++;}
								?>
								<tr>
									<td style="width:5%;"><?php echo $i; ?></td>
									<td style="width:15%;" ><?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name.' ('.$postTravlePackage->user_rating.')');?>
									</td>
									<td style="width:15%;"><?= h($postTravlePackage->title) ?></td>
									<td style="width:20%;"><?= h($CategoryList);?></td>
									<td style="width:20%;">
									<?php echo $this->Html->image('../'.$postTravlePackage->image,['style'=>'height:8%;width:100%;']);?></td>
									<td class="actions" style="25%">
										 <span>
										 	<?php echo $this->Form->button('<i class="fa fa-thumbs-up"></i>',['class'=>'btn btn-primary btn-md likes','value'=>'button','style'=>'background-color:#1295A2']); ?>
											<a href="<?php echo $this->Url->build(["controller" => "PostTravlePackages",'action'=>"view",$postTravlePackage->id]); ?>"><?php echo $this->Form->button('<i class="fa fa-eye"></i>',['class'=>'btn btn-warning btn-md','value'=>'button']); ?></a>
											<?php echo $this->Form->button('<i class="fa fa-flag"></i>',['class'=>'btn btn-info btn-md','value'=>'button']); ?>
											<?php echo $this->Form->button('<i class="fa fa-bookmark"></i>',['class'=>'btn btn-success btn-md','value'=>'button']); ?>
											 <?php //echo $this->Html->link('Likes','#'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn btn-primary btn-xs'));?>
											<?php //echo $this->Html->link('Details','/PostTravlePackages/view/'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn btn-warning btn-xs'));?>
											<?php //echo $this->Html->link('Follow','#'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn btn-success btn-xs'));?>
											<?php //echo $this->Html->link('Delete','#'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackage->id)));?>
										</span>
									</td>
								</tr>
								<?php $i++;endforeach; ?>
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
