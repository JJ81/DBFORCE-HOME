<div class="modal fade" id="modalSetMemo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo ROOT;?>admin/customer/response/res_set_memo.php" method="post" class="form-set-memo">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        DB 메모 &nbsp;
                        <small class="memo-db-name"></small>
                    </h5>
                    <button type="button" class="close btn-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <table class="table">
                            <tr>
                                <td colspan="2" style="border-top: none;">
                                    <textarea name="memo"
                                              id="memo"
                                              cols="30"
                                              class="form-control memo-area"
                                              style="min-height: 200px;"
                                              rows="10"></textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">취소</button>
                    <button type="submit" class="btn btn-primary js-save-memo">저장</button>
                </div>
                <input type="hidden" name="cs_id" class="memo-cs-id" />
                <input type="hidden" name="prev_path" value="<?php echo CURRENT_URL;?>" />
            </form>
        </div>
    </div>
</div>