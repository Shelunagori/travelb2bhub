<!--<a href="javascript:void(0)" onclick="window.history.back();">Go Back</a>-->
<!-- <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'dashboard')) ?>" class="link-icon"><?php echo $this->Html->image('arrow.png'); ?></a> -->
<?php 
$unreadMessages = "";
if(isset($unreadChatCount) && $unreadChatCount >0 ) {
	$unreadMessages = $unreadChatCount;
} ?>

	
	
