<?php
	if($_SESSION['id']) { ?>
		<div class="brand clearfix">
			<a href="#" class="logo" style="font-size:16px;">Online Parking Reservation</a>
				<span class="menu-btn"><i class="fa fa-bars"></i></span>
				<ul class="ts-profile-nav">
					<li class="ts-account">
						<a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
						<ul>
							<li><a href="admin-profile.php">My Account</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
		</div>

<?php
	} else { ?>
			<div class="brand clearfix">
				<a href="#" class="logo" style="font-size:16px;">Online Parking Reservation</a>
				<span class="menu-btn"><i class="fa fa-bars"></i></span>
				<a href="index.php" style="font-size:16px; padding:40px; margin:80px; ">Home</a>
				<a href="registration.php" style="font-size:16px; padding:40px;">User Registration</a>
				<a href="login.php" style="font-size:16px; padding:40px;">User Login</a>
				<a href="reserve.php" style="font-size:16px; padding:40px;">Parking Reservation</a>
				<a href="admin-login.php" style="font-size:16px; padding:40px;">Admin Login</a>
			</div>
<?php } ?>
