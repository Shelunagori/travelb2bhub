
<div id="profile" class="container-fluid">
<div class="row tra-section-gray equal_column">
 <div class="col-md-3 col-sm-3 col-xs-12 left-panel">			
    
       <div class="col-md-10 col-xs-offset-1 text-center col-xs-12">			



<div class="profile"><img src="/userimages/<?php echo $users['image'] ?>" alt=""/></div>  

<h3><?php echo $users['first_name'] ?></h3> 
<h4>Email:-<?php echo $users['email'] ?></h4> 
<h4>Number:-<?php echo $users['mobile_number'] ?></h4> 
<a href="profileedit/<?php echo $users['id'] ?>">Edit Profile</a>   
 <div class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i></div>
      </div>
 </div>
 <div class="right-panel">
 <div class=" col-md-9 title">My Profile</div>
<?php echo $this->element('top_link');?>
 </div>

  <div class="col-md-9 col-sm-9 col-xs-12 right">
					<div class="col-md-3 col-sm-6 tra-tours animate-box" data-animate-effect="fadeIn">
						<div href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'sendrequest')) ?>"><?php echo $this->Html->image('team2.png', ['class' => 'img-responsive']); ?>
							<div class="description">
							<span>Place Request</span>
								<div class="icon-head"><?php echo $this->Html->image('hand-icon.png'); ?> 200</div>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 tra-tours animate-box" data-animate-effect="fadeIn">
						<div href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'myrequest')) ?>"><?php echo $this->Html->image('team2.png', ['class' => 'img-responsive']); ?>
							<div class="description">
								<span>My Request</span>
								<div class="icon-head"><?php echo $this->Html->image('tick-icon.png'); ?>  200</div>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
						</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 tra-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><?php echo $this->Html->image('team2.png', ['class' => 'img-responsive']); ?>
							<div class="description">
								
								<span>Responed to Request</span>
								<div class="icon-head"><?php echo $this->Html->image('back-icon.png'); ?> 200</div>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							</div>
						</div>
					</div>
                    <div class="col-md-3 col-sm-6 tra-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><?php echo $this->Html->image('team2.png', ['class' => 'img-responsive']); ?>
							<div class="description">
								<span>MyRespones</span>
								<div class="icon-head"><?php echo $this->Html->image('edit-icon.png'); ?> 200</div>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							</div>
						</div>
					</div>

                    <h1>Discription</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt</p>
</div>
</div>
<?php echo $this->element('footer');?>