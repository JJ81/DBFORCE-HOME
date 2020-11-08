<div class="modal fade" id="modalModifyPassByAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo ROOT;?>admin/employee/response/res_reset_pw.php" method="post" class="form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">비밀번호 변경</h5>
                    <button type="button" class="close btn-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="password"
                               class="form-control form-admin-pass"
                               name="password"
                               placeholder="변경할 비밀번호" required />
                    </div>
                    <div class="form-group">
                        <input type="password"
                               class="form-control form-admin-pass"
                               name="re_password"
                               placeholder="변경할 비밀번호 확인" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                    <button type="submit" class="btn btn-primary">변경하기</button>
                </div>
                <input type="hidden" name="employee_id" class="modal-employee-id" />
            </form>
        </div>
    </div>
</div>