<style>
h1,h2,h3,h4,h5,h6{
	font-family: 'Raleway', sans-serif !important;
}
li { list-style: none;}
.review-block .block-text {
    background-color: #eee;
    padding: 10px 15px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}
.carousel-inner {
    position: relative;
    width: 100%;
    overflow: hidden;
}
.carousel {
    position: relative;
}
.review-block .block-text p {
    margin: 0;
    min-height: 120px; 
    height: 120px;
    z-index: 30;
}
hr { margin-top:0px!important;}
.bg-red{
	background-color:#F3565D!important
}
.bg-blue{
	background-color:#1295A2!important;
}
.bg-green{
	background-color:#56BC87!important;
}
.bg-yellow{
	background-color:#DFBA49!important;
}
.bg-white
{
	padding-top: 30px !important;
}
.arroysign
{
	margin: 17px;
	right: 23px !important;
    width: 3% !important;
    top: 40%;
    bottom: 52%;
}
.rating i {
	color:#1295A2 !important;
}

</style>
<br>
<?php 
$lastword=  substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1);
	//if($lastword=="dashboard"  ) {
		?>
		<div class="portalmobile">
		<div class="portalmobile">
			<div class="row">
			<?php
			if($users['role_id'] == 1 || $users['role_id'] == 2)
			{
				?>
				<div class="col-md-3" >
				<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'sendrequest')) ?>">
					<li class="col-lg-12 col-xs-12 tile   tile-1 slideTextUp">
					  <!-- small box -->
					  <div class="small-box bg-red">
						<div class="inner">
							<table width="100%" border="0" height="90px">
								<tr>
									<td rowspan="2" width="40%">&nbsp;	<br>
										<?php echo $this->Html->image('white-place-request-icon.png',array('style'=>'height:40px;width:50px')); ?>
									</td>
									<td  align="left" style="padding-top:20px; font-size:20px">
										<?php echo $PlaceReqCount; ?>
									</td>
								</tr>
								<tr>
									<td align="left" style="font-size:15px">Place Request</td>
								</tr>
							</table>		
							 
						</div>
					  </div>
					  <div class="small-box bg-white">
						  <span>Click here to fill your Requirement for Travel Package, Hotel or Transportation. </span> 
 					  </div>
					</li>
				</a>
				</div>
				<!-- ./col -->
				<div class="col-md-3" >
				<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>">
					<li class="col-lg-12 col-xs-12 tile   tile-1 slideTextUp">
					  <!-- small box -->
					  <div class="small-box bg-yellow">
						<div class="inner">
							<table width="100%" border="0" height="90px">
								<tr>
									<td rowspan="2" width="40%">&nbsp;	<br>
										<?php echo $this->Html->image('white-my-request-icon.png',array('style'=>'height:40px;width:50px')); ?>
									</td>
									<td  align="left" style="padding-top:20px; font-size:20px">
										<?php echo $myRequestCountNew; ?>
									</td>
								</tr>
								<tr>
									<td align="left" style="font-size:15px">My Requests</td>
								</tr>
							</table>		
						</div>
					  </div>
					  <div class="small-box bg-white">
						<span> Click here to view the list of all currently Open requests placed by you. <span> 
 					  </div>
					</li>
				</a>
				</div>
			<?php 
			} 
			if($users['role_id'] == 1 || $users['role_id'] == 3) { 
			?>
				<!-- COls -->
				<div class="col-md-3" >
				<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>">
					<li class="col-lg-12 col-xs-12 tile   tile-1 slideTextUp">
					  <!-- small box -->
					  <div class="small-box bg-green">
						<div class="inner">
							<table width="100%" border="0" height="90px">
								<tr>
									<td rowspan="2" width="40%">&nbsp;	<br>
										<?php echo $this->Html->image('white-back-icon.png',array('style'=>'height:40px;width:50px')); ?>
									</td>
									<td  align="left" style="padding-top:20px; font-size:20px">
										<?php echo $respondToRequestCountNew; ?>
									</td>
								</tr>
								<tr>
									<td align="left" style="font-size:15px">Respond to Requests</td>
								</tr>
							</table>		
							 
						</div>
					  </div>
					  <div class="small-box bg-white">
						<span> Click here to view, And Respond to Requirements placed by other users. <span> 
 					  </div>
					</li>
				</a>
				</div>
				<!---COls--->
				<div class="col-md-3" >
				<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'myresponselist')) ?>">
					<li class="col-lg-12 col-xs-12 tile   tile-1 slideTextUp">
					  <!-- small box -->
					  <div class="small-box bg-blue">
						<div class="inner">
							<table width="100%" border="0" height="90px">
								<tr>
									<td rowspan="2" width="40%">&nbsp;	<br>
										<?php echo $this->Html->image('white-my-resposes-head.png',array('style'=>'height:40px;width:50px')); ?>
									</td>
									<td  align="left" style="padding-top:20px; font-size:20px">
										<?php echo $myReponseCountNew; ?>
									</td>
								</tr>
								<tr>
									<td align="left" style="font-size:15px">My Responses</td>
								</tr>
							</table>		
							 
						</div>
					  </div>
					  <div class="small-box bg-white">
						<span> Click here to view all currently open Requests, You have Respoded to. <span> 
 					  </div>
					</li>
				</a>
				</div>
		<?php }
		
		if($users['role_id'] == 2 ) { 
			?>
		
				<!-- COls -->
				<div class="col-md-3" >
				<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'finalized-request-list')) ?>">
					<li class="col-lg-12 col-xs-12 tile   tile-1 slideTextUp">
					  <!-- small box -->
					  <div class="small-box bg-green">
						<div class="inner">
							<table width="100%" border="0" height="90px">
								<tr>
									<td rowspan="2" width="40%">&nbsp;	<br>
										<i style='font-size:46px' class="fa fa-check-square"></i>
									</td>
									<td  align="left" style="padding-top:20px; font-size:20px">
										<?php echo $finalizeRequestNew; ?>
									</td>
								</tr>
								<tr>
									<td align="left" style="font-size:15px">Finalized Requests</td>
								</tr>
							</table>		
							 
						</div>
					  </div>
					  <div class="small-box bg-white">
						<span> Click here to view, And Respond to Requirements placed by other users. <span> 
 					  </div>
					</li>
				</a>
				</div>
				<!---COls--->
				<div class="col-md-3" >
				<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'removed-request-list')) ?>">
					<li class="col-lg-12 col-xs-12 tile   tile-1 slideTextUp">
					  <!-- small box -->
					  <div class="small-box bg-blue">
						<div class="inner">
							<table width="100%" border="0" height="90px">
								<tr>
									<td rowspan="2" width="40%">&nbsp;	<br>
										<i style='font-size:46px' class="fa fa-trash"></i>
									</td>
									<td  align="left" style="padding-top:20px; font-size:20px">
										<?php echo $RemovedReqestNew; ?>
									</td>
								</tr>
								<tr>
									<td align="left" style="font-size:15px">Removed Requests</td>
								</tr>
							</table>		
							 
						</div>
					  </div>
					  <div class="small-box bg-white">
						<span> Click here to view all currently open Requests, You have Respoded to. <span> 
 					  </div>
					</li>
				</a>
				</div>
		<?php }
			if($users['role_id'] == 3)
			{
				?>
				<div class="col-md-3" >
				<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'my-final-responses')) ?>">
					<li class="col-lg-12 col-xs-12 tile   tile-1 slideTextUp">
					  <!-- small box -->
					  <div class="small-box bg-red">
						<div class="inner">
							<table width="100%" border="0" height="90px">
								<tr>
									<td rowspan="2" width="40%">&nbsp;	<br>
										<i style='font-size:46px' class="fa fa-check-square"></i>
									</td>
									<td  align="left" style="padding-top:20px; font-size:20px">
										<?php echo $FInalResponseCountNew; ?>
									</td>
								</tr>
								<tr>
									<td align="left" style="font-size:15px">Finalized Responses</td>
								</tr>
							</table>		
							 
						</div>
					  </div>
					  <div class="small-box bg-white">
						  <span>Click here to fill your Requirement for Travel Package, Hotel or Transportation. </span> 
 					  </div>
					</li>
				</a>
				</div>
				<!-- ./col -->
				<div class="col-md-3" >
				<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'blocked-user-list')) ?>">
					<li class="col-lg-12 col-xs-12 tile   tile-1 slideTextUp">
					  <!-- small box -->
					  <div class="small-box bg-yellow">
						<div class="inner">
							<table width="100%" border="0" height="90px">
								<tr>
									<td rowspan="2" width="40%">&nbsp;	<br>
										<i style='font-size:46px' class="fa fa-users"></i>
									</td>
									<td  align="left" style="padding-top:20px; font-size:20px">
										<?php echo $blockedUserscountnew; ?>
									</td>
								</tr>
								<tr>
									<td align="left" style="font-size:15px">Blocked Users</td>
								</tr>
							</table>		
						</div>
					  </div>
					  <div class="small-box bg-white">
						<span> Click here to view the list of all currently Open requests placed by you. <span> 
 					  </div>
					</li>
				</a>
				</div>
			<?php 
			}


		?>
	  </div>
	</div>
	<!--<div class="col-md-5">
		<?php if( count($testimonial) > 0) {
			?>
			<div class="col-md-12" style="background-color:#FFF;">
				<p style="font-size:20px;padding-top:10px">Reviews</p>
				<hr></hr>
				<div class="">
				
					<div class="carousel-reviews broun-block">
						<div id="carousel-reviews" class="carousel slide carousel1" data-ride="carousel">
							<div class="carousel-inner">
							<?php
							$x=1;
							foreach($testimonial as $testimo){
							?>
								<div class="item <?php if($x==1){ echo 'active'; } ?>">
									<?php
									$k =1;
									//foreach($testimon as $testimo){
									?>
									<div class="">
										<div class="review-block">
											<div class="">
												<div class="block-text">
													<p> <?php echo $testimo['comment']; ?> </p>
												</div>
												 
											</div>
											<div class="col-md-3 col-sm-2 col-xs-2 person-img" style="padding-top:5px">
												<?php

													if($testimo["profile_pic"]==""){
														echo $this->Html->image('no-profile-image.jpg', ["class"=>"img-responsive center_img","alt"=>"Profile Pic","style"=>"border-radius: 50%;height:50px;    border: 1px solid #1295A2;"]); 
													}
													else
													{
														if(file_exists('img/user_docs/'.$testimo["author_id"].'/'.$testimo["profile_pic"])>0){
															echo $this->Html->image('user_docs/'.$testimo["author_id"].'/'.$testimo["profile_pic"], ["class"=>"img-responsive center_img","alt"=>"Profile Pic","style"=>"border-radius: 50%;height:50px;border: 1px solid #1295A2;"]);
														}
														else{
															echo $this->Html->image('no-profile-image.jpg', ["class"=>"img-responsive center_img","alt"=>"Profile Pic","style"=>"border-radius: 50%;height:50px;    border: 1px solid #1295A2;"]); 
														}
													}
												?>
												<br>
											</div>
											<div class="col-md-9 person-info">
												<h4><?php echo $testimo['name']; ?></h4>
												<div class="rating">
													<?php
													$userRating =  $testimo['rating1'];
													if($userRating>0){
														for($i=$userRating; $i>0; $i--){
															echo '<i class="fa fa-star"></i>';
														}
													}
													else {
														echo '<i class="fa fa-star"></i>';
													}
													?>
												</div>
											</div>
										</div>
									</div>
								<?php  ?>
								</div>
							<?php $x++;
								} ?>

							</div>
							<?php if(count($testimonial)>2){?>
								<div class="">
									<a class="left carousel-control arroysign" href="#carousel-reviews" role="button" data-slide="prev">   
										<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
									</a>
									<a class="right carousel-control arroysign" href="#carousel-reviews" role="button" data-slide="next">
										<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
									</a>
								</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
		<?php }
		else{
			?>
			<div class="row">
				<div class="col-md-12" style="background-color:#FFF;">
					<p style="font-size:20px;padding-top:10px">Reviews</p>
					<hr></hr>
					<div class="">
						<div class="carousel-reviews broun-block" style="height: 214px;">
							<div id="carousel-reviews" class="carousel slide carousel1" data-ride="carousel">
								<div class="carousel-inner">
									<div class="block-text">
										No Reviews
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}?>  
	</div>---->
 	 
	</div>
			
	<?php
	/*} 
	else 
	{*/ 
	/*	?>
		<div class="homepageshow">
		<table width="100%">
			<tr>
 			<?php if($users['role_id'] == 1 || $users['role_id'] == 2) { 
			?>
			<td width="20%">
			<div style="width:100% !important;border-right:1px solid #1c6f7d">
				<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'sendrequest')) ?>">
 				  <div class="small-box bg-blue">
					<div class="inner">
						<table width="100%" border="0"  style="text-align:center">
							<tr>
								<td height="30px"> 	 
									<?php echo $this->Html->image('white-place-request-icon.png',array('style'=>'height:20px;width:20px')); ?>
								</td>
							</tr>
							<tr>
								<td height="25px" style="font-size:12px">
									Place Request
								</td>
							</tr>
							<tr>
								<td height="25px" style="font-size:14px"><?php echo ($reqcountNew['value']-$myRequestCountNew); ?></td>
							</tr>
						</table>		
						 
					</div>
				  </div>
				</a>
			</div>
			</td>
			<td width="20%">
			<!-- ./col -->
			 <div style="width:100% !important;border-right:1px solid #1c6f7d">
				<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>">
				   
				  <div class="small-box bg-blue">
					<div class="inner">
						<table width="100%" border="0" style="text-align:center">
							<tr>
								<td height="30px" > 
									<?php echo $this->Html->image('white-my-request-icon.png',array('style'=>'height:20px;width:20px')); ?>
								</td>
							</tr>
							<tr>
								<td height="25px"  style="font-size:12px">
									My Requests
								</td>
							</tr>
							<tr>
								<td height="25px"  style="font-size:14px"><?php echo $myRequestCountNew; ?></td>
							</tr>
						</table>		
					</div>
				  </div>
				</a>
			</div>
			</td>
			<?php } 
			if($users['role_id'] == 1 || $users['role_id'] == 3) { 
			?>
			<!-- COls -->
			<?php if($users['role_id'] == 1){?>
			<td width="20%">
			<div style="width:100% !important;border-right:1px solid #1c6f7d">
			<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'dashboard')) ?>">
 				  
				  <div class="small-box bg-blue">
					<div class="inner">
						<table width="100%" border="0" style="text-align:center">
							<tr>
								<td height="40px">
									<i style="font-size:25px" class="fa fa-home"></i>								
 								</td>
							</tr>
							<tr height="40px">
								<td style="font-size:12px">
									Home
								</td>
							</tr> 
						</table>		
					</div>
				  </div>
				</a>
			</div>
			</td>	
			<?php } ?> 
			<td width="20%">
			<div style="width:100% !important;border-right:1px solid #1c6f7d">
			<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>">
 				  
				  <div class="small-box bg-blue">
					<div class="inner">
						<table width="100%" border="0" style="text-align:center">
							<tr>
								<td height="30px" > 	 
									<?php echo $this->Html->image('white-back-icon.png',array('style'=>'height:20px;width:20px')); ?>
								</td>
							</tr>
							<tr>
								<td height="25px"  style="font-size:12px">
									R to R
								</td>
							</tr>
							<tr>
								<td height="25px"  style="font-size:14px"><?php echo $respondToRequestCountNew; ?></td>
							</tr>
						</table>		
					</div>
				  </div>
				</a>
			</div>
			</td>
			<?php if($users['role_id'] == 3){?>
			<td width="20%">
			<div style="width:100% !important;border-right:1px solid #1c6f7d">
			<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'dashboard')) ?>">
 				  
				  <div class="small-box bg-blue">
					<div class="inner">
						<table width="100%" border="0" style="text-align:center">
							<tr>
								<td height="40px" > 
									<i style="font-size:25px" class="fa fa-home"></i>								
 								</td>
							</tr>
							<tr>
								<td height="40px"  style="font-size:12px">
									Home
								</td>
							</tr> 
						</table>		
					</div>
				  </div>
				</a>
			</div>
			</td>	
			<?php } ?>
			<td width="20%">
			<!---COls--->
			 <div style="width:100% !important">
			<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'myresponselist')) ?>">
				  
				  <div class="small-box bg-blue">
					<div class="inner">
						<table width="100%" border="0" style="text-align:center">
							<tr>
								<td height="30px" > 
									<?php echo $this->Html->image('white-my-resposes-head.png',array('style'=>'height:20px;width:20px')); ?>
								</td>
							</tr>
							<tr>
								<td height="25px"  style="font-size:12px">
									My Responses
								</td>
							</tr>
							<tr>
								<td height="25px"  style="font-size:14px"><?php echo $myReponseCountNew; ?></td>
							</tr>
						</table>		
					</div>
				  </div>
				</a>
			</div>
			</td> 
			<?php }	?>
			</tr>
			</table>
 		  
		</div> 
<?php //} */ ?>