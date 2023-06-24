<?php 


require('qpdf.php');

$subject        = $_POST['subject'];
$class          = $_POST['class'];
$room           = $_POST['room'];
$time           = $_POST['time'];
$date           = $_POST['date'];
$time           = $_POST['time'];


$pdf = new qpdf();
$pdf->AddPage();
$pdf->SetFont("Arial", "B", 8);


$pdf->Cell(190, 10, "Subject: " . $subject, 1, 1);
$pdf->Cell(190, 10, "Class: " . $class, 1, 1);
$pdf->Cell(190, 10, "Room: " . $room, 1, 1);
$pdf->Cell(190, 10, "Date: " . $date, 1, 1);
$pdf->Cell(190, 10, "Time: " . $time, 1, 1);

$pdf->Output();



?>