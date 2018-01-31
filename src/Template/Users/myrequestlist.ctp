 <?php echo $this->element('header-back');?>
  <div class="container-fluid">
    <div class="row equal_column">
      <div class="col-md-3 col-sm-3 col-xs-12 left-panel">
        <div class="col-md-10 col-xs-offset-1 text-center col-xs-12">
          <div class="profile"><img src="/userimages/<?php echo $users['image'] ?>" alt=""/></div>  

<h3><?php echo $users['first_name'] ?></h3> 
<h4>Email:-<?php echo $users['email'] ?></h4> 
<h4>Number:-<?php echo $users['mobile_number'] ?></h4>
          <a href="#">Edit Profile</a>
          

 </div>
  
  <div class="list">

<div class="list-hotlier-req"><?php echo $this->Html->image('friend-ico.png'); ?> <span>Business Buddy</span> </div>
<div class="list-hotlier-req"><?php echo $this->Html->image('deal.png'); ?> <span>Finalized Requests</span> </div>
<div class="list-hotlier-req"><?php echo $this->Html->image('del.png'); ?><span>Removed Requests</span> </div>


</div>
      </div>
      <div class="col-md-9 pro-top">
        <div class="col-md-12">
          <div class="col-md-3 col-sm-9 col-xs-offset-3 col-xs-12">
            <div class="title"><strong>Respond</strong><br>
              20</div>
          </div>
          <div class="col-md-3 col-sm-9 col-xs-12">
            <div class="title"><strong>Finalized Responses</strong><br>
              50</div>
          </div>
         
        </div>
      </div>
      <div class="right-panel">
        <div class=" col-md-9 title">My Requests</div>
        <div class="col-md-3">
          <div id="top-link"> <a href="#" class="link-icon"><?php echo $this->Html->image('notify.png'); ?></a> <a href="#" class="link-icon"><?php echo $this->Html->image('logout.png'); ?></a> <a href="#" class="link-icon"><?php echo $this->Html->image('search-icon.png'); ?></a> </div>
        </div>
      </div>
      <div class="col-md-9 col-sm-9 col-xs-12 right">
       <?php foreach($requests as $request){ ?>
       <div class="box-event">
       <div class="col-md-4">Agent Name :- <?php echo $request['user']['first_name']; ?></div>
       <div class="col-md-4">Booking Type :- <?php echo $request['city']['name']; ?></div>
        <div class="col-md-4">Hotel Rating :- <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i></div>
        <div class="col-md-4">Total Budget :- <?php echo $request['total_budget']; ?>/-</div>
        <div class="col-md-4">Quote Price :- <?php echo $request['total_budget']; ?></div>
        
        <div class="col-md-7 col-sm-7 right link">
     <a href="#"><?php echo $this->Html->image('tick-ico.png'); ?> Check Responses</a> <a href="#"><?php echo $this->Html->image('detail-ico.png'); ?> View Details</a> <a href="#">
     <?php echo $this->Html->image('chat-ico.png'); ?> Remove Request</a>
        </div>
       </div>
       <?php }?>
       
       
       <div class="col-md-5 col-xs-offset-7 right"><ul class="pagination">
    <li><a href="#">&laquo;</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&raquo;</a></li>
</ul></div>
        
        
      </div>
    </div>
    </div>


<?php echo $this->element('footer');?>