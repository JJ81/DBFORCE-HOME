<?php
require_once('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

if(empty($_POST['title'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/social/', '잘못된 접근입니다.');
    exit;
}

$title=getDataByPost('title');
$date=getDataByPost('date'); // 생성일
$html=htmlEntities($_POST["ir1"], ENT_QUOTES);
$hits=getDataByPost('hits');
$author=getDataByPost('author');
$external_link=getDataByPost('external_link');
$link_origin=getDataByPost('link_origin');

$admin_id=$_SESSION['user_id'];
$company_id=$_SESSION['company_id'];

if(empty($date)){
    $date=getToday('Y-m-d');
}


if(empty($external_link)){
    $external_link=null;
}

if(empty($link_origin)){
    $link_origin=null;
}

$thumbnail=null;
$UPLOAD_DIR_IMAGE=SOCIAL_IMG_PATH; // 공지사항 이미지 업로드 경로
$newImgName=null;



if(!empty($_FILES['thumbnail']['tmp_name'])){
    if(validateImage($_FILES['thumbnail']['tmp_name'])) {
        $newImgName = makeNewImageName( $_FILES['thumbnail']['tmp_name'] );
    }
}

if($newImgName !== null){
    if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $UPLOAD_DIR_IMAGE . $newImgName )) {

    } else {
        AlertMsgAndRedirectTo(ROOT . 'admin/social/', '잘못된 설정으로 이미지 업로드에 실패하였습니다.');
        exit;
    }
}

$thumbnail=$newImgName;

use JCORP\Business\Social\SocialService as Social;
$social=new Social();

$insertId=$social->setList($title, $thumbnail, $html, $author, $hits, $external_link, $link_origin, $date);

if(!empty($insertId)){
    Redirect(ROOT . 'admin/social/modify.php?id=' . $insertId);
}else{
    AlertMsgAndRedirectTo(ROOT . 'admin/social/', '알 수 없는 오류가 발생했습니다. 공지사항을 다시 작성해 주세요.');
}

exit;