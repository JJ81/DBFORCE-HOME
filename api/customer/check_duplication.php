<?php
header('Content-type: application/json');
require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');

$user_id=getDataByPost('user_id');

if(empty($user_id)){
    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => '잘못된 접근입니다.'
    ));

    exit;
}

$user_id=addslashes($user_id);

error_log('$user_id');
error_log($user_id);

use \JCORP\Business\Customer\CustomerRegService as CustomerReg;
$customer=new CustomerReg();

$result=$customer->checkDuplicateUserId($user_id);

echo json_encode(array(
    'success' => true,
    'code' => 200,
    'result' => $result
));

exit;
