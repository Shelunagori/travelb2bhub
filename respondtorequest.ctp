 <?php echo $this->element('header-back1');?>
  <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-12 left-panel">
        <div class="col-md-10 col-xs-offset-1 text-center col-xs-12">
          <div class="profile"><img src="/userimages/<?php echo $users['image'] ?>" alt=""/></div>  

<h3><?php echo $users['first_name'] ?></h3> 
<h4>Email:-<?php echo $users['email'] ?></h4> 
<h4>Number:-<?php echo $users['mobile_number'] ?></h4>
          <a href="profileedit/<?php echo $users['id'] ?>">Edit Profile</a>
          

 </div>
  
  <div class="list">

<div class="list-hotlier-req"><?php echo $this->Html->image('friend-ico.png'); ?> <span>Business buddy</span> </div>
<div class="list-hotlier-req"><?php echo $this->Html->image('deal.png'); ?> <span>Finalized Requests</span> </div>
<div class="list-hotlier-req"><?php echo $this->Html->image('Trash_Can-512.png'); ?><span>Removed Requests</span> </div>


</div>     
          
       
      </div>
      <div class="col-md-9 pro-top">
        <div class="col-md-12">
          <div class="col-md-3">
              <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'sendrequest')) ?>"><div class="title"><strong>	Place Request</strong><br>
                      <?php echo $number; ?></div></a>
          </div>
         
          <div class="col-md-3">
              <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>"> <div class="title"><strong>		My Requests</strong><br>
                      <?php echo $number; ?></div></a>
          </div>
     
		  <div class="col-md-3">
             <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>"> <div class="title act"><strong>Respond To Requests</strong><br>
                     <?php echo $numbers; ?></div></a>
          </div>
          <div class="col-md-3">
             <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'myresponselist')) ?>"> <div class="title"><strong>My Responses</strong><br>
                     <?php echo $respond; ?></div></a>
          </div>
         
        </div>
      </div>
      <div class="right-panel">
	  <?php if($users['role_id'] == 2 ){ ?>
        <div class=" col-md-9 title">Event Planner Requests</div>
	  <?php }  ?>
		<?php if($users['role_id'] == 3 ){ ?>
		   <div class=" col-md-9 title">Hotelier Responses</div>
		<?php  } ?>
		<?php if($users['role_id'] == 1 ){ ?>
		   <div class=" col-md-9 title">Respond to Requests</div>
		<?php  } ?>
        <div class="col-md-3">
          <div id="top-link"> <a href="#" class="link-icon"><?php echo $this->Html->image('notify.png'); ?></a> 
		  <?php if($users['id'] != ''){ ?>
		  <a data-toggle="tooltip" title="Logout" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'logout')) ?>" class="link-icon"><?php echo $this->Html->image('logout.png'); ?></a> 
		  <?php } ?>
		  <a href="#" class="link-icon"><?php echo $this->Html->image('search-icon.png'); ?></a> </div>
        </div>
      </div>
      <div class="col-md-9 col-sm-9 col-xs-12 right">
       <?php foreach($requests as $request){ ?>
       <div class="box-event">
	    <div class="col-md-4">Refrence Id :- <?php echo $request['reference_id']; ?></div>
		<?php if($request['category_id'] == 3 ) {
			$check =  explode(",",$request['check_in']);
			
			$checkout =  explode(",",$request['check_out']);
			$vb = end($checkout);
			
			
			?>
       <div class="col-md-4">Start Date :- <?php echo $check[0]; ?></div>
	   	   <div class="col-md-4">End Date :- <?php echo $vb; ?></div>
		<?php } ?>
		         <?php if($request['category_id'] == 1 ) {
			$check =  explode(",",$request['check_in']);
			?>
       <div class="col-md-4">Start Date :- <?php echo $check[0]; ?></div>
	   	   <div class="col-md-4">End Date :- <?php echo $request['end_date']; ?></div>
		<?php } ?>
		<?php if($request['category_id'] == 2 ) {?>
       <div class="col-md-4">Start Date :- <?php echo $request['start_date']; ?></div>
	   	   <div class="col-md-4">End Date :- <?php echo $request['end_date']; ?></div>
		<?php } ?>

       <div class="col-md-4">Total Budget :- <?php echo $request['total_budget']; ?>/-</div>
        <div class="col-md-4">Request Type :- <?php if($request['category_id']==1){ echo "Package";} if($request['category_id']==2){ echo "Transport";}if($request['category_id']==3){ echo "Hotel";} ?></div>
         <div class="col-md-4">Adults :- <?php echo $request['adult']; ?></div>
		 <div class="col-md-4">Comment :- <?php echo $request['comment']; ?></div>
        <div class="col-md-5 col-sm-5 right link">
		<?php if($users['role_id'] == 3){ ?>
     <a href="#"><?php echo $this->Html->image('tick-ico.png'); ?> Show interest</a> 
		<?php }?>
		<?php if(($users['role_id'] == 1)) { ?>
     <a data-toggle="modal" data-target="#myModal" href="#"><?php echo $this->Html->image('tick-ico.png'); ?> Show interest</a> 
		<?php }?>
		<?php if(($users['role_id'] == 2)) { ?>
     <a href="#"><?php echo $this->Html->image('tick-ico.png'); ?> Check Responses</a> 
		<?php }?>
		<?php $id = $request['id'];?>
	  <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'viewdetails',$id)) ?>"><?php echo $this->Html->image('detail-ico.png'); ?> Details</a>
	  <a href="<?php echo $request['id']; ?>">
     <?php echo $this->Html->image('chat-ico.png'); ?> Chat </a>
        </div>
       </div>
       <?php }?>
       
       
    <!--  <div class="col-md-5 col-xs-offset-7 right"><ul class="pagination">
    <li><a href="#">&laquo;</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&raquo;</a></li>
</ul></div>-->
        
        
      </div>
    </div>
    <div id="tra-tours" class="footemail"> <a href="mailto:Contactus@travelb2bhub.com">Contactus@travelb2bhub.com</a> </div>
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<?php echo $this->element('footer');?>