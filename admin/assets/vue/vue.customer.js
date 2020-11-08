var vueModalCustomerModify=new Vue({
    el: "#modalModifyCustomerInfo",
    data: {
        cs_id: null,
        name: null,
        phone: null,
        status_id: null,
        created_dt: null,

        status_list: []
    },
    beforeMount: function () {
        this.getStatusList();
    },
    methods: {
        getStatusList: function () {
            var _self=this;
            axios.get('/api/status/get_list.php')
                .then(function(res){
                    console.info(res);
                    if(res.data.success){
                        _self.status_list=res.data.result
                    }
                })
                .catch(function (err) {
                    console.error(err);
                });
        },

        modifyCustomerInfo: function (){
            var _self=this;
            if(_self.cs_id === null || _self.cs_id === ''){
                alert('잘못된 접근입니다. 다시 시도해주세요.');
                return;
            }

            if(_self.name === null || _self.name===null){
                alert('고객명 필드가 비어 있습니다.');
                return;
            }

            if(_self.phone === null || _self.phone===null){
                alert('핸드폰번호 필드가 비어 있습니다.');
                return;
            }

            if(_self.created_dt === null || _self.created_dt===null){
                alert('등록일 필드가 비어 있습니다.');
                return;
            }

            var formData=new FormData();
            formData.append('cs_id', _self.cs_id);
            formData.append('cs_name', _self.name);
            formData.append('phone', _self.phone);
            formData.append('created_dt', _self.created_dt);
            formData.append('status_id', _self.status_id);

            axios.post('/api/customer/mod_customer_info.php', formData)
                .then(function (res) {
                    if(res.data.success){
                        console.info(res.data.result);
                    }

                    swal("성공", "고객정보가 수정되었습니다.", "success", {
                        buttons: false,
                        timer: 1500
                    });

                    $('#modalModifyCustomerInfo').modal('hide');
                    vueCustomerTable.getList();
                })
                .catch(function (err) {
                    console.error(err);
                    swal("실패", "일시적으로 에러가 발생했습니다.", "danger", {
                        buttons: false,
                        timer: 1500
                    });
                });
        }

    }
});

var vueModalCustomerDelete=new Vue({
    el: "#modalDeleteCustomerInfo",
    data:{
        cs_id: null,
        cs_name: null,
        cs_phone: null
    },
    methods: {
        deleteCustomerInfo: function (){
            var _self=this;
            var formData=new FormData();
            formData.append('cs_id', _self.cs_id);

            axios.post('/api/customer/del_customer_info.php', formData)
                .then(function (res) {
                    if(res.data.success){
                        swal("성공", "고객정보가 삭제되었습니다.", "success", {
                            buttons: false,
                            timer: 1500
                        });
                    }else{
                        console.error(res.data.msg);
                        swal("실패", "고객정보 삭제에 실패하였습니다.", "warning", {
                            buttons: false,
                            timer: 1500
                        });
                    }

                    $('#modalDeleteCustomerInfo').modal('hide');
                    vueCustomerTable.getList();
                })
                .catch(function(err) {
                    console.error(err);
                    swal("실패", "일시적 에러가 발생했습니다.", "danger", {
                        buttons: false,
                        timer: 1500
                    });
                });
        }
    }
});
