
<?php
require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');
define('PAGE','CUSTOMER');
define('PAGE_NAME', "캠페인 생성");

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

use \JCORP\Business\Template\TemplateService as Template;
$template=new Template();

$size=null;
$page=null;
$prev=null;
$next=null;
$total_page=null;

$admin_id=$_SESSION['user_id'];
$company_id=$_SESSION['company_id'];

$template_list=$template->getTemplate($company_id, 0, 1000);


?>

<?php require_once ('../inc/head.php');?>
<style>
    .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active{
        border: none;
    }

    .ui-state-default{
        cursor: move;
    }
</style>
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
                <h3 class="text-primary"><?php echo PAGE_NAME;?></h3></div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo PAGE_NAME;?></li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->

        <!-- Container fluid  -->
        <div class="container-fluid" id="vue-campaign-create">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title clearfix">
                            <h4><?php echo PAGE_NAME;?></h4>
                        </div>
                        <div class="card-body" id="vue-customer-table">
                            <div class="table-responsive jp-customer-table">
                                <form action="<?php echo ROOT;?>admin/campaign/response/res_create.php"
                                      method="post"
                                      class="form-campaign-create"
                                      enctype="multipart/form-data">
                                    <table class="display nowrap table" cellspacing="0" width="100%">
                                        <colgroup>
                                            <col width="200">
                                            <col width="*">
                                        </colgroup>
                                        <tr>
                                            <th>
                                                제목 <small class="text-danger">*</small>
                                            </th>
                                            <td>
                                                <input type="text"
                                                       name="title"
                                                       class="form-control"
                                                       placeholder="캠페인 제목을 입력해주세요."
                                                       v-model="title" />
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                목적/설명
                                            </th>
                                            <td>
                                                <input type="text"
                                                       name="purpose"
                                                       class="form-control"
                                                       placeholder="켐페인 목적/설명을 입력해 주세요."
                                                       v-model="purpose" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>템플릿 선택 <small class="text-danger">*</small></th>
                                            <td>
                                                <div class="template_wrapper">
                                                    <?php if(count($template_list) === 0){?>

                                                    <?php } else { ?>
                                                        <ul id="template_sortable">
                                                            <?php for($i=0,$size=count($template_list);$i<$size;$i++) {?>
                                                            <li class="ui-state-default">
                                                                <table class="table table-template">
                                                                    <colgroup>
                                                                        <col width="50" />
                                                                        <col width="150" />
                                                                        <col width="*" />
                                                                    </colgroup>

                                                                    <tr>
                                                                        <td class="center">
                                                                            <input type="checkbox"
                                                                                   name="template_id[]"
                                                                                   class="js-template-id"
                                                                                   value="<?php echo $template_list[$i]['id'];?>" />
                                                                        </td>
                                                                        <td class="center">
                                                                            <?php
                                                                            if($template_list[$i]['template_type'] === 'IM'){
                                                                                echo "이미지형";
                                                                            } else if($template_list[$i]['template_type'] === 'BD'){
                                                                                echo "게시판형";
                                                                            } else if($template_list[$i]['template_type'] === 'HM'){
                                                                                echo "HTML형";
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td class="color-primary text-align-left">
                                                                            <?php echo $template_list[$i]['title'] ;?>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </li>
                                                            <?php } ?>
                                                        </ul>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>활성화</th>
                                            <td class="text-align-left">
                                                <input type="checkbox" name="isOpen" id="direct-open" checked>
                                                <label for="direct-open">바로 오픈</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>리다이렉션</th>
                                            <td>
                                                <input type="text"
                                                       name="redirection"
                                                       class="form-control"
                                                       placeholder="리다이렉션할 주소를 입력해 주세요. (http://주소)" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a href="./" class="btn btn-danger">취소</a>
                                                <button type="button" class="btn btn-primary"
                                                        @click="submit">캠페인 등록</button>
                                            </td>
                                        </tr>
                                    </table>

                                    <input type="hidden"
                                           name="prev_path"
                                           value="<?php echo CURRENT_URL;?>" />
                                </form>
                            </div>
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
<?php require_once ('../modal/modal_modify_pass.php'); ?>
<?php require_once ('../modal/modal_modify_customer.php'); ?>
<?php require_once ('../modal/modal_delete_customer.php'); ?>
<?php require_once ('../modal/modal_view_memo.php'); ?>
<?php require_once ('../modal/modal_memo.php'); ?>
<?php require_once ('../modal/modal_device_info.php'); ?>

<?php require_once ('../inc/foot.php'); ?>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.22/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="<?php echo ROOT;?>admin/assets/vue/vue.common.js?v=<?php echo VERSION;?>"></script>
<script>
    $( function() {
        $( "#template_sortable" ).sortable();
        $( "#template_sortable" ).disableSelection();
    } );

    var vueCreateCampaign=new Vue({
       el: "#vue-campaign-create",
       data:{
            title: null,
            purpose: null,
           templateCount: 0
       },
       methods:{
            validate: function () {
                var _self=this;
                if(_self.title === null || _self.title.trim() === ''){
                    alert('제목을 입력해 주세요');
                    return false;
                }

                // 템플릿은 최소한 1개 이상 선택을 해야 한다.
                $('.js-template-id').each(function (i) {
                    console.info( i + ' / ' + $(this).prop('checked') );
                    _self.templateCount += ($(this).prop('checked') === true) ? 1 : 0;
                });

                if(_self.templateCount === 0){
                    alert('템플릿은 적어도 한 개 이상 선택을 해야 합니다.');
                    return false;
                }

                return true;
            },

            submit: function () {
                var _self=this;
                if(_self.validate()){
                    console.info('submit');
                    $('.form-campaign-create').submit();
                }
            }

       }
    });
</script>
</body>
</html>