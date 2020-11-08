<?php
require_once('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT.'index.php', "로그인이 필요합니다.");
    exit;
}

if(empty($_POST['employee_id']) or empty($_POST['new_employee_id'])){
    AlertMsgAndRedirectTo(ROOT.'index.php', "잘못된 접근입니다.");
    exit;
}

use JCORP\Database\DBConnection as DBconn;
$db = new DBconn();

$employee_id=getDataByPost('employee_id');
$new_employee_id=getDataByPost('new_employee_id');

// crm_db_rations의 모든 디비를 가져와서
// db_id만 모두 가져오면 된다
// employee_id, customer_id, distributed_dt(자동배정)
$get_all_db_query="select `id`, `customer_id`, `memo`, `distributed_dt` from `crm_db_relations` where `employee_id`=$employee_id;";
$result=$db->query($get_all_db_query);

if(count($result) == 0){
    AlertMsgAndRedirectTo(ROOT.'employee/', "인계할 데이터가 없습니다.");
    exit;
}

// TODO 트랜잭션이 필요함.
// TODO 기존에 중복된 디비가 있다면 제외가 되어야 한다!!
$insert_query_stmt="insert into `crm_db_relations` (`employee_id`, `customer_id`, `memo`, `distributed_dt`) values";
$tmp_id="";

for($i=0,$size=count($result);$i<$size;$i++){
    $new_db=$result[$i]['customer_id'];
    $memo=$result[$i]['memo'];
    $date=$result[$i]['distributed_dt'];

    if($i == $size-1){
        $insert_query_stmt .= "($new_employee_id, $new_db, '$memo', '$date');";
        $tmp_id .= $result[$i]['id'];
    }else{
        $insert_query_stmt .= "($new_employee_id, $new_db, '$memo', '$date'),";
        $tmp_id .= $result[$i]['id'] . ',';
    }
}

$result_insert=$db->insert($insert_query_stmt);
if(empty($result_insert)){
    AlertMsgAndRedirectTo(ROOT.'employee/', "DB 인계에 실패하였습니다.");
    exit;
}

$delete_query="delete from `crm_db_relations` where `employee_id`=$employee_id;";
$result_delete=$db->delete($delete_query);

if(empty($result_delete)){
    AlertMsgAndRedirectTo(ROOT.'employee/', "인계자의 디비삭제가 정상적으로 처리되지 않았습니다.");
}else{
    AlertMsgAndRedirectTo(ROOT.'employee/', "DB 인계가 완료되었습니다.");
}



exit;