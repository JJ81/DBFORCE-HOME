<?php

require_once('../../../autoload.php');
require_once('../../../commons/session.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'login.php', '로그인이 필요합니다.');
    exit;
}

// 비밀번호 수정 처리
if(empty($_POST['employee_id']) or empty($_POST['password']) or empty($_POST['re_password'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/employee/', '올바른 접근이 아닙니다.');
    exit;
}

$employee_id=getDataByPost('employee_id');
$password=getDataByPost('password');
$re_password=getDataByPost('re_password');


if(strlen($password) < 4){
    AlertMsgAndRedirectTo(ROOT . 'admin/employee/', '비밀번호 4자리 이상 입력해주세요.');
    exit;
}

if($password !== $re_password){
    AlertMsgAndRedirectTo(ROOT . 'admin/employee/', '비밀번호가 일치하지 않습니다.');
    exit;
}

$company_id=$_SESSION['company_id'];
$encrypted_passwd = password_hash($password, PASSWORD_DEFAULT);

use JCORP\Database\DBConnection as DBconn;
$db = new DBconn();

$update_query="update `platform_employee` set `password`='$encrypted_passwd' where `id`=$employee_id and `company_id`=$company_id;";

$result = $db->update($update_query);
$db=null;

AlertMsgAndRedirectTo(ROOT . 'admin/employee/', '비밀번호가 정상적으로 수정되었습니다.');

exit;