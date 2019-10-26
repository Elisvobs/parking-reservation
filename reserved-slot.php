<?php
	session_start();
	include('includes/config.php');
	include('includes/checklogin.php');
	check_login();

	if(isset($_POST['submit'])) {
		$model=$_POST['model'];
		$num_plate=$_POST['num_plate'];
		$slot_id=$_POST['slot_id'];
		$timeA=$_POST['timeA'];
		$timeD=$_POST['timeD'];
		$amount=$_POST['amount'];
		$query="insert into  registration(model,num_plate,slot_id,timeA,timeD,amount) values(?,?,?,?,?,?)";
		$stmt = $mysqli->prepare($query);
		$rc=$stmt->bind_param('ssisss',$model,$num_plate,$slot_id,$timeA,$timeD,$amount);
		$stmt->execute();
		echo"<script>alert('Parking Slot has been reserved');</script>";
		header('location: dashboard.php');
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

			<title>Reserve Parking</title>

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
		</head>

		<body>
			<?php include('includes/header.php');?>
			<div class="ts-main-content">
				<?php include('includes/sidebar.php');?>
				<div class="content-wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<h2 class="page-title"> Reserve Parking </h2>
								<div class="row">
									<div class="col-md-12">
										<div class="panel panel-primary">
										<div class="panel-heading">Fill all Info</div>
											<div class="panel-body">

												<form method="post" action="" name="registration" class="form-horizontal" onSubmit="return valid();">
                          <?php
  													$id=$_GET['id'];
  													$stmt=$mysqli->prepare("SELECT * FROM registration WHERE id=? ");
  													$stmt->bind_param('i',$id);
  													$stmt->execute();
  													$res=$stmt->get_result();
  													//$cnt=1;
  													while($row=$res->fetch_object()) {	?>
    													<div class="form-group">
    														<label class="col-sm-2 control-label"> Model : </label>
    														<div class="col-sm-3">
    															<input type="text"  name="model" id="model"  class="form-control" required="required" >
    														</div>
    														<div class="form-group">
    															<label class="col-sm-2 control-label">Number Plate : </label>
    															<div class="col-sm-3">
    																<input type="text" name="num_plate" id="num_plate"  class="form-control">
    															</div>
    														</div>
    													</div>

    													<div class="form-group">
    														<label class="col-sm-2 control-label">Slot Number : </label>
    														<div class="col-sm-3">
    															<input type="text" name="slot_id" id="slot_id"  class="form-control" onBlur="checkAvailability()" required="required">
    																<span id="slot-availability-status" style="font-size:12px;"></span>
    														</div>
    														<div class="form-group">
    															<label class="col-sm-2 control-label">Check-in Time : </label>
    															<div class="col-sm-3">
    																<input type="datetime-local" name="timeA" id="timeA"  class="form-control" required="required">
    															</div>
      													</div>
      												</div>

  														<div class="form-group">
  															<label class="col-sm-2 control-label">Check-out Time : </label>
  															<div class="col-sm-3">
  																<input type="datetime-local" name="timeD" id="timeD"  class="form-control" required="required">
  															</div>
  															<div class="form-group">
  																<label class="col-sm-2 control-label">Amount : </label>
  																<div class="col-sm-3">
  																	<input type="text" name="amount" id="amount"  class="form-control" required="required">
  																</div>
  															</div>
  													</div>
  												<?php } ?>

  													<div class="col-sm-6 col-sm-offset-4">
  														<button class="btn btn-default" type="submit">Cancel</button>
  														<input class="btn btn-primary" type="submit" name="submit" Value="Register">
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
					data:'slot_id='+$("#slot_id").val(),
					type: "POST",
					success:function(data){
						$("#slot-availability-status").html(data);
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
