<?php
	session_start();
	include('includes/config.php');
	if(isset($_POST['login'])) {
		$id_number=$_POST['id_number'];
		$password=md5($_POST['password']);
		$stmt=$mysqli->prepare("SELECT id_number,password,id FROM users WHERE id_number=? and password=? ");
		$stmt->bind_param('ss',$id_number,$password);
		$stmt->execute();
		$stmt -> bind_result($id_number,$password,$id);
		$rs=$stmt->fetch();
		$stmt->close();
		$_SESSION['id']=$id;
		$_SESSION['login']=$id_number;
		$uip=$_SERVER['REMOTE_ADDR'];
		$ldate=date('d/m/Y h:i:s', time());
		if($rs) {
		$uid=$_SESSION['id'];
		$uemail=$_SESSION['login'];
		$ip=$_SERVER['REMOTE_ADDR'];
		$geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip;
		$addrDetailsArr = unserialize(file_get_contents($geopluginURL));
		$city = $addrDetailsArr['geoplugin_city'];
		$country = $addrDetailsArr['geoplugin_countryName'];
		$log="insert into userLog(userId,userEmail,userIp,city,country) values('$uid','$uemail','$ip','$city','$country')";
		$mysqli->query($log);

			if($log) {
				header("location:reserve.php");
			}
		}

		else {
			echo "<script>alert('Invalid Username/Email or password');</script>";
		}
	}
	?>

<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">

		<title>Online Parking Reservation</title>

		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">>
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<link rel="stylesheet" href="css/fileinput.min.css">
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<link rel="stylesheet" href="css/style.css">

		<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
		<script type="text/javascript" src="js/validation.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>

		<script type="text/javascript">
			function valid() {
				if(document.registration.password.value!= document.registration.cpassword.value) {
					alert("Password and Re-Type Password Field do not match  !!");
					document.registration.cpassword.focus();
					return false;
				}
				return true;
			}
		</script>
	</head>

	<body>
		<!-- <?php include('includes/header.php');?> -->
		<div class="login-page bk-img" style="background-image: url(img/bg_1.png);">
			<div class="brand clearfix">
				<ul class="ts-profile-nav">
					<li class="ts-account">
						<a href="admin-login.php"> Admin Login </a>

					</li>
				</ul>
			</div>
		<div class="form-content">
			<div class="container">
				<div class="row">

					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold text-light mt-4x">Online Parking Reservation</h1>
						<div class="well row pt-2x pb-3x" style="background-color: transparent;">
							<div class="col-md-8 col-md-offset-2">

											<form action="" method="post">
												<label for="" class="text-uppercase text-sm" style="color:#fff">ID Number</label>
												<input type="text" placeholder="ID Number" name="id_number" class="form-control mb" maxlength="13">
												<label for="" class="text-uppercase text-sm" style="color:#fff">Password</label>
												<input type="password" placeholder="Password" name="password" class="form-control mb">

												<input type="submit" name="login" class="btn btn-primary btn-block" value="Login" >
											</form>
										</div>
									</div>

									<div class="text-center text-light">
										<a href="registration.php" class="text-light">New user, please register</a><br>
										<a href="forgot-password.php" class="text-light">Forgot password?</a><br>
									</div>
								</div>
							</div>
						</div>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>

		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="js/Chart.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/chartData.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>
