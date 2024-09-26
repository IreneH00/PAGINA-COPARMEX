<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

include 'conexion.php';  


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'INVENTARIO DE PRODUCTOS');


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
$sheet->setCellValue('B4', 'Nombre del producto');
$sheet->setCellValue('C4', 'Descripción');
$sheet->setCellValue('D4', 'Precio');
$sheet->setCellValue('E4', 'Unidades');


$headerStyleArray = [
    'font' => ['bold' => true],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFCCCCCC']],
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
];

$sheet->getStyle('A4:E4')->applyFromArray($headerStyleArray);


$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(25);
$sheet->getColumnDimension('C')->setWidth(40);
$sheet->getColumnDimension('D')->setWidth(10);
$sheet->getColumnDimension('E')->setWidth(10);


$query = "SELECT p.id, p.nombre, p.descripcion, p.cantidad_total, p.precio FROM productos p ORDER BY p.id DESC";
$result = $conex->query($query);


$rowNumber = 5; 
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $rowNumber, $row['id']);
    $sheet->setCellValue('B' . $rowNumber, $row['nombre']);
    $sheet->setCellValue('C' . $rowNumber, $row['descripcion']);
    $sheet->setCellValue('D' . $rowNumber, $row['precio']);
    $sheet->setCellValue('E' . $rowNumber, $row['cantidad_total']);
    
  
    $sheet->getStyle('D' . $rowNumber)->getNumberFormat()->setFormatCode('"$"#,##0.00');
    
    $rowNumber++;
}


$dataStyleArray = [
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
];
$sheet->getStyle('A4:E' . ($rowNumber - 1))->applyFromArray($dataStyleArray);


$sheet->getStyle('D5:E' . ($rowNumber - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


$filename = 'inventario.xlsx';


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
