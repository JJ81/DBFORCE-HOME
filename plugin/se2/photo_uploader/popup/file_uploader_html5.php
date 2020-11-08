<?php
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

function makeNewImageFileName($companyId, $target, $imgType){
    return date("Ymd") . '_' . $companyId  . '_' . md5($target)  . "." . $imgType;
}

    $sFileInfo = '';
	$headers = array();
	 
	foreach($_SERVER as $k => $v) {
		if(substr($k, 0, 9) == "HTTP_FILE") {
			$k = substr(strtolower($k), 5);
			$headers[$k] = $v;
		} 
	}
	
	$file = new stdClass;
	$file->name = str_replace("\0", "", rawurldecode($headers['file_name']));
	$file->size = $headers['file_size'];
	$file->content = file_get_contents("php://input");

    // PHP Notice:  Only variables should be passed by reference in
	$filename_ext = strtolower(array_pop(explode('.',$file->name)));
	$allow_file = array("jpg", "png", "bmp", "gif"); 
	
	if(!in_array($filename_ext, $allow_file)) {
		echo "NOTALLOW_".$file->name;
	} else {
		//$uploadDir = '../../upload/';
        $uploadDir = '../../../../upload/'; // TODO 경로를 변경해야 함.
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}
		

        $newImageName=makeNewImageFileName(1, $file->name, $filename_ext);
		//$newPath = $uploadDir.iconv("utf-8", "cp949", $file->name);
		$newPath = $uploadDir.iconv("utf-8", "cp949", $newImageName);


        if(file_put_contents($newPath, $file->content)) {
            $sFileInfo .= "&bNewLine=true";
            $sFileInfo .= "&sFileName=" . $newImageName;
            $sFileInfo .= "&sFileURL=$uploadDir" . $newImageName; // TODO 위치 변경이 필요함.
        }

//		if(file_put_contents($newPath, $file->content)) {
//			$sFileInfo .= "&bNewLine=true";
//			$sFileInfo .= "&sFileName=".$file->name;
//			$sFileInfo .= "&sFileURL=/upload/" . $file->name; // TODO 위치 변경이 필요함.
//		}
		
		echo $sFileInfo;
	}
?>