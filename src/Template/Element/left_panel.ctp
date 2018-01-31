<?php $currentUrl = explode("/",\Cake\Routing\Router::url()); ?>
<div id="orange_bg" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 left-panel padding0 padding-t15">			
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
    <?php  if($currentUrl[2]=='dashboard') { ?>
<div class="profile">
                <?php
                if($users['profile_pic']=="" ){
                     echo $this->Html->image('no-profile-image.jpg', ["alt"=>"Profile Pic", "height"=>150]); 
                }else{
               echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['profile_pic'], [ "alt"=>"Profile Pic", "height"=>150]);
                }
                ?>
                <br>
                <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'profileedit')) ?>">Edit Profile</a>
</div>
		<h3 class="margin-tb5"><?php echo $users['first_name'].' '.$users['last_name']; ?></h3>
		<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'changePassword')) ?>">Change Password</a><br>
          <div class="contact-icons">
				<ul>
				<?php if($users['web_url']!="") { ?>
                    <li><a title="Website" href="#"><?php  echo $this->Html->image('web-url.png', ["alt"=>"Website", "height"=>32, "width"=>32]); ?></a></li>
                    <?php } ?>
                    <?php if($users['pancard_pic']!="") { ?>
                    <li><a title="Pan Card" href="#"><?php  echo $this->Html->image('pan-card.png', ["alt"=>"Pan Card","height"=>32, "width"=>32 ]); ?></a></li>
                    <?php } ?>
                    <?php if($users['id_card_pic']!="") { ?>
                    <li><a href="#" title="ID Card"><?php  echo $this->Html->image('id-card.png', ["alt"=>"ID Card","height"=>32, "width"=>32 ]); ?></a></li>
                    <?php } ?>
                    <?php if($users['company_shop_registration_pic']!="") { ?>
                    <li><a href="#" title="Company shop registration"><?php  echo $this->Html->image('company-reg.png', ["alt"=>"Company shop registration","height"=>32, "width"=>32 ]); ?></a></li>
                    <?php } ?>
                </ul>
			</div>
        
		<?php
			if(isset($userProfile)) {
			$profilePercentage = 0;
			if(!empty($userProfile['pancard_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$userProfile['id'].DS.$userProfile['pancard_pic'])) {
					if($userProfile['role_id'] == 3) {
						$profilePercentage += 10;
						
			} 
			else if($userProfile['role_id'] == 2) {
						$profilePercentage += 16;
						
			} 
			else {
				$profilePercentage += 5;
			}
			}
			if(!empty($userProfile['company_shop_registration_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$userProfile['id'].DS.$userProfile['company_shop_registration_pic'])) {
				if($userProfile['role_id'] == 3) {
						$profilePercentage += 10;
						
			} 
			else if($userProfile['role_id'] == 2) {
						$profilePercentage += 15;
						
			} 
			else {
				$profilePercentage += 5;
			}
			}

			if(!empty($userProfile['company_img_1_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$userProfile['id'].DS.$userProfile['company_img_1_pic'])) {
				if($userProfile['role_id'] == 3 || $userProfile['role_id'] == 2) {
						$profilePercentage += 10;
						
			} else {
				$profilePercentage += 5;
			}
			}

			if(!empty($userProfile['id_card_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$userProfile['id'].DS.$userProfile['id_card_pic'])) {
				if($userProfile['role_id'] == 3 || $userProfile['role_id'] == 2) {
						$profilePercentage += 10;
						
			} else {
				$profilePercentage += 5;
			}
			}

			if(!empty($userProfile['profile_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$userProfile['id'].DS.$userProfile['profile_pic'])) {
				if($userProfile['role_id'] == 3 || $userProfile['role_id'] == 2) {
						$profilePercentage += 10;
						
			} else {
				$profilePercentage += 5;
			}
			}
		
			if(!empty($userProfile['first_name'])) {
				
					if($userProfile['role_id'] == 3 || $userProfile['role_id'] == 2) {
					$profilePercentage += 3;
			}
			else {
				$profilePercentage += 2;

			}
			}
			if(!empty($userProfile['company_name'])) {
				
					if($userProfile['role_id'] == 3 || $userProfile['role_id'] == 2) {
					$profilePercentage += 3;
			}
			else {
				$profilePercentage += 2;

			}
			}
			if(!empty($userProfile['email'])) {
				$profilePercentage += 3;
			}
			if(!empty($userProfile['mobile_number'])) {
				
					if($userProfile['role_id'] == 3 || $userProfile['role_id'] == 2) {
					$profilePercentage += 4;
			}
			else {
				$profilePercentage += 3;

			}
			}
			if(!empty($userProfile['p_contact'])) {
				$profilePercentage += 3;
			}
			if(!empty($userProfile['address'])) {
				$profilePercentage += 3;
			}
			if(!empty($userProfile['locality'])) {
				
					if($userProfile['role_id'] == 3) {
					$profilePercentage += 3;
			}
			else {
				$profilePercentage += 2;

			}
			}
			if(!empty($userProfile['city_id'])) {
				$profilePercentage += 3;
			}
			if(!empty($userProfile['state_id'])) {
				$profilePercentage += 3;
			}
			if(!empty($userProfile['country_id'])) {
				$profilePercentage += 3;
			}
			if(!empty($userProfile['pincode'])) {
				$profilePercentage += 3;
			}
			if(!empty($userProfile['web_url'])) {
				$profilePercentage += 3;
			}
			if(!empty($userProfile['description'])) {
				
					if($userProfile['role_id'] == 3 || $userProfile['role_id'] == 2) {
					$profilePercentage += 3;
			}
			else {
				$profilePercentage += 2;

			}
			}
			if($userProfile['role_id'] == 3 ) {
				if(!empty($userProfile['hotel_rating'])) {
					$profilePercentage += 5;
				}
				if(!empty($userProfile['hotel_categories'])) {
					$profilePercentage += 5;
				}
			} 
			
			if($userProfile['role_id'] == 1 ) {
				if(!empty($userProfile['iata_pic'])) {
					$profilePercentage += 5;
				}
				if(!empty($userProfile['tafi_pic'])) {
					$profilePercentage += 5;
				}
				if(!empty($userProfile['taai_pic'])) {
					$profilePercentage += 5;
				}
				if(!empty($userProfile['iato_pic'])) {
					$profilePercentage += 5;
				}
            if(!empty($userProfile['adyoi_pic'])) {
					$profilePercentage += 5;
				}
				if(!empty($userProfile['iso9001_pic'])) {
					$profilePercentage += 5;
				}
				if(!empty($userProfile['uftaa_pic'])) {
					$profilePercentage += 5;
				}
				if(!empty($userProfile['adtoi_pic'])) {
					$profilePercentage += 5;
				}
			}
			echo '<p class="pro-complete">Profile Completeness';
			?>
			<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $profilePercentage; ?>"
				aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $profilePercentage; ?>%">
					<?php echo $profilePercentage; ?>%
				</div>
			</div>
            <div class="rating">
                <?php $userRating =  $this->request->session()->read('Auth.User.avrage_rating'); 
                //echo $userRating;
                if($userRating>0){
                    for($i=$userRating; $i>0; $i--){
                        echo '<i class="fa fa-star"></i>';
                    }
                }else{
                    
                }
                ?>
<span title="Average Rating"> <?php echo $userRating;?></span>
<?php $testimonialcount =  $this->request->session()->read('Auth.User.testimonialcount'); ?>
             <?php if($testimonialcount>0){?>
             <span title="Numbe of Users"> ( <?php echo $testimonialcount;?> )</span>
             <?php }?>
            </div>
            
		<?php
		}}
		?>
    </div>
	<div class="list">
		<?php if($this->request->session()->read('Auth.User.role_id') != 3){ ?>
			<div class="list-hotlier-req"><?php echo $this->Html->image('user-plus.png'); ?> <span><?php echo $this->Html->link(__('Finalized Requests'), ["controller"=>"Users", 'action' => 'finalizedRequestList'], ['escape' => false]) ?></span> </div>
		<?php } ?>
		<?php if($this->request->session()->read('Auth.User.role_id') == 1 ){ ?>
			<div class="list-hotlier-req"><?php echo $this->Html->image('finalized-response.png'); ?><span><?php echo $this->Html->link(__('Finalized Responses'), ["controller"=>"Users", 'action' => 'myFinalResponses'], ['escape' => false]) ?></span> </div>
			
			<div class="list-hotlier-req"><?php echo $this->Html->image('friend-ico.png'); ?> <span><?php echo $this->Html->link(__('Following'), ["controller"=>"Users", 'action' => 'businessBuddiesList'], ['escape' => false]) ?></span></div>
		<?php } ?>
		<?php if($this->request->session()->read('Auth.User.role_id') == 1 || $this->request->session()->read('Auth.User.role_id') == 2 ){ ?>
		<div class="list-hotlier-req"><?php echo $this->Html->image('delete-icon.png'); ?><span><?php echo $this->Html->link(__('Removed Requests'), ["controller"=>"Users", 'action' => 'removedRequestList'], ['escape' => false]) ?></span> </div>
	<?php } ?>

		<?php if($this->request->session()->read('Auth.User.role_id') == 3){ ?>
		<div class="list-hotlier-req"><?php echo $this->Html->image('finalized-response.png'); ?><span><?php echo $this->Html->link(__('Finalized Responses'), ["controller"=>"Users", 'action' => 'myFinalResponses'], ['escape' => false]) ?></span> </div>
		<div class="list-hotlier-req"><?php echo $this->Html->image('1_promotion.png'); ?><span>

		<?php echo $this->Html->link(__('Promotion Report'), ["controller"=>"Users", 'action' => 'promotionreports',$this->request->session()->read('Auth.User.id')], ['escape' => false]) ?></span> </div>
		<div class="list-hotlier-req"><?php echo $this->Html->image('friend-ico.png'); ?> <span><?php echo $this->Html->link(__('Following'), ["controller"=>"Users", 'action' => 'businessBuddiesList'], ['escape' => false]) ?></span></div>	
		<?php } ?>
		<div class="list-hotlier-req"><?php echo $this->Html->image('user-cross.png'); ?> <span><?php echo $this->Html->link(__('Blocked Users'), ["controller"=>"Users", 'action' => 'blockedUserList'], ['escape' => false]) ?></span> </div>

	</div>
</div>



