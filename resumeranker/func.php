<?php 

function validateDate($month, $day, $year)
{

	$date = "'".$_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day']."'";	//initialize date

	if(!$_POST['month'] || !$_POST['day'] || !$_POST['year'])	//check for NULL
		$date = 'NULL';

	
	if($date != 'NULL')			//Check for valid date
	{
		if(!checkdate($_POST['month'],$_POST['day'],$_POST['year']))
		{
			echo $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'] . ' not a valid date. Please enter it properly.';
			$validationFlag = false;
		}
	}
	return $date;
}

?>