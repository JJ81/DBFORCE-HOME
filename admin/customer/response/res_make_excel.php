<?php
require_once('../../../autoload.php');
require_once('../../../vendor/autoload.php');
require_once('../../../commons/session.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

if(!isset($_GET['start_dt']) or !isset($_GET['end_dt'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/customer/', '날짜 입력이 되지 않았습니다.');
    exit;
}

$start_dt=getDataByGet('start_dt');
$end_dt=getDataByGet('end_dt');

use JCORP\Database\DBConnection as DBConn;
$db=new DBConn();
$rows=$db->query("select * from `platform_customer` where `created_dt` between '$start_dt 00:00:00' and '$end_dt 23:59:59' order by `id` desc;");


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// set header
$sheet->setCellValue('A1', '등록일');
$sheet->setCellValue('B1', '이름');
$sheet->setCellValue('C1', '전화번호');

// bind data
for($i=0,$size=count($rows);$i<$size;$i++){

    $date=strval(setDate(trim($rows[$i]['created_dt'])));
    $name=strval(trim($rows[$i]['name']));
    $phone=strval(trim($rows[$i]['phone']));

    $index=$i+2;

    $sheet->setCellValue('A'.$index, $date);
    $sheet->setCellValue('B'.$index, $name);
    $sheet->setCellValue('C'.$index, $phone);

}

$today=getToday('Y-m-d');

header("Content-charset=utf-8");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="db_'.$today.'.xlsx"');

$writer = new Xlsx($spreadsheet);
$writer->save("php://output");