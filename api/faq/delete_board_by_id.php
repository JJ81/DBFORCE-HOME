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

$id=getDataByGet('id');

use JCORP\Business\FaqService\FaqService as Faq;
$inc=new Faq();

$result_delete=$inc->delList($id);

if(empty($result_delete)){
    echo json_encode(array(
        'success' => false,
        'code' => 500
    ));
}else{
    echo json_encode(array(
        'success' => true,
        'code' => 200
    ));
}

exit;