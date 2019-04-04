<?php 

    $pdf->Image($image_dir, 160, 53, 30, 35); //x then y, width then height
    $pdf->SetY(40);
    $pdf->SetX(155);
    $pdf->SetFont('Arial', 'B', '10'); 
    $pdf->Cell(20,20, "Roll. No. ".$rollno); //width height
    $pdf->SetY(29);
    $pdf->SetX(150);
    $pdf->SetFont('Arial','U');
    $pdf->Cell(20,20,"Date Submitted :".$date);
    $pdf->SetY(30);

    printfield("Candidate Name : ", $pdf);
    printdata($name, $pdf);

    printfield("Gender : ", $pdf);
    if($gender == 'M'){
        printdata("MALE", $pdf);
    }else{
        printdata("FEMALE", $pdf);
    }

    printfield("Date of Birth(Age) : ", $pdf);
    printdata($dob.' ('.$age.')', $pdf);

    printfield("Father's Name : ", $pdf);
    printdata($fathersname, $pdf);

    printfield("Mother's Name : ", $pdf);
    printdata($mothersname, $pdf);

    printfield("Address : ", $pdf);
    printdatamulti($address, $pdf);

    printfield("City : ", $pdf);
    printdata($city, $pdf);

    printfield("Pincode : ", $pdf);
    printdata($pincode, $pdf);

    printfield("Phone Number : ", $pdf);
    printdata($phone, $pdf);

    printfield("Center Name : ", $pdf);
    printdata(exam($center), $pdf);

    printfield("Script Option : ", $pdf);
    printdata(lang($langsel), $pdf);

    printfield("Qualification : ", $pdf);
    printdatamulti($qualification, $pdf);

    printfield("Last Studied : ", $pdf);
    printdatamulti($currentstudy, $pdf);

    printdeclaration("I hereby declare that all the particulars state in application form are true and correct to the best of my knowledge and belief. I have read and understood to SSSTSE Rules and Regulations. I shall abide the Terms and Conditions.", $pdf);
    $pdf->Image($sign_dir, 135, $pdf->GetY(), 60, 20); //x then y, width then height
 ?>