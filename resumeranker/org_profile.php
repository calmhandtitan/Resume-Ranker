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
		$estd_yr = $row['ESTD_YEAR'];
		$repo = $row['REPO'];
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Recruiter-Profile</title>
	<style type="text/css">
	span{
		color:red;
	}
	p1{
		text-align: right;
	}
	
	</style>
	<link rel="stylesheet" type="text/css" href="css/forms.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
	<?php
		include('header.html');
	?>

	<p class="p1" style="text-align:right;"><span>All fields marked with * are mandatory.</span></p>

	<form action="org_profile.php" method="POST">
		<table border="1" cellpadding="2" cellspacing="2" align="center">
			<tr>
				<td>Organization Name<span>*</span>:</td>
				<td><input type="text" class = "depth"name="name"></td>
			</tr>
			<tr>
				<td>Established Year<span>*</span>:</td>
				<td>Day<select name = "day" class="dropdepth">
				<option></option>
				<?php
					for($i = 1; $i <= 31; $i++){
					echo '<option value='.$i.'>'.$i.'</option>';
					}
				?>
				</select>
				<?php
				$months = array('01'=>'January', '02'=>'February',
				'03'=>'March', '04'=>'April', '05'=>'May',
				'06'=>'June', '07'=>'July', '08'=>'August',
				'09'=>'September','10'=>'October',
				'11'=>'November','12'=>'December');
				?>
				Month<select name = "month" class="dropdepth">
				<option></option>
				<?php 
					foreach($months as $num => $nm){
					echo "<option value='$num'>$nm</option>";
					}
				?>
				</select>
				Year<select name = "year" class="dropdepth">
				<option></option>
				<?php
				for($i = date('Y')-20; $i <= date('Y')-1; $i++){
				echo "<option value='$i'>$i</option>";
				}
				?>
				</select>
				</td>
				</tr>
			<tr>
				<td>HR Contact:</td>
				<td><input type="text" class = "depth"name="contact"></td>
			</tr>
			<tr>
				<td>Number of Branches:</td>
				<td><input type="text" class = "depth"name="repo"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input class = "modern" type="submit" name="submit_profile" value="Submit">
				</td>
			</tr>

		</table>
	</form>
</body>
</html>


<?php 
	if(isset($_POST['submit_profile']))
	{
		if(!empty($_POST['name']) )
		{
			
			$name = "'".$_POST['name']."'";
			$estd_yr = "'".$_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day']."'";
			$contact = $_POST['contact'];
			$repo = $_POST['repo'];


			if(!$_POST['month'] || !$_POST['day'] || !$_POST['year'])
				$estd_yr = 'NULL';
			//Check for valid date
			if($estd_yr != 'NULL')
			{
				if(!checkdate($_POST['month'],$_POST['day'],$_POST['year']))
				{
					echo $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'] . ' not a valid date. Please enter it properly.';
					$validationFlag = false;
				}
			}

			//Create Insert query
			$query = "INSERT INTO ORGANISATION
			VALUES 
			($orgid, $name, $estd_yr, $contact, $repo)";
			
			//Execute query
			$results = mysql_query($query);


			//Check if query executes successfully
			if($results == TRUE)	
			{
				$_SESSION['sender_page'] = 'company_file.php';
				header('location: company_file.php');
			}
			else 	//if one doesn't pass
			{
				$_SESSION['sender_page'] = 'NULL';
//				header('location: stu_profile.php');
			}
		}
		else
			echo "Please fill the required fields!";
	}
 ?>