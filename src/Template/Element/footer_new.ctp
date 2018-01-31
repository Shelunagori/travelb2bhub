</div>
<?php echo $this->Html->script(['jquery.validate']);?>
  <?php $currentUrl = explode("/",\Cake\Routing\Router::url()); ?>
   <?php  if($currentUrl[1]=='users' && $currentUrl[2]!='login' && $currentUrl[2]!='forgot-password'   && $currentUrl[2]!='register'   && $currentUrl[2]!='viewprofile') {   ?>
<style>
@media (min-width: 320px) and (max-width: 767px) {
 footer{
        margin-bottom: 64px!important;
    }
    }
</style>
<?php } ?>

<div class="container-fluid mail_section">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
               <a href="mailto:contactus@travelb2bhub.com">
                   <h3> <?php echo $this->Html->image('mail-icon.png', array("class" => "img-responsive center_img" )) ; ?>
                 <?php echo $emailsystem['value']; ?>    
                   </h3>
               </a>
            </div>
        </div>
     </div>
     <footer>
    <div class="container padding-t30 padding-b10 center_on_mobile">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 f_our_links">
               <h4 class="heading">OUR LINKS</h4>  
                <ul class="">
<li><a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'home')) ?>">Home</a></li>
<li><a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'memberships')) ?>">Membership</a></li>
<li><a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'aboutus')) ?>">About us</a></li>
<li><a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'contactus')) ?>">Contact us</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12 f_policy">
                <h4 class="heading">POLICY</h4>  
                <ul class="">
                  <li><a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'privacypolicy')) ?>">Privacy policy</a></li>
					<li><a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'termsandconditions')) ?>">Terms and conditions</a></li>
						<li><a href="<?php echo $this->Url->build(array('controller'=>'pages','action'=>'faq')) ?>">FAQs</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 f_sign_up">
                <h4 class="heading">SIGN UP FOR NEWSLETTER</h4>
                <form>
                  <div class="form-group margin-b25">
                  <input type="email" class="form-control" id="InputEmail" placeholder="Enter Email address" required>
                  </div>
                  <input type="submit" id="newsLatterSubmit" class="btn btn-default f_btn" value="Submit">
                </form>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 f_contact">
                <h4 class="heading">CONTACT INFO</h4>    
                <p><?php echo $this->Html->image('address-icon.png', array("class" => "img-responsive " )) ; ?>
                    <span> <?php echo $addresssystem['value']; ?> </span>
                </p>
                <p><?php echo $this->Html->image('mobile-icon.png', array("class" => "img-responsive padding4" )) ; ?>
                    <span>Phone:<a href="tel:<?php echo $phonesystem['value']; ?>"> <?php echo $phonesystem['value']; ?></a>     </span>
                </p>
            </div>
        </div>
     </div>
    <div class="container-fluid black_bg center_on_mobile">
        <div class="margin-lr7 padding-tb10 ">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-lg-push-9 col-md-push-9 col-sm-push-9 social">
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/TravelB2BHub/" target="_blank" class="facebook">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 col-lg-pull-3 col-md-pull-3 col-sm-pull-3 col-xs-12 developed">
                    <p class="copyright">Web Design Udaipur By : 
                        <a href="http://www.elixirinfo.com/" target="_blank">Elixir Technologies Pvt. Ltd. </a>					
                    </p>
                </div>
            </div>
        </div>
     </div>
<div id="feedback">
<div id="feedback-tab">Feedback </div>
		<div id="feedback-form" style='display:none;' class="col-xs-4 col-md-4 panel panel-default">
		<span id="span">X</span>
		 <?php  echo $this->Form->create("Feedback", ['url' => ['controller' => 'Pages', 'action' => 'feedback'], "id"=>"feedbackform", "class"=>"form panel-body"]); ?>
			<p class="feedsuccess" style="color:green; font-size:12px; text-align:center; font-weight:bold; display:none;"  >Your Feedback submitted successfully</p>
				<div class="form-group">
                     <label for="from">Your Name
                            <span class="asterisk">
                                  <img src="/img/Asterisk.png" class="img-responsive">
                              </span>    
                        </label>
					<input class="form-control" name="name1" autofocus placeholder="Enter Here" type="text" />
				</div>
			<div class="form-group">
                     <label for="from">Your Phone
                            <span class="asterisk">
                                  <img src="/img/Asterisk.png" class="img-responsive">
                              </span>    
                        </label>
					<input class="form-control" name="phone1" autofocus placeholder="Enter Here" type="text" />
				</div>
				<div class="form-group">
                    <label for="from">Your E-mail
                            <span class="asterisk">
                                  <img src="/img/Asterisk.png" class="img-responsive">
                              </span>    
                        </label>
					<input class="form-control" name="email1" autofocus placeholder="Enter Here" type="email" />
				</div>
			
				<div class="form-group">
                     <label for="from">Comment
                            <span class="asterisk">
                                  <img src="/img/Asterisk.png" class="img-responsive">
                              </span>    
                        </label>
					<textarea class="form-control" name="body1" required placeholder="Please write your feedback here..." rows="3"></textarea>
					
					
				</div>
				<button class="btn btn-primary pull-right" type="submit">Send</button>
<input type="hidden" value="5000" id="ajaxcount" name="ajaxcount"/>
			</form>
		</div>
		
	</div>
<style type="text/css">
.panel {
margin-bottom: 0px;
}
</style>
<script>
$(function() {
	$("#feedback-tab").click(function() {
		
		$("#feedback-form").toggle("slide");
	});
	$("#span").click(function() {
		
		$("#feedback-form").hide("slide");
	});

	$("#feedback-form form").on('submit', function(event) {
		var $form = $(this);
		$.ajax({
			type: $form.attr('method'),
			url: $form.attr('action'),
			data: $form.serialize(),
			success: function() {
$("input[name='name1']").val("");
$("input[name='phone1']").val("");
$("input[name='email1']").val("");
$("textarea[name='body1']").val("");
			$(".feedsuccess").show();

				
			}
		});
		event.preventDefault();
	});
});

$('#feedbackform').validate({
	rules: {
		"name1" : {
			required : true
		},
		"phone1" : {
			required : true
		},
		"email1": {
			required : true,
			email: true
		},
		"body1": {
			required : true,
		},
		
	},
	messages: {
		"name1" : {
			required : "Please enter Name."
		},
		"phone1" : {
			required : "Please enter Phone"
		},
		"email1": {
			required : "Please enter email.",
			email : "Please enter valid email."
		},
		"body1": {
			required : "Please enter feedback.",
		}
	}
});
</script>
<?php if ($this->request->session()->read('Auth.User')){?>
<script>
$(document).ready(function (){
	$("#chat_icon").mouseover(function (e) {
		e.preventDefault();
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'clearreadChats')) ?>";
			$.ajax({
				url:url,
				type: 'POST',
				data: {clearchat:'1'}
			}).done(function(result){
				if(result == 1) {
					var a= 1;
					//$(".chat_count").css("display", "none");
					$(".chat_count").html('0');
				}
			});
	});
	
var ajaxcount = $('#ajaxcount').val();
setInterval(get_notification, ajaxcount);

function get_notification(){
	var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'getnotifications')) ?>";
	$.ajax({
				url:url,
				type: 'POST',
				data: {clearchat:'1'}
			}).done(function(result){
				if(result==0 || result=='0'){
					if($('div').hasClass('modal-backdrop')){
   				$('div').removeClass('modal-backdrop');
   				$('div').removeClass('fade');
   				$('div').removeClass('in');
					}
$(".chat_count").html('0');
					var donothing;				
				}else{
					if($('div').hasClass('modal-backdrop')){
   				$('div').removeClass('modal-backdrop');
   				$('div').removeClass('fade');
   				$('div').removeClass('in');
					}
					//modal-backdrop fade in
					$(".notification_list").html(result);
				}
			});
	}

$(".chat_message").click(function () {
	$('#ajaxcount').val('100000');
});

$(".close").click(function () {
	$('#ajaxcount').val('5000');
});
	
});
	
getrespondrequestcounts();
	
function getrespondrequestcounts(){
	var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'getRespondrequestCounts')) ?>";
	$.ajax({ url:url,
			 type: 'POST',
			 data: {getres:'1'}
			}).done(function(result){
		$(".respondrequestcount").html(''+result+'');
		$(".respondrequestcount_mobile").html(result);
		
		});
    setTimeout(getrespondrequestcounts, 5000);
}
getmyrequestcounts();
	
function getmyrequestcounts(){
	var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'getMyrequestCounts')) ?>";
	$.ajax({ url:url,
			 type: 'POST',
			 data: {getres:'1'}
			}).done(function(result){
		
		$(".myrequestcount").html(''+result+'');
		$(".myrequestcount_mobile").html(result);
		
		});
    setTimeout(getmyrequestcounts, 5000);
}

	getmyresponsecounts();
	
function getmyresponsecounts(){
	var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'getMyresponseCounts')) ?>";
	$.ajax({ url:url,
			 type: 'POST',
			 data: {getres:'1'}
			}).done(function(result){
		
		$(".myresponsecount").html(''+result+'');
		$(".myresponsecount_mobile").html(result);
		
		});
    setTimeout(getmyresponsecounts, 5000);
}
	
	
	
</script>
<?php }?>
</footer>
