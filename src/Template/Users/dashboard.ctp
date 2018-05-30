<style>
hr { margin-top:0px!important;}
.price {
	height: 40px;
    background-color: #000000d9;
    color: #FFF;
    text-align: center;
    font-size: 18px;
    padding-top: 7px;
}
.priceing
{
    padding: 5px;
    margin-bottom: 20px;  
    border: 1px solid #ddd;
    border-radius: 5px;	
}
.img {
    position: relative;
    text-align: center;
    color: white;
}
.overlap {
    position: absolute;
    bottom: 0px;
    right: 0px;
	width:100%;
	opacity: .7;
}
.nm { 
	font-size: 19px;
    color: #373435;
    font-weight: 900;
}
.other { 
	font-size: 17px;
    color: #727376; 
}
.arroysign
{
	margin: 17px;
	right: 23px !important;
    width: 3% !important;
    top: 40%;
    bottom: 52%;
}
li > p{
		color:#96989A !important;
		margin: 0 0 4px !important;
	}	
 .button {
    width: 70%;
    font-size: 12px;
    max-width: 214px;
    text-align: center;
    color: rgb(255, 255, 255);
    background: none;
    border-width: 1px;
    border-style: solid;
    border-color: rgb(255, 255, 255);
    border-image: initial; 
    border-radius: 50px;
}
.button:hover{
	background-color:#FB6542;
} 
.inner{
	color:#FFF !important;		
}
.textpormoition {
	font-size:15px!important;
} 
@media all and (max-width: 520px) {
	.content-header {
		padding: 0px 0px 0 0px !important;
	}
	.content{
	padding: 0px !important;
	}
}
@media all and (min-width: 520px) {
	.tets{
		margin-top: 25px;
	}
}
.tbhight{height:140px;}
@media all and (min-width: 770px) {
	.small-box {margin-bottom: 0px !important;}
	.Dashbord{ margin-bottom:15px;}
	.tbhight{height:110px !important;}
}

.content{padding-top: 0px !important; margin-top: -7px !important;}
</style>

<section class="">
<div class="container-fluid">  
<?php 
	$role_id=$users->role_id 
?>
 <div class="row equal_column tets" style="margin-bottom:20px">
	 <div class="col-md-9">
		<?php if($role_id==1) { ?>
		<div class="" style=""> 
		<li class="col-lg-12 col-xs-12 text-center Dashbord" style="background-image:url(../images/Travel.jpg);height:33%;width:100%;background-repeat:round;">
			  <!-- small box -->
			  <div class="small-box" >
				<div class="inner" align="center">
					<table border="0" class="tbhight" style="text-align: center;">
						<tr>
							<td colspan="2" style="font-size:17px"><b>Listed Packages</b></td>	
						</tr>
						<tr>
							<td colspan="2" class="textpormoition">Click on the buttons below to View or Promote Travel Packages </td>	
						</tr>
						 
						<tr>
							<td><a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'report')) ?>">
							<button class="button btn-sm btn-info" >View </button></a></td>
							
							<td><a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'add')) ?>">
								<button class="button btn-sm btn-danger"  >Load </button></a></td>
							
						</tr>											 
					</table>	
				</div>
			  </div>
			   
			</li>
		</div>
		<?php } ?>
		<div class=" neww" > 
			<li class="col-lg-12 col-xs-12 text-center Dashbord" style="background-image:url(../images/Hotel.jpg);height:33%;width:100%;background-repeat:round;">
			  <!-- small box -->
			  <div class="small-box" >
				<div class="inner" align="center">
					<table border="0" class="tbhight" style="text-align: center;">
						<tr>
							<td colspan="2" style="font-size:17px"><b>Hotel Promotions</b></td>	
						</tr>
						<tr>
							<td colspan="2" class="textpormoition">Click on the <?php if($role_id==3){ ?>buttons<?php } else{echo"button";} ?> below to View <?php if($role_id==3){ ?>or Post<?php } ?> Hotel Promotions </td>	
						</tr>
						 
						<tr>
							<td><a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'report')) ?>">
							<button <?php if($role_id!=3){ ?> style="width:35% !important;"<?php }?> class="button btn-sm btn-info" >View </button></a></td>
							
							<td><?php if($role_id==3){ ?><a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'add')) ?>">
								<button class="button btn-sm btn-danger"  >Load </button></a><?php }?></td>
							
						</tr>											 
					</table>	
				</div>
			  </div>
			   
			</li>
		</div>
		
		<div class="">
		<li class="col-lg-12 col-xs-12 text-center Dashbord" style="background-image:url(../images/Taxi.jpg);height:33%;width:100%;background-repeat:round; ">
			  <!-- small box -->
			  <div class="small-box" >
				<div class="inner" align="center">
					<table border="0" class="tbhight" style="text-align: center;">
						<tr>
							<td colspan="2" style="font-size:17px"><b>Listed Taxi/Fleet Services</b></td>	
						</tr>
						<tr>
							<td colspan="2" class="textpormoition">Click on the <?php if($role_id==1){ ?>buttons<?php } else{echo"button";} ?> below to View <?php if($role_id==1){ ?> or Promote <?php } ?> Taxi/Fleet Services </td>	
						</tr>
						<tr>
							<td><a href="<?php echo $this->Url->build(array('controller'=>'TaxiFleetPromotions','action'=>'report')) ?>">
							<button <?php if($role_id!=1){ ?> style="width:50% !important;"<?php } ?> class="button btn-sm btn-info" >View </button></a></td>
							
							<td><?php if($role_id==1){ ?><a href="<?php echo $this->Url->build(array('controller'=>'TaxiFleetPromotions','action'=>'add')) ?>">
								<button class="button btn-sm btn-danger"  >Load </button></a> <?php } ?></td>
						</tr>
					</table>	
				</div>
			  </div>
			</li>
		</div>
		<?php if($role_id==2 || $role_id==3) { ?>
		<div class=""> 
			<li class="col-lg-12 col-xs-12 text-center Dashbord" style="background-image:url(../images/Event.jpg);height:33%;width:100%;background-repeat:round; ">
			  <!-- small box -->
			  <div class="small-box" >
				<div class="inner" align="center">
					<table border="0" class="tbhight" style="text-align: center;">
						<tr>
							<td colspan="2" style="font-size:17px"><b>Event Planner Promotions</b></td>	
						</tr>
						<tr>
							<td colspan="2" class="textpormoition">Click on the <?php if($role_id==2){ ?>buttons<?php } else{echo"button";} ?> below to View <?php if($role_id==2){ ?> or Promote <?php }?> Event Planning Services </td>	
						</tr>
						 
						<tr>
							<td><a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'report')) ?>">
							<button <?php if($role_id!=2){ ?> style="width:35% !important;"<?php }?> class="button btn-sm btn-info" >View </button></a></td>
							
							<td><?php if($role_id==2){ ?><a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'add')) ?>">
								<button class="button btn-sm btn-danger"  >Load </button></a><?php }?></td>
							
						</tr>											 
					</table>	
				</div>
			  </div>
			   
			</li> 
		</div>
	<?php } ?> 
	<div style="top: 28px;">
		<?php echo $this->element('subheader');?> 
	</div>
	</div>
	<div class='col-md-3 hideinphone' align="left">
		<div class="col-md-12" style="background-color:#FFF; margin-left:-8px !important;">
			<h4 align="center" style="padding-top:10px"><b>Download the app</b> for a GREAT <b>user experience</b></h4><br>
			<p style="color:#5c5a5a;font-size:14px;">1) <b>Don’t miss any business leads:</b> Receive instantaneous notifications about new leads and receive responses in real-time.</p><br>
			<p style="color:#5c5a5a;font-size:14px;">2) <b>Real-time communication:</b> Have live chats directly with buyers and sellers or Call them by clicking a button for buying listed packages, transport, or hotels.</p><br>
			<p style="color:#5c5a5a;font-size:14px;">3) <b>Improved User Interface / User Experience:</b> Mobile specific design elements and processes make the App very easy to operate.</p><br><br>
			<div align="center" style="margin-bottom:38px">
				<a target="_blank" href="https://play.google.com/store/apps/details?id=com.app.travel.TravelB2B"><?php echo  $this->Html->image('/images/google_play.png', ['style'=>'width:60%;']) ?></a>
			</div> 
		</div>
	</div>
	
	
</div>
				
</section>

	<!-- hide section for hotelier--->


<?php
	if($users['role_id'] != 3 && count($advertisement1) > 0){
	?>
		<div class="col-md-12" style="background-color:#FFF; margin-top:10px; display:none">
			<div style="padding:10px">
				<p style="font-size:20px;padding-top:10px;color:#4B4B4D">Hoteliers Interested in You</p>
			</div>
			<hr></hr>
				  
						<div id="myCarousel" class="carousel slide">
							<div class="carousel-inner">
							<?php
							$ad = $advertisement1;
							$i=1;
							foreach(array_chunk($advertisement1->toArray() ,3) as $advert){
								?>
								<div class="item <?php if($i==1){ echo 'active'; } ?>" >
									<div class="row-fluid">
									<?php
									$k =1;
									foreach($advert as $advert2){
										 
									if (!preg_match("~^(?:f|ht)tps?://~i",  $advert2['website'])) {
										$advert2['website'] = "http://" .  $advert2['website'];
									}
												 
									?>
										<div class=" col-md-4">
										<a onclick="countfunc('<?php echo $advert2['website']; ?>','<?php echo $advert2['id']; ?>')" href="<?php echo $advert2['website']; ?>" target="_blank">
											<div class="priceing">
												<div class="img" style="height:230px">
													<img 
													<?php if(($advert2['hotel_pic']=="") || (!file_exists('../img/hotels/'.$advert2['hotel_pic']))) {?> src="../img/blankhotel.PNG"<?php } else 
													{ ?>
													src="../img/hotels/<?php echo $advert2['hotel_pic']; } ?>" alt="Image" height="230px" width="100%" />
													<div class="price overlap" >Rs. <span>
														<?php echo $advert2['cheap_tariff']; ?></span>-<span><?php echo $advert2['expensive_tariff']; ?></span>
													</div>
												</div>
												<div class="" align="center">
												<table width="90%" border="0">
													<tr>
														<td height="60px">
															<span class="nm"><?php $nm= strtolower($advert2['hotel_name']); echo ucwords($nm); ?></span>
														</td>
													<tr>
													<tr>
														<td height="40px">
															 <span class="other">
															 <?php echo ucwords(strtolower(mb_strimwidth($advert2['hotel_location'], 0, 32, "..."))); ?>
														</span>
														</td>
													<tr>
													<tr>
														<td  height="40px">
															   
															<span class="other"><?php foreach($hotelCategories as $key=> $hotel){
																if($key==$advert2['hotel_type']){ echo ucwords(strtolower($hotel));}
															}
																?>
															</span>
														</td>
													<tr>
													</table> 
												</div>
											</div>
											</a>
										</div>
									<?php $k++;
									} ?>
									</div><!--/row-fluid-->
								</div><!--/item-->

							<?php $i++;
							} ?>
							</div><!--/carousel-inner-->

							<a class="left carousel-control arroysign" href="#myCarousel" data-slide="prev"><i class="fa fa-arrow-circle-left"></i></a>
							<a class="right carousel-control arroysign" href="#myCarousel" data-slide="next"><i class="fa fa-arrow-circle-right"></i></a>
						</div><!--/myCarousel-->

					</div><!--/well-->
				</div>
				</div>
              <?php } ?>
              
             
          </div>

    </div>
</div>
<script>
function countfunc(web,id){
  $.ajax({
	url: '/users/promotioncounts/' + id,
	cache: false,
	type: 'GET',
	dataType: 'HTML',
	success: function () {
	  //location.href=web;
	  // window.open(web, '_blank');
	}
});
}
$(function() {
    $( "#element", this ).click(function( event ) {
        if( $(this).val().length >= 4 ) {
            $.ajax({
                url: '/clients/index/' + escape( $(this).val() ),
                cache: false,
                type: 'GET',
                dataType: 'HTML',
                success: function (clients) {
                    $('#clients').html(clients);
                }
            });
        }
    });
});
$('#carousel-reviews .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));
  
  
});
$('.carousel').carousel({
  interval:50000000000000000,
  ride:false
});

</script>