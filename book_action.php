
<script src = 'js/script_min.js'></script>


<?php

session_start();

$role = $_POST['role'];

$cash = 0;

if( $role == 1 ) $cash = 12900;
else $cash = 8900;

$total = 0;
$total += $_POST['senior'] * $cash;
$total += $_POST['student'] * ($cash-2000);
$total += $_POST['junior'] * ($cash-4000);

$code = $_POST['code'];

$start = $_POST['start'];

$link = mysqli_connect('localhost', 'root', '1q2w3e4r', 'blackit');
$qry_chk = mysqli_query($link,'select * from bus where code='.$_POST['start']);
$row = mysqli_fetch_row($qry_chk);

$qry_chk = mysqli_query($link,'select * from bus where code='.$_POST['end']);
$row2 = mysqli_fetch_row($qry_chk);

?>

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
          <h1>결제 <small>payment</small></h1>
        </div>
        <div class="col-md-6 col-md-offset-3">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>
							예매 정보
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>출발지</a></td>
						<td><?php print $row[1].'['.$row[0].']'; ?></td>
					</tr>      
					<tr>
						<td>도착지</td>
						<td><?php print $row2[1].'['.$row2[0].']'; ?></td>
					</tr>
					<tr>
						<td>일시</td>
						<td><?php print $_POST['date'].' '.$_POST['time'].':00'; ?></td>
					</tr>
					<tr>
						<td>버스 등급</td>
						<td><?php if ($_POST['role'] == 1) print '우등'; else print '일반';?></td>
					</tr>
					<tr>
						<td>인원</td>
						<td><?php
								if( $_POST['senior'] != 0 )
								{
									print "어른(".$_POST['senior'].") ";
								}
								if( $_POST['student'] != 0 )
								{
										print "학생(".$_POST['student'].") ";
									}
									if( $_POST['junior'] != 0 )
									{
										print "아동(".$_POST['junior'].") ";
									}
								?>
							</td>
						</tr>
						<tr>
							<td>총액</td>
							<td><?php print $total; ?></td>
						</tr>
						<tr>
							<td>결제 수단</td>
							<td><select name='how'>
									<option value='card'>신용카드</option>
									<option value='other'>무통장입급</option>
								</select>
							</td>
						</tr>
						<tr>
						<td colspan="2">
							<button id='next' class="btn btn-info" onclick="cashGo();">&nbsp;&nbsp;&nbsp;다음&nbsp;&nbsp;&nbsp;</button>
						</td>
						</tr>
					</tbody>
				</table>
			
		</div>

<form name='result' method='post' action='cash_action.php'>
<input type='hidden' name='code' value=<?php print $_POST['start'].$_POST['end'].date("md",strtotime($_POST['date'])).$_POST['time'].$_POST['role'] ?> >
<input type='hidden' name='role' value=<?php print $_POST['role']?>>
<input type='hidden' name='senior' value=<?php print $_POST['senior']?>>
<input type='hidden' name='student' value=<?php print $_POST['student']?>>
<input type='hidden' name='junior' value=<?php print $_POST['junior']?>>
<input type='hidden' name='start' value=<?php print $_POST['start']?>>
<input type='hidden' name='end' value=<?php print $_POST['end']?>>
<input type='hidden' name='date' value=<?php print $_POST['date']?>>
<input type='hidden' name='time' value=<?php print $_POST['time']?>>
<input type='hidden' name='cash' value=<?php print $total?>>
<input type='hidden' name='user' value=<?php print $_SESSION['user_ID']?>>
<input type='hidden' name='cash_date' value=<?php print date("Y-m-d,H:i:s",time())?>>
<input type='hidden' name='seat' value=<?php print $_POST['seats']?>>

<?php
	$qry = mysqli_query($link, "select * from list");
	$cash_code = mysqli_num_rows($qry);
?>

<input type='hidden' name='cash_code' value=<?php print $cash_code.date("His",time())?>>

</form>
</body>
</html>


