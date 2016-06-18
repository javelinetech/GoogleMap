<header id="header">	
	<div class="head">
		<div class="row clearfix">
			<div class="logo">
				<h1>Zooom</h1>
			</div><!-- end logo -->

		</div><!-- row -->
	</div><!-- head -->

	<div class="headdown">
		<div class="row clearfix">
			<nav>
				<ul class="sf-menu">
					<li><a href="index.php">Home</a></li>
					<?php if(isset($_SESSION['username']) && $_SESSION['username'] == 'admin'){ ?>
					<li><a href="admin.php">Admin</a></li>
					<li><a href="logout.php">Logout</a></li>
					<?php }else{ ?>
					<li><a href="sign-in.php">Login</a></li>
					<?php } ?>
				</ul>
		</div><!-- row -->
	</div><!-- headdown -->
</header><!-- end header -->