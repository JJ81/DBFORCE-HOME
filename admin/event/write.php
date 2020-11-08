<?php
require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');

define('PAGE','EVENT');
define('PAGENAME', '이벤트');
define('TARGET_FOLDER', 'event');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

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
                <h3 class="text-primary"><?php echo PAGENAME;?> 글쓰기</h3></div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo PAGENAME;?></li>
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
                            <h4><?php echo PAGENAME;?> 작성</h4>
                            <a href="<?php echo ROOT;?>admin/<?php echo TARGET_FOLDER;?>/" class="btn btn-primary pull-right">목록으로</a>
                        </div>
                        <div class="card-body">
                            <!-- contents -->
                            <div class="_container">
                                <form action="<?php echo ROOT;?>admin/<?php echo TARGET_FOLDER;?>/response/res_write.php" method="post" enctype="multipart/form-data" class="form">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="">제목 <small class="text-danger">(*)</small></label>
                                                <input type="text" name="title" placeholder="제목을 입력하세요." class="form-control form-title" autofocus required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="">대표썸네일 <small>(jpg, gif, png)</small></label>
                                                <input type="file" name="thumbnail" class="form-control"
                                                       placeholder="글을 대표할 썸네일을 입력해주세요." required accept="image/*" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="">작성일/공지일 <small class="text-danger">(*)</small></label>
                                                <input type="date" name="date" class="form-control form-date" value="<?php echo getToday('Y-m-d');?>" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="">조회수 <small class="text-danger">(*)</small></label>
                                                <input type="number" name="hits" class="form-control form-count" placeholder="조회수를 입력해 주세요." />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="">작성자</label>
                                                <input type="text" name="author" class="form-control form-author" placeholder="작성자를 입력해 주세요." />
                                            </div>
                                        </div>
<!--                                        <div class="col-lg-6 col-md-6">-->
<!--                                            <div class="form-group">-->
<!--                                                <label for="">외부링크</label>-->
<!--                                                <input type="text" name="external_link" class="form-control form-external-link" placeholder="외부링크를 입력 (http:// or https://)" />-->
<!--                                                <div class="text-danger">-->
<!--                                                    <small>* 외부링크를 사용하게 될 경우, 본문의 내용이 출력되지 않고 외부 링크가 대신하게 됩니다.</small>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="col-lg-6 col-md-6">-->
<!--                                            <div class="form-group">-->
<!--                                                <label for="">링크출처</label>-->
<!--                                                <input type="text" name="link_origin" class="form-control form-link-origin" placeholder="외부링크 출처를 입력해 주세요." />-->
<!--                                            </div>-->
<!--                                        </div>-->
                                    </div>

                                    <!-- smart editor -->
                                    <div>
                                        <div style="margin-bottom: 5px;">본문 작성 <small class="text-danger">(*)</small></div>
                                        <textarea name="ir1" id="ir1" rows="10" cols="100" style="width: 100%; height:412px; display:none;"></textarea>
                                    </div>
                                    <!-- smart editor -->

                                    <div style="text-align: center;margin-top: 10px;">
                                        <a href="<?php echo ROOT;?>admin/<?php echo TARGET_FOLDER;?>/" class="btn btn-outline-danger">작성취소</a>
                                        <button type="button" onclick="submitContents(this);" class="btn btn-success">작성완료</button>
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

    function pasteHTML() {
        var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
        oEditors.getById["ir1"].exec("PASTE_HTML", [sHTML]);
    }

    function showHTML() {
        var sHTML = oEditors.getById["ir1"].getIR();
        alert(sHTML);
    }

    function submitContents(elClickedObj) {

        var formTitle = $('.form-title');
        var editorArea = $('#ir1');

        // 이 방식으로는 에디터에 입력값이 있는지 판단을 할 수가 없다.
        if(formTitle.val().trim() === ''){
            alert('제목을 입력해주세요');
            formTitle.focus();
            return;
        }

        oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.


        // check validation
        if(checkValidation() === false){
            return;
        }

        // TODO 올바르게 작동하지 않으니 검증 로직 점검할 것.
        if(editorArea.val().trim() === ''){
            alert('글을 입력해주세요.');
            return;
        }

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

    var formTitle=$('.form-title');
    var formDate=$('.form-date');
    var formCount=$('.form-count');


    // 필수 입력 항목의 누락여부를 파악한다.
    function checkValidation(){
        // 제목, 작성일, 조회수, 글내용을 submitContents에서 파악함.
        if(formTitle.val().trim() === ''){
            formTitle.focus();
            alert('제목을 입력해 주세요.');
            return false;
        }

        if(formDate.val().trim() === ''){
            formDate.focus();
            alert('공지일을 입력해 주세요.');
            return false;
        }

        // if(formCount.val().trim() === ''){
        //     formCount.focus();
        //     alert('조회수를 입력해 주세요.');
        //     return false;
        // }

        return true;
    }


</script>
</body>
</html>