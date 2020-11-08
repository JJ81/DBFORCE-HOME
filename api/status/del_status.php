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

if(!isset($_POST['status_id'])){
    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => 'Parameter is missing'
    ));
    exit;
}

$status_id=getDataByPost('status_id');

if(empty($status_id)){
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

$result=$customer->deleteList($status_id, $company_id);

error_log('[Alarm] delete status info');
error_log($result);

echo json_encode(array(
    'success' => true,
    'code' => 200,
    'result' =>$result
));

exit;
