(function ($) {

    function getWindowWidth(){
        return $(window).width();
    }

    function hidePreloader(){
        $('.jp-ld-preloader').fadeOut();
    }

    function isMobile(){
        if( navigator.userAgent.match(/Android/i)
            || navigator.userAgent.match(/webOS/i)
            || navigator.userAgent.match(/iPhone/i)
            || navigator.userAgent.match(/iPad/i)
            || navigator.userAgent.match(/iPod/i)
            || navigator.userAgent.match(/BlackBerry/i)
            || navigator.userAgent.match(/Windows Phone/i)
        ){
            return true;
        }
        else {
            return false;
        }
    }

    $(window).bind('load', function () {
        hidePreloader();
    });

    var modalRequest=$('.as-modal-reqeust-form');

    // 유전자 분석 보험 컨설팅
    $('.js-as-gene-request').bind('click', function (e) {
        e.preventDefault();
        modalRequest.fadeIn();
    });

    // 문의창 닫기
    $('.as-modal-close').bind('click', function (e) {
        e.preventDefault();
        modalRequest.fadeOut();
    });

    // 상품 상세보기
    $('.as-item-details-link-details').bind('click', function (e) {
        e.preventDefault();
        modalRequest.fadeIn();
    });

    // 상품상담신청
    $('.as-item-details-link-request').bind('click', function (e) {
        e.preventDefault();
        modalRequest.fadeIn();
    });


    // about wing banner
    var
        _win = $(window),
        vt_wing_right = $('.vt-wing-body');
        gapToTop = null,
        duration = 200;

    if(vt_wing_right.length > 0 ){
        gapToTop = vt_wing_right.offset().top - 120; // 120 is proper space for user
    }

    /**
     * Get scroll's position
     * @returns {*}
     */
    function getScrollPos(){
        return _win.scrollTop();
    }

    _win.bind('load scroll', function (e) {
        var pos = getScrollPos();

        if(pos >= gapToTop+100){
            setTimeout(function () {
                vt_wing_right.css({
                    top : pos - gapToTop
                });
            }, duration);
        }else{
            setTimeout(function (){
                vt_wing_right.css({
                    top : 100 + 'px'
                });
            }, duration);
        }
    });



    window.getWindowWidth=getWindowWidth;
    window.isMobile=isMobile;


    // mobile start
    var navOpenBtn=$('.vt-btn-nav');
    var navCloseBtn=$('.vt-nav-m-close');
    var navBody=$('.vt-nav-m');

    navCloseBtn.bind('click', function (e) {
        e.preventDefault();
        navBody.fadeOut();
    });

    navOpenBtn.bind('click', function (e) {
        e.preventDefault();
        navBody.fadeIn();
    });

    function goTop(){
        $( 'html, body' ).animate( { scrollTop : 0 }, 500 );
    }

    window.goTop=goTop;



    // navigation mobile
    function calcMobileNav(){
        var mobileNavBody=$('.navigation-m-body');
        var mobileNavList=mobileNavBody.find('li');
        var mobileNavCount=mobileNavList.length;
        var navTotalWidth=0;

        mobileNavList.each(function (i, e){
           // console.info(i);
            navTotalWidth += Math.ceil($(e).outerWidth());
        });

        mobileNavBody.css('width', navTotalWidth + 'px');

        //console.info(navTotalWidth);
    }

    function calcMobileSubNav(){
        var mobileNavBody=$('.navigation-m-sub-body');
        var mobileNavList=mobileNavBody.find('li');
        var mobileNavCount=mobileNavList.length;
        var navTotalWidth=0;

        mobileNavList.each(function (i, e){
            // console.info(i);
            navTotalWidth += Math.ceil($(e).outerWidth());
        });

        mobileNavBody.css('width', navTotalWidth + 'px');

        //console.info(navTotalWidth);
    }

    $(window).bind('load resize', function (){
        calcMobileNav();
        calcMobileSubNav();
    });


    // set navigation in mobile
    var navMBody=$('#navigation-m .navigation-m-body');
    var navMBodyWrp=$('#navigation-m .navigation-m-inner');
    var naviListActiveIndex=0;

    // 메인 메뉴 위치를 활성화했을 때 idx
    // 메인 메뉴가 숨어 있는지 여부를 판단해야 함.

    function getMenuPos(){
        var className='navigation-m-active';
        var mobileNavList=navMBody.find('li');

        mobileNavList.each(function (i, e){
            if($(e).find('a').hasClass(className)){
                naviListActiveIndex=i;
            }
        });

        return naviListActiveIndex;
    }

    function calMainMobileNav(){
        var idx=getMenuPos();

        // idx까지의 총 길이를 가져온다.
        var req_nav_pos=0; // 요청된 메뉴까지의 길이
        var current_win_width=Math.round(getWindowWidth());
        var mobileNavList=navMBody.find('li');
        var navTotalWidth=0; // 총 길이

        var tmp_new_pos=Math.abs(parseInt(req_nav_pos - current_win_width ));
        var activNaviWidth = parseInt(Math.ceil(mobileNavList.eq(idx).outerWidth()));

        mobileNavList.each(function (i, e){
            if(idx >= i){
                req_nav_pos += Math.ceil($(e).outerWidth());
            }
            navTotalWidth += Math.ceil($(e).outerWidth());
        });

        // console.info('위치:' + idx);
        // console.info('총길이: ' + navTotalWidth);
        // console.info('요청까지의 길이: ' + req_nav_pos);
        // console.info('현재 창 넓이: ' + current_win_width);

        // 현재창의 넓이를 가져온다.
        // 이 둘을 비교하여 숨어 있는지 여부를 확인한다.
        // 숨어 있을 경우 요청받은 메뉴의 위치가 화면의 중간에 올 수 있는 길이를 계산한다. 현재 화면의 길이 + 현재 화면 길이의 절반 + a
        // 계산의 결과값이 총 길이를 벗어날 경우 총 길이


        if(current_win_width < navTotalWidth){ // 메뉴의 길이가 현재 화면에서 숨어 있을 때에만 처리한다.
            // console.info(req_nav_pos);
            // console.info(mobileNavList.eq(idx));
            // console.info(current_win_width);


            if(req_nav_pos+mobileNavList.eq(idx).outerWidth()/2 < current_win_width){
                //console.info('not hide:: Nothing to do');
            } else {
                //console.info('hide');

                if(req_nav_pos+mobileNavList.eq(idx).outerWidth()/2 > navTotalWidth/2){
                    //console.info('A');
                    navMBodyWrp.animate({'scrollLeft' : navTotalWidth-current_win_width }, 300);
                }else{
                    //console.info('B');
                    navMBodyWrp.animate({'scrollLeft' : Math.abs(getWindowWidth()/2- (tmp_new_pos + (activNaviWidth/2))) }, 300);
                }
            }
        }
    }


    function getSubMenuPos(){
        var className='navigation-m-sub-link-active';
        var mobileNavList=$('.navigation-m-sub-body').find('li');
        var activePos=0;

        mobileNavList.each(function (i, e){
            if($(e).find('a').hasClass(className)){
                activePos=i;
            }
        });

        return activePos;
    }

    function setSubNavM(){
        var activePos=getSubMenuPos();
        var subNavHolder=$('.navigation-m-inner-sub');
        var subNav=$('.navigation-m-sub-body');
        var current_win_width=getWindowWidth();
        var req_nav_pos=0;
        var navTotalWidth=0;

        // console.info(activePos);

        subNavHolder.find('li').each(function (i, e){
            if(activePos >= i){
                req_nav_pos += Math.ceil($(e).outerWidth());
            }
            navTotalWidth += Math.ceil($(e).outerWidth());
        });


        // console.info('총 길이: ' + navTotalWidth);
        // console.info('요청 길이: ' + req_nav_pos);

        if( current_win_width < (req_nav_pos + subNavHolder.find('li').eq(activePos).outerWidth()) ){
            //console.info('hide');
            subNavHolder.animate({'scrollLeft' : navTotalWidth-current_win_width }, 300);
        }else{
            //console.info('no hide');
        }
    }


    $(window).bind('load resize', function (){
        calMainMobileNav();
        setSubNavM();
    });


    // notice rolling on the top
    var noticeMHolder=$('.notice-m-con-wrp');
    if(noticeMHolder.length>0){
        $('.notice-m-con-wrp').easyTicker({
            visible: 1,
            interval: 4000
        });
    }


    // register
    function autoHypenPhone(str){
        str = str.replace(/[^0-9]/g, '');
        var tmp = '';
        if( str.length < 4){
            return str;
        }else if(str.length < 7){
            tmp += str.substr(0, 3);
            tmp += '-';
            tmp += str.substr(3);
            return tmp;
        } else if(str.length === 8){
            tmp += str.substr(0, 4);
            tmp += '-';
            tmp += str.substr(4);
            return tmp;
        } else if(str.length < 11){
            tmp += str.substr(0, 3);
            tmp += '-';
            tmp += str.substr(3, 3);
            tmp += '-';
            tmp += str.substr(6);
            return tmp;
        }else{
            tmp += str.substr(0, 3);
            tmp += '-';
            tmp += str.substr(3, 4);
            tmp += '-';
            tmp += str.substr(7);
            return tmp;
        }
        return str;
    }

    function applyPhoneNumberEvent(){
        var val = $(this).val().trim();
        $(this).val(autoHypenPhone(val));
    }

    var inputField=$('input[type="tel"]');
    inputField.bind('keydown keyup', applyPhoneNumberEvent);


    // 삽입된 이미지가 현재화면보다 클 경우 100%로 맞춘다.
    function adjustImgHtml(){
        var _current_width=$(window).width();
        var _img_holder=$('.editHtmlArea');

        _img_holder.find('img').each(function (i,e){
            var _img_width=$(e).width();

            // alert(_img_width);

            if(_img_width >= _current_width){
                $(e).addClass('spread_img');
            }
        });
    }

    $(window).bind('load resize', function (){
        adjustImgHtml();
    });


// 상단 무료체험 신청현황
    $(function(){
        var timer = !1;
        var _Ticker = $('#T1').newsTicker();
        _Ticker.on('mouseenter',function(){
            var __self = this;
            timer = setTimeout(function(){
                __self.pauseTicker();
            }, 300);
        });
        _Ticker.on('mouseleave',function(){
            clearTimeout(timer);
            if(!timer) return !1;
            this.startTicker();
        });
    });



    // wing banner action
    var leftWing=$('.left-wing');
    var rightWing=$('.right-wing');
    var wingWrp=$('.wing-pc-wrp');
    $(window).bind('load resize scroll', function (){

        if(wingWrp.length === 0){
            return;
        }

        var currentScrollPos=getScrollPos();

        // console.info(currentScrollPos);

        if(currentScrollPos >= wingWrp.offset().top){
            //console.info('F');

            leftWing.css({
                'top' : currentScrollPos - leftWing.height()/2 + 50 + 'px'
            });

            rightWing.css({
                'top' : currentScrollPos - leftWing.height()/2 + 50 + 'px'
            });
        }else{
            //console.info('S');

            leftWing.css({
                'top' : '10px'
            });

            rightWing.css({
                'top' : '10px'
            });
        }

    });



}(jQuery));
