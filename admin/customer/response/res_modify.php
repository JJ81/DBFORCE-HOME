<?php

require_once('../../../autoload.php');
require_once('../../../commons/session.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

if(!isset($_POST['id']) or !isset($_POST['name']) or !isset($_POST['phone'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/customer/', '잘못된 접근입니다.');
    exit;
}

$id=getDataByPost('id');
$name=getDataByPost('name');
$phone=getDataByPost('phone');
$status=getDataByPost('status');
$created_dt=getDataByPost('created_dt');
$company_id=$_SESSION['company_id'];
$admin_id=$_SESSION['user_id'];
$today=getToday('Y-m-d H:i:s');

use \JCORP\Business\Customer\CustomerService as Customer;
$customer=new Customer();

if(empty($status) or $status == 'null'){
    $status=NULL;
}

//error_log('status');
//error_log($status);


$result=$customer->modifyCustomerInfo($id, $name, $status, $created_dt, $today, $phone, $admin_id, $company_id);

if(empty($result)){
    AlertMsgAndRedirectTo(ROOT . 'admin/customer/', '고객정보가 수정되지 않았습니다. 잠시 후에 다시 시도해 주세요.');
}else{
    AlertMsgAndRedirectTo(ROOT . 'admin/customer/', '고객정보가 수정되었습니다.');
}

exit;