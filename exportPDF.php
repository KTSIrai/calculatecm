<?php 
include('dbconnect.php');
include('fpdf168/fpdf.php');


$pdf = new FPDF();

$id = $_GET['id'];
$cer ="SELECT * FROM land_info WHERE id='$id'";
$query_cer=mysqli_query($connect,$cer);
$re_cer=mysqli_fetch_assoc($query_cer);

$pdf->addpage('P');
$pdf->addfont('sa','','THSarabun.php');

$pdf->setXY(10,170);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','ปีการผลิต :     '.$re_cer['production_year']),0,1,'c');


$pdf->setXY(10,180);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','ไอดีแปลง :     '.$re_cer['plot_id']),0,1,'c');

$pdf->setXY(60,180);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','ชนิดอ้อย :     '.$re_cer['sugar_type']),0,1,'c');

$pdf->setXY(10,190);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','เลขสัญญา :    '.$re_cer['plcontract_number']),0,1,'c');

$pdf->setXY(60,190);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','ชื่อโคต้า :      '.$re_cer['quota_name']),0,1,'c');

$pdf->setXY(140,180);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','หน่วยส่งเสริม :    '.$re_cer['promotion_unit']),0,1,'c');

$pdf->setXY(140,190);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','เขต นสส.   :   '.$re_cer['promoter_area']),0,1,'c');

$pdf->setXY(10,200);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','ที่อยู่แปลง   หมู่  '.$re_cer['village']),0,1,'c');

$pdf->setXY(55,200);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','  ตำบล  '.$re_cer['district_sub']),0,1,'c');

$pdf->setXY(100,200);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','อำเภอ  '.$re_cer['district']),0,1,'c');

$pdf->setXY(140,200);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','จังหวัด  '.$re_cer['province']),0,1,'c');

$pdf->setXY(10,215);
$pdf->setfont('sa','',16);
$pdf->Cell(0,0,'',1,1,'c');

$pdf->setXY(35,220);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','เนื้อที่     '.$re_cer['square_meters']),0,1,'c');
$pdf->setXY(65,220);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','ตารางเมตร'),0,1,'c');

$pdf->setXY(35,230);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','เนื้อที่            '.$re_cer['rai']),0,1,'c');

$pdf->setXY(70,230);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','ไร่         '.$re_cer['ngan']),0,1,'c');

$pdf->setXY(95,230);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','งาน         '.$re_cer['wah']),0,1,'c');

$pdf->setXY(120,230);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874',' ตารางวา'),0,1,'c');

$pdf->setXY(35,240);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','เนื้อที่จ่ายเงินส่งเสริม         '.$re_cer['rai_adjusted']),0,1,'c');
$pdf->setXY(90  ,240);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874',' ไร่'),0,1,'c');


$pdf->setXY(12,255);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','ลงชื่อ..................................นสส.'),0,1,'c');
$pdf->setXY(11,265);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874',' (                                    )'),0,1,'c');

$pdf->setXY(72,255);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','ลงชื่อ..........................................หัวหน้าหน่วย'),0,1,'c');
$pdf->setXY(76,265);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874',' (                                         )'),0,1,'c');

$pdf->setXY(145,255);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874','ลงชื่อ....................................ผู้ตรวจ'),0,1,'c');
$pdf->setXY(145,265);
$pdf->setfont('sa','',16);
$pdf->Cell(0,10,iconv('utf-8','cp874',' (                                       )'),0,1,'c');

#กรอบรูป
$pdf->setXY(5,5);
$pdf->Cell(200,160,'',1,1,'c');

$pdf->setXY(88,5);
$pdf->setfont('sa','',18);
$pdf->Cell(0,10,iconv('utf-8','cp874','รายการคำนวนแผนที่'),0,1,'c');

#200m
$pdf->setXY(185,154);
$pdf->setfont('sa','',13);
$pdf->Cell(0,10,iconv('utf-8','cp874','200m'),0,1,'c');

$pdf->setXY(180,161);
$pdf->Cell(0,0,'',1,1,'c');

$pdf->setXY(182,158);
$pdf->setfont('sa','',12);
$pdf->Cell(0,10,iconv('utf-8','cp874','OVERZOOM'),0,1,'c');



$pdf->Output();


?>
