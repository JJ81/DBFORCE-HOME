<?php
require_once('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . '/admin/login.php', '로그인이 필요합니다.');
    exit;
}

if($_SESSION['role'] !== 'A'){
    AlertMsgAndRedirectTo(ROOT . '/', '관리자만 접근할 수 있는 페이지입니다.');
    exit;
}

if(empty($_POST['title']) or empty($_POST['description']) or
    empty($_POST['keyword']) or empty($_POST['service_url']) or
    empty($_POST['pc_viewport']) or empty($_POST['deploy_version']))
{
    AlertMsgAndRedirectTo(ROOT . 'admin/settings/basics.php', '잘못된 접근입니다.');
    exit;
}

$title=getDataByPost('title');
$description=getDataByPost('description');
$keyword=getDataByPost('keyword');
$service_url=getDataByPost('service_url');
$pc_viewport=getDataByPost('pc_viewport');
$deploy_version=getDataByPost('deploy_version');
$naver_verification_number=getDataByPost('naver_verification_number');
$google_verification_number=getDataByPost('google_verification_number');


use Msg\Database\DBConnection as DBconn;
$db = new DBconn();

// insert해야할지 update해야할지를 판단
$check_query="select * from `cms_basic_info`;";
$check_result=$db->query($check_query);

if(count($check_result) == 0){
    // insert
    $insert_query=
        "insert into `cms_basic_info` (`title`, `description`, `keyword`, `service_url`, ".
        " `pc_viewport`, `deploy_version`, `naver_verification_number`, `google_verification_number`) ".
        "values (:title, :description, :keyword, :service_url, :pc_viewport, :deploy_version, :naver_verification_number, :google_verification_number)";
    $insert_value=array(
        ':title' => $title,
        ':descrption' => $description,
        ':keyword' => $keyword,
        ':service_url' => $service_url,
        ':pc_viewport' => $pc_viewport,
        ':deploy_version' => $deploy_version,
        ':naver_verification_number' => $naver_verification_number,
        ':google_verification_number' => $google_verification_number
    );
    $insertedId=$db->insert($insert_query, $insert_value);
}else{
    // update
    $id=$check_result[0]['id'];
    $update_query=
        "update `cms_basic_info` set `title`='$title', `description`='$description', `keyword`='$keyword', `service_url`='$service_url', ".
        "`pc_viewport`='$pc_viewport', `deploy_version`='$deploy_version', ".
        " `naver_verification_number`='$naver_verification_number', `google_verification_number`='$google_verification_number' " .
        " where `id`=$id;";
    $result=$db->update($update_query);
}

$db=null;


AlertMsgAndRedirectTo('/admin/settings/basics.php', '서비스 설정 정보가 정상적으로 등록되었습니다.');
?>