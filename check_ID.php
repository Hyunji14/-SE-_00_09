<?php
	$conn = mysqli_connect("127.0.0.1", "root", "1q2w3e4r", "blackit");

	if( mysqli_connect_errno()){
		echo "MySQL Database connect Failed" . mysqli_connect_error();
	}
	
	$user_ID = $_POST['user_ID'];

	echo $user_ID;
?>
