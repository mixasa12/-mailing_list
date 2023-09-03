<?php
header('Access-Control-Allow-Origin: *');
define('FPDF_FONTPATH','fpdf/font/test/');
require("fpdf/fpdf.php");
require("FPDI-2.3.6/src/autoload.php");
require('fpdf/makefont/makefont.php');
require_once("connection.php");
ini_set('max_execution_time','3600');
use setasign\Fpdi\Fpdi; 
$fio="Бекетова Евгения Валерьевна";
$email="bandurinmm@gmail.com";
foreach($_POST as $key => $value) {
  if($key == "fio") {
    $fio = $value; 
  } 
  if($key == "email") {
    $email = $value; 
  }
};
$sql = "SELECT COUNT(*) AS iss FROM people WHERE fio='".$fio."' AND email='".$email."'";
//echo $sql;
$result = mysqli_query($connection, $sql);
$isss=0;
    while($row = mysqli_fetch_array($result)){
        $isss=$row["iss"];
    }
if($isss==0){
    $sql = "INSERT INTO people (fio, email) VALUES ('".$fio."','".$email."')";
    mysqli_query($connection,$sql);
}
$sql = "SELECT id FROM people WHERE fio='".$fio."' AND email='".$email."'";
//echo $sql;
$result = mysqli_query($connection, $sql);
$id=(-1);
    while($row = mysqli_fetch_array($result)){
        $id=$row["id"];
    }
$sql = "INSERT INTO sert (people_id, tip,dat) VALUES (".$id.",'neiro','".date("Y-m-d")."')";
echo $sql;
mysqli_query($connection,$sql);
$sql = "SELECT COUNT(*) AS ins FROM sert WHERE dat>'2022-12-31' AND dat<'2028-01-01' AND tip='neiro'";
//echo $sql;
$result = mysqli_query($connection, $sql);
$countn=0;
$countx=0;
    while($row1 = mysqli_fetch_array($result)){
        $countx=$row1["ins"];
    }
$sql1 = "SELECT COUNT(*) AS ins FROM sert WHERE dat>'2022-12-31' AND dat<'2028-01-01' AND tip='neiro' AND rez=1";
//echo $sql;
$result1 = mysqli_query($connection, $sql1);
    while($row = mysqli_fetch_array($result1)){
        $countx=$countx+$row["ins"];
    }
$countn= floor(log10($countx));
if($countn<2){
    for($i=$countn;$i<2;$i++){
        $countx="0".(string)$countx;
    }
} 
$countx=$countx.(string)(date("-Y"))  ;
$a=$fio;
$god="года";
$dat=date("d.m.Y");
$pdf = new FPDI(); 
$pdf->setSourceFile('template_1.pdf'); 
$tpl = $pdf->importPage(1); 
$pdf->addPage('L'); 
$pdf->AddFont('ArialMT','','arialmt.php');
$pdf->AddFont('ArialBOLD','','ArialBold.php');
$pdf->AddFont('franclin','','framd.php');
$fio = iconv('utf-8', 'windows-1251', $fio);
$god = iconv('utf-8', 'windows-1251', $god);
$pdf->useTemplate($tpl);
$pdf->SetFont('ArialBOLD', '', '30');
$pdf->MultiCell(290,137,$fio,0,'C');
$pdf->SetFont('ArialBOLD', '', '17');
$pdf->SetXY(185, 172);
$pdf->Write(0, $dat);
$pdf->SetXY(216.5,171.5);
$pdf->Write(0,$god);
$pdf->SetFont('ArialBOLD','','21');
$pdf->SetXY(147,46.5);
$pdf->Write(0,$countx);
$structure = 'sertificate/'.$a;
$i="";
if(is_dir($structure))
{   $i=2;
    $is=true;
    while($is){
    if(is_dir($structure.$i))
    {
        $i++;
    }
    else
    {
       $is=false; 
    }
    }
}
if (!mkdir($structure.$i, 0777, true)) {
    die('errorrr');
}
$pdf->output($structure.$i.'/Сертификат.pdf', 'F');
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';
$title = "Сертификат о прохождении интенсива «Инструктор по игровой нейрогимнастике»";
$body = 'Добрый день!<br>
Благодарю вас за участие в моем интенсиве! Ваш сертификат во вложении.<br><br>

С уважением и заботой, Евгения Бекетова';  
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};
    $mail->Host       = 'ssl://smtp.beget.com'; 
    $mail->Username   = 'akademia@cleverakademia.ru'; 
    $mail->Password   = 'Diana0105_'; 
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('akademia@cleverakademia.ru', 'Евгения Бекетова');
    $mail->addAddress($email);
    $mail->addAddress('output@cleverakademia.ru');
$mail->Subject = $title;
$mail->Body = $body;
$mail->isHTML(true);  // письмо обычным текстом, если клиент не поддерживает html
$mail->addAttachment($structure.$i.'/Сертификат.pdf');
if ($mail->send()) {echo "success";} 
else {echo $mail->ErrorInfo;}
} catch (Exception $e) {
    echo "error ";
    echo "Сообщение не было отправлено. Причина ошибки}";
}
?>