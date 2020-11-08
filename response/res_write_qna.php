<?php
require_once('./../autoload.php');
require_once('./../commons/config.php');
require_once('./../commons/utils.php');
require_once('./../commons/session.php');

define('PAGE_NAME', 'qna_write');

$member_id=$_SESSION['user_uid'];
$member_cid=$_SESSION['user_uuid'];
if(empty($_SESSION['user_uuid'])){
    AlertMsgAndRedirectTo(ROOT, '로그인이 필요합니다.');
    exit;
}

if(empty($_POST['title'])){
    AlertMsgAndRedirectTo(ROOT, '잘못된 접근입니다.[1]');
    exit;
}

if(empty($member_id)){
    AlertMsgAndRedirectTo(ROOT, '잘못된 접근입니다.[2]');
    exit;
}

$author=getUserName();
$title=getDataByPost('title');
$date=getToday('Y-m-d H:s:i');
$html=htmlEntities($_POST["ir1"], ENT_QUOTES);
$hits=0; // 유저가 쓸 경우 무조건 0으로 세팅
$external_link=getDataByPost('external_link');
$link_origin=getDataByPost('link_origin');

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
$UPLOAD_DIR_IMAGE=QNA_IMG_PATH;
$newImgName=null;



if(!empty($_FILES['thumbnail']['tmp_name'])){
    if(validateImage($_FILES['thumbnail']['tmp_name'])) {
        $newImgName = makeNewImageName( $_FILES['thumbnail']['tmp_name'] );
    }
}

if($newImgName !== null){
    if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $UPLOAD_DIR_IMAGE . $newImgName )) {

    } else {
        AlertMsgAndRedirectTo(ROOT . PAGE_NAME.'.php' . PAGE_NAME, '잘못된 설정으로 이미지 업로드에 실패하였습니다.');
        exit;
    }
}

$thumbnail=$newImgName;

// 파일 업로드 관련 => 이미지 첨부만 가능한 것으로 한다. upload_file말고 thumbnail을 업로드할 수 있도록 한다.
$upload_file=null;

use JCORP\Business\QnAService\QnAService as QnAService;
$inc=new QnAService();

$writer_id=$member_cid;
$type="Q";

$insertId=$inc->setListByUser($title, $writer_id, $thumbnail, $html, $author, $date, $type);

if(!empty($insertId)){
    Redirect(ROOT . 'qna_view.php?id=' . $insertId);
}else{
    AlertMsgAndRedirectTo(ROOT . PAGE_NAME . '.php', '알 수 없는 오류가 발생했습니다. 잠시 후에 다시 작성해 주세요.');
}

exit;