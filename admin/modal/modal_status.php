<div class="modal fade" id="createCardMethod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">상태 추가</h5>
                <button type="button" class="close btn-modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div style="overflow-y:scroll;max-height: 400px;">
                    <table class="table">
                        <tr>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       name="status"
                                       placeholder="상태값 입력"
                                       required
                                       v-model="current_value"
                                       autocomplete="off" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       name="desc"
                                       placeholder="부가설명"
                                       required
                                       v-model="current_desc"
                                       autocomplete="off" />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">취소</button>
                <button type="button" class="btn btn-primary"
                        @click="createStatus()"
                        v-if="mode==='ADD'">등록</button>
                <button type="button" class="btn btn-warning"
                        @click="modifyStatus()"
                        v-if="mode==='MOD'">수정</button>
            </div>
            <input type="hidden" name="prev_path" value="<?php echo CURRENT_URL;?>" />
        </div>
    </div>
</div>