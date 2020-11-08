<meta charset="utf-8">
<meta name="Referrer" content="origin">
<meta name="referrer" content="always">
<meta name="author" content="제이코퍼레이션, JCORPORATIONTECH">
<?php if(isMobile()){ ?>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes">
<?php } else { ?>
    <meta name="viewport" content="width=1100" />
<?php } ?>

<meta name="description" content="<?php echo $info[0]['description'];?>">
<meta name="keyword" content="<?php echo $info[0]['keyword'];?>">
<meta property="og:title" content="<?php echo $info[0]['title'];?>">
<meta property="og:type" content="article">
<meta property="og:url" content="<?php echo $info[0]['service_url'];?>">
<meta property="og:image" content="<?php echo $info[0]['search_img'];?>?v=<?php echo $info[0]['deploy_version'];?>">

<meta property="og:image:width" content="185">
<meta property="og:image:height" content="185">

<meta property="og:description" content="<?php echo $info[0]['description'];?>">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="<?php echo $info[0]['title'];?>">
<meta name="twitter:url" content="<?php echo $info[0]['service_url'];?>">
<meta name="twitter:image" content="<?php echo $info[0]['search_img'];?>?v=<?php echo $info[0]['deploy_version'];?>">
<meta name="twitter:description" content="<?php echo $info[0]['description'];?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $info[0]['favicon'];?>?v=<?php echo $info[0]['deploy_version'];?>">

<meta name="naver-site-verification" content="<?php echo $info[0]['naver_verification_number'];?>">
<meta name="google-site-verification" content="<?php echo $info[0]['google_verification_number'];?>">
<link rel="canonical" href="<?php echo $info[0]['service_url'];?>">

<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo ROOT;?>assets/swiper.min.css" />
<!--<link rel="stylesheet" href="--><?php //echo ROOT;?><!--assets/styles.min.css?v=--><?php //echo $info[0]['deploy_version'];?><!--">-->
<link rel="stylesheet" href="<?php echo ROOT;?>assets/styles.css?v=<?php echo $info[0]['deploy_version'];?>">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<!-- 임시로 부트 스트랩을 사용한다. -->
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">-->

