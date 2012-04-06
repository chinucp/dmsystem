<?php

class Zend_View_Helper_DrawLineGraph extends Zend_View_Helper_Abstract
{ 
    
    public function drawLineGraph($fileName,$datax,$datay,$titleArr,$sizeArr = array(800,600)){
    	
		Zend_Registry::set('jpgraph',new DMS_Jpgraph_Jpgraph());
		
		if(empty($sizeArr[0])) $sizeArr[0]=800;
		if(empty($sizeArr[1])) $sizeArr[1]=600;
		$jpgraph = new Graph($sizeArr[0],$sizeArr[1]);
		$jpgraph->img->SetMargin(55,10,45,75);
		$jpgraph->SetBox(true);
		
		$jpgraph->img->SetAntiAliasing("white");
		$jpgraph->SetScale("textlin"); 
		
		// Use built in font
		$jpgraph->title->SetFont(FF_FONT1,FS_BOLD);
				
		//create lines
		foreach($datay as $datayKey=>$datayVal){ 
			$line = new LinePlot($datayVal[1]);
			$line->mark->SetType(MARK_FILLEDCIRCLE);
			$line->mark->SetFillColor($datayVal[0]);
			$line->mark->SetWidth(5);
			$line->SetColor($datayVal[0]);
			$line->SetCenter();
			$line->SetLegend($datayKey);
			$jpgraph->Add($line); 
		} 
		
		// Output line
		$jpgraph->xaxis->SetTickLabels($datax); 
		$jpgraph->legend->SetMarkAbsSize(6);
		
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