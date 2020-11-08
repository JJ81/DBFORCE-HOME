<?php
require_once ('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');
require '../../../vendor/autoload.php';

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo('login.php', '로그인이 필요합니다.');
    exit;
}

$admin_id=$_SESSION['user_id'];
$company_id=$_SESSION['company_id'];

use JCORP\Database\DBConnection as DBconn;
$db=new DBconn();

// Check file size
//if ($_FILES["file"]["size"] > 1024*1024*10) {
//
//    exit;
//}

$img_type=checkValidImg($_FILES['file']['type']);
error_log($img_type);

if($img_type === ''){
    echo json_encode(array(
        'success' => false,
        'code' => 403,
        'msg' => 'image is not valid'
    ));
    exit;
}

$target_img_ext="jpg";
$originImg=$_FILES['file']['tmp_name'];
$newImgName='';
$tmp_new_file_name=makeNewImageFileName( $company_id, $_FILES['file']['tmp_name']);
$newImgName=changeImageExt($tmp_new_file_name, $img_type, $target_img_ext);

$path="../../../assets/img/";
if (move_uploaded_file($_FILES["file"]["tmp_name"], $path . $newImgName)) {
    error_log('uploaded successfully');

    $db->insert("insert into `jp_ld_image` (`image_name`) values('$newImgName');");
    AlertMsgAndRedirectTo(ROOT . 'admin/image', '이미지 업로드가 정상적으로 처리되었습니다.');
} else {
    error_log('failed to upload');
    AlertMsgAndRedirectTo(ROOT . 'admin/image', '이미지 업로드가 비정상적으로 처리되었습니다. 잠시 후에 다시 시도해 주세요.');
}

exit;