<?php
	session_start();
	include('includes/config.php');
	if(isset($_POST['login'])) {
		$id_number=$_POST['id_number'];
		$contact=$_POST['contact'];
		$stmt=$mysqli->prepare("SELECT id_number,phonenum,password FROM users WHERE (id_number=? && phonenum=?) ");
		$stmt->bind_param('ss',$id_number,$contact);
		$stmt->execute();
		$stmt -> bind_result($username,$id_number,$password);
		$rs=$stmt->fetch();

		if($rs)	{
			$pwd=md5($_POST['password']);
		}
		else {
			echo "<script>alert('Invalid Email/Contact no or password');</script>";
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

		<title>Reset Password</title>

		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<link rel="stylesheet" href="css/fileinput.min.css">
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<div class="login-page bk-img" style="background-image: url(img/bg_1.png);">
			<div class="form-content">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<h1 class="text-center text-bold text-light mt-4x">Online Parking Reservation</h1>
							<div class="well row pt-2x pb-3x bk-light" style="background-color: transparent;">
								<div class="col-md-8 col-md-offset-2">
								<?php
									if(isset($_POST['login'])) { ?>
										<p>Your Password is <?php echo $pwd;?><br> Change the Password After login</p>
								<?php }  ?>
									<form action="" class="mt" method="post">
										<label for="" class="text-uppercase text-sm" style="color:#fff;">Your Id Number</label>
										<input type="id_number" placeholder="ID Number" name="id_number" class="form-control mb">
										<label for="" class="text-uppercase text-sm" style="color:#fff;">Your Contact No.</label>
										<input type="text" placeholder="Contact no" name="contact" class="form-control mb">

										<input type="submit" name="login" class="btn btn-primary btn-block" value="Reset Password" >
									</form>
								</div>
							</div>
							<div class="text-center text-light">
								<a href="login.php" class="text-light">Sign in?</a>
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
