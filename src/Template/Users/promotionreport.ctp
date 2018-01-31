<div id="removed_request_list" class="container-fluid">
	<div class="row equal_column">
      <?php echo $this->element('left_panel');?>

      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 padding0">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 border_bottom">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 ">
                <h4 class="title">Promotion Report</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 ">
                <!--<a href="javascript:void(0)" onclick="window.history.back();">Go Back</a>-->
                                        <!-- <a href="/users/dashboard" class="link-icon"><img src="/img/arrow.png" alt=""/></a> -->
                <ul class="top-icons-wrap"><ul class="top-icons-wrap">
                                     
                 <li>
 <a href="javascript:void(0);" class="link-icon" data-toggle="modal" data-target="#myModal122" ><img src="/img/white-filter.png" alt=""></a> </li>
					<li class="notification_list"> 
                            <a href="javascript:void(0);" class="link-icon"><img src="/img/notify.png" alt=""></a>
                            <div class="ap-subs">
                                <ul class="list-unstyled msg_list" role="menu">
                               
                  <?php echo $this->element('subheader');?>
			
          <hr class="hr_bordor">
		<div class="col-md-12 col-md-12 col-sm-12 col-xs-12 margin-b20" >	
                    <?php if(count($promotionreport)>0){?>
<div class="text-center" >
                    <table class="table-responsive table-bordered table-striped xyz" >
                    <thead class="thead-inverse">
                        <tr><th  class="text-center hidden-xs">Sno.</th><th  class="text-center">Date of Promotion</th><th  class="text-center">Duration (Months)</th><th  class="text-center"> Cities </th><th  class="text-center"> Views </th></tr>
                    </thead>
                    <tbody>
                  <?php $i=1;
//print_r($promotionreport);
 foreach($promotionreport as $pr) { 

?>
                     
                  <tr>  <td class="text-center hidden-xs" valign="top"><?php echo $i; ?></td><td class="text-center" valign="top"><?php echo date("d/m/Y", strtotime($pr['created_at'])); ?></td> 
<td class="text-center" valign="top"><?php echo $pr['duration']; ?></td><td valign="top" class="text-center" ><?php if($pr['cities']!==""){

$cityarray = explode(',',$pr['cities']);
foreach($cityarray as $cityid){
 $state_id = $allStates[$allCities1[$cityid]];
$resultstr[] = $allCities[$cityid].' ('.$state_id.')';

}

echo implode(", ",$resultstr);
}

$resultstr ='';
 ?></td><td valign="top" class="text-center" style="color: #1c6f7d !important;"><strong><?php echo $pr['count']; ?></strong></td>
 </tr>
                        
                    <?php $i++; } ?>
                  </tbody>
  					</table> </div><?php }else{?>
  					<p>To promote your hotel  <a style=" color: #1c6f7d;font-weight: 600;text-decoration: underline;" href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'promotions')) ?>">click here</a></p>
  					<?php }?>
                </div>

      </div>
    </div>
</div>
</div>

  
<?php echo $this->element('footer');?>
