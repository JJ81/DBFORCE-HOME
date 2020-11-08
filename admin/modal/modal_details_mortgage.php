<div class="modal fade" id="modalMortgageInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    주택담보대출 상세정보
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
                            <th class="center">담보유형</th>
                            <th class="center">대출상환유형*</th>
                            <th class="center">대출금리유형</th>
                            <th class="center">최저</th>
                            <th class="center">최고</th>
                            <th class="center">평균</th>
                        </tr>
                        <tr v-if="infos.length === 0">
                            <td class="center" colspan="7">등록된 정보가 없습니다.</td>
                        </tr>

                        <tr v-else v-for="info in infos">
                            <td class="center">{{info.dcls_month}}</td>
                            <td class="center">{{info.mrtg_type_nm}}</td>
                            <td class="center">{{info.rpay_type_nm}}</td>
                            <td class="center">{{info.lend_rate_type_nm}}</td>
                            <td class="center color-primary">{{info.lend_rate_min}}</td>
                            <td class="center color-primary">{{info.lend_rate_max}}</td>
                            <td class="center color-primary">{{info.lend_rate_avg}}</td>
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