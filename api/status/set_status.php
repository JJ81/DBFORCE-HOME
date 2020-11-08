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

if(!isset($_POST['name'])){
    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => 'Parameter is missing'
    ));
    exit;
}

$name=getDataByPost('name');
$desc=getDataByPost('desc');

if(empty($name)){
    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => 'Data is missing'
    ));
    exit;
}

$company_id=$_SESSION['company_id'];
$admin_id=$_SESSION['user_id'];

if($desc == "null"){
    $desc=NULL;
}

use \JCORP\Business\Customer\CustomerStatusService as CustomerStatus;
$customer=new CustomerStatus();

$inserted_id=$customer->setList($name, $desc, $admin_id, $company_id);

echo json_encode(array(
    'success' => true,
    'code' => 200,
    'result' =>$inserted_id
));

exit;
