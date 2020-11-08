<?php

require_once('../../../autoload.php');
require_once('../../../commons/session.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

if(!isset($_POST['id'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/customer/', '잘못된 접근입니다.');
    exit;
}

$id=getDataByPost('id'); // customer_id
$prev_path=getDataByPost('prev_path');
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

    AlertMsgAndRedirectTo($prev_path, '고객정보가 삭제되었습니다.');
}catch (Exception $ex){
    $db->getDBINS()->rollBack();
    $db=null;

    error_log($ex);
    AlertMsgAndRedirectTo($prev_path, '고객정보 삭제에 실패하였습니다.');
}

exit;