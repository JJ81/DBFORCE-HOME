var
    form=$('.form-req-estimate'),
    target=null,
    first_tel=$("input[name='tel-first']"),
    mid_tel=$("input[name='tel-mid']"),
    end_tel=$("input[name='tel-end']");

first_tel.bind('keyup keydown', digitInput);
mid_tel.bind('keyup keydown', digitInput);
end_tel.bind('keyup keydown', digitInput);

function digitInput(){
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
}

$('.jp_submit_estimate').bind('click', function (e) {
    e.preventDefault();

    // 전송 중에는 버튼을 비활성화시킨다.
    if($(this).hasClass('js-jp-active')){
        alert('제출중입니다. 잠시만 기다려 주세요.');
        return;
    }

    var index=$(this).attr('data-pos'); // current form index
    console.info(index);

    target=form.eq(index);

    if(validateFormEstimate(target)){
        console.log('전송시도중');

        $(this).addClass('js-jp-active');
        $(this).find('.animated').removeClass('blind');
    }
});


function validateFormEstimate(form_el){
    if(form_el.find('.jp-customer-name').val().trim() === ''){
        alert('성함을 입력해주세요.');
        form_el.find('.jp-customer-name').focus();
        return false;
    }

    if(form_el.find("input[name='tel-first']").val().trim() === ''){
        alert('연락처를 입력해주세요.');
        form_el.find("input[name='tel-first']").focus();
        return false;
    }

    if(form_el.find("input[name='tel-mid']").val().trim() === ''){
        alert('연락처를 입력해주세요.');
        form_el.find("input[name='tel-mid']").focus();
        return false;
    }

    if(form_el.find("input[name='tel-end']").val().trim() === ''){
        alert('연락처를 입력해주세요.');
        form_el.find("input[name='tel-end']").focus();
        return false;
    }

    if(!form_el.find('#agreement').prop('checked')){
        alert('개인정보활용동의를 체크해주세요.');
        form_el.find('#agreement').focus();
        return false;
    }

    target.submit();
    return true;
}

function checkReferrer(){
    return document.referrer;
}

$(window).bind('load', function () {
    $('.jp-hidden-referrer').val(checkReferrer());
});