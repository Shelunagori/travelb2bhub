<style>
h1,h2,h3,h4,h5,h6{
	font-family: 'Raleway', sans-serif !important;
}
.bg-blue{
	background-color:#1295A2!important;
} 
.fixedDivCss {
  overflow: hidden;
  background-color: #FFF;
  position: fixed;
  bottom: -20px;
  width: 100%;
  left: 0px;
}
.inner{
	padding:5px !important;
	bottom:0;
} 
 </style>
<?php 
$page_name=$this->request->params['action']; 
$controller=$this->request->params['controller']; 
if($controller=='Users'){
if($page_name!='viewprofile'){
if($page_name!='sendrequest'){ 

 ?>
		<div class="homepageshow fixedDivCss">
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
								<td height="25px"> 	 
									<?php echo $this->Html->image('white-place-request-icon.png',array('style'=>'height:20px;width:20px')); ?>
								</td>
							</tr>
							<tr>
								<td height="20" style="font-size:8px !important">
									Place Request
								</td>
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
								<td height="25px" > 
									<?php echo $this->Html->image('white-my-request-icon.png',array('style'=>'height:15px;width:15px')); ?> 
									<span style="position: absolute;top: 3px; text-align: center; border-radius: 100%; background-color: #fff;color: #000; border: 1px solid #afafaf;"class="label"><?php echo $myRequestCountNew; ?></span>
								</td>
							</tr>
							<tr>
								<td height="20px"  style="font-size:8px !important">
									My Requests
								</td>
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
								<td height="25px" > 	 
									<?php echo $this->Html->image('white-back-icon.png',array('style'=>'height:15px;width:15px')); ?>
									<span style="position: absolute;top: 3px; text-align: center; border-radius: 100%; background-color: #fff;color: #000; border: 1px solid #afafaf;"class="label"><?php echo $respondToRequestCountNew; ?></span> 
								</td>
							</tr>
							<tr>
								<td height="20px"  style="font-size:8px !important">
									Respond to Requests
								</td>
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
								<td height="25px" > 
									<?php echo $this->Html->image('white-my-resposes-head.png',array('style'=>'height:15px;width:15px')); ?>
									<span style="position: absolute;top: 3px; text-align: center; border-radius: 100%; background-color: #fff;color: #000; border: 1px solid #afafaf;"class="label"><?php echo $myReponseCountNew; ?></span> 
								</td>
							</tr>
							<tr>
								<td height="20px"  style="font-size:8px !important">
									My Responses
								</td>
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
<?php } } } ?>