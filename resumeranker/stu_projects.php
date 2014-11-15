<?php 
	session_start();

	include 'connect.inc.php';
	include 'func.php';

	$sid = $_SESSION['SID'];
	$sname = '';

	$query = "SELECT NAME FROM STUDENT WHERE SID = $sid";
	$result = mysql_query($query);
	while($row = mysql_fetch_assoc($result))	
	{
		$sname = $row['NAME'];
	}
/*
	if($_SESSION['sender_page'] == 'stu_profile.php')	//notify for completion of last page
	{
		?>
			<script type="text/javascript">
			alert('Congratulations! You have been registered successfully!');
			</script>
		<?php
	}
	else 	//notify an error
	{
		?>
			<script type="text/javascript">
			alert('An Error Occured! Please Try Again!!');
			</script>
		<?php	
	}
*/	
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Student-Projects</title>
	<link rel="stylesheet" type="text/css" href="css/forms.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<style type="text/css">
	span{
		color:red;
	}
	p1{
		text-align: right;
	}
	
	</style>
</head>
<body>
	<?php
		include('header.html');
	?>

	<p class="p1" style="text-align:right;"><span>All fields marked with * are mandatory.</span></p>
	<form action="stu_projects.php" method="POST">
		<table border="1" cellpadding="2" cellspacing="2" align="center">
			<tr>
				<td>Name:</td>
				<td><?php echo $sname; ?></td>
			</tr>

			<tr>
				<td>Project Title<span>*</span>:</td>
				<td><input type="text" class = "depth"name="ptitle"></td>
			</tr>
			<tr>
				<td>Project Type<span>*</span>:</td>
				<td>
					<select class="dropdepth" name = "ptype">
					<option></option>
					<option value = "Academic" >Academic</option>
					<option value = "Individual" >Individual</option>
					<option value = "Intern Project" >Intern Project</option>
					<option value = "Work Project" >Work Project</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Status<span>*</span>:</td>
				<td>
					<select class="dropdepth" name = "status">
					<option></option>
					<option value = "Completed" >Completed</option>
					<option value = "Ongoing" >Ongoing</option>
					</select>
				</td>
			</tr>
			<tr>	
				<td>Role<span>*</span>:</td>
				<td>
				<select class="dropdepth" name = "role">
					<option></option>
					<option value = "Designer" >Designer</option>
					<option value = "Developer" >Developer</option>
					<option value = "Tester" >Tester</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Start Date<span>*</span>:</td>
				<td>Day<select name = "sday" class="dropdepth">
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
				Month<select name = "smonth" class="dropdepth">
				<option></option>
				<?php 
					foreach($months as $num => $nm){
					echo "<option value='$num'>$nm</option>";
					}
				?>
				</select>
				Year<select name = "syear" class="dropdepth">
				<option></option>
				<?php
				for($i = date('Y')-40; $i <= date('Y')-14; $i++){
				echo "<option value='$i'>$i</option>";
				}
				?>
				</select>
				</td>
				</tr>
			<tr>
				<td>End Date:</td>
				<td>Day<select name = "eday" class="dropdepth">
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
				Month<select name = "emonth" class="dropdepth">
				<option></option>
				<?php 
					foreach($months as $num => $nm){
					echo "<option value='$num'>$nm</option>";
					}
				?>
				</select>
				Year<select name = "eyear" class="dropdepth">
				<option></option>
				<?php
				for($i = date('Y')-40; $i <= date('Y')-14; $i++){
				echo "<option value='$i'>$i</option>";
				}
				?>
				</select>
				</td>
				</tr>

			<tr>
				<td>Web Link:</td>
				<td><input type="text" class = "depth" name="weblink"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input class = "modern" type="submit" name="submit_profile" value="Submit">
					<input class = "modern" type="submit" name="addmore" value="Add More">				
					<input class = "modern" type="submit" name="skip" value="Skip">
				</td>
			</tr>

		</table>
	</form>
</body>
</html>


<?php 

	if(isset($_POST['skip']))	//if user wants to enter projects later
	{
		header('location: stu_course.php');	//goto next page
	}


	if(isset($_POST['submit_profile']) || isset($_POST['addmore'])) //if either is submitted
	{
		if(!empty($_POST['ptitle']) && !empty($_POST['ptype']) && !empty($_POST['status']) && !empty($_POST['role']))
		{
			$name = "'".$sname."'";
			$ptitle = "'".$_POST['ptitle']."'";
			$ptype = "'".$_POST['ptype']."'";
			$status = "'".$_POST['status']."'";
//			$start_date = validateDate($_POST['smonth']), $_POST['sday'], $_POST['syear']);
//			$end_date = validateDate($_POST['emonth']), $_POST['eday'], $_POST['eyear']);
			$start_date = "'".$_POST['syear'] . '-' . $_POST['smonth'] . '-' . $_POST['sday']."'";
			$end_date = "'".$_POST['eyear'] . '-' . $_POST['emonth'] . '-' . $_POST['eday']."'";

			if(!$_POST['smonth'] || !$_POST['sday'] || !$_POST['syear'])
				$start_date = 'NULL';
			//Check for valid date
			if($start_date != 'NULL')
			{
				if(!checkdate($_POST['smonth'],$_POST['sday'],$_POST['syear']))
				{
					echo $_POST['syear'] . '-' . $_POST['month'] . '-' . $_POST['sday'] . ' not a valid date. Please enter it properly.';
					$validationFlag = false;
				}
			}
			if(!$_POST['emonth'] || !$_POST['eday'] || !$_POST['eyear'])
				$end_date = 'NULL';
			//Check for valid date
			if($end_date != 'NULL')
			{
				if(!checkdate($_POST['emonth'],$_POST['eday'],$_POST['eyear']))
				{
					echo $_POST['eyear'] . '-' . $_POST['emonth'] . '-' . $_POST['eday'] . ' not a valid date. Please enter it properly.';
					$validationFlag = false;
				}
			}

			if(!$_POST['weblink'])
				$weblink = 'NULL';
			else
				$weblink = "'".$_POST['weblink']."'";
			if(!$_POST['role'])
				$role = 'NULL';
			else
				$role = "'".$_POST['role']."'";

			//Create Insert query
			$query1 = "INSERT INTO PROJECT
			(PTITLE, PTYPE, STATUS, LINK) 
			VALUES 
			($ptitle, $ptype, $status, $weblink)";

			$query2 = "INSERT INTO STUDENT_PROJECT
			(SID, PTITLE, PTYPE, START_DATE, END_DATE, ROLE) 
			VALUES 
			($sid, $ptitle, $ptype, $start_date, $end_date, $role)";

			//Execute query
			$results1 = mysql_query($query1);
			$results2 = mysql_query($query2);

			//if both the queries process correctly then only proceed else rollback
			//need to use transaction here

			//Check if query executes successfully
			if($results1 == FALSE && $results2 == FALSE)	//if both didn't work
			{
				$_SESSION['sender_page'] = 'NULL';	//this will notify an error
				header('location: stu_projects.php');
			}
			else //if both worked
			{
				$_SESSION['sender_page'] = 'stu_projects.php';	//initialize the sender page

				if(isset($_POST['addmore']))
					header('location: stu_projects.php');	//if user wants to add more projectcs
				else
					header('location: stu_course.php');	//to next page
			}
		}
		else
			echo "Please fill the required fields!";
	}
 ?>