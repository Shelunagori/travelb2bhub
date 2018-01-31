	<!-- end:header-top -->
    <div id="tra-membership">
    
    <div class="container-fluid member_bg ">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">
                 <h1 class="text-center"><?php echo $membership_text->title; ?></h1>
            </div>
        </div>
    </div>
      <div class="container">
        <div class="row margin-tb35 ">
          <div class="col-md-12 ">
          
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 margin-b50">
                 <h4 class="free_promotion"> <?php echo $membership_text->description; ?></h4>
              </div>		
        <!-- Pricing -->
        <div class="col-xs-12 col-xs-12  mt grey_bg radius5">
       
        <div class="pricing" id="pricing-table">
             
              
                <?php foreach($memberships as $membership ) { ?>
                    <div class="col-md-4">
                    <div class="plan">
                        <div class="pricing-table">
                             <p class="title"><?php echo $membership['membership_name'].'s'; ?></p>
                             <p class="subhead"><b>Rs.<span><?php echo  $membership['price']; ?></span></b> <br>(Valid 1 year)</p>
                              <?php echo  $membership['description']; ?> 
                               <a class="btn btn-default rgt2" href="../users/register?role=<?php echo  $membership['id']; ?>">Get Started</a>
                        </div>
                    </div>
                    </div>
                    <?php } ?>
          </div>
         </div>
        </div>

      </div>
    </div>
    </div>
 <?php echo $this->Html->script(['bootstrap.min','jquery.magnific-popup.min']);?>
