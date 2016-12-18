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
    <link rel="stylesheet" href="css/book.css" media="screen" title="no title" charset="utf-8">

</head>

<?php
	session_start();
	$link = mysqli_connect('localhost', 'root', '1q2w3e4r', 'blackit');
	$qry_chk = mysqli_query($link,'select * from bus where code='.$_POST['start']);
	$row = mysqli_fetch_row($qry_chk);
	$lang = 1;
?>
<body>
<article class="container">
<div class="page-header">
          <h1>좌석 선택 <small>Choose Sit</small></h1>
        </div>
<center>

<br><br><br><br>
       <div class="col-md-6 col-md-offset-3">
				  <table class="table table-striped">
				  <thead>
				  <th>
				  예매 정보
				  </th>
				  </thead>
					<tbody>
						<tr>
							<td>출발</td>
							<td><?php print $row[$lang].'['.$row[0].']'; ?><br>
								<?php	$qry_chk = mysqli_query($link,'select * from bus where code='.$_POST['end']);
										$row = mysqli_fetch_row($qry_chk);
								?>
							</td>
						</tr>      
						<tr>
							<td>도착</td>
							<td><?php print $row[$lang].'['.$row[0].']'; ?><br></td>
						</tr>
						<tr>
							<td>출발시간</td>
							<td><?php print $_POST['date'].' '.$_POST['time'].':00'; ?><br></td>
						</tr>
						<tr>
							<td>총인원</td>
							<td><?php print '어른('.$_POST['senior'].') 학생('.$_POST['student'].') 아동('.$_POST['junior'].')';?></td>
						</tr>
						<tr>
							
<?php
	$qry_chk = mysqli_query($link,'select * from bus_sc where code=\''.$_POST['start'].$_POST['end'].date("md",strtotime($_POST['date'])).$_POST['time'].$_POST['role'].'\'');
	if( mysqli_num_rows( $qry_chk ) == 0 )
	{
		if( $_POST['role'] == 1 )
			$Array = array(1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);
		else if( $_POST['role'] == 0 )
			$Array = array(1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);
		$seat = serialize($Array);
		$code = $_POST['start'].$_POST['end'].date("md",strtotime($_POST['date'])).$_POST['time'].$_POST['role'];
		mysqli_query($link,"insert into bus_sc values($code, '$seat')");
		$qry_chk = mysqli_query($link,"select * from bus_sc where code='$code'");
		
	}
?>

<form name='seatform' action='' method='post'>
<table>
<?php
	
	$row = mysqli_fetch_row($qry_chk);
	$array = unserialize($row[1]);

	if( $_POST['role'] == 1 )
	{
		for( $i=0; $i<36; $i++)
		{
			if( $i %9 == 0 && $i > 0 ) print '</tr>';
			if( $i % 9 == 0 ) print '<tr>';
			if( $i < 9 )
			{
				print "<td>";
				if( $array[$i*3] != 0 )
					print "<input type='checkbox' name='seat' value=".($i*3+1)."/>";
				print "".($i*3+1)."</td>";
			}
			else if( $i < 18 )
			{
				if( $i == 17 )
				{
					print "<td>";
					if( $array[25] != 0 )
						print "<input type='checkbox' name='seat' value=26/>";
					print "26</td>";
				}
				else print "<td></td>";
			}
			else if( $i < 27){
				if( (($i%9)*3+2) == 26 )
				{
					print "<td>";
					if( $array[26] != 0 )
						print "<input type='checkbox' name='seat' value=27/>";
					print "27</td>";
				}
				else
				{
					print "<td>";
					if( $array[(($i%9)*3+2)-1] != 0 )
						print "<input type='checkbox' name='seat' value=".(($i%9)*3+2)."/>";
					print "".(($i%9)*3+2)."</td>";
				}
			}
			else{
				if( (($i%9)*3+3) == 27 )
				{
					print "<td>";
					if( $array[26] != 0 )
						print "<input type='checkbox' name='seat' value=28/>";
					print "28</td>";
				}
				else
				{
					print "<td>";
					if( $array[(($i%9)*3+3)-1] != 0 )
						print "<input type='checkbox' name='seat' value=".(($i%9)*3+3)."/>";
					print "".(($i%9)*3+3)."</td>";
				}
			}
		}
		print '</tr>';
	}

	else{
		print "<tr>";
		for($i=0; $i<11; $i++)
		{
			print "<td>";
			if( $array[$i*4+1-1] != 0 )
				print "<input type='checkbox' name='seat' value=".($i*4+1)."/>";
			print "".($i*4+1)."</td>";
		}
		print '</tr>';
		print "<tr>";

		for($i=0; $i<11; $i++)
                {
                        print "<td>";
                        if( $array[$i*4+2-1] != 0 )
                                print "<input type='checkbox' name='seat' value=".($i*4+2)."/>";
                        print "".($i*4+2)."</td>";
                }
		print '</tr>';
                print "<tr>";
		for($i=0; $i<10; $i++)
		{
			print "<td>";
			print "</td>";
		}
		print "<td>";
		if( $array[44] != 0 )
			print "<input type='checkbox' name='seat' value=45/>";
		print "45</td>";

		print '</tr>';
                print "<tr>";
		for($i=0; $i<11; $i++)
                {
                        print "<td>";
                        if( $array[$i*4+3-1] != 0 )
                                print "<input type='checkbox' name='seat' value=".($i*4+3)."/>";
                        print "".($i*4+3)."</td>";
                }

		print '</tr>';
                print "<tr>";
		for($i=0; $i<11; $i++)
                {
                        print "<td>";
                        if( $array[$i*4+4-1] != 0 )
                                print "<input type='checkbox' name='seat' value=".($i*4+4)."/>";
                        print "".($i*4+4)."</td>";
                }

		print "</tr>";
	}
?>
</table>
						</tr>

						<tr>
						</br>
						<button id='next' class="btn btn-info" onclick=<?php print "book(".($_POST['senior']+$_POST['student']+$_POST['junior']).");"?> >&nbsp;&nbsp;&nbsp;다음&nbsp;&nbsp;&nbsp;</button>
						</tr>
					</tbody>
				</table>
	
			
			</div>

<input type='hidden' name='code' value=<?php print $_POST['start'].$_POST['end'].date("md",strtotime($_POST['date'])).$_POST['time'].$_POST['role'] ?> >
<input type='hidden' name='role' value=<?php print $_POST['role']?>>
<input type='hidden' name='senior' value=<?php print $_POST['senior']?>>
<input type='hidden' name='student' value=<?php print $_POST['student']?>>
<input type='hidden' name='junior' value=<?php print $_POST['junior']?>>
<input type='hidden' name='start' value=<?php print $_POST['start']?>>
<input type='hidden' name='end' value=<?php print $_POST['end']?>>
<input type='hidden' name='date' value=<?php print $_POST['date']?>>
<input type='hidden' name='time' value=<?php print $_POST['time']?>>
</form>
	
	<br><br>
	

</center>
</article>
</body>

</html>
