<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
    $rsmsg = "Thank you for registering with Travelb2bhub.com! Please activate your account by clicking on the link sent to your e-mail address. If you do not receive an e-mail in your inbox, please check SPAM or JUNK folder.";
$textalert = "Welcome";
}else{
$message = h($message);
	if($message==$rsmsg){
	$textalert = "Welcome";
	}else{
	$textalert = "Alert";
	}
}
?>
<div id="myModalflash" class="modal in fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">
<?php echo $textalert; ?></h4>
		</div>
		<div class="modal-body">
		 <div class="message" style="font-weight: 700;margin: 15px;font-size: 16px">
		 <?php if($message==$rsmsg){?>
		 Thank you for registering with Travelb2bhub.com! <br/>Please activate your account by clicking on the link sent to your e-mail address. <br/><br/>If you do not receive an e-mail in your inbox, please check SPAM or JUNK folder.
		 <?php }else{ echo $message; } ?></div>
		</div>
		</div>
		</div>
		</div>
		 <script>
                        $(document).ready(function () {
                            $('#myModalflash').show();
                           
                            
                            $(".close").click(function() {
                            	 $('#myModalflash').removeClass('in');
                            	 $('#myModalflash').hide();
                            });
                        });
                    </script> 
