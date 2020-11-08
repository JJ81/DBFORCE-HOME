<?php
require_once ('../../../autoload.php');
require_once('../../../commons/config.php');
require_once('../../../commons/utils.php');
require_once('../../../commons/session.php');
require '../../../vendor/autoload.php';

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo('login.php', '로그인이 필요합니다.');
    exit;
}

$admin_id=$_SESSION['user_id'];
$company_id=$_SESSION['company_id'];

// 설정
$uploads_dir = EXCEL_UPLOAD_PATH;
$allowed_ext = array('xls','xlsx');

// 변수 정리
$error = $_FILES['excel']['error'];
$name = $_FILES['excel']['name'];

// 파일이 없으면 무효 처리
if(!$name){
    AlertMsgAndRedirectTo(ROOT . 'admin/customer/', '잘못된 접근입니다.');
    exit;
}
// 파일 이름에 .xlsx가 없으면 무효 처리
if(!strpos($name, '.xlsx')){
    AlertMsgAndRedirectTo(ROOT . 'admin/customer/', '사용할 수 없는 파일입니다.');
    exit;
}


// 오류 확인
if( $error != UPLOAD_ERR_OK ) {
    switch( $error ) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            error_log($error);
            AlertMsgAndRedirectTo(ROOT . 'admin/customer/', '파일 크기를 조절하세요.');
            break;
        case UPLOAD_ERR_NO_FILE:
            error_log($error);
            AlertMsgAndRedirectTo(ROOT . 'admin/customer/', '파일이 첨부되지 않았습니다.');
            break;
        default:
            error_log($error);
            AlertMsgAndRedirectTo(ROOT . 'admin/customer/', '파일이 제대로 업로드 되지 않았습니다.');
    }
    exit;
}

// 파일 이름 생성
$excelName=changeExcelName($name, $company_id) . ".xlsx";

// 파일 이동
move_uploaded_file( $_FILES['excel']['tmp_name'], $uploads_dir . $excelName);


$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
$spreadsheet = $reader->load($uploads_dir . $excelName);
$worksheet = $spreadsheet->getActiveSheet();
$rows = $worksheet->toArray();

use JCORP\Database\DBConnection as DBconn;
$db = new DBconn();


echo("<a href='".ROOT . "admin/customer/' style='font-size: 20px;'>돌아가기</a>");
echo("<br />");
echo("<br />");


for($i=1,$size=count($rows);$i<$size;$i++){
    if(trim($rows[$i][0]) !== '' and trim($rows[$i][1]) !== ''){
        $name=trim($rows[$i][0]);
        $phone=trim($rows[$i][1]);
        $created_dt=(empty($rows[$i][2])) ? NULL : trim($rows[$i][2]);

        // 날짜 형식을 체크한 후에 맞지 않을 경우 NULL로 처리할 것.
        $created_dt=checkAvailableDate($created_dt);

        // 기존 디비에 같은 전화번호가 있는지 확인 후에 쿼리문에 추가한다.
        $dup_query="select * from `jp_ld_customer` where `phone`='$phone';";
        $dup_result=$db->query($dup_query);

        if(count($dup_result) == 0){
            // 핸드폰 번호의 형식 검사
            if(checkPhoneType($phone)){
                $query=null;
                if($created_dt===null){
                    $query="insert into `jp_ld_customer` (`name`, `phone`, `admin_id`, `company_id`) value ('$name', '$phone', $admin_id, $company_id);";
                }else{
                    $query="insert into `jp_ld_customer` (`name`, `phone`, `created_dt`, `admin_id`, `company_id`) value ('$name', '$phone', '$created_dt', $admin_id, $company_id);";
                }

                $insertedId=$db->insert($query, null);

                echo '<strong style="color: green;">[입력완료]</strong> ' . $name . ' ' . $phone;
                error_log('[입력] ' . $name . ' ' . $phone);
            }else{
                echo '<strong style="color: orange;">[형식오류]</strong> ' . $phone;
                error_log('[번호형식에러] ' . $phone);
            }
        }else{
            echo '<strong style="color: dimgrey;">[중복발견]</strong> ' . $name . ' ' . $phone;
            error_log('중복 자동 제거 ' . $name . ' ' . $phone);
        }
        echo '<br />';
    }
}

echo("<br />");
echo("<br />");
echo("<a href='".ROOT."admin/customer/' style='font-size: 20px;'>돌아가기</a>");
// AlertMsgAndRedirectTo(ROOT . 'admin/customer/', '요청하신 DB가 처리되었습니다.');