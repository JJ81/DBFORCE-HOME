<div class="modal fade" id="modalAddNewVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="#" class="form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">영상 추가</h5>
                    <button type="button" class="close btn-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text"
                               class="form-control"
                               name="video_title"
                               v-model="title"
                               placeholder="영상 제목" />
                    </div>
                    <div class="form-group">
                        <input type="text"
                               class="form-control"
                               name="video_url"
                               v-model="url"
                               placeholder="예) d0g1tQJTDws" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                    <button type="button" class="btn btn-primary" @click="addNewVideo">추가하기</button>
                </div>
            </form>
        </div>
    </div>
</div>