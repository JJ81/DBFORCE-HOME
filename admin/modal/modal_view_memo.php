<div class="modal fade" id="readMemoByCustomerId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">메모내역 &nbsp;&nbsp;<small>(디비명: {{c_name}})</small></h3>
                <button type="button" class="close btn-modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-table-header">
                    <div class="modal-table-header-cell">
                        날짜/내역
                    </div>
                    <div class="modal-table-header-cell">
                        메모내용
                    </div>
                    <div class="modal-table-header-cell">
                         액션
                    </div>
                </div>
                <div class="modal-table-wrapper">

                    <!-- loop -->
                    <div class="modal-table-body" v-for="(ls, index) in lists">
                        <div class="modal-table-body-cell">{{ls.created_dt}} <small v-if="ls.admin_id">({{ls.admin_id}})</small></div>
                        <div class="modal-table-body-cell">{{ls.memo}}</div>
                        <div class="modal-table-body-cell">
<!--                            <span v-if="mode === 'MOD' && selected_memo_id === ls.memo_id">수정취소</span>-->
<!--                            <span v-if="mode === 'ADD' && selected_memo_id !== ls.memo_id">수정</span>-->

                            <a href="#"
                               class="btn btn-sm btn-outline-warning"
                               v-if="mode === 'MOD' && selected_memo_id === ls.memo_id"
                               @click="switchMemoMode(ls.memo_id, index)">수정취소</a>
                            <a href="#"
                               class="btn btn-sm btn-outline-warning"
                               v-if="mode === 'ADD' && selected_memo_id !== ls.memo_id"
                               @click="switchMemoMode(ls.memo_id, index)">수정</a>
                            <a href="#" class="btn btn-sm btn-outline-danger"
                               @click="deleteMemoById(ls.memo_id, ls.customer_id)">삭제</a>
                        </div>
                    </div>
                    <!-- // loop -->

                </div>

                <div>
                    <textarea name="memo"
                              cols="30"
                              rows="10"
                              class="form-control js-memo-place"
                              style="min-height: 100px;"
                              v-model="msg"
                              placeholder="새로운 메모를 입력하세요."></textarea>
                </div>
            </div>
            <div class="modal-footer clearfix">
<!--                <span v-if="mode=='ADD'">추가</span>-->
<!--                <span v-if="mode=='MOD'">수정</span>-->

                <a href="#" class="btn btn-success" @click="addNewMemo();" v-if="mode=='ADD'">추가</a>
                <a href="#" class="btn btn-warning" @click="modifyMemo();" v-if="mode=='MOD'">수정</a>
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>