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

if(!isset($_POST['cs_id']) or !isset($_POST['memo'])){
    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => 'Parameter is missing'
    ));
    exit;
}

$customer_id=getDataByPost('cs_id');
$msg=getDataByPost('memo');

if(empty($customer_id) or empty($msg)){
    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => 'Data is missing'
    ));
    exit;
}

$company_id=$_SESSION['company_id'];
$admin_id=$_SESSION['user_id'];


use \JCORP\Business\Memo\MemoService as Memo;
$memo=new Memo();

$inserted_id=$memo->setMemo($msg, $customer_id, $admin_id, $company_id);

echo json_encode(array(
    'success' => true,
    'code' => 200,
    'result' =>$inserted_id
));

exit;
