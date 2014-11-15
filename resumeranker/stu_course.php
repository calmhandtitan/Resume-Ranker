<?php 
	session_start();
	include 'connect.inc.php';	
	$sid = $_SESSION['SID'];
 ?>

<html>
	<head>
		<title>Course Entry Page</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<link rel="stylesheet" type="text/css" href="./css/forms.css">
	</head>
	
	<body>
		<?php
			include 'header.html';
		?>
		
		<form name="course" action="stu_course.php" method="POST">
			<center>
				<h3>Enter the details of four courses that you are best familiar with</h3>
				<table>
					<tr><th>Sno</th>
						<th>Course Name</th>
						<th>Grade</th>
					</tr>
					<tr>
						<td>1. </td>
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
					?>	</select></td>
						<td><select class="dropdepth" name="course1_grade">
						<option  value="NULL">----Select----</option>							
							<option value="10">A+</option>
							<option value="9">A</option>
							<option value="8">B+</option>
							<option value="7">B</option>
							<option value="6">C+</option>
							<option value="5">C</option>
							<option value="4">D+</option>
							<option value="3">D</option>
							<option value="2">F</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>2. </td>
						<td> <select name="course2" class="dropdepth">
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
						<td><select class="dropdepth" name="course2_grade">
						<option  value="NULL">----Select----</option>							
							<option value="10">A+</option>
							<option value="9">A</option>
							<option value="8">B+</option>
							<option value="7">B</option>
							<option value="6">C+</option>
							<option value="5">C</option>
							<option value="4">D+</option>
							<option value="3">D</option>
							<option value="2">F</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>3. </td>
						<td> <select name="course3" class="dropdepth">
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
						<td><select class="dropdepth" name="course3_grade">
						<option value="NULL">----Select----</option>							
							<option value="10">A+</option>
							<option value="9">A</option>
							<option value="8">B+</option>
							<option value="7">B</option>
							<option value="6">C+</option>
							<option value="5">C</option>
							<option value="4">D+</option>
							<option value="3">D</option>
							<option value="2">F</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>4. </td>
						<td> <select name="course4" class="dropdepth">
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
						<td><select class="dropdepth" name="course4_grade">
							<option value="NULL">----Select----</option>
							<option value="10">A+</option>
							<option value="9">A</option>
							<option value="8">B+</option>
							<option value="7">B</option>
							<option value="6">C+</option>
							<option value="5">C</option>
							<option value="4">D+</option>
							<option value="3">D</option>
							<option value="2">F</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<center>
								<input class = "modern" type="submit" name="skip" value="Skip">
								<input type="submit" class="modern"  name="course_submit" value="Submit and Proceed">	

							</center>							
						</td>
					</tr>
				</table>
			</center>
		</form>
	</body>
</html>

<?php 
	if(isset($_POST['skip']))
	{
		header('location: stu_profile2.php');	//goto next page
	}
	if(isset($_POST['course_submit']))
	{
		if(($_POST['course1']  != NULL) && ($_POST['course1_grade'] != NULL))
		{
			$course1 = "'".$_POST['course1']."'";

			$query = "SELECT COURSE_ID FROM COURSE WHERE COURSE_NAME = $course1";
			$result = mysql_query($query);

			$course1_id = 0;
			while($row = mysql_fetch_assoc($result))
			{
				$course1_id = $row['COURSE_ID'];
			}


			$course1_grade = $_POST['course1_grade'];
			$query = "INSERT INTO STUDENT_COURSE
						VALUES($sid, $course1_id, $course1_grade)";
			$result = mysql_query($query);

			if($result == FALSE)
			{
				echo mysql_error();
			}
		}
		if(($_POST['course2']  != NULL) && ($_POST['course2_grade'] != NULL))
		{
			$course2 = "'".$_POST['course2']."'";

			$query = "SELECT COURSE_ID FROM COURSE WHERE COURSE_NAME = $course2";
			$result = mysql_query($query);

			$course2_id = 0;
			while($row = mysql_fetch_assoc($result))
			{
				$course2_id = $row['COURSE_ID'];
			}


			$course2_grade = $_POST['course2_grade'];
			$query = "INSERT INTO STUDENT_COURSE
						VALUES($sid, $course2_id, $course2_grade)";
			$result = mysql_query($query);

			if($result == FALSE)
			{
				echo mysql_error();
			}
		}
		if(($_POST['course3']  != NULL) && ($_POST['course3_grade'] != NULL))
		{
			$course3 = "'".$_POST['course3']."'";

			$query = "SELECT COURSE_ID FROM COURSE WHERE COURSE_NAME = $course3";
			$result = mysql_query($query);

			$course3_id = 0;
			while($row = mysql_fetch_assoc($result))
			{
				$course3_id = $row['COURSE_ID'];
			}


			$course3_grade = $_POST['course3_grade'];
			$query = "INSERT INTO STUDENT_COURSE
						VALUES($sid, $course3_id, $course3_grade)";
			$result = mysql_query($query);

			if($result == FALSE)
			{
//				echo mysql_error();
			}
		}
		if(($_POST['course4']  != NULL) && ($_POST['course4_grade'] != NULL))
		{
			$course4 = "'".$_POST['course4']."'";

			$query = "SELECT COURSE_ID FROM COURSE WHERE COURSE_NAME = $course4";
			$result = mysql_query($query);

			$course4_id = 0;
			while($row = mysql_fetch_assoc($result))
			{
				$course4_id = $row['COURSE_ID'];
			}


			$course4_grade = $_POST['course4_grade'];
			$query = "INSERT INTO STUDENT_COURSE
						VALUES($sid, $course4_id, $course4_grade)";
			$result = mysql_query($query);

			if($result == FALSE)
			{
				echo mysql_error();
			}
		}
	}
 ?>