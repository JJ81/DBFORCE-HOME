<?php
header('Content-type: application/json');
require_once('../../autoload.php');
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

$lists=json_decode($_POST['lists'], true);
//error_log("check order");
//error_log(print_r($lists, true));


for($i=0,$size=count($lists);$i<$size;$i++){
    if($lists[$i]['order'] == ''){
        echo json_encode(array(
            'success' => false,
            'code' => 500,
            'msg' => '설정값을 다시 확인하세요.'
        ));
        exit;
    }
}

use \JCORP\Business\Video\VideoService as Video;
$video=new Video();

for($j=0,$size_j=count($lists);$j<$size_j;$j++) {
    $tmp_id=intval($lists[$j]['id']);
    $tmp_order=intval($lists[$j]['order']);

//    error_log($tmp_id);
//    error_log($tmp_order);

    $video->setOrderVideo($tmp_id, $tmp_order);
}

echo json_encode(array(
    'success' => true,
    'code' => 200,
    'msg' => '영상의 순위가 조정되었습니다.'
));