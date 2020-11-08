<?php
header('Content-type: application/json');
require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');

if(empty($_SESSION['user'])){
    echo json_encode(array(
        'success' => false,
        'code' => 401,
        'msg' => '로그인이 필요합니다.'
    ));
    exit;
}

// 필수 입력값을 모두 받았는지 판단하여 처리할 것.
if(empty($_POST['title']) or empty($_POST['position']) or empty($_POST['order']) or empty($_POST['id']) ){
    echo json_encode(array(
        'success' => false,
        'code' => 403,
        'msg' => 'required parameter is missed'
    ));
    exit;
}

use \JCORP\Business\Review\ReviewService as Review;
$review=new Review();

// htmlspecialchars 를 처리하는 로직과 큰따옴표와 작은 따옴표를 처리하는 로직을 함께 넣을 수 있는 유틸리티가 필요하다.

$id=receiveHtmlAndSpecialLetters(getDataByPost('id'));
$title=receiveHtmlAndSpecialLetters(getDataByPost('title'));
$position=receiveHtmlAndSpecialLetters(getDataByPost('position'));
$order=receiveHtmlAndSpecialLetters(getDataByPost('order'));
$company_id=intval($_SESSION['company_id']);
$path="../../assets/review/";

if(empty($title) or empty($position) or empty($order) ){
    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => 'Required data is missed'
    ));
    exit;
}


// 이미지가 있을 때의 처리
if(!empty($_FILES['thumbnail']['type'])){
// 이미지 업로드 처리
    $img_type=checkValidImg($_FILES['thumbnail']['type']);
    error_log($img_type);

    if($img_type === ''){
        echo json_encode(array(
            'success' => false,
            'code' => 500,
            'msg' => 'image is not valid'
        ));
        exit;
    }

    $target_img_ext="jpg";
    $originImg=$_FILES['thumbnail']['tmp_name'];
    $newImgName='';
    $tmp_new_file_name=makeNewImageFileName( $company_id, $_FILES['thumbnail']['tmp_name']);
    $newImgName=changeImageExt($tmp_new_file_name, $img_type, $target_img_ext);

    if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $path . $newImgName)) {
        error_log('uploaded successfully');

        $result=$review->updateReviewInfo($title, $position, $newImgName, $order, $company_id, $id);

        if(!empty($result)){
            echo json_encode(array(
                'success' => true,
                'code' => 200,
                'msg' => 'Complete to add new one successfully'
            ));
        }else{
            echo json_encode(array(
                'success' => true,
                'code' => 500,
                'msg' => 'Failed to add new review'
            ));
        }

        exit;
    } else {
        echo json_encode(array(
            'success' => false,
            'code' => 500,
            'msg' => 'Failed to upload image successfully'
        ));
        exit;
    }

}else{ // 새로운 이미지가 없을 때의 처리

    $result=$review->updateReviewInfoWithOutThumbnail($title, $position, $order, $company_id, $id);

    if(!empty($result)){
        echo json_encode(array(
            'success' => true,
            'code' => 200,
            'msg' => 'Complete to add new one successfully'
        ));
    }else{
        echo json_encode(array(
            'success' => true,
            'code' => 500,
            'msg' => 'Failed to add new review'
        ));
    }

    exit;
}