<style>
hr { margin-top:0px!important;}
.price {
	height: 40px;
    background-color: #4c4141;
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
</style>
<section class="content-header">
<?php
     $this->element('subheader');

	if($users['role_id'] != 3 && count($advertisement1) > 0){
	?>
		<div class="col-md-12" style="background-color:#FFF">
			<p style="font-size:20px;padding-top:10px">Hoteliers interested in you</p>
			<hr></hr>
				  
						<div id="myCarousel" class="carousel slide">
							<div class="carousel-inner">
							<?php
							$ad = $advertisement1;
							$i=1;
							foreach(array_chunk($advertisement1->toArray() ,4) as $advert){
								?>
								<div class="item <?php if($i==1){ echo 'active'; } ?>" >
									<div class="row-fluid">
									<?php
									$k =1;
									foreach($advert as $advert2){
									?>
										<div class=" col-md-4">
											<div class="priceing">
												<img <?php  if($advert2['hotel_pic']=="") {?> src="../img/travel-advertisement.jpg"<?php } else {?>
												src="../img/hotels/<?php echo $advert2['hotel_pic']; } ?>" alt="Image" height="180px" width="100%" />
												<div class="price" >Rs. <span>
													<?php echo $advert2['cheap_tariff']; ?></span>-<span><?php echo $advert2['expensive_tariff']; ?></span>
												</div>
												<div class="caption">
																										
													
													<h4><?php echo $advert2['hotel_name']; ?></h4>
													<p> <?php echo $advert2['hotel_location']; ?></p>
													<p>   
														<?php foreach($hotelCategories as $key=> $hotel){
															if($key==$advert2['hotel_type']){ echo $hotel;}
														}
														?>
													</p>
													<?php  
													if (!preg_match("~^(?:f|ht)tps?://~i",  $advert2['website'])) {
														$advert2['website'] = "http://" .  $advert2['website'];
													}
													?>
													<a onclick="countfunc('<?php echo $advert2['website']; ?>','<?php echo $advert2['id']; ?>')" class="btn btn-mini" href="<?php echo $advert2['website']; ?>" target="_blank">» View More</a>
												</div>
											</div>
										</div>
									<?php $k++;
									} ?>
									</div><!--/row-fluid-->
								</div><!--/item-->

							<?php $i++;
							} ?>
							</div><!--/carousel-inner-->

							<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
							<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
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