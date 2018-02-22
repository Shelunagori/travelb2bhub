	  <div class="modal-content"><?php echo $this->Html->script(['jquery.validate']);?>
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title" style="text-align:left">Add Review</h4>
		</div>
		<div class="modal-body" style="height:224px">
<div class="container-fluid" id="profile" >
	<div class="row tra-section-gray equal_column">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 ">
		
        </div>
	</div>
</div>

	<?php
	 $comment ='';
 	 $rating = '0';
 	 $testimonialid = 0;
  
	 if(count($testimonialedit) > 0 ){
	 	//print_r($testimonialedit);
	 
	 $comment = $testimonialedit["comment"];
    $rating = $testimonialedit["rating"];
    $testimonialid = $testimonialedit["id"];
	 }
	echo $this->Form->create("Promotions", ['type' => 'file', 'class'=> 'form-horizontal', 'url' => ['controller' => 'Users', 'action' => 'addtestimonial',$authoruserId], 'onSubmit' => 'return addtestimonial();', 'id'=>"addtestimonial"]); ?>
                       
								<!-- Text input-->
						<div class="form-group">
						<label class="col-md-4 control-label" for="Rating">Rating <span class="asterisk">

						</span></label>
						<div class="col-md-6 margin_t20_on_mob">
						<input class="star star-5" id="star-5<?php echo $reqid; ?>" type="radio" name="rating" <?php if($rating=="5") {echo "checked";} ?> value="5"/>
						<label class="star star-5" for="star-5<?php echo $reqid; ?>"></label>
						<input class="star star-4" id="star-4<?php echo $reqid; ?>" type="radio" name="rating" <?php if($rating=="4") {echo "checked";} ?> value="4"/>
						<label class="star star-4" for="star-4<?php echo $reqid; ?>"></label>
						<input class="star star-3" id="star-3<?php echo $reqid; ?>" type="radio" name="rating" <?php if($rating=="3") {echo "checked";} ?> value="3"/>
						<label class="star star-3" for="star-3<?php echo $reqid; ?>"></label>
						<input class="star star-2" id="star-2<?php echo $reqid; ?>" type="radio" name="rating" <?php if($rating=="2") {echo "checked";} ?> value="2"/>
						<label class="star star-2" for="star-2<?php echo $reqid; ?>"></label>
						<input class="star star-1" id="star-1<?php echo $reqid; ?>" type="radio" name="rating" <?php if($rating=="1") {echo "checked";} ?> value="1"/>
						<label class="star star-1" for="star-1<?php echo $reqid; ?>"></label>
						<input style="display:none;" type="radio" name="rating" <?php if($rating=="0") {echo "checked";} ?> value="0"/>
						</div>
						</div>
						<div class="form-group" style="display:none;">
						<label class="col-md-4 control-label" for="user_id">User Name</label>  
						<div class="col-md-6"  >
						<input id="user_name" name="user_name" placeholder="User Name" readonly class="form-control input-md" required="" value="<?php echo $userDetails->first_name; ?> <?php echo $userDetails->last_name; ?>" type="text">
						<input id="author_id" name="author_id"  class="form-control input-md" required="" value="<?php echo $authoruserId; ?>" type="hidden">
						<input id="user_id" name="user_id"  class="form-control input-md" required="" value="<?php echo $reviewuserId; ?>" type="hidden">
						<input id="request_id" name="request_id"  class="form-control input-md" required="" value="<?php echo $reqid; ?>" type="hidden">
						<input id="testimonial_id" name="testimonialid"  class="form-control input-md" required="" value="<?php echo $testimonialid; ?>" type="hidden">
						</div>
						</div>

						<div class="form-group">
						<label class="col-md-4 control-label" for="comment">Comment</label>
						<div class="col-md-6">
						<textarea name="comment" class="form-control" id="comment"><?php echo $comment; ?></textarea>
						</div>
						</div>

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group margin-t30 margin-b15 text-center">
						<ul class="btn_on_prmotion"> 
						<li align="center">
						<input type="submit" name="submittestimonial" id="submittestimonial" class="btn btn-primary" value="Submit ">
						</li>

					</ul>
				</div>
			</div>
			
		</form>
	</div>
	<script>
function addtestimonial() {
    var radios = document.getElementsByName("rating");
    var formValid = false;
    var i = 0;
    while (!formValid && i < radios.length) {
        if (radios[i].checked) formValid = true;
        i++;        
    }

    if (!formValid) alert("Please Select Rating!");
    return formValid;
}	
	</script>
	  </div>