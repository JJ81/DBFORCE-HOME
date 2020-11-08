<?php
require_once('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');

define('PAGE_NAME', 'qna');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . '/admin/login.php', '로그인이 필요합니다.');
    exit;
}

if(empty($_POST['a_id'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/'.PAGE_NAME, '잘못된 접근입니다.');
    exit;
}

$id=getDataByPost('a_id'); // 답변 아이디와 질문 아이디 공통

use JCORP\Business\QnAService\QnAService as QnAService;
$inc=new QnAService();
$info=$inc->getAnswerListById($id);

if(count($info) === 0){
    AlertMsgAndRedirectTo(ROOT . 'admin/' . PAGE_NAME, '존재하지 않는 게시물입니다.');
    exit;
}


$result_update=$inc->delList($id);


if(!empty($result_update)){
    Redirect(ROOT . 'admin/'.PAGE_NAME);
}else{
    AlertMsgAndRedirectTo(ROOT . 'admin/'.PAGE_NAME, '변경사항이 없습니다.');
}

exit;