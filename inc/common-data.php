<?php
use JCORP\Business\Basics\BasicInfoService as Basic;
$basic=new Basic();

$company_id=1; // 설정시 강제세팅값필요
$info=$basic->getBasicInfoByCompany_id($company_id);

// 1. 오늘날짜의 월과 일을 추출하기
$today=getToday('m-d');
$today_month=date('m');
$today_day=date('d');

// 2. 공지사항 가져오기
use JCORP\Business\Notice\NoticeService as Notice;
$notice=new Notice();
$notice_lists=$notice->getList(0, 3); // 최신글 3개

// 3. 무료체험신청현황 데이터 가져오기
use JCORP\Business\Free\FreeExpService as FreeExp;
$free_exp=new FreeExp();
$free_req_lists=$free_exp->getListBySize(10);