<style>
 

.containerss {
    border: 2px solid #dedede;
    background-color:#;
    border-radius: 5px;
    padding:20px;
    padding-bottom:0px;
    margin: 3px 0;
	
}

.darker {
    border-color: #ccc;
    background-color: #ddd;
}

.containerss::after {
    content: "";
    clear: both;
    display: table;
}

.containerss img {
    float: left;
    max-width: 60px;
    width: 100%;
    margin-right: 20px;
    border-radius: 50%;
}

.containerss img.right {
    float: right;
    margin-left: 20px;
    margin-right:0;
}

.time-right {
    float: right;
    color: #aaa;
}

.time-left {
    float: left;
    color: #999;
}
</style>
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Chat</h4>
		</div>
		<div class="modal-body">
			<!--Chat history-->
			<div class="chat-wrap" style="overflow-y: scroll; height: 400px;">
				<?php 
				foreach($UserChats as $row){
					if($row["user_id"] == $this->request->session()->read('Auth.User.id')) {?>
						<?php 
						if(file_exists($this->Html->image('user_docs/'.$row["user"]["id"].'/'.$row["user"]["profile_pic"]))){
							$img= $this->Html->image('user_docs/'.$row["user"]["id"].'/'.$row["user"]["profile_pic"], ["alt"=>"User Pic.", "style"=>"width:58px;height:58px;", "class"=>"img-circle right"]);
						}
						else
						{
							$img= $this->Html->image('no-profile-image.jpg', ["alt"=>"User Pic.", "style"=>"width:58px; height:58px;", "class"=>"img-circle right"]);
						}
						?>
						
						<div class="containerss">
							<?php echo $img;?>
							<p style="text-align: right;"><b><?php echo ucwords($row["user"]["first_name"]); ?></b></p>
							<fieldset style="text-align:left;border-radius:20px;"><p style="text-align: right;"><?php echo ucwords($row["message"]); ?></p></fieldset>
							<span class="time-left"><?php echo date("d M Y h:i A", strtotime($row["created"])); ?></span>
						</div>
			<?php   } 
					else 
					{ ?>
				 
							<?php 
								if(file_exists($this->Html->image('user_docs/'.$row["user"]["id"].'/'.$row["user"]["profile_pic"]))){
									
									$images= $this->Html->image('user_docs/'.$row["user"]["id"].'/'.$row["user"]["profile_pic"], ["alt"=>"User Pic.", "style"=>"width:58px; height:58px;", "class"=>"img-circle "]);
								}
								else {
									$images=  $this->Html->image('no-profile-image.jpg', ["alt"=>"User Pic.", "style"=>"width:58px; height:58px;", "class"=>"img-circle "]);
								}
						 
							?>
						<div class="containerss darker" style="background-color:#EDEDED;">
							<?php echo $images;?>
							<p style="text-align: right;"><b><?php echo ucwords($row["user"]["first_name"]); ?></b></p>
							<fieldset style="text-align:left;border-radius:20px;"><p style="text-align: right;"><?php echo ucwords($row["message"]); ?></p></fieldset>
							<span class="time-right"><?php echo date("d M Y h:i A", strtotime($row["created"])); ?></span>
						</div>
						 		 
					<?php } ?>
			<?php } ?>
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
						<button type="submit" name="submit" class="btn btn-orange btn-sm" value="Send">Send</button>
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