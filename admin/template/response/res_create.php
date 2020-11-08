<?php
require_once('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo('login.php', '로그인이 필요합니다.');
    exit;
}

use \JCORP\Business\Template\TemplateService as Template;
$template=new Template();

$admin_id=$_SESSION['user_id'];
$company_id=$_SESSION['company_id'];
$title=getDataByPost('title');
$purpose=getDataByPost('purpose');
$prev_path=$_POST['prev_path'];

if(empty($_POST['template_type'])){
    AlertMsgAndRedirectTo($prev_path,'잘못된 접근입니다.');
    exit;
}

$template_type=getDataByPost('template_type'); // HM, BD, IM

if($template_type === 'IM'){ // 이미지 템플릿일 경우의 처리
    $img_type=checkValidImg($_FILES['file']['type']);
    error_log($img_type);

    if($img_type === ''){
        AlertMsgAndRedirectTo($prev_path,'이미지 형식이 맞지 않습니다.');
        exit;
    }

    $target_img_ext="jpg";
    $originImg=$_FILES['file']['tmp_name'];
    $newImgName='';
    $tmp_new_file_name=makeNewImageFileName( $company_id, $_FILES['file']['tmp_name']);
    $newImgName=changeImageExt($tmp_new_file_name, $img_type, $target_img_ext);

    $path="../../../assets/uploads/images/"; // 업로드 위치
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $path . $newImgName)) {

        // 데이터베이스에 이미지 템플릿을 등록한다.
        $result_image=$template->setImageTemplate($template_type, $title, $purpose, $newImgName, $admin_id, $company_id);

        if(empty($result_image)){
            error_log('uploaded but not registered');
            AlertMsgAndRedirectTo($prev_path, '이미지 템플릿이 정상적으로 등록되지 않았습니다. 잠시 후에 다시 시도해주세요.');
        }else{
            error_log('uploaded successfully');
            AlertMsgAndRedirectTo($prev_path, '이미지 템플릿이 정상적으로 등록되었습니다.');
        }

    } else {
        error_log('failed to upload');
        AlertMsgAndRedirectTo($prev_path, '이미지 템플릿이 비정상적으로 등록되었습니다. 다시 확인해 주세요.');
    }


} else if($template_type === 'BD') {

} else if($template_type === 'HM'){

} else {
    AlertMsgAndRedirectTo($prev_path,'잘못된 접근입니다.');
    exit;
}