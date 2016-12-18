<?php
	$conn = mysqli_connect("127.0.0.1", "root", "1q2w3e4r","blackit");
	
	if( mysqli_connect_errno()){
		echo "MySQL Database connect Failed : " . mysqli_connect_error();
	}

	$user_Name = $_POST['user_Name'];
	$user_ID = $_POST['user_ID'];
	$user_Passwd = $_POST['user_passwd'];
	$user_Passwd_Check = $_POST['user_passwd_check'];
	$user_Email = $_POST['user_Email'];
	$user_info = $_POST['checkbox'];

	$ID_check_query = "select user_ID from user where user_ID='$user_ID'";
	$check_query_result = mysqli_query($conn, $ID_check_query);

	
	$exist_ID = mysqli_fetch_row($check_query_result);

	if( $user_Name == null && $user_ID != null && $user_Passwd == null && $user_Passwd_Check == null && $user_Email == null){
		if($exist_ID[0] == $user_ID){
			echo "<script> alert('$user_ID is already exist'); location.href='join.html';</script>";
		}

		else if($exist_ID[0] == null){
			echo "<script>alert('$user_ID is can use');</script>";
			echo "<script>location.href='join.html';</script>";
		}

	}
	
	else if( $user_Name != null && $user_Passwd != null && $user_Passwd_Check != null && $user_Email != null && $user_info != null){

		if( $user_Passwd != $user_Passwd_Check){
			echo "<script>alert('Password is not Correct. Try again.'); location='join.html';</script>";
		}

		else{
			$insert_query = "insert into user values('$user_Name', '$user_ID', '$user_Passwd', '$user_Email', '$user_info')";			
			$insert_query_result = mysqli_query($conn, $insert_query);
			if(!$insert_query_result){
				echo "<script>alert('insert fail'); location.href='join.html';</script>";
			}
			else{
				echo "<script>alert('Join Success!!'); location.href='login.html';</script>";
			}
		}	
	}

	else{
                echo "<script>alert('Please input information');</script>";
                echo "<script>location.href='join.html';</script>";
        }

?>
