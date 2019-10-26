<?php
	session_start();
	include('includes/config.php');
	include('includes/checklogin.php');
	check_login();
	//code for registration
	if(isset($_POST['submit'])) {
		$fname=$_POST['fname'];
		$sname=$_POST['sname'];
		$phonenum=$_POST['phonenum'];
		$id_number=$_POST['id_number'];

		$query="update users set fname=?,sname=?,phonenum=?,id_number=? where id=?";
		$stmt = $mysqli->prepare($query);
		$rc=$stmt->bind_param('ssss',$fname,$sname,$phonenum,$id_number);
		$stmt->execute();
		echo"<script>success('Client Info Successfully Updated');</script>";
		header('location: manage-clients.php');
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

		<title>Update Client Info</title>
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
							<h2 class="page-title">Update Client </h2>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-primary">
										<div class="panel-heading">Edit Client Info</div>

										<div class="panel-body">
											<form method="post" action="" class="form-horizontal">
												<?php
													$id=$_GET['id'];
													$stmt=$mysqli->prepare("SELECT * FROM users WHERE id=? ");
													$stmt->bind_param('i',$id);
													$stmt->execute();
													$res=$stmt->get_result();
													//$cnt=1;
													while($row=$res->fetch_object()) {	?>
														<div class="form-group">
															<label class="col-sm-2 control-label"> First Name : </label>
															<div class="col-sm-3">
																<input type="text"  name="fname" id="fname"  class="form-control" value="<?php echo $row->fname;?>"  >
															</div>
															<div class="form-group">
																<label class="col-sm-2 control-label">Surname : </label>
																<div class="col-sm-3">
																	<input type="text" name="sname" id="sname"  class="form-control" value="<?php echo $row->sname;?>">
																</div>
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-2 control-label">Mobile No : </label>
															<div class="col-sm-3">
																<input type="text" name="phonenum" id="phonenum"  class="form-control" value="<?php echo $row->phonenum;?>">
															</div>
															<div class="form-group">
																<label class="col-sm-2 control-label">Id Number : </label>
																<div class="col-sm-3">
																	<input type="text" name="id_number" id="id_number" class="form-control" value="<?php echo $row->id_number;?>">
																</div>
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

	<script type="text/javascript">
		$(document).ready(function() {
			$('#duration').keyup(function(){
				var fetch_dbid = $(this).val();
				$.ajax({
					type:'POST',
					url :"ins-amt.php?action=userid",
					data :{userinfo:fetch_dbid},
					success:function(data){
						$('.result').val(data);
					}
				});
		})});
	</script>
</html>
