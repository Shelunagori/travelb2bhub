<style>
 

.checked {
    color: orange;
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
    min-height: 120px; 
    height: 120px;
    z-index: 30;
}

</style>

<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Profile</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
			     
					<div>
						<div class="form-group col-md-12">
						<div class="form-group col-md-3">
							<?php
							if( $users['profile_pic']=="" ){
								echo $this->Html->image('no-profile-image.jpg', ["alt"=>"Profile Pic", "height"=>150]); 
							}else {
								echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['profile_pic'], ["alt"=>"Profile Pic", "height"=>150,"class"=>"profile_img"]);
							} 
							?>
						</div> 
						<div class="form-group col-md-9">
							<span class="margin-tb5" style="font-size: 23px;"><font color="#1295A2"><?php echo $users['first_name'] ?> <?php echo $users['last_name'] ?></font></span>
							<p style="font-size: 20px;"><font color="#848688"><?php echo $membership_name;?></font></p>
							
								<?php
			$profilePercentage = 0;
			if(!empty($users['pancard_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['pancard_pic'])) {
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
						
			} else {
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
			}
	
			?>
			
			<div >
			<span style="text-align:left !important; font-size: 20px;"><font color="#4B4B4D">Profile Completeness</font></span>
				<div class="text-center">
					
					<!---- 	<div class="contact-icons">
                        <ul class="hidden-xs hidden-sm">
                                        <?php if($users['web_url']!="") { ?>
                    <li><a title="Website" href="#"><?php  echo $this->Html->image('black-web-url.png', ["alt"=>"Website", "height"=>32, "width"=>32]); ?></a></li>
                    <?php } ?>
                    <?php if($users['pancard_pic']!="") { ?>
                    <li><a title="Pan Card" href="#"><?php  echo $this->Html->image('black-pan-card.png', ["alt"=>"Pan Card","height"=>32, "width"=>32 ]); ?></a></li>
                    <?php } ?>
                    <?php if($users['id_card_pic']!="") { ?>
                    <li><a href="#" title="ID Card"><?php  echo $this->Html->image('black-id-card.png', ["alt"=>"ID Card","height"=>32, "width"=>32 ]); ?></a></li>
                    <?php } ?>
                    <?php if($users['company_shop_registration_pic']!="") { ?>
                    <li><a href="#" title="Company shop registration"><?php  echo $this->Html->image('black-company-reg.png', ["alt"=>"Company shop registration","height"=>32, "width"=>32 ]); ?></a></li>
                    <?php } ?>
                                        </ul>
                                        
                
                                       
                <ul class="visible-sm visible-xs">
                                        
                    <?php if($users['web_url']!="") { ?>                    
                    <li>  
                        <button tabindex="0" class="btn btn_tooltip" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-style="mypops" id="Pops">
                        <a title="Website" ><?php  echo $this->Html->image('black-web-url.png', ["alt"=>"Website", "height"=>32, "width"=>32]); ?></a></button>
                        
                         <span id="popover-content" class="hide">Website</span>
                    </li>
                    <?php } ?>
                    
                    <?php if($users['pancard_pic']!="") { ?>
                    <li>
                        <button tabindex="0" class="btn btn_tooltip" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-style="mypops" id="Pops1">
                        <a title="Pan Card"><?php  echo $this->Html->image('black-pan-card.png', ["alt"=>"Pan Card","height"=>32, "width"=>32 ]); ?></a></button>
                        
                         <span id="popover-content1" class="hide">Pan Card</span>
                            
                            </li>
                    <?php } ?>
                    
                    <?php if($users['id_card_pic']!="") { ?>
                    <li>
                        <button tabindex="0" class="btn btn_tooltip" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-style="mypops" id="Pops2">
                        <a title="ID Card"><?php  echo $this->Html->image('black-id-card.png', ["alt"=>"ID Card","height"=>32, "width"=>32 ]); ?></a></button>
                        
                         <span id="popover-content2" class="hide">ID Card</span>
                        
                            </li>
                    <?php } ?>
                    
                    <?php if($users['company_shop_registration_pic']!="") { ?>
                    <li>
                        <button tabindex="0" class="btn btn_tooltip" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-style="mypops" id="Pops3">
                        <a title="Company shop registration"><?php  echo $this->Html->image('black-company-reg.png', ["alt"=>"Company shop registration","height"=>32, "width"=>32 ]); ?></a></button>
                        
                         <span id="popover-content3" class="hide">Company shop registration</span>
                    
                    </li>
                    <?php } ?>
                    </ul>---->
                </div>
						<div class="progress">
							<div class="progress-bar"  role="progressbar" aria-valuenow="<?php echo $profilePercentage; ?>"
							aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $profilePercentage; ?>%">
								<?php echo $profilePercentage; ?>%
							</div>
						</div>
                    <!--<div class="rating" style="cursor: pointer;" data-toggle="collapse"  data-parent="#reviews" href="#reviews">
								<?php
								if($average_rating>0){
							   
									for($i=$average_rating; $i>0; $i--){
										echo '<i class="fa fa-star"></i>';
									}
								}else{
								  
								}  
								?><span title="Average Rating"> <?php echo $average_rating;?></span><?php if($testimonialcount>0){?>
							 <span title="Numbe of Users"> ( <?php echo $testimonialcount;?> )</span>
							 <?php }?> 
                    </div>-->
                   
				   
				   <hr/>
				   <div class="clo-md-12">
						<font color="#4B4B4D" size="4">
						<div class="col-md-4">
							<?php 
							if($users['role_id'] == 1){ ?>
								<strong>
									Finalized Requests
								</strong>
								<br>
								<span style="font-size: 30px;">
									<font color="#1295A2">
										<?php echo $userRequestCount;?>
									</font>
								</span>
							 <?php }
							 else if($users['role_id'] == 2){ ?>
								<strong>
								Finalized Requests
								</strong><br>
								<span style="font-size: 30px;">
									<font color="#1295A2">
										<?php echo $userRequestCount;?>
									</font>
								</span>
							 <?php } ?>
						</div>		
						<div class="col-md-4">
							<?php 
							if($users['role_id'] == 1){ ?>
								<strong>
								Responded Requests
								</strong><br>
								<span style="font-size: 30px;">
									<font color="#1295A2">
										<?php echo $userrespondToRequestCount;?>
									</font>	
								</span>
							<?php }
							 else if($users['role_id'] == 3){ ?>
								<strong>Responded Requests</strong><br>
								<span style="font-size: 30px;">
								<font color="#1295A2">
									<?php echo $userrespondToRequestCount;?></span>
								</font>
							 <?php } ?>
						</div>
						<div class="col-md-4">
							<?php 
							if($users['role_id'] == 1){ ?>
								<strong>Finalized Responses</strong><br>
								<span style="font-size: 30px;">
								<font color="#1295A2">
								<?php echo $userReponseCount;?>
								</font>
								</span>
							<?php }
							 else if($users['role_id'] == 3){ ?>
								<strong>Finalized Responses</strong><br>
								<span style="font-size:30px;">
								<font color="#1295A2">
								<?php echo $userReponseCount;?>
								</font>
								</span>
							 <?php } ?>
						</div>
						</font>
				   </div>
				</div> 
			</div> 
		</div> 
	</div>
            </form>
          </div>      
        </div>
      </div>
      <!-- /.row -->
		<div class="col-md-12">
			<span style="font-size:18px">Description</span>
			<div class="box box-primary">
				<div class="box-body">
					<div>
						<div class="form-group col-md-12">
							<?php echo $users['description']; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<span style="font-size:18px">Certificates</span>
			<div class="box box-primary">
				<div class="box-body">
					<div>
						<div class="col-md-12">
							<div class="img_show col-md-3" align="center">
								<?php if(!empty($users['iata_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['iata_pic'])) { 
									echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['iata_pic'], ["alt"=>"IATA Pic", "height"=>150, 'width'=>150, 'style'=>'border-radius: 50%;']);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"IATA Pic", "height"=>200, 'width'=>200, 'style'=>'border-radius: 50%;']); 
									} ?>
								<p>
									IATA Pic
								</p>
							</div>
							<div class="img_show col-md-3" align="center">
								<?php if(!empty($users['tafi_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['tafi_pic'])) {
									echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['tafi_pic'], ["alt"=>"T A F I Pic", "height"=>150, 'width'=>150, 'style'=>'border-radius: 50%;']);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"T A F I Pic", "height"=>200, 'width'=>200, 'style'=>'border-radius: 50%;']); 
									} ?>
								<p>
									T A F I Pic
								</p>
							</div>
							
							<div class="img_show col-md-3" align="center">
								<?php if(!empty($users['taai_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['taai_pic'])) { 
									echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['taai_pic'], ["alt"=>"T A A I Pic", "height"=>150, 'width'=>150, 'style'=>'border-radius: 50%;']);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"T A A I Pic", "height"=>200, 'width'=>200, 'style'=>'border-radius: 50%;']); 
									} ?>
								<p>
									T A A I Pic
								</p>
							</div>
							
							<div class="img_show col-md-3" align="center">
								<?php if(!empty($users['iato_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['iato_pic'])) { 
									echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['iato_pic'], ["alt"=>"I A T O Pic", "height"=>150, 'width'=>150, 'style'=>'border-radius: 50%;']);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"I A T O Pic", "height"=>200, 'width'=>200, 'style'=>'border-radius: 50%;']); 
									} ?>
								<p>
									IATO Pic
								</p>
							</div>
							
							<div class="img_show col-md-3" align="center">
								<?php if(!empty($users['adyoi_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['adyoi_pic'])) { 
									echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['adyoi_pic'], ["alt"=>"A D Y O I Pic", "height"=>150, 'width'=>150, 'style'=>'border-radius: 50%;']);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"A D T O I Pic", "height"=>200, 'width'=>200, 'style'=>'border-radius: 50%;']); 
									} ?>
								<p>
									A D Y O I Pic
								</p>
							</div>
							
							<div class="img_show col-md-3" align="center">
								<?php if(!empty($users['iso9001_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['iso9001_pic'])) { 
									echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['iso9001_pic'], ["alt"=>"I S O 9001 Pic", "height"=>150, 'width'=>150, 'style'=>'border-radius: 50%;']);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"I S O 9001 Pic", "height"=>200, 'width'=>200, 'style'=>'border-radius: 50%;']); 
									} ?>
								<p>
									I S O 9001 Pic
								</p>
							</div>
							
							<div class="img_show col-md-3" align="center">
								<?php if(!empty($users['uftaa_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['uftaa_pic'])) { 
								   echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['uftaa_pic'], ["alt"=>"U F T A A Pic", "height"=>150, 'width'=>150, 'style'=>'border-radius: 50%;']);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"U F T A A Pic", "height"=>200, 'width'=>200, 'style'=>'border-radius: 50%;']); 
									} ?>
									<p>
										U F T A A Pic
									</p>
							</div>
							
							<div class="img_show col-md-3" align="center">
								<?php if(!empty($users['adtoi_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['adtoi_pic'])) { 
									echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['adtoi_pic'], ["alt"=>"A D T O I Pic", "height"=>150, 'width'=>150, 'style'=>'border-radius: 50%;']);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"A D T O I Pic", "height"=>200, 'width'=>200, 'style'=>'border-radius: 50%;']); 
									} ?>
									<p>
										A D T O I Pic
									</p>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		
		 
		<div class="col-md-12">
		<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-body">
				<div>
					<div class="form-group col-md-12">
						 <div class="row">
                <div class="col-md-12 paddingright0">
                    <div class="rating-block">
                        <h5 >Average user rating &nbsp; <font color="#1295A2" ><?php echo $average_rating;?> <small> ( <?php echo $testimonialcount;?> ) </font> </small>&nbsp; 
							<span <?php if($average_rating==1 OR $average_rating>1){ ?>class="fa fa-star checked"<?php }else{  ?>class="fa fa-star"<?php } ?> ></span>
							<span <?php if($average_rating==2 OR $average_rating>2){ ?>class="fa fa-star checked"<?php }else{  ?>class="fa fa-star"<?php } ?> ></span>
							<span <?php if($average_rating==3 OR $average_rating>3){ ?>class="fa fa-star checked"<?php }else{  ?>class="fa fa-star"<?php } ?> ></span>
							<span <?php if($average_rating==4 OR $average_rating>4){ ?>class="fa fa-star checked"<?php }else{  ?>class="fa fa-star"<?php } ?> ></span>
							<span <?php if($average_rating==5 OR $average_rating>5){ ?>class="fa fa-star checked"<?php }else{  ?>class="fa fa-star"<?php } ?> ></span>
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
                        <div class="col-md-3">
                            <div><?php echo $i;?> 
							<span <?php if($average_rating==$i OR $average_rating>$i){ ?>class="fa fa-star checked"<?php }else{  ?>class="fa fa-star"<?php } ?> ></span>
							</div>
                        </div>
                        <div class="col-md-7" >
                            <div class="progress">         
								<div <?php if($average_rating==$i OR $average_rating>$i){ ?>style="width: 100%; height: 18px; background-color: #ff9800;"<?php } ?>></div>	
                            </div>
                        </div>
                        <div class="col-md-2" ><?php if($average_rating==$i OR 	$average_rating>$i){ echo "100"; }else{ echo "0"; }  ?>%
                        </div>
                        
                      <?php }?> 
                       </div> 
                    
                </div>
                 </div> 
             </div>
 					</div>
				</div>
			</div>
		</div>
		</div>
		<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-body">
				<div>
		<?php  if($testimonialcount > 0) { 
			?>
			<div class="col-md-12" style="background-color:#FFF">
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
														echo $this->Html->image('user_docs/'.$testimo["author_id"].'/'.$testimo["profile_pic"], ["class"=>"img-responsive center_img","alt"=>"Profile Pic","style"=>"border-radius: 50%;height:50px;border: 1px solid #1295A2;"]);
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
			<?php
		}?>
				</div>
			</div>
		</div>
		</div>
		</div>
		
		<div class="col-md-12">
			<span style="font-size:18px">Office Photographs</span>
			<div class="box box-primary">
				<div class="box-body">
					<div>
						<div class="form-group col-md-12">
							<div class="col-md-4">
								<p>Photograph Of <?php if($users['role_id'] == 3) { echo "Hotel "; } else { ?> Office <?php } ?> 1</p>
								<?php if(!empty($users['company_img_1_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['company_img_1_pic'])) {
								echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['company_img_1_pic'], [ "alt"=>"Company Image 1 Pic", "height"=>"180px"]);?>
								<?php } ?>
							</div>
							<div class="col-md-4"><p>Photograph Of <?php if($users['role_id'] == 3) { echo "Hotel "; } else { ?> Office <?php } ?> 2</p>  
								<?php if(!empty($users['company_img_2_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['company_img_2_pic'])) {
								echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['company_img_2_pic'], [ "alt"=>"Company Image 2 Pic", "height"=>"180px"]);?>
								<?php } ?> 
							</div>
						</div>
					</div>
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
 