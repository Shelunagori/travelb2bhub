<?php echo $this->element('header');?>
<?php echo $this->element('loginonbanner');?>
 <div id="tra-tours">
      <div class="container">
        <div class="row">
          <div class="col-md-12  text-center heading-section animate-box">
            <h3>How it works</h3>
            <p>This website/APP will serve as a <b>B2B Travel Trading Portal</b> that <b>connects Travel Agents, Hoteliers,</b> and <b>Event Planners</b>, within India, with each other to enable them to <b>sell and market tourism</b> related <b>services</b> better, and even in locations were they didn’t have reach or contacts. This is a B2B networking site and is NOT meant to cater to individual travelers.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 animate-box fadeInUp animated" data-animate-effect="fadeIn">
            <div class="service">
            <div class="icons"> <?php echo $this->Html->image('icon1.png'); ?> </div>
             <h3>Travel Agents</h3>
             <span></span>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor blandit metus, ut</p>
		    <a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'travel-agent')) ?>">Read More</a>
           </div> 
          </div>
          <div class="col-md-4 animate-box fadeInUp animated" data-animate-effect="fadeIn">
            <div class="service">
            <div class="icons"> <?php echo $this->Html->image('hotel-icon2.png'); ?> </div>
             <h3>Hoteliers</h3>
             <span></span>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor blandit metus, ut</p>
            <a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'hoteliers')) ?>">Read More</a>
           </div> 
          </div>
          <div class="col-md-4 animate-box fadeInUp animated" data-animate-effect="fadeIn">
            <div class="service">
            <div class="icons"> <?php echo $this->Html->image('icon3.png'); ?> </div>
             <h3>Event Planners</h3>
             <span></span>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor blandit metus, ut</p>
            <a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'event-planners')) ?>">Read More</a>
           </div> 
          </div>
          
        </div>
        
        
         <div class="row marg">
        
       <div class="col-md-4 col-sm-6 tra-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="images/pic1.png" alt="" class="img-responsive">
							<div class="desc">
															
								<a href="#"><div class="play"></div></a>
							</div>
						</div>
					</div>
        
        
        <div class="col-md-4 col-sm-6 tra-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="images/pic2.png" alt="" class="img-responsive">
							<div class="desc">
															
								<a href="#"><div class="play"></div></a>
							</div>
						</div>
					</div>
                    
                    
                    <div class="col-md-4 col-sm-6 tra-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="images/pic3.png" alt="" class="img-responsive">
							<div class="desc">
															
								<a href="#"><div class="play"></div></a>
							</div>
						</div>
					</div>
        
        </div>
       
        
      </div>
    </div>
    
    
     <div id="tra-tours" class="footemail">
     <a href="mailto:Customercare@travelb2bhub.com">Customercare@travelb2bhub.com</a>
     </div>
<?php
echo $this->element('footer');
?>