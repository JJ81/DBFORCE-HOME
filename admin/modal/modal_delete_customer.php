<div class="modal fade" id="modalDeleteCustomerInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="#" method="post" class="form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">고객정보삭제</h5>
                    <button type="button" class="close btn-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text"
                               class="form-control"
                               name="name"
                               placeholder="이름"
                               maxlength="10"
                               readonly
                               v-model="cs_name"
                               required />
                    </div>
                    <div class="form-group">
                        <input type="tel"
                               class="form-control"
                               name="phone"
                               placeholder="핸드폰번호(-포함)"
                               maxlength="13"
                               readonly
                               v-model="cs_phone"
                               required />
                    </div>
                    <div class="text-danger"><small>[주의] 고객정보 삭제시, 고객정보와 관련된 모든 내용이 모두 삭제됩니다.</small></div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                    <button type="button" class="btn btn-danger" @click="deleteCustomerInfo();">삭제</button>
                    <input type="hidden" class="js-customer-id" name="id" v-model="cs_id" />
                </div>
            </form>
        </div>
    </div>
</div>