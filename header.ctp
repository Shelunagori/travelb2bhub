<div id="tra-wrapper">
  <div id="tra-page">
    <header id="myCarousel" class="carousel slide" >
      <div class="tra-hero">
        <div class="tra-cover">
         
          <div class="container top">
            <div class="nav-header ttp"> <a href="#" class="js-tra-nav-toggle tra-nav-toggle dark"><i></i></a>
              <h1 id="tra-logo"><a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'home')) ?>"><?php echo $this->Html->image('logo.png', ['alt' => 'Site Logo']); ?> </a></h1>
              
              <div class=" col-md-6 right download-app text-right"><a href="#"><?php echo $this->Html->image('android.png'); ?> </a> <a href="#"><?php echo $this->Html->image('app.png'); ?></a></div>
              <!-- START #tra-menu-wrap -->
              <nav id="tra-menu-wrap" role="navigation">
                <ul class="sf-menu" id="tra-primary-menu">
                  <li class="active"><a href="<?php echo $this->Html->url(array('controller'=>'pages','action'=>'home')) ?>">Home</a></li>
                  <li><a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'memberships')) ?>">Membership</a></li>
                  <li><a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'promotions')) ?>">Promotions</a></li>
                  <li><a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'services')) ?>">Services </a></li>
                  <li><a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'aboutus')) ?>">About Us</a></li>
                  <li><a href="#">Testimonial</a></li>
                  <li><a href=" <?php echo $this->Url->build(array('controller'=>'pages','action'=>'contactus')) ?>">Contact Us </a></li>
                </ul>
              </nav>
            </div>
          </div>
            