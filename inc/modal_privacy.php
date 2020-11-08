<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">개인정보취급방침</h4>
            </div>
            <div class="modal-body">
                <div style="white-space: pre-line;font-size: 12px;"><?php if(!empty($privacy[0]['privacy'])) {echo html_entity_decode($privacy[0]['privacy']);}else{ echo '관리자에서 해당 정보를 입력하세요.';} ?></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>