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

use \JCORP\Business\VIP\VIPService as VIP;
$vip=new VIP();

$result=$vip->totalVIPAmount();

echo json_encode(array(
    'success' => true,
    'code' => 200,
    'result' =>$result
));

exit;