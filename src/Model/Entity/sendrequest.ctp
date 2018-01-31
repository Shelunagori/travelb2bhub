<?php echo $this->element('header-back'); ?>

<?= $this->Html->css(['jquery.steps']); ?>
<?php echo $this->Html->script(['modernizr-2.6.2.min', 'jquery.cookie-1.3.1', 'jquery.steps', 'selectFx']); ?>
<div id="tra-contact">

    <div class="container">

        <?= $this->Flash->render() ?>
        <div class="content">
            <?php
            echo $this->Form->create(null, [
                'type' => 'file',
                'url' => ['controller' => 'Users', 'action' => 'sendrequest']
            ]);
            ?> 
            <h1>Basic Demo</h1>

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

            <div id="wizard" class="cp">
                <h2>PACKAGE</h2>
                <section>
                    <div class="form-box">

                        <div class="title">General Requirements</div>
                        <div class="form">



                            <div class="col-xxs-12 col-xs-12 mt">
                                <div class="input-field">
                                    <label for="from">Total budget</label>
                                    <select name="total_budget" class="form-control">
                                        <option value="" disabled selected>Total budget</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" value="<?php echo $users['id'] ?>">

                            <div class="col-xxs-6 col-xs-6 mt">
                                <div class="input-field">
                                    <label for="from">ADULTS</label>
		
   <div> <input type='button' value='-' class='qtyminus' field='adult' />
    <input type='text' name='adult' value='0' class='qty' />
    <input type='button' value='+' class='qtyplus' field='adult' /></div>

                                </div>
                            </div>

                            <div class="col-xxs-6 col-xs-6 mt">
                                <div class="input-field">
                                    <label for="from">Children below 6 </label>
                                    <div><input type='button' value='-' class='qtyminus1' field='children' />
    <input type='text' name='children' value='0' class='qty' />
    <input type='button' value='+' class='qtyplus1' field='children' /></div>
                                </div>
                            </div>

                        </div>
                    </div>

                </section>

                <h2 class="link">HOTEL</h2>
                <section>
                    <div class="form-box">

                        <div class="title">Stay Requirements</div>
                        <div class="form">
                            <div class="destination">
                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">NO of Rooms</label>

                                        <div class="box-room">

                                            <div class="col-xxs-8 col-xs-8"> <label for="from">Single</label></div>
                                            <div class="col-xxs-4 col-xs-4"><input name="room1" type="text" class="form-control" id="from-place" placeholder="0"/></div>

                                            <div class="col-xxs-8 col-xs-8"> <label for="from">Double</label></div>
                                            <div class="col-xxs-4 col-xs-4"><input name="room2" type="text" class="form-control" id="from-place" placeholder="0"/></div>

                                            <div class="col-xxs-8 col-xs-8"> <label for="from">Triple</label></div>
                                            <div class="col-xxs-4 col-xs-4"><input name="room3" type="text" class="form-control" id="from-place" placeholder="0"/></div>

                                            <div class="col-xxs-8 col-xs-8"> <label for="from">Child with bed</label></div>
                                            <div class="col-xxs-4 col-xs-4"><input name="child_with_bed" type="text" class="form-control" id="from-place" placeholder="0"/></div>

                                            <div class="col-xxs-8 col-xs-8"> <label for="from">Child without bed</label></div>
                                            <div class="col-xxs-4 col-xs-4"><input name="child_without_bed" type="text" class="form-control" id="from-place" placeholder="0"/></div>


                                        </div>    

                                    </div>
                                </div>



                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">Hotel Category</label>
                                        <select name="hotel_category" class="form-control">
                                            <option value="" disabled selected>Hotel Category</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">Meal plan</label>
                                        <select name="meal_plan" class="form-control">
                                            <option value="" disabled selected>EP - European plan</option>
                                            <option value="1">EP - European Plan</option>
                                            <option value="2">CP - Contenental Plan</option>
                                            <option value="3">Modified American Plan</option>
                                            <option value="4">AP - American Plan</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">Destination City</label>
                                        <select name="destination_city[]" class="form-control">
                                            <option value="" disabled selected>Enter Here</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row1">

                                    <div class="col-xxs-6 col-xs-6 mt">
                                        <div class="input-field">
                                            <label for="from">CHECK IN </label>
                                            <input type="text" name="check_in" class="form-control" id="date-start" placeholder="mm/dd/yyyy"/>
                                        </div>
                                    </div>

                                    <div class="col-xxs-6 col-xs-6 mt">
                                        <div class="input-field">
                                            <label for="from">CHECK OUT </label>
                                            <input type="text" name="check_out" class="form-control" id="date-start" placeholder="mm/dd/yyyy"/>
                                        </div>
                                    </div>
                                </div>

                            </div>

                      

                             <div class="col-xxs-12 col-xs-12 mt">
                                   <div class="text-center"> 
                                       
                                    <div class="input_fields_wrap1">
                                    <button class="add_field_button1 but">Add Another Destination</button>

                                </div>
                                    
                                 </div> 
                                </div>
                            
                            
                            

                        </div>


                    </div>
                </section>

                <h2 class="link">TRANSPORT</h2>
                <section>

                    <div class="form-box">

                        <div class="title">Transport Requirements</div>
                        <div class="form">
                            <div class="destination">




                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">Transport Requirements</label>
                                        <select name="transport_requirement" class="form-control">
                                            <option value="" disabled selected>Luxury car</option>
                                            <option value="1">Sedan</option>
                                            <option value="2">Inova/ Tavera</option>
                                            <option value="3">Tempo Traveler</option>
                                            <option value="4">AC Coach</option>
                                            <option value="4">Non AC Bus</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">Pickup City</label>
                                        <select name="pickup_city" class="form-control">
                                            <option value="" disabled selected>Enter Here</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">Start Date</label>
                                        <input name="start_date" type="text" class="form-control" id="date-start" placeholder="mm/dd/yyyy"/>
                                    </div>
                                </div>

                                <div class="col-xxs-6 col-xs-6 mt">
                                    <div class="input-field">
                                        <label for="from">END Date</label>
                                        <input type="text" name="end_date" class="form-control" id="date-start" placeholder="mm/dd/yyyy"/>
                                    </div>
                                </div>


                                <div class="col-xxs-12 text-center">
                                    
                                    <div class="input_fields_wrap">
                                    <button class="add_field_button but">Add Stop</button>
<!--                                    <div><input class="form-control" type="text" name="stops[]"></div>-->
                                </div>
                                    
                                 </div> 


                                





                                <div class="col-xxs-12 col-xs-12 mt">
                                    <div class="input-field">
                                        <label for="from">Final City</label>
                                        <select name="final_city" class="form-control">
                                            <option  value="" disabled selected>Enter Here</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="col-xxs-12 col-xs-12 mt">
                                <div class="input-field">
                                    <label for="from">Comment Box</label>
                                    <textarea name="comment" class="form-control" cols="" rows="4"></textarea>

                                </div>
                            </div> 

                            <div class="margi">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            </form>
        </div>
    </div>
</div>

  <script>
      jQuery(document).ready(function(){
    // This button will increment the value
    $('.qtyplus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
     $('.qtyplus1').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus1").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
});

  </script>
<script>
    $(document).ready(function() {
    var max_fields      = 10; 
    var wrapper         = $(".input_fields_wrap"); 
    var add_button      = $(".add_field_button"); 
    
    var x = 1; 
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapper).append(' <div class="col-xxs-6 col-xs-6 mt"><input class="form-control" placeholder="add stop name" type="text" name="stops[]"/></div><div class="col-xxs-6 col-xs-6 mt2"></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
    </script>

<script>
    $(document).ready(function() {
    var max_fields      = 10; 
    var wrapper         = $(".input_fields_wrap1"); 
    var add_button      = $(".add_field_button1"); 
    
    var x = 1; 
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapper).append('<div>\n\
<input name="room1[]" type="text" class="form-control mt" id="from-place" placeholder="0"/>\n\
<input name="room2[]" type="text" class="form-control mt" id="from-place" placeholder="0"/>\n\
<input name="room3[]" type="text" class="form-control mt" id="from-place" placeholder="0"/>\n\
<input name="child_with_bed[]" type="text" class="form-control mt" id="from-place" placeholder="0"/>\n\
<input name="child_without_bed[]" type="text" class="form-control mt" id="from-place" placeholder="0"/>\n\
<select name="hotel_category[]" class="form-control">\n\
                                            <option value="" disabled selected>Hotel Category</option>\n\
                                            <option value="1">1</option>\n\
                                            <option value="2">2</option>\n\
                                            <option value="3">3</option>\n\
                                            <option value="4">4</option>\n\
                                        </select>\n\
<select name="meal_plan[]" class="form-control">\n\
                                            <option value="" disabled selected>EP - European plan</option>\n\
                                            <option value="1">EP - European Plan</option>\n\
                                            <option value="2">CP - Contenental Plan</option>\n\
                                            <option value="3">Modified American Plan</option>\n\
                                            <option value="4">AP - American Plan</option>\n\
                                        </select>\n\
<select name="destination_city[]" class="form-control">\n\
                                            <option value="" disabled selected>Enter Here</option>\n\
                                            <option value="1">1</option>\n\
                                            <option value="2">2</option>\n\
                                            <option value="3">3</option>\n\
                                            <option value="4">4</option>\n\
                                        </select>\n\
<input class="form-control" type="text" name="check_in[]"/><input class="form-control" type="text" name="check_out[]"/><a href="#" class="remove_field1">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field1", function(e){ 
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
    </script>
<div id="tra-tours" class="footemail">
    <a href="mailto:Customercare@travelb2bhub.com">Customercare@travelb2bhub.com</a>
</div>

<?php echo $this->element('footer'); ?>

