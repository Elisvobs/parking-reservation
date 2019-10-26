<?php
	session_start();
	include('includes/config.php');
	include('includes/checklogin.php');
	check_login();
	if(isset($_POST['submit'])) {
    $customer_id=$_POST['customer_id'];
		$num_plate=$_POST['num_plate'];
		$amount_charged=$_POST['amount_charged'];
		$amount_paid=$_POST['amount_paid'];
		$query="insert into payments(customer_id,num_plate,amount_charged,amount_paid)values(?,?,?,?)";
		$stmt = $mysqli->prepare($query);
		$rc=$stmt->bind_param('isss',$customer_id,$num_plate,$amount_charged,$amount_paid);
		$stmt->execute();
		echo"<script>alert('Payment has been received');</script>";
		header('location: payments.php');
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

		<title>Make Payments</title>

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
		<?php include('includes/admin-header.php');?>
		<div class="ts-main-content">
			<?php include('includes/admin-sidebar.php');?>
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<h2 class="page-title"> Make Payments </h2>
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-primary">
									<div class="text-center panel-heading">Fill Payment Info</div>
										<div class="panel-body">

											<form method="post" action="" name="registration" class="form-horizontal" onSubmit="return valid();">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Customer Id : </label>
                          <div class="col-sm-5">
                            <input type="text" name="customer_id" id="customer_id" class="form-control mb" maxlength="3" onBlur="checkAvailability()" required="required">
                              <span id="slot-availability-status" style="font-size:12px;"></span>
                          </div>
                        </div>

												<div class="form-group">
													<label class="col-sm-4 control-label">Number Plate : </label>
													<div class="col-sm-5">
														<input type="text" onkeydown="handleChange()" name="num_plate" id="num_plate" class="form-control mb" minlength="7" maxlength="7">
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-4 control-label">Amount Charged : </label>
													<div class="col-sm-5">
														<input type="text" name="amount_charged" id="amount_charged" onchange="checkDate()" class="form-control mb" required="required">
													</div>
												</div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">Amount Paid : </label>
                          <div class="col-sm-5">
                            <input type="text" name="amount_paid" id="amount_paid" class="form-control mb" required="required">
                          </div>
                        </div>

											<div class="col-sm-6 col-sm-offset-6 ">
												<input class="btn btn-primary" type="submit" name="submit" Value="Payment">
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	</body>

	<!-- alert if number plate alert exceeds or is below 7 characters-->
	<script>
		function handleChange() {
			var x = document.getElementById("num_plate").value;
			console.log(x);
			if (x.length > 7) {
					alert("number plates should have 7 characters");
			}
		}
	</script>

	<!-- check availability of the slot to be selected -->
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

	<!-- ensure amount charged is similar to amount paid -->
	<script>
		$(document).ready(function () {
			charged = $("input[name='amount_charged']").val();
			paid = $("input[name='amount_paid']").val();

			$("input[name='amount_paid']").on('change', function () {
					var charged = $("input[name='amount_charged']").val();
					var paid = $("input[name='amount_paid']").val();

					if (charged > paid) {
							alert("Reservation payments should be made in full!");
					}
			});
		});
	</script>
</html>
