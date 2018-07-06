<section id="about_us" class="">
<div class="container-fluid about_bg">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">
             <h1 class="text-center"> <?php echo $aboutcontent->title; ?></h1>
        </div>
    </div>
</div>
<div class="container padding-t35">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="about-head">
                 <?php echo $aboutcontent->description; ?>
            </div>
            <hr class="divider">
        </div>
    </div>
</div>
<!-- end:header-top -->
<div id="tra-contact">
   <div class="container team">
      <div class="row margin-tb30">
         <div class="col-md-12 text-center">
            <h1 class="text-center margin-b60">Our Team</h1>
            <!-- Pricing -->
            <div class="col-md-6 col-sm-6 col-xs-12 tra-tours ">
               <div id="des1">
                  <a href="#">
                      <?php echo $this->Html->image('Prady_Singh.png', ['alt' => 'Free HTML5 Website Template by FreeHTML5.co','class' => 'img-responsive']); ?>
                     <div class="desc">
                        <span></span>
                        <h3>Pradyuman Singh</h3>
                        <span>Co-Founder</span>
                        <p class="tra-social-icons">
 
                            <a href="https://www.facebook.com/TravelB2BHub/"  target="_blank"><i class="fa fa-facebook"></i></a>
                         </p>
                  </div>
                  </a>
               </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 tra-tours ">
               <div id="des1">
                  <a href="#">
                    <?php echo $this->Html->image('PHOTO -HARSH SIR.png', ['alt' => 'Free HTML5 Website Template by FreeHTML5.co','class' => 'img-responsive']); ?>
                     <div class="desc">
                        <span></span>
                         <h3>Harsh Bula</h3>
                        <span>Co-Founder</span>
                        <p class="tra-social-icons"> 
                            <a href="https://www.facebook.com/TravelB2BHub/"  target="_blank"><i class="fa fa-facebook"></i></a>
                         </p>
                  </div></a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</section>
