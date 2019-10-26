<?php
	session_start();
	include('includes/config.php');
	if(isset($_POST['submit'])) {
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$contactno=$_POST['contact'];
		$id_number=$_POST['id_number'];
		$password=md5($_POST['password']);
		$query="insert into  users(fname,sname,phonenum,id_number,password) values(?,?,?,?,?)";
		$stmt = $mysqli->prepare($query);
		$rc=$stmt->bind_param('sssss',$fname,$lname,$contactno,$id_number,$password);
		$stmt->execute();
		echo"<script>alert('Customer Successfully registered');</script>";
		header('location: login.php');
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
		<div class="login-page bk-img" style="background-image: url(img/bg_1.png);">
			<div class="form-content">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<h1 class="text-center text-bold text-light mt-4x">Online Parking Reservation</h1>
						</div>
						<div class="col-md-10 col-md-offset-1">
							<div class="panel panel-primary"  style="background-color: transparent;">
								<div class="text-center panel-heading" > User Registration</div>
								<div class="panel-body">

									<form method="post" action="" name="registration" class="form-horizontal" onSubmit="return valid();">
										<div class="form-group">
											<label class="col-sm-2 control-label" style="color:#fff"> First Name : </label>
											<div class="col-sm-3">
												<input type="text"  name="fname" id="fname"  class="form-control" placeholder="First Name" required="required" >
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label" style="color:#fff">Surname : </label>
												<div class="col-sm-3">
													<input type="text" name="lname" id="lname"  class="form-control" placeholder="Surname" required="required">
												</div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label" style="color:#fff">Mobile No : </label>
											<div class="col-sm-3">
												<input type="text" name="contact" id="contact" minlength="10"  maxlength="10" placeholder="Mobile No" class="form-control"  required="required">
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label" style="color:#fff">ID Number : </label>
												<div class="col-sm-3">
													<input type="text" name="id_number" id="id_number" maxlength="13" placeholder="ID Number" class="form-control" required="required">
												</div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label" style="color:#fff">Password: </label>
											<div class="col-sm-3">
												<input type="password" name="password" id="password" placeholder="Password" class="form-control" required="required">
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label" style="color:#fff">Confirm Password: </label>
												<div class="col-sm-3">
													<input type="password" name="cpassword" id="cpassword" placeholder="Retype Password" class="form-control" required="required">
												</div>
											</div>
										</div>

										<div class="col-sm-6 col-sm-offset-5">
											<input class="btn btn-primary" type="submit" name="submit" Value="Register">
										</div>
									</form>
								</div>
							</div>
							<div class="text-center text-light">
								<a href="login.php" class="text-light">Already have an account? Login here!</a>
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

	<script>
			$("input[name='contact']").change(function() {
			value = $("input[name='contact']").val()
			 if( value.length < 10 ) {
					 $("input[name='contact']").val("");
					 alert("Mobile number should have 10 digits");
				 }
		});
	</script>

	<script>
			$("input[name='id_number']").change(function() {
			value = $("input[name='id_number']").val()
			 if( value.length < 13) {
					 $("input[name='id_number']").val("");
					 alert("ID number should have 13 digits");
				 } else if (value.length > 13) {
						 $("input[name='id_number']").val("");
						 alert("ID number should have 13 digits");				 	
				 }
				 else {
					 var pattern = "(^\d{2})-(\d{7})\s([A-Z-a-z]{1}\s(\d{2}$))";
					 if (!pattern.test(value)) {
					 } else {
						 alert("Id number should be in format 63-0000000X00")
					 }
				 }
		});
	</script>

	<!-- <script>
		function handleChange() {
			var x = document.getElementById("id_number").value;
			var pattern = "^\d{2}-(\d{7})\s([A-Z-a-z]){1}\s(\d{2}$";
			console.log(x);
			if (x.length > 13) {
					alert("number plates should have 13 characters");
			}
			if (!pattern.test(x)) {
				alert("Id number should be in format 63-0000000X00")
			}
		}
	</script> -->
</html>
