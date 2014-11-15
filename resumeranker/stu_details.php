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
	if(!isset($_SESSION['sender_page']))	//notify for completion of last page
		$_SESSION['sender_page'] = 'NULL';
	else
	{
		?>
			<script type="text/javascript">
			alert('An Error Occured! Please Try Again!!');
			</script>
		<?php	
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Student-Profile</title>
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

	<form action="stu_profile.php" method="POST">
		<table border="1" cellpadding="2" cellspacing="2" align="center">
			<tr>
				<td>Name<span>*</span>:</td>
				<td><input type="text" class = "depth" name="sname"></td>
			</tr>
			<tr>
				<td>Date of Birth<span>*</span>:</td>
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
				for($i = date('Y')-40; $i <= date('Y')-14; $i++){
				echo "<option value='$i'>$i</option>";
				}
				?>
				</select>
				</td>
				</tr>
			<tr>
				<td>XII Percentage:</td>
				<td><input type="text" class = "depth"name="XII_perc"></td>
			</tr>
			<tr>
				<td>ADDRESS:</td>
				<td><input type="text" class = "depth"name="address"></td>
			</tr>
			<tr>
				<td>CGPA<span>*</span>:</td>
				<td><input type="text" class = "depth"name="cgpa"></td>
			</tr>
			<tr>
				<td>CONTACT:</td>
				<td><input type="text" class = "depth"name="contact"></td>
			</tr>
			<tr>
				<td>Institute<span>*</span>:</td>
				<td><input type="text" class = "depth"name="institute"></td>
			</tr>
			<tr>
				<td>Highest Qualification<span>*</span>:</td>
				<td><input type="text" class = "depth"name="qualification"></td>
			</tr>
			<tr>
				<td>Discipline<span>*</span>:</td>
				<td>
					<select class="dropdepth" name = "dname">
					<option></option>
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
				<td>Interests<span>*</span>:</td>
				<td>
					<textarea class="depth" rows = "5" cols="30" name="interests">Separate different interests with ',' only</textarea>					
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input class = "modern" type="submit" name="submit_profile" value="Submit">
					<input class = "modern" type="submit" name="skip" value="Skip">
				</td>
			</tr>

		</table>
	</form>
</body>
</html>


<?php 
	if(isset($_POST['skip']))
	{
		header('location: stu_projects.php');
	}
	if(isset($_POST['submit_profile']))
	{
		if(!empty($_POST['XII_perc']) && !empty($_POST['address']) && !empty($_POST['cgpa']) &&  !empty($_POST['institute']) && !empty($_POST['qualification']) )
		{
			$name = "'".$_POST['sname']."'";
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

			$interests = "'".$_POST['interests']."'";	//interests is a string separated by commas
			//now isolating different interests using explode function
			//explode(delimiter, string): this works same as split() in python or str_tok() in C
			$interests_array = explode(',' , $interests);	

			//Create Insert query
			$query = "INSERT INTO STUDENT
			(NAME, DOB, XII_PERC, ADDRESS, CGPA, CONTACT, INSTITUTE, 
			QUALI, DNAME) 
			VALUES 
			($name, $dob, $XII_perc, $address, $cgpa, $contact, $institute, $qualification,
			$dname)";

			//Execute query
			$results = mysql_query($query);

			foreach ($element as $interests_array) 
			{
				echo $element;
				$query2 = "INSERT INTO INTERESTS (SID, INTEREST) 
							VALUES 	($sid, $element)";			
				$results2 = mysql_query($query2);
			}
			
			/*
				need to use transaction here 
				only proceed when both the queries finishes.
			*/

			//Check if query executes successfully
			if($results == FALSE && $results2 == FALSE)	//if any single query fail
			{
				$_SESSION['sender_page'] = 'NULL';
				header('location: stu_profile.php');
			}
			else 	//if both query passs
			{
				$_SESSION['stu_name'] = $name;
				$_SESSION['sender_page'] = 'stu_profile.php';
				header('location: stu_projects.php');
			}
		}
		else
			echo "Please fill the required fields!";
	}
 ?>