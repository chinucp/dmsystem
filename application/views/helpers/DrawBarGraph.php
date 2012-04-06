<?php

class Zend_View_Helper_DrawBarGraph extends Zend_View_Helper_Abstract
{ 
    
    public function drawBarGraph($fileName,$datax,$datay,$titleArr,$sizeArr = array(400,400)){
    	
		Zend_Registry::set('jpgraph',new DMS_Jpgraph_Jpgraph()); 
		
		// Setup the graph.
		if(empty($sizeArr[0])) $sizeArr[0]=400;
		if(empty($sizeArr[1])) $sizeArr[1]=400;
		$jpgraph = new Graph($sizeArr[0],$sizeArr[1]);
		$jpgraph->img->SetMargin(55,10,45,75);
		$jpgraph->SetScale("textlin");
				
		// Setup font for axis
		$jpgraph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,10);
		$jpgraph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,10);
		
		// Show 0 label on Y-axis (default is not to show)
		$jpgraph->yscale->ticks->SupressZeroLabel(false);
		
		// Setup X-axis labels
		$jpgraph->xaxis->SetTickLabels($datax);
		// $graph->xaxis->SetLabelAngle(50);
		
		// Create the bar pot
		$bplot = new BarPlot($datay);
		$bplot->SetWidth(0.6);
		
		// Setup color for gradient fill style
		//$bplot->SetFillGradient("navy:0.9","navy:1.85",GRAD_LEFT_REFLECTION);
		
		// Set color for the frame of each bar
		$bplot->SetColor("white");
		//$bplot->SetLegend('Projects'); 
		$jpgraph->Add($bplot);
		
		$jpgraph->yaxis->SetTitleMargin(40);
		$jpgraph->xaxis->SetTitleMargin(30); 
		if(!empty($titleArr['x'])) $jpgraph->xaxis->title->Set($titleArr['x']);
		if(!empty($titleArr['y'])) $jpgraph->yaxis->title->Set($titleArr['y']);
		
		$title = $titleArr['m'];
		$title = mb_convert_encoding($title,'UTF-8');
		$jpgraph->title->Set($title);
				
		// Return the graph	 
		$gdImgHandler = $jpgraph->Stroke(_IMG_HANDLER);
		if(empty($fileName)) $fileName="tmpImg";
		$fileName = $fileName.".png";
		$image = GRAPH_PATH.'\\'.$fileName;// Default is PNG so use ".png" as suffix

		$jpgraph->img->Stream($image);
		return $fileName; 
    }
    
    
}