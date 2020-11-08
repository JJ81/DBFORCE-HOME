<div class="modal fade" id="modalInstallmentInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    적금 상세정보
                </h5>
                <button type="button" class="close btn-modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div style="max-height: 700px;overflow-y: auto;resize: vertical;">
                    <table class="table table-hover">
                        <tr>
                            <th class="center">공시제출월</th>
                            <th class="center">저축금리유형</th>
                            <th class="center">적립유형</th>
                            <th class="center">저축기간</th>
                            <th class="center">저축금리</th>
                            <th class="center">저축 우대금리</th>
                        </tr>
                        <tr v-if="infos.length === 0">
                            <td class="center" colspan="6">등록된 정보가 없습니다.</td>
                        </tr>

                        <tr v-else v-for="info in infos">
                            <td class="center">{{info.dcls_month}}</td>
                            <td class="center">{{info.intr_rate_type_nm}} <small>({{info.intr_rate_type}})</small></td>
                            <td class="center">{{info.rsrv_type}} <small>({{info.rsrv_type_nm}})</small></td>
                            <td class="center color-primary">{{info.save_trm}}</td>
                            <td class="center color-primary">{{info.intr_rate}}</td>
                            <td class="center color-primary">{{info.intr_rate2}}</td>
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