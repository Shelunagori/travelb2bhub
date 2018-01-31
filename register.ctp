<style>
    p.p-policy-content {
        line-height: 23px;
        text-align: justify;
    }
    h3.p-policy-head {
        margin-bottom: 50px;
    }

    .policy-details {
        margin-top: 25px;
    }

</style>
<?php echo $this->element('header-back'); ?>
 <?=$this->Html->css(['jquery.steps']); ?>
  <?php echo $this->Html->script(['modernizr-2.6.2.min', 'jquery.cookie-1.3.1','jquery.steps','selectFx']);?>

<div id="tra-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12 animate-box">
                <?= $this->Flash->render() ?>
                <h1 class="text-center">Register</h1>

                <div class="content">
                   <?php  
                        echo $this->Form->create(null, [
                                                            'type' => 'file',
                                                            'url' => ['controller' => 'Users', 'action' => 'register'] 
                        ]); 
                    ?> 
					
					<script>
                        $(function ()
                        {
                            $("#wizard").steps({
                                headerTag: "h2",
                                bodyTag: "section",
                                transitionEffect: "slideLeft"
                            });
                        });
                    </script>

                    <div id="wizard">
                        
                         
                        <section>
                          

                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">User Category</label>
                                        <select name="role_id" class="form-control" required="">
                                            <option value="" disabled selected>Select</option>
                                            <option value="1">Travel Agent</option>
                                            <option value="2">Event Planner</option>
                                            <option value="3">Hotelier</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">Company Name</label>
                                        <input type="text" name="company_name" class="form-control" id="from-place" placeholder="Enter Here"/>
                                    </div>
                                </div>

                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">First Name</label>
                                        <input type="text" name="first_name" class="form-control" id="from-place" placeholder="Enter Here"/>
                                    </div>
                                </div>





                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" id="from-place" placeholder="Enter Here"/>
                                    </div>
                                </div>

                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">Email*</label>
                                        <input type="email" name="email" class="form-control" id="from-place" placeholder="Enter Here"/>
                                    </div>
                                </div>

                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">Password*</label>
                                        <input type="password" name="password" class="form-control" id="from-place" placeholder="Enter Here"/>
                                    </div>
                                </div>

                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">Confirm Password*</label>
                                        <input type="password" name="password" class="form-control" id="from-place" placeholder="Enter Here"/>
                                    </div>
                                </div>
								
								<div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">Contact No.*</label>
                                        <input type="text" name="mobile_number" class="form-control" id="from-place" placeholder="Primary Contact Number"/>
                                    </div>
                                </div>
                           
                        </section>

                        
                        <section>
                          
                                                              

                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">Address</label>
                                        <input type="text" name="address" class="form-control" id="from-place" placeholder="Enter Here"/>
                                    </div>
                                </div>





                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">Country</label>
                                        <select name="country_id" class="form-control">
                                            <option value="" disabled selected>Enter Here</option>
                                            <?php foreach($countries as $country){
                                                
                                                
                                            ?>
                                             <option value="<?php echo $country['id']; ?>"><?php echo $country['country_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">City</label>
                                        <select name="city_id" class="form-control">
                                            <option value="" disabled selected>Enter Here</option>
                                            <?php foreach($cities as $city){
                                               
                                                
                                            ?>
                                             <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">State</label>
                                        <select class="form-control">
                                            <option value="" disabled selected>Enter Here</option>
                                            <?php foreach($states as $state){
                                           
                                                
                                            ?>
                                             <option value="<?php echo $state['id']; ?>"><?php echo $state['state_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="image-upload">
                                        <label for="file-input">
                                            User Profile Picture<br><?php echo $this->Html->image('img-icon.png'); ?>
                                        </label>

                                        <input id="file-input" name="image" type="file"/>  Upload Picture
                                    </div>
                                </div>

                              

                                <div class="col-md-12 center col-md-12 mt">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>

                  
                                </section>
                                </form>
                                </div>
                                </div>






                                </div>
                                </div>







                                </div>
                                </div>


                                <div id="tra-tours" class="footemail">
                                <a href="mailto:Contactus@travelb2bhub.com">Contactus@travelb2bhub.com</a>
                                </div>
                                <?php echo $this->element('footer'); ?>

