<?php

require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');
define('PAGE','NOTICE');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT .'admin/login.php', '로그인이 필요합니다.');
    exit;
}

if($_SESSION['role'] !== 'S'){
    AlertMsgAndRedirectTo(ROOT . 'admin/index.php', '관리자만 접근할 수 있는 페이지입니다.');
    exit;
}

use JCORP\Business\Basics\BasicInfoService as Basic;
$basic=new Basic();
$company_id=$_SESSION['company_id'];
$privacy=$basic->getPrivacyInfo($company_id);

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
                <h3 class="text-primary">영상관리</h3></div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">영상관리</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->

        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="vue-video-table">
                        <div class="card-title clearfix">
                            <h4>영상관리</h4>
                            <button class="btn btn-outline-info pull-right"
                                    @click="modalOrderVideo.openModal"
                                    style="margin-left: 5px;">우선순위설정</button>
                            <button class="btn btn-outline-secondary pull-right"
                                    @click="vueAddModal.openModal">영상등록</button>
                        </div>
                        <div class="card-body">
                            <!-- contents -->
                            <div class="table-responsive">
                                <table class="display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
                                <colgroup>
                                    <col width="*" />
                                    <col width="*" />
                                    <col width="*" />
                                    <col width="*" />
                                    <col width="200" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>등록일</th>
                                    <th>제목</th>
                                    <th>주소</th>
                                    <th>우선순위</th>
                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="lists.length > 0" v-for="ls in lists" :key="ls">
                                        <td>
                                            {{vueCommon.extractDateFromDateTime(ls.registered_dt)}}
                                        </td>
                                        <td>
                                            {{ls.video_title}}
                                            <small v-if="ls.representative === '1'" class="badge-info"
                                                  style="display: inline-block; padding: 0 5px;border-radius: 10px;">대표영상</small>
                                        </td>
                                        <td>
                                            <a :href="'https://www.youtube.com/watch?v=' + ls.video_url" target="_blank">
                                                https://www.youtube.com/watch?v={{ls.video_url}}
                                            </a>
                                        </td>
                                        <td>
                                            {{ls.order}}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary"
                                                    v-if="ls.representative !== '1'" @click="setRepresentative(ls.id)">대표지정</button>
                                            <button class="btn btn-sm btn-outline-warning"
                                                    @click="vueModifyModal.openModal(ls.id)">수정</button>
                                            <button class="btn btn-sm btn-outline-danger"
                                                    @click="deleteVideo(ls.id, ls.representative)">삭제</button>
                                        </td>
                                    </tr>

                                    <tr v-if="lists.length === 0">
                                        <td colspan="4" class="center">No Data.</td>
                                    </tr>
                                </tbody>
                            </table>
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

<?php require_once ('../modal/modal_add_video.php'); ?>
<?php require_once ('../modal/modal_order_video.php'); ?>
<?php require_once ('../modal/modal_modify_video.php'); ?>

<?php require_once ('../inc/foot.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.22/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="<?php echo ROOT;?>admin/assets/vue/vue.common.js?v=<?php echo VERSION;?>"></script>
<script type="text/javascript">
    var vueAddModal=new Vue({
        el: "#modalAddNewVideo",
        data:{
            title: null,
            url: null
        },
        methods:{
            openModal: function () {
                this.resetForm();
                $('#modalAddNewVideo').modal('show');
            },

            closeModal: function () {
                $('#modalAddNewVideo').modal('hide');
            },

            resetForm: function () {
                this.title=null;
                this.url=null;
            },

            addNewVideo: function () {
                var _self=this;
                if(_self.title === '' || _self.title === null){
                    alert('영상 제목을 입력해주세요.');
                    return;
                }

                if(_self.url === '' || _self.url === null){
                    alert('영상 주소의 아이디값을 입력해주세요.');
                    return;
                }

                var formData=new FormData();
                formData.append('title', _self.title);
                formData.append('url', _self.url);

                axios.post('/api/video/set_video.php', formData)
                    .then(function (res){
                        _self.closeModal();

                        if(res.data.success){
                            swal("성공", "영상이 추가 되었습니다.", "success", {
                                buttons: false,
                                timer: 1500
                            });

                            vueVideo.getVideoList();
                        }else{
                            swal("실패", "일시적으로 에러가 발생했습니다.", "danger", {
                                buttons: false,
                                timer: 1500
                            });
                        }
                    })
                    .catch(function (err){
                        swal("실패", err, "danger", {
                            buttons: false,
                            timer: 1500
                        });
                    });
            }
        }
    });

    var vueModifyModal=new Vue({
        el: "#modalModifyVideo",
        data:{
            title: null,
            url: null,
            id: null
        },
        methods:{
            openModal: function (id) {
                var _self=this;
                _self.id=id;

                axios.get('/api/video/get_video_by_id.php?id=' + id)
                    .then(function (res) {
                        console.log(res.data);

                        if(res.data.success){
                            _self.title=res.data.list[0]['video_title'];
                            _self.url=res.data.list[0]['video_url'];

                            $('#modalModifyVideo').modal('show');
                        }
                    })
                    .catch(function (err){
                        console.error(err);
                        alert(err);
                    });
            },

            closeModal: function () {
                $('#modalModifyVideo').modal('hide');
            },

            modifyVideo: function () {
                var _self=this;

                if(_self.title === '' || _self.title === null){
                    alert('영상 제목을 입력해주세요.');
                    return;
                }

                if(_self.url === '' || _self.url === null){
                    alert('영상 주소의 아이디값을 입력해주세요.');
                    return;
                }

                var formData=new FormData();
                formData.append('title', _self.title);
                formData.append('url', _self.url);
                formData.append('id', _self.id);

                if(_self.id === null){
                    window.location.reload();
                    return;
                }

                axios.post('/api/video/update_video.php', formData)
                    .then(function (res){
                        _self.closeModal();

                        if(res.data.success){
                            swal("성공", "영상이 수정 되었습니다.", "success", {
                                buttons: false,
                                timer: 1500
                            });

                            vueVideo.getVideoList();
                        }else{
                            swal("실패", "일시적으로 에러가 발생했습니다.", "danger", {
                                buttons: false,
                                timer: 1500
                            });
                        }
                    })
                    .catch(function (err){
                        swal("실패", err, "danger", {
                            buttons: false,
                            timer: 1500
                        });
                    });
            }
        }
    });

    var modalOrderVideo=new Vue({
        el: "#modalOrderVideo",
        data: {
            lists: []
        },
        methods:{
            // copyVideoList: function () {
            //     var _self=this, i=0, size=vueVideo.lists.length;
            //     for(;i<size;i++){
            //         // console.info(i);
            //         // console.info(vueVideo.lists[i]['id']);
            //
            //         var tmp={
            //             "id" : vueVideo.lists[i]['id'],
            //             "video_title" : vueVideo.lists[i]['video_title'],
            //             "order" : vueVideo.lists[i]['order']
            //         };
            //
            //         _self.lists[i]=tmp;
            //     }
            // },

            openModal: function () {
                // this.copyVideoList();
                $('#modalOrderVideo').modal('show');
            },

            closeModal: function () {
                $('#modalOrderVideo').modal('hide');
            },

            adjustVideoOrder: function () {
                var _self=this;
                var formData=new FormData();

                formData.append('lists', JSON.stringify(_self.lists));
                axios.post('/api/video/set_video_order.php', formData)
                    .then(function (res) {
                        console.info(res.data.success);
                        console.info(res.data.msg);

                        if(res.data.success){
                            swal("성공", res.data.msg, "success", {
                                buttons: false,
                                timer: 1500
                            });
                            vueVideo.getVideoList();
                            _self.closeModal();
                        }else{
                            swal("실패", "일시적으로 에러가 발생했습니다.", "danger", {
                                buttons: false,
                                timer: 1500
                            });
                        }

                    })
                    .catch(function (err) {
                        console.error(err);
                        swal("실패", err, "danger", {
                            buttons: false,
                            timer: 1500
                        });
                    })

            }
        }
    });

    var vueVideo=new Vue({
        el: "#vue-video-table",
        data: {
            lists: []
        },
        beforeMount: function(){
            this.getVideoList();
        },
        methods: {
            getVideoList: function () {
                var _self=this;
                axios.get('/api/video/get_video.php')
                    .then(function (res) {
                        console.log(res.data);

                        if(res.data.success){
                            _self.lists=res.data.lists;
                            modalOrderVideo.lists=res.data.lists;
                        }
                    })
                    .catch(function (err){
                        console.error(err);
                        alert(err);
                    });
            },

            deleteVideo: function (id, representative) {
                console.info(id);
                console.info(representative);
                var _self=this;

                swal({
                    title: "영상 삭제",
                    text: '정말로 선택한 영상을 삭제하시겠습니까?',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true
                })
                    .then(function(yes){
                        if (yes) {
                            if(representative == '1'){
                                swal("경고", " 대표영상은 삭제할 수 없습니다.", "warning", {
                                    buttons: false,
                                    timer: 1500
                                });
                                return;
                            }

                            var formData=new FormData();
                            formData.append('id', id);

                            axios.post('/api/video/delete_video.php', formData)
                                .then(function (res){
                                    if(res.data.success){
                                        swal("성공", "영상이 수정 되었습니다.", "success", {
                                            buttons: false,
                                            timer: 1500
                                        });
                                        _self.getVideoList();

                                    }else{
                                        swal("실패", "일시적으로 에러가 발생했습니다.", "danger", {
                                            buttons: false,
                                            timer: 1500
                                        });
                                    }
                                })
                                .catch(function(err){
                                    console.error(err);
                                    swal("실패", "일시적으로 에러가 발생했습니다.", "danger", {
                                        buttons: false,
                                        timer: 1500
                                    });
                                });

                        }
                    });
            },

            setRepresentative: function (id) {
                var _self=this;
                console.info(id);

                var formData=new FormData();
                formData.append('id', id);

                axios.post('/api/video/set_representative_video.php', formData)
                    .then(function (res) {
                        if(res.data.success){
                            swal("성공", "영상이 지정 되었습니다.", "success", {
                                buttons: false,
                                timer: 1500
                            });
                            _self.getVideoList();

                        }else{
                            swal("실패", "일시적으로 에러가 발생했습니다.", "danger", {
                                buttons: false,
                                timer: 1500
                            });
                        }
                    })
                    .catch(function (err) {
                        console.error(err);
                        swal("실패", err, "danger", {
                            buttons: false,
                            timer: 1500
                        });
                    });
            }
        }
    });


</script>
</body>
</html>