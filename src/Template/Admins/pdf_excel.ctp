<!--- CODE FOR EXCEL --> 
<?php

if($export_in=='excel')
{
 	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=$file_name.xls");
	header("Content-Type: application/force-download");
	header("Cache-Control: post-check=0, pre-check=0", true);
	echo $export_data;
}
//<!--- CODE FOR PDF --> 
if($export_in=='pdf')
{
	$file_name=$application_no;
	App::import('Vendor','xtcpdf');  
	$tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'ISO-8859-1', false);
	$textfont = 'times'; // looks better, finer, and more condensed than 'dejavusans' 
	
	$tcpdf->SetAuthor("Dsu Menaria at http://phppoets.com"); 
	$tcpdf->SetAutoPageBreak( true ); 
	//$tcpdf->setHeaderFont(array($textfont,'',40)); 
	$tcpdf->xheadercolor = array(255,255,255); 
	$tcpdf->xheadertext = ''; 
	$tcpdf->xfootertext = '';
	$tcpdf->SetPrintHeader(false);
	$tcpdf->SetPrintFooter(false);
	// add a page (required with recent versions of tcpdf) 
	$tcpdf->AddPage(); 
	
	// Now you position and print your page content 
	// example:  
	$tcpdf->SetTextColor(0, 0, 0); 
	//$tcpdf->SetHeaderData('/flexiloans/img/flexi loan logo final.png', '30', ''.' ', PDF_HEADER_STRING);

	$tcpdf->SetFont('helvetica', '', 11, '', true);
	//$tcpdf->SetFont($textfont,12); 
	$tcpdf->SetLineWidth(0.1);	
	$tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	$tcpdf->writeHTML($export_data);
	ob_end_clean();
echo $tcpdf->Output($file_name.'.pdf', 'D'); 	
}

?>
<!--- END  OF CODE -->