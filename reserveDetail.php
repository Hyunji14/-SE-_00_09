<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>버스 예매 시스템 - 내역 상세조회</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" title="no title" charset="utf-8">
    <!-- Custom style -->
    <link rel="stylesheet" href="css/reserveDetail.css" media="screen" title="no title" charset="utf-8">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <article class="container">
        <div class="page-header">
          <h1>예매내역 상세조회 <small>Reservation Details</small></h1>
        </div>
        <div class="col-md-6 col-md-offset-3">
			<form method="post" action="login.html">
				  <table class="table table-striped">
					<thead>
						<tr>
							<th>항목</th>
							<th>내용</th>
						</tr>
					</thead>
					<?php
						session_start();
						$user_ID = $_SESSION['user_ID'];
						$code = $_GET['code'];

						$conn = mysqli_connect("localhost", "root", "1q2w3e4r", "blackit");
						$show_query = "select * from list where id='$user_ID' and cash_code='$code'";
						$show_result = mysqli_query($conn, $show_query);

						$row = mysqli_fetch_assoc($show_result);

						$start = $row['start'];
						$end = $row['end'];
						$date = $row['date'];
						$grade = $row['role'];
						$cash = $row['cash'];						
						$how = $row['how'];
						$time = $row['time'];
						$cash_date = $row['cash_date'];
						$seat = $row['my_seat'];

						$start_query = "select kor from bus where code='$start'";
						$start_result = mysqli_query($conn, $start_query);
						$start_row = mysqli_fetch_row($start_result);

                                                $end_query = "select kor from bus where code='$end'";
                                                $end_result = mysqli_query($conn, $end_query);
                                                $end_row = mysqli_fetch_row($end_result);
					?>
					<tbody>
						<tr>
							<td>출발지</a></td>
							<td><?php echo $start_row[0];?></td>
						</tr>      
						<tr>
							<td>도착지</td>
							<td><?php echo $end_row[0]; ?></td>
						</tr>
						<tr>
							<td>출발시간</td>
							<td><?php echo $time; ?></td>
						</tr>
						<tr>
							<td>버스등급</td>
							<td>
								<?php
									if($grade =='1'){ echo "우등";}
									else{ echo "일반"; }
								?>
							</td>
						</tr>
						<tr>
							<td>좌석</td>
							<td><?php echo $seat; ?></td>
						</tr>
						<tr>
							<td>요금</td>
							<td><?php echo $cash; ?></td>
						</tr>
						<tr>
							<td>승인 날짜</td>
							<td><?php echo $cash_date;?></td>
						</tr>
						<tr>
							<td>결제 방법</td>
							<td>
								<?php
									if( $how == 'other'){ echo "무통장 입금";} else{ echo "신용카드";}
								?>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			<div class="buttons">
				<button type="button" class="btn btn-primary" onclick="location.href='reserve_cancle.php?code=<?php echo $code;?>'">예매 취소</button>
				<button type="button" class="btn btn-info" onclick="location.href='home.php'">홈으로</button>
			</div>
		</div>
	

      </article>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
