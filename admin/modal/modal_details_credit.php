<div class="modal fade" id="modalCreditInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    개인신용대출 상세정보
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
                            <th class="center">금리구분</th>
                            <th class="center">등급1</th>
                            <th class="center">등급4</th>
                            <th class="center">등급5</th>
                            <th class="center">등급6</th>
                            <th class="center">등급10</th>
                            <th class="center">평균금리</th>
                        </tr>
                        <tr v-if="infos.length === 0">
                            <td class="center" colspan="8">등록된 정보가 없습니다.</td>
                        </tr>

                        <tr v-else v-for="info in infos">
                            <td class="center">{{info.dcls_month}}</td>
                            <td class="center">{{info.crdt_lend_rate_type_nm}} <small>({{info.crdt_lend_rate_type}})</small></td>
                            <td class="center">{{info.crdt_grad_1}}</td>
                            <td class="center">{{info.crdt_grad_4}}</td>
                            <td class="center">{{info.crdt_grad_5}}</td>
                            <td class="center">{{info.crdt_grad_6}}</td>
                            <td class="center">{{info.crdt_grad_10}}</td>
                            <td class="center">{{info.crdt_grad_avg}}</td>
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