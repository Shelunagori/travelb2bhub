<?php echo $this->Html->script(['jquery.validate']);?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div id="tra-contact">
    
    <div class="container-fluid contact_bg margin-b35">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">
                 <h1 class="text-center">Contact Us</h1>
            </div>
        </div>
    </div>
    <div class="container margin-b35">
    <div class="row">
    <div class="col-md-12">
           <?php echo  $this->Flash->render() ?>
           </div>
     </div>
        <?php  echo $this->Form->create("Contact", ['url' => ['controller' => 'Pages', 'action' => 'contactus'], "id"=>"ContactUsForm"]); ?>
        <div class="row ">
            
            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">

                <div class="cont">
                    <h5><i class="fa fa-hourglass-start" aria-hidden="true"></i> Office Hours</h5>
                    <span>
                         <?php echo $officehourssystem['value']; ?>
                    </span>
                </div>

                <div class="cont">
                    <h5><i class="fa fa-envelope-o" aria-hidden="true"></i> Email</h5>
                    <span>
                        <a href="mailto:<?php echo $emailsystem['value']; ?>"><?php echo $emailsystem['value']; ?></a>
                    </span>
                </div>

                <div class="cont">
                    <h5><i class="fa fa-home" aria-hidden="true"></i> Address</h5>
                    <span><?php echo $addresssystem['value']; ?>
                    </span>
                </div>
               <div class="cont hidden-xs">
                    <h5><i class="fa fa-mobile" aria-hidden="true"></i> Call us</h5>
                    <span><?php echo $phonesystem['value']; ?></span>
                </div>
                 <div class="cont hidden-lg hidden-md hidden-sm">
                    <h5><i class="fa fa-mobile" aria-hidden="true"></i> Call us</h5>
                    <span><a href="tel:<?php echo $phonesystem['value']; ?>"><?php echo $phonesystem['value']; ?></a></span>
                </div>

            </div>
            
            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12 contact_border">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <label for="from">First Name
                            <span class="asterisk">
                                <img src="../img/Asterisk.png" class="img-responsive">
                            </span>    
                        </label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $user["first_name"];?>">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <label for="from">Last Name
                            <span class="asterisk">
                                <img src="../img/Asterisk.png" class="img-responsive">
                            </span>       
                        </label>
                        <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $user["last_name"];?>">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <label for="from">Phone
                             <span class="asterisk">
                                <img src="../img/Asterisk.png" class="img-responsive">
                            </span>       
                        </label>
                        <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $user["mobile_number"];?>" placeholder="+91-0123456789">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <label for="from">Email
                             <span class="asterisk">
                                <img src="../img/Asterisk.png" class="img-responsive">
                            </span>       
                        </label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $user["email"];?>" >
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                        <label for="from">Subject</label>
                            <select name="subject" id="subject" class="form-control" >
                                <option selected value="Feedback" >Feedback</option>
                                <option value="Need Assistance">Need assistance</option>
                                <option value="Report a bug">Report a bug</option>
                                <option value="Other">Other</option>	
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                        <label for="from">Comment
                             <span class="asterisk">
                                <img src="../img/Asterisk.png" class="img-responsive">
                            </span>       
                        </label>
                            <textarea name="comment" id="comment" class="form-control" id="" cols="30" rows="2" ></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  margin-t20">
                        <div class="form-group">
                            <input type="submit" value="Send Message" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        
        </form>        
            
        </div>
    
      
    
     <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="map" class="tra-map">
                   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3628.1975449561314!2d73.70738001427483!3d24.582377784185816!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3967e585002f71bd%3A0x6fa687126624880b!2sShivam+Residency!5e0!3m2!1sen!2sin!4v1497001513971" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>

                </div>
            </div>
        </div>

    </div>

</div>
    
    

<script>
$('#ContactUsForm').validate({
	rules: {
		"first_name" : {
			required : true
		},
		"last_name" : {
			required : true
		},
		"email": {
			required : true,
			email: true
		},
		"phone": {
			required : true,
		},
		"comment": {
			required: true
		}
	},
	messages: {
		"first_name" : {
			required : "Please enter first name."
		},
		"last_name" : {
			required : "Please enter last name."
		},
		"email": {
			required : "Please enter email.",
			email : "Please enter valid email."
		},
		"phone": {
			required : "Please enter phone number.",
		},
		"comment": {
			required: "Please enter comment."
		}
	}
});
</script>