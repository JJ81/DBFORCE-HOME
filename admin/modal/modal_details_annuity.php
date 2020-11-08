<div class="modal fade" id="modalAnnuityInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    연금저축 상세정보
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
                            <th class="center">수령기간</th>
                            <th class="center">가입연령</th>
                            <th class="center">월납입액</th>
                            <th class="center">납입기간</th>
                            <th class="center">연금개시연령</th>
                            <th class="center">수령액 <small>(원)</small></th>
                        </tr>
                        <tr v-if="infos.length === 0">
                            <td class="center" colspan="7">등록된 정보가 없습니다.</td>
                        </tr>

                        <tr v-else v-for="info in infos">
                            <td class="center">{{info.dcls_month}}</td>
                            <td class="center">{{info.pnsn_recp_trm_nm}}</td>
                            <td class="center">{{info.pnsn_entr_age_nm}}</td>
                            <td class="center">{{info.mon_paym_atm_nm}}</td>
                            <td class="center">{{info.paym_prd_nm}}</td>
                            <td class="center">{{info.pnsn_strt_age_nm}}</td>
                            <td class="color-primary">{{insertCommaInDigit(info.pnsn_recp_amt)}}</td>
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