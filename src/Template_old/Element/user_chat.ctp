<style>
.containerss {
    border: 2px solid #dedede;
    background-color:#;
    border-radius: 10px;
    padding:7px;
    padding-bottom:0px;
    margin: 3px 2px;
	
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
			<div class="chat-wrap" style="overflow-y: scroll; height: 380px;">
				<?php 
				foreach($UserChats as $row){
					if($row["user_id"] == $this->request->session()->read('Auth.User.id')) {?>
						<?php 
						if(file_exists('img/user_docs/'.$row["user"]["id"].'/'.$row["user"]["profile_pic"])>0){
							$img= $this->Html->image('user_docs/'.$row["user"]["id"].'/'.$row["user"]["profile_pic"], ["alt"=>"User Pic.", "style"=>"width:58px;height:58px;margin-top: 10px;", "class"=>"img-circle right"]);
						}
						else
						{
							$img= $this->Html->image('profile.png', ["alt"=>"User Pic.", "style"=>"width:58px; height:58px;margin-top: 10px;", "class"=>"img-circle right"]);
						}
					?>
						
						<div class="containerss">
							<?php echo $img;?>
							<p style="text-align: right;"><b><?php echo ucwords($row["user"]["first_name"]); ?></b></p>
							<fieldset style="text-align:left;border-radius:5px;box-shadow:0 1px 5px rgba(0,0,0,0.25), 0 0px 6px rgba(0,0,0,0.22)"><p style="text-align: right;"><?php echo ucwords($row["message"]); ?></p></fieldset>
							<span class="time-left" style="margin-top: 2px;font-size: 10px;"><?php echo date("d M Y h:i A", strtotime($row["created"])); ?></span>
						</div>
			<?php   } 
					else 
					{ ?>
				 
							<?php 
								 
								if(file_exists('img/user_docs/'.$row["user"]["id"].'/'.$row["user"]["profile_pic"])>0){	
									$images= $this->Html->image('user_docs/'.$row["user"]["id"].'/'.$row["user"]["profile_pic"], ["alt"=>"User Pic.", "style"=>"width:58px; height:58px;margin-top: 10px;", "class"=>"img-circle "]);
								}
								else {
									$images=  $this->Html->image('profile.png', ["alt"=>"User Pic.", "style"=>"width:58px; height:58px;margin-top: 10px;", "class"=>"img-circle "]);
								}
						 
							?>
						<div class="containerss darker" style="background-color:#f7f7f7;">
							<?php echo $images;?>
							<p style="text-align: left;"><b><?php echo ucwords($row["user"]["first_name"]); ?></b></p>
							<fieldset style="text-align:left;border-radius:5px; box-shadow:0 1px 5px rgba(0,0,0,0.25), 0 0px 6px rgba(0,0,0,0.22)"><p style="text-align: left;"><?php echo ucwords($row["message"]); ?></p></fieldset>
							<span class="time-right" style="margin-top: 2px; font-size: 10px;"><?php echo date("d M Y h:i A", strtotime($row["created"])); ?></span>
						</div>
						 		 
					<?php } ?>
			<?php } ?>
			</div>
			<!--Chat history/-->
			<div class="form" style="padding:10px">
				<?php  echo $this->Form->create("Users", ['type' => 'file', 'url' => ['controller' => 'Users', 'action' => 'addChat'], 'id'=>"UserChatForm"]); ?>
				<input type="hidden" name="request_id" id="chat_request_id" value="<?php echo $requestId; ?>">
				<input type="hidden" name="chat_user_id" id="chat_user_id" value="<?php echo $chatUserId; ?>">
				<label for="message">Message</label>
				<div class="input-group">
					<input id="message"  name="message" type="text" class="form-control input-sm" autocomplete="off" placeholder="Type your message here..." />
					<input type="hidden" name="screen_id" id="screen_id" value="<?php echo $screen_id; ?>">
					<span class="input-group-btn">
						<button type="submit" name="submit" class="btn btn-info btn-sm" value="Send">Send</button>
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