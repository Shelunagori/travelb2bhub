	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Chat</h4>
		</div>
		<div class="modal-body">
			<!--Chat history-->
			<div class="chat-wrap">
				<ul class="chat">
					<?php 
					foreach($UserChats as $row){
						if($row["user_id"] == $this->request->session()->read('Auth.User.id')) {?>
							<li class="right clearfix">
								<span class="chat-img pull-right">
									<?php echo $this->Html->image('user_docs/'.$row["user"]["id"].'/'.$row["user"]["profile_pic"], ["alt"=>"User Pic.", "style"=>"width:50px; height:50px;", "class"=>"img-circle"]);?>
									<!-- <img src="/img/user_docs/143/1488187056334449536.jpg" style="width:50px; height:50px;"  alt="User Avatar" class="img-circle"> -->
								</span>
								<div class="chat-body clearfix">
									<div class="header">
										<small class=" text-muted" style="float:left;"><?php echo date("d M Y h:i A", strtotime($row["created"])); ?></small>
										<strong class="pull-right primary-font"><?php echo $row["user"]["first_name"]; ?></strong>
									</div><br/>
									<p style="float: left;"><?php echo $row["message"]; ?></p>
								</div>
							</li>
						<?php } else {?>
							<li class="left clearfix">
								<span class="chat-img pull-left">
									<?php echo $this->Html->image('user_docs/'.$row["user"]["id"].'/'.$row["user"]["profile_pic"], ["alt"=>"User Pic.", "style"=>"width:50px; height:50px;", "class"=>"img-circle"]);?>
								</span>
								<div class="chat-body clearfix">
									<div class="header">
										<strong class="primary-font" style="float:left;"><?php echo $row["user"]["first_name"]; ?></strong> <small class="pull-right text-muted">
										<?php echo date("d M Y h:i A", strtotime($row["created"])); ?></small>
									</div><br/>
									<p style="float: left;"><?php echo $row["message"]; ?></p>
								</div>
							</li>
						<?php } ?>
					<?php } ?>
			</ul>
			</div>
			<!--Chat history/-->
			<div class="form">
				<?php  echo $this->Form->create("Users", ['type' => 'file', 'url' => ['controller' => 'Users', 'action' => 'addChat'], 'id'=>"UserChatForm"]); ?>
				<input type="hidden" name="request_id" id="chat_request_id" value="<?php echo $requestId; ?>">
				<input type="hidden" name="chat_user_id" id="chat_user_id" value="<?php echo $chatUserId; ?>">
				<div class="ap-border"></div>
				<label for="message">Message</label>
				<div class="input-group">
					<input id="message"  name="message" type="text" class="form-control input-sm" autocomplete="off" placeholder="Type your message here..." />
					<input type="hidden" name="screen_id" id="screen_id" value="<?php echo $screen_id; ?>">
					<span class="input-group-btn">
						<input type="submit" name="submit" class="btn btn-orange btn-sm" value="Send">
					</span>
				</div>
				</form>
			</div>
		</div>
	  </div>
	  
	
<script>
$('#UserChatForm').validate({
	rules: {
		"message" : {
			required : true
		}
	},
	messages: {
		"message" : {
			required : "Please enter message."
		}
	},
	ignore: ":hidden:not(select)"
});
function f1(res){
	var result = res.split(",");
	$('#chat_request_id').val(result[0]);
	$('#chat_user_id').val(result[1]);
}
</script>