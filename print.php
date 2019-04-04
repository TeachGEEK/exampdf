<?php
include_once '../dbconnect.php';

session_start();

if(!$_SESSION['phone']){
    header('location: ../signin.php');
    exit;
}

$sql = "SELECT payment_done from cred where phone = '".$_SESSION['phone']."'"; //TODO from form data table
if($result=mysqli_query($conn,$sql)){
    if(mysqli_num_rows($result) > 0){
        while ($row=mysqli_fetch_row($result)){
            $paid = $row[0];
        }
    }  
}
if($paid == '0'){
    header('location: payment.php?msg=1');
    exit;
}
$name = '';
$gender = '';
$dob = '';
$age = '';
$fathersname = '';
$mothersname = '';
$address = '';
$city = '';
$pincode = '';
$phone = '';
$center = '';
$langsel = '';
$qualification = '';
$currentstudy = '';
$date = ''; 
$rollno= '';
$image_dir ='';
$sign_dir = '';
$sql = "SELECT * from form_data where phone = '".$_SESSION['phone']."'"; //TODO from form data table
if($result=mysqli_query($conn,$sql)){
    if(mysqli_num_rows($result) > 0){
        while ($row=mysqli_fetch_row($result))
        {
             $name = $row[0];
             $gender = $row[1];
             $dob = $row[2];
             $age = $row[3];
             $fathersname = $row[4];
             $mothersname = $row[5] ;
             $address = $row[6];
             $city = $row[7];
             $pincode = $row[8];
             $phone = $row[9];
             $center = $row[10];
             $langsel = $row[11];
             $qualification = $row[12];
             $currentstudy = $row[13];
             $date = $row[14];
             $image_dir = $row[16];
             $sign_dir =$row[17];
        }
      mysqli_free_result($result);
    }
}
$sql = "SELECT rollnumber from cred where phone = '".$_SESSION['phone']."'";
if($result=mysqli_query($conn,$sql)){
    if(mysqli_num_rows($result) > 0){
        while ($row=mysqli_fetch_row($result))
        {
             $rollno = $row[0];
        }
      mysqli_free_result($result);
    }
}

function printdata($data, $pdf){
    $pdf -> SetX(60);
    $pdf -> SetFont('Arial'); 
    $pdf -> Cell(20,20, $data); //width height
}

function printdatamulti($data, $pdf){
    $pdf -> SetY($pdf -> GetY()+7);
    $pdf -> SetX(60);
    $pdf -> SetFont('Arial'); 
    $pdf -> MultiCell(97,7, $data); //width height
    $pdf -> SetY($pdf -> GetY()-15);
}

function printdatamulti2($data, $pdf){
    $pdf -> SetY($pdf -> GetY()+7);
    $pdf -> SetX(60);
    $pdf -> SetFont('Arial'); 
    $pdf -> MultiCell(90,6, $data); //width height
    $pdf -> SetY($pdf -> GetY()-15);
}

function printdatamultikol($data, $pdf){
    $pdf -> SetY($pdf -> GetY()+7);
    $pdf -> SetX(60);
    $pdf -> SetFont('Arial','','7'); 
    $pdf -> MultiCell(90,6, $data); //width height
    $pdf -> SetY($pdf -> GetY()-15);
    $pdf -> SetFont('Arial','','10'); 
}

function printfield($data, $pdf){
    $pdf -> SetY($pdf -> GetY()+7);
    $pdf -> SetX(30);
    $pdf -> SetFont('Arial', 'B'); 
    $pdf -> Cell(20,20, $data,0,0,'R'); //width height
}

function lang($data){
    if($data == 'O'){
        return 'OLCHIKI';
    }else{
        return 'BENGALI';
    }
}

function printdeclaration($data, $pdf){
    $pdf -> SetY($pdf -> GetY()+15);
    $pdf -> SetX(10);
    $pdf -> MultiCell(190,5, $data); //width height
    // $pdf -> SetY($pdf -> GetY()-15);
}

function exam($data){
    if($data == 'BANON'){
        return 'BANKURA';
    }elseif ($data == 'RANION' ) {
        return 'RANIBANDH';
    }elseif ($data == 'SALON') {
        return 'SALTORA';
    }elseif ($data == 'SARON') {
        return 'SARENGA';
    }elseif ($data == 'PURON') {
        return 'PURULIA';
    }elseif ($data == 'KESON') {
        return 'KESIARY';
    }elseif ($data == 'RAON') {
        return 'RANIGANJ';
    }elseif ($data == 'MANON') {
        return 'MANBAZAR';
    }elseif ($data == 'MIDON') {
        return 'MIDNAPUR';
    }elseif ($data == 'KOLON') {
        return 'KOLKATA';
    }
}

function examaddr($data){
  if($data == 'BANON'){
        return 'LOKPUR HIGH SCHOOL, BANKURA TOWN';
    }elseif ($data == 'RANION' ) {
        return 'RANIBANDH HIGH SCHOOL, RANIBANDH, BANKURA';
    }elseif ($data == 'SALON') {
        return 'SALTORA DR. B. C. VIDYAPITH, SALTORA, BANKURA';
    }elseif ($data == 'SARON') {
        return 'SARENGA M. S. VIDYAPITH, SARENGA, BANKURA';
    }elseif ($data == 'PURON') {
        return 'CHITTARANJAN HIGH SCHOOL, PURULIA TOWN ';
    }elseif ($data == 'KESON') {
        return 'KESIARY HIGH SCHOOL, KESIARY, PASCHIM MIDNAPUR';
    }elseif ($data == 'RAON') {
        return 'SEARSOLE RAJ HIGH SCHOOL, RANIGANJ, PASCHIM BARDHAMAN';
    }elseif ($data == 'MANON') {
        return 'BISHRI ANCHALIK P.D.G.M. HIGH SCHOOL, MANBAZAR, PURULIA';
    }elseif ($data == 'MIDON') {
        return 'TANTIGERIA HIGH SCHOOL, NEAR MIDNAPUR RAILWAY STATION';
    }elseif ($data == 'KOLON') {
        return 'GOVT. SPONSORED MULTIPURPOSE SCHOOL BOYS TAKI HOUSE, 299B, ACHARYA PRAFULLA CHANDRA ROAD, KOLKATA 700009';
    }
}

if(isset($_SESSION['phone'])){   
    require 'fpdf181/fpdf.php';
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->Image('bgnew.jpg', 0, 0 , $pdf->GetPageWidth(), $pdf->GetPageHeight());
    include_once 'applicationxx.php';
    $pdf->SetLineWidth(0.5);
    $pdf->Line(10,185, 200, 185);
    include_once 'admitxx.php';
    $pdf->SetLineWidth(0.5);
    $pdf->Line(10,274, 200, 274);
    $pdf->SetY(276.5);
    $pdf->SetX(10);
    $pdf->Cell($pdf->GetPageWidth()-18,0,"HELPLINE : 8436770914, 7908996492 | Website: www.sarsaguntalentexam.in ",0,0,'C');
    $pdf->output("I","admitcard.pdf");
}else{
    header('location: https://sarsaguntalentexam.in');
}
?>

