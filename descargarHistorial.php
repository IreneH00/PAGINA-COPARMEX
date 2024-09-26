<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;

include 'conexion.php';  


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


$sheet->setCellValue('A1', 'HISTORIAL DE TRANSACCIONES DE PRODUCTOS');


$sheet->mergeCells('A1:E1');


$titleStyleArray = [
    'font' => ['bold' => true, 'size' => 14],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
];
$sheet->getStyle('A1')->applyFromArray($titleStyleArray);


$date = date('Y-m-d H:i:s');  
$sheet->setCellValue('A2', 'Fecha de generación: ' . $date);


$sheet->mergeCells('A2:E2');


$sheet->getStyle('A2')->getFont()->setItalic(true);
$sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


$sheet->setCellValue('A4', 'ID');
$sheet->setCellValue('B4', 'Fecha');
$sheet->setCellValue('C4', 'Producto');
$sheet->setCellValue('D4', 'Cantidad');
$sheet->setCellValue('E4', 'Motivo');


$headerStyleArray = [
    'font' => ['bold' => true],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFCCCCCC']],
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
];

$sheet->getStyle('A4:E4')->applyFromArray($headerStyleArray);


$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getColumnDimension('C')->setWidth(20);
$sheet->getColumnDimension('D')->setWidth(10);
$sheet->getColumnDimension('E')->setWidth(30);

$query = "SELECT h.id, h.fecha, p.nombre AS producto, h.cantidad, h.motivo, h.tipo_movimiento
          FROM historial h
          JOIN productos p ON h.id_producto = p.id
          ORDER BY h.fecha DESC";
$result = $conex->query($query);


$rowNumber = 5; 
while ($row = $result->fetch_assoc()) {
   
    if ($row['tipo_movimiento'] === 'retirar') {
        $signo = '-';
    } else {
        $signo = '+';
    }
    
   
    $sheet->setCellValue('A' . $rowNumber, $row['id']);
    $sheet->setCellValue('B' . $rowNumber, $row['fecha']);
    $sheet->setCellValue('C' . $rowNumber, $row['producto']);
    $sheet->setCellValue('D' . $rowNumber, $signo . $row['cantidad']);
    $sheet->setCellValue('E' . $rowNumber, $row['motivo']);
    $rowNumber++;
}

$dataStyleArray = [
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
];
$sheet->getStyle('A4:E' . ($rowNumber - 1))->applyFromArray($dataStyleArray);


$sheet->getStyle('D5:D' . ($rowNumber - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$filename = 'historial.xlsx';


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');


$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

