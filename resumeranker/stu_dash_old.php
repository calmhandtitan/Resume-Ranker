<?php 
	session_start();
	include 'connect.inc.php';

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

?>

<html>
	<head>
		<title>Dashboard</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<link rel="stylesheet" type="text/css" href="./css/forms.css">
	</head>
	
	<body>
		<?php
			include 'header.html';
		?>
		
		<table name="top" border="2">
			<tr>
				<td width="600"><center>
					<h3><?php echo $sname; ?>'s DashBoard</h3></center>	<!-- Use php to enter the name of the student instead -->
					<table border="1">
					<tr>
						<td><h4>Institute Name</td>
					    <td><?php echo $institute_name; ?></h4></td>
					</tr>
					<tr>
						<td><h4>Discipline</td>
					    <td><?php echo $dname; ?></h4></td>
					</tr>
					<tr>
						<td><h4>Programme</td>
					    <td><?php echo $quali; ?></h4></td>
					</tr>
					</table>
				</td>
				<td width="250">
					<h3>hey wassup</h3>
				</td>
				<td>
					<center><h3>Leaderboard</h3></center>
					<table name="leaderboard" border="2">
						<thead>
						<tr>
							<th class="column_style">Name</th>
							<th class="column_style">Institute</th>
							<th class="column_style">Rating</th>
						</tr>
						</thead>
						<tbody>
						<?php

							//get top students on the basis of rating
							$query = "SELECT * FROM STU_RATING ORDER BY SRATING DESC";
							$result = mysql_query($query);
							$count = 1;
							while(($row = mysql_fetch_assoc($result)) && ($count <= 5))
							{
								$leader_sid = $row['SID'];
								$rating = $row['SRATING'];

								$subquery = "SELECT * FROM STUDENT WHERE SID = $leader_sid";
								$subresult = mysql_query($subquery);


								while($r1 = mysql_fetch_assoc($subresult))	
								{
									$leadername = $r1['NAME'];
									$leader_institute_name = $r1['INSTITUTE'];

									echo '<tr>
										<td>'.$leadername.'</td>
										<td>'.$leader_institute_name.'</td>';
								}
								echo '<td>'.$rating.'</td>
									</tr>';
								$count += 1;
							}							
						
						?>
						</tbody>
					
					</table>
				</td>
			</tr>
		</table>
		
	</body>
</head>
		