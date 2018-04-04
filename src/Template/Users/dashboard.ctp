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
	font-size:10px!important;
}	

</style>
<section class="content-header">
<div class="container-fluid">
<div class="row equal_column" > 
    <div class="col-md-12" > 
		<?php echo $this->element('subheader');?>
		<?php echo  $this->Flash->render();
			$role_id=$users->role_id 
		?>
	</div>
</div>
<span class="help-block"></span>
		<div class="box box-primary">
				<div class="box-header with-border"> 
				<h3 class="box-title" style="padding:5px;">Promotions</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<?php if($role_id==1) {?>
							<div class="col-md-4"> 
 							<li class="col-lg-12 col-xs-12 text-center" style="background-image:url(../images/Travel.jpg);height:200px;width:100%;background-repeat:round;padding: 25px;">
								  <!-- small box -->
								  <div class="small-box" >
									<div class="inner">
										<table border="0" height="130px">
											<tr>
												<td colspan="2" style="font-size:16px"><b>Listed Packages</b></td>	
											</tr>
											<tr>
												<td colspan="2" class="textpormoition">Click on the buttons below to View Promote Travel Packages </td>	
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
							<div class="col-md-4 neww" > 
								<li class="col-lg-12 col-xs-12 text-center" style="background-image:url(../images/Hotel.jpg);height:200px;width:100%;background-repeat:round;padding: 25px;">
								  <!-- small box -->
								  <div class="small-box" >
									<div class="inner">
										<table border="0" height="130px">
											<tr>
												<td colspan="2" style="font-size:16px"><b>Hotel Promotions</b></td>	
											</tr>
											<tr>
												<td colspan="2" class="textpormoition">Click on the buttons below to View <?php if($role_id==3){ ?>or Post<?php } ?> Hotel Promotions </td>	
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
							
							<div class="col-md-4">
							<li class="col-lg-12 col-xs-12 text-center" style="background-image:url(../images/Taxi.jpg);height:200px;width:100%;background-repeat:round;padding: 25px;">
								  <!-- small box -->
								  <div class="small-box" >
									<div class="inner">
										<table border="0" height="130px">
											<tr>
												<td colspan="2" style="font-size:16px"><b>Listed Taxi/Fleet Services</b></td>	
											</tr>
											<tr>
												<td colspan="2" class="textpormoition">Click on the buttons below to View <?php if($role_id==1){ ?> or Promote <?php } ?> Taxi/Fleet Services </td>	
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
							<div class="col-md-4"> 
								<li class="col-lg-12 col-xs-12 text-center" style="background-image:url(../images/Event.jpg);height:200px;width:100%;background-repeat:round;padding: 25px;">
								  <!-- small box -->
								  <div class="small-box" >
									<div class="inner">
										<table border="0" height="130px">
											<tr>
												<td colspan="2" style="font-size:16px"><b>Event Promotions</b></td>	
											</tr>
											<tr>
												<td colspan="2" class="textpormoition">Click on the buttons below to View <?php if($role_id==2){ ?> or Promote <?php }?> Event Planning Services </td>	
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