<div style="position: fixed; bottom: 0; left: 0; width: 100%;background: #5e0a0e;z-index: 100;">
    <div style="margin: 0 auto; width: 1200px;position: relative;">
        <div style="padding-left: 410px;padding-right: 300px;height: 150px;">
            <form action="<?php echo ROOT;?>response/res_gather_request.php" method="post">
                <img src="<?php echo ROOT;?>assets/img/img-pc-form-title.jpg"
                     alt=""
                     style="position: absolute; top: 0; left: 0;" />

                <div style="padding-top: 50px;padding-left: 20px;">
                    <input type="text"
                           name="name"
                           maxlength="10"
                           required
                           placeholder="이름 입력"
                           style="height: 40px;line-height: 40px;color: #606060; font-size: 18px; box-sizing: border-box; padding: 0 20px; width: 180px;" />
                    <input type="tel"
                           name="tel"
                           required
                           placeholder="전화번호 (-포함)"
                           maxlength="13"
                           style="height: 40px;line-height: 40px;color: #606060; font-size: 18px; box-sizing: border-box; padding: 0 20px; width: 250px;margin-left: 20px;" />
                </div>

                <div style="color: #D7D7D7;font-size: 12px;padding-left: 20px;padding-top: 10px;">
                    <input type="checkbox" id="vt-check-agreement" required checked />
                    <label for="vt-check-agreement">개인정보수집 및 이용동의</label> &nbsp;&nbsp;
                    <a href="<?php echo ROOT;?>agreement.php"
                       target="_blank"
                       class="vt-view-agreement" style="color: #fff;text-decoration: underline;">전문보기</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="vt-check-agreement-2" required checked />
                    <label for="vt-check-agreement-2">마케팅수신동의</label> &nbsp;&nbsp;
                    <a href="<?php echo ROOT;?>agreement.php"
                       target="_blank"
                       class="vt-view-agreement" style="color: #fff;text-decoration: underline;">전문보기</a>
                </div>

                <button type="submit" style="position: absolute;top: 49px; right: 40px;outline: none;border: none;">
                    <img src="<?php echo ROOT;?>assets/img/btn-form-req.jpg" alt="" />
                </button>

                <input type="hidden" name="path" value="<?php echo CURRENT_URL;?>" />
                <input type="hidden" name="req_item_type" value="MainHome" />
                <input type="hidden" class="jp-hidden-referrer" name="referrer" />
            </form>
        </div>
    </div>
</div>