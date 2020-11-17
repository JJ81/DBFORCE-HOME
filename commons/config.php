<?php
date_default_timezone_set('UTC');
date_default_timezone_set('Asia/Seoul');
define('SET_CURRENT_TIME', date('Y-m-d H:i:s', time()));
define('SET_CURRENT_DATE', date('Y-m-d', time()));
setlocale(LC_MONETARY, 'en_US');
define('ROOT', $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/');
define('SESS_DURATION', 60 * 60 * 8 * 100); // set 60min for expiry time 8h x 100
define('VERSION', "202010220938");
define('TITLE', "고객관리시스템, 디비포스");
define('SITE_URL', "http://dbforce.co.kr/");
define('DESCRIPTION', '매일 진화하는 고객관리시스템, 디비포스DBFORCE');

// define('EMAIL_RECEIVER', 'info@jcorporationtech.com');
// define("PHONE_NUMBER", "");
// define("SMS_RECEIVER", "");
//define('KAKAO_TALK', 'http://pf.kakao.com/_xgVCbK/chat');
//define('YOUTUBE_URL', 'https://www.youtube.com/channel/UCJCX0RWnzUvaJMjiJTYKvXQ');
//define('EVENT_PAGE_URL', 'http://event.keib.co.kr/');
//define('EVENT_PAGE_URL', 'http://promotion.keib.co.kr/');
//define('REPRESENTATIVE_NUMBER', '1566-8331');
//define('BANK_ACCOUNT', '123-4567-890');

// define('SMS_TEST_MODE', 'N');
define('CURRENT_URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

define('EXCEL_UPLOAD_PATH', $_SERVER['DOCUMENT_ROOT'] . "/admin/assets/excels/");
define('NOTICE_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/notice/"); // 고객센터
define('MEDIA_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/media/"); // 언론보도
define('NEWS_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/news/"); // 이용후기
define('PROFIT_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/profit/"); // 수익율
define('SOCIAL_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/social/"); // 사회공헌
define('MARKET_NEWS_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/market_news/"); // 장전시황
define('DAILY_NEWS_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/daily_news/"); // 일일시황
define('BRIEFING_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/briefing_news/"); // 전문가 브리핑
define('STOCK_SCHEDULE_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/stock_schedule/"); // 증시일정

define('REVIEW_PROFIT_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/review_profit/"); // 고객성공후기
define('INTERVIEW_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/interview/"); // 고객인터뷰
define('FAQ_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/faq/"); // 질문답변
define('MEMBER_PROFIT_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/member_profit/"); // 실시간수익인증
define('FREE_PROFIT_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/free_profit/"); // 무료 수익인증
define('VIP_PROFIT_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/vip_profit/"); // vip 수익인증
define('BEST_PROFIT_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/best_profit/"); // 베스트 수익인증

define('QNA_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/qna/"); // 질문답변 저장소
define('EVENT_IMG_PATH', $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/event/"); // 이벤트



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);