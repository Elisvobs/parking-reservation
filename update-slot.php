<?php
	session_start();
	include('includes/config.php');
	include('includes/checklogin.php');
	check_login();
	//code for registration
	if(isset($_POST['submit'])) {
		$num_plate=$_POST['num_plate'];
		$slot_id=$_POST['slot_id'];
		$timeA=$_POST['timeA'];
		$timeD=$_POST['timeD'];
		$amount=$_POST['amount'];
		$query="update parking set num_plate=?,slot_id=?,timeA=?,timeD=?, amount=? where id=?";
		$stmt = $mysqli->prepare($query);
		$rc=$stmt->bind_param('sisss',$num_plate,$slot_id,$timeA,$timeD,$amount);
		$stmt->execute();
		echo"<script>success('Reservation Info Successfully Updated');</script>";
		header('location: manage-slots.php');
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

		<title>Update Reservation Info</title>
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
							<h2 class="page-title">Update Reservation </h2>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-primary">
										<div class="panel-heading">Update Client Info</div>

										<div class="panel-body">
											<form method="post" action="" class="form-horizontal">
												<?php
													$id=$_GET['id'];
													$stmt=$mysqli->prepare("SELECT * FROM parking WHERE id=? ");
													$stmt->bind_param('i',$id);
													$stmt->execute();
													$res=$stmt->get_result();
													//$cnt=1;
													while($row=$res->fetch_object()) {	?>
														<div class="form-group">
																<label class="col-sm-2 control-label">Number Plate : </label>
																<div class="col-sm-3">
																	<input type="text" name="num_plate" id="num_plate"  class="form-control" maxlength="7" value="<?php echo $row->num_plate;?>">
																</div>
																<div class="form-group">
																	<label class="col-sm-2 control-label">Slot Number : </label>
																	<div class="col-sm-3">
																		<input type="text" name="slot_id" id="slot_id"  class="form-control" onBlur="checkAvailability()" value="<?php echo $row->slot_id;?>">
																			<span id="slot-availability-status" style="font-size:12px;"></span>
																	</div>
																</div>
															</div>


															<div class="form-group">
																<label class="col-sm-2 control-label">Check-in Time : </label>
																<div class="col-sm-3">
																	<input type="datetime-local" name="timeA" id="timeA" min="10/18/2019"  class="form-control" value="<?php echo $row->timeA;?>">
																</div>
															<div class="form-group">
																<label class="col-sm-2 control-label">Check-out Time : </label>
																<div class="col-sm-3">
																	<input type="datetime-local" name="timeD" id="timeD"  class="form-control" value="<?php echo $row->timeD;?>">
																</div>
															</div>
														</div>


															<div class="form-group">
																<label class="col-sm-2 control-label">Amount : </label>
																<div class="col-sm-3">
																	<input type="text" name="amount" id="amount"  class="form-control" value="<?php echo $row->amount;?>">
																</div>
															</div>
												<?php } ?>

											<div class="col-sm-6 col-sm-offset-5">
												<input type="submit" name="submit" Value="Update" class="btn btn-primary">
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

	<!-- alert if number plate alert exceeds or is below 7 characters-->
	<script>
		function handleChange() {
			var x = document.getElementById("num_plate").value;
			console.log(x);
			if (x.length >= 7) {
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

	<!-- limit slot selection to 100 slots -->
	<script>
		$("input[name='slot_id']").change(function() {
			number = $("input[name='slot_id']").val()
			 if( number <= 0 || number >= 100 ) {
					 $("input[name='slot_id']").val("");
					 alert("Values should be from 1 - 100");
				 }
		});
	</script>

	<!-- restrict past dates -->
	<script>
		function checkDate(){
			var inputDate = new Date(document.getElementById("timeA").value);
			var date = new Date();
			if(inputDate < date){
				 alert("Dates should be from today onwards! Please enter valid date");
			}
		}
	</script>

	<!-- checkout date should be greater than checkin date -->
	<script>
		$(document).ready(function () {
			arr_time = $("input[name='timeA']").val();
			dep_time = $("input[name='timeD']").val();

			$("input[name='timeD']").on('change', function () {
					var arr_time = new Date($("input[name='timeA']").val());
					var dep_time = new Date($("input[name='timeD']").val());

					if (arr_time  > dep_time) {
							alert("Check-out time should be later than check-in time");
					}
			});
		});
	</script>

</html>
