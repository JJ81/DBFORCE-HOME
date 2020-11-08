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

use \JCORP\Business\Review\ReviewService as Review;
$review=new Review();

$total=$review->getReviewListCount($company_id);
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

$rows=$review->getReviewList($offset, $size, $company_id);

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
                <h3 class="text-primary">후기관리</h3></div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">후기관리</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->

        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row" id="vue-review-table">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title clearfix">
                            <h4>후기관리</h4>
                            <span class="pull-right" style="text-align: right;">
                                <button class="btn btn-outline-primary" @click="vueSetReview.openModal('ADD')">후기 등록</button>
<!--                                <button class="btn btn-outline-warning">순서 조정</button>-->
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive jp-customer-table">
                                <table class="display nowrap table table-hover table-bordered jp-table-customer" cellspacing="0" width="100%">
                                    <colgroup>
                                        <col width="200" />
                                        <col width="*" />
                                        <col width="150" />
                                        <col width="*" />
                                        <col width="100" />
                                        <col width="200" />
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th class="center">등록일</th>
                                        <th class="center">제목</th>
                                        <th class="center">페이지(위치)</th>
                                        <th class="center">이미지명</th>
                                        <th class="center">순서</th>
                                        <th>액션</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <tr v-if="lists.length === 0">
                                            <td colspan="6" class="center">No Data.</td>
                                        </tr>

                                        <tr class="jp-customer-record" v-if="lists.length > 0" v-for="ls in lists">
                                            <td class="center">
                                                {{ls.created_dt}}
                                            </td>
                                            <td class="center">
                                                {{ vueCommon.replaceSlashes(ls.title) }}
                                            </td>
                                            <td class="center">
                                                <span v-if="ls.position === 'S'">종잣돈만들기</span>
                                                <span v-if="ls.position === 'T'">투자훈련소</span>
                                            </td>
                                            <td class="color-primary center">
                                                {{ls.thumbnail}}
                                            </td>
                                            <td class="center">
                                                {{ls.order}}
                                            </td>
                                            <td class="center">
                                                <button class="btn btn-sm btn-outline-info"
                                                    @click="callModalForView(ls.id, ls.title, ls.position, ls.thumbnail, ls.order)">보기</button>
                                                <button class="btn-outline-warning btn-sm"
                                                    :data-review-id="ls.id"
                                                    @click="callModalForModify(ls.id, ls.title, ls.position, ls.thumbnail, ls.order);">수정</button>
                                                <button class="btn-outline-danger btn-sm"
                                                    :data-review-id="ls.id"
                                                    @click="callModalForDelete(ls.id)">삭제</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <?php if(count($rows) !== 0){ ?>
                                    <nav style="margin-top: 20px;">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link"
                                                   href="<?php echo ROOT;?>/admin/review/?size=<?php echo $size;?>&page=1"
                                                   tabindex="-1">First</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                   href="<?php echo ROOT;?>admin/review/?size=<?php echo $size;?>&page=<?php echo $prev;?>"
                                                   tabindex="-1">Previous</a>
                                            </li>
                                            <li class="page-item">
                                            <span class="page-link">
                                                <strong style="color: #1e91e4;"><?php echo $current; ?></strong> / <?php echo $total_page; ?>
                                            </span>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                   href="<?php echo ROOT;?>admin/review/?size=<?php echo $size;?>&page=<?php echo $next;?>"
                                                   tabindex="-1">Next</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                   href="<?php echo ROOT;?>admin/review/?size=<?php echo $size;?>&page=<?php echo $total_page;?>"
                                                   tabindex="-1">Last</a>
                                            </li>
                                        </ul>
                                    </nav>
                                <?php } ?>
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
<?php require_once ('../modal/modal_set_review.php'); ?>

<?php //require_once ('../modal/modal_modify_customer.php'); ?>
<?php //require_once ('../modal/modal_delete_customer.php'); ?>
<?php //require_once ('../modal/modal_view_memo.php'); ?>
<?php //require_once ('../modal/modal_memo.php'); ?>
<?php //require_once ('../modal/modal_device_info.php'); ?>

<?php require_once ('../inc/foot.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.22/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="<?php echo ROOT;?>admin/assets/vue/vue.common.js?v=<?php echo VERSION;?>"></script>
<script>
    var LIMIT_IMG_BYTES=1024*1024*1.5;

    var vueSetReview=new Vue({
        el: "#modalSetReview",
        data: {
            title: null,
            position: null,
            thumbnail: null,
            order: null,
            id: null,
            img_thumbnail: null,
            mode: 'ADD'
        },
        methods: {

            openModal: function (mode) {
                var _self=this;
                _self.mode=mode;

                if(mode === 'ADD'){
                    _self.title = null;
                    _self.position = null;
                    _self.order = null;
                    _self.img_thumbnail=null;
                    _self.id = null;
                }

                _self.thumbnail = null;

                $('.jp-ld-uploader').val('');
                $('#modalSetReview').modal('show');
            },

            closeModal: function () {
                $('#modalSetReview').modal('hide');
            },

            validation: function () {
                var _self=this;

                if(_self.mode === 'ADD'){
                    if(_self.title === null || _self.position === null || _self.order === null || _self.thumbnail === null){
                        return false;
                    }

                    return true;
                }else if(_self.mode === 'MOD'){
                    if(_self.title === null || _self.position === null || _self.order === null || _self.id === null){
                        return false;
                    }

                    return true;
                }
            },

            /**
             * 후기 추가
             **/
            addNewReview: function (){
                var _self=this;

                if(_self.validation() === false){
                    swal("경고", "모든 필드의 값을 입력하세요.", "warning", {
                        buttons: false,
                        timer: 1500
                    });
                    return;
                }

                var newImg=document.getElementById('upload-file-img').files[0];
                var newImgSize=0;


                if(newImg){
                    newImgSize=newImg.size;
                    if(newImgSize > LIMIT_IMG_BYTES){
                        alert('이미지 최대 용량은 1.5MB입니다. 이미지 사이즈를 조정해 주세요. (Your image size is ' + newImgSize + 'Bytes)');
                        console.info(newImgSize);
                        return;
                    }
                }



                var formData = new FormData();
                formData.append('title', _self.title);
                formData.append('position', _self.position);
                formData.append('order', _self.order);

                if(newImg){
                    formData.append('thumbnail', newImg);
                }


                axios.post('/api/review/set_review.php', formData)
                    .then(function (res) {
                        console.info(res.data);
                        if(res.data.success){
                            swal("성공", "후기가 추가 되었습니다.", "success", {
                                buttons: false,
                                timer: 1500
                            });

                            vueReviewTable.getList();
                            _self.closeModal();
                        }else{
                            _self.closeModal();
                            swal("실패", "일시적으로 에러가 발생했습니다.", "danger", {
                                buttons: false,
                                timer: 1500
                            });
                        }
                    })
                    .catch(function (err) {
                        console.error(err);
                        _self.closeModal();
                        swal("실패", "일시적으로 에러가 발생했습니다.", "danger", {
                            buttons: false,
                            timer: 1500
                        });

                    });
            },

            modifyReview: function () {
                var _self=this;

                if(_self.validation() === false){
                    swal("경고", "모든 필드의 값을 입력하세요.", "warning", {
                        buttons: false,
                        timer: 1500
                    });
                    return;
                }

                var newImg=document.getElementById('upload-file-img').files[0];
                var newImgSize=0;

                if(newImg){
                    newImgSize=newImg.size;
                    if(newImgSize > LIMIT_IMG_BYTES){
                        alert('이미지 최대 용량은 1.5MB입니다. 이미지 사이즈를 조정해 주세요. (Your image size is ' + newImgSize + 'Bytes)');
                        console.info(newImgSize);
                        return;
                    }
                }


                var formData = new FormData();
                formData.append('title', _self.title);
                formData.append('position', _self.position);
                formData.append('order', _self.order);

                if(newImg){
                    formData.append('thumbnail', newImg);
                }


                formData.append('id', _self.id);

                axios.post('/api/review/update_review.php', formData)
                    .then(function (res) {
                        console.info(res.data);
                        if(res.data.success){
                            swal("성공", "후기가 수정 되었습니다.", "success", {
                                buttons: false,
                                timer: 1500
                            });

                            vueReviewTable.getList();
                            _self.closeModal();
                        }else{
                            _self.closeModal();
                            swal("실패", "일시적으로 에러가 발생했습니다.", "danger", {
                                buttons: false,
                                timer: 1500
                            });
                        }
                    })
                    .catch(function (err) {
                        console.error(err);
                        _self.closeModal();
                        swal("실패", "일시적으로 에러가 발생했습니다.", "danger", {
                            buttons: false,
                            timer: 1500
                        });

                    });


            },

            drawThumbnail: function (){
                return $('.img-path').val() + this.img_thumbnail;
            }
        }
    });

    var vueReviewTable=new Vue({
        el: "#vue-review-table",
        data: {
            lists: [],
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
                        size: _self.size,
                        page: _self.page
                    }
                };
                axios.get('/api/review/get_review_list.php', params)
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


            /**
             * 후기 수정
             * @param id
             * @param title
             * @param position
             * @param thumbnail
             * @param order
             */
            callModalForModify: function (id, title, position, thumbnail, order) {

                vueSetReview.title=vueCommon.replaceSlashes(title);
                vueSetReview.position=position;
                vueSetReview.img_thumbnail=thumbnail;
                vueSetReview.order=order;
                vueSetReview.id=id;

                vueSetReview.openModal('MOD');
            },

            callModalForView: function (id, title, position, thumbnail, order) {

                vueSetReview.title=vueCommon.replaceSlashes(title);
                vueSetReview.position=position;
                vueSetReview.img_thumbnail=thumbnail;
                vueSetReview.order=order;
                vueSetReview.id=id;

                vueSetReview.openModal('VIEW');
            },



            callModalForDelete: function (id) {
                var _self=this;

                swal({
                    title: "삭제",
                    text: '정말로 선택한 후기를 삭제하시겠습니까?',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true
                })
                .then(function(yes){
                    if(yes){

                        var formData=new FormData();
                        formData.append('id', id);

                        axios.post('/api/review/delete_review.php', formData)
                            .then(function (res) {
                                console.info(res.data);
                                if(res.data.success){
                                    console.info('success to delete review');
                                    swal("성공", "정상적으로 삭제 되었습니다.", "success", {
                                        buttons: false,
                                        timer: 1500
                                    });

                                }else{
                                    console.error('failed to delete review');
                                    swal("경고", "후기를 삭제하지 못했습니다.", "warning", {
                                        buttons: false,
                                        timer: 1500
                                    });
                                }
                                _self.getList();
                            })
                            .catch(function (err) {
                                console.error(err);
                            });
                    }
                });
            }
        }
    });
</script>
</body>
</html>