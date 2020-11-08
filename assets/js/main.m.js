// 상단 모바일 배너
var swiperTopBan=new Swiper('.vt-swiper-container-home-banner', {
    pagination: {
        el: '.vt-swiper-pagination-home-banner',
        clickable: true
    },
    slidesPerView: 1,
    spaceBetween:0,
    effect: 'slide',
    loop: true,
    autoplay: {
        delay: 5000,
    },
    speed: 1000,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    on: {
        slideChangeTransitionStart: function (){
            var _idx=this.activeIndex;

            if(_idx >= 6){
                _idx=1;
            }

            // console.info(_idx);

            activeBannerSlide(_idx);
        }
    }
});

var activeBannerClassName='banner-pc-nav-link-active';
function activeBannerSlide(num){
    $('.banner-pc-nav-link').removeClass(activeBannerClassName);
    $('.banner-pc-nav-list').eq(num-1).children('a').addClass(activeBannerClassName);
}

$('.banner-pc-nav-link').bind('click', function (e){
    e.preventDefault();
    $('.banner-pc-nav-link').removeClass(activeBannerClassName);

    var idx=$(this).parent().index();

    $('.banner-pc-nav-list').eq(idx).children('a').addClass(activeBannerClassName);

    swiperTopBan.slideTo(idx+1, 1000, true);
});


// 탭액션 (첫번째)
var tabList=$('#main-board-01 .main-board-tab-list a');
tabList.bind('click', function (e){
    e.preventDefault();
    var _self=$(this);
    var idx=_self.parent().index()+1;


    $('#main-board-01  .main-board-tab-link').removeClass('active');
    _self.addClass('active');


    $('#main-board-01  .main-board-con').css('display', 'none');
    $('#main-board-01  .main-board-con-0' + idx).css('display', 'block');
});

// 탭액션 (두번째)
var tabList=$('#main-board-02 .main-board-tab-list a');
tabList.bind('click', function (e){
    e.preventDefault();
    var _self=$(this);
    var idx=_self.parent().index()+1;


    $('#main-board-02 .main-board-tab-link').removeClass('active');
    _self.addClass('active');


    $('#main-board-02 .main-board-con').css('display', 'none');
    $('#main-board-02 .main-board-con-0' + idx).css('display', 'block');
});

// 베스트 수익 후기
new Swiper('.vt-swiper-container-home-best', {
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    loop: true,
    coverflowEffect: {
        rotate: 0,
        stretch: 50,
        // depth: 200,
        depth: 0,
        modifier: 1,
        slideShadows : false,
    }
});