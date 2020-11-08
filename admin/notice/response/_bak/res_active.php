<?php
require_once('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

if(empty($_POST['id'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/notice/', '잘못된 접근입니다.');
    exit;
}

$id=getDataByPost('id');
$company_id=$_SESSION['company_id'];
use JCORP\Business\Notice\NoticeService as Notice;
$notice=new Notice();
$today=getToday('Y-m-d h:i:s');

$notice->activeNoticeById($id, $today, $company_id);

AlertMsgAndRedirectTo(ROOT. 'admin/notice/view.php?id='.$id, '비활성화되었습니다.');
exit;