<?php
header('Content-type: application/json');
require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');

// API
if(empty($_SESSION['user'])){
    echo json_encode(array(
        'success' => false,
        'code' => 401,
        'msg' => '로그인이 필요합니다.'
    ));
    exit;
}

$id=getDataByPost('id');
$company_id=$_SESSION['company_id'];

if(empty($id)){
    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => 'required data is missed'
    ));
    exit;
}

use \JCORP\Business\Review\ReviewService as Review;
$review=new Review();

$lists=$review->deleteReviewInfo($id, $company_id);

echo json_encode(array(
    'success' => true,
    'code' => 200,
    'lists' =>$lists
));