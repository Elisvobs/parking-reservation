<?php
	session_start();
	include('includes/config.php');
	include('includes/checklogin.php');
	check_login();
	if(isset($_POST['submit'])) {
		$fname=$_POST['fname'];
		$sname=$_POST['lname'];
		$contactno=$_POST['contact'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$query="insert into  users(fname,sname,phonenum,email,password) values(?,?,?,?,?)";
		$stmt = $mysqli->prepare($query);
		$rc=$stmt->bind_param('sssss',$fname,$sname,$contactno,$email,$password);
		$stmt->execute();
		echo"<script>alert('Customer Successfully registered');</script>";
		header('location:  manage-clients.php');
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

		<title>User Registration</title>

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
		<?php include('includes/admin-header.php');?>
		<div class="ts-main-content">
			<?php include('includes/admin-sidebar.php');?>
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<h2 class="page-title"> User Registration </h2>
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-primary">
									<div class="panel-heading">Fill All Client Info</div>
										<div class="panel-body">

											<form method="post" action="" name="registration" class="form-horizontal" onSubmit="return valid();">
												<div class="form-group">
													<label class="col-sm-2 control-label"> First Name : </label>
													<div class="col-sm-3">
														<input type="text"  name="fname" id="fname"  class="form-control" required="required" >
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label">Surname : </label>
														<div class="col-sm-3">
															<input type="text" name="sname" id="sname"  class="form-control" required="required">
														</div>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">Mobile No : </label>
													<div class="col-sm-3">
														<input type="text" name="contact" id="contact" maxlength="10" class="form-control" required="required">
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label">Id Number : </label>
														<div class="col-sm-3">
															<input type="email" name="email" id="email"  class="form-control" onBlur="checkAvailability()" required="required">
																<span id="user-availability-status" style="font-size:12px;"></span>
														</div>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">Password: </label>
													<div class="col-sm-3">
														<input type="password" name="password" id="password"  class="form-control" required="required">
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label">Confirm Password: </label>
														<div class="col-sm-3">
															<input type="password" name="cpassword" id="cpassword"  class="form-control" required="required">
														</div>
													</div>
												</div>

												<div class="col-sm-6 col-sm-offset-4">
													<button class="btn btn-default" type="submit">Cancel</button>
													<input class="btn btn-primary" type="submit" name="submit" Value="Add Client">
												</div>
											</form>
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

	<script>
		function checkAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_availability.php",
				data:'emailid='+$("#email").val(),
				type: "POST",
				success:function(data){
					$("#user-availability-status").html(data);
					$("#loaderIcon").hide();
				},
				error:function () {
				event.preventDefault();
				alert('error');
				}
			});
		}
	</script>
</html>
