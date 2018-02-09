<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			
			<div class="mes-box"><?= $this->Flash->render() ?></div>
			<div class="login-panel panel panel-default animated fadeInDown">
				<div class="panel-heading">
					 <h3 class="panel-title">Please Sign In</h3></div>
				<div class="panel-body">
					<div class="logo-holder">
					<?php echo $this->Html->Image('/packages/serverfireteam/panel/img/logo.png'); ?>
					</div>
					<form method="POST" accept-charset="UTF-8">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Email" name="email" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">
									Remember Me
								</label>
							</div>
							<!-- Change this to a button or input when using this as a form -->
							<input type="submit" class="btn btn-lg btn-success btn-block" value="Login ">
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>