<?php
require_once('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

if(empty($_POST['ir1'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/settings/agreement.php', '잘못된 접근입니다.');
    exit;
}

$html=htmlEntities($_POST["ir1"], ENT_QUOTES);
$company_id=$_SESSION['company_id'];
$admin_id=$_SESSION['user_id'];

use JCORP\Database\DBConnection as DBconn;
$db = new DBconn();

// insert해야할지 update해야할지를 판단
$check_query="select * from `platform_settings` where `company_id`=$company_id limit 0,1;";
$check_result=$db->query($check_query);

if(count($check_result) == 0){
    // insert
    $insert_query="insert into `platform_settings` (`agreement`, `admin_id`, `company_id`) values (:agreement, :admin_id, :company_id)";
    $insert_value=array(
        ':agreement' => $html,
        ':admin_id' => $admin_id,
        ':company_id' => $company_id
    );
    $insertedId=$db->insert($insert_query, $insert_value);
}else{
    // update
    $setting_id=$check_result[0]['id'];
    $update_query="update `platform_settings` set `agreement`=:agreement where `id`=:setting_id and `company_id`=:company_id;";
    $value=array(
        ':agreement' => $html,
        ':setting_id' => $setting_id,
        ':company_id' => $company_id
    );
    $result=$db->update($update_query, $value);
}

$db=null;

AlertMsgAndRedirectTo('/admin/settings/agreement.php', '이용약관이 정상적으로 처리되었습니다.');

exit;