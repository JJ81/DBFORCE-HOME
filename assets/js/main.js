/*-----------------------------------------------------------------------------------

    Template Name: Sotare - Software Landing Page Bootstrap 4 Template.
    Description: Sotare - Software Landing Page.
    Author: devitems
    Version: 1.2

-----------------------------------------------------------------------------------*/
(function ($) {
    "use strict";
    new WOW().init();
    /*--
        Menu Sticky
    -----------------------------------*/
    var windows = $(window);
    var sticky = $('.header-sticky');
    
    windows.on('scroll', function() {
        var scroll = windows.scrollTop();
        if (scroll < 300) {
            sticky.removeClass('is-sticky');
        }else{
            sticky.addClass('is-sticky');
        }
    });
     /*--
        Mobile Menu
    ------------------------*/
    var menuNav = $('nav.main-navigation');
    menuNav.meanmenu({
        meanScreenWidth: '991',
        meanMenuContainer: '.mobile-menu',
        meanMenuClose: '<span class="menu-close"></span>',
        meanMenuOpen: '<span class="menu-bar"></span>',
        meanRevealPosition: 'right',
        meanMenuCloseSize: '0',
        onePage:true
    });
    
    /*-- 
        Screenshot Center Active Slider 
    ------------------------------------*/
    var sliderScreenshotActive = $('.slider-screenshot-active');
    sliderScreenshotActive.slick({
        arrows: false,
        autoplay: true,
        dots: false,
        autoplaySpeed: 2000,
        infinite: true,
        centerMode: true,
        centerPadding: '123px',
        slidesToShow: 3,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    centerPadding: '90px',
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                    centerPadding: '50px',
                }
            },
            {
              breakpoint: 768,
              settings: {
                centerPadding: '45px',
                slidesToShow: 3
              }
            },
            {
              breakpoint: 480,
              settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '0px',
                slidesToShow: 3
              }
            }
        ]
    });
   
    /*-- 
        Screenshot Center Active Slider 
    ------------------------------------*/
    var centerScreenshotActive = $('.screenshot-center-active');
    centerScreenshotActive.slick({
        arrows: true,
        autoplay: true,
        dots: true,
        infinite: true,
        slidesToShow: 2,
        slidesToScoll: 1,
        prevArrow:false,
        nextArrow: false,
        responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1
              }
            }
        ]
    });
     
    /*-- 
        Testimonial Active Slider 
    ------------------------------------*/
    var testimonialActive = $('.testimonial-active');
    testimonialActive.slick({
        arrows: true,
        autoplay: true,
        dots: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScoll: 1,
        centerMode: true,
        centerPadding: '0px',
        prevArrow:false,
        nextArrow: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 479,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
    
    /*--
        onePageNav JS
    ---------------------------*/
    $('.main-navigation ul').onePageNav({
        currentClass: 'active',
        changeHash: false,
        scrollSpeed: 750,
        scrollThreshold: 0.5,
        filter: '',
        easing: 'swing',
        offsetHeight: 80,
    });
    
	// Fake Loader 
	$('.fakeloader').fakeLoader({
        timeToHide:500,
        bgColor:"#09C7E0",
        spinner:"spinner1",
        zIndex:"99999"
	});
    
    // Magnific Popup Video
    $('.popup-youtube').magnificPopup({
        type: 'iframe',
        removalDelay: 300,
        mainClass: 'mfp-fade'
    });
    
    /*--
        Magnific Popup Image
    ------------------------*/
    $('.img-poppu').magnificPopup({
        type: 'image',
        gallery:{
            enabled:true
        }
    });

    // CounterUp Active 
	$('.counter-active').counterUp({
		delay: 10,
		time: 1000
	});
    /*--
    Accordion
    -------------------------*/
    $(".faequently-accordion").collapse({
        accordion:true,
        open: function() {
        this.slideDown(300);
      },
      close: function() {
        this.slideUp(300);
      }		
    });	 
    /*--
        ScrollUp Active
    -----------------------------------*/
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-double-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });   
        
    
    
    /*------------------------------------
        DateCountdown active 
    ------------------------------------- */
    $(".DateCountdown").TimeCircles({
        direction: "Counter-clockwise",
        fg_width: 0.009,
        bg_width: 0,
        use_background: false,
        time: {
            Days: {
                text: "Days",
                color: "#fff"
            },
            Hours: {
                text: "Hours",
                color: "#fff"
            },
            Minutes: {
                text: "Mins",
                color: "#fff"
            },
            Seconds: {
                text: "Secs",
                color: "#fff"
            }
        }

    });
    
    
    })(jQuery);	