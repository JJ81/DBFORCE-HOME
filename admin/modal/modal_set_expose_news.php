<div class="modal fade" id="modalSetMainNews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo ROOT;?>admin/news/response/res_set_expose_news.php" method="post" class="form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">뉴스 메인 노출 설정</h5>
                    <button type="button" class="close btn-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="number" class="form-control" name="pickup_order"
                               placeholder="노출값을 입력 (값이 높을수록 상위에 출력)" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                    <button type="submit" class="btn btn-primary">설정하기</button>
                </div>
                <input type="hidden" name="news_id" class="js-news-id" />
            </form>
        </div>
    </div>
</div>