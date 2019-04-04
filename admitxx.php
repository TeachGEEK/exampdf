<?php 
    $pdf -> SetY(180); 
    $pdf -> SetX(30);
    $pdf -> SetFont('Helvetica','B','15');
    $pdf -> Cell(20,20, "SAR SAGUN SANTALI TALENT SEARCH EXAMINATION 2018");
	$pdf -> SetFont('Arial', 'BU', '10');
	$pdf -> SetY(195); 
	$pdf -> SetX(95);
	$pdf -> Cell(20,0, "ADMIT CARD",0,0,'C'); 
	$pdf -> SetY(195);
	$pdf -> SetX(150);
	$pdf -> SetFont('Arial', 'B', '10');
	$pdf -> Cell(20,20, "Roll. No. ".$rollno);
	$pdf -> Image($image_dir, 155, 210, 30, 35); //x y
	$pdf -> SetY(183); 
	printfield("Candidate Name : ", $pdf);
    printdata($name, $pdf);

   	printfield("Father's Name : ", $pdf);
    printdata($fathersname, $pdf);

    printfield("Date of Birth : ", $pdf);
    printdata($dob, $pdf);

    printfield("Script Option : ", $pdf);
    printdata(lang($langsel), $pdf);

    printfield("Center Name : ", $pdf);
    printdata(exam($center), $pdf);

    printfield("Center Address : ", $pdf);
    if($center == 'KOLON'){
        printdatamultikol(examaddr($center), $pdf);
    }else{
        printdatamulti2(examaddr($center), $pdf);
    }

    printfield("Examination Date : ", $pdf);
    printdatamulti2('30 SEPTEMBER, 2018', $pdf);

    $pdf->Line(30, 265, 80, 265);
    $pdf->Line(130, 265, 180, 265);
    $pdf->Image('signature_director.png', 133, 250, 40, 20);
    $pdf->SetY(250);
    $pdf->SetX(20);
    $pdf->Cell(70,20,"",1,0,'C');
    $pdf->SetX(120);
    $pdf->Cell(70,20,"",1,0,'C');
    $pdf->SetY(265);
    $pdf->SetX(53);
    $pdf->Cell(5,5,"Signature of Candidate",0,0,'C');
    $pdf->SetX(155);
    $pdf->Cell(5,5,"Director of Examination",0,0,'C');
 ?>