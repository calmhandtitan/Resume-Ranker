<?php 
	session_start();
	include 'connect.inc.php';


//	$_SESSION['ORG_ID'] = 4;	// to be edited
	$orgid = $_SESSION['ORG_ID'];

	$orgname = '';

	$query = "SELECT * FROM ORGANISATION WHERE ORG_ID = $orgid";
	$result = mysql_query($query);
	while($row = mysql_fetch_assoc($result))	
	{
		$orgname = $row['ORG_NAME'];
		$estd_yr = $row['ESTD_YEAR'];
		$repo = $row['REPO'];
	}


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
		<title>Recruiter-Dashboard</title>
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
		<center>
		<table class="top" border="1" cellspacing="0">
			<tr>
				<td width="300"><center>
					<h2>Dashboard of Recruiter</h2><br>	</center>	<!-- Use php to enter the name of the student instead -->
					<center><table border="0" >
					<tr>
						<td><h4>Organisation Name</h4></td>
						<td><h4>:</h4></td>
					    <td><h4><?php echo $orgname; ?></h4></td>
					</tr>
					<tr>
						<td><h4>Establishment Year</h4></td>
					    <td><h4>:</h4</td>
						<td><h4><?php echo $estd_yr; ?></h4></td>
					</tr>
					<tr>
						<td><h4>Reputation</h4></td>
					    <td><h4>:</h4</td>
						<td><h4><?php echo $repo; ?></h4></td>
					</tr>
					</table></center>
					<center>
						<a href="org_rating.php">Click to see the ratings of all candidates</a>
					</div></center></h4>
					<br>
					<center><strong><a href="logout.php">Logout</a></strong></center>
				</td>
				<td width="500">
					<br><h3>Graph for the leaders according to your requirements</h3>
					<iframe src="./test/main.php" width="500" height="300"></iframe>
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
		</center>
		<center><h2>Detailed analysis of the leader Candidates</h2>
		<iframe src="./test/mainleader.php" width="1000" height="400" ></iframe> </center>
		
		
	</body>
</head>
		