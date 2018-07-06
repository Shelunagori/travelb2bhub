<section id="home_slider">
   <div class="container-fluid">
        <div class="row">
           <!-- Carousel -->
                <div id="carousel-example-generic" class="carousel slide " data-ride="carousel">
                    <!-- Indicators -->
<!--
                    <ol class="carousel-indicators hidden-xs">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    </ol>
-->
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php $i=0; foreach($sliders as $slide) { ?>
                        <div class="item <?php echo $i==0?'active':''; ?>">
 <?php echo $this->Html->image('slider/'.$slide['headerimg'], array("class" => "" )) ; ?>
                           <div class="header-text">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                <h2 class="margin<?php echo $i; ?>"><?php echo $slide['title']; ?></h2>
                                </div>  </div>
                        </div>
                        <?php if($i==0) { ?>
                        <div class="header-text2">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                <div class="box_on_carousel">
                                    <div class="">
                                        <ul class="icon_ul">
                                            <li class="">
                                                <?php echo $this->Html->image('icon-01.png', array("class" => "" )) ; ?>
                                            </li>
                                        </ul>
                                        <ul class="text_ul">
                                            <li class="heading"><span>Travel Agents</span> 
                                                  <span  id="tacount">(<?php echo $travelAgentCount; ?>)</span>
                                            </li>
                                            <li class="title"><span>BUY: </span>Submit Requirements</li>
                                            <li class="title"><span>SELL: </span>Respond to Submitted Requirements</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box_on_carousel">
                                    <div class="">
                                        <ul class="icon_ul">
                                            <li class="">
                                                 <?php echo $this->Html->image('icon-hotel.png', array("class" => "" )) ; ?>
                                            </li>
                                        </ul>
                                        <ul class="text_ul">
                                            <li class="heading"><span>Hoteliers</span>
                                                <span  id="hocount">(<?php echo $hotelierCount; ?>)</span>
                                            </li>
                                            <li class="title"><span>SELL: </span>Respond to Submitted Requirements</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box_on_carousel">
                                    <div class="">
                                        <ul class="icon_ul">
                                            <li class="">
                                                  <?php echo $this->Html->image('icon-events.png', array("class" => "" )) ; ?>
                                            </li>
                                        </ul>
                                        <ul class="text_ul">
                                            <li class="heading"><span>Event Planners</span>
                                                 <span  id="epcount">(<?php echo $eventPlannerCount; ?>)</span>
                                            </li>
                                            <li class="title"><span>BUY: </span>Submit Requirements</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /header-text -->
                         <?php }  $i++;} ?>
                    </div>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class=""><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class=""><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    </a>
                </div><!-- /carousel -->

        </div>
    </div>
</section>
<section id="content" class="hidden-xs">
    <div class="container-fluid grey_bg ">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 padding-t10">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center overview margin-b30 padding0">
                       <h1><?php echo $overview->title; ?></h1>
                         <?php echo $this->Html->image('heading-line.png', array("class" => "img-responsive center_img" )) ; ?>
                 </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 overview">
                   <?php echo $overview->description; ?>
                </div>
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 right_img_home">
                     <?php echo $this->Html->image('img-right.jpg', array("class" => "img-responsive" )) ; ?>
                </div>
            </div>
        </div>
    </div><!-- /Overview -->
    <div class="container margin-b40 margin-t20 ">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center margin-b30 ">
               <h1>Benefits</h1>
                    <?php echo $this->Html->image('heading-line.png', array("class" => "img-responsive center_img" )) ; ?>
            </div>
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-b20">
                <div class="box">
                    <div class="icon">
                        <div class="image">
                        <?php echo $this->Html->image('banifits-icon-01.png', array("class" => "img-responsive" )) ; ?>
                        </div>
                        <div class="info">
                            <h4 class="title"><?php echo $benifits1->title; ?></h4>
                            <p> <?php echo $benifits1->description; ?></p>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-b20">
                <div class="box">
                    <div class="icon">
                        <div class="image">
                         <?php echo $this->Html->image('banifits-icon-02.png', array("class" => "img-responsive" )) ; ?>
                        </div>
                        <div class="info">
                         <h4 class="title"><?php echo $benifits2->title; ?></h4>
                            <p> <?php echo $benifits2->description; ?></p>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-b20">
                <div class="box">
                    <div class="icon">
                        <div class="image">
                            <?php echo $this->Html->image('banifits-icon-03.png', array("class" => "img-responsive" )) ; ?>
                        </div>
                        <div class="info">
                          <h4 class="title"><?php echo $benifits3->title; ?></h4>         
                            <p> <?php echo $benifits3->description; ?></p>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-b20">
                <div class="box">
                    <div class="icon">
                        <div class="image">
 <?php echo $this->Html->image('banifits-icon-04.png', array("class" => "img-responsive" )) ; ?>
                        </div>
                        <div class="info">
                          <h4 class="title"><?php echo $benifits4->title; ?></h4>         
                            <p> <?php echo $benifits4->description; ?></p>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-b20">
                <div class="box">
                    <div class="icon">
                        <div class="image">
 <?php echo $this->Html->image('banifits-icon-05.png', array("class" => "img-responsive" )) ; ?>
                        </div>
                        <div class="info">
                            <h4 class="title"><?php echo $benifits5->title; ?></h4>         
                            <p> <?php echo $benifits5->description; ?></p>
                        </div>
                    </div>
                    <div class="space"></div>
                </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-b20">
                <div class="box">							
                    <div class="icon">
                        <div class="image">
                             
 <?php echo $this->Html->image('banifits-icon-06.png', array("class" => "img-responsive" )) ; ?>
                        </div>
                        <div class="info">
                           <h4 class="title"><?php echo $benifits6->title; ?></h4>         
                            <p> <?php echo $benifits6->description; ?></p>
                        </div>
                    </div>
                </div> 
            </div>             
        </div>
    </div><!-- Benefit -->
    
    <div class="container-fluid grey_bg get_started">
    
        <div class="">
            <div class="row margin-t10">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center margin-b30 ">
                   <h1>Get Started</h1>
                   <?php echo $this->Html->image('heading-line.png', array("class" => "img-responsive center_img" )) ; ?>
   
   
                   
                </div>
            </div>
            <div class="row margin-b50 get_started_icons">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 text-center">
                <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'register')) ?>" 
                class="">
                <?php echo $this->Html->image('get-started-icon-01.png', array("class" => "img-responsive center_img" )) ; ?>
                <h5>Sign-up</h5>
                </a>               
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 text-center">
                <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'login')) ?>" 
                class="">
                <?php echo $this->Html->image('get-started-icon-02.png', array("class" => "img-responsive center_img" )) ; ?>
                <h5>Login to your<br> Profile</h5>
                </a>             
                </div>
                 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 text-center">
  <?php echo $this->Html->image('get-started-icon-03.png', array("class" => "img-responsive center_img" )) ; ?>
                  
                    <h5>Place Request /<br> Respond to Request</h5>                
                </div>
                 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 text-center">
                  <?php echo $this->Html->image('get-started-icon-016.png', array("class" => "img-responsive center_img" )) ; ?>
                   
                    <h5>Review/ Shortlist Responses</h5>                
                </div>
                 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 text-center">
                 <?php echo $this->Html->image('get-started-icon-04.png', array("class" => "img-responsive center_img" )) ; ?>
                   
                    <h5>Negotiate via live<br> chat, or phone </h5>                
                </div>
                 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 text-center">
                  <?php echo $this->Html->image('get-started-icon-06.png', array("class" => "img-responsive center_img" )) ; ?>
                   
                    <h5>Finalize the <br>best deal</h5>                
                </div>
               

            </div>
        </div>
    </div>
    
     
</section>



<section id="content" class="hidden-lg hidden-md hidden-sm" style="margin-top: 20px;">
       <div class="container-fluid">   
           <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel-group" id="accordion">	
        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title ">
                                    <a data-toggle="collapse"  data-parent="#overview" href="#overview">
                                     <?php echo $overview->title; ?></a>
                                </h4>
                            </div>

                            <div id="overview" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="container-fluid grey_bg ">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 padding-t10">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center overview padding0">
                                                      
                                                         <?php echo $this->Html->image('heading-line.png', array("class" => "img-responsive center_img border_img" )) ; ?>
                                                 </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 overview">
                                                   <?php echo $overview->description; ?>
                                                </div>
                                                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 right_img_home">
                                                     <?php echo $this->Html->image('img-right.jpg', array("class" => "img-responsive" )) ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /Overview -->
                                </div>
                            </div>
                        </div>
                        <!--panel panel-default-->

                         <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title ">
                                    <a data-toggle="collapse"  data-parent="#benefit" href="#benefit">
                                     Benefits</a>
                                </h4>
                            </div>

                            <div id="benefit" class="panel-collapse collapse">
                                <div class="panel-body">
                                        <div class="container margin-b40 margin-t20 ">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center ">
                                                   
                                                        <?php echo $this->Html->image('heading-line.png', array("class" => "img-responsive center_img border_img" )) ; ?>
                                                </div>
                                               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-b20">
                                                    <div class="box">
                                                        <div class="icon">
                                                            <div class="image">
                                                            <?php echo $this->Html->image('banifits-icon-01.png', array("class" => "img-responsive" )) ; ?>
                                                            </div>
                                                            <div class="info">
                                                                <h4 class="title"><?php echo $benifits1->title; ?></h4>
                                                                <p> <?php echo $benifits1->description; ?></p>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-b20">
                                                    <div class="box">
                                                        <div class="icon">
                                                            <div class="image">
                                                             <?php echo $this->Html->image('banifits-icon-02.png', array("class" => "img-responsive" )) ; ?>
                                                            </div>
                                                            <div class="info">
                                                             <h4 class="title"><?php echo $benifits2->title; ?></h4>
                                                                <p> <?php echo $benifits2->description; ?></p>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-b20">
                                                    <div class="box">
                                                        <div class="icon">
                                                            <div class="image">
                                                                <?php echo $this->Html->image('banifits-icon-03.png', array("class" => "img-responsive" )) ; ?>
                                                            </div>
                                                            <div class="info">
                                                              <h4 class="title"><?php echo $benifits3->title; ?></h4>         
                                                                <p> <?php echo $benifits3->description; ?></p>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-b20">
                                                    <div class="box">
                                                        <div class="icon">
                                                            <div class="image">
                                     <?php echo $this->Html->image('banifits-icon-04.png', array("class" => "img-responsive" )) ; ?>
                                                            </div>
                                                            <div class="info">
                                                              <h4 class="title"><?php echo $benifits4->title; ?></h4>         
                                                                <p> <?php echo $benifits4->description; ?></p>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-b20">
                                                    <div class="box">
                                                        <div class="icon">
                                                            <div class="image">
                                     <?php echo $this->Html->image('banifits-icon-05.png', array("class" => "img-responsive" )) ; ?>
                                                            </div>
                                                            <div class="info">
                                                                <h4 class="title"><?php echo $benifits5->title; ?></h4>         
                                                                <p> <?php echo $benifits5->description; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="space"></div>
                                                    </div> 
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-b20">
                                                    <div class="box">							
                                                        <div class="icon">
                                                            <div class="image">

                                     <?php echo $this->Html->image('banifits-icon-06.png', array("class" => "img-responsive" )) ; ?>
                                                            </div>
                                                            <div class="info">
                                                               <h4 class="title"><?php echo $benifits6->title; ?></h4>         
                                                                <p> <?php echo $benifits6->description; ?></p>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>             
                                            </div>
                                        </div><!-- Benefit -->
                                </div>
                            </div>
                        </div>
                        <!--panel panel-default-->

                         <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title ">
                                    <a data-toggle="collapse"  data-parent="#get-started" href="#get-started">
                                     Get Started</a>
                                </h4>
                            </div>

                            <div id="get-started" class="panel-collapse collapse">
                                <div class="panel-body">
                                       <div class="container-fluid grey_bg get_started">

                                    <div class="">
                                        <div class="row margin-t10">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                           
                                               <?php echo $this->Html->image('heading-line.png', array("class" => "img-responsive center_img border_img" )) ; ?>



                                            </div>
                                        </div>
                                        <div class="row margin-b50 get_started_icons">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 text-center">
<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'register')) ?>" class="">
<?php echo $this->Html->image('get-started-icon-01.png', array("class" => "img-responsive center_img" )) ; ?>
                                      <h5>Sign-up</h5></a>             
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 text-center">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'login')) ?>"
                         class=""><?php echo $this->Html->image('get-started-icon-02.png', array("class" => "img-responsive center_img" )) ; ?>
                                               <h5>Login to your <br>Profile</h5></a>             
                                            </div>
                                             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 text-center">
                              <?php echo $this->Html->image('get-started-icon-03.png', array("class" => "img-responsive center_img" )) ; ?>

                                                <h5>Place Request /<br> Respond to Request</h5>                
                                            </div>
                                             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 text-center">
                                              <?php echo $this->Html->image('get-started-icon-016.png', array("class" => "img-responsive center_img" )) ; ?>

                                                <h5>Review/ Shortlist Responses</h5>                
                                            </div>
                                             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 text-center">
                                             <?php echo $this->Html->image('get-started-icon-04.png', array("class" => "img-responsive center_img" )) ; ?>

                                                <h5>Negotiate via <br>live chat, or phone </h5>                
                                            </div>
                                             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 text-center">
                                              <?php echo $this->Html->image('get-started-icon-06.png', array("class" => "img-responsive center_img" )) ; ?>

                                                <h5>Finalize the <br>best deal</h5>                
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!--panel panel-default-->

                    </div>                    
                </div>
           </div>
      </div>
</section>

 <div class="free-trial-logo">
      <img src="/img/trial-b2b.png" class="img-responsive" alt="">
  </div>  
<script type="text/javascript">
var auto_refresh = setInterval(
function ()
{
$('#tacount').load('pages/sliderautocount/ta').fadeIn("slow");
$('#epcount').load('pages/sliderautocount/ep').fadeIn("slow");
$('#hocount').load('pages/sliderautocount/hot').fadeIn("slow");
}, 10000); // refresh every 10000 milliseconds
</script>
<script>
$('.carousel').carousel({
  interval: 200000
})
</script>