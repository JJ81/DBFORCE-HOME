<div class="free-list-area-top">
    <div class="free-list-area-inner">

        <div class="vt-free-request-stream vt-free-request-stream-m">
            <div class="vt-free-request-stream-inner clearfix">
                <div class="ti-notice-stream">
                    <div class="vt-free-request-title">
                        <strong style="font-size: 14px;"> <?php echo $today_month;?>월<?php echo $today_day;?>일자</strong>
                        <span style="font-size: 14px;">
                            <strong style="color: #faee18;">유료서비스</strong>
                            신청현황
                        </span>
                    </div>

                    <div class="vt-free-request-lists">
                        <div class="TickerNews" id="T1">
                            <div class="ti_wrapper">
                                <div class="ti_slide clearfix">
                                    <div class="ti_content">
                                        <?php for($fe=0,$size_fe=count($free_req_lists);$fe<$size_fe;$fe++){ ?>
                                            <div class="ti_news">
                                                <?php echo $free_req_lists[$fe]['user_name'];?>(<?php echo $free_req_lists[$fe]['tel_end'];?>)님 신청완료
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>