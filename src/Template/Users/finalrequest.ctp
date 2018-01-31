 <?php echo $this->element('header-back');?>
  <div class="row equal_column">
      <div class="col-md-3 col-sm-3 col-xs-12 left-panel">
        <div class="col-md-10 col-xs-offset-1 text-center col-xs-12">
          <div class="profile"><img src="/userimages/<?=($users['image'] !="")?$users['image']:"dummy.jpg" ?>" alt=""/></div>  

<h3><?php echo $users['first_name'] ?></h3> 
<h4>Email:-<?php echo $users['email'] ?></h4> 
<h4>Number:-<?php echo $users['mobile_number'] ?></h4>
          <a href="profileedit/<?php echo $users['id'] ?>">Edit Profile</a>
          

 </div>
  
  <div class="list">

<div class="list-hotlier-req"><?php echo $this->Html->image('friend-ico.png'); ?> <span>Business buddy</span> </div>
<div class="list-hotlier-req"><?php echo $this->Html->image('deal.png'); ?> <span>Close Deals</span> </div>
<div class="list-hotlier-req"><?php echo $this->Html->image('tick-ico2.png'); ?><span>Accept Deals</span> </div>


</div>     
          
       
      </div>
      
      <div class="right-panel">
	  <?php if($users['role_id'] == 2 ){ ?>
        <div class=" col-md-9 title">event planer requests</div>
	  <?php }  ?>
		<?php if($users['role_id'] == 3 ){ ?>
		   <div class=" col-md-9 title">hotailier response</div>
		<?php  } ?>
		<?php if($users['role_id'] == 1 ){ ?>
		   <div class=" col-md-9 title">Responed To Request</div>
		<?php  } ?>
        <?php echo $this->element('top_link');?>
      </div>
      <div class="col-md-9 col-sm-9 col-xs-12 right">
       <?php foreach($finals as $request){ ?>
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
		  <?php $uid = $request['user']['id']; ?>
		  <div class="col-md-4"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$uid)) ?>"><p>Name :- <?php echo $request['user']['first_name']; ?>&nbsp;&nbsp;<?php echo $request['user']['last_name']; ?></p></a></div>
		   <div class="col-md-4">Contact Number :- <?php echo $request['user']['mobile_number']; ?></div>
		    <div class="col-md-4">Email :- <?php echo $request['user']['email']; ?></div>
        <div class="col-md-5 col-sm-5 right link">
		<?php if($users['role_id'] == 3){ ?>
     <a href="#"><?php echo $this->Html->image('tick-ico.png'); ?> Show interest</a> 
		<?php }?>
		<?php if(($users['role_id'] == 1)) { 
		$rid = $request['id'];
		?>
     <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'myresponse',$rid)) ?>"><?php echo $this->Html->image('tick-ico.png'); ?> Show interest</a> 
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
    <div id="tra-tours" class="footemail"> <a href="mailto:Customercare@travelb2bhub.com">Customercare@travelb2bhub.com</a> </div>

<?php echo $this->element('footer');?>