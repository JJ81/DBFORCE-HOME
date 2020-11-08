<div class="as-request-holder">
    <div class="as-request-holder clearfix">
        <div class="as-request-box">
            <div class="as-request-box-inner">
                <h4 class="as-request-box-title">맞춤 안심 보험 상담</h4>
                <p class="as-request-box-desc">
                    안심금융조회서비스이 알찬정보!<br />
                    전문가 상담받고, 보험료는 낮추고 보장은 올리세요.
                </p>
                <form action="./response/res_gather_request.php" method="post" class="as-form-request-01">
                    <div class="as-form-name-holder">
                        <input type="text" name="name" class="as-input-field" required autocomplete="off" placeholder="이름을 입력하세요." />
                    </div>
                    <div class="as-form-tel-holder">
                        <input type="tel" name="tel" class="as-input-field" required autocomplete="off" placeholder="전화번호를 -없이 입력하세요." />
                    </div>
                    <div class="as-form-agree-holder">
                        <input type="checkbox" id="as-agreement-01" required checked />
                        <label for="as-agreement-01">개인정보 수집 및 이용동의</label>
                    </div>
                    <div class="as-form-btn-holder">
                        <button type="submit" class="as-form-submit-btn">무료상담신청</button>
                    </div>
                    <input type="hidden" name="req_item_type" value="IS" />
                    <input type="hidden" name="path" value="<?php echo CURRENT_URL;?>" />
                </form>
            </div>
        </div>
        <div class="as-request-box">
            <div class="as-request-box-inner">
                <h4 class="as-request-box-title">저금리 안심 대출 상담</h4>
                <p class="as-request-box-desc">
                    신용정보조회 없이 간단하게!<br />
                    나에게 적합한 대출상품, 안심하고 추천받으세요.
                </p>
                <form action="./response/res_gather_request.php" method="post" class="as-form-request-02">
                    <div class="as-form-name-holder">
                        <input type="text" name="name" class="as-input-field" required autocomplete="off" placeholder="이름을 입력하세요." />
                    </div>
                    <div class="as-form-tel-holder">
                        <input type="tel" name="tel" class="as-input-field" required autocomplete="off" placeholder="전화번호를 -없이 입력하세요." />
                    </div>
                    <div class="as-form-agree-holder">
                        <input type="checkbox" id="as-agreement-02" required checked />
                        <label for="as-agreement-02">개인정보 수집 및 이용동의</label>
                    </div>
                    <div class="as-form-btn-holder">
                        <button type="submit" class="as-form-submit-btn">무료상담신청</button>
                    </div>
                    <input type="hidden" name="req_item_type" value="L" />
                    <input type="hidden" name="path" value="<?php echo CURRENT_URL;?>" />
                </form>
            </div>
        </div>
    </div>
</div>
