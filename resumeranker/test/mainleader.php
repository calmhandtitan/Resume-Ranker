<?php   

 /* CAT:Bar Chart */

 /* pChart library inclusions */
 include("./library/class/pData.class.php");
 include("./library/class/pDraw.class.php");
 include("./library/class/pImage.class.php");

 include '../connect.inc.php';

 session_start();
$orgid = $_SESSION['ORG_ID'];

 $qry = "SELECT NAME,o_rating as r_rating,org_name  
 		FROM student,org_rating ORT, organisation ORG
 		WHERE student.SID = ORT.SID 
 		AND ORT.org_id = $orgid
 		AND ORT.org_id = ORG.org_id";

 $result = mysql_query($qry);
// if($result == FALSE)
// 	echo mysql_error();
 //echo $result;
$count = 0;
 $Student_names = array();
 $ratings = array();
 $onami = "";
while( ($row = mysql_fetch_assoc($result)) )
{
	$onami = $row['org_name'];
	$Student_names[$count] = $row['NAME'];
	$ratings[$count++]  = $row['r_rating'];

}


 //$Student_names = array("lokendra","chandan","vandan","manthan","london","ghantan");
 
 /* Create and populate the pData object */
 $MyData = new pData();  
 
 
 
 $MyData->addPoints($ratings,$onami);
 
 
 $MyData->setAxisName(0,"Rating");
 $MyData->addPoints($Student_names,"Students");

 $MyData->setAbscissa("Students");

 /* Create the pChart object */
 $myPicture = new pImage(1200,470,$MyData);

 /* Turn of Antialiasing */
 $myPicture->Antialias = FALSE;

 /* Add a border to the picture */
 //$myPicture->drawRectangle(0,0,800,500,array("R"=>0,"G"=>0,"B"=>0));

 /* Set the default font */
 $myPicture->setFontProperties(array("FontName"=>"./library/fonts/pf_arma_five.ttf","FontSize"=>10));

 /* Define the chart area */
 $myPicture->setGraphArea(60,0,1000,400);

 /* Draw the scale */
 $scaleSettings = array("GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
 $myPicture->drawScale($scaleSettings);

 /* Write the chart legend */
 $myPicture->drawLegend(580,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

 /* Turn on shadow computing */ 
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

 /* Draw the chart */
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
 $settings = array("Gradient"=>TRUE,"GradientMode"=>GRADIENT_EFFECT_CAN,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
 $myPicture->drawBarChart();

 /* Render the picture (choose the best way) */
 $myPicture->autoOutput("example.drawBarChart.simple.png");
?>