<?php

require_once('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . '/admin/login.php', '로그인이 필요합니다.');
    exit;
}

if(empty($_POST['id'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/media/', '잘못된 접근입니다.');
    exit;
}

$id=getDataByPost('id');

use JCORP\Business\Media\MediaService as Media;
$media=new Media();
$media_info=$media->getListById($id);

if(count($media_info) === 0){
    AlertMsgAndRedirectTo(ROOT . 'admin/media/', '존재하지 않는 게시물입니다.');
    exit;
}


$title=getDataByPost('title');
$date=getDataByPost('date');
$html=htmlEntities($_POST["ir1"], ENT_QUOTES);
$hits=intval(getDataByPost('hits'));
$author=getDataByPost('author');
$external_link=getDataByPost('external_link');
$link_origin=getDataByPost('link_origin');
$desc=getDataByPost('desc');
$delete_thumbnail=getDataByPost('delete_thumbnail'); // 썸네일 삭제 여부 결정

$admin_id=$_SESSION['user_id'];
$company_id=$_SESSION['company_id'];

if(empty($date)){
    $date=getToday('Y-m-d');
}

$thumbnail=null;
$UPLOAD_DIR_IMAGE=MEDIA_IMG_PATH; // 공지사항 이미지 업로드 경로
$newImgName=null;

if(empty($external_link)){
    $external_link=null;
}

if(empty($link_origin)){
    $link_origin=null;
}

if(empty($desc)){
    $desc=null;
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
        AlertMsgAndRedirectTo(ROOT . 'admin/media/', '잘못된 설정으로 이미지 업로드에 실패하였습니다.');
        exit;
    }
}else{
    if(!empty($delete_thumbnail)){
        $thumbnail=null; // 기존 이미지를 삭제해야 하는 경우
    }else{
        // 새로운 이미지가 없는 경우
        $thumbnail=$media_info[0]['thumbnail']; // 기존의 정보를 연결
    }
}

error_log('[INFO] Check notice data when updating it');
error_log($title);
error_log($desc);
error_log($external_link);
error_log($id);

$result_update_notice=$media->updateList($title, $thumbnail, $html, $author, $hits, $external_link, $link_origin, $id, $date, $desc);

//error_log('$result_update_notice');
//error_log($result_update_notice);

if(!empty($result_update_notice)){
    Redirect(ROOT . 'admin/media/modify.php?id=' . $id);
}else{
    AlertMsgAndRedirectTo(ROOT . 'admin/media/modify.php?id=' . $id, '변경사항이 없습니다.');
}

exit;