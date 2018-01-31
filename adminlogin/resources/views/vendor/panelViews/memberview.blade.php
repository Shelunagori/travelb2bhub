@extends('panelViews::mainTemplate')
@section('page-wrapper')


@foreach( $users as $user)
<style>
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{background-color: #fff;}
</style>
<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">User Information</a></li>
        <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Accomodation</a></li>
         <li role="presentation"><a href="#tab3" aria-controls="tab2" role="tab" data-toggle="tab">Transport</a></li>
          <li role="presentation"><a href="#tab4" aria-controls="tab2" role="tab" data-toggle="tab">Payment</a></li>
    </ul>
   
  
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab1">
   <table class="table" style="width:50%">
       
        <tr>
        <td>Name: </td> <td> {{ $user->name }} </td>
         </tr> <tr>
        <td>Email: </td> <td> {{ $user->email }} </td>
         </tr> <tr>
        <td>Password: </td> <td> {{ $user->password }} </td>
         </tr> <tr>
        <td>Mobile: </td> <td> {{ $user->mobile_no }} </td>
         </tr> <tr>
        <td>Entity Type: </td> <td> {{ $user->entity_type }} </td>
         </tr>
         <tr>
        <td>RTI Type: </td> <td> {{ $user->rti_type }} </td>
         </tr> 
          <tr>
        <td>Entry With: </td> <td> {{ $user->entry_with }} </td>
         </tr> <tr>
        <td>Spouse Name: </td> <td> {{ $user->spouse_name }} </td>
         </tr> <tr>
        <td>Spouse Number: </td> <td> {{ $user->spouse_number }} </td>
         </tr> <tr>
        <td>Circler Type: </td> <td> {{ $user->circler_type }} </td>
         </tr> <tr>
        <td>Circler Number: </td> <td> {{ $user->circler_number }} </td>
         </tr> <tr>
        <td>Area: </td> <td> {{ $user->area }} </td>
         </tr> <tr>
        <td>Table Number: </td> <td> {{ $user->table_no }} </td>
         </tr> <tr>
        <td>Address: </td> <td> {{ $user->address }} </td>
         </tr> <tr>
        <td>Country: </td> <td> {{ $user->country }} </td>
         </tr> <tr>
        <td>State: </td> <td> {{ $user->state }} </td>
         </tr> <tr>
        <td>City: </td> <td> {{ $user->city }} </td>
         </tr> <tr>
        <td>Pincode: </td> <td> {{ $user->pincode }} </td>
         </tr> 
        
        
        </table>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab2">
			 <table class="table" style="width:50%">
       
        <tr>
          <td>Room Type: </td> <td> {{ $user->room_type }} </td>
         </tr> <tr>
          <td>Hotel Name: </td> <td> {{ $user->hotel_name }} </td>
         </tr> <tr>
          <td>Check In: </td> <td> {{ $user->check_in }} </td>
         </tr> <tr>
          <td>Check Out: </td> <td> {{ $user->check_out }} </td>
         </tr> 
          <td>Accomodation Instruction: </td> <td> {{ $user->accomodation_instruction }} </td>
         </tr> 
       
        </table>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab3">
        <table class="table" style="width:50%">
       
        <tr>
        <td>Pickup Require: </td> <td> 
        <?php echo ($user->pickup_require=="yes")? "Yes": "No";  ?> </td>
        </tr> <tr>
          <td>Pickup Transport: </td> <td> {{ $user->pickup_transport }} </td>
         </tr>  <tr>
          <td>Pickup Transport Number: </td> <td> {{ $user->pickup_transport_no }} </td>
         </tr> <tr>
          <td>Pickup Date: </td> <td> {{ $user->pickup_date }} </td>
         </tr> <tr>
          <td>Pickup time: </td> <td> {{ $user->pickup_time }} </td>
         </tr> <tr>
          <td>Drop Require: </td> <td>  <?php echo ($user->drop_require=="yes")? "Yes": "No";  ?>  </td>
         </tr> <tr>
			<td>Drop Transport: </td> <td> {{ $user->drop_transport }} </td>
         </tr> <tr>
          <td>Drop Transport No: </td> <td> {{ $user->drop_transport_no }} </td>
         </tr> <tr>
 			<td>Drop Date: </td> <td> {{ $user->drop_date }} </td>
         </tr> <tr>
 			<td>Drop time: </td> <td> {{ $user->drop_time }} </td>
         </tr> <tr>
 			<td>Transport Instruction: </td> <td> {{ $user->transport_instruction }} </td>
         </tr> 
         
       
        </table>
        
        </div>
        <div role="tabpanel" class="tab-pane" id="tab4">
			<table class="table" style="width:50%">
       
        <tr>
 			<td>Registration Fee: </td> <td> {{ $user->registration_fee  }} </td>
         </tr> 
       
        <tr>
 			<td> <?php if(isset($payment[0]->paidamount)) { $payment = $payment[0]->paidamount; } else  { $payment =  0; }   ?>Paid Amount: </td> <td> {{ $payment }} </td>
         </tr>
         <tr>
 			<td>Due Amount: </td> <td> {{ $user->registration_fee  - $payment}} </td>
         </tr>
         
        </table>        
        </div>
    </div>
</div>

@endforeach
@stop