<?php
	$conn = mysqli_connect("127.0.0.1", "root", "1q2w3e4r", "blackit");
	
	if( mysqli_connect_errno()){
			echo "MySQL Database connect Failed : " . mysqli_connect_error();
	}

	$user_ID = $_POST['user_ID'];
	$user_Passwd = $_POST['user_passwd'];

	if( $user_ID == null || $user_Passwd == null){
		echo "<script>alert('Please input information');</script>";
		echo "<script>location.href='login.html';</script>";
	}

	$check_ID_query = "select user_ID from user where user_ID='$user_ID'";
	$check_result = mysqli_query($conn, $check_ID_query);
	$check_row = mysqli_fetch_row($check_result);
	
	if( $check_row[0] == null){
		echo "<script>alert('$user_ID is not exist.');</script>";
		echo "<script>location.href='login.html'</script>";
	}

	else{
		$check_pw_query = "select user_passwd from user where user_ID='$user_ID'";
		$check_pw_result = mysqli_query($conn, $check_pw_query);
		$get_passwd = mysqli_fetch_row($check_pw_result);

		if( $user_Passwd != $get_passwd[0] ){
			echo "<script>alert('Passwrod is not correct');</script>";
			echo "<script>location.href='login.html';</script>";
		}
		else{
			echo "<script>alert('Login Success!!');</script>";
			session_start();
			$_SESSION['user_ID'] = $user_ID;
			echo "<script>location.href='home.php';</script>";
		}
	}
?>
