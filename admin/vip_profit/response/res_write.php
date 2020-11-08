<?php
require_once('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');

define('PAGE_NAME', 'vip_profit');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

//if(empty($_POST['title'])){
//    AlertMsgAndRedirectTo(ROOT . 'admin/' . PAGE_NAME, '잘못된 접근입니다.');
//    exit;
//}



$title=getDataByPost('title');
$date=getDataByPost('date'); // 생성일
$html=htmlEntities($_POST["ir1"], ENT_QUOTES);
$hits=getDataByPost('hits');

$external_link=getDataByPost('external_link');
$link_origin=getDataByPost('link_origin');


$max_profit_rate=getDataByPost('max_profit_rate'); // 최대수익율
$max_profit_price=getDataByPost('max_profit_price'); // 최대수익금

$admin_id=$_SESSION['user_id'];
$company_id=$_SESSION['company_id'];


$stock_title=getDataByPost('stock_title');
$purchase_price=getDataByPost('purchase_price');
$purchase_date=getDataByPost('purchase_date');
$sell_price=getDataByPost('sell_price');
$sell_date=getDataByPost('sell_date');
$profit_rate=getDataByPost('rate');
$author=getDataByPost('author');


if(empty($date)){
    $date=getToday('Y-m-d');
}


if(empty($external_link)){
    $external_link=null;
}

if(empty($link_origin)){
    $link_origin=null;
}

$thumbnail=null;
$UPLOAD_DIR_IMAGE=VIP_PROFIT_IMG_PATH;
$newImgName=null;



if(!empty($_FILES['thumbnail']['tmp_name'])){
    if(validateImage($_FILES['thumbnail']['tmp_name'])) {
        $newImgName = makeNewImageName( $_FILES['thumbnail']['tmp_name'] );
    }
}

if($newImgName !== null){
    if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $UPLOAD_DIR_IMAGE . $newImgName )) {

    } else {
        AlertMsgAndRedirectTo(ROOT . 'admin/' . PAGE_NAME, '잘못된 설정으로 이미지 업로드에 실패하였습니다.');
        exit;
    }
}

$thumbnail=$newImgName;

use JCORP\Business\VipProfitService\VipProfitService as VipProfit;
$inc=new VipProfit();

$insertId=$inc->setList2($stock_title, $purchase_price, $purchase_date, $sell_price, $sell_date, $profit_rate, $author);

if(!empty($insertId)){
    Redirect(ROOT . 'admin/' . PAGE_NAME . '/modify.php?id=' . $insertId);
}else{
    AlertMsgAndRedirectTo(ROOT . 'admin/' . PAGE_NAME, '알 수 없는 오류가 발생했습니다. 공지사항을 다시 작성해 주세요.');
}

exit;