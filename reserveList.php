<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>버스 예매 시스템 - 예매 내역</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" title="no title" charset="utf-8">
    <!-- Custom style -->
    <link rel="stylesheet" href="css/style_reservation.css" media="screen" title="no title" charset="utf-8">

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
          <h1>예매 내역 <small>Reservation List</small></h1>
        </div>
        <div class="col-md-6 col-md-offset-3">
			<form method="post" action="login.html">
				  <table class="table table-striped">
					<thead>
						<tr>
							<th>예매코드</th>
							<th>버스등급</th>
							<th>요금</th>
							<th>결제</th>
						</tr>
					</thead>
					<?php
						session_start();
						$user_ID = $_SESSION['user_ID'];
						$conn = mysqli_connect('localhost', 'root', '1q2w3e4r', 'blackit');
						$count_query = "select * from list where id='$user_ID'";
						$count_result = mysqli_query($conn, $count_query);
					
						while($row = mysqli_fetch_assoc($count_result)){
							$code = $row['cash_code'];
							$grade = $row['role'];
							$cash = $row['cash'];
							$how = $row['how'];
						}	
					?>
					<tbody>
						<tr>
							<td><a href="reserveDetail.php?code=<?php echo $code;?>"><?php echo $code; ?></a></td>
							<td><?php if($grade == '1'){ echo "우등";} else{ echo "일반";}?></td>
							<td><?php echo $cash; ?></td>
							<td><?php if($how == 'other'){ echo "무통장 입금"; } else { echo "신용카드"; } ?></td>
						</tr>     

					</tbody>
				</table>
			</form>
			<button type="button" class="btn btn-info" onclick="location.href='home.php'">홈으로</button>
        </div>
      </article>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html> 
