<?php
require_once ('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo('login.php', '로그인이 필요합니다.');
    exit;
}

if($_SESSION['role'] !== '1'){
    AlertMsgAndRedirectTo(ROOT . 'index.php', '최고관리자만 접근할 수 있는 페이지입니다.');
    exit;
}

if(empty($_POST['val-account']) or empty($_POST['val-password'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/employee/create.php', '잘못된 접근입니다.');
    exit;
}

$username=getDataByPost('val-username');
$accountId=getDataByPost('val-account');
$password=getDataByPost('val-password');
$roleId=getDataByPost('val-role');
$teamId=null;
$phone=getDataByPost('val-phone');
$company_id=getCompanyId();

use JCORP\Business\Employee\EmployeeService as Employee;
$employee=new Employee();

$encrypted_passwd = password_hash($password, PASSWORD_DEFAULT);
$dup_result=$employee->checkDuplicated($accountId, $company_id);

if(count($dup_result) > 0){
    AlertMsgAndRedirectTo(ROOT . 'admin/employee/create.php', '이미 등록된 로그인계정입니다.');
    exit;
}

$insertedId=$employee->makeNewEmployee($username, $accountId, $encrypted_passwd, $roleId, $teamId, $phone, $company_id);

if($insertedId > 0){
    AlertMsgAndRedirectTo(ROOT . 'admin/employee/', '새로운 직원이 등록되었습니다.');
}else{
    AlertMsgAndRedirectTo(ROOT . 'admin/employee/', '새로운 직원 등록에 실패하였습니다.');
}

exit;