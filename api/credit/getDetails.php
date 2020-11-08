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

$company_id=$_SESSION['company_id'];
$fin_co_no=getDataByGet('fcn');
$fin_prdt_cd=getDataByGet('fpc');

use \JCORP\Business\FinLifeApi\CreditLoanService as Credit;
$credit=new Credit();

$info=$credit->getDetails($fin_co_no, $fin_prdt_cd, $company_id);

echo json_encode(array(
    'success' => true,
    'code' => 200,
    'list' =>$info
));

exit;
