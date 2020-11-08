<?php
require_once('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

if(empty($_POST['news_id'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/news/', '잘못된 접근입니다.');
    exit;
}

$id=getDataByPost('news_id');
$pickup_order=getDataByPost('pickup_order');

use JCORP\Business\News\NewsService as News;
$news=new News();

// 이미지를 가지고 있는지 조회를 한 후에
$result_info=$news->getListById($id);
if(count($result_info) === 0){
    AlertMsgAndRedirectTo(ROOT . 'admin/news/', '존재하지 않는 게시물입니다.');
    exit;
}

if($result_info[0]['thumbnail'] === '' or $result_info[0]['thumbnail'] === null){
    AlertMsgAndRedirectTo(ROOT . 'admin/news/', '썸네일이 없는 게시물입니다.');
    exit;
}

$result=$news->setMainExpose($id, $pickup_order);

if(!empty($result)){
    Redirect(ROOT . 'admin/news/');
}else{
    AlertMsgAndRedirectTo(ROOT . 'admin/news/', '알 수 없는 오류가 발생했습니다. 금융뉴스를 다시 작성해 주세요.');
}

exit;