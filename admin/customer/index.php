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

// 검색 조건
$name=null;
$phone=null;
$status=null;
$memo=null;
$reg_start_dt=null; // 등록일 시작일 기간검색
$reg_end_dt=null; // 등록일 종료일 기간검색
$mod_start_dt=null; // 수정일 시작일
$mod_end_dt=null; // 수정일 종료일


$name=getDataByGet('name');
$phone=getDataByGet('phone');
$status=getDataByGet('status');
$memo=getDataByGet('memo');
$reg_start_dt=getDataByGet('rsd');
$reg_end_dt=getDataByGet('red');
$mod_start_dt=getDataByGet('msd');
$mod_end_dt=getDataByGet('med');


// pagination!!
if(empty($_GET['size'])){
    $size=20;
}else{
    $size=getDataByGet('size');
}

if(empty($_GET['page'])){
    $page=1;
}else{
    $page=getDataByGet('page');
}

$current=$page;
$next=null;
$prev=null;

$company_id=$_SESSION['company_id'];

use \JCORP\Business\Customer\CustomerService as Customer;
$customer=new Customer();

$total=$customer->getCustomerListCount($name, $phone, $status, $memo, $reg_start_dt, $reg_end_dt, $mod_start_dt, $mod_end_dt, $company_id);
$total_count = $total[0]['total'];
$total_page=ceil($total_count/$size);
$offset=($page-1)*$size;

if($current < $total_page){
    $next = $current+1;
} else {
    $next=$current;
}

if($current > 1){
    $prev = $current-1;
}else{
    $prev=$current;
}

$rows=$customer->getCustomerList($offset, $size, $name, $phone, $status, $memo, $reg_start_dt, $reg_end_dt, $mod_start_dt, $mod_end_dt, $company_id);


use \JCORP\Business\Customer\CustomerStatusService as CustomerService;
$customer_status=new CustomerService();
$status_list=$customer_status->getList($company_id);
// error_log($size);
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
                <h3 class="text-primary">회원관리 <?php echo $name;?></h3></div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">회원관리</li>
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
                            <h4>회원관리</h4>
                            <span class="pull-right col-lg-6" style="text-align: right;">
                                <form action="<?php echo ROOT;?>admin/customer/response/res_make_excel.php" method="get">
                                    <label for="" style="font-size: 13px;margin-right: 10px;">시작일</label>
                                    <input type="date"
                                           class="form-control"
                                           name="start_dt"
                                           required
                                           style="width: 175px;display: inline-block;" />
                                    &nbsp;&nbsp;
                                    <label for="" style="font-size: 13px;margin-right: 10px;">종료일</label>
                                    <input type="date"
                                           class="form-control"
                                           name="end_dt"
                                           required
                                           style="width: 175px;display: inline-block;" />
                                    <button type="submit" class="btn btn-outline-info">엑셀다운로드</button>
                                </form>
                            </span>
                        </div>
                        <div class="card-body" id="vue-customer-table">
                            <div class="table-responsive jp-customer-table">
                                <table class="display nowrap table table-hover table-bordered jp-table-customer" cellspacing="0" width="100%">
                                    <colgroup>
                                        <col width="220">
                                        <col width="*">
                                        <col width="*">
                                        <col width="*">
                                        <col width="*">
                                        <col width="*">
                                        <col width="*">
                                        <col width="220">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th class="center">등록일</th>
                                        <th class="center">이름</th>
                                        <th class="center">전화</th>
                                        <th class="center">IP</th>
                                        <th class="center">Referrer</th>
                                        <th class="center">UTM</th>
                                        <th class="center">상태</th>
                                        <th>액션</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="lists.length === 0">
                                            <td colspan="8" class="center">No Data.</td>
                                        </tr>

                                        <tr class="jp-customer-record" v-if="lists.length > 0" v-for="ls in lists">
                                            <td class="center">
                                                {{ vueCommon.extractDateFromDateTime(ls.created_dt) }}
                                            </td>
                                            <td class="center">{{ls.name}}</td>
                                            <td class="color-primary center">
                                                {{vueCommon.checkPhoneNumberType(ls.phone)}}
                                            </td>
                                            <td class="center">
                                                <span v-if="ls.ip_addr">{{ls.ip_addr}}</span>
                                                <span v-else>-</span>
                                                <span v-if="ls.req_item_type">
                                                    <span v-if="ls.req_item_type === 'MainHomeM'">(Mobile)</span>
                                                    <span v-if="ls.req_item_type === 'MainHome'">(PC)</span>
                                                </span>
                                            </td>
                                            <td class="center">
                                                <span v-if="ls.referrer">{{ls.referrer}}</span>
                                                <span v-else>-</span>
                                            </td>
                                            <td class="center">
                                                <span v-if="ls.url">{{ls.url}}</span>
                                                <span v-else>-</span>
                                            </td>
                                            <td class="center">
                                                <span v-if="ls.status_name">{{ls.status_name}}</span>
                                                <span v-else>-</span>
                                            </td>
                                            <td class="center">
                                                <button class="btn-outline-primary btn-sm"
                                                        :data-customer-id="ls.id"
                                                        :data-customer-name="ls.name"
                                                        @click="callModalForMemo(ls.id, ls.name);">메모</button>
                                                <button class="btn-outline-info btn btn-sm"
                                                        @click="vueDeviceInfo.getDeviceInfo(ls.id);">디바이스</button>
                                                <button class="btn-outline-warning btn-sm"
                                                        :data-customer-id="ls.name"
                                                        :data-customer-name="ls.name"
                                                        :data-customer-phone="ls.phone"
                                                        :data-status-id="ls.status_id"
                                                        :data-created-dt="ls.created_dt"
                                                        @click="callModalForModify(ls.id, ls.name, ls.phone, ls.status_id, ls.created_dt);">수정</button>
                                                <button class="btn-outline-danger btn-sm"
                                                        :data-customer-id="ls.id"
                                                        :data-customer-name="ls.name"
                                                        :data-customer-phone="ls.phone"
                                                        @click="callModalForDelete(ls.id, ls.name, ls.phone)">삭제</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <?php if(count($rows) !== 0){ ?>
                                    <nav style="margin-top: 20px;">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link"
                                                   href="<?php echo ROOT;?>/admin/customer/?size=<?php echo $size;?>&page=1&name=<?php echo $name;?>&phone=<?php echo $phone;?>&status=<?php echo $status;?>"
                                                   tabindex="-1">First</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                   href="<?php echo ROOT;?>admin/customer/?size=<?php echo $size;?>&page=<?php echo $prev;?>&name=<?php echo $name;?>&phone=<?php echo $phone;?>&status=<?php echo $status;?>"
                                                   tabindex="-1">Previous</a>
                                            </li>
                                            <li class="page-item">
                                            <span class="page-link">
                                                <strong style="color: #1e91e4;"><?php echo $current; ?></strong> / <?php echo $total_page; ?>
                                            </span>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                   href="<?php echo ROOT;?>admin/customer/?size=<?php echo $size;?>&page=<?php echo $next;?>&name=<?php echo $name;?>&phone=<?php echo $phone;?>&status=<?php echo $status;?>"
                                                   tabindex="-1">Next</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                   href="<?php echo ROOT;?>admin/customer/?size=<?php echo $size;?>&page=<?php echo $total_page;?>&name=<?php echo $name;?>&phone=<?php echo $phone;?>&status=<?php echo $status;?>"
                                                   tabindex="-1">Last</a>
                                            </li>
                                        </ul>
                                    </nav>
                                <?php } ?>

                                <!-- controller -->
                                <div class="jp-search-condition">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form action="<?php echo ROOT;?>admin/customer/" method="GET" style="margin-right: 20px;">
                                                        <div class="row">
                                                            <div class="col-lg-10 col-md-10" style="text-align: right;">
                                                                <input type="text"
                                                                       name="name"
                                                                       class="form-control"
                                                                       style="display: inline-block;width: 180px;"
                                                                       maxlength="13"
                                                                       value="<?php echo $name;?>"
                                                                       placeholder="이름" />
                                                                <input type="text"
                                                                       name="phone"
                                                                       class="form-control"
                                                                       style="display: inline-block;width: 180px;"
                                                                       maxlength="13"
                                                                       value="<?php echo $phone;?>"
                                                                       placeholder="전화번호" />
                                                                &nbsp;&nbsp;
                                                                <?php if(!empty($status_list)){?>
                                                                    <select name="status" class="form-control" style="display: inline-block;width: 180px;">
                                                                        <option value="">상태(분류)선택</option>
                                                                        <?php for($i=0,$size_s=count($status_list);$i<$size_s;$i++){ ?>
                                                                            <option value="<?php echo $status_list[$i]['id'];?>" <?php if($status == $status_list[$i]['id']){ echo "selected";} ;?>>
                                                                                <?php echo $status_list[$i]['name'];?>
                                                                            </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2" style="text-align: left;">
                                                                <button type="submit" class="btn btn-md btn-success">검색</button>
                                                            </div>
                                                            <input type="hidden" name="page" value="1" />
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<script src="<?php echo ROOT;?>admin/assets/vue/vue.memo.js?v=<?php echo VERSION;?>"></script>
<script src="<?php echo ROOT;?>admin/assets/vue/vue.customer.js?v=<?php echo VERSION;?>"></script>
<script>
    var vueDeviceInfo=new Vue({
        el: "#modalDeviceInfo",
        data: {
            device_info: null
        },
        methods:{
            getDeviceInfo: function (id) {
                var _self=this;
                axios.get('/api/customer/get_device_info.php?id=' + id)
                    .then(function (res) {
                        console.log(res);
                        if(res.data.success){
                            console.info(res.data.info[0]['device_info']);
                            _self.device_info=res.data.info[0]['device_info'];
                            $('#modalDeviceInfo').modal('show');
                        }
                    })
                    .catch(function (err){
                        console.error(err);
                        alert(err);
                    });
            },
        }
    });

    var vueCustomerTable=new Vue({
        el: "#vue-customer-table",
        data: {
            lists: [],
            name: "<?php echo $name;?>",
            phone: "<?php echo $phone;?>",
            status: "<?php echo $status;?>",
            size: "<?php echo $size;?>",
            page: <?php echo $page;?>
        },
        beforeMount: function(){
            this.getList();
        },
        methods:{
            getList: function(){
                var _self=this;
                var params = { // 검색 조건 설정
                    params: {
                        name: _self.name,
                        phone: _self.phone,
                        status: _self.status,
                        size: _self.size,
                        page: _self.page
                    }
                };
                axios.get('/api/customer/get_customer_list.php', params)
                    .then(function (res) {
                        console.log(res);
                        if(res.data.success){
                            _self.lists=res.data.lists;
                        }
                    })
                    .catch(function (err){
                        console.error(err);
                        alert(err);
                    });
            },

            callModalForMemo: function (cs_id, cs_name){
                vue_memo.openModal(cs_id, cs_name);
            },

            callModalForModify: function (cs_id, cs_name, cs_phone, status_id, created_dt) {
                var modalModify=$('#modalModifyCustomerInfo');
                var created_dt=moment(created_dt).format('YYYY-MM-DD');

                vueModalCustomerModify.cs_id=cs_id;
                vueModalCustomerModify.name=cs_name;
                vueModalCustomerModify.phone=cs_phone;
                vueModalCustomerModify.status_id=status_id;
                vueModalCustomerModify.created_dt=created_dt;

                modalModify.modal('show');
            },

            callModalForDelete: function (cs_id, cs_name, phone) {
                var modalDelete=$('#modalDeleteCustomerInfo');

                vueModalCustomerDelete.cs_id=cs_id;
                vueModalCustomerDelete.cs_name=cs_name;
                vueModalCustomerDelete.cs_phone=phone;
                modalDelete.modal('show');

            },

            selectPhone: function (e) {
                var phone=$(e.currentTarget).attr('data-phone');
                $(e.currentTarget).val(phone);
                $(e.currentTarget).select();
            },

            recoverPhoneNumber: function () {
                $(".phone-place").each(function(i, el){
                    var newNum= vueCommon.hidePhoneNumber($(el).attr('data-phone'));
                    $(this).val(newNum);
                });
            },

            activateMemoBox: function (e) {
                $(e.currentTarget).addClass('memo_box_active');
            },

            deactivateMemoBox: function () {
                $('.memo_box').removeClass('memo_box_active');
            }

        }
    });
</script>
</body>
</html>