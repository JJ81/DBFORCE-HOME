<?php

session_start();

if(!empty($_SESSION['expire']))
{
    $now = time(); // Checking the time now when home page starts.

    if($now < $_SESSION['expire']){
        // 남은 시간이 5분이하일 경우 만료시간을 현재 시간 기준으로 30분 추가
        if( abs($now - $_SESSION['expire']) <= 60*5){
            $_SESSION['expire'] = $now+60*30; // 30분 추가
        }

    } else if($now >= $_SESSION['expire']) {
        session_destroy();
        //AlertMsgAndRedirectTo(ROOT . 'admin/', '로그인 세션 시간이 만료되었습니다. 다시 로그인하세요.');
        Redirect(ROOT);
        exit;
    }
}
