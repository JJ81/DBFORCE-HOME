<div class="modal fade" id="modalDeviceInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    디바이스 정보
                </h5>
                <button type="button" class="close btn-modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <table class="table">
                        <tr>
                            <td colspan="2" style="border-top: none;text-align: left;">
                                {{device_info}}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-warning" data-dismiss="modal">닫기</button>
            </div>

        </div>
    </div>
</div>