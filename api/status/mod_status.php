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

if(!isset($_POST['status_id']) or !isset($_POST['name'])){
    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => 'Parameter is missing'
    ));
    exit;
}

$status_id=getDataByPost('status_id');
$name=getDataByPost('name');
$desc=getDataByPost('desc');

if(empty($status_id) or empty($name)){
    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => 'Data is missing'
    ));
    exit;
}

$company_id=$_SESSION['company_id'];

use \JCORP\Business\Customer\CustomerStatusService as CustomerStatus;
$customer=new CustomerStatus();

$today=getToday('Y-m-d H:i:s');

if($desc === 'null'){
    $desc=null;
}

$result=$customer->modifyList($name, $desc, $company_id, $today, $status_id);

error_log($result);

echo json_encode(array(
    'success' => true,
    'code' => 200,
    'result' =>$result
));

exit;
