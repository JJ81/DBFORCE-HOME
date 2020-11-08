<?php
require_once('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');


if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'login.php', '로그인이 필요합니다.');
    exit;
}

if($_SESSION['role'] !== '1'){
    AlertMsgAndRedirectTo(ROOT . 'index.php', '최고관리자만 접근할 수 있는 페이지입니다.');
    exit;
}


$employee_id=getDataByPost('employee_id');
$prev_path=getDataByPost('prev_path');

error_log('employee_id');
error_log($employee_id);

use JCORP\Database\DBConnection as DBconn;
$db = new DBconn();


// 우선 회수할 디비 갯수가 있는지 파악한다.
$query_count_db="select * from `crm_db_relations` where `employee_id`=$employee_id;";
$result_count_db=$db->query($query_count_db);

// 회수할 디비가 없다면 해당 사실을 알려주고 프로세스를 종료한다.
if(count($result_count_db) == 0 ){
    AlertMsgAndRedirectTo($prev_path, '회수할 고객디비를 가지고 있지 않습니다.');
    exit;
}


// 디비를 모두 읽어들여서 로그에 적고
try{
    $db->getDBINS()->beginTransaction();


    // 회수할 디비가 있다면 아래 프로세스를 통해서 회수한 내용을 로그로 남긴다.
    $query=
        "insert into `crm_log_allocate` (`employee_id`, `customer_id`, `distributed_dt`) " .
        "select `employee_id`,`customer_id`, `distributed_dt` from `crm_db_relations` where `employee_id`=$employee_id;";
    $result_draw=$db->insert($query);

    if(!empty($result_draw)){
        error_log('Insert crm_log_allocate');
    }else{
        throw new Exception("[IST] 디비회수가 비정상적으로 처리되었습니다. 다시 시도해주세요.");
    }

    // 회수된 디비의 내용 중 기존과는 다르게 레벨변경이 되지 않도록 한다.
    $query_adjust_value=
        "update `crm_customer` as `cc`, " .
        "(select `customer_id` from `crm_db_relations` where `employee_id`=$employee_id) as `cdr` " .
        "set `is_assign`=0 where `cdr`.`customer_id`=`cc`.`id`;";
    $result_value=$db->update($query_adjust_value);

    if(!empty($result_value)){
        error_log('is_assign is 0');
    }else{
        throw new Exception("[VAL] 디비회수가 비정상적으로 처리되었습니다. 데이터를 확인하세요.");
    }

    error_log($result_value); // 변경이 되었는데 0이 출력되는 이유가 무엇인가??

    // 특정 직원 아이디로 연결된 모든 관계를 끊는다.
    $query_delete=$db->delete("delete from `crm_db_relations` where `employee_id`=$employee_id;");


    if(!empty($query_delete)){
        $db->getDBINS()->commit();
        AlertMsgAndRedirectTo($prev_path,"디비회수가 정상적으로 완료되었습니다.");
    }else{
        throw new Exception("[DEL] 디비회수가 비정상적으로 처리되었습니다. 다시 시도해주세요.");
    }

}catch(Exception $ex){
    $db->getDBINS()->rollBack();
    error_log($ex);
    AlertMsgAndRedirectTo($prev_path,$ex->getMessage());
}

exit;