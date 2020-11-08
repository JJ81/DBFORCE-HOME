<?php
require_once ('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');
require '../../../vendor/autoload.php';

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

$ids=$_POST['id'];
$name=$_POST['name'];
$tel_end=$_POST['tel_end'];

error_log(print_r($ids, true));
error_log(print_r($name, true));
error_log(print_r($tel_end, true));

// 에러처리 케이스
// 갯수가 0개일 때
// 두 개의 갯수가 맞지 않을 경우
if(count($ids) === 0){
    AlertMsgAndRedirectTo(ROOT . 'admin/free_data/', '잘못된 접근입니다.');
    exit;
}

use \JCORP\Business\Free\FreeExpService as Free;
$free=new Free();

for($i=0,$size=count($ids);$i<$size;$i++){
    $tmp_name=$name[$i];
    $tmp_tel=$tel_end[$i];
    $tmp_id=$ids[$i];

    error_log($tmp_name);
    error_log($tmp_tel);
    error_log($tmp_id);

    $result_update=$free->modVipList($tmp_name, $tmp_tel, $tmp_id);
    error_log('$result_update');
    error_log($result_update);
}

AlertMsgAndRedirectTo(ROOT . 'admin/free_data/', '정상적으로 처리되었습니다.');

exit;