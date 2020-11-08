<?php

require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');
define('PAGE','EMPLOYEE');


if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'login.php', '로그인이 필요합니다.');
    exit;
}

if($_SESSION['role'] !== '1'){
    AlertMsgAndRedirectTo(ROOT . 'index.php', '최고관리자만 접근할 수 있는 페이지입니다.');
    exit;
}


use JCORP\Business\Employee\EmployeeService as Employee;
$employee=new Employee();
$company_id=$_SESSION['company_id'];
$rows=$employee->getAllEmployeeWithSuperAdmin($company_id);


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
                <h3 class="text-primary">직원관리</h3></div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">직원관리</li>
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
                            <h4>직원관리</h4>
                            <a href="<?php echo ROOT;?>/admin/employee/create.php" class="btn btn-outline-success pull-right">직원등록</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover tb-db-list tb-employee-list">
                                    <thead>
                                    <tr>
                                        <th>계정</th>
                                        <th>이름</th>
                                        <th>권한</th>
                                        <th>연락처</th>
                                        <th>등록일</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(count($rows) == 0){ ?>
                                        <tr>
                                            <td colspan="6" style="text-align: center;">아직 등록된 직원이 없습니다.</td>
                                        </tr>
                                    <?php }else{ ?>
                                        <?php foreach ($rows as $r) { ?>
                                            <tr>
                                                <td scope="row">
                                                    <?php echo $r['login_id'];?>
                                                </td>
                                                <td class="color-primary">
                                                    <?php echo $r['name'];?>
                                                </td>
                                                <td>
                                                    <?php echo $r['role_name'];?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if(empty($r['phone'])){
                                                            echo '-';
                                                        }else{
                                                            echo $r['phone'];
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo setDate($r['registered_dt']);?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo ROOT;?>admin/employee/modify.php?employee_id=<?php echo $r['id']; ?>"
                                                       class="btn btn-sm btn-outline-info">수정</a>
                                                    <button class="btn btn-sm btn-outline-warning js-change-employee-pw" data-employee-id="<?php echo $r['id']; ?>">비밀번호</button>
                                                    <?php if($r['role_id'] !== '1'){ ?>
<!--                                                        <button class="btn btn-sm btn-outline-success js-takeover-employee" data-employee-id="--><?php //echo $r['id']; ?><!--">인수인계</button>-->
<!--                                                        <button class="btn btn-sm btn-secondary js-draw-db" data-employee-id="--><?php //echo $r['id']; ?><!--">디비회수</button>-->
                                                        <button class="btn btn-sm btn-danger sweet-success-cancel" data-employee-id="<?php echo $r['id']; ?>">삭제</button>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>

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
        <?php require_once ('../modal/modal_modify_pass.php'); ?>
        <?php require_once ('../modal/modal_modify_pass_by_admin.php'); ?>
    </div>
    <!-- End Page wrapper  -->
</div>
<!-- End Wrapper -->

<?php require_once ('../inc/foot.php'); ?>
<script>

    $('.sweet-success-cancel').bind('click', function () {
        var employee_id=$(this).attr('data-employee-id');
        console.log(employee_id);

        swal({
                title: "정말로 삭제하시겠습니까 ?",
                text: "한 번 삭제하면 관련 정보를 복구할 수 없습니다.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "예, 삭제합니다.",
                cancelButtonText: "취소합니다.",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    axios.get('<?php echo ROOT;?>admin/employee/response/res_delete_employee.php?employee_id=' + employee_id)
                        .then(function (res) {
                            // handle success
                            if(res.data.success && res.data.code === 200){
                                swal({
                                    title : "삭제되었습니다. !!",
                                    text: "해당 계정은 더 이상 사용할 수 없습니다.",
                                    type: "success"
                                }, function (isConfirm) {
                                    if(isConfirm){
                                        window.location.reload();
                                    }
                                });
                            } else if(!res.data.success && res.data.code === 410){
                                swal("인수인계를 먼저 진행하세요.", "인수인계 버튼을 클릭하세요.", "error");
                            } else {
                                swal("일시적 에러가 발생했습니다.", "잠시 후에 다시 시도해주세요.", "error");
                            }
                        })
                        .catch(function (error) {
                            // handle error
                            console.error(error);
                            swal("일시적 에러가 발생했습니다.", "잠시 후에 다시 시도해주세요.", "error");
                        });
                }
                else {
                    swal("취소되었습니다. !!", "다시 한 번 신중하게 생각하세요.", "error");
                }
            });
    });

    $('.js-change-employee-pw').bind('click', function () {
        var employee_id=$(this).attr('data-employee-id');
        var modal=$('#modalModifyPassByAdmin');
        modal.find('.modal-employee-id').val(employee_id);
        modal.modal('show');
    });

    $('.js-takeover-employee').bind('click', function () {
        var employee_id=$(this).attr('data-employee-id');
        var modal=$('#modalTakeOver');
        modal.find('.modal-employee-id').val(employee_id);

        modal.modal('show');
    });

    // 디비 회수 기능
    $('.js-draw-db').bind('click', function () {
        var employee_id=$(this).attr('data-employee-id');
        var modal=$('#modalDrawDB');
        modal.find('.js-employee-id').val(employee_id);
        modal.modal("show");
    });

</script>
</body>
</html>