<?php
require_once('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');


if(empty($_POST['user']) or empty($_POST['pass'])){
    Redirect(ROOT . 'admin/login.php');
    exit;
}

$name = getDataByPost('user');
$password = getDataByPost('pass');

use JCORP\Database\DBConnection as DBconn;
$db = new DBconn();


$query = "select * from `platform_employee` where `login_id`='$name' limit 0,1;";
$row=$db->query($query);

if(count($row) == 0){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '등록되지 않은 정보입니다.');
    exit;
}else{
    if(!password_verify($password, $row[0]['password'])){
        AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '비밀번호가 맞지 않습니다.');
        exit;
    }else{

        if($row[0]['is_available'] == "0"){
            AlertMsgAndRedirectTo(ROOT . 'admin/login.php',  "삭제된 계정입니다.");
            exit;
        }

        $_SESSION['user_id'] = $row[0]['id'];
        $_SESSION['user'] = $row[0]['name'];
        $_SESSION['company_id'] = $row[0]['company_id'];
        $_SESSION['role'] = $row[0]['role_id'];
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + SESS_DURATION;

        AlertMsgAndRedirectTo(ROOT . 'admin/member/',  $_SESSION['user'] . "님, 환영합니다!");
    }
}