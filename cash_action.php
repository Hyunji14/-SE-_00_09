<html>
<head>
	<meta charset="utf-8">
	<script src = 'js/script_min.js'></script>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<title>버스 예매 시스템</title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" title="no title" charset="utf-8">
    <!-- Custom style -->
    <link rel="stylesheet" href="css/book.css" media="screen" title="no title" charset="utf-8">

</head>
<body>
<article class="container">
        <div class="page-header">
          <h1>예매 완료 <small>Reservation Success</small></h1>
        </div>
        <div class="alert alert-success">
			<strong>Success!</strong> 예매가 완료 되었습니다.
		</div>
		<button type="button" class="btn btn-info" onclick="location.href='home.php'">홈으로</button>



</article>
</body>
</html>



<?php
session_start();
	$link = mysqli_connect('localhost', 'root', '1q2w3e4r', 'blackit');
	$qry_chk = mysqli_query($link, 'select * from bus_sc where code='.$_POST['code']);

	$row = mysqli_fetch_row($qry_chk);
	$seat = $row[1];
	$seat = unserialize($seat);

	if( $_POST['role'] == 1 )
		$Array = array(1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);
	else if( $_POST['role'] == 0 )
		$Array = array(1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);

	$getCheck = $_POST['seat'];
	$my_seat = '';
	$getCheck = explode(',',$getCheck);
	for($i=0; $i<count($getCheck); $i++)
	{
		if( strlen($my_seat) > 0 ) $my_seat.=', ';
		$my_seat .= $getCheck[$i];
		$seat[$getCheck[$i]-1] = 0;
	}
	
	$seat = serialize($seat);

	$qry_ch = mysqli_query($link, 'update bus_sc set seat=\''.$seat.'\' where code=\''.$_POST['code'].'\'');

	$id = $_SESSION['user_ID'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$role = $_POST['role'];
	$cash = $_POST['cash'];
	$cash_date = $_POST['cash_date'];
	$how = $_POST['how'];
	$valid = 1;
	$cash_code = $_POST['cash_code'];

#	$id = 'rls1004';

	mysqli_query($link, "insert into list values($cash_code,'$id',$start,$end,'$date', $time, $role, $cash, '$cash_date', '$how', $valid, '$my_seat')");

	echo "<script>alert('예매가 완료되었습니다.');</script>";
	#echo "<script>location.href='home.php';</script>";
?>
