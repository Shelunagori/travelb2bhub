<div class="row">
	<div class="col-md-12">
        <div class="col-md-3">
            <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $PackagePromotionCount;?></h3>
              <p>Package Promotions</p>
            </div>
            <div class="icon">
              <i class="fa fa-briefcase"></i>
            </div>
            <a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'package_report')) ?>" class="small-box-footer">View</a>
          </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $TaxiPromotionCount;?></h3>
              <p>Taxi/Fleet Promotions</p>
            </div>
            <div class="icon">
              <i class="fa fa-taxi"></i>
            </div>
            <a href="<?php echo $this->Url->build(array('controller'=>'TaxiFleetPromotions','action'=>'package_report')) ?>" class="small-box-footer">View</a>
          </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $EventPromotionCount;?></h3>
              <p>Event Planner Promotions</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'package_report')) ?>" class="small-box-footer">View</a>
          </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $HotelPromotionCount;?></h3>
              <p>Hotel Promotions</p>
            </div>
            <div class="icon">
              <i class="fa fa-home"></i>
            </div>
            <a href="<?php echo $this->Url->build(array('controller'=>'HotelPromotions','action'=>'package_report')) ?>" class="small-box-footer">View</a>
          </div>
        </div>
    </div>
</div>