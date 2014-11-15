<?php
	session_start();
	include ('connect.inc.php');
	$orgid = $_SESSION['ORG_ID'];
?>
<html>
	<head>
		<title>
			Company Specification</title>
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/forms.css" />
	</head>
	
	<body>
	<?php
		include('header.html');
	?>
		<center>
			<div>
			<h3>Requirement form for the Recruiters</h3>
					<strong><a style="text-align:right" href="logout.php">Logout</a></strong>
			<table border="1">
				<form name="company1" action="company_file.php" method="post">
					<tr>
						<td>Recruiter Organisation Name</td>
						<td><input class = "depth" type="text" name="orgname"></td>
					</tr>
					<tr>
						<td>Desired Department</td>
						<td>
							<select class="dropdepth" name = "dname">
				
							<?php
								//Prepare query
								$query = "SELECT DNAME FROM discipline";
								//Execute query 
								$result = mysql_query($query);
	
								while($row = mysql_fetch_array($result))
								{
									echo '<option value = "'.$row['DNAME'].'" >'.$row['DNAME'].'</option>';
	
								}
							?>
							</select>
						</td>
					</tr>
					<tr>
					<hr>
					<tr>
						<td colspan="2">
							<center><strong>Academic priorities</strong></center></td>
					</tr>
					<tr>
						<td>XII percentage Weightage</td>
						<td><input type="text" name="perc_weight" class="depth"></td>
					</tr>
					<tr>
						<td>CGPA Weightage</td>
						<td><input type="text" name="CGPA_weight" class="depth"></td>
					</tr>
					<tr>
						<td colspan="2">
							<center><strong>Technical Preferences</strong></center></td>
					</tr>
					<tr>
						<td>Workshops desired on topics</td>
						<td>
							<textarea class="depth" rows = "5" cols="30" name="workshops">Separate different topics with ',' only</textarea>					
						</td>
					</tr>
					<tr>
						<td>Weightage to workshops</td>
						<td><input type="text" name="workshop_weight" class="depth"></td>
					</tr>
					<tr>
						<td>Certifications desired on topics</td>
						<td>
							<textarea class="depth" rows = "5" cols="30" name="certifications">Separate different topics with ',' only</textarea>					
						</td>
					</tr>
					<tr>
						<td>Weightage to certifications</td>
						<td><input type="text" name="certification_weight" class="depth"></td>
					</tr>
					<tr>
						<td>Type of Contests desired</td>
						<td>
							<textarea class="depth" rows = "5" cols="30" name="contests">Separate different topics with ',' only</textarea>					
						</td>
					</tr>
					<tr>
						<td>Weightage to Contests</td>
						<td><input type="text" name="con_weight" class="depth"></td>
					</tr>
					<tr>
						<td>Type of Projects desired</td>
						<td>
							<textarea class="depth" rows = "5" cols="30" name="projects">Separate different titles with ',' only</textarea>					
						</td>
					</tr>
					<tr>
						<td>Weightage to Projects</td>
						<td><input type="text" name="project_weight" class="depth"></td>
					</tr>

					<tr>
					<tr>
						<td colspan="2"><center><strong>Any Extra Weightage to some particular course</strong></center></td>
					</tr>
					<tr>
						<td>Course Name</td>
						<td>
													<select name="course1" class="dropdepth">
							<option value="NULL">--------------------Select--------------------</option>
							<?php
						
						//Prepare query
						$query = "SELECT COURSE_NAME FROM course";
						//Execute query 
						$result = mysql_query($query);

						while($row = mysql_fetch_array($result))
						{
							echo '<option value = "'.$row['COURSE_NAME'].'" >'.$row['COURSE_NAME'].'</option>';

						}
					?>	</select>
						</td>
					</tr>
						<td>Weightage</td>
						<td><input type="text" name="course1_weight" class="depth"></td>
					</tr>
					
					<tr>
						<td>Course Name</td>
						<td>						<select name="course2" class="dropdepth">
							<option value="NULL">--------------------Select--------------------</option>
							<?php
						
						//Prepare query
						$query = "SELECT COURSE_NAME FROM course";
						//Execute query 
						$result = mysql_query($query);

						while($row = mysql_fetch_array($result))
						{
							echo '<option value = "'.$row['COURSE_NAME'].'" >'.$row['COURSE_NAME'].'</option>';

						}
					?>	</select></td>
					</tr>
						<td>Weightage</td>
						<td><input type="text" name="course2_weight" class="depth"></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input class = "modern" type="submit" name="submit_profile" value="Submit">
						</td>
					</tr>					
				</form>
			</table>
		</center>
	</body>
</html>

<?php 

	if(isset($_POST['skip']))
	{
		header('location: stu_projects.php');
	}
	if(isset($_POST['submit_profile']))
	{
		if(!empty($_POST['orgname']) && !empty($_POST['dname'])) 
		{

			$orgname = "'".$_POST['orgname']."'";
			$dname = "'".$_POST['dname']."'";
			$workshops = "'".$_POST['workshops']."'";
			$certifications = "'".$_POST['certifications']."'";
			$contests = "'".$_POST['contests']."'";
			$projects = "'".$_POST['projects']."'";
			$course1 = "'".$_POST['course1']."'";
			$course2 = "'".$_POST['course2']."'";

			$perc_weight = $_POST['perc_weight'];
			$CGPA_weight = $_POST['CGPA_weight'];
			$workshop_weight = $_POST['workshop_weight'];
			$certification_weight = $_POST['certification_weight'];
			$con_weight = $_POST['con_weight'];
			$course1_weight = $_POST['course1_weight'];
			$course2_weight = $_POST['course2_weight'];
			$project_weight = $_POST['project_weight'];

			//Create Insert query
			$query = "INSERT INTO REC_DATA
			VALUES 
			($orgid, $orgname, $dname, $perc_weight, $CGPA_weight, $workshops, $workshop_weight, $contests, $con_weight, $certifications,
			 $certification_weight, $course1, $course1_weight, $course2, $course2_weight, $projects, $project_weight)";
			
			//Execute query
			$results = mysql_query($query);

			/*
				need to use transaction here 
				only proceed when both the queries finishes.
			*/

			//Check if query executes successfully
			if($results == TRUE)	//if query pass
			{	
				$_SESSION['sender_page'] = 'company_file.php';
				echo "data inserted successfully";
//				header('location: stu_projects.php');
			}
			else 	//if doesn't pass
			{
				$_SESSION['sender_page'] = 'NULL';
				echo mysql_error();
//				header('location: stu_profile.php');
			}
		}
		else
			echo "Please fill the required fields!";
	}
 ?>