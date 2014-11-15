<?php   
 /* CAT:Bar Chart */

 /* pChart library inclusions */
 include("./library/class/pData.class.php");
 include("./library/class/pDraw.class.php");
 include("./library/class/pImage.class.php");

 $Student_names = array("lokendra","chandan","vandan","manthan","london","ghantan");
 $Company = array(
			array("IBM" , array(150,220,300,250,420,200))  , 
			array("Microsoft"  , array(223,223,125,122,125,756)),
			array("Amazon" , array(10,101,200,10,11,111))
			);
 
 /* Create and populate the pData object */
 $MyData = new pData();  
 
 
 for( $i=0; $i< sizeof($Company); $i++){
 $MyData->addPoints($Company[$i][1],$Company[$i][0]);
 }
 
 $MyData->setAxisName(0,"Rating");
 $MyData->addPoints($Student_names,"Students");

 $MyData->setAbscissa("Students");

 /* Create the pChart object */
 $myPicture = new pImage(800,230,$MyData);

 /* Turn of Antialiasing */
 $myPicture->Antialias = FALSE;

 /* Add a border to the picture */
 $myPicture->drawRectangle(0,0,800,230,array("R"=>0,"G"=>0,"B"=>0));

 /* Set the default font */
 $myPicture->setFontProperties(array("FontName"=>"./library/fonts/pf_arma_five.ttf","FontSize"=>6));

 /* Define the chart area */
 $myPicture->setGraphArea(60,40,650,200);

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