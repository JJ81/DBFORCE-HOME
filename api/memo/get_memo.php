<?php
header('Content-type: application/json');
require_once('../../autoload.php');
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

if(!isset($_GET['customer_id'])){
    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => 'Parameter is missing'
    ));
    exit;
}

$company_id=$_SESSION['company_id'];
$customer_id=getDataByGet('customer_id');

use \JCORP\Business\Memo\MemoService as Memo;
$memo=new Memo();

$lists=$memo->getMemoByCustomerId($customer_id, $company_id);

echo json_encode(array(
    'success' => true,
    'code' => 200,
    'data' =>$lists
));

exit;
