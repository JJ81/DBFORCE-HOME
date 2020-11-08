<?php

/**
 * @param $url
 * @param $msg
 */
function AlertMsgAndRedirectTo($url, $msg)
{
    echo "<script>" .
        "alert(\"$msg\");" .
        "window.location.href='$url'" .
        "</script>";
}

/**
 * @param $msg
 */
function AlertMsg($msg)
{
    echo "<script>".
        "alert(\"$msg\")".
        "</script>";
}

/**
 * @param $url
 */
function Redirect($url)
{
    echo "<script>window.location.href='$url';</script>";
}

/**
 * @param $msg
 */
function Alert($msg)
{
    echo "<script>alert('$msg');</script>";
}

/**
 * @param $HOST
 */
function RedirectToLogin($HOST)
{
    header("Location: http://$HOST". ROOT); // TODO SSL를 설정했을 경우 변경해주어야 한다.
    exit();
}

/**
 * @param string $browserName
 * @param $msg
 */
function recomChromeBrowser($browserName='chrome', $msg)
{
    if (!strpos(strtolower($_SERVER['HTTP_USER_AGENT']), $browserName)) {
        AlertMsg($msg);
    }
}
/**
 * 이번달을 기준으로 이전달을 리턴한다.
 * @param $todayMonth
 * @return Y-m
 */
function getLastMonth($today=SET_CURRENT_DATE)
{
    return date('Y-m', strtotime('last Month'));
}

/**
 * @param bool|string $today
 * @return bool|string
 */
function getThisMonth($today=SET_CURRENT_DATE)
{
    return date('Y-m', strtotime('this Month'));
}

/**
 * @param int $dayOfTheWeek
 * @return array
 */
function getThisWeek($dayOfTheWeek=0)
{
    $end = date('Y-m-d', strtotime(SET_CURRENT_DATE));
    $start = date('Y-m-d', strtotime(SET_CURRENT_DATE . '-'.$dayOfTheWeek.' days'));
    return array($start, $end);
}

/**
 * @param bool|string $today
 */
function getLastWeek($dayOfTheWeek=0)
{
    $end = date('Y-m-d', strtotime(SET_CURRENT_DATE . '-'.($dayOfTheWeek+1).' days'));
    $start = date('Y-m-d', strtotime(SET_CURRENT_DATE . '-'.($dayOfTheWeek+7).' days'));

    return array($start, $end);
}

/**
 * 레벨에 따라서 해시 알고리즘으로 비밀번호를 암호화 한다
 * @param $string
 * @param $level
 * @return bool|string
 */
function makePasswordByHash($string, $level)
{
    return password_hash($string, PASSWORD_DEFAULT, ['COST' => $level]);
}

/**
 * true 이면 비밀번호를 다시 만든다.
 * @param $pass
 * @param $level
 * @return string
 */
function getNeedReHash($pass, $level)
{
    return password_needs_rehash(
        $pass,
        PASSWORD_DEFAULT,
        ['COST' => $level]
    );
}

/**
 * @param $name
 * @return null|string
 */
function getDataByPost($name){
    return (trim(filter_input(INPUT_POST, ''.$name.'', FILTER_SANITIZE_MAGIC_QUOTES)) == '') ?
        null : trim(filter_input(INPUT_POST, ''.$name.'', FILTER_SANITIZE_MAGIC_QUOTES));
}

/**
 * @param $name
 * @return null|string
 */
function getDataByGet($name){
    return (trim(filter_input(INPUT_GET, ''.$name.'', FILTER_SANITIZE_MAGIC_QUOTES)) == '') ?
        null : trim(filter_input(INPUT_GET, ''.$name.'', FILTER_SANITIZE_MAGIC_QUOTES));
}

/**
 * 이미지 네이밍 변환시 확장자명을 추가
 * @param $target
 * @return string
 */
function getImageType($target){
    $num = exif_imagetype( $target );
    if($num === 1){
        return '.gif';
    }else if($num === 2){
        return '.jpg';
    }else if($num === 3){
        return '.png';
    }
    return '';
}

/**
 * 이미지인지 여부를 판별하는 로직을 구현
 * @param $image
 * @return bool
 */
function validateImage($image){
    if(getImageType($image) == ''){
        return false;
    }
    return true;
}

/**
 * 파일 이미지 이름 변경
 * @param $companyId
 * @param $swatch_type
 * @param $target
 * @return string
 */
function makeNewImageFileName($companyId, $target){
    return date("Ymd") . '_' . $companyId  . '_' . md5($target) . getImageType($target);
}

/**
 * @param $target
 * @return string
 */
function makeNewImageName($target){
    return date("Ymd") . '_'. md5($target) . getImageType($target);
}

/**
 * 숫자 콤마
 * @param $num
 * @return string
 */
function separateCommaNumber($num){
    return number_format($num);
}


/**
 * @param $date
 * @param null $splitter
 * @return string
 * @throws Exception
 */
function setDate($date, $splitter=null){
    if($splitter === null){
        $splitter='-';
    }
    $datetime = new DateTime($date);
    return $datetime->format('Y'.$splitter.'m'.$splitter.'d');
}

/**
 * @param $date
 * @return string
 * @throws Exception
 */
function setDateTime($date){
    $datetime = new DateTime($date);
    return $datetime->format('Y-m-d H:i:s');
}

/**
 * @param $date
 * @return string
 * @throws Exception
 */
function setTime($date){
    $datetime = new DateTime($date);
    return $datetime->format('H:i:s');
}

/**
 * @param $format
 * @return string
 * @throws Exception
 */
function getToday($format){
    return (new DateTime())->format($format);
}

/**
 * @param $tel
 * @return null|string|string[]
 */
function add_hyphen($tel)
{
    $tel = preg_replace("/[^0-9]/", "", $tel);    // 숫자 이외 제거
    if (substr($tel,0,2)=='02')
        return preg_replace("/([0-9]{2})([0-9]{3,4})([0-9]{4})$/", "\\1-\\2-\\3", $tel);
    else if (strlen($tel)=='8' && (substr($tel,0,2)=='15' || substr($tel,0,2)=='16' || substr($tel,0,2)=='18'))
        // 지능망 번호이면
        return preg_replace("/([0-9]{4})([0-9]{4})$/", "\\1-\\2", $tel);
    else
        return preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/", "\\1-\\2-\\3", $tel);
}

/**
 * @param $memo
 * @param $date
 * @param $employee_id
 * @return string
 */
function separateMemo($memo, $date, $employee_id){
    if(empty($memo)){
        return "<div class='center'>-</div>";
    }
    $memo_array=explode("{}", $memo);
    $memo_dt_array=explode("{}", $date);
    $memo_employee_array=explode("{}", $employee_id);
    $memo_size=count($memo_array);
    $ret_str="";

    if($memo_size > 0){
        for($i=0;$i<$memo_size;$i++){
            $memo=$memo_array[$i];
            $date=$memo_dt_array[$i];
            $employee_id=$memo_employee_array[$i];
            $ret_str .= "<div>$date <i class='fa fa-arrow-circle-o-right'></i> $memo<small>($employee_id)</small></div>";
        }
    }

    return $ret_str;
}

/**
 * @param string $excel
 * @param int $company_id
 * @return string
 */
function changeExcelName(string $excel, int $company_id){
    return date("YmdHis") . '_' . $company_id . '_' .md5($excel);
}

/**
 * @param $phone
 * @return bool
 */
function checkPhoneType($phone){
    $tmp_phone=null;

    // 번호 중간에 있는 하이픈을 제거
    $tmp_phone = preg_replace("/[^0-9,.]/", "", $phone);

    //  번호인지만 검증
    if(!preg_match('/[0-9]/', $tmp_phone)){
        return false;
    }

    //  총자릿수가 7자리 미만이거나 11자리를 초과하는 경우 미처리 대상
    if(strlen($tmp_phone) < 7 or strlen($tmp_phone) > 11){
        return false;
    }


    return true;
}

/**
 * @param string $date
 * @return string
 */
function checkAvailableDate(string $date){
    if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
        return $date;
    }
    return NULL;
}

/**
 * @param $phone
 * @return string
 */
function hideLastPhoneNumber($phone){
    $new_phone="";
    $phone_arr = explode('-', $phone);
    $new_phone .= $phone_arr[0] . '-' . $phone_arr[1] . '-' . '****';
    return $new_phone;
}

/**
 * @return string|string[]|null
 */
function coupon_generator()
{
    $len = 16;
    $chars = "ABCDEFGHJKLMNPQRSTUVWXYZ123456789";

    srand((double)microtime()*1000000);

    $i = 0;
    $str = "";

    while ($i < $len) {
        $num = rand() % strlen($chars);
        $tmp = substr($chars, $num, 1);
        $str .= $tmp;
        $i++;
    }

    $str = preg_replace("/([0-9A-Z]{4})([0-9A-Z]{4})([0-9A-Z]{4})([0-9A-Z]{4})/”, “\1-\2-\3-\4", $str);

    return $str;
}

/**
 * @param $imgTypeInfo
 * @return mixed|string
 */
function checkValidImg($imgTypeInfo){
    $img_type=replaceStringInNames('image/', '', $imgTypeInfo);


    //error_log($img_type);

    if($img_type !== 'png' and $img_type !== 'jpg' and $img_type !== 'jpeg' and $img_type !== 'gif'){
        return '';
    }

    return $img_type;
}

/**
 * @param $newFileName
 * @param $img_type
 * @param $dst_type
 * @return mixed|string
 */
function changeImageExt($newFileName, $img_type, $dst_type){
    $newImgName="";

    if($img_type === 'png'){
        $newImgName=replaceStringInNames('.png',".$dst_type", $newFileName);
    }else if($img_type == 'jpg'){
        $newImgName=replaceStringInNames('.jpg',".$dst_type", $newFileName);
    }else if($img_type == 'jpeg'){
        $newImgName=replaceStringInNames('.jpeg',".$dst_type", $newFileName);
    }else if($img_type == 'gif'){
        $newImgName=replaceStringInNames('.gif',".$dst_type", $newFileName);
    }

    return $newImgName;
}

/**
 * @param $pattern
 * @param $replacement
 * @param $target
 * @return mixed
 */
function replaceStringInNames($pattern, $replacement, $target){
    return str_replace($pattern, $replacement, $target);
}


// /", /'  를 대체할 수 있도록 처리
function replaceQuotationMark($target){
    $tmp_str=replaceStringInNames('\"','"', $target);
    $tmp_str2=replaceStringInNames("\'","'", $tmp_str);
    return $tmp_str2;
}


/**
 * @return false|int
 */
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

/**
 * @param string $data
 * @return mixed|string
 */
function receiveHtmlAndSpecialLetters(string $data){
    if(empty($data)){
        return null;
    }

    $tmp_data=html_entity_decode($data, ENT_QUOTES);
    return $tmp_data;
}

/**
 * @param string $data
 * @return |null
 */
function readHtmlAndSpecialLetters(string $data){
    if(empty($data)){
        return null;
    }

    $tmp_data=html_entity_encode($data, ENT_QUOTES);
    return $tmp_data;
}


function getDataFromAPI($url){
    return json_decode(file_get_contents($url));
}

/**
 * @return mixed|null
 */
function getCompanyId(){
    if(empty($_SESSION['company_id'])){
        return null;
    }

    return $_SESSION['company_id'];
}

function getUserName(){
    return $_SESSION['username'];
}

/***
 * @param int $rate => 노출정도
 * @param string $str => 대상
 * @return string
 */
function hideInfoWithString(int $rate, string $str){
    $totalStrCount=strlen($str); // 총 문자 개수
    $hideStrCount=round($totalStrCount*($rate/100)); // 최종 숨겨야할 문자 개수
    $ret_str='';

    $str_arr=str_split($str);

    for($i=0,$size=count($str_arr);$i<$size;$i++){
        if($i < $hideStrCount){
            $ret_str .= $str_arr[$i];
        }else{
            $ret_str .= '*';
        }
    }

    return $ret_str;
}

/**
 * @param $a
 * @param $b
 * @return bool
 */
function checkContainLetter($a, $b){
    if(strpos($a, $b) !== false) {
        return true;
    } else {
        return false;
    }
}