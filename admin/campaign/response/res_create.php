<?php
require_once('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo('login.php', '로그인이 필요합니다.');
    exit;
}

use \JCORP\Business\Campaign\CampaignService as Campaign;
$campaign=new Campaign();

$admin_id=$_SESSION['user_id'];
$company_id=$_SESSION['company_id'];
$title=getDataByPost('title');
$purpose=getDataByPost('purpose');
$prev_path=$_POST['prev_path'];
$redirection=getDataByPost('redirection');
$isOpen=getDataByPost('isOpen');


if(empty($_POST['template_id'])){
    AlertMsgAndRedirectTo($prev_path,'잘못된 접근입니다.');
    exit;
}

$template_id=$_POST['template_id']; // array
error_log(print_r($template_id, true));

if(empty($template_id)){
    AlertMsgAndRedirectTo($prev_path,'잘못된 접근입니다.');
    exit;
}


$string_template_id=implode(',', $template_id);

if(empty($isOpen)){
    $isOpen=0;
}else{
    $isOpen=1;
}


$result=$campaign->setCampaign($admin_id, $company_id, $title, $purpose, $string_template_id, $isOpen, $redirection);

if(!empty($result)){
    AlertMsgAndRedirectTo(ROOT . 'admin/campaign/','캠페인이 정상적으로 등록되었습니다.');
}else{
    AlertMsgAndRedirectTo($prev_path,'캠페인이 정상적으로 등록되지 않았습니다. 다시 확인해 주세요.');
}
exit;