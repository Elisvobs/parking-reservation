<?php
	require_once("includes/config.php");
	if(!empty($_POST["emailid"])) {
		$email= $_POST["emailid"];
		if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {
			echo "error : You did not enter a valid email.";
		}
		else {
			$result ="SELECT count(*) FROM users WHERE email=?";
			$stmt = $mysqli->prepare($result);
			$stmt->bind_param('s',$email);
			$stmt->execute();
			$stmt->bind_result($count);
			$stmt->fetch();
			$stmt->close();
			if($count>0) {
				echo "<span style='color:red'> Email already exist .</span>";
			}
			else {
				echo "<span style='color:green'> Email available for registration .</span>";
			}
		}
	}


	if(!empty($_POST["slot_id"])) {
		$slot_id= $_POST["slot_id"];
		$result ="SELECT count(*) FROM parking WHERE slot_id=?";
		$stmt = $mysqli->prepare($result);
		$stmt->bind_param('i', $slot_id);
		$stmt->execute();
		$stmt->bind_result($count);
		$stmt->fetch();
		$stmt->close();
		if($count>0) {
			echo "<span style='color:red'> Slot already occupied! Please select another slot .</span>";
			// alert("Slot already occupied! Please select another slot.");
		}
		else {
			echo "<span style='color:green'> Slot is available for reservation .</span>";
		}
	}

	if(!empty($_POST["oldpassword"])) {
		$pass=$_POST["oldpassword"];
		$result ="SELECT password FROM users WHERE password=?";
		$stmt = $mysqli->prepare($result);
		$stmt->bind_param('s',$pass);
		$stmt->execute();
		$stmt -> bind_result($result);
		$stmt -> fetch();
		$opass=$result;
		if($opass==$pass)
			echo "<span style='color:green'> Password  matched .</span>";
		else
			echo "<span style='color:red'> Password Not matched</span>";
	}
?>
