<?php 

include('connect.inc.php');

$get_sid = "SELECT R.ORG_ID as ORGID, S.SID as SID, S.XII_PERC, S.CGPA, R.XII_PERC as perc_wt, R.CGPA as cgpa_wt
			FROM REC_DATA R,STUDENT S 
			WHERE R.DNAME = S.DNAME  ";	//GET STUDENTS ID'S OF THOSE DISCIPLINE
$res1 = mysql_query($get_sid);

if($res1 == FALSE)
	echo mysql_error();
else
	echo "done<br>";


while( $row= mysql_fetch_assoc($res1))
{
	echo $row['ORGID'].' '.$row['SID'].' '.$row['XII_PERC'].' '.$row['CGPA']. ' '.$row['perc_wt'].' '.$row['cgpa_wt'].'<br>';
}

//declare an associative array with student's name mapped to 0
$zero = 0;
while ($row = mysql_fetch_assoc($res1))
{
	$orgid = $row['ORGID'];
	$sid = $row['SID'];
	$q =  "INSERT INTO stu_rating 
			VALUES ($orgid, $sid, $zero)";
	$res = mysql_query($q);

	if($res == FALSE)
		echo mysql_error();

}

while ($row = mysql_fetch_assoc($res1))
{
	$up = ($row['R.CGPA']*$row['R.CGPA'])+($row['R.XII_PERC']*$row['S.XII_PERC']);
	$q =  "UPDATE stu_rating SET SRATING = $up
			WHERE ORG_ID = $row['ORGID']
			AND SID = $row['SID']";

	$res = mysql_query($q);

	if($res == FALSE)
		echo mysql_error();
}

?>