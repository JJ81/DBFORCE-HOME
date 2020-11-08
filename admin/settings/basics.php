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

//if($_SESSION['role'] !== 'A'){
//    AlertMsgAndRedirectTo('/index.php', '관리자만 접근할 수 있는 페이지입니다.');
//    exit;
//}

$company_id=$_SESSION['company_id'];

use JCORP\Business\Basics\BasicInfoService as Basic;
$basic=new Basic();
$row=$basic->getBasicInfoByCompany_id($company_id);

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
                <h3 class="text-primary">서비스 설정</h3></div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">서비스 설정</li>
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
                            <h4>서비스 설정</h4>
                            <a href="javascript:window.history.back(-1);" class="btn btn-default pull-right">뒤로</a>
                        </div>
                        <div class="card-body">
                            <!-- contents -->
                            <div class="_container">
                                <form action="./response/res_basic_settings.php" method="post" class="form">
                                    <table class="table">
                                        <colgroup>
                                            <col width="200" />
                                            <col width="*" />
                                        </colgroup>
                                        <tr>
                                            <th>서비스명 <i class="text-danger">*</i></th>
                                            <td>
                                                <input type="text"
                                                       name="title"
                                                       required
                                                       class="form-control"
                                                       placeholder="서비스명을 입력하세요."
                                                       value="<?php echo $row[0]['title']; ?>" />
                                                <p class="text-align-right">* 서비스명을 입력해주세요. 너무 길면 검색결과에 노출이 안될 수도 있으니 되도록 간결하게 입력해주세요.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>설명 <i class="text-danger">*</i></th>
                                            <td>
                                                <input type="text"
                                                       name="description"
                                                       required
                                                       class="form-control"
                                                       placeholder="서비스 설명을 입력하세요."
                                                       value="<?php echo $row[0]['description']; ?>" />
                                                <p class="text-align-right">* 서비스에 대한 간략한 설명을 입력 해주세요. 너무 길면 검색노출에 제약사항이 됩니다.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>키워드 <i class="text-danger">*</i></th>
                                            <td>
                                                <input type="text"
                                                       name="keyword"
                                                       required
                                                       class="form-control"
                                                       placeholder="키워드를 입력하세요."
                                                       value="<?php echo $row[0]['keyword']; ?>" />
                                                <p class="text-align-right">* 서비스를 잘 나타낼 수 있는 주요 키워드를 ,로 구분하여 입력해 주세요.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>웹주소 <i class="text-danger">*</i></th>
                                            <td>
                                                <input type="text"
                                                       name="service_url"
                                                       required
                                                       class="form-control"
                                                       placeholder="홈페이지 주소를 입력하세요. (http://를 포함하여 입력하세요.)"
                                                       value="<?php echo $row[0]['service_url']; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>파비콘설정 <i class="text-danger">*</i></th>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>검색이미지설정 <i class="text-danger">*</i></th>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>사이트맵</th>
                                            <td>
                                                <textarea name="sitemap"
                                                          class="form-control"
                                                          cols="30"
                                                          rows="10"
                                                          style="height: 300px;"
                                                          placeholder="사이트맵을 예시에 따라서 작성해주세요."></textarea>
                                                <p class="text-align-right" style="margin-top: 5px;">* 가이드에 따라서 사이트맵을 등록하시면 검색에 도움을 받을 수가 있습니다.
                                                    <a href="#" target="_blank" class="btn btn-sm btn-primary">예시보기</a>
                                                    <a href="#" target="_blank" class="btn btn-sm btn-outline-primary">XML로 직접 업로드</a>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Version (Caching) <i class="text-danger">*</i></th>
                                            <td>
                                                <input type="text"
                                                       name="deploy_version"
                                                       class="form-control"
                                                       required
                                                       placeholder="소스 버전을 갱신해주세요. (캐싱관리)"
                                                       value="<?php echo $row[0]['deploy_version']; ?>" />
                                                <p class="text-align-right">* 새로운 소스가 등록되었을 경우 캐싱하기 위해서 버전을 변경해 주세요.</p>
                                            </td>
                                        </tr>
<!--                                        <tr>-->
<!--                                            <th>PC Viewport</th>-->
<!--                                            <td>-->
<!--                                                <input type="text"-->
<!--                                                       name="pc_viewport"-->
<!--                                                       required-->
<!--                                                       class="form-control"-->
<!--                                                       placeholder="PC Viewport (ex) 1080"-->
<!--                                                       value="--><?php //echo $row[0]['pc_viewport']; ?><!--" />-->
<!--                                                <p class="text-align-right">* PC용으로만 설정이 필요할 경우 가로사이즈를 입력해주세요.</p>-->
<!--                                            </td>-->
<!--                                        </tr>-->
                                        <tr>
                                            <th>Naver</th>
                                            <td>
                                                <input type="text"
                                                       name="naver_verification_number"
                                                       class="form-control"
                                                       placeholder="네이버에서 발급받은 인증 번호를 입력해주세요."
                                                       value="<?php echo $row[0]['naver_verification_number']; ?>" />
                                                <p class="text-align-right">* 네이버 웹마스터에서 발급받은 토큰을 입력해 주세요.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Google</th>
                                            <td>
                                                <input type="text"
                                                       name="google_verification_number"
                                                       class="form-control"
                                                       placeholder="구글에서 발급받은 인증 번호를 입력해주세요."
                                                       value="<?php echo $row[0]['google_verification_number']; ?>" />
                                                <p class="text-align-right">* 구글 웹마스터에서 발급받은 토큰을 입력해 주세요.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>웹로그(Google)</th>
                                            <td>
                                                <textarea name="web_log"
                                                          class="form-control"
                                                          cols="30"
                                                          rows="10"
                                                          style="height: 300px;"
                                                          placeholder="웹로그 소스를 입력해 주세요."></textarea>
                                                <p class="text-align-right">*  웹로그 수집을 위한 소스를 이곳에 입력해주세요.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>태그매니저(Google)</th>
                                            <td>
                                                <textarea name="tag_manager"
                                                          class="form-control"
                                                          cols="30"
                                                          rows="10"
                                                          style="height: 300px;"
                                                          placeholder="태그매니저를 위한 소스를 입력해 주세요."></textarea>
                                                <p class="text-align-right">*  태그매니저를 위한 소스를 이곳에 입력해주세요.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>페이스북 픽셀</th>
                                            <td>
                                                <textarea name="fb_pixel"
                                                          class="form-control"
                                                          cols="30"
                                                          rows="10"
                                                          style="height: 300px;"
                                                          placeholder="페이스북 픽셀 소스를 입력해 주세요."></textarea>
                                                <p class="text-align-right">*  페이스북 픽셀 관련 소스를 이곳에 입력해주세요.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>로거 LOGGER</th>
                                            <td>
                                                <textarea name="etc_logger"
                                                          class="form-control"
                                                          cols="30"
                                                          rows="10"
                                                          style="height: 300px;"
                                                          placeholder="위의 사항을 제외한 로거소스를 입력해 주세요."></textarea>
                                                <p class="text-align-right">*  위의 사항을 제외한 로거소스를 입력해주세요.</p>
                                            </td>
                                        </tr>
                                    </table>
                                    <div style="text-align: center;margin-top: 10px;">
                                        <button type="button" class="btn btn-primary" onclick="alert('제작자에게 문의하세요. info@jcorporationtech.com');">저장</button>
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

</body>
</html>