<?php 
	session_start();
	include 'connect.inc.php';

	if(!isset($_SESSION['SID']))
	{
		$_SESSION['SID'] = 1;
	}
	else
	{
		$_SESSION['SID'] += 1;
	}
	if($_SESSION['sender_page'] == 'NULL')
	{
		?>
			<script type="text/javascript">
			alert('Wrong username or password! Please Try Again!!');
			</script>
		<?php	
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style type="text/css">
	span{
		color:red;
	}
	p1{
		text-align: right;
	}

	</style>
	<link rel="stylesheet" type="text/css" href="css/forms.css" />
</head>
<body>
	<p class="p1"><span>All fields marked with * are mandatory.</span></p>

	<form action="login.php" method="POST">
		<table border="1" cellpadding="2" cellspacing="2" align="center">
			<tr>
				<td>Userame<span>*</span>:</td>
				<td><input type="text" class = "depth" name="username"></td>
			</tr>
			<tr>
				<td>Password<span>*</span>:</td>
				<td><input type="password" class = "depth"name="password"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input class = "modern" type="submit" name="login" value="Login">
				</td>
			</tr>

		</table>
	</form>
</body>
</html>


<?php 

	if(isset($_POST['login']))
	{
		if(!empty($_POST['username']) && !empty($_POST['password']) )
		{
			$username = "'".$_POST['username']."'";
			$password = "'".$_POST['password']."'";
			$password = md5($password);

			$qry='SELECT * FROM STUDENT_LOGIN WHERE USERNAME = '.$username.' AND PASSWORD = '.$password;

			//Execute query
			$results = mysql_query($query);

			//Check if query executes successfully
			if($results == FALSE)	//login failed
			{
				$_SESSION['sender_page'] = 'NULL';
				header('location: login.php');
			}
			else 	//login successfull
			{
				$_SESSION['stu_name'] = $name;
				$_SESSION['sender_page'] = 'login.php';
				header('location: stu_profile.php');
			}
		}
		else
			echo "Please fill the required fields!";
	}
 ?>