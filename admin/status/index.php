<?php
require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');
define('PAGE','CUSTOMER');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}



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
                <h3 class="text-primary">상태관리</h3></div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">상태관리</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->

        <!-- Container fluid  -->
        <div class="container-fluid" id="vueStatus">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title clearfix">
                            <h4>상태관리 <small>(* 고객을 등록한 상태값으로 분류하기 위한 기능입니다.)</small></h4>
                            <a href="#" class="btn btn-outline-success pull-right"
                               @click="openModal('#createCardMethod', null, 'ADD')">추가</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display nowrap table table-hover table-bordered jp-table-customer" cellspacing="0" width="100%">
                                    <colgroup>
                                        <col width="150" />
                                        <col width="150" />
                                        <col width="*" />
                                        <col width="150" />
                                        <col width="150" />
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th class="center">등록일</th>
                                        <th class="center">상태값</th>
                                        <th class="center">설명</th>
                                        <th class="center">수정일</th>
                                        <th class="center">액션</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-if="lists.length>0" v-for="(ls, index) in lists">
                                        <td class="center">{{ls.created_dt}}</td>
                                        <td class="color-primary center">{{ls.name}}</td>
                                        <td class="center">
                                            <span v-if="ls.description">{{ls.description}}</span>
                                            <span v-else>-</span>
                                        </td>
                                        <td class="center">
                                            <span v-if="ls.modified_dt">{{ls.modified_dt}}</span>
                                            <span v-else>-</span>
                                        </td>
                                        <td class="center">
                                            <button class="btn btn-sm btn-outline-warning"
                                                    @click="openModal('#createCardMethod', ls.id, 'MOD', index)">수정</button>
                                            <button class="btn btn-sm btn-outline-danger"
                                                    @click="vueModalStatus.deleteStatus(ls.id)">삭제</button>
                                        </td>
                                    </tr>
                                    <tr v-if="lists.length === 0">
                                        <td colspan="5" class="center">No Data.</td>
                                    </tr>
                                    </tbody>
                                </table>

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
<?php require_once ('../modal/modal_status.php'); ?>

<?php require_once ('../inc/foot.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.22/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="<?php echo ROOT;?>admin/assets/vue/vue.status.js?v=<?php echo VERSION;?>"></script>

</body>
</html>