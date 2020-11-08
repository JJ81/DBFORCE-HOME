<div class="modal fade" id="modalModifyCustomerInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="#" method="post" class="form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">고객정보수정</h5>
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
                               v-model="name"
                               required />
                    </div>
                    <div class="form-group">
                        <input type="tel"
                               class="form-control"
                               name="phone"
                               placeholder="핸드폰번호(-포함)"
                               maxlength="13"
                               v-model="phone"
                               required />
                    </div>
                    <div class="form-group">
                        <input type="date"
                               class="form-control js-customer-created-dt"
                               name="created_dt"
                               v-model="created_dt"
                               required />
                    </div>

                    <div class="form-group">
                        <select name="status" class="form-control" v-model="status_id">
                            <option value="null">상태(분류)선택</option>
                            <template v-for="sl in status_list">
                                <option :value="sl.id">
                                    {{sl.name}}
                                </option>
                            </template>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                    <button type="button" class="btn btn-warning" @click="modifyCustomerInfo">수정</button>
                    <input type="hidden" class="js-customer-id" name="id" v-model="cs_id" />
                </div>
            </form>
        </div>
    </div>
</div>