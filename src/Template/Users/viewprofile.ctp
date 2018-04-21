<?php 
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
?>
<style>
.checked {
    color: #1295AB;
}
.checked1 {
    color: #F3565D;
}
.vl {
    border-left: 6px solid green;
    height: 300px;
}
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
    min-height: 89px; 
    height: 89px;
    z-index: 30;
}

</style>

<section class="content">
 <div class="col-md-12">
				<div class="box-tools pull-right">
				<?php if($users['id']==$loginid){?>
					<a href="../profileedit/<?php echo $users['id'];?>" class="btn btn-sm btn-danger margin"> Edit </a>
				<?php } ?>
				</div> 
			</div>
      <div class="row">
	 
        <!-- left column -->
        <div class="col-md-4">
          <!-- general form elements -->
          <div class="box box-primary">
			<div class="box-tools pull-right">
		 
			</div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
			
              <div class="box-body">
			     
					<div>
						<div class="form-group">
						<div class="form-group  text-center">
							<?php
							if($users['profile_pic']==""){
								echo $this->Html->image('no-profile-image.jpg', ["alt"=>"Profile Pic", "height"=>110, 'style'=>'border-radius: 50%;',"width"=>110]); 
							}
							else {
								if(file_exists('img/user_docs/'.$users['id'].'/'.$users['profile_pic'])>0){
									echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['profile_pic'], ["alt"=>"Profile Pic", "height"=>110,"width"=>110, "class"=>"profile_img", 'style'=>'border-radius: 50%;']);
								}
								else{
									echo $this->Html->image('no-profile-image.jpg', ["alt"=>"Profile Pic", "height"=>110,"width"=>110, 'style'=>'border-radius: 50%;']); 
								}
							} 
							?><br>
							<span class="margin-tb5" style="font-size: 18px;"><font color="#1295A2"><?php echo $users['first_name'] ?> <?php echo $users['last_name'] ?></font></span><br>
							<span style="font-size: 15px;"><font color="#848688"><?php echo $membership_name;?></font></span>
							<?php
			$profilePercentage = 0;
			if(!empty($users['pancard_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.	$users['id'].DS.$users['pancard_pic'])) {
				if($users['role_id'] == 3) {
					$profilePercentage += 10;
				}
				else if($users['role_id'] == 2) {
					$profilePercentage += 16;
				}
				else {
					$profilePercentage += 5;
				}
			}
			if(!empty($users['company_shop_registration_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['company_shop_registration_pic'])) {
				if($users['role_id'] == 3) {
					$profilePercentage += 10;
				}
				else if($users['role_id'] == 2) {
					$profilePercentage += 15;
				}
				else {
					$profilePercentage += 5;
				}
			}
			if(!empty($users['company_img_1_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['company_img_1_pic'])) {
				if($users['role_id'] == 3 || $users['role_id'] == 2) {
					$profilePercentage += 10;
				} 
				else {
					$profilePercentage += 5;
				}
			}
			if(!empty($users['id_card_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['id_card_pic'])) {
				if($users['role_id'] == 3 || $users['role_id'] == 2) {
					$profilePercentage += 10;
							
				} else {
					$profilePercentage += 5;
				}
			}
			if(!empty($users['profile_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['profile_pic'])) {
				if($users['role_id'] == 3 || $users['role_id'] == 2) {
					$profilePercentage += 10;
							
				} else {
					$profilePercentage += 5;
				}
			}		
			if(!empty($users['first_name'])) {
				
				if($users['role_id'] == 3 || $users['role_id'] == 2) {
					$profilePercentage += 3;
				}
				else {
					$profilePercentage += 2;
				}
			}
			if(!empty($users['company_name'])) {
				
				if($users['role_id'] == 3 || $users['role_id'] == 2) {
					$profilePercentage += 3;
				}
				else {
					$profilePercentage += 2;
				}
			}
			if(!empty($users['email'])) {
				$profilePercentage += 3;
			}
			if(!empty($users['mobile_number'])) {
				
				if($users['role_id'] == 3 || $users['role_id'] == 2) {
					$profilePercentage += 4;
				}
				else {
					$profilePercentage += 3;
				}
			}
			if(!empty($users['p_contact'])) {
				$profilePercentage += 3;
			}
			if(!empty($users['address'])) {
				$profilePercentage += 3;
			}
			if(!empty($users['locality'])) {
				if($users['role_id'] == 3) {
					$profilePercentage += 3;
				}
				else {
					$profilePercentage += 2;
				}
			}
			if(!empty($users['city_id'])) {
				$profilePercentage += 3;
			}
			if(!empty($users['state_id'])) {
				$profilePercentage += 3;
			}
			if(!empty($users['country_id'])) {
				$profilePercentage += 3;
			}
			if(!empty($users['pincode'])) {
				$profilePercentage += 3;
			}
			if(!empty($users['web_url'])) {
				$profilePercentage += 3;
			}
			if(!empty($users['description'])) {
				
				if($users['role_id'] == 3 || $users['role_id'] == 2) {
					$profilePercentage += 3;
				}
				else {
					$profilePercentage += 2;

				}
			}
			if($users['role_id'] == 3 ) {
				if(!empty($users['hotel_rating'])) {
					$profilePercentage += 5;
				}
				if(!empty($users['hotel_categories'])) {
					$profilePercentage += 5;
				}
			} 
			
			if($users['role_id'] == 1 ) {
				if(!empty($users['iata_pic'])) {
					$profilePercentage += 5;
				}
				if(!empty($users['tafi_pic'])) {
					$profilePercentage += 5;
				}
				if(!empty($users['taai_pic'])) {
					$profilePercentage += 5;
				}
				if(!empty($users['iato_pic'])) {
					$profilePercentage += 5;
				}
				if(!empty($users['adyoi_pic'])) {
					$profilePercentage += 5;
				}
				if(!empty($users['iso9001_pic'])) {
					$profilePercentage += 5;
				}
				if(!empty($users['uftaa_pic'])) {
					$profilePercentage += 5;
				}
				if(!empty($users['adtoi_pic'])) {
					$profilePercentage += 5;
				}
			} ?>
			<p style="font-size: 16px;"><font color="#4B4B4D">Profile Completeness</font></p>
			<div class="progress" style="height: 14px !important;">
				<div class="progress-bar"  role="progressbar" aria-valuenow="<?php echo $profilePercentage; ?>"
				aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $profilePercentage; ?>%;background-color: #1295AB !important;line-height: 15px !important;">
					<?php echo $profilePercentage; ?>%
				</div>
			</div>
			<div>
						<font color="#4B4B4D" size="4">
						<div class="col-md-12">
							<?php 
							$Final_hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'finalized-request-list'));
							if($users['role_id'] == 1){ ?>
								 <div style="float:left" class="col-md-10" align="left">
									<a href="<?php echo $hrefurl; ?>"> Finalized Requests</a>
								 </div>
								 <div style="float:right"  >
									<div style="width: 32px;height: 25px;background-color:#1295A2;border-radius:13px;color:#FEFEFE;">		
										<?php echo $userRequestCount;?>
									</div>
								 </div>
							 <?php }
							 else if($users['role_id'] == 2){ ?>
								
								 <div style="float:left" class="col-md-10" align="left">
									<a href="<?php echo $hrefurl; ?>"> Finalized Requests</a>
								 </div>
								 <div style="float:right" class="col-md-2">
									<div style="width: 32px; height: 25px; background-color: #1295A2;border-radius:9px;color:#FEFEFE;">		
									<?php echo $userRequestCount;?>
									</div>
								 </div>
							 <?php } ?>
						</div>		
						<div class="col-md-12" style="margin-top:3%;">
							<?php 
							$Res_req_hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'respondtorequest'));
							if($users['role_id'] == 1){ ?>
								<div style="float:left" class="col-md-10" align="left">
									<a href="<?php echo $Res_req_hrefurl; ?>"> Responded Requests</a>
								 </div>
								 <div style="float:right"  >
									<div style="width: 32px !important; height: 25px; background-color: #DFBA49;border-radius:13px;color:#FEFEFE;">		
										<?php echo $userrespondToRequestCount;?>
									</div>
								 </div>
								  
							<?php }
							 else if($users['role_id'] == 3){ ?>
								<div style="float:left" class="col-md-10" align="left">
									<a href="<?php echo $Res_req_hrefurl; ?>"> Responded Requests</a>
								 </div>
								 <div style="float:right"  >
									<div style="width: 32px !important; height: 25px; background-color: #DFBA49;border-radius:13px;color:#FEFEFE;">		
									<?php echo $userrespondToRequestCount;?>
									</div>
								 </div>
								 
							 <?php } ?>
						</div>
						<div class="col-md-12" style="margin-top:3%;">
							<?php 
							$final_res_hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'my-final-responses'));
							if($users['role_id'] == 1){ ?>
								<div style="float:left" class="col-md-10" align="left">
									<a href="<?php echo $final_res_hrefurl; ?>"> Finalized Responses</a>
								 </div>
								 <div style="float:right"  >
									<div style="width: 32px; height: 25px; background-color: #F3565D;border-radius:13px;color:#FEFEFE;">	
										<?php echo $userReponseCount;?>
									</div>
								 </div>
								  
							<?php }
							 else if($users['role_id'] == 3){ ?>
								<div style="float:left" class="col-md-10" align="left">
									<a href="<?php echo $final_res_hrefurl; ?>"> Finalized Responses</a>
								 </div>
								 <div style="float:right"  >
									<div style="width: 32px; height: 25px; background-color: #F3565D;border-radius:13px;color:#FEFEFE;">		
										<?php echo $userReponseCount;?>
									</div>
								 </div>
							 <?php } ?>
						</div>
						</font>
				   </div>
						</div>  
 	</div>
            </form>
			
          </div>      
		  
		 </div>
      </div>  
      </div>  
<!-------------------second------------------------------------------------->
 <div class="col-md-4">
          <!-- general form elements -->
          <div class="box box-primary">
			<div class="box-tools pull-right">
			 
			</div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
			      <div class="rating-block">
			<h4 style="color:#1295A2">Rating</h4>
				<hr> 
				<h5 >Average user rating &nbsp; <font color="#1295A2" ><?php echo number_format($average_rating,1);?> <small> ( <?php echo $testimonialcount;?> ) </font> </small>&nbsp; 
					<span <?php if($average_rating==1 OR $average_rating>1){ ?>class="fa fa-star checked1"<?php }else{  ?>class="fa fa-star"<?php } ?> ></span>
					<span <?php if($average_rating==2 OR $average_rating>2){ ?>class="fa fa-star checked1"<?php }else{  ?>class="fa fa-star"<?php } ?> ></span>
					<span <?php if($average_rating==3 OR $average_rating>3){ ?>class="fa fa-star checked1"<?php }else{  ?>class="fa fa-star"<?php } ?> ></span>
					<span <?php if($average_rating==4 OR $average_rating>4){ ?>class="fa fa-star checked1"<?php }else{  ?>class="fa fa-star"<?php } ?> ></span>
					<span <?php if($average_rating==5 OR $average_rating>5){ ?>class="fa fa-star checked1"<?php }else{  ?>class="fa fa-star"<?php } ?> ></span>
				</h5>
				<div class="row">  
			   <div class="col-md-8 col-xs-8 col-sm-8"> <h5 class="media_h4">Rating breakdown </h5> </div>
			   
			  </div>
			  <div class="row"> 
				<?php     
				// Example data
				$star1 = $star1count;
				$star2 = $star2count;
				$star3 = $star3count;
				$star4 = $star4count;
				$star5 = $star5count;

				$tot_stars = $star1 + $star2 + $star3 + $star4 + $star5;
					for ($i=5;$i >=1; --$i) {
				  $var = "star$i";
				  $count = $$var;
				   $percent = $count * 100 / $tot_stars;?>
				   <div class="row" class="col-md-12" style="padding-top:15px;">
				   <table width="90%" border="0" style="margin-left:15px;">
					<tr>
					<td width="18%" align="right">	
					<div class="col-md-12"  style="text-align:right;">
						<div><?php echo $i;?> 
						<span <?php if($average_rating==$i OR $average_rating>$i){ ?>class="fa fa-star checked"<?php }else{  ?>class="fa fa-star"<?php } ?> ></span>
						</div>
					</div>
					</td>
					<td width="70%">	
					<div class="col-md-8" style="padding-right: 0px !important;width:100% !important;">
						<div class="progress" style="height:13px !important;margin-bottom:2px !important;">         
							<div <?php if($average_rating==$i OR $average_rating>$i){ ?>style="width: 100%; height: 13px; background-color: #1295AB;border-radius:9px;"<?php } ?>></div>	
						</div>
					</div>
					</td>
					<td width="7%" align="left">	
					<div class="col-md-2" ><?php if($average_rating==$i OR 	$average_rating>$i){ echo "100"; }else{ echo "0"; }  ?>%
					</div>
					</td>
					</tr>
					</table>
					</div>
				  <?php }?> 
				   </div> 
				
			</div>
		 </div>
      </div>  
      </div>		  
      		  
<!-------------------second------------------------------------------------->		  
<!-------------------third------------------------------------------------->	


<div class="col-md-4">
          <!-- general form elements -->
          <div class="box box-primary">
			
              <div class="box-body">
			     <?php  if($testimonialcount > 0) { 
			?>
			<h4 style="color:#1295A2">Review</h4>
				<hr></hr>
			<div class=" " style="background-color:#FFF">
				
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
												<div class="block-text message-data align-right"  >
													<p style="height: 120px !important;"> <?php echo $testimo['comment']; ?> </p>
												</div>
												 
											</div><br>
											<div class="col-md-3 col-sm-2 col-xs-2 person-img" style="padding-top:5px">
												<?php

													if($testimo["profile_pic"]==""){
														echo $this->Html->image('no-profile-image.jpg', ["class"=>"img-responsive center_img","alt"=>"Profile Pic","style"=>"border-radius: 50%;height:50px;    border: 1px solid #1295A2;"]); 
													}
													else
													{
														if(file_exists('img/user_docs/'.$testimo["author_id"].'/'.$testimo["profile_pic"])){
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
													//echo $userRating;
													if($userRating>0){
														for($i=$userRating; $i>0; $i--){
															echo '<i class="fa fa-star checked"></i>';
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
								<?php //$k++;} ?>
								</div>
							<?php $x++;} ?>

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
			<div class="col-md-12" style="background-color:#FFF">
				<p style="font-size:20px;padding-top:5px">Reviews</p>
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
			<?php
		}?>    
		  
		 </div>
      </div>  
      </div>	  
<!-------------------third------------------------------------------------->		  
     </div>  
      <!-- /.row -->
			 
			<span style="font-size:18px; padding:10px;padding-top:10px;color:#373435 !important;"><b>Description</b></span>
			 
				<div class="box-body box">
					<div>
						<div class="form-group col-md-12" style="min-height: 80px !important;'">
							<?php echo $users['description']; ?>
						</div>
					</div>
				</div>
				
				
				<span style="font-size:18px; padding:10px;padding-top:10px;color:#373435 !important;"><b>Personal Details</b></span>
			 
				<div class="box-body box">
					<div>
						<div class="form-group col-md-12" >
						<table>
							<tr>
								<td width="50%">Company Name:</td>
								<td width="50%"><?php echo $users['company_name']; ?></td>
							</tr>
							<tr>
								<td>Primary Contact No.:</td>
								<td><?php echo $users['mobile_number']; ?></td>
							</tr>
							<tr>
								<td>Secondary Contact No.:</td>
								<td><?php echo $users['p_contact']; ?></td>
							</tr>
							<tr>
								<td>Email:</td>
								<td><?php echo $users['email']; ?></td>
							</tr>
							<tr>
								<td>Website:</td>
								<td><?php echo $users['web_url']; ?></td>
							</tr>
							<tr>
								<td>States of Operation:</td>
								<td><?php $preference=$users['preference']; 
								
								$preferences=explode(',', $preference);
							 
								foreach($preferences as $data){
									
									$state_id=$data;
									  
									$set="select `state_name` from `states` where `id`='$state_id'";
									$stmt1 = $conn->execute($set);
									foreach($stmt1 as $fet){
									$state_name=$fet['state_name'];	
									}
									
									$final_state_name.=$state_name;
									$final_state_name.=',';
								}
								echo $final_state_name;
								?></td>
							</tr>
						</table>	
						</div>
					</div>
				</div>
			 </div>
			 
			 
			 
			 
			 
			 
			 <span style="font-size:18px; padding:10px;padding-top:10px;color:#373435 !important;"><b>Address</b></span>
			 
				<div class="box-body box">
					<div>
						<div class="form-group col-md-12" >
						<table >
							<tr>
								<td width="150px">Address:</td>
								<td width="50%"><?php echo $users['address']; ?></td>
							</tr>
							<tr>
								<td>City:</td>
								<td><?php
									$ct_id=$users['city_id'];
									$seto="select `name` from `cities` where `id`='$ct_id'";
									$stmto = $conn->execute($seto);
									foreach($stmto as $feto){
									echo $ct_name=$feto['name'];	
									}
								?></td>
							</tr>
							<tr>
								<td>State:</td>
								<td><?php 
									$stst_id=$users['state_id'];
									$set1="select `state_name` from `states` where `id`='$stst_id'";
									$stmt11 = $conn->execute($set1);
									foreach($stmt11 as $fet1){
									echo $stst_name=$fet1['state_name'];	
									}
								?></td>
							</tr>
							<tr>
								<td>Country:</td>
								<td><?php 
									$cntry_id=$users['country_id'];
									$seto1="select `country_name` from `countries` where `id`='$cntry_id'";
									$stmto1 = $conn->execute($seto1);
									foreach($stmto1 as $feto1){
									echo $cntry_name=$feto1['country_name'];	
									}
								?></td>
							</tr>
							<tr>
								<td>Pincode:</td>
								<td><?php echo $users['pincode']; ?></td>
							</tr>
							
						</table>	
						</div>
					</div>
				</div>
			 
			 
		 
		  <?php if($users['role_id'] == 1){ ?>
			 
			<span style="font-size:18px; padding:10px;padding-top:10px;color:#373435 !important;"><b>Certificates</b></span>
				<div class="box-body box">
					 
						<div class="form-group col-md-12 " >
						<table  width="100%">
						<tr>
							<td align="center" width="25%">
							<div >
								<?php if(!empty($users['iata_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['iata_pic'])>0) { 
									echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['iata_pic'], ["alt"=>"IATA Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"IATA Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
									} ?>
								 
							</div>
							</td>
							<td align="center"  width="25%">
							<div >
								<?php if(!empty($users['tafi_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['tafi_pic'])>0) {
									echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['tafi_pic'], ["alt"=>"T A F I Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"T A F I Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
									} ?>
								 
							</div>
							</td>
							<td align="center"  width="25%">
							<div >
								<?php if(!empty($users['taai_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['taai_pic'])>0) { 
									echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['taai_pic'], ["alt"=>"T A A I Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"T A A I Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
									} ?>
								 
							</div>
							</td>
							 
							
							<td align="center"  width="25%">
							<div >
								<?php if(!empty($users['iato_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['iato_pic'])>0) { 
									echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['iato_pic'], ["alt"=>"I A T O Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"I A T O Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
									} ?>
								 
							</div>
							</td>
							</tr>
							<tr>
								<td width="25%" align="center">IATA</td>
								<td width="25%"  align="center">TAFI</td>
								<td width="25%"  align="center">TAAI</td>
								<td width="25%"  align="center">IATO</td>
							</tr>
							<tr>
							<td align="center"  width="25%">
							<div >
								<?php if(!empty($users['adyoi_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['adyoi_pic'])>0) { 
									echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['adyoi_pic'], ["alt"=>"A D Y O I Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"A D T O I Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
									} ?>
								 
							</div>
							</td>
							<td align="center"  width="25%">
							<div >
								<?php if(!empty($users['iso9001_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['iso9001_pic'])>0) { 
									echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['iso9001_pic'], ["alt"=>"I S O 9001 Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"I S O 9001 Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
									} ?>
							 
							</div>
							</td>
							<td align="center"  width="25%">
							<div >
								<?php if(!empty($users['uftaa_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['uftaa_pic'])>0) { 
								   echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['uftaa_pic'], ["alt"=>"U F T A A Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"U F T A A Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
									} ?>
									 
							</div>
							</td>
							<td align="center"  width="25%">
							<div >
								<?php if(!empty($users['adtoi_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['adtoi_pic'])>0) { 
									echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['adtoi_pic'], ["alt"=>"A D T O I Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"A D T O I Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
									} ?>
								 
							</div>
							</td>
							</tr>
							<tr>
								<td width="25%" align="center">ADYOI</td>
								<td width="25%"  align="center">ISO9001</td>
								<td width="25%"  align="center">UFTAA</td>
								<td width="25%"  align="center">ADTOI</td>
							</tr>
							</table>
						</div>
				</div>
		 <?php } ?>
			
				<span style="font-size:18px; padding:10px;padding-top:10px;color:#373435 !important;">
					<b>Office Photographs</b>
				</span>
				<div class="box-body box">
					<div>
						<div class="form-group col-md-12">
						<table cellpadding="10">
							<tr>
								<td width="48%">
									<div>
										 
										<?php if(!empty($users['company_img_1_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['company_img_1_pic'])>0) {
										echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['company_img_1_pic'], [ "alt"=>"Company Image 1 Pic", "height"=>"150px;"]);?>
										<?php }
										else{
											echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"A D T O I Pic", "height"=>130, 'width'=>130]); 
										}?>
									</div>
								</td >
								<td width="1%">&nbsp;</td>
								<td width="48%">
									<div>
										<?php if(!empty($users['company_img_2_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['company_img_2_pic'])>0) {
										echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['company_img_2_pic'], [ "alt"=>"Company Image 2 Pic", "height"=>"150px;"]);?>
										<?php }
										else{
											echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"A D T O I Pic", "height"=>130, 'width'=>130]); 
										}?>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
				
				
				
				<span style="font-size:18px; padding:10px;padding-top:10px;color:#373435 !important;">
					<b>ID/Registration Pics</b>
				</span>
				<div class="box-body box">
					<div>
						<div class="form-group col-md-12">
						<table>
						<tr>
						<td width="33%">
							<div  align="center">
								 
								<?php if(!empty($users['pancard_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['pancard_pic'])>0) {
								echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['pancard_pic'], [ "alt"=>"Pan Card", "height"=>"150px;border-radius: 50%;"]);?>
								<?php }
								else{
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"Pan Card", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
								}?>
								 
							</div>
							</td>
							<td width="33%">
							<div   align="center">
								<?php if(!empty($users['id_card_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['id_card_pic'])>0) {
								echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['id_card_pic'], [ "alt"=>"Business card", "height"=>"150px;border-radius: 50%;"]);?>
								<?php }
								else{
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"Business card", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
								}?>
								 
							</div>
							</td>
							<td width="33%">
							<div   align="center">
								<?php if(!empty($users['company_shop_registration_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['company_shop_registration_pic'])>0) {
								echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['company_shop_registration_pic'], [ "alt"=>"Company Shop Act Registration", "height"=>"150px;border-radius: 50%;"]);?>
								<?php }
								else{
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"Company Shop Act Registration", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
								}?>
									
							</div>
							 
							</td>
							</tr>
							<tr>
								<td align="center">Pan Card</td>
								<td align="center">Business Card</td>
								<td align="center">Company Shop Act Registration</td>
							</tr>
							</table>
							
						</div>
					</div>
				</div>
    </section>
	
 
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function() {
    $('#carousel-reviews .item').each(function(){
		var next = $(this).next();
		if (!next.length) {
		next = $(this).siblings(':first');
		}
		next.children(':first-child').clone().appendTo($(this));
	});
    $('#
	carousel-reviews').carousel({
	  interval:50000000000000000,
	  ride:false
	});
 });
</script>
 