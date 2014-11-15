<?php
	session_start();
	include 'connect.inc.php';
	$orgid = $_SESSION['ORG_ID'];

	$orgname = '';

	$query = "SELECT * FROM ORGANISATION WHERE ORG_ID = $orgid";
	$result = mysql_query($query);
	while($row = mysql_fetch_assoc($result))	
	{
		$orgname = $row['ORG_NAME'];
	}

?>
<html>
	</head>
		<title>Organisation-Ratings</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		
	</head>
	
	<body>
		<?php
			include 'header.html';
		?>
		<center>
		<p class="p1" style="text-align:right;"><a style="text-align: right;" href="org_dash.php">Goto DashBoard</a></p>
		<h2><?php echo $orgname; ?></h2> 
		
		
	
		<h3> Table for the Ratings of candidates </h3>
		
		<table class="leaderboard_style">
			<thead>
				<th>Rank</th>
				<th>Name</th>
				<th>Insitute</th>
				<th>Discipline</th>
				<th>Rating</th>
			</thead>
			<tbody>
				<?php
					$query = "SELECT S.NAME as naam, S.INSTITUTE as clg, S.DNAME as disciname, O.O_RATING as rate
								FROM STUDENT S, ORG_RATING O
								WHERE O.org_id = $orgid
								AND O.sid = S.SID
								ORDER BY O.O_RATING DESC";
					$result = mysql_query($query);
					
					$my_array = '';
					$i = 1;
					if($result)
					{
						while($row = mysql_fetch_assoc($result))
						{
							echo '<tr>
									<td>'.$i.'<td>'.$row['naam'].'</td><td>'.$row['clg'].'</td><td>'.$row['disciname'].'</td><td>'.$row['rate'].'</tr>';
									$i++;
						}
					}
					else
					{
//						header('location:org_dash.php');
						exit();
					}
				?>
			</tbody>
		</table>
		</center>
	</body>
<html>
					
	