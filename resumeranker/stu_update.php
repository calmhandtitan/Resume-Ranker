<?php 
	session_start();
	include 'connect.inc.php';
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Student-Update</title>
</head>
<body>

</body>
</html>

<?php 
	if(isset($_POST['skip']))
	{
		header('location: main_page.php');
	}
	if(isset($_POST['submit_profile']))
	{
		if(!empty($_POST['XII_perc']) && !empty($_POST['address']) && !empty($_POST['cgpa']) &&  !empty($_POST['institute']) && !empty($_POST['qualification']) )
		{
			$name = "'".$_SESSION['STUDENT_NAME']."'";
			$XII_perc = "'".$_POST['XII_perc']."'";
			$address = "'".$_POST['address']."'";
			$cgpa = "'".$_POST['cgpa']."'";
			$contact = "'".$_POST['contact']."'";
			$institute = "'".$_POST['institute']."'";
			$qualification = "'".$_POST['qualification']."'";
			$dob = "'".$_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day']."'";
			$dname = "'".$_POST['dname']."'";

			if(!$_POST['month'] || !$_POST['day'] || !$_POST['year'])
				$dob = 'NULL';
			//Check for valid date
			if($dob != 'NULL')
			{
				if(!checkdate($_POST['month'],$_POST['day'],$_POST['year']))
				{
					echo $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'] . ' not a valid date. Please enter it properly.';
					$validationFlag = false;
				}
			}
			if(!$_POST['contact'])
				$contact = 'NULL';
			else
				$contact = "'".$_POST['contact']."'";

			//Create Insert query
			$query = "INSERT INTO STUDENT
			(NAME, DOB, XII_PERC, ADDRESS, CGPA, CONTACT, INSTITUTE, 
			QUALI, DNAME) 
			VALUES 
			($name, $dob, $XII_perc, $address, $cgpa, $contact, $institute, $qualification,
			$dname)";

			//Execute query
			$results = mysql_query($query);

			//Check if query executes successfully
			if($results == FALSE)
				echo mysql_error() . '<br>';
			else
				echo 'Data inserted successfully! ';
		}
		else
			echo "PLease fill the required fields!";
	}
 ?>