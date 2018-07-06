<?php echo $this->element('header');?>
<?php echo $this->element('loginonbanner');?>
 <div id="tra-tours">
      <div class="container">
        <div class="row">
          <div class="col-md-12  text-center heading-section animate-box">
            <h3>How it works</h3>
			<p>TravelB2BHub.com serves as a <b>COMMISSION FREE</b> Business to Business, tourism trading portal that directly connects Travel Agents, Hoteliers, and Event Planners in India. In addition, it facilitates the sale of tourism related services in locations were the user doesn't have any reach or contacts.<br>
			<b>Choose your category to find out more:<b></p>
            
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 animate-box fadeInUp animated" data-animate-effect="fadeIn">
            <div class="service">
            <div class="icons"> <?php echo $this->Html->image('icon1.png'); ?> </div>
             <h3>Travel Agents</h3>
             <span></span>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor blandit metus, ut</p>
		    <a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'travel-agent')) ?>">Click to view video</a>
           </div> 
          </div>
          <div class="col-md-4 animate-box fadeInUp animated" data-animate-effect="fadeIn">
            <div class="service">
            <div class="icons"> <?php echo $this->Html->image('hotel-icon2.png'); ?> </div>
             <h3>Hoteliers</h3>
             <span></span>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor blandit metus, ut</p>
            <a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'hoteliers')) ?>">Click to view video</a>
           </div> 
          </div>
          <div class="col-md-4 animate-box fadeInUp animated" data-animate-effect="fadeIn">
            <div class="service">
            <div class="icons"> <?php echo $this->Html->image('icon3.png'); ?> </div>
             <h3>Event Planners</h3>
             <span></span>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor blandit metus, ut</p>
            <a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'event-planners')) ?>">Click to view video</a>
           </div> 
          </div>
          
        </div>
        
        
        
       
        
      </div>
    </div>
    
    
     <div id="tra-tours" class="footemail">
     <a href="mailto:Contactus@travelb2bhub.com">Contactus@travelb2bhub.com</a>
     </div>
<?php
echo $this->element('footer');
?>