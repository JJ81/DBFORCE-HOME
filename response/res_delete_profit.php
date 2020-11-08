<?php
require_once('./../autoload.php');
require_once('./../commons/config.php');
require_once('./../commons/utils.php');
require_once('./../commons/session.php');

define('PAGE_NAME', 'member_profit_modify');

$member_cid=$_SESSION['user_uuid'];

if(empty($member_cid)){
    AlertMsgAndRedirectTo(ROOT, '로그인이 필요합니다.');
    exit;
}

$id=getDataByPost('id');

if(empty($id)){
    AlertMsgAndRedirectTo(ROOT, '잘못된 접근입니다.[1]');
    exit;
}

use JCORP\Business\MemberProfitService\MemberProfitService as MemberProfit;
$inc=new MemberProfit();
$info=$inc->getListById($id);

if(count($info) === 0){
    AlertMsgAndRedirectTo(ROOT . 'member_profit.php', '존재하지 않는 게시물입니다.');
    exit;
}

// 삭제 권한 찾기
if($member_cid !== $info[0]['writer_id']){
    AlertMsgAndRedirectTo(ROOT . 'member_profit.php', '게시글을 삭제할 권한이 없습니다.');
    exit;
}

$result=$inc->delList($id);

if(!empty($result)){
    AlertMsgAndRedirectTo(ROOT . 'member_profit.php', '선택된 게시물이 삭제되었습니다.');
}else{
    AlertMsgAndRedirectTo(ROOT . PAGE_NAME . '.php?id='.$id, '알 수 없는 오류가 발생했습니다. 잠시 후에 다시 작성해 주세요.');
}

exit;