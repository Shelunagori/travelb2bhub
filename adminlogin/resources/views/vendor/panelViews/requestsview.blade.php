<div class=modal-content>
                                       <div class=modal-header>
                                          <button class=close data-dismiss=modal type=button>×</button>
<h4 class=modal-title><?php if($requests->category_id==1){ echo 'Package';}elseif($requests->category_id==2){echo 'Transport';}elseif($requests->category_id==3){echo 'Hotel';}?> Details</h4>
                                       </div>
	<div class=modal-body>
		<style>
			.table tr:hover {border-color: #777;}
.table tr:nth-child(even) {background: #f5f5f5;}
			.table tr:nth-child(odd) {background: #ffffff;}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{background-color: #fff;}
</style>
	<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">      
        General Details</a></li>
        <?php if($requests->category_id==1 || $requests->category_id==3){?>
         <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Stay Requirements</a></li>
         <?php }elseif($requests->category_id==2){?>
          <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Transport</a></li>
          <?php }?>
          <li role="presentation"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">Comments</a></li>
    </ul>
   
  
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab1">
   			<table class="table" style="width:100%">
        <tr><td>Reference Id: </td> <td> {{ $requests->reference_id }} </td></tr>
        <tr>
        <td>Locality: </td> <td> {{ $requests->locality }} </td>
         </tr> <tr>
        <td>Total Budget: </td> <td>Rs. {{ $requests->total_budget }} </td>
         </tr>
 			<tr>
        <td>Adult: </td> <td> {{ $requests->adult }} </td>
         </tr>
         <tr>
        <td>Children below 6: </td> <td> {{ $requests->children }} </td>
         </tr>
			<tr>
        <td>Agent Name: </td> <td> <?php echo $user[0]->first_name.' '.$user[0]->last_name;?> </td>
         </tr>
			</table>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab2">
        <?php if(count($hotels)>1){ ?>
       	@foreach( $hotels  as $index => $hotel) 
       <h4>Destination {{$index+1}}</h4>
        <table class="table" style="width:100%">
        <tr><td>Single: </td> <td> @if($hotel->room1 == '') --  @else {{ $hotel->room1 }} @endif  </td></tr>
        <tr>
        <td>Double: </td> <td>@if($hotel->room2 == '') --  @else {{ $hotel->room2 }} @endif </td>
         </tr> <tr>
        <td>Triple: </td> <td>@if($hotel->room3 == '') --  @else {{ $hotel->room3 }} @endif </td>
         </tr>
 			<tr>
        <td>Child With Bed: </td> <td>@if($hotel->child_with_bed == '') --  @else {{ $hotel->child_with_bed }} @endif </td>
         </tr>
         <tr>
        <td>Child Without Bed: </td> <td>@if($hotel->child_without_bed == '') --  @else {{ $hotel->child_without_bed }} @endif </td>
         </tr>
			<tr>
        <td>Hotel Rating: </td> <td>
@if($hotel->hotel_rating>0)
@for ($i = $hotel->hotel_rating; $i > 0; $i--)
       <i class="fa fa-star"></i>
    @endfor
@else -- @endif 
        </td>
         </tr>
        <tr> <td>Hotel Category: </td><td>
         <?php if(!empty($hotel->hotel_category)) {$res = explode(",", $hotel->hotel_category);
$hotel_category = "";
foreach($res as $row1) {
$hotel_category .= "".$hotelCategories[$row1]." or ";
}
echo substr($hotel_category, 0, -3);
}else{
echo '----';
}   
      ?> </td>
         </tr>
         <tr><td>Meal: </td> <td> <?php if(empty($hotel->meal_plan)){ echo "----"; }else{ echo $mealplans[$hotel->meal_plan]; }?>
			 </td>
         </tr>
         <tr><td>Check In: </td> <td> {{ $hotel->check_in }}</td></tr>
         <tr><td>Check Out: </td> <td>{{ $hotel->check_out }} </td></tr>
         <tr><td>Locality: </td> <td> {{ $hotel->locality }}</td></tr>
         <tr><td>Destination City: </td> <td><?php if(empty($hotel->city_id)){ echo $cities[$requests->city_id]; }else{ echo $cities[$hotel->city_id]; }?></td></tr>
         <tr><td>Destination State: </td> <td><?php if(empty($hotel->state_id)){ echo $states[$requests->state_id]; }else{ echo $states[$hotel->state_id]; }?>  </td></tr>
			</table>
        @endforeach
			<?php }else{?>
			@foreach( $hotels as $hotel) 
			<table class="table" style="width:100%">
        <tr><td>Single: </td> <td> @if($hotel->room1 == '') --  @else {{ $hotel->room1 }} @endif  </td></tr>
        <tr>
        <td>Double: </td> <td>@if($hotel->room2 == '') --  @else {{ $hotel->room2 }} @endif </td>
         </tr> <tr>
        <td>Triple: </td> <td>@if($hotel->room3 == '') --  @else {{ $hotel->room3 }} @endif </td>
         </tr>
 			<tr>
        <td>Child With Bed: </td> <td>@if($hotel->child_with_bed == '') --  @else {{ $hotel->child_with_bed }} @endif </td>
         </tr>
         <tr>
        <td>Child Without Bed: </td> <td>@if($hotel->child_without_bed == '') --  @else {{ $hotel->child_without_bed }} @endif </td>
         </tr>
			<tr>
        <td>Hotel Rating: </td> <td>
@if($hotel->hotel_rating>0)
@for ($i = $hotel->hotel_rating; $i > 0; $i--)
       <i class="fa fa-star"></i>
    @endfor
@else -- @endif 
        </td>
         </tr>
        <tr> <td>Hotel Category: </td> <td>      
      <?php if(!empty($hotel->hotel_category)) {$res = explode(",", $hotel->hotel_category);
$hotel_category = "";
foreach($res as $row1) {
$hotel_category .= "".$hotelCategories[$row1]." or ";
}
echo substr($hotel_category, 0, -3);
}else{
echo '----';
}   
      ?>  
		     
     </td>
         </tr>
         <tr><td>Meal: </td> <td><?php if(empty($hotel->meal_plan)){ echo "----"; }else{ echo $mealplans[$hotel->meal_plan]; }?>
			 </td>
         </tr>
         <tr><td>Check In: </td> <td> {{ $hotel->check_in }}</td></tr>
         <tr><td>Check Out: </td> <td>{{ $hotel->check_out }} </td></tr>
         <tr><td>Locality: </td> <td> {{ $hotel->locality }}</td></tr>
         <tr><td>Destination City: </td> <td><?php if(empty($hotel->city_id)){ echo $cities[$requests->city_id]; }else{ echo $cities[$hotel->city_id]; }?> </td></tr>
         <tr><td>Destination State: </td> <td>
<?php if(empty($hotel->state_id)){ echo $states[$requests->state_id]; }else{ echo $states[$hotel->state_id]; }?>         
          </td></tr>
			</table>
        @endforeach
			<?php }?>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab3">
          <table class="table" style="width:100%">
           <tr><td>Transport: </td> <td>
<?php echo ($requests->transport_requirement)?$transports[$requests->transport_requirement]:"-- --"; ?>           
           </td>
            <tr><td>Start Date: </td> <td>
<?php echo ($requests->start_date)?date("d/m/Y", strtotime($requests->start_date)):"-- --"; ?>            
            </td>
             <tr><td>End Date: </td> <td>
<?php echo ($requests->end_date)?date("d/m/Y", strtotime($requests->end_date)):"-- --"; ?>             
             </td>
              <tr><td>Pickup Locality: </td> <td><?php echo ($requests->pickup_locality)?$requests->pickup_locality:"-- --"; ?></td>
               <tr><td>Pickup City: </td> <td><?php echo ($requests->pickup_city)?$cities[$requests->pickup_city]:"-- --"; ?></td>
               <tr><td>Pickup State: </td> <td><?php echo ($requests->pickup_state)?$states[$requests->pickup_state]:"-- --"; ?></td>
               <?php if(!empty($request_stops)) { ?>
               <?php $stop_count=1; foreach($request_stops as $stops) {?>
               <tr><td colspan="2">Stop<?php echo $stop_count;?></td></tr>
             <tr><td>Stop Locality: </td> <td><?php echo ($stops->locality)?$stops->locality:"-- --"; ?></td>
                 <tr><td>Stop City: </td> <td><?php echo ($stops->city_id)?$cities[$stops->city_id]:"-- --"; ?></td>
                  <tr><td>Stop State: </td> <td><?php echo ($stops->state_id)?$states[$stops->state_id]:"-- --"; ?></td></tr>
               <?php }?>
               
               <?php }?>
                <tr><td>Final Locality: </td> <td><?php echo ($requests->final_locality)?$requests->final_locality:"-- --"; ?></td>
                 <tr><td>Final City: </td> <td><?php echo ($requests->final_city)?$cities[$requests->final_city]:"-- --"; ?></td>
                  <tr><td>Final State: </td> <td><?php echo ($requests->final_state)?$states[$requests->final_state]:"-- --"; ?></td></tr>
           </table>     
        </div>
        <div role="tabpanel" class="tab-pane" id="tab4">
        <p>{{$requests->comment}}</p>
        </div>
    </div>
</div>
	</div>
                                    </div>
