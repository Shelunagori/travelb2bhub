<?php
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
?>
<div class=container-fluid id=requestlist>
<div class="row equal_column">
<?php echo $this->element('left_panel');?>
<div class="col-xs-12 padding0 col-lg-9 col-md-9 col-sm-9">
   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding0 border_bottom">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
         <h4 class=title>My Requests</h4>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
         <ul class=top-icons-wrap>
         <li><a href=javascript:void(0); class=link-icon data-target=#myModal123 data-toggle=modal><img alt=""src=/img/sortarrow.png></a>
         <li><a href=javascript:void(0); class=link-icon data-target=#myModal122 data-toggle=modal><img alt=""src=/img/white-filter.png></a>
         <li class="notification_list">
            <a href=javascript:void(0); class=link-icon id=chat_icon><span class=chat_count><?php echo $chatCount;?></span><img alt=""src=/img/notify.png></a>
            <div class=ap-subs>
               <ul class="list-unstyled msg_list"role=menu>
               <?php echo $this->element('subheader');?>
               <hr class=hr_bordor>
               <div class=col-md-12><?php echo  $this->Flash->render() ?></div>
               <div class="fade modal form-modal"id=myModal123 role=dialog>
                  <div class=modal-dialog>
                     <div class=modal-content>
                        <div class=modal-header>
                           <button class=close data-dismiss=modal type=button>×</button>
                           <h4 class=modal-title>Sorting</h4>
                        </div>
                        <div class=modal-body>
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box-event">
                                 <ul class=sorting_ul>
                                    <li class="col-xs-12 col-sm-12 col-md-12"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>?sort=totalbudgethl">Total Budget (High To Low) <span class=arrow><span></span></span></a>
                                    <li class="col-xs-12 col-sm-12 col-md-12"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>?sort=totalbudgetlh">Total Budget (Low To High) <span class=arrow><span></span></span></a>
                                    <li class="col-xs-12 col-sm-12 col-md-12"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>?sort=resposesnolh">No. of Responses (Low To High) <span class=arrow><span></span></span></a>
                                    <li class="col-xs-12 col-sm-12 col-md-12"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>?sort=resposesnohl">No. of Responses (High To Low) <span class=arrow><span></span></span></a>
                                    <li class="col-xs-12 col-sm-12 col-md-12"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>?sort=requesttype">Request Type <span class=arrow><span></span></span></a>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class=modal-footer></div>
                     </div>
                  </div>
               </div>
               <div class="fade modal form-modal"id=myModal122 role=dialog>
                  <div class=modal-dialog>
                     <div class=modal-content>
                        <div class=modal-header>
                           <button class=close data-dismiss=modal type=button>×</button>
                           <h4 class=modal-title>Filter</h4>
                        </div>
                        <div class=modal-body>
                           <form class=filter_box>
                              <div class="row form-group margin-b10">
                                 <label class="col-form-label col-md-3"for=example-text-input>Request Type:</label>
                                 <div class=col-md-9>
                                    <select class=form-control name=req_typesearch>
                                       <option value="">Select Request Type
                                       <option value=1>Package
                                       <option value=3>Hotel
                                       <option value=2>Transport
                                    </select>
                                 </div>
                              </div>
                              <div class="row form-group margin-b10">
                                 <label class="col-form-label col-md-3"for=example-text-input>Total Budget:</label>
                                 <div class=col-md-9>
                                    <select class=form-control name=budgetsearch>
                                       <option value="">Select Total Budget
                                       <option value=0-10000<?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="0-10000")? 'selected':''; ?>>0-10000
                                       <option value=10000-30000<?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="10000-30000")? 'selected':''; ?>>10000-30000
                                       <option value=30000-50000<?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="30000-50000")? 'selected':''; ?>>30000-50000
                                       <option value=50000-100000<?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="50000-100000")? 'selected':''; ?>>50000-100000
                                       <option value=100000-100000000000<?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="100000-100000000000")? 'selected':''; ?>>100000-Above
                                    </select>
                                 </div>
                              </div>
                              <div class="row form-group margin-b10">
                                 <label class="col-form-label col-md-3"for=example-text-input>Start Date:</label>
                                 <div class=col-md-9><input class=form-control name=startdatesearch value="<?php echo isset($_GET['startdatesearch'])? $_GET['startdatesearch']:''; ?>"id=datepicker1></div>
                              </div>
                              <div class="row form-group margin-b10">
                                 <label class="col-form-label col-md-3"for=example-text-input>End Date:</label>
                                 <div class=col-md-9><input class=form-control name=enddatesearch value="<?php echo isset($_GET['enddatesearch'])? $_GET['enddatesearch']:''; ?>"id=datepicker2></div>
                              </div>
                              <div class="row form-group margin-b10">
                                 <label class="col-form-label col-md-3"for=example-text-input>Pickup City:</label>
                                 <div class=col-md-9>
                                    <select class=form-control name=pickup_city id=pickup_city>
                                       <option value="">Select</option>
                                       <?php foreach($allCities1 as $city){?>
                                       <option value="<?php echo $city['value'];?>"<?php if(isset($_GET['pickup_city']) AND $_GET['pickup_city']==$city['value']){ echo 'selected'; }?>><?php echo $city['label'];?></option>
                                       <?php }?>
                                    </select>
                                 </div>
                              </div>
                              <div class="row form-group margin-b10">
                                 <label class="col-form-label col-md-3"for=example-text-input>Destination City:</label>
                                 <div class=col-md-9>
                                    <select class=form-control name=destination_city id=destination_city>
                                       <option value="">Select</option>
                                       <?php foreach($allCities1 as $city){?>
                                       <option value="<?php echo $city['value'];?>"<?php if(isset($_GET['destination_city']) AND $_GET['destination_city']==$city['value']){ echo 'selected'; }?>><?php echo $city['label'];?></option>
                                       <?php }?>
                                    </select>
                                    <?php //echo $this->Form->control('preference', ["id"=>"destination_city", "type"=>"select", 'options' =>$allCities2, "class"=>"form-control"]); ?>
                                 </div>
                              </div>
                              <div class="row form-group margin-b10">
                                 <label class="col-form-label col-md-3"for=example-text-input>Reference ID:</label>
                                 <div class=col-md-9><input class=form-control name=refidsearch value="<?php echo isset($_GET['refidsearch'])? $_GET['refidsearch']:''; ?>"></div>
                              </div>
                              <div class="row form-group margin-b10">
                                 <label class="col-form-label col-md-3"for=example-text-input>Members:</label>
                                 <div class=col-md-9><input class=form-control name=memberssearch value="<?php echo isset($_GET['memberssearch'])? $_GET['memberssearch']:''; ?>"></div>
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center"><input class="btn btn-primary btn-submit"name=submit value=Submit type=submit> <a href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'requestlist')) ?>"class="btn btn-primary btn-submit">Reset</a></div>
                           </form>
                           <script>$(document).ready(function(){$("#datepicker1").datepicker({dateFormat:"dd/mm/yy",changeMonth:!0,changeYear:!0,minDate:"<?php echo date("d/m/Y"); ?>",onSelect:function(e){$("#datepicker2").datepicker("option","minDate",e),$("#datepicker2").val("")}})}),$("#datepicker2").datepicker({dateFormat:"dd/mm/yy",changeMonth:!0,changeYear:!0,minDate:"<?php echo date("d/m/y"); ?>",onSelect:function(e){""==$("#datepicker1").val()&&(alert("Please select check-in date first."),$("#datepicker2").val(""))}})</script>
                        </div>
                        <div class=modal-footer></div>
                     </div>
                  </div>
               </div>
				<div id="autorefresh_requestlist">
               <?php if(isset($_GET['sort']) && $_GET['sort']=="resposesnolh") { ?><script>$(document).ready(function(){$(".req").sort(function(n,e){return parseInt(n.id)>parseInt(e.id)}).each(function(){var n=$(this);n.remove(),$(n).appendTo("#cat")})})</script><?php } ?><?php if(isset($_GET['sort']) && $_GET['sort']=="resposesnohl") { ?><script>$(document).ready(function(){$(".req").sort(function(n,e){return parseInt(n.id)<parseInt(e.id)}).each(function(){var n=$(this);n.remove(),$(n).appendTo("#cat")})})</script><?php } ?><?php if(isset($_GET['sort']) && $_GET['sort']=="requesttype") { ?><script>$(document).ready(function(){$(".req").sort(function(n,e){return parseInt(n.id)>parseInt(e.id)}).each(function(){var n=$(this);n.remove(),$(n).appendTo("#cat")})})</script><?php } ?><?php
                  if(count($requests) >0) {
                  $m =0;
                  foreach($requests as $request){ 
                  $totmem = $request['adult'] +   $request['children']; 
                  if(isset($_GET['memberssearch']) && $_GET['memberssearch']!="" && $_GET['memberssearch'] !=$totmem ){
                  continue;
                  }
                  if($m%2==0) { echo '<div class="clearfix"></div>'; 
                  }
                  $m++;
                  ?>
               <div id=cat>
                  <?php if(isset($_GET['sort']) && $_GET['sort']=="requesttype") { ?>
                  <div class="col-xs-12 col-sm-12 col-lg-6 col-md-6 req"id="<?php if($request['category_id']==1){ echo "1";} if($request['category_id']==2){ echo "3";}if($request['category_id']==3){ echo "2";} ?>">
                     <?php } else { ?>
                     <div class="col-xs-12 col-sm-12 col-lg-6 col-md-6 req"id="<?php echo $data['responsecount'][$request['id']]; ?>">
                        <?php } ?>
                        <div class=box-event id="request-<?php echo $request['id']; ?>">
                           <ul>
                              <li class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
                                 <p><b>Request Type: </b><?php if($request['category_id']==1){ echo "<img src='../img/slider/package-icon.png'><span class='package'>Package</span>";} if($request['category_id']==2){ echo "<img src='../img/slider/transport-icon.png'><span class='transport'>Transport</span>";}if($request['category_id']==3){ echo "<img src='../img/slider/hotelier-icon.png'><span class='hotel'>Hotel</span>";} ?>
                              <li class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
                                 <p><b>Total Budget: </b>Rs.<?php echo $request['total_budget']; ?>
                              </li>
                              <?php if($request['category_id'] == 3 ) { ?>
                              <li class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
                                 <p><b>Start Date: </b><?php echo ($request['check_in'])?date('d/m/Y',strtotime($request['check_in'])):"-- --"; ?>
                              <li class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
                                 <p><b>End Date: </b><?php echo ($request['check_out'])? date('d/m/Y',strtotime($request['check_out'])):"-- --"; ?>
                              </li>
                              <?php }
                                 elseif($request['category_id'] == 1 ) { 
                                 $sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$request['id']."'";
                                 $stmt = $conn->execute($sql);
                                 $result = $stmt->fetch('assoc');	                 
                                 ?>
                              <li class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
                                 <p><b>Start Date: </b><?php echo ($request['check_in'])?date('d/m/Y',strtotime($request['check_in'])):"-- --"; ?>
                              <li class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
                                 <p><?php if(!empty($result['TopDate'])) { ?><b>End Date: </b><?php echo date('d/m/Y',strtotime($result['TopDate'])); ?><?php }else{?><b>End Date: </b><?php echo ($request['check_out'])?date('d/m/Y',strtotime($request['check_out'])):"-- --"; ?><?php }?>
                              </li>
                              <?php }
                                 elseif($request['category_id'] == 2 ) { ?>
                              <li class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
                                 <p><b>Start Date: </b><?php echo ($request['start_date'])?date('d/m/Y',strtotime($request['start_date'])):"-- --"; ?>
                              <li class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
                                 <p><b>End Date: </b><?php echo ($request['end_date'])?date('d/m/Y',strtotime($request['end_date'])):"-- --"; ?>
                              </li>
                              <?php } ?>
                              <li class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
                                 <p><b>Reference ID: </b><?php echo $request['reference_id']; ?>
                              <li class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
                                 <p><b>Members: </b><?php echo $request['adult'] +   $request['children']; ?>
                              <li class="col-xs-12 col-sm-12 col-md-12 col-lg-12 destination">
                                 <?php if($request['category_id']==2){ ?>
                                 <p><b>Pickup City: </b><?php echo ($request['pickup_city'])?$allCities[$request['pickup_city']]:"-- --"; ?><?php echo ($request['pickup_state'])?' ('.$allStates[$request['pickup_state']].')':"";  ?><?php } else { ?>
                                 <p><b>Destination City: </b><?php echo ($request['city_id'])?$allCities[$request['city_id']]:"-- --"; ?><?php echo ($request['state_id'])?' ('.$allStates[$request['state_id']].')':""; ?><?php if($request['category_id'] == 1){
                                    if(count($request['hotels']) >1) {
                                    unset($request['hotels'][0]);?><?php
                                    foreach($request['hotels'] as $row) { ?><?php echo ($row['city_id'])?', '.$allCities[$row['city_id']]:""; ?><?php echo ($row['state_id'])?' ('.$allStates[$row['state_id']].')':""; ?><?php } ?><?php } ?><?php } ?></</p>
                                 <?php } ?>
                              <li class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment">
                                 <p><b>Comment: </b><span><?php echo $request['comment']; ?></span>
                           </ul>
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding0 link right">
                              <?php $pid = $request['id'];?>
                              <div class="col-xs-12 col-lg-6 col-md-6 col-sm-6 padding0"><a class="viewdetail" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'viewdetails',$request['id'])) ?>"data-target="#myModal1<?php echo $request['id']; ?>"data-toggle=modal><?php echo $this->Html->image('detail-ico.png'); ?> Details</a></div>
                              <div class="fade modal"id="myModal1<?php echo $request['id']; ?>"role=dialog>
                                 <div class=modal-dialog>
                                    <div class=modal-content>
                                       <div class=modal-header>
                                          <button class=close data-dismiss=modal type=button>×</button>
                                          <h4 class=modal-title>Details</h4>
                                       </div>
                                       <div class=modal-body></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-lg-6 col-md-6 col-sm-6 padding0"><a href=javascript:void(0); class=removeRequest request_id="<?php echo $pid; ?>"><?php echo $this->Html->image('remove-request.png'); ?>Remove Request</a></div>
                              <div class="col-xs-12 col-lg-6 col-md-6 col-sm-6 padding0 check_responses" id="checkresponse_<?php echo $request['id'];?>"><?php if($data['responsecount'][$pid] > 0 ) { ?><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$pid)) ?>"class=check_responses_btn><?php echo $this->Html->image('tick-ico.png'); ?> Check Responses ( <strong><?php echo $data['responsecount'][$pid]; ?></strong> ) </a><?php } else { ?><a href=# class=check_responses_btn><img alt=""src=/img/no-response-ico.png> No Response ( 0 ) </a><?php } ?></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
                  <div class=pages></div>
                  <?php }else {?>
                  <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box-event text-center">
<?php if(isset($_GET['req_typesearch'])){ echo "No matching data.";}else{ echo "There is no request in the mailbox.";}?></div>
                  </div>
                  <?php } ?>
				</div>				  
               </div>
            </div>
      </div>
   </div>
</div>				  
<?php echo $this->element('footer');?>
					  <?php
$servername = $_SERVER['HTTP_HOST'];
if($servername =='192.168.3.82' OR $servername=='192.168.3.52' OR $servername=='localhost'){
	$serverurl = 'http://'.$servername.'/travelb2bhub/';
	}else{
	$serverurl = 'http://'.$servername.'/';
	}
?>
<script>
    $(document).ready(function() {
        $(".removeRequest").click(function(e) {
			$('#ajaxcount').val('100000');
            e.preventDefault();
            var t = $(this).attr("request_id");
            confirm("Are you sure want to remove this request?") && $.ajax({
                url: "<?php echo $this->Url->build(array('controller'=>'users','action'=>'removeRequest')) ?>",
                type: "POST",
                data: {
                    request_id: t
                }
            }).done(function(e) {
                1 == e ? (alert("Request has been removed successfully."), $("#request-" + t).slideUp(800, "linear")): alert("There is some problem, please try again.")
            })
        });
		
	getmyrequestlistsapi(5000);
		
	function getmyrequestlistsapi(){
	var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'getmyrequestlistsapi')) ?>";
	$.ajax({ url:url,
			 type: 'POST',
			 data: {getres:'1'}
			}).done(function(result){
		var object = JSON.parse(result);
		//console.log(result);
		$.each(object, function(index, value) {
			var chres_id = "#chatcounts_"+index;
			if(value>0)
			{
			var res_html = '<a href="<?php echo $serverurl;?>users/checkresponses/'+index+'" class="check_responses_btn"><?php echo $this->Html->image("tick-ico.png"); ?> Check Responses ( <strong>'+value+'</strong> ) </a>';
			$(chres_id).html(res_html);	
			}
			
			});
		});
    setTimeout(getmyrequestlistsapi, 5000);
		}
    });
</script>