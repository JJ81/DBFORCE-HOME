<?php
header('Content-type: application/json');
require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');

// API
if(empty($_SESSION['user'])){
    echo json_encode(array(
        'success' => false,
        'code' => 401,
        'msg' => '로그인이 필요합니다.'
    ));
    exit;
}

// 검색 조건
$name=null;
$phone=null;
$status=null;
$memo=null;
$reg_start_dt=null; // 등록일 시작일 기간검색
$reg_end_dt=null; // 등록일 종료일 기간검색
$mod_start_dt=null; // 수정일 시작일
$mod_end_dt=null; // 수정일 종료일

$name=getDataByGet('name');
$phone=getDataByGet('phone');
$status=getDataByGet('status');
$memo=getDataByGet('memo');
$reg_start_dt=getDataByGet('rsd');
$reg_end_dt=getDataByGet('red');
$mod_start_dt=getDataByGet('msd');
$mod_end_dt=getDataByGet('med');

//if(!isset($_GET['name'])){
//    $name=getDataByGet('name');
//}
//
//if(!isset($_GET['phone'])){
//    $phone=getDataByGet('phone');
//}
//
//if(!isset($_GET['status'])){
//    $status=getDataByGet('status');
//}
//
//if(!isset($_GET['memo'])){
//    $memo=getDataByGet('memo');
//}
//
//if(!isset($_GET['rsd'])){
//    $reg_start_dt=getDataByGet('rsd');
//}
//
//if(!isset($_GET['red'])){
//    $reg_end_dt=getDataByGet('red');
//}
//
//if(!isset($_GET['msd'])){
//    $mod_start_dt=getDataByGet('msd');
//}
//
//if(!isset($_GET['med'])){
//    $mod_end_dt=getDataByGet('med');
//}

if(empty($_GET['size'])){
    $size=20;
}else{
    $size=getDataByGet('size');
}

if(empty($_GET['page'])){
    $page=1;
}else{
    $page=getDataByGet('page');
}

//error_log($name);

$current=$page;
$next=null;
$prev=null;

$company_id=$_SESSION['company_id'];
$customer_id=getDataByGet('customer_id');

use \JCORP\Business\Customer\CustomerService as Customer;
$customer=new Customer();

$total=$customer->getCustomerListCount($name, $phone, $status, $memo, $reg_start_dt, $reg_end_dt, $mod_start_dt, $mod_end_dt, $company_id);
$total_count = $total[0]['total'];
$total_page=ceil($total_count/$size);
$offset=($page-1)*$size;

if($current < $total_page){
    $next = $current+1;
} else {
    $next=$current;
}

if($current > 1){
    $prev = $current-1;
}else{
    $prev=$current;
}

$lists=$customer->getCustomerList($offset, $size, $name, $phone, $status, $memo, $reg_start_dt, $reg_end_dt, $mod_start_dt, $mod_end_dt, $company_id);

echo json_encode(array(
    'success' => true,
    'code' => 200,
    'lists' =>$lists
));

exit;
