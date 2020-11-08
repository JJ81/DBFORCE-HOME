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

if(!isset($_GET['count'])){
    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => 'Parameter is missing'
    ));
    exit;
}

$count=getDataByGet('count');

error_log('$count');
error_log($count);

if(empty($count)){
    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => 'Data is missing'
    ));
    exit;
}

error_log('$count');
error_log($count);

use \JCORP\Business\VIP\VIPService as VIP;
$vip=new VIP();

$result_id=$vip->setTotalVIPAmount($count);

if(empty($result_id)){
    echo json_encode(array(
        'success' => false,
        'code' => 500
    ));
}else{
    echo json_encode(array(
        'success' => true,
        'code' => 200,
        'result' =>$result_id
    ));
}

exit;
