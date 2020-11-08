<?php
require_once('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');

define('PAGE_NAME', 'interview');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . '/admin/login.php', '로그인이 필요합니다.');
    exit;
}

if(empty($_POST['id'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/'.PAGE_NAME, '잘못된 접근입니다.');
    exit;
}

$id=getDataByPost('id');

use JCORP\Business\InterviewService\InterviewService as Interview;
$inc=new Interview();
$info=$inc->getListById($id);

if(count($info) === 0){
    AlertMsgAndRedirectTo(ROOT . 'admin/' . PAGE_NAME, '존재하지 않는 게시물입니다.');
    exit;
}


$title=getDataByPost('title');
$date=getDataByPost('date');
$html=htmlEntities($_POST["ir1"], ENT_QUOTES);
$hits=intval(getDataByPost('hits'));
$author=getDataByPost('author');
$external_link=getDataByPost('external_link');
$link_origin=getDataByPost('link_origin');

$delete_thumbnail=getDataByPost('delete_thumbnail'); // 썸네일 삭제 여부 결정

$admin_id=$_SESSION['user_id'];
$company_id=$_SESSION['company_id'];


$video=getDataByPost('video');


if(empty($date)){
    $date=getToday('Y-m-d');
}

$thumbnail=null;
$UPLOAD_DIR_IMAGE=INTERVIEW_IMG_PATH;
$newImgName=null;

if(empty($external_link)){
    $external_link=null;
}

if(empty($link_origin)){
    $link_origin=null;
}

// 처리 케이스
// 1. 썸네일 삭제만 선택하는 경우 :: null 로 처리
// 2. 썸네일 삭제와 이미지를 업로드하는 경우 :: 이미지 업로드만 처리
// 3. 썸네일 삭제 체크 없이 이미지를 업로드 하는 경우 :: 이미지 업로드만 처리
// 4. 썸네일 체크 및 이미지 모두 없는 경우 :: 기존 이미지 정보 입력

if(!empty($delete_thumbnail)){
    $thumbnail=null;
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
        AlertMsgAndRedirectTo(ROOT . 'admin/' . PAGE_NAME, '잘못된 설정으로 이미지 업로드에 실패하였습니다.');
        exit;
    }
}else{
    if(!empty($delete_thumbnail)){
        $thumbnail=null; // 기존 이미지를 삭제해야 하는 경우
    }else{
        // 새로운 이미지가 없는 경우
        $thumbnail=$info[0]['thumbnail']; // 기존의 정보를 연결
    }
}

error_log('[INFO] Check data when updating it');
error_log($title);
error_log($thumbnail); // null
error_log($html);
error_log($author);
error_log($hits);
error_log($id);
error_log($delete_thumbnail);

$result_update=$inc->updateList($title, $thumbnail, $html, $author, $hits, $external_link, $link_origin, $id, $date, $video);

error_log('$result_update_notice');
error_log($result_update);

if(!empty($result_update)){
    Redirect(ROOT . 'admin/'.PAGE_NAME.'/modify.php?id=' . $id);
}else{
    AlertMsgAndRedirectTo(ROOT . 'admin/'.PAGE_NAME.'/modify.php?id=' . $id, '변경사항이 없습니다.');
}

exit;