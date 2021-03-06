<?php
header('Content-type: application/json');
require_once('../../autoload.php');
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
$title=getDataByPost('title');
$url=getDataByPost('url');

if(empty($title) or empty($url) or empty($id)){
    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => '필수입력값이 누락되었습니다.'
    ));
    exit;
}

use \JCORP\Business\Video\VideoService as Video;
$video=new Video();

$result=$video->updateVideoById($title, $url, $id);

echo json_encode(array(
    'success' => true,
    'code' => 200,
    'result' => $result
));