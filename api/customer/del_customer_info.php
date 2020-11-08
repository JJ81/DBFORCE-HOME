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

if(!isset($_POST['cs_id'])){
    echo json_encode(array(
        'success' => false,
        'code' => 400,
        'msg' => 'Parameter is missing'
    ));
    exit;
}

$id=getDataByPost('cs_id');
$admin_id=$_SESSION['user_id'];
$company_id=$_SESSION['company_id'];


use JCORP\Database\DBConnection as DBconn;
$db = new DBconn();

use \JCORP\Business\Customer\CustomerService as Customer;
$customer=new Customer();

use \JCORP\Business\Memo\MemoService as Memo;
$memo=new Memo();

try{
    $db->getDBINS()->beginTransaction();

    $delete_result=$memo->deleteMemoWithCustomerId($db, $id, $company_id);

    if(empty($delete_result)){
        error_log("Failed to delete memo " . $id);
        throw new Exception("Failed to delete memo " . $id);
    }

    $delete_result_customer=$customer->deleteCustomerInfo($db, $id, $company_id);

    if(empty($delete_result_customer)){
        error_log("Failed to delete customer " . $id);
        throw new Exception("Failed to delete customer " . $id);
    }

    $db->getDBINS()->commit();
    $db=null;

    echo json_encode(array(
        'success' => true,
        'code' => 200
    ));
    exit;


}catch (Exception $ex){
    $db->getDBINS()->rollBack();
    $db=null;

    error_log($ex->getMessage());

    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => $ex->getMessage()
    ));
    exit;
}

