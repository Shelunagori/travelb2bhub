<style>
h1,h2,h3,h4,h5,h6{
	font-family: 'Raleway', sans-serif !important;
}
li { list-style: none;}
.review-block .block-text {
    background-color: #eee;
    padding: 10px 15px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}
.carousel-inner {
    position: relative;
    width: 100%;
    overflow: hidden;
}
.carousel {
    position: relative;
}
.review-block .block-text p {
    margin: 0;
    min-height: 120px; 
    height: 120px;
    z-index: 30;
}
hr { margin-top:0px!important;}
.bg-red{
	background-color:#F3565D!important
}
.bg-blue{
	background-color:#1295A2!important;
}
.bg-green{
	background-color:#56BC87!important;
}
.bg-yellow{
	background-color:#DFBA49!important;
}
.bg-white
{
	padding: 30px !important;
}
.arroysign
{
	margin: 17px;
	right: 23px !important;
    width: 3% !important;
    top: 40%;
    bottom: 52%;
}
.rating i {
	color:#1295A2 !important;
}


</style>
<?php 
$lastword=  substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1);
 ?>
		<div class="homepageshow">
		<table width="100%">
			<tr>
 			<?php if($users['role_id'] == 1 || $users['role_id'] == 2) { 
			?>
			<td width="25%">
			<div style="width:100% !important;border-right:1px solid #1c6f7d">
				<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'sendrequest')) ?>">
 				  <div class="small-box bg-blue">
					<div class="inner">
						<table width="100%" border="0"  style="text-align:center">
							<tr>
								<td height="30px"> 	 
									<?php echo $this->Html->image('white-place-request-icon.png',array('style'=>'height:20px;width:20px')); ?>
								</td>
							</tr>
							<tr>
								<td height="25px" style="font-size:8px !important">
									Place Request
								</td>
							</tr>
							<tr>
								<td height="25px" style="font-size:14px"><?php echo ($reqcountNew['value']-$myRequestCountNew); ?></td>
							</tr>
						</table>		
						 
					</div>
				  </div>
				</a>
			</div>
			</td>
			<td width="25%">
			<!-- ./col -->
			 <div style="width:100% !important;border-right:1px solid #1c6f7d">
				<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>">
				   
				  <div class="small-box bg-blue">
					<div class="inner">
						<table width="100%" border="0" style="text-align:center">
							<tr>
								<td height="30px" > 
									<?php echo $this->Html->image('white-my-request-icon.png',array('style'=>'height:20px;width:20px')); ?>
								</td>
							</tr>
							<tr>
								<td height="25px"  style="font-size:8px !important">
									My Requests
								</td>
							</tr>
							<tr>
								<td height="25px"  style="font-size:14px"><?php echo $myRequestCountNew; ?></td>
							</tr>
						</table>		
					</div>
				  </div>
				</a>
			</div>
			</td>
			<?php } 
			if($users['role_id'] == 1 || $users['role_id'] == 3) { 
			?>
			<!-- COls -->
			<?php if($users['role_id'] == 1){?>
			<!--<td width="25%">
			<div style="width:100% !important;border-right:1px solid #1c6f7d">
			<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'dashboard')) ?>">
 				  
				  <div class="small-box bg-blue">
					<div class="inner">
						<table width="100%" border="0" style="text-align:center">
							<tr>
								<td height="40px">
									<i style="font-size:25px" class="fa fa-home"></i>								
 								</td>
							</tr>
							<tr height="40px">
								<td style="font-size:8px">
									Home
								</td>
							</tr> 
						</table>		
					</div>
				  </div>
				</a>
			</div>
			</td>-->	
			<?php } ?> 
			<td width="25%">
			<div style="width:100% !important;border-right:1px solid #1c6f7d">
			<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>">
 				  
				  <div class="small-box bg-blue">
					<div class="inner">
						<table width="100%" border="0" style="text-align:center">
							<tr>
								<td height="26px" > 	 
									<?php echo $this->Html->image('white-back-icon.png',array('style'=>'height:20px;width:20px')); ?>
								</td>
							</tr>
							<tr>
								<td height="25px"  style="font-size:8px !important">
									Respond to Requests
								</td>
							</tr>
							<tr>
								<td height="20px"  style="font-size:14px"><?php echo $respondToRequestCountNew; ?></td>
							</tr>
						</table>		
					</div>
				  </div>
				</a>
			</div>
			</td>
			<?php if($users['role_id'] == 3){?>
			<!--<td width="25%">
			<div style="width:100% !important;border-right:1px solid #1c6f7d">
			<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'dashboard')) ?>">
 				  
				  <div class="small-box bg-blue">
					<div class="inner">
						<table width="100%" border="0" style="text-align:center">
							<tr>
								<td height="40px" > 
									<i style="font-size:25px" class="fa fa-home"></i>								
 								</td>
							</tr>
							<tr>
								<td height="40px"  style="font-size:8px">
									Home
								</td>
							</tr> 
						</table>		
					</div>
				  </div>
				</a>
			</div>
			</td>-->	
			<?php } ?>
			<td width="25%">
			<!---COls--->
			 <div style="width:100% !important">
			<a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'myresponselist')) ?>">
				  
				  <div class="small-box bg-blue">
					<div class="inner">
						<table width="100%" border="0" style="text-align:center">
							<tr>
								<td height="30px" > 
									<?php echo $this->Html->image('white-my-resposes-head.png',array('style'=>'height:20px;width:20px')); ?>
								</td>
							</tr>
							<tr>
								<td height="25px"  style="font-size:8px !important">
									My Responses
								</td>
							</tr>
							<tr>
								<td height="25px"  style="font-size:14px"><?php echo $myReponseCountNew; ?></td>
							</tr>
						</table>		
					</div>
				  </div>
				</a>
			</div>
			</td> 
			<?php }	?>
			</tr>
			</table>
 		  
		</div> 
<?php //} ?>