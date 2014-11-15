<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>

<?php
	if (isset($_POST['Login']))
	{
		//Collect POST values
		$username = $_POST['username'];
		$password = $_POST['password'];
		$logintype = $_POST['logintype'];

		include 'connect.inc.php';	//connect to database

		if($logintype == 'student')
		{
			//Create query
			$qry = 'SELECT * FROM Student_Login WHERE USERNAME = '.$username.' AND PASSWORD = '.$password;
		}
		else
		{
			//Create query
			$qry = 'SELECT * FROM Recruiter_Login WHERE USERNAME = '.$username.' AND PASSWORD = '.$password;
		}
		
		//Execute query
		$result=mysql_query($qry);
		//Check whether the query was successful or not 
		if($result)
		{
			$count = mysql_num_rows($result);
		}
		else
		{
			//Login failed
			include('hello.php');
			echo '<center>Incorrect Username or Password !!!<center>';
			exit();
		}
			//if query was successful it should fetch 1 matching record from the table.
		if( $count == 1)
		{
			//Login successful set session variables and redirect to main page.
			session_start();
			$_SESSION['IS_AUTHENTICATED'] = 1;
			if($logintype == 'student')
			{
				$_SESSION['STUDENT_NAME'] = $username;
				header('location:main_page.php');
			}
			else
			{
				$_SESSION['RECRUITER_NAME'] = $username;
				header('location:main_page.php');
			}		
		}
		else
		{
			//Login failed 
			include('hello.php');
			echo '<center>Incorrect Username or Password !!!<center>';
			exit();
		}
	}
	else
	{
		header("location: hello.php");
		exit();
	}
?>