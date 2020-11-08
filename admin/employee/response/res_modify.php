<?php
require_once ('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');
define('PAGE','EMPLOYEE');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo('login.php', '로그인이 필요합니다.');
    exit;
}

if($_SESSION['role'] !== '1'){
    AlertMsgAndRedirectTo(ROOT . 'index.php', '최고관리자만 접근할 수 있는 페이지입니다.');
    exit;
}

//error_log( $_POST['employee_id'] );
//error_log( $_POST['val-account'] );
//
//// exit;

if(empty($_POST['employee_id']) or empty($_POST['val-account'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/employee/', '잘못된 접근입니다.');
    exit;
}

$employee_id=getDataByPost('employee_id');
$username=getDataByPost('val-username');
$accountId=getDataByPost('val-account');
$roleId=getDataByPost('val-role');
$teamId=null;
$phone=getDataByPost('val-phone');

//error_log('team id');
//error_log($teamId);

use JCORP\Database\DBConnection as DBconn;
$db = new DBconn();

use JCORP\Business\Employee\EmployeeService as Employee;
$employee=new Employee();

$current_info_query="select * from `platform_employee` where `id`=$employee_id limit 0,1;";
$current_info=$db->query($current_info_query);

if($accountId !== $current_info[0]['login_id']){
    // 로그인 계정 중복 검사 진행할 것.
    // 현재 사용하고 있는 계정을 그대로 업데이트 할 경우는 중복 검사 안함.
    $dup_query="select * from `platform_employee` where `login_id`='$accountId';";
    $dup_result=$db->query($dup_query);

    if(count($dup_result) > 0){
        AlertMsgAndRedirectTo(ROOT . 'admin/employee/modify.php?employee_id='.$employee_id, '이미 등록된 로그인계정입니다.');
        exit;
    }
}

$result=$employee->updateEmployeeInfo($username, $accountId, $roleId, $teamId, $phone, $employee_id);

if($result){
    AlertMsgAndRedirectTo(ROOT . 'admin/employee/modify.php?employee_id='.$employee_id, '직원정보가 수정되었습니다.');
}else{
    AlertMsgAndRedirectTo(ROOT . 'admin/employee/modify.php?employee_id='.$employee_id, '직원정보수정에 실패하였거나 수정없이 저장하였습니다.');
}

$db=null;