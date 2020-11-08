(function ($) {
    // 숫자만 입력가능
    var
        first_tel=$("input[name='tel-first']"),
        mid_tel=$("input[name='tel-mid']"),
        end_tel=$("input[name='tel-end']");

    first_tel.bind('keyup keydown', digitInput);
    mid_tel.bind('keyup keydown', digitInput);
    end_tel.bind('keyup keydown', digitInput);

    function digitInput(){
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    }

    function resizeVideoHolder(target, ratio){
        var width=target.outerWidth();
        target.css('height', width*ratio);
    }

    $(window).bind('load resize', function () {
        resizeVideoHolder($('.jp-video-iframe'), 0.565);
    });

}(jQuery));