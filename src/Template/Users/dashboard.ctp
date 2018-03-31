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
    width: 50%;
    font-size: 14px;
    max-width: 214px;
    text-align: center;
    color: rgb(255, 255, 255);
    background: none;
    border-width: 1px;
    border-style: solid;
    border-color: rgb(255, 255, 255);
    border-image: initial;
    padding: 0.75rem 1rem;
    border-radius: 2px;
}
.button:hover{
	background-color:#1295A2;
}
</style>
<section class="content-header">
<div class="container-fluid">
<div class="row equal_column" > 
    <div class="col-md-12" > 
		<?php echo $this->element('subheader');?>
		<?php echo  $this->Flash->render() ?>
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
							<div class="col-md-4" > 
								<li class="col-lg-12 col-xs-12 tile   tile-1 slideTextUp" style="background-image:url(../images/Hotel.png);height:200px;width:100%;background-repeat:round;">
								  <!-- small box -->
								  <div class="small-box" >
									<div class="inner">
										<p>hotel Promotion</p>	
										 
									</div>
								  </div>
								  <div class="small-box " style="margin-top:20px;">
									<table class="table">
											<tr>
											<span>hotel Promotion</span>	
											</tr><span class="help-block"></span>
											<tr>
											<a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'report')) ?>">
												<button class="button" >View Details</button></a>
											</tr>
											<span class="help-block"></span>
											<tr>
											<a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'add')) ?>">
												<button class="button"  >Load Package</button></a>
											</tr>
										</table>
								  </div>
								</li>
							</div>
							<div class="col-md-4"> 
							<li class="col-lg-12 col-xs-12 tile   tile-1 slideTextUp" style="background-image:url(../images/Travel.png);height:200px;width:100%;background-repeat:round;">
								  <!-- small box -->
								  <div class="small-box" >
									<div class="inner">
										<p>travel Package</p>	
										 
									</div>
								  </div>
								  <div class="small-box " style="margin-top:20px;">
									<table class="table">
											<tr>
											<span>travel Package</span>	
											</tr><span class="help-block"></span>
											<tr>
											<a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'report')) ?>">
												<button class="button" >View Details</button></a>
											</tr>
											<span class="help-block"></span>
											<tr>
											<a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'add')) ?>">
												<button class="button"  >Load Package</button></a>
											</tr>
											
										</table>
								  </div>
								</li>
							</div>
							<div class="col-md-4">
							<li class="col-lg-12 col-xs-12 tile   tile-1 slideTextUp" style="background-image:url(../images/Taxi.png);height:200px;width:100%;background-repeat:round;">
								  <!-- small box -->
								  <div class="small-box" >
									<div class="inner">
										<p>Taxi Fleet</p>	
										 
									</div>
								  </div>
								  <div class="small-box " style="margin-top:20px;">
									<table class="table">
											<tr>
											<span >Taxi Fleet</span>	
											</tr><span class="help-block"></span>
											<tr>
											<a href="<?php echo $this->Url->build(array('controller'=>'TaxiFleetPromotions','action'=>'report')) ?>">
												<button class="button" >View Details</button></a>
											</tr><span class="help-block"></span>
											<tr>
											<a href="<?php echo $this->Url->build(array('controller'=>'TaxiFleetPromotions','action'=>'add')) ?>">
												<button class="button"  >Load Package</button></a>
											</tr>
										</table>
								  </div>
								</li>
							</div>
					</div>
				</div>
			</div>
		</div>
</section>

	<!-- hide section for hotelier--->

<?php
	if($users['role_id'] != 3 && count($advertisement1) > 0){
	?>
		<div class="col-md-12" style="background-color:#FFF; margin-top:10px">
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