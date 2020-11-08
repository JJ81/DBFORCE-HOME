var vueStatus = new Vue({
    el: "#vueStatus",
    data: {
        lists: []
    },
    beforeMount: function (){
        this.getList();
    },
    methods: {
        getList: function () {
            var _self=this;
            axios.get('/api/status/get_list.php')
                .then(function (res){
                    console.log(res.data.result);
                    if(res.data.success){
                        _self.lists=res.data.result;
                    }else{
                        console.error(res.data.msg);
                    }
                })
                .catch(function(err){
                    console.error(err);
                });
        },


        openModal: function (targetId, status_id, mode, idx) {
            vueModalStatus.mode=mode;
            vueModalStatus.current_value=null;
            vueModalStatus.current_desc=null;
            vueModalStatus.selected_status_id=null;
            // 추가할 때와 수정할 때의 처리
            if(mode === 'ADD'){
                // vueModalStatus.current_value=null;
                // vueModalStatus.current_desc=null;
                // vueModalStatus.selected_status_id=null;
            }else if(mode === 'MOD'){
                vueModalStatus.selected_status_id=status_id;
                vueModalStatus.current_value=this.lists[idx]['name'];
                vueModalStatus.current_desc=this.lists[idx]['description'];
            }

            $(targetId).modal('show');
        },

        closeModal: function (targetId) {
            $(targetId).modal('hide');
        }

    }
});

var vueModalStatus=new Vue({
    el: "#createCardMethod",
    data: {
        current_value: null,
        current_desc: null,
        mode : 'ADD',
        selected_status_id: null
    },
    methods: {
        createStatus: function () {
            var _self=this;
            var formData=new FormData();

            if(_self.current_value === '' || _self.current_value === null){
                alert('상태값을 입력하세요.');
                return;
            }

            formData.append('name', _self.current_value);
            formData.append('desc', _self.current_desc);

            axios.post('/api/status/set_status.php', formData)
                .then(function (res){
                    console.info(res);
                    if(res.data.success){
                        _self.current_value=null;
                        _self.current_desc=null;
                        vueStatus.closeModal("#createCardMethod");
                        vueStatus.getList();
                    }
                })
                .catch(function (err) {
                    console.error(err);
                    alert(err);
                });
        },

        modifyStatus: function () {
            var _self=this;
            var formData=new FormData();
            formData.append('status_id', _self.selected_status_id);
            formData.append('name', _self.current_value);
            formData.append('desc', _self.current_desc);

            axios.post('/api/status/mod_status.php', formData)
                .then(function (res) {
                    console.info(res.data);
                    if(res.data.success){
                        console.info('success to modify status value');
                    }else{
                        console.error('failed to modify status value');
                    }
                    vueStatus.closeModal("#createCardMethod");
                    vueStatus.getList();
                })
                .catch(function (err) {
                    console.error(err);
                });
        },

        deleteStatus: function (status_id) {
            var _self=this;

            swal({
                title: "삭제",
                text: '정말로 선택한 상태값을 삭제하시겠습니까?',
                icon: "warning",
                buttons: true,
                dangerMode: true
            })
                .then(function(yes){
                    if(yes){
                        var formData=new FormData();
                        formData.append('status_id', status_id);

                        axios.post('/api/status/del_status.php', formData)
                            .then(function (res) {
                                console.info(res.data);
                                if(res.data.success){
                                    console.info('success to delete status value');
                                    swal("성공", "정상적으로 삭제 되었습니다.", "success", {
                                        buttons: false,
                                        timer: 1500
                                    });

                                }else{
                                    console.error('failed to delete status value');
                                    swal("경고", "사용중인 상태값은 제거할 수 없습니다.", "warning", {
                                        buttons: false,
                                        timer: 1500
                                    });
                                }
                                vueStatus.closeModal("#createCardMethod");
                                vueStatus.getList();
                            })
                            .catch(function (err) {
                                console.error(err);
                            });

                    }

                });

        }
    }
});

