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

if(empty($id)){
    echo json_encode(array(
        'success' => false,
        'code' => 500,
        'msg' => '필수입력값이 누락되었습니다.'
    ));
    exit;
}

use JCORP\Database\DBConnection as DBconn;
$db = new DBconn();

use \JCORP\Business\Video\VideoService as Video;
$video=new Video();


try {
    $db->getDBINS()->beginTransaction();

    // 대표 영상 초기화
    $video->removeRepresentativeVideo($db);

    // 대표 영상 지정
    $result=$video->setRepresentativeVideo($id, $db);

    if(!empty($result)){
        $db->getDBINS()->commit();
        $db=null;

        echo json_encode(array(
            'success' => true,
            'code' => 200
        ));
    }else{
        throw new Exception("대표영상을 지정하는데 실패하였습니다. " . $id);
    }
}catch(Exception $ex){
    $db->getDBINS()->rollBack();
    $db=null;
    echo json_encode(array(
        'success' => false,
        'code' => 500
    ));
}