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

$origin_id=getDataByPost('id');
$id=getDataByPost('a_id'); // 답변 글 아이디

use JCORP\Business\QnAService\QnAService as QnAService;
$inc=new QnAService();
$info=$inc->getAnswerListById($id);

error_log('$info');
error_log(print_r($info, true));


if(count($info) == 0){
    AlertMsgAndRedirectTo(ROOT . 'admin/' . PAGE_NAME, '존재하지 않는 게시물입니다.');
    exit;
}

$title=getDataByPost('title');
$date=getDataByPost('date');
$html=htmlEntities($_POST["ir1"], ENT_QUOTES);
$author=getDataByPost('author');
$admin_id=$_SESSION['user_id'];
$company_id=$_SESSION['company_id'];

if(empty($date)){
    $date=getToday('Y-m-d');
}

$thumbnail=null;
$UPLOAD_DIR_IMAGE=QNA_IMG_PATH;
$newImgName=null;

$result_update=$inc->updateAnswerList($title, $author, $date, $html, $id);

error_log('$result_update_notice');
error_log($result_update);

if(!empty($result_update)){
    Redirect(ROOT . 'admin/'.PAGE_NAME.'/modify_answer.php?id=' . $origin_id);
}else{
    AlertMsgAndRedirectTo(ROOT . 'admin/'.PAGE_NAME.'/modify_answer.php?id=' . $origin_id, '변경사항이 없습니다.');
}

exit;