
<?php
require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');
define('PAGE','CUSTOMER');
define('PAGE_NAME', "템플릿생성");

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

$size=null;
$page=null;
$prev=null;
$next=null;
$total_page=null;
$rows=array();
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
        <div class="container-fluid" id="vue-template-create">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title clearfix">
                            <h4><?php echo PAGE_NAME;?></h4>
                        </div>
                        <div class="card-body" id="vue-customer-table">
                            <div class="table-responsive jp-customer-table">
                                <form action="<?php echo ROOT;?>admin/template/response/res_create.php"
                                      method="post"
                                      class="form-template-create"
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
                                                       placeholder="템플릿 제목을 입력해주세요."
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
                                                       placeholder="템플릿 목적/설명을 입력해 주세요."
                                                       v-model="purpose" />
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                유형
                                            </th>
                                            <td style="text-align: left;">
                                                <input type="radio" id="tpl_type_html" v-model="template_type" name="template_type" value="HM" />
                                                <label for="tpl_type_html">HTML</label>
                                                &nbsp;&nbsp;
                                                <input type="radio" id="tpl_type_img" v-model="template_type" name="template_type" value="IM" />
                                                <label for="tpl_type_img">이미지</label>
                                                &nbsp;&nbsp;
                                                <input type="radio" id="tpl_type_board" v-model="template_type" name="template_type" value="BD" />
                                                <label for="tpl_type_board">게시판</label>
                                            </td>
                                        </tr>

                                        <tr v-if="template_type === 'IM'">
                                            <th>이미지<small class="text-danger">*</small></th>
                                            <td>
                                                <input type="file"
                                                       name="file"
                                                       class="form-control"
                                                       v-model="template_image"
                                                       accept="image/png, image/gif, image/jpg, image/jpeg" />
                                            </td>
                                        </tr>

                                        <tr v-if="template_type === 'HM'">
                                            <th>HTML<small class="text-danger">*</small></th>
                                            <td>
                                                <textarea class="form-control"
                                                      name="template"
                                                      id=""
                                                      cols="30"
                                                      rows="30"
                                                      style="min-height: 300px; resize: vertical;"></textarea>
                                            </td>
                                        </tr>

                                        <tr v-if="template_type === 'BD'">
                                            <th>게시판 선택</th>
                                            <td style="text-align: left;">
                                                <input type="radio" id="board_review" v-model="board_type" name="board_type" value="RV" />
                                                <label for="board_review">고객후기</label>
                                                &nbsp;&nbsp;
                                                <input type="radio" id="board-live" v-model="board_type" name="board_type" value="LS" />
                                                <label for="board-live">실시간상담현황</label>
                                            </td>
                                        </tr>
                                        <tr v-if="template_type === 'BD'">
                                            <th>게시글 선택<small class="text-danger">*</small></th>
                                            <td>
                                                <div style="min-height: 300px;overflow-y: scroll;resize: vertical;">
                                                    <table class="table table-review" v-if="board_type === 'RV'">
                                                        <colgroup>
                                                            <col width="50" />
                                                            <col width="*" />
                                                            <col width="*" />
                                                            <col width="*" />
                                                        </colgroup>
                                                        <tr>
                                                            <th>선택</th>
                                                            <th>썸네일</th>
                                                            <th>제목</th>
                                                            <th>내용</th>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" />
                                                            </td>
                                                            <td></td>
                                                            <td>제목을 출력</td>
                                                            <td>글 내용을 출력</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" />
                                                            </td>
                                                            <td></td>
                                                            <td>제목을 출력</td>
                                                            <td>글 내용을 출력</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" />
                                                            </td>
                                                            <td></td>
                                                            <td>제목을 출력</td>
                                                            <td>글 내용을 출력</td>
                                                        </tr>
                                                    </table>
                                                    <table class="table table-review" v-if="board_type === 'LS'">
                                                        <colgroup>
                                                            <col width="50" />
                                                            <col width="*" />
                                                            <col width="*" />
                                                            <col width="*" />
                                                        </colgroup>
                                                        <tr>
                                                            <th>선택</th>
                                                            <th>이름</th>
                                                            <th>상태</th>
                                                            <th>내용</th>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox"></td>
                                                            <td>홍길동</td>
                                                            <td>접수중</td>
                                                            <td>접수내용</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox"></td>
                                                            <td>홍길동</td>
                                                            <td>접수중</td>
                                                            <td>접수내용</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox"></td>
                                                            <td>홍길동</td>
                                                            <td>접수중</td>
                                                            <td>접수내용</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="checkbox"></td>
                                                            <td>홍길동</td>
                                                            <td>접수중</td>
                                                            <td>접수내용</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a href="./" class="btn btn-danger">취소</a>
                                                <button type="button" class="btn btn-primary" @click="submit">템플릿 등록</button>
                                            </td>
                                        </tr>
                                    </table>
                                    <input type="hidden"
                                           name="template_type"
                                           v-model="template_type" />
                                    <input type="hidden"
                                           name="board_type"
                                           v-model="board_type"
                                           v-if="board_type !== null" />
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.22/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="<?php echo ROOT;?>admin/assets/vue/vue.common.js?v=<?php echo VERSION;?>"></script>
<script>
    var vueCreateTemplate=new Vue({
       el: "#vue-template-create",
       data:{
           template_type: 'HM', // 기본 템플릿 선택은 HTML,
           board_type: 'RV', // RV or LS,
           title: null,
           purpose: null,
           template_image : null, // 이미지 템플릿일 경우 처리
       },
       methods:{
            validate: function () {
                // 템플릿 유형에 따라서 유효성 검사 항목이 결정된다.

                if(this.template_type === 'IM'){
                    console.log("template image");

                    if(this.title === null || this.title.trim() === ''){
                        alert('제목을 입력해 주세요');
                        return false;
                    }

                    if(this.template_image === null){
                        alert('이미지를 등록해주세요.');
                        return false;
                    }
                }

                return true;
            },

            // TODO caseA 이미지 템플릿을 먼저 등록시켜 본다.
            submit: function () {
                var _self=this;
                if(_self.validate()){
                    $('.form-template-create').submit();
                }
            }
       }
    });
</script>
</body>
</html>