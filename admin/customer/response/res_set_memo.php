<?php

require_once('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo('login.php', '로그인이 필요합니다.');
    exit;
}

if(!isset($_POST['cs_id']) or !isset($_POST['memo'])){
    AlertMsgAndRedirectTo(ROOT,'잘못된 접근입니다.');
    exit;
}


$msg=getDataByPost('memo');
$admin_id=$_SESSION['user_id'];
$cs_id=getDataByPost('cs_id');
$company_id=$_SESSION['company_id'];
$prev_path=getDataByPost('prev_path');


// error_log($memo);

use \JCORP\Business\Memo\MemoService as Memo;
$memo=new Memo();

$result=$memo->setMemo($msg, $cs_id, $admin_id, $company_id);


if(!empty($result)){
    AlertMsgAndRedirectTo($prev_path,'메모가 추가되었습니다.');
}else{
    AlertMsgAndRedirectTo($prev_path,'메모가 추가가 취소되었습니다.');
}

exit;