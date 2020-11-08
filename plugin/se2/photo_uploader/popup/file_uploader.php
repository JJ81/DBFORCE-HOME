<?php
// default redirection
$url = $_REQUEST["callback"].'?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

// SUCCESSFUL
if(bSuccessUpload) {
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];
	
	$filename_ext = strtolower(array_pop(explode('.',$name)));
	$allow_file = array("jpg", "png", "bmp", "gif");
	
	if(!in_array($filename_ext, $allow_file)) {
		$url .= '&errstr='.$name;
	} else {
		//$uploadDir = '../../upload/'; 기존 설정위치
        //$uploadDir = '../../assets/uploads/'; // 새 설정 위치

        $uploadDir = '../../assets/uploads/images/'; // 새 설정 위치
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}
		
		// $newPath = $uploadDir . urlencode($_FILES['Filedata']['name']); // TODO 이미지명을 변경하기 위해 기존 코드를 주석처리 함.
		$newPath = $uploadDir . makeNewImageName(urlencode($_FILES['Filedata']['name']));

		@move_uploaded_file($tmp_name, $newPath);
		
		$url .= "&bNewLine=true";
		$url .= "&sFileName=".urlencode(urlencode($name));
		$url .= "&sFileURL=upload/".urlencode(urlencode($name));
	}
}
// FAILED
else {
	$url .= '&errstr=error';
}
	
header('Location: '. $url);
?>