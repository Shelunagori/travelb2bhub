    <?php echo $this->element('header-back');?>
<div id="tra-contact">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center animate-box">
						<h1>Get In Touch</h1>
                                                   <?= $this->Flash->render() ?>
					</div>
				</div>
                            
				                 <?php  echo $this->Form->create(null, [
    'url' => ['controller' => 'Users', 'action' => 'contactus']
]); ?>
					<div class="row animate-box">
						
						<div class="col-md-8 col-xs-offset-2">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" name="first_name" class="form-control" placeholder="First Name">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" name="last_name" class="form-control" placeholder="Last Name">
									</div>
								</div>
                                <div class="col-md-6">
									<div class="form-group">
										<input type="text" name="phone" class="form-control" placeholder="Phone">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="email" name="email" class="form-control" placeholder="Email">
									</div>
								</div>
                                <div class="col-md-6">
									<div class="form-group">
										<select name="subject" class="form-control">
										<option selected >Subject</option>
										<option value="1">Need Assistance</option>
										<option value="2">Report a bug</option>
										<option value="3">Other</option>
														
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<textarea name="comment" name="first_name" class="form-control" id="" cols="30" rows="7" placeholder="Comment"></textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input type="submit" value="Send Message" class="btn btn-primary">
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
                
                <div class="row animate-box">
                <div class="col-md-10 col-xs-offset-1">
                
                <div class="col-md-3 cont">
                <i class="icon-location"></i> Office Hours<br>
                <span>9:00 AM - 7:00 PM Mon - Fri<br>
                    9:00 AM - 5:00 PM Sat - Sun<br>
					</span>
                </div>
                
                 <div class="col-md-3 cont">
                <i class="icon-mail"></i> Email<br>
                <span>info@travelb2bhub.com</span>
                </div>
                
                 <div class="col-md-3 cont">
               <i class="icon-location-pin"></i> Address<br>
               <span>Office A, Shivam Appartments,<br>
			   Durga Nursery Road-Udaipur<br>
			   Rajasthan, India-313001<br>
			   
              </span>
                </div>
                 <div class="col-md-3 cont">
                <i class="icon-phone2"></i> Call us<br>
                <span>+91-9549220077</span>
                </div>
							
						</div>
                        </div>
                        
			</div>
		</div>
    
    
<div id="map" class="tra-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14026.871322545785!2d77.0622027!3d28.4880432!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1485026574115" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
    
    
        
        
        
   
    <div id="tra-tours" class="footemail"> <a href="mailto:Customercare@travelb2bhub.com">Customercare@travelb2bhub.com</a> </div>
    <?php echo $this->element('footer');?>