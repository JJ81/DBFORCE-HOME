var vue_memo=new Vue({
    el: "#readMemoByCustomerId",
    data: {
        lists: [],
        c_name: null,
        c_id : null,
        msg : null,
        selected_memo_id: null,
        mode: "ADD" // ADD or MOD
    },

    methods:{
        openModal: function(cid, cname){
            if(!cid){
                alert('잘못된 요청입니다.');
                return;
            }

            this.c_id=cid;
            this.c_name=cname;
            this.msg=null;
            this.selected_memo_id=null;
            this.mode="ADD";


            $('#readMemoByCustomerId').modal('show');
            this.fetchMemoByCid(cid);
        },

        fetchMemoByCid: function (cid) {
            var _self=this;

            if(!cid){
                alert('잘못된 요청입니다.');
                return;
            }

            axios.get('/api/memo/get_memo.php?customer_id=' + cid)
                .then(function (res) {
                    if(res.data.success){
                        _self.lists=res.data.data;

                        if(res.data.data.length>0){
                            _self.c_name=res.data.data[0]['name'];
                            _self.c_id=res.data.data[0]['customer_id'];
                        }

                    }else{
                        alert('데이터를 가져오는 데 실패하였습니다. 다시 시도해 주세요.');
                        window.location.reload();
                    }
                })
                .catch(function (err) {
                    console.error(err);
                    alert(err);
                });
        },

        deleteMemoById: function (memo_id, cs_id) {
            console.info('check value to delete memo');
            console.info(memo_id + " / " + cs_id);

            var _self=this;
            var formData=new FormData();
            formData.append('cs_id', cs_id);
            formData.append('memo_id', memo_id);

            axios.post('/api/memo/del_memo.php', formData)
                .then(function (res){
                    console.info(res);
                    if(res.data.success){
                        _self.msg=null;
                        _self.selected_memo_id=null;
                        _self.mode="ADD";
                        _self.fetchMemoByCid(cs_id);
                    }
                    vueCustomerTable.getList();
                })
                .catch(function (err) {
                    console.error(err);
                    alert(err);
                });
        },

        addNewMemo: function () {
            var _self=this;

            if(_self.msg === '' || _self.msg === null){
                alert('메모를 입력하세요.');
                return;
            }

            var formData=new FormData();
            formData.append('cs_id', _self.c_id);
            formData.append('memo', _self.msg);

            axios.post('/api/memo/set_memo.php', formData)
                .then(function (res){
                    console.info(res);
                    if(res.data.success){
                        _self.msg=null;
                        _self.fetchMemoByCid(_self.c_id);
                    }
                    vueCustomerTable.getList();
                })
                .catch(function (err) {
                    console.error(err);
                    alert(err);
                });
        },

        switchMemoMode: function(memo_id, idx){
            var _self=this;
            _self.selected_memo_id=memo_id;

            if(_self.mode === 'ADD'){
                _self.mode="MOD";
                _self.msg=_self.lists[idx]['memo'];


            }else if(_self.mode === 'MOD'){
                _self.mode="ADD";
                _self.selected_memo_id=null;
                _self.msg=null;
            }
        },

        modifyMemo: function () {
            var _self=this;
            var formData=new FormData();

            if(_self.msg === '' || _self.msg === null){
                alert('메모를 입력하세요.');
                return;
            }

            formData.append('memo_id', _self.selected_memo_id);
            formData.append('memo', _self.msg);

            axios.post('/api/memo/mod_memo.php', formData)
                .then(function (res){
                    console.info(res);
                    if(res.data.success){
                        _self.msg=null;
                        _self.mode='ADD';
                        _self.selected_memo_id=null;
                        _self.fetchMemoByCid(_self.c_id);
                        vueCustomerTable.getList();
                    }
                })
                .catch(function (err) {
                    console.error(err);
                    alert(err);
                });
        }
    }
});