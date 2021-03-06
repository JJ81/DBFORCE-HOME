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

if(!isset($_GET['id'])){
    echo json_encode(array(
        'success' => false,
        'code' => 500
    ));
    exit;
}

$id=getDataByGet('id');

use \JCORP\Business\Customer\CustomerService as Customer;
$customer=new Customer();

$info=$customer->getDeviceInfo($id);

echo json_encode(array(
    'success' => true,
    'code' => 200,
    'info' =>$info
));

exit;
