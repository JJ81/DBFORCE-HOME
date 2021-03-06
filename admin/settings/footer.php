<?php

require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');
define('PAGE','NOTICE');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

$company_id=$_SESSION['company_id'];

use JCORP\Business\Basics\BasicInfoService as Basic;
$basic=new Basic();
$row=$basic->getFooterInfo($company_id);
?>

<?php require_once ('../inc/head.php');?>

<body class="fix-header fix-sidebar">
<!-- Preloader - style you can find in spinners.css -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<!-- Main wrapper  -->
<div id="main-wrapper">
    <?php require_once ('../inc/header.php');?>
    <?php require_once ('../inc/leftmenu.php');?>

    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">푸터정보관리</h3></div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">푸터정보관리</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->

        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title clearfix">
                            <h4>푸터정보관리</h4>
                            <a href="javascript:window.history.back(-1);" class="btn btn-primary pull-right">뒤로</a>
                        </div>
                        <div class="card-body">
                            <!-- contents -->
                            <div class="_container">
                                <form action="./response/res_footer.php" method="post" class="form">
                                    <!-- smart editor -->
                                    <div>
                                        <textarea name="ir1"
                                                  id="ir1"
                                                  rows="10"
                                                  cols="100"
                                                  style="display:none;"><?php if(!empty($row[0]['footer'])) {echo html_entity_decode($row[0]['footer']);} ?></textarea>
                                    </div>
                                    <!-- // smart editor -->
                                    <div style="text-align: center;margin-top: 10px;">
                                        <button type="button" onclick="submitContents(this);" class="btn btn-primary">저장</button>
                                    </div>
                                </form>
                            </div>
                            <!-- // contents -->
                        </div>
                    </div>
                    <!-- /# card -->
                </div>
            </div>
            <!-- /# row -->
            <!-- End PAge Content -->
        </div>
        <!-- End Container fluid  -->

        <?php require_once ('../inc/footer.php'); ?>
    </div>
    <!-- End Page wrapper  -->
</div>
<!-- End Wrapper -->

<?php require_once ('../inc/foot.php'); ?>
<script type="text/javascript" src="/plugin/se2/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript">
    var oEditors = [];

    // 추가 글꼴 목록
    //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

    nhn.husky.EZCreator.createInIFrame({
        oAppRef: oEditors,
        elPlaceHolder: "ir1",
        sSkinURI: "/plugin/se2/SmartEditor2Skin.html",
        htParams : {
            bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
            bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
            bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
            //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
            fOnBeforeUnload : function(){
                //alert("완료!");
            }
        }, //boolean
        fOnAppLoad : function(){
            //예제 코드
            //oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
        },
        fCreator: "createSEditor2"
    });

//    function pasteHTML() {
//        var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
//        oEditors.getById["ir1"].exec("PASTE_HTML", [sHTML]);
//    }

//    function showHTML() {
//        var sHTML = oEditors.getById["ir1"].getIR();
//        alert(sHTML);
//    }

    function submitContents(elClickedObj) {
        oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.

        // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

        try {
            elClickedObj.form.submit();
        } catch(e) {}
    }

    function setDefaultFont() {
        var sDefaultFont = '궁서';
        var nFontSize = 24;
        oEditors.getById["ir1"].setDefaultFont(sDefaultFont, nFontSize);
    }

    // 타입에 따른 처리
    (function () {
        var radioType = $('input[name="blog_type"]');

        var thumbnailArea = $('.representative-type-thumbnail, .representative-type-thumbnail-new');
        var videoArea = $('.representative-type-video, .representative-type-video-new');

        radioType.bind('change', function () {
            var cur = $(this).val();

            if(cur === 'T'){
                thumbnailArea.css('display', 'block');
                videoArea.css('display', 'none');
            }else if(cur === 'V'){
                thumbnailArea.css('display', 'none');
                videoArea.css('display', 'block');
            }
        });
    } ());
</script>
</body>
</html>