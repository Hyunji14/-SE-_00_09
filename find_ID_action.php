<?php
        $conn = mysqli_connect("127.0.0.1", "root", "1q2w3e4r", "blackit");

        if( mysqli_connect_errno()){
                        echo "MySQL Database connect Failed : " . mysqli_connect_error();
        }

        $user_Name = $_POST['user_Name'];
        $user_info = $_POST['checkbox'];
	$user_Email = $_POST['user_Email'];

        $check_ID_query = "select user_ID from user where user_Name='$user_Name' and user_Email='$user_Email' and user_Info = '$user_info'";
        $check_result = mysqli_query($conn, $check_ID_query);
        $exist_ID = mysqli_fetch_row($check_result);


        if( $exist_ID[0] == null){
                echo "<script>alert('ID is not exist.');</script>";
                echo "<script>location.href='find_ID.html';</script>";
        }
	else{
		echo "<script>alert('Your ID is \"$exist_ID[0]\".');</script>";
		echo "<script>location.href='login.html';</script>";	
	}
?>
