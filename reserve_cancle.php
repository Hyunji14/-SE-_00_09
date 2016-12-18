<?php
	session_start();
	$user_ID = $_SESSION['user_ID'];
	$conn = mysqli_connect("localhost", "root", "1q2w3e4r", "blackit");
	$code = $_GET['code'];

	$query = "select my_seat from list where id='$user_ID' and cash_code='$code'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_row($result);

	$qry = "select * from list where id='$user_ID' and cash_code='$code'";
	$rr = mysqli_query($conn, $qry);
	$rr = mysqli_fetch_row($rr);
	$date = explode('-',$rr[4]);
	$code = $rr[2].$rr[3].$date[1].$date[2].$rr[5].$rr[6];
		
	$search_code_query = "select * from bus_sc where code='$code'";
	$search_result = mysqli_query($conn, $search_code_query);

	$search_result = mysqli_fetch_row($search_result);

	$array = unserialize($search_result[1]);

	$seat_num = explode(',', $row[0]);
	for($i=0; $i<count($seat_num); $i++)
	{
		$array[$seat_num[$i]-1] = 1;
	}
	$serial_seat = serialize($array);
	
	$serial_update_query = "update bus_sc set seat='$serial_seat' where code='$code'";
	$update_result = mysqli_query($conn, $serial_update_query);

	if($update_result){
		$delete_query = "delete from list where cash_code='$code'";
		$delete_result = mysqli_query($conn, $delete_query);
		if($delete_result){
			echo "<script>alert('Reserve Cancle is Success');</script>";
			echo "<script>location.href='home.php';</script>";
		}
		else{
			echo "<script>alert('Reserve Cancle is Failed.');</script>";
			echo "<script>location.href='reserveDetail.php';</script>";
		}
	}
?>
