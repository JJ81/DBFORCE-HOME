<?php
require_once ('commons/config.php');
require_once("./commons/utils.php");
require_once("./autoload.php");


?>
<!doctype html>
<html class="no-js" lang="ko">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo TITLE;?></title>
    <meta name="description" content="진화하는 고객관리시스템, 디비포스DBFORCE">
    <meta name="keyword" content="CRM, 고객관리시스템, 디비포스, DBFORCE, 유사투자자문, 대부중개업, 보험, 대출, 핸드폰, 인터넷, 모바일" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="제이코퍼레이션" />
    <meta name="naver-site-verification" content="38eec51f54fdd514bbe0247135b4c2cc2a90ae7e"/>
    <meta name="google-site-verification" content="KKNtMEQG0B43jDvm8aWQOwap2YWV8M_dpw4ww3E9ES0" />
    <link rel="shortcut icon" href="/assets/favicon.png?v=<?php echo VERSION;?>" type="image/x-icon" />
    <link rel="canonical" href="<?php echo SITE_URL;?>" />
    <!-- CSS
    ========================= -->

    <meta property="og:title" content="<?php echo TITLE;?>" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?php echo SITE_URL;?>" />
    <meta property="og:image" content="/assets/preview.jpg?v=<?php echo VERSION;?>" />
    <meta property="og:description" content="<?php echo DESCRIPTION;?>" />
    <meta property="og:image:width" content="185" />
    <meta property="og:image:height" content="185" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="<?php echo TITLE;?>" />
    <meta name="twitter:url" content="<?php echo SITE_URL;?>" />
    <meta name="twitter:image" content="/assets/preview.jpg?v=<?php echo VERSION;?>" />
    <meta name="twitter:description" content="<?php echo DESCRIPTION;?>" />


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css?v=<?php echo VERSION;?>">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css?v=<?php echo VERSION;?>">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo VERSION;?>">

    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js?v=<?php echo VERSION;?>"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JC1F73CDBT"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-JC1F73CDBT');
    </script>
</head>

<body>

<div class="fakeloader"></div>

<!-- Main Wrapper Start -->
<div class="main-wrapper">
    <!-- header-area start -->
    <header class="header header-sticky">
        <!-- header Top start -->
        <div id="main-menu" class="header-top-2 inner-header">
            <div class="container">
                <div class="row header-top-inner">
                    <div class="col-lg-4">
                        <div class="logo">
                            <a href="/">
                                <img src="assets/images/logo/logo_white_shadow.png" alt="" width="160" />
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <!-- Main Menu Start -->
                        <div class="main-menu">
                            <nav class="main-navigation">
                                <ul>
                                    <li class="active"><a href="#slider">메인</a></li>
                                    <li><a href="#feature">서비스</a></li>
                                    <li class="smooth-scroll"><a href="#about">운영정책</a></li>
                                    <li><a href="#pricing">가격정책</a></li>
                                    <li><a href="#testimonial">사용후기</a></li>
                                    <li><a href="#faq">FAQ</a></li>
                                    <li><a href="#team">파트너</a></li>
                                    <li><a href="#contact">무료체험신청</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Main Menu End -->
                    </div>
                    <div class="col">
                        <!-- mobile-menu start -->
                        <div class="mobile-menu d-block d-lg-none"></div>
                        <!-- mobile-menu end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Top end -->
    </header>
    <!-- Header-area end -->

    <!-- Hero Slider Start -->
    <div class="hero-slider  hero-slider-1" id="slider">
        <div class="single-slide " style="background-image: url('assets/images/slider/slider-03.png')">
            <!-- Hero Content One Start -->
            <div class="hero-content-one container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slider-text-info text-white text-center">
                            <h4>고객관리시스템 CRM</h4>
                            <h1>디비포스 - <span>스마트한 고객관리가<br /> 매출향상의 지름길이 됩니다.</span></h1>
                            <div class="slider-button">
                                <a href="#feature" class="slider-btn theme-btn">더 알아보기</a>
                                <a href="#contact" class="slider-btn white-btn">무료체험신청</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hero Content One End -->
        </div>
    </div>
    <!-- Hero Slider End -->

    <!-- Slider Screenshort Start -->
    <div class="slider-screenshort">
        <div class="container">
            <div class="row slider-screenshot-active">
                <div class="col-lg-12">
                    <!-- Singel Screenshot Start -->
                    <div class="singel-screenshot">
                        <img src="assets/images/service/display_01.jpg" alt="" />
                    </div>
                    <!-- Singel Screenshot End -->
                </div>
                <div class="col-lg-12">
                    <!-- Singel Screenshot Start -->
                    <div class="singel-screenshot">
                        <img src="assets/images/service/display_02.jpg" alt="" />
                    </div>
                    <!-- Singel Screenshot End -->
                </div>
                <div class="col-lg-12">
                    <!-- Singel Screenshot Start -->
                    <div class="singel-screenshot">
                        <img src="assets/images/service/display_03.jpg" alt="" />
                    </div>
                    <!-- Singel Screenshot End -->
                </div>
                <div class="col-lg-12">
                    <!-- Singel Screenshot Start -->
                    <div class="singel-screenshot">
                        <img src="assets/images/service/display_04.jpg" alt="" />
                    </div>
                    <!-- Singel Screenshot End -->
                </div>

            </div>
        </div>
    </div>
    <!-- Slider Screenshort End -->

    <!-- Feature Area Start -->
    <div class="feature-area section-pt section-pb-70" id="feature">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 ml-auto mr-auto">
                    <div class="section-title">
                        <h2>주요서비스 <span> - What We Offer</span></h2>
                        <p>아래와 같은 내용으로 고객관리시스템 디비포스DBFORCE 서비스가 제공됩니다.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <!-- Signle Feature Area Start -->
                    <div class="signle-feature">
                        <div class="feature-icon">
                            <span class="bi bi-bond"></span>
                        </div>
                        <div class="feature-content">
                            <h3>역할 분리</h3>
                            <p>최고관리자, 관리자, 팀장, 영업사원, 전문가 등 역할에 따라 분리된 계정을 생성하여 사용하여 각 역할에 맞게 충실히 운영하게 됩니다.</p>
                        </div>
                    </div>
                    <!-- Signle Feature Area End -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <!-- Signle Feature Area Start -->
                    <div class="signle-feature">
                        <div class="feature-icon">
                            <span class="bi bi-finger-print"></span>
                        </div>
                        <div class="feature-content">
                            <h3>보안</h3>
                            <p>등록한 IP주소에서만 접근이 가능하도록 설정이 가능하며 모든 고객사의 데이터베이스와 서버가 분리되어 운영됩니다.</p>
                        </div>
                    </div>
                    <!-- Signle Feature Area End -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <!-- Signle Feature Area Start -->
                    <div class="signle-feature">
                        <div class="feature-icon">
                            <span class="bi bi-rocket2"></span>
                        </div>
                        <div class="feature-content">
                            <h3>높은 생산성 향상</h3>
                            <p>각 업종에 맞는 최적화된 다양한 기능이 정기적으로 업데이트 됨으로써 업무상으로 높은 생성성이 추구할 수 있습니다.</p>
                        </div>
                    </div>
                    <!-- Signle Feature Area End -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <!-- Signle Feature Area Start -->
                    <div class="signle-feature">
                        <div class="feature-icon">
                            <span class="bi bi-globe3"></span>
                        </div>
                        <div class="feature-content">
                            <h3>증명된 IT기술</h3>
                            <p>안정성이 높은 IT기술을 바탕으로 제작된 웹기반 소프트웨어를 공급받게 됩니다. 브라우저만 있으면 어디서나 업무를 볼 수 있습니다.</p>
                        </div>
                    </div>
                    <!-- Signle Feature Area End -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <!-- Signle Feature Area Start -->
                    <div class="signle-feature">
                        <div class="feature-icon">
                            <span class="bi bi-support"></span>
                        </div>
                        <div class="feature-content">
                            <h3>Support & Faq</h3>
                            <p>추가 비용없이 편의 기능을 건의하여 사용하실 수 있으며, 서비스 사용시 궁금한 점이나 장애 해결 등을 실시간 채팅을 통해서 지원해 드립니다.</p>
                        </div>
                    </div>
                    <!-- Signle Feature Area End -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <!-- Signle Feature Area Start -->
                    <div class="signle-feature">
                        <div class="feature-icon">
                            <span class="bi bi-group"></span>
                        </div>
                        <div class="feature-content">
                            <h3>동종업계 뉴스</h3>
                            <p>빠르게 변화하는 시장상황이나 관련법에 따라 대응해야 하는 여러 가지 상황에 대해서 동종업계의 최신 소식을 공유 받으실 수 있습니다.</p>
                        </div>
                    </div>
                    <!-- Signle Feature Area End -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <!-- Signle Feature Area Start -->
                    <div class="signle-feature">
                        <div class="feature-icon">
                            <span class="bi bi-graph-bar"></span>
                        </div>
                        <div class="feature-content">
                            <h3>손쉬운 매출관리</h3>
                            <p>영업사원의 매출기여도 등을 실시간을 확인하고 의욕을 고취하여 더욱 더 열심히 영업을 진행할 수 있도록 대시보드가 제공됩니다.</p>
                        </div>
                    </div>
                    <!-- Signle Feature Area End -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <!-- Signle Feature Area Start -->
                    <div class="signle-feature">
                        <div class="feature-icon">
                            <span class="bi bi-cloud-up"></span>
                        </div>
                        <div class="feature-content">
                            <h3>소프트웨어 버전별 유지</h3>
                            <p>안정적 사용을 위하여 사용하시는 소프트웨어의 버전을 고정으로 혹은 업데이트하여 사용하실 수가 있습니다.</p>
                        </div>
                    </div>
                    <!-- Signle Feature Area End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Area End -->

    <!-- About Area Start -->
    <div class="about-area  bg-grey section-ptb" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 order-1 order-lg-2">
                    <div class="about-image text-center">
                        <img src="assets/images/service/policy.jpg" alt="" />
                        <div class="about-video-button">
<!--                            <a href="https://www.youtube.com/watch?v=0O2aH4XLbto" class="video-btn popup-youtube"><i class="fa fa-play"></i></a>-->
<!--                            <div class="video-animation">-->
<!--                                <div class="animation animation-1"></div>-->
<!--                                <div class="animation animation-2"></div>-->
<!--                                <div class="animation animation-3"></div>-->
<!--                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12  order-2 order-lg-1">
                    <div class="about-content-inner">
                        <div class="about-title">
                            <h4>DBFORCE POLICY</h4>
                            <h2>운영정책<span> - What We Serve</span></h2>
                        </div>
                        <div class="about-text">
                            <p>각 업계에 맞춤으로 제작된 고객관리시스템 디비포스DBFORCE는 <u>정기적으로 진화하는 서비스</u>로서 제공됩니다.
                                저희 서비스를 사용하시는 모든 고객사는 추가 기능 요청 및 기능 개선에 대한 건의를 하실 수 있습니다.
                                디비포스는 <u>고객사의 의견을 수렴하여 끊임없이 업그레이드가 되어 보다 나은 서비스를 제공</u>해 드립니다.</p>
                        </div>
                        <!-- Project Count Area Start -->
                        <div class="project-count-area">
                            <div class="project-count-inner">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4">
                                        <!-- counter start -->
                                        <div class="counter">
                                            <h3 class="counter-active">241</h3>
                                            <small>(건)</small>
                                            <p>접수된 요청</p>
                                        </div>
                                        <!-- counter end -->
                                    </div>
                                    <div class="col-lg-4 col-sm-4">
                                        <!-- counter start -->
                                        <div class="counter">
                                            <h3 class="counter-active">117</h3>
                                            <small>(개)</small>
                                            <p>고객사</p>
                                        </div>
                                        <!-- counter end -->
                                    </div>
                                    <div class="col-lg-4 col-sm-4">
                                        <!-- counter start -->
                                        <div class="counter">
                                            <h3 class="counter-active">97</h3>
                                            <small>(%)</small>
                                            <p>고객만족도</p>
                                        </div>
                                        <!-- counter end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Project Count Area End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Area End -->

    <!-- Priceing Package Area Start -->
    <div class="priceing-package-area section-pt section-pb-70" id="pricing">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 ml-auto mr-auto">
                    <div class="section-title">
                        <h2>가격정책 <span>- The Best For You</span></h2>
                        <p>서비스의 상세 사양을 회사의 상황에 맞는 살펴보시고 결정하세요.<br />
                            만약 서비스 선택에 대한 상담이 필요하시면 <a href="mailto:info@jcorporationtech.com">이메일(info@jcorporationtech.com)</a>이나
                            <a href="https://pf.kakao.com/_xjBDxgxl/chat" target="_blank">카카오톡(@JCORP)</a> 혹은 <a
                                    href="tel:1833-7835">대표번호(1833-7835)</a> 등으로 연락주시기 바랍니다.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Single Price Package Start -->
                    <div class="single-price-package priceing-bg mb--30">
                        <div class="price-title">
                            <h4>Light</h4>
                            <h2>기본형 서비스</h2>
                        </div>
                        <div class="price-list">
                            <ul>
                                <li>계정 생성 무제한</li>
                                <li>정기 기능 업데이트</li>
                                <li>데이터베이스 용량 무제한</li>
                                <li>추천: 대부중개,핸드폰,렌트카,인터넷 등</li>
                                <li>
                                    <strong>월 5만원</strong>
                                </li>
                            </ul>
                        </div>
                        <div class="price-btn">
                            <a href="#contact" class="button">Buy Now</a>
                        </div>
                    </div>
                    <!-- Single Price Package End -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Single Price Package Start -->
                    <div class="single-price-package priceing-bg mb--30 active">
                        <div class="price-title">
                            <h4>Standard</h4>
                            <h2>표준형 서비스</h2>
                        </div>
                        <div class="price-list">
                            <ul>
                                <li>계정성생 무제한</li>
                                <li>정기 기능 업데이트</li>
                                <li>데이터베이스 용량 무제한</li>
                                <li>추천: (유사)투자자문</li>
                                <li><strong>월 12만원</strong></li>
                            </ul>
                        </div>
                        <div class="price-btn">
                            <a href="#contact" type="button" class="button">Buy Now</a>
                        </div>
                    </div>
                    <!-- Single Price Package End -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Single Price Package Start -->
                    <div class="single-price-package priceing-bg mb--30">
                        <div class="price-title">
                            <h4>Premium</h4>
                            <h2>맞춤형 프리미엄 서비스</h2>
                        </div>
                        <div class="price-list">
                            <ul>
                                <li>요청에 따른 스펙 결정</li>
                                <li>정기 유지 보수</li>
                                <li>추후 기능 추가 가능</li>
                                <li>추천: 고객사 맞춤형 스펙</li>
                                <li><strong>1,000만원부터~ </strong>(1회납)</li>
                            </ul>
                        </div>
                        <div class="price-btn">
                            <a href="#contact" class="button">Buy Now</a>
                        </div>
                    </div>
                    <!-- Single Price Package End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Priceing Package Area End -->

    <!-- Subscribe Area Start -->
    <div class="subscribe-area subscribe-bg section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 ml-auto mr-auto">
                    <div class="subscribe-title text-center">
                        <h2>디비포스에 대한 최신 뉴스</h2>
                        <p>디비포스에 대한 최신 뉴스레터를 받기 원하신다면 메일 주소를 남겨주세요.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6  ml-auto mr-auto">
                    <div class="subscribe-form-area">
                        <form action="/api/mail/send_mail.php" class="subscribe-form-inner" method="post">
                            <input type="email" name="email" placeholder="이메일 입력" required />
                            <button class="subscribe-btn"><i class="fa fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Subscribe Area End -->

    <!-- Testimonial Area Start -->
    <div class="testimonial-area section-ptb" id="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 ml-auto mr-auto">
                    <div class="section-title">
                        <h2>고객사 사용 후기 <span>- Our client's say</span></h2>
                        <p>아래는 디비포스 서비스를 꾸준히 이용해 주시는 고객사의 후기입니다.</p>
                    </div>
                </div>
            </div>
            <div class="row testimonial-active">
                <div class="col-lg-4">
                    <div class="testimonial-content">
                        <!-- single-testimonial start -->
                        <div class="single-testimonial">
                            <div class="client-say">
                                <p>매우 합리적인 가격정책이 마음에 들어 선택하게 되었습니다.</p>
                            </div>
                            <div class="client-author">
                                <h4>오름****</h4>
                            </div>
                        </div>
                        <!-- single-testimonial end -->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-content">
                        <!-- single-testimonial start -->
                        <div class="single-testimonial">
                            <div class="client-say">
                                <p>덕분에 빠르게 월 10억 매출상승을 달성할 수 있었습니다. 감사합니다!</p>
                            </div>
                            <div class="client-author">
                                <h4>한국**투자**</h4>
                            </div>
                        </div>
                        <!-- single-testimonial end -->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-content">
                        <!-- single-testimonial start -->
                        <div class="single-testimonial">
                            <div class="client-say">
                                <p>사업 전반적으로 도움을 주셔서 정말 감사합니다.</p>
                            </div>
                            <div class="client-author">
                                <h4>시크*투***</h4>
                            </div>
                        </div>
                        <!-- single-testimonial end -->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-content">
                        <!-- single-testimonial start -->
                        <div class="single-testimonial">
                            <div class="client-say">
                                <p>매번 기능 업데이트가 정말 좋은 것 같아요. 앞으로도 잘 부탁드립니다.</p>
                            </div>
                            <div class="client-author">
                                <h4>해피*****</h4>
                            </div>
                        </div>
                        <!-- single-testimonial end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial Area End -->

    <!-- Frequently Asked Question Area Start -->
    <div class="frequently-question-area section-pb" id="faq">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 ml-auto mr-auto">
                    <div class="section-title">
                        <h2>Faq <span>- Answer & Question </span></h2>
                        <p>디비포스에 대한 자주 묻는 질문에 대한 답변입니다.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="question-content-wrap">
                        <div class="faequently-area-inner">
                            <div class="faequently-accordion">
                                <!--panel body start-->
                                <h4 class="open">디비포스를 사용하고 싶은데 절차가 어떻게 되나요?</h4>
                                <div class="faequently-description">
                                    <p>연락처와 이메일 주소 등을 남겨주시면 서비스 계약서를 전달드리게 됩니다. 현금영수증이나 세금계산서를 발급해 드리고 있으며 사용시작일은 고객사의 요청에 맞게 설정해 드립니다.</p>
                                </div>
                                <!--panel body end-->
                                <!--panel body start-->
                                <h4>데모버전(무료체험)버전을 사용해 볼 수 있을까요?</h4>
                                <div class="faequently-description">
                                    <p>저희는 고객사가 미리 사용해 보고 결정하실 수 있도록 항상 최신 버전의 무료체험 버전을 준비해 놓고 있습니다. 문의를 남겨주시면 빠르게 무료체험을 하실 수 있도록 정보를 제공해 드리겠습니다.</p>
                                </div>
                                <!--panel body end-->
                                <!--panel body start-->
                                <h4>기본 계약 조건은 어떻게 되나요?</h4>
                                <div class="faequently-description">
                                    <p>최소 계약 기간은 6개월 단위로 진행하게 됩니다. 6개월이 경과하면 갱신계약을 진행하개 됩니다. 3개월분이 선납조건이 되며 4~6회차는 저희가 발송드리는 이용청구서를 확인하신 후에 결제해 주시면 됩니다.</p>
                                </div>
                                <!--panel body end-->
                                <!--panel body start-->
                                <h4>기능 추가를 요청하면 제작비용이 발생하나요?</h4>
                                <div class="faequently-description">
                                    <p>디비포스는 고객사의 기능 추가 요청에 대해서 어떠한 비용도 청구하지 않습니다. (단, 자사 맞춤형 프리미엄 제작 서비스의 경우는 예외)</p>
                                </div>
                                <!--panel body end-->
                                <!--panel body start-->
                                <h4>계정은 몇 개까지 생성이 가능한가요?</h4>
                                <div class="faequently-description">
                                    <p>추가 요금 없이 무제한으로 계정을 생성할 수 있습니다. 다만, 기본적으로 설정해 드리는 서버의 스펙을 넘어서는 사용량이 발생할 경우, 서버 스펙 상향 조정에 대한 과금이 부과될 수 있습니다.</p>
                                </div>
                                <!--panel body end-->
                                <!--panel body start-->
                                <h4>보안은 믿을 만한가요?</h4>
                                <div class="faequently-description">
                                    <p>저희는 고객사의 동의없이 데이터베이스의 중요한 정보에 대한 접근을 하지 하지 않습니다. 또한 타사 서비스와는 달리 각 고객사의 서버와 데이터베이스를 분리하여 운영 및 관리하므로 상대적으로 안전합니다. 도메인 및 주소 등은 검색이 될 수 없도록 처리되어 제공됩니다.</p>
                                </div>
                                <!--panel body end-->
                                <!--panel body start-->
                                <h4>신청하면 바로 사용이 가능한가요?</h4>
                                <div class="faequently-description">
                                    <p>계약서 작성 및 초기 이용료를 납부해 주시면 1~2일 내에 사용이 가능하게 됩니다.</p>
                                </div>
                                <!--panel body end-->
                                <!--panel body start-->
                                <h4>디비포스 외에 홈페이지나 랜딩페이지 제작도 해 주시나요?</h4>
                                <div class="faequently-description">
                                    <p>업종별 홈페이지 및 랜딩페이지를 제작해 드리고 있습니다. 여러 제작 사례를 통해서 안내를 해 드리고 있으며 별도로 문의주시기 바랍니다.</p>
                                </div>
                                <!--panel body end-->
                                <!--panel body start-->
                                <h4>회사가 커져서 본점과 여러 지점 등으로 나뉘게 되었어요? 어떻게 해야 하나요?</h4>
                                <div class="faequently-description">
                                    <p>디비포스 1계약당 1개의 회사에서 사용이 가능합니다. 기본적으로 데이터베이스가 하나의 서버에서 관리가 되기 때문에 만약 사업상 명확한 분리가 필요하시다면 별도의 계약을 진행해 주시면 됩니다. 혹은 데이터베이스의 분리가 필요 없을 경우, 서버의 스펙만 상향 조정하여 사용이 가능합니다.</p>
                                </div>
                                <!--panel body end-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="question-image">
                        <img src="assets/images/service/faq.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Frequently Asked Question Area End -->

    <!-- Our Client Start -->
    <div class="our-team-area bg-grey section-pt section-pb-70" id="team">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 ml-auto mr-auto">
                    <div class="section-title">
                        <h2>주요 파트너사 <span>- Our Partners </span></h2>
                        <p>디비포스DBFORCE를 사용하시는 주요 파트너사입니다.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single-team mb--30">
                        <div class="team-imgae">
                            <img src="assets/images/partner/partner_01.jpg" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-team mb--30">
                        <div class="team-imgae">
                            <img src="assets/images/partner/partner_02.jpg" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-team mb--30">
                        <div class="team-imgae">
                            <img src="assets/images/partner/partner_03.jpg" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-team mb--30">
                        <div class="team-imgae">
                            <img src="assets/images/partner/partner_04.jpg" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Team Aare End -->

    <!-- Contact Area Start -->
    <div class="contact-area section-ptb" id="contact">
        <div class="container">
            <div class="row no-gutters align-items-center">
                <div class="col-lg-6">
                    <div class="contact-information">
                        <div class="contact-info">
                            <div class="contact-title">
                                <h2>서비스/무료체험 신청</h2>
                                <p>좀 더 자세한 문의사항에 대해서 접수해 남겨주시면 성심성의껏 답변해 드리도록 하겠습니다.</p>
                            </div>
                            <div class="contact-address">
                                <ul>
                                    <li><i class="fa fa-phone"></i> <span class="information"><a href="tel:1833-7835">1833-7835</a></span></li>
                                    <li><i class="fa fa-envelope-o"></i> <span class="information"><a href="mailto:info@jcorporationtech.com">info@jcorporationtech.com</a></span></li>
                                    <li><i class="fa fa-comment"></i> <span class="information"><a href="https://pf.kakao.com/_xjBDxgxl" target="_blank">카카오채널 @JCORP</a></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form class="contact-form-area" action="/api/mail/send_mail2.php" method="post" id="contact-form">
                        <div class="row contact-form">
                            <div class="form-group col-md-12">
                                <input name="name" class="form-control" placeholder="상호명/성명" type="text" id="name">
                            </div>
                            <div class="form-group col-md-12">
                                <input name="tel" class="form-control" placeholder="휴대전화번호 (- 포함)" type="tel" id="phone">
                            </div>
                            <div class="form-group col-md-12">
                                <input name="email" class="form-control" placeholder="이메일" type="email" id="subject">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="message" class="문의사항 form-control" placeholder="문의내용"></textarea>
                            </div>
                            <div class="submit-form form-group col-sm-12">
                                <button class="button submit-btn" type="submit"><span>보내기</span></button>
                                <p class="form-messege"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Area End -->



    <!-- Footor Area Start -->
    <footer class="footer-area footer-bg">
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="social-link">
                            <ul>
                                <li><a href="#" target="_blank">Blog</a></li>
                                <li><a href="#" target="_blank">Instagram</a></li>
                                <li><a href="#" target="_blank">Facebook</a></li>
                                <li><a href="#" target="_blank">Youtube</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="copy-right">
                            Copyright &copy; JCORPORATIONTECH 2016. All Right Reserved
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footor Area End -->
</div>
<!-- Main Wrapper End -->

<!-- JS
============================================ -->

<!-- jQuery JS -->
<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
<!-- Popper JS -->
<script src="assets/js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Plugins JS -->
<script src="assets/js/plugins.js"></script>
<!-- Ajax Mail -->
<script src="assets/js/ajax-mail.js?v=<?php echo VERSION;?>"></script>
<!-- Main JS -->
<script src="assets/js/main.js?v=<?php echo VERSION;?>"></script>


</body>

</html>