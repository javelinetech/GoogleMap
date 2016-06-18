<?php
    require_once ("inc/main.php");
    
?>
<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9 ]><html class="ie9" lang="en"><![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US"><!--<![endif]-->
<head>
	<title>Zooom Login & Register | Zooom Productions</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Seo Meta -->
	<meta name="description" content="">
	<meta name="keywords" content="">

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="styles/icons.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="styles/animate.css" media="screen" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="js/rs-plugin/css/settings.css" media="screen" /><!-- Revolution Slider -->
	<link rel="stylesheet" type="text/css" href="styles/responsive.css" media="screen" />
	<link href='http://fonts.googleapis.com/css?family=Marcellus' rel='stylesheet' type='text/css'>
	

	<!-- Favicon -->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/ico">
	

	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=EmulateIE8; IE=EDGE" />
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script>
	<![endif]-->
</head>
<body>
	<div id="frame_">
	<div id="layout" class="full shop_page">
		<?php include_once("header.php") ?>
		
		<div class="page-content">
			<div class="row official-shop checkout clearfix mbs">

				<div class="grid_6">
					<h3 class="col-title"> Sign in </h3><span class="liner mbt"></span>
					<?php if(isset($_GET['msg'])){ ?>
					<div class="notification-box notification-box-error">
						<p><i class="icon-remove-sign"></i>Error: <?php echo $_GET['msg']?></p>
						<a class="notification-close notification-close-error" href="#"><i class="icon-remove"></i></a>
					</div>
					<?php } ?>
					<?php if(isset($_GET['msgs'])){ ?>					
					<div class="notification-box notification-box-success">
						<p><i class="icon-ok"></i> <?php echo $_GET['msgs']?></p>
						<a class="notification-close notification-close-error" href="#"><i class="icon-remove"></i></a>
					</div>
					<?php } ?>
					<form method="post" id="login_form_official" action="log_in.php">
						<div class="clearfix">
						<input type="text" placeholder="Username" name="username" class="righttip" title="Enter your registered username" required><br/>
						<input type="password" placeholder="Password" name="password" class="righttip" title="Enter your Password" required>
						</div>
						<input type="submit" id="login_button" name="login-in" value="Sign In">			
											
					</form>
										
				</div>

				<div class="grid_6">&nbsp;</div>


			</div><!-- row -->
		</div><!-- end page content -->
        <br/><br/><br/><br/>
        <br/><br/><br/>
		<?php include_once("footer.php") ?>

	</div><!-- end layout -->
	</div><!-- end frame -->

<div id="toTop"><i class="icon-angle-up"></i></div><!-- Back to top -->
<!-- Scripts -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/theme20.js"></script>
	<script type="text/javascript" src="js/rs-plugin/pluginsources/jquery.themepunch.plugins.min.js"></script>	
	<script type="text/javascript" src="js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script type="text/javascript" src="js/jquery.knob.js"></script>
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="js/gmap3.js"></script>
	<script type="text/javascript" src="js/twitter/jquery.tweet.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>