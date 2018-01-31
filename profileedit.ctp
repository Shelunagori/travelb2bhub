 <?php echo $this->element('header-back');?>
  <div id="profile">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-12 left-panel">
        <div class="col-md-10 col-xs-offset-1 text-center col-xs-12">
          <div class="profile"><img src="/userimages/<?php echo $users['image'] ?>" alt=""/></div>
        <h3><?php echo $users['first_name'] ?></h3> 
<h4>Email:-<?php echo $users['email'] ?></h4> 
<h4>Number:-<?php echo $users['mobile_number'] ?></h4>
          <a href="profileedit/<?php echo $users['id'] ?>">Edit Profile</a>
          <div class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i></div>
          
          


 </div>
  
  <div class="list">
<div class="list-head">List of blocked user</div>

<div class="list-subhead">Blocked user</div>
<div class="list-user">Lorem ipsum 2<a href="#">Unblock</a></div>
<div class="list-user">Lorem ipsum <a href="#">Unblock</a></div>
<div class="list-user">Lorem ipsum <a href="#">Unblock</a></div>
<div class="list-user">Lorem ipsum <a href="#">Unblock</a></div>

</div>     
          
       
      </div>
      <div class="col-md-9 pro-top">
        <div class="col-md-12">
          <div class="col-md-3 col-sm-9 col-xs-12">
            <div class="title"><strong>Place Request</strong><br>
              20/100</div>
          </div>
          <div class="col-md-3 col-sm-9 col-xs-12">
            <div class="title"><strong>My Requests</strong><br>
              20/100</div>
          </div>
          <div class="col-md-3 col-sm-9 col-xs-12">
            <div class="title"><strong>Respond To Requests</strong><br>
              20/100</div>
          </div>
          <div class="col-md-3 col-sm-9 col-xs-12">
            <div class="title"><strong>My Responses</strong><br>
              20/100</div>
          </div>
        </div>
      </div>
      <div class="right-panel">
        <div class=" col-md-9 title">Edit Profile</div>
       <div class="col-md-3">
 <div id="top-link">
 <a href="#" class="link-icon"><?php echo $this->Html->image('notify.png'); ?></a>
<?php if($users['id'] != '') {?>
		  <a data-toggle="tooltip" title="Logout" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'logout')) ?>" class="link-icon"><?php echo $this->Html->image('logout.png'); ?></a> 
		  <?php } ?>
 <a href="#" class="link-icon"><?php echo $this->Html->image('search-icon.png'); ?></a>
 </div>
 </div>
      </div>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
        <div class="form">
            <?php $pararm = $users['id']; ?>
        <?php  
                        echo $this->Form->create(null, [
                                                            'type' => 'file',
                                                            'url' => ['controller' => 'Users', 'action' => 'edit',$pararm] 
                        ]); 
                    ?>
            <form method="post" action="">
			 <div class="col-xxs-6 col-xs-6 mt">
            <div class="input-field">
              <label for="from">First Name</label>
              <input type="text" class="form-control" name="address" value="<?php echo $users['first_name'] ?>" id="from-place" placeholder="Enter Here"/>
            </div>
          </div>
          <div class="col-xxs-6 col-xs-6 mt">
            <div class="input-field">
              <label for="from">Last Name</label>
              <input type="text" class="form-control" name="last_name" value="<?php echo $users['last_name'] ?>" id="from-place" placeholder="Enter Here"/>
            </div>
          </div>
		   <div class="col-xxs-6 col-xs-6 mt">
            <div class="input-field">
              <label for="from">Company Name</label>
              <input type="text" class="form-control" name="company_name" value="<?php echo $users['company_name'] ?>"" id="from-place" placeholder="Enter Here"/>
            </div>
          </div>
          <div class="col-xxs-6 col-xs-6 mt">
            <div class="input-field">
              <label for="from">Email</label>
              <input type="email" name="email" class="form-control" value="<?php echo $users['email'] ?>" id="from-place" placeholder="Enter Here"/>
            </div>
          </div>
             <div class="col-xxs-6 col-xs-6 mt">
            <div class="input-field">
              <label for="from">Primary Contact</label>
              <input type="text" class="form-control" value="<?php echo $users['mobile_number'] ?>" id="from-place" placeholder="Enter Here"/>
            </div>
          </div>
          <div class="col-xxs-6 col-xs-6 mt">
            <div class="input-field">
              <label for="from">Secondary Contact</label>
              <input type="text" name="p_contact" class="form-control" value="<?php echo $users['p_contact'] ?>" id="from-place" placeholder="Primary Contact Number"/>
            </div>
          </div>
          <div class="col-xxs-6 col-xs-6 mt">
            <div class="input-field">
              <label for="from">Address</label>
              <input type="text" class="form-control" name="address" value="<?php echo $users['address'] ?>" id="from-place" placeholder="Enter Here"/>
            </div>
          </div>
         
       
         
          <div class="col-xxs-6 col-xs-6 mt">
            <div class="input-field">
              <label for="from">City</label>
              <select name="city_id" class="form-control">
                <option value="" disabled selected>Enter Here</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div>
          </div>
          
          <div class="col-xxs-6 col-xs-6 mt">
            <div class="input-field">
              <label for="from">State</label>
              <select name="state_id" class="form-control">
                <option value="" disabled selected>Enter Here</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div>
          </div>
          
          <div class="col-xxs-6 col-xs-6 mt">
            <div class="input-field">
              <label for="from">Country</label>
              <select name="country_id" class="form-control">
                <option value="" disabled selected>Enter Here</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div>
          </div>
          
           <div class="col-xxs-6 col-xs-6 mt">
            <div class="input-field">
              <label for="from">FAX</label>
              <input type="text" name="fax" class="form-control" id="from-place" placeholder="Enter Here"/>
            </div>
          </div>
          
         
          
          
          
          <div class="margi1">
            <input type="submit" name="submit" class="btn btn-primary btn-block " value="Update Profile ">
          </div>
        </form>
        </div>
      </div>
    </div>
    <div id="tra-tours" class="footemail"> <a href="mailto:Contactus@travelb2bhub.com">Contactus@travelb2bhub.com</a> </div>

<?php echo $this->element('footer');?>