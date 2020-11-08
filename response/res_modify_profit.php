<?php
require_once('./../autoload.php');
require_once('./../commons/config.php');
require_once('./../commons/utils.php');
require_once('./../commons/session.php');

define('PAGE_NAME', 'member_profit_modify');

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
$hits=0;
$external_link=getDataByPost('external_link');
$link_origin=getDataByPost('link_origin');
$id=getDataByPost('id');

if(empty($id)){
    AlertMsgAndRedirectTo(ROOT, '잘못된 접근입니다.[3]');
    exit;
}

use JCORP\Business\MemberProfitService\MemberProfitService as MemberProfit;
$inc=new MemberProfit();
$info=$inc->getListById($id);

if(count($info) === 0){
    AlertMsgAndRedirectTo(ROOT . 'member_profit.php', '존재하지 않는 게시물입니다.');
    exit;
}

$thumbnail=null;
$UPLOAD_DIR_IMAGE=MEMBER_PROFIT_IMG_PATH;
$newImgName=null;

if(empty($external_link)){
    $external_link=null;
}

if(empty($link_origin)){
    $link_origin=null;
}


if(!empty($_FILES['thumbnail']['tmp_name'])){
    if(validateImage($_FILES['thumbnail']['tmp_name'])) {
        $newImgName = makeNewImageName( $_FILES['thumbnail']['tmp_name'] );
    }

    // 새로운 썸네일이 있는 경우
    $thumbnail=$newImgName;
}

if($newImgName !== null){
    if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $UPLOAD_DIR_IMAGE . $newImgName )) {
        // 새로운 이미지가 업로드된 경우
    } else {
        AlertMsgAndRedirectTo(ROOT . PAGE_NAME . '.php?id='. $id, '잘못된 설정으로 이미지 업로드에 실패하였습니다.');
        exit;
    }
}else{
    // 새로운 이미지가 없는 경우
    $thumbnail=$info[0]['thumbnail']; // 기존의 정보를 연결
}

error_log('[INFO] Check data when updating it');
error_log($title);
error_log($thumbnail); // null
error_log($html);
error_log($author);
error_log($hits);
error_log($id);

$hits=$info[0]['count'];

$result=$inc->updateList($title, $thumbnail, $html, $author, $hits, $external_link, $link_origin, $id, $date);

if(!empty($result)){
    Redirect(ROOT . 'member_profit_view.php?id=' . $id);
}else{
    AlertMsgAndRedirectTo(ROOT . PAGE_NAME . '.php?id='.$id, '알 수 없는 오류가 발생했습니다. 잠시 후에 다시 작성해 주세요.');
}

exit;