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

if(!isset($_POST['cs_id']) or !isset($_POST['cs_name']) or !isset($_POST['phone']) or !isset($_POST['created_dt'])){
    echo json_encode(array(
        'success' => false,
        'code' => 400,
        'msg' => 'Parameter is missing'
    ));
    exit;
}

$cs_id=getDataByPost('cs_id');
$cs_name=getDataByPost('cs_name');
$status_id=getDataByPost('status_id');
$created_dt=getDataByPost('created_dt');
$modified_dt=getToday('Y-m-d H:i:s');
$phone=getDataByPost('phone');
$admin_id=$_SESSION['user_id'];
$company_id=$_SESSION['company_id'];


use \JCORP\Business\Customer\CustomerService as Customer;
$customer=new Customer();
if(empty($status_id) or $status_id == 'null'){
    $status_id=NULL;
}

$result=$customer->modifyCustomerInfo($cs_id, $cs_name, $status_id, $modified_dt, $phone, $admin_id, $company_id, $created_dt);

echo json_encode(array(
    'success' => true,
    'code' => 200,
    'result' => $result
));
exit;

