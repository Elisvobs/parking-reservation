<?php
	session_start();
	include('includes/config.php');
	date_default_timezone_set('Africa/Zimbabwe');
	include('includes/checklogin.php');
	check_login();
	$aid=$_SESSION['id'];

	if(isset($_POST['update'])) {
		$fname=$_POST['fname'];
		$sname=$_POST['sname'];
		$phonenum=$_POST['phonenum'];
		$id_number=$_POST['id_number'];
		$udate = date('d-m-Y h:i:s', time());
		$query="update  users set fname=?,sname=?,phonenum=? where id=?";
		$stmt = $mysqli->prepare($query);
		$rc=$stmt->bind_param('sssssi',$fname,$sname,$phonenum,$id_number,$udate,$aid);
		$stmt->execute();
		echo"<script>alert('Profile updated Successfully');</script>";
		header("location:dashboard.php");
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

		<title>Update Profile</title>

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
		<?php include('includes/header.php');?>
		<div class="ts-main-content">
			<?php include('includes/sidebar.php');?>
				<div class="content-wrapper">
					<div class="container-fluid">
					<?php
						$aid=$_SESSION['id'];
						$ret="select * from users where id=?";
						$stmt= $mysqli->prepare($ret) ;
						$stmt->bind_param('i',$aid);
						$stmt->execute() ;//ok
						$res=$stmt->get_result();
						//$cnt=1;
						while($row=$res->fetch_object()) {
					?>
						<div class="row">
							<div class="col-md-12">
								<h2 class="page-title"><?php echo $row->fname;?>'s&nbsp;Profile </h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading">Edit Profile &nbsp;  </div>

						<div class="panel-body">
							<form method="post" action="" name="registration" class="form-horizontal" onSubmit="return valid();">
								<div class="form-group">
									<label class="col-sm-2 control-label"> First Name : </label>
									<div class="col-sm-8">
										<input type="text" name="fname" id="fname"  class="form-control" value="<?php echo $row->fname;?>"   required="required" >
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">Surname (s): </label>
									<div class="col-sm-8">
										<input type="text" name="sname" id="sname"  class="form-control" value="<?php echo $row->sname;?>" required="required">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">Phone Number : </label>
									<div class="col-sm-8">
										<input type="text" name="phonenum" id="phonenum"  class="form-control" maxlength="10" value="<?php echo $row->phonenum;?>" required="required">
									</div>
								</div>


								<div class="form-group">
									<label class="col-sm-2 control-label">Email: </label>
									<div class="col-sm-8">
										<input type="text" name="id_number" id="id_number"  class="form-control" value="<?php echo $row->id_number;?>" readonly>
											<span id="user-availability-status" style="font-size:12px;"></span>
									</div>
								</div>
								<?php } ?>

								<div class="col-sm-6 col-sm-offset-4">
									<input type="submit" name="update" Value="Update Profile" class="btn btn-primary">
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
				error:function (){}
			});
		}
	</script>
</html>
