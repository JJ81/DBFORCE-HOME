<?php
header('Content-type: application/json');
require_once ('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');

if(empty($_SESSION['user'])){
    echo json_encode(array(
        'success' => false,
        'code' => 401,
        'msg' => 'Need to login.'
    ));
    exit;
}

if(empty($_GET['employee_id'])){
    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => 'Parameter is missing'
    ));
    exit;
}

use JCORP\Database\DBConnection as DBconn;
$db = new DBconn();

$company_id=getCompanyId();
$employee_id=getDataByGet('employee_id');

$query="update `platform_employee` set `is_available`=false where `id`=$employee_id and `company_id`=$company_id;";
$result=$db->update($query);
$db=null;

if($result){
    echo json_encode(array(
        'success' => true,
        'code' => 200
    ));
}else{
    echo json_encode(array(
        'success' => false,
        'code' => 500
    ));
}


exit;