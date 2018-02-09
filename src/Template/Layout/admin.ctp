<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <link rel="shortcut icon" href="/packages/serverfireteam/panel/favicon.ico">
    <link rel="icon" href="/packages/serverfireteam/panel/favicon.ico" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="PHP" >
	<title>TB2B</title>
		<?php echo $this->Html->css('/packages/zofe/rapyd/assets/demo/style.css'); ?> 
		<?php echo $this->Html->css('/packages/zofe/rapyd/assets/datepicker/datepicker3.css'); ?>
		<?php echo $this->Html->css('/packages/zofe/rapyd/assets/autocomplete/autocomplete.css'); ?>
		<?php echo $this->Html->css('/packages/zofe/rapyd/assets/autocomplete/bootstrap-tagsinput.css'); ?>
		<?php echo $this->Html->css('/packages/zofe/rapyd/assets/colorpicker/css/bootstrap-colorpicker.min.css'); ?>
		<?php echo $this->Html->css('/packages/serverfireteam/panel/css/styles.css'); ?>
		<?php echo $this->Html->css('/packages/serverfireteam/panel/font-icon/icomoon/style.css'); ?>
		<?php echo $this->Html->script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'); ?> 
		<?php echo $this->Html->script('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'); ?> 
		<?php echo $this->Html->script('http://fonts.googleapis.com/css?family=Abel');?> 
		  
		<?php echo $this->Html->script('/packages/serverfireteam/panel/js/jquery-1.11.0.js'); ?></script>
		<?php echo $this->Html->css('/packages/zofe/rapyd/assets/select2/select2.css'); ?>
		<?php echo $this->Html->script('/packages/zofe/rapyd/assets/select2/select2.js'); ?></script>
		
		<style>
			.Responses .pull-right a{
				display: none;
			}
			.Requests .pull-right a{
				display: none;
			}
		</style>
	</head>
	<body class="dashboard Admin">
	<div class="loading">
        <h1> LOADING </h1>
        <div class="spinner">
          <div class="rect1"></div>
          <div class="rect2"></div>
          <div class="rect3"></div>
          <div class="rect4"></div>
          <div class="rect5"></div>
        </div>
    </div>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top " role="navigation" style="margin-bottom: 0">

            <!-- /.navbar-header -->
             <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed btn-resp-sidebar" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>

              </div>


            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar " role="navigation">
                <div class="sidebar-nav navbar-collapse collapse " id="bs-example-navbar-collapse-1">
                      <div class="grav center">
						<?php echo $this->Html->Image('/packages/serverfireteam/panel/img/logo.png'); ?>
					  </div>
                      <div class="user-info">
					  
					  </div>
                     
                      <ul class="nav" id="side-menu">
                          <li class="{{ (Request::url() === url('panel')) ? 'active' : '' }}">
                              <a  href="{{ url('panel') }}" ><i class="fa fa-dashboard fa-fw"></i> {{ \Lang::get('panel::fields.dashboard') }}</a>
                          </li>

                          @foreach($linkItems as $linkItem)
                              
                              <li class="s-link {{ $isActive ? 'active' : '' }}">
                                  <a  href="{{ url($linkItem['showListUrl']) }}" class="{{ $isActive ? 'active' : '' }}">
                                      <i class="fa fa-edit fa-fw"></i>
                                      {{{$linkItem['title']}}}
                                  </a>
                                  <span class="badge {{App::getLocale() == 'fa' ? 'pull-left' : 'pull-right'}}">{!!$linkItem['count']!!}</span>
                                  <div class="items-bar">
                                      <a href="{{ url($linkItem['addUrl']) }}" class="ic-plus" title="Add" ></a>
                                      <a title="List" class="ic-lines" href="{{ url($linkItem['showListUrl']) }}" ></a>
                                  </div>
                              </li>
                          @endforeach
<li class="s-link"><a href="{{ url('/') }}/reports.php"><i class="fa fa-edit fa-fw"></i>Reports</a></li>
						  <li class="s-link"><a href="{{ url('/') }}/statistics.php"><i class="fa fa-edit fa-fw"></i>Statistics</a></li>
                      </ul>

                        </li>
                    </ul>
                </div>


            </div>
            <!-- /.navbar-static-side -->
        </nav>
      
        <div id="page-wrapper">


            <!-- Menu Bar -->
            <div class="row">
                <div class="col-xs-12 text-a top-icon-bar">
                    <div class="btn-group" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                            <a  type="button" class="btn btn-default dropdown-toggle main-link" data-toggle="dropdown" aria-expanded="false">
                                Settings
                                <span class="caret"></span>
                            </a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href=""><span class="icon  ic-users "></span> Edit Profile</a></li>
                            <li><a href=""><span class="icon ic-cog"></span>Change Password</a></li>
                          </ul>
                        </div>
                        <a href="{{url('panel/logout')}}" type="button" class="btn btn-default main-link">Logout<span class="icon  ic-switch"></span></a>
                      </div>
                </div>
            </div>

            <?php echo $this->fetch('content'); ?>

        </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
	
	
	
	
	
 
	
	
	
	
	
	
	
	

			
			
		<?php echo $this->Html->script('/packages/serverfireteam/panel/js/bootstrap.min.js'); ?>
		<?php echo $this->Html->script('/packages/serverfireteam/panel/js/sb-admin-2.js'); ?>  
		<?php echo $this->Html->script('/packages/zofe/rapyd/assets/datepicker/bootstrap-datepicker.js'); ?>
		<?php echo $this->Html->script('/packages/zofe/rapyd/assets/datepicker/locales/bootstrap-datepicker.it.js'); ?>
		<?php echo $this->Html->script('/packages/zofe/rapyd/assets/autocomplete/typeahead.bundle.min.js'); ?>
		<?php echo $this->Html->script('/packages/zofe/rapyd/assets/template/handlebars.js'); ?> 
		<?php echo $this->Html->script('/packages/zofe/rapyd/assets/autocomplete/bootstrap-tagsinput.min.js');?>
		<?php echo $this->Html->script('/packages/zofe/rapyd/assets/colorpicker/js/bootstrap-colorpicker.min.js');?>
		<?php echo $this->Html->script('/packages/zofe/rapyd/assets/select2/custom.js'); ?> 
	</body>

</html>
