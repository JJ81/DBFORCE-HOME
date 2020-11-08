<div class="modal fade" id="modalOrderVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="#" class="form form-video-order">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">영상 순서 조정</h5>
                    <button type="button" class="close btn-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table vue-table-order-video">
                        <colgroup>
                            <col width="*" />
                            <col width="100" />
                        </colgroup>
                        <tr v-for="ls in lists" :key="ls">
                            <th>{{ls.video_title}}</th>
                            <td valign="middle">
                                <input type="text"
                                       class="form-control center"
                                       v-model="ls.order"
                                       :value="ls.order" />
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                    <button type="button" class="btn btn-primary" @click="adjustVideoOrder">적용</button>
                </div>
            </form>
        </div>
    </div>
</div>