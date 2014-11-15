<?php
	session_start();
	include ('connect.inc.php');
	include 'func.php';

	$sid = $_SESSION['SID'];
?>

<html>
	<head>
		<title>
			Student Specification</title>
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/forms.css" />
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
		<center>
			<h3>Form to input details about the technical skills of candidate</h3>
			<table>
			<form name="certi_details" action="stu_profile2.php" method="post">
				<tr>
					<td>
					Choose between Workshop/Contest/Certification<span>*</span>:
					</td>
					<td>
						<select name="chooser" class="dropdepth">
							<option value="workshop">Workshop</option>
							<option value="contest">Contest</option>
							<option value="certi">Certification</option>
						</select>
					</td>
				</tr>

				<tr>
					<td>
						Organisor Name<span>*</span>: </td>
					<td> <input class="depth" type="text" name="organisor_name"/>
					</td>
				</tr>
				<tr>
					<td>Name of the workshop/contest/certification<span>*</span>:</td>
					<td><input class="depth" type="text" name="name"></td>
				</tr>
				<tr>
					<td>Workshop/Contest/Certification Type<span>*</span>:</td>
					<td><input class="depth" type="text" name="type"></td>
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
				for($i = date('Y')-10; $i <= date('Y'); $i++){
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
				for($i = date('Y')-10; $i <= date('Y'); $i++){
				echo "<option value='$i'>$i</option>";
				}
				?>
				</select>
				</td>
				</tr>				
<!--				
				<tr>
					<td>
						Rank in the contest
					</td>
					<td>
						<input  type="text" class="depth" name="rank" size="6">
					</td>
				</tr>
				<tr>
					<td>Total Participants</td>
					<td>
						<input  type="text" class="depth" name="total_participants" size="6">
					</td>
				</tr>
-->				
				<tr>
					<td>
						<input class = "modern" type="submit" name="skip" value="Skip">
					</td>
					<td>
						<input class="modern" type="submit" name="addmore" value="Submit & Add More">
						<input class="modern" type="submit" name = "submit" value="Submit and proceed">
					</td>
						

				</tr>
				
				
			</table>
		</center>
	</body>
</html>

<?php 
	if(isset($_POST['skip']))
	{
		header('location: stu_dash.php');	//goto next page
	}
	if(isset($_POST['submit']) || isset($_POST['addmore']))	//if user clicked on submit or add more, first add that entry
	{
		$chooser = $_POST['chooser'];

		if(!empty($name) && !empty($organisor_name) && !empty($type) && !empty($start_date)	)	//if all fields are filled, proceed
		{
			$name = "'".$_POST['name']."'";
			$organisor_name = "'".$_POST['organisor_name']."'";
			$type = "'".$_POST['type']."'";
//			$start_date = validateDate( $_POST['smonth']),    $_POST['sday'],   $_POST['syear']  );
//			$end_date =   validateDate( $_POST['emonth']),    $_POST['eday'],   $_POST['eyear']  );

			$start_date = "'".$_POST['syear'] . '-' . $_POST['smonth'] . '-' . $_POST['sday']."'";
			$end_date = "'".$_POST['eyear'] . '-' . $_POST['emonth'] . '-' . $_POST['eday']."'";
			//Check for valid date
			if(!$_POST['smonth'] || !$_POST['sday'] || !$_POST['syear'])
				$start_date = 'NULL';
			
			if($start_date != 'NULL')
			{
				if(!checkdate($_POST['smonth'],$_POST['sday'],$_POST['syear']))
				{
					echo $_POST['syear'] . '-' . $_POST['month'] . '-' . $_POST['sday'] . ' not a valid date. Please enter it properly.';
					$validationFlag = false;
				}
			}
			//Check for valid date
			if(!$_POST['emonth'] || !$_POST['eday'] || !$_POST['eyear'])
				$end_date = 'NULL';
			if($end_date != 'NULL')
			{
				if(!checkdate($_POST['emonth'],$_POST['eday'],$_POST['eyear']))
				{
					echo $_POST['eyear'] . '-' . $_POST['emonth'] . '-' . $_POST['eday'] . ' not a valid date. Please enter it properly.';
					$validationFlag = false;
				}
			}

			$query_successful = false;	
			switch ($chooser) 
			{
				case 'workshop': {
									$query = "INSERT INTO STUDENT_WORKSHOP
												VALUES($sid, $name, $type, $start_date, $end_date)";
									$result = mysql_query($query);

									if($result == FALSE)
									{
										echo mysql_error();
									}
									else
										$query_successful = true;

									break;	
							     }
				case 'contest': {
									
									$query = "INSERT INTO STUDENT_CONTEST
												VALUES($sid, $name, $type, $start_date, $end_date)";
									$result = mysql_query($query);

									if($result == FALSE)
									{
										echo mysql_error();
									}
									else
										$query_successful = true;
									
									break;	
							     }
				case 'certification': {
										$query = "INSERT INTO STUDENT_CERTI
													VALUES($name, $sid)";
										$result = mysql_query($query);

										if($result == FALSE)
										{
											echo mysql_error();
										}
										else
											$query_successful = true;
										
										break;	
								     }	
			}
			if($query_successful)
			{

				echo "query_successful :)";
				$_SESSION['sender_page'] = 'stu_profile2.php';
				if(isset($_POST['addmore']))	//if user wants to add more data
				{					
					header('Loaction: stu_profile2.php');	//redirect to own page
				}
				if(isset($_POST['submit']))	//if user wants to proceed
				{
					header('Loaction: stu_profile2.php');	//redirect to next page	
				}
			}
			
		}
		else 	//some field left empty
		{
			?>
			<script type="text/javascript">
			alert('Some fields have been left out. Please fill them to proceed! :)');
			</script>
			<?php
		}
	}
 ?>