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
$percentage=$_POST['percentage'];


// 에러처리 케이스
// 갯수가 0개일 때
// 두 개의 갯수가 맞지 않을 경우
if(count($ids) === 0){
    AlertMsgAndRedirectTo(ROOT . 'admin/profit_data/', '잘못된 접근입니다.');
    exit;
}

use \JCORP\Business\Profit\ProfitService as Profit;
$profit=new Profit();

for($i=0,$size=count($ids);$i<$size;$i++){
    $tmp_name=$name[$i];
    $tmp_percentage=$percentage[$i];
    $tmp_id=$ids[$i];

    $result_update=$profit->modProfitList($tmp_name, $tmp_percentage, $tmp_id);
    error_log('$result_update');
    error_log($result_update);
}

AlertMsgAndRedirectTo(ROOT . 'admin/profit_data/', '정상적으로 처리되었습니다.');

exit;