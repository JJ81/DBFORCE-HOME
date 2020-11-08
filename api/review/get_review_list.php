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

if(empty($_GET['size'])){
    $size=20;
}else{
    $size=getDataByGet('size');
}

if(empty($_GET['page'])){
    $page=1;
}else{
    $page=getDataByGet('page');
}

$current=$page;
$next=null;
$prev=null;

$company_id=$_SESSION['company_id'];

use \JCORP\Business\Review\ReviewService as Review;
$review=new Review();

$total=$review->getReviewListCount($company_id);
$total_count = $total[0]['total'];
$total_page=ceil($total_count/$size);
$offset=($page-1)*$size;

if($current < $total_page){
    $next = $current+1;
} else {
    $next=$current;
}

if($current > 1){
    $prev = $current-1;
}else{
    $prev=$current;
}

$lists=$review->getReviewList($offset, $size, $company_id);

echo json_encode(array(
    'success' => true,
    'code' => 200,
    'lists' =>$lists
));

exit;
