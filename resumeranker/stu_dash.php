<?php 
	session_start();
	include 'connect.inc.php';

//	$_SESSION['SID'] = 2012063;
	$sid = $_SESSION['SID'];
	$sname = '';

	$query = "SELECT * FROM STUDENT WHERE SID = $sid";
	$result = mysql_query($query);
	while($row = mysql_fetch_assoc($result))	
	{
		$sname = $row['NAME'];
		$institute_name = $row['INSTITUTE'];
		$dname = $row['DNAME'];
		$quali = $row['QUALI'];
	}


	$my_rank = 0;
	$iter = 0;
	$my_array = array();
	$count = 1;

	//get top students on the basis of rating
	$query = "SELECT * FROM LEADERBOARD ORDER BY R_RATING DESC";
	$result = mysql_query($query);


	while(($row = mysql_fetch_assoc($result)) )
	{
		$leader_sid = $row['sid'];
		$rating = $row['r_rating'];

		$subquery = "SELECT * FROM STUDENT WHERE SID = $leader_sid";
		$subresult = mysql_query($subquery);

		if($leader_sid == $sid)
			$my_rank = $count;

		while($r1 = mysql_fetch_assoc($subresult))	
		{
			$leadername = $r1['NAME'];
			$leader_institute_name = $r1['INSTITUTE'];

			if( $count <= 5 ){
			$my_array[$iter] = '<tr>
				<td>'.$leadername.'</td>
				<td>'.$leader_institute_name.'</td>';
			}
		}
		if( $count <= 5){
		$my_array[$iter] = $my_array[$iter].'<td>'.$rating.'</td>
			</tr>';}
		$iter++;
		$count += 1;
	}							

?>

<html>
	<head>
		<title>Student-Dashboard</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<link rel="stylesheet" type="text/css" href="./css/forms.css">
		<style>
			body{
				margin:0px;
			}
		</style>
	</head>
	
	<body>
		<?php
			include 'header.html';
		?>
		
		<table class="top" border="1" cellspacing="0">
			<tr>
				<td width="500"><center>
					<h2><?php echo $sname; ?>'s DashBoard</h2><br>	</center>	<!-- Use php to enter the name of the student instead -->
					<center><table border="0" >
					<tr>
						<td><h4>Institute Name</h4></td>
						<td><h4>:</h4></td>
					    <td><h4><?php echo $institute_name; ?></h4></td>
					</tr>
					<tr>
						<td><h4>Department</h4></td>
					    <td><h4>:</h4</td>
						<td><h4><?php echo $dname; ?></h4></td>
					</tr>
					<tr>
						<td><h4>Programme</h4></td>
					    <td><h4>:</h4</td>
						<td><h4><?php echo $quali; ?></h4></td>
					</tr>
					</table></center>
					
				</td>
				<td width="250" >
					<div class="rate" style="background:#1847a8; height:100px;">
						<center><h2 style="font-size:40px;">Rank<br><?php echo $my_rank; ?></h2></center>
					</div>
					<br><br>
					<center><strong><a href="logout.php">Logout</a></strong></center>
					<br>
				
				</td>
				<td>
					<br>
					<center><h3>Leaderboard</h3></center>
					<table name="leaderboard" border="0" class="leaderboard_style">
						<thead>
						<tr>
							<th class="column_style">Name</th>
							<th class="column_style">Institute</th>
							<th class="column_style">Rating</th>
						</tr>
						</thead>
						<tbody>
						<?php
							for($i = 0; $i < $iter; $i++)
							{
								echo $my_array[$i];
							}
							
						?>
						</tbody>
					
					</table>
				</td>
			</tr>
		</table>
		
	</body>
</head>
		