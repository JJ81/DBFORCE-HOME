<div class="free-request">
    <form action="<?php echo ROOT;?>response/res_gather_request.php"
          class="js-form-request form-req-estimate"
          method="post">
        <table class="table-request">
            <tr>
                <td width="25%" class="label-req">이름</td>
                <td width="75%">
                    <input type="text"
                           name="name"
                           class="form-control name jp-customer-name"
                           autocomplete="off"
                           maxlength="5"
                           placeholder="이름을 입력하세요."
                           required />
                </td>
            </tr>
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
                <td width="25%" class="label-req">
                    <span>전화번호</span>
                </td>
                <td width="75%" class="phone-area">
                    <div class="clearfix">
                        <input type="tel" name="tel-first"
                               class="form-control"
                               autocomplete="off"
                               maxlength="3"
                               required />
                        <span>&nbsp;</span>
                        <input type="tel" name="tel-mid"
                               class="form-control"
                               autocomplete="off"
                               maxlength="4"
                               required />
                        <span>&nbsp;</span>
                        <input type="tel" name="tel-end"
                               class="form-control"
                               autocomplete="off"
                               maxlength="4"
                               required />
                    </div>
                </td>
            </tr>
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
                <td width="25%" class="label-req">
                    <span>가입선택</span>
                </td>
                <td width="75%" class="phone-area">
                    <div class="clearfix">
                        <select name="path" class="form-control" style="height: 45px;">
                            <option value="A" <?php if(PAGE === 'START'){ echo 'selected';}?>>종잣돈 모으기</option>
                            <option value="B" <?php if(PAGE === 'TRAIN'){ echo 'selected';}?>>투자 훈련소</option>
                            <option value="C" <?php if(PAGE === 'CAMP'){ echo 'selected';}?>>베이스캠프</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-top: 15px;">
                    <label for="agreement" style="color: #fff;font-size: 12px;">
                        <input type="checkbox" name="agreement" id="agreement"
                               checked
                               required
                               style="vertical-align: middle;position: relative;top: -2px;white-space: nowrap;" /> 개인정보 수집동의
                    </label>
                    <a href="#none" style="font-size: 12px;color: #fff;margin-left: 5px;white-space: nowrap; text-decoration: underline;"
                       class="js-view-agreement"
                       data-toggle="modal"
                       data-target="#exampleModalCenter">[자세히 보기]</a>
                </td>
            </tr>


        </table>

        <div class="center" style="margin-top: 15px;">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <input type="hidden" name="referrer" class="jp-hidden-referrer" />
                    <button type="button"
                            data-pos="<?php echo $pass;?>"
                            class="btn is-request-remodel js-btn-register jp_submit_estimate"
                            style="line-height: 60px;padding: 0;">
                        가입상담 신청하기 <i class="fa fa-spinner faa-spin animated blind"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>