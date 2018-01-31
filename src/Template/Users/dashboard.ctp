<div id="profile" class="container-fluid">
    <div class="row tra-section-gray equal_column">
          <?php echo $this->element('left_panel');?>
           <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 padding0">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 border_bottom">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 ">
                    <h4 class="title">Dashboard</h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 ">
                    <ul class="top-icons-wrap">
					<li>
						  <li class="notification_list">
   <a href="javascript:void(0);" id="chat_icon" class="link-icon"><span class="chat_count"><?php echo $chatCount;?></span><img src="/img/notify.png" alt=""></a>
                            <div class="ap-subs">
                                <ul class="list-unstyled msg_list" role="menu">
                  <?php
                  echo $this->element('subheader');?>
              <?php if($users['role_id'] != 3 && count($advertisement1) > 0){?>
               <hr class="hr_bordor">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1>Hoteliers interested in you</h1>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">
                        <div class="well advertisment">
                            <div id="myCarousel" class="carousel slide">
                            <!-- Carousel items -->
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
                                  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                      <div class="thumbnail">
<img <?php  if($advert2['hotel_pic']=="") {?> src="../img/travel-advertisement.jpg"<?php } else {?>
src="../img/hotels/<?php echo $advert2['hotel_pic']; } ?>" alt="Image" style="max-width:100%;" />
                                       <div class="price">Rs. <span><?php echo $advert2['cheap_tariff']; ?></span>-<span><?php echo $advert2['expensive_tariff']; ?></span></div>
                                       <div class="caption">
                                            <h4><?php echo $advert2['hotel_name']; ?></h4>
 <p> <?php echo $advert2['hotel_location']; ?></p>
                                            <p>   <?php foreach($hotelCategories as $key=> $hotel){
                                           if($key==$advert2['hotel_type']){ echo $hotel;}
                                           }
                                           ?></p>
                                           <?php  if (!preg_match("~^(?:f|ht)tps?://~i",  $advert2['website'])) {
         $advert2['website'] = "http://" .  $advert2['website'];
    }
    ?>
                                            <a onclick="countfunc('<?php echo $advert2['website']; ?>','<?php echo $advert2['id']; ?>')" class="btn btn-mini" href="<?php echo $advert2['website']; ?>" target="_blank">» View More</a>
                                        </div>
                                      </div>
                                  </div>
                                  <?php $k++;} ?>
                                </div><!--/row-fluid-->
                            </div><!--/item-->

<?php $i++;} ?>
                            </div><!--/carousel-inner-->

                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                            </div><!--/myCarousel-->

                        </div><!--/well-->
                    </div>
						</div>
              <?php } ?>
               <div class="col-md-12 col-sm-12 col-xs-12">	
                    <h1>Description</h1>
                     <p><?php echo $users['description'];?></p>
                </div>
               <hr class="hr_bordor">
               <?php if( count($testimonial) > 0) { ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1>Reviews</h1>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">
                        <div class="carousel-reviews broun-block">
                            <div id="carousel-reviews" class="carousel slide carousel1" data-ride="carousel">
                                <div class="carousel-inner">
                                <?php

$testi = $testimonial;
$x=1;
 foreach($testimonial as $testimo){
 ?>
                                    <div class="item <?php if($x==1){ echo 'active'; } ?>">
                                     <?php
                                 $k =1;
 //foreach($testimon as $testimo){
 ?>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="review-block">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">
                                                    <div class="block-text">
                                                        <p> <?php echo $testimo['comment']; ?> </p>
                                                    </div>
                                                    <img src="/img/review_bottom_border.png" class="img-responsive">
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-5 col-xs-4 person-img">
                                                <?php
              


                                        if($testimo["profile_pic"]==""){
                                             echo $this->Html->image('no-profile-image.jpg', ["class"=>"img-responsive center_img","alt"=>"Profile Pic", "height"=>150]); 
                                        }else{
                                        echo $this->Html->image('user_docs/'.$testimo["author_id"].'/'.$testimo["profile_pic"], ["class"=>"img-responsive center_img","alt"=>"Profile Pic", "height"=>150]);
                                        }
                ?>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-7 col-xs-8 person-info">
                                                    <h4><?php echo $testimo['name']; ?></h4>
                                                    <div class="rating">
                <?php
                 $userRating =  $testimo['rating1'];
                //echo $userRating;
                if($userRating>0){
                    for($i=$userRating; $i>0; $i--){
                        echo '<i class="fa fa-star"></i>';
                    }
                }else{
                    echo '<i class="fa fa-star"></i>';
                }
                ?>
            </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php //$k++;} ?>
                                    </div>
                                    <?php $x++;} ?>

                                </div>
                                <?php if(count($testimonial)>2){?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center padding0">
                                    <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">   
                                        <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                                       <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                                    </a>
                               </div>
                               <?php }?>
                            </div>
                        </div>
                    </div>

                </div>
<?php } ?>
            </div>
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