<!doctype html>

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
    <link rel="stylesheet" href="css/reserve.css" media="screen" title="no title" charset="utf-8">

</head>

<body>
	<article class="container">
		<div class="page-header">
          <h1>예매 <small>Reservation</small></h1>
        </div>
<center>
	<div>
	<button class='button_select btn btn-warning' id='bt1' onclick="bt('bt1');">예매</button>
	<button class='button effect btn btn-success' id='bt2' onclick="location.href='reserveList.php'">내역 확인</button>
	</div>
</center>

<br><br>

<center class="center">
<?php
	session_start();
	if( !isset($_SESSION['user_ID']) )
	{
		print "<script>alert('로그인 먼저!');</script>";
		print "<script>location.href='login.html';</script>";
	}
	$link = mysqli_connect('localhost', 'root', '1q2w3e4r', 'blackit');
?>

<section id='s_bt1_m' >
<div class="col-xs-2">
	<select name='start' class="form-control input-sm">
	<option value="">출발</option>
	<?php
		$qry_chk = mysqli_query($link,'select * from bus');
		while( $row = mysqli_fetch_row($qry_chk) ){
			print "<option value=".$row[0].">";
			print $row[1]."[".$row[0]."]";
			print "</option>";
		}
	?>
	</select>
	</div>
	<div class="col-xs-1">=></div>
	<div class="col-xs-2">
	<select name='end' class="form-control input-sm">
	<option value="">도착</option>
	<?php
		$qry_chk = mysqli_query($link,'select * from bus');
		while( $row = mysqli_fetch_row($qry_chk) ){
			print "<option value=".$row[0].">";
			print $row[1]."[".$row[0]."]";
			print "</option>";
		}
	?>
	</select>
</div>
	<br><br>
<div class="col-xs-2">
	<input type='date'class="form-control input-sm" name='date'/>
	</div>
	<div class="col-xs-1"></div>
	<div class="col-xs-2">
	<select name='time'class="form-control input-sm">
	<option value="">시간</option>
	<?php
		for($i=6; $i<23; $i++)
		{
			print "<option value=".$i.">";
			print $i." : 00";
			print "</option>";
		}
	?>
	</select>
	</div>
	<br><br>
<div class="col-xs-2">
	<select name='role'class="form-control input-sm">
	<option value=1>우등</option>
	<option value=0>일반</option>
	</select>
</div>
	<div class="col-xs-1">
	<input class="form-control input-sm"type='number' name='senior'  placeholder='어른'/>
	</div>
	<div class="col-xs-1">
	<input class="form-control input-sm"type='number' name='student'  placeholder='학생'/>
	</div>
	<div class="col-xs-1">
	<input class="form-control input-sm"type='number' name='junior'  placeholder='아동'/>
	</div>
	<br><br>
	
	</section>
	<br>
<div>
	<button id='next' class="btn btn-info" onclick="next();">&nbsp;&nbsp;&nbsp;다음&nbsp;&nbsp;&nbsp;</button>
</div>

<section id='s_bt2_m' style='visibility: hidden;'>
	asdf
</section>

</center>
  </article>
</body>

</html>
