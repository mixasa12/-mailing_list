<html>
    <head>
        <meta charset="utf-8">
    </head>
</html>
<?php
header('Access-Control-Allow-Origin: *');
define('FPDF_FONTPATH','fpdf/font/test/');
require("fpdf/fpdf.php");
require("FPDI-2.3.6/src/autoload.php");
require('fpdf/makefont/makefont.php');
require_once("connection.php");
ini_set('max_execution_time','3600');
use setasign\Fpdi\Fpdi; 
$fi="Иванов Иван Иванович";
$email="bandurinmm@gmail.com";
$s="SELECT * FROM answer";
$answer=[];
$r=mysqli_query($connection, $s);
while($row = mysqli_fetch_array($r)){
        $answer[$row['number']]=$row['answer'];
    }
$rigth=0;
$test="";
$open_q1="";
$open_q2="";
$open_q3="";
$open_q4="";
foreach($_POST as $key => $value) {
$i=1;
  if($key == "task1") {
    $fi1 = $value;
    if($answer[1]==mb_substr($fi1,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
    if($key == "task2") {
    $fi2 = $value;
    if($answer[2]==mb_substr($fi2,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
    if($key == "task3") {
    $fi3 = $value;
    if($answer[3]==mb_substr($fi3,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
    if($key == "task4") {
    $fi4 = $value;
    if($answer[4]==mb_substr($fi4,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
    if($key == "task5") {
    $fi5 = $value;
    if($answer[5]==mb_substr($fi5,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
    if($key == "task6") {
    $fi6 = $value;
    if($answer[6]==mb_substr($fi6,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
    if($key == "task7") {
    $fi7 = $value;
    if($answer[7]==mb_substr($fi7,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
    if($key == "task8") {
    $fi8 = $value;
    if($answer[8]==mb_substr($fi8,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
    if($key == "task9") {
    $fi9 = $value;
    if($answer[9]==mb_substr($fi9,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  }   if($key == "task10") {
    $fi10 = $value;
    if($answer[10]==mb_substr($fi10,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
    if($key == "task11") {
    $fi11 = $value;
    if($answer[11]==mb_substr($fi11,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
    if($key == "task12") {
    $fi12 = $value;
    if($answer[12]==mb_substr($fi12,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
    if($key == "task13") {
    $fi13 = $value;
    if($answer[13]==mb_substr($fi13,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
    if($key == "task14") {
    $fi14 = $value;
    if($answer[14]==mb_substr($fi14,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
    if($key == "task15") {
    $fi15 = $value;
        if($answer[15]==mb_substr($fi15,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
    if($key == "task16") {
    $fi16 = $value;
        if($answer[16]==mb_substr($fi16,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
    if($key == "task17") {
    $fi17 = $value;
        if($answer[17]==mb_substr($fi17,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
    if($key == "task18") {
    $fi18 = $value;
        if($answer[18]==mb_substr($fi18,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
      if($key == "task19") {
    $fi19 = $value;
        if($answer[19]==mb_substr($fi19,0,1)){
        $test=$test."y";
        $rigth++;
    }
    $i++;
  } 
  if($key == "email") {
    $email = $value; 
  }
    if($key == "fio") {
    $fi = $value; 
  }
    if($key == "open_q1") {
    $open_q1 = $value; 
  }
      if($key == "open_q2") {
    $open_q2 = $value; 
  }
      if($key == "open_q3") {
    $open_q3 = $value; 
  }
      if($key == "open_q4") {
    $open_q4 = $value; 
  }
};
$query="SELECT COUNT(*) AS co FROM people WHERE fio='".$fi."' AND email='".$email."'";
$rez=mysqli_query($connection,$query);
$iss=0;
while($row = mysqli_fetch_array($rez)){
    $iss=$row["co"];
}
echo $iss;
if($iss==0){
   $query1="INSERT INTO `people`(`fio`, `email`) VALUES ('".$fi."','".$email."')";
    mysqli_query($connection,$query1);
}
$query2="SELECT id FROM people WHERE fio='".$fi."' AND email='".$email."'";
$rez2=mysqli_query($connection,$query2);
$id=0;
while($row2 = mysqli_fetch_array($rez2)){
    $id=$row2["id"];
}
$dat=date("Y-m-d");
$r2=$rigth/19;
$r_is=0;
if($r2>0.7){
    $r_is=1;
}
$query3="INSERT INTO `sert`(`people_id`, `tip`, `dat`, `rez`, `r_count`, `open_q1`, `open_q2`, `open_q3`, `open_q4`) VALUES (".$id.",'neiro_rez','".$dat."',".$r_is.",".$r2.",'".$open_q1."','".$open_q2."','".$open_q3."','".$open_q4."')";
mysqli_query($connection,$query3);
$sql = "SELECT COUNT(*) AS ins FROM sert WHERE dat>'2022-12-31' AND dat<'2024-01-01' AND tip='neiro'";
//echo $sql;
$result = mysqli_query($connection, $sql);
$countn=0;
$countx=0;
    while($row = mysqli_fetch_array($result)){
        $countx=$row["ins"];
    }
$sql1 = "SELECT COUNT(*) AS ins FROM sert WHERE dat>'2022-12-31' AND dat<'2024-01-01' AND tip='neiro_rez' AND rez=1";
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
$countx=$countx.(string)(date("-Y"));
$dat=date("d.m.Y");
$god="года";
$pdf = new FPDI(); 
$pdf->setSourceFile('template_1.pdf'); 
$tpl = $pdf->importPage(1); 
$pdf->addPage('L'); 
$pdf->AddFont('ArialMT','','arialmt.php');
$pdf->AddFont('ArialBOLD','','ArialBold.php');
$pdf->AddFont('franclin','','franklingothic_demi.php');
$god = iconv('utf-8', 'windows-1251', $god);
$test = iconv('utf-8', 'windows-1251', $test);
$fi = iconv('utf-8', 'windows-1251', $fi);
$pdf->useTemplate($tpl);
$pdf->SetFont('franclin', '', '30');
$pdf->MultiCell(284,142,$fi,0,'C');
$pdf->SetFont('franclin', '', '17');
$pdf->SetXY(182, 171);
$pdf->Write(0, $dat);
$pdf->SetXY(216, 171);
$pdf->Write(0, $god);
$pdf->SetFont('franclin', '', '21');
$pdf->SetXY(148, 46.5);
$pdf->Write(0, $countx);
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
if($rigth/19>0.7)
{
$title = "Результаты тестирования";
$body = 'Добрый день!<br>
Вы успешно прошли тестирование для получения сертификата "Инструктор игровой нейрогимнастики".<br><br>

Поздравляю вас!<br>
Сертификат вы можете увидеть во вложении к письму.<br><br>

Интересных вам занятий по методике!<br><br>

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
}}
else{
$title = "Результаты тестирования";
$body = 'Здравствуйте!<br>
К сожалению, вы не набрали достаточного количества баллов для получения сертификата.<br><br>

Попробуйте пройти тест снова по этой ссылке - <a href="https://clever-akademia.ru/instruktor_testfev">https://clever-akademia.ru/instruktor_testfev</a><br><br>

С уважением, Евгения Бекетова';  
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
//$mail->addAttachment($structure.$i.'/Сертификат.pdf');
if ($mail->send()) {echo "success";} 
else {echo $mail->ErrorInfo;}
} catch (Exception $e) {
    echo "error ";
    echo "Сообщение не было отправлено. Причина ошибки}";
}   
}
?>