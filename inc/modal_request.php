<div class="as-modal-reqeust-form">
    <div class="as-modal-reqeust-form-inner">
        <h6 class="as-modal-title">
            <img src="<?php echo ROOT;?>assets/img/logo-pc.png" alt="안심금융조회서비스" />
            <a href="#close_modal" class="as-modal-close">
                <img src="<?php echo ROOT;?>assets/img/img-modal-close.png" alt="닫기" />
            </a>
        </h6>
        <div class="as-modal-sub-title">
            누구나 쉽게 금융상품을 비교분석할 수 있도록<br />
            <strong class="as-bold-blue">안심금융조회서비스</strong>가 함께 하겠습니다.
        </div>

        <div class="as-modal-form-body">
            <form action="#" method="post">
                <div class="form-group">
                    <label for="as-name">이름</label>
                    <input type="text"
                           name="name"
                           class="as-form-input"
                           id="as-name"
                           required />
                </div>
                <div class="form-group">
                    <label for="as-birthday">생년월일</label>
                    <input type="text"
                           name="birthday"
                           class="as-form-input"
                           id="as-birthday"
                           placeholder="예시) 19760310"
                           required />
                </div>
                <div class="form-group">
                    <label for="as-phone2">휴대폰</label>
                    <div class="clearfix" style="margin-top: 5px;">
                        <input type="tel"
                               name="phone-1"
                               class="as-form-input-tel"
                               id="as-phone"
                               value="010"
                               maxlength="3"
                               required />
                        <input type="tel"
                               name="phone-2"
                               class="as-form-input-tel"
                               id="as-phone2"
                               maxlength="4"
                               required />
                        <input type="tel"
                               name="phone-3"
                               class="as-form-input-tel"
                               id="as-phone3"
                               maxlength="4"
                               required />
                    </div>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="agreement" id="as-modal-agreement" checked />
                    <label for="as-modal-agreement">개인정보수집 및 이용 동의</label>
                </div>
                <div class="form-group center as-form-btn-area">
                    <button type="submit" class="as-btn-free-request">전문가 무료 상담 신청</button>
                </div>
                <?php // 'L','D','RD','D2','IS' ?>
                <input type="hidden" name="req_item_type" class="as-modal-req-type" />
                <input type="hidden" name="path" value="<?php echo CURRENT_URL;?>" />
            </form>
        </div>
    </div>
</div>