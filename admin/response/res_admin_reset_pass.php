<?php

require_once('../../autoload.php');
require_once('../../commons/session.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}


// 비밀번호 수정 처리

if(empty($_POST['password'])){
    AlertMsgAndRedirectTo(ROOT, '올바른 접근이 아닙니다.');
    exit;
}

$password=getDataByPost('password');
$re_password=getDataByPost('re_password');


if(strlen($password) < 4){
    AlertMsgAndRedirectTo(ROOT . 'admin/', '비밀번호 4자리 이상 입력해주세요.');
    exit;
}

if($password !== $re_password){
    AlertMsgAndRedirectTo(ROOT . 'admin/', '비밀번호가 일치하지 않습니다.');
    exit;
}

$company_id=$_SESSION['company_id'];
$encrypted_passwd = password_hash($password, PASSWORD_DEFAULT);

use JCORP\Database\DBConnection as DBconn;
$db = new DBconn();

$admin_id=$_SESSION['user_id'];
$update_query="update `platform_employee` set `password`='$encrypted_passwd' where `id`=$admin_id and `company_id`=$company_id;";

$result = $db->update($update_query);
$db=null;

AlertMsgAndRedirectTo(ROOT . 'admin/', '비밀번호가 정상적으로 수정되었습니다.');

exit;