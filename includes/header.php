<?php
	if($_SESSION['id']) { ?>
		<div class="brand clearfix">
			<a href="#" class="logo" style="font-size:16px;">Online Parking Reservation</a>
			<span class="menu-btn"><i class="fa fa-bars"></i></span>
			<ul class="ts-profile-nav">
				<li class="ts-account">
					<a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
					<ul>
						<li><a href="my-profile.php">My Account</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	<?php
	} else { ?>
		<div class="brand clearfix">
			<a href="#" class="logo" style="font-size:16px; padding:10px;">Online Parking Reservation</a>
			<span class="menu-btn"><i class="fa fa-bars"></i></span>
			<!-- <a href="index.php" class="logo" style="font-size:16px; padding:10px;">Home</a> -->
			<a href="registration.php" class="logo" style="font-size:16px; padding:10px;">User Registration</a>
			<a href="login.php" class="logo" style="font-size:16px; padding:10px;">User Login</a>
			<a href="reserve.php" class="logo" style="font-size:16px; padding:10px;">Parking Reservation</a>
			<a href="admin-login.php" class="logo" style="font-size:16px; padding:10px;">Admin Login</a>
		</div>
<?php } ?>
