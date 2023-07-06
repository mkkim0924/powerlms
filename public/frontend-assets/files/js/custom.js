// JavaScript Document


$(window).on('load', function () {

    "use strict";

    /*----------------------------------------------------*/
    /*	Preloader
    /*----------------------------------------------------*/

    var preloader = $('#loader-wrapper'),
        loader = preloader.find('.cssload-loading');
    loader.fadeOut();
    preloader.delay(400).fadeOut('slow');

});


$(window).on('scroll', function () {

    "use strict";

    /*----------------------------------------------------*/
    /*	Navigtion Menu Scroll
    /*----------------------------------------------------*/

    var b = $(window).scrollTop();

    if (b > 100) {
        $(".wsmainfull").addClass("scroll");
    } else {
        $(".wsmainfull").removeClass("scroll");
    }

});

$(document).ready(function () {

    "use strict";


    var preloader = $('#loader-wrapper'),
        loader = preloader.find('.cssload-loading');
    loader.fadeOut();
    preloader.delay(400).fadeOut('slow');

    /*----------------------------------------------------*/
    /*	Hero Slider
    /*----------------------------------------------------*/

    if ($('.slider').length > 0) {
        $('.slider').slider({
            full_width: false,
            interval: 6000,
            transition: 1000,
            draggable: false,
        });
    }

    var $searchInput = $('[name="search_input"]');
    $searchInput.on("input keypress", function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        var dInput = $(this).val().trim();
        var lTrimInput = $(this).val().replace(/^\s+/g, "");
        $searchInput.val(lTrimInput);
        if (keycode == '13' && (dInput.length > 0)) {
            var url = $app_url + '/courses?search=' + dInput;
            window.location.href = url;
        }
    });

    /*----------------------------------------------------*/
    /*	Animated Scroll To Anchor
    /*----------------------------------------------------*/

    $('.header a[href^="#"], .page a.btn[href^="#"], .page a.internal-link[href^="#"]').on('click', function (e) {

        e.preventDefault();

        var target = this.hash,
            $target = jQuery(target);

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top - 60 // - 200px (nav-height)
        }, 'slow', 'easeInSine', function () {
            window.location.hash = '1' + target;
        });

    });


    /*----------------------------------------------------*/
    /*	ScrollUp
    /*----------------------------------------------------*/

    $.scrollUp = function (options) {

        // Defaults
        var defaults = {
            scrollName: 'scrollUp', // Element ID
            topDistance: 600, // Distance from top before showing element (px)
            topSpeed: 800, // Speed back to top (ms)
            animation: 'fade', // Fade, slide, none
            animationInSpeed: 200, // Animation in speed (ms)
            animationOutSpeed: 200, // Animation out speed (ms)
            scrollText: '', // Text for element
            scrollImg: false, // Set true to use image
            activeOverlay: false // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        };

        var o = $.extend({}, defaults, options),
            scrollId = '#' + o.scrollName;

        // Create element
        $('<a/>', {
            id: o.scrollName,
            href: '#top',
            title: o.scrollText
        }).appendTo('body');

        // If not using an image display text
        if (!o.scrollImg) {
            $(scrollId).text(o.scrollText);
        }

        // Minium CSS to make the magic happen
        $(scrollId).css({'display': 'none', 'position': 'fixed', 'z-index': '99999'});

        // Active point overlay
        if (o.activeOverlay) {
            $("body").append("<div id='" + o.scrollName + "-active'></div>");
            $(scrollId + "-active").css({
                'position': 'absolute',
                'top': o.topDistance + 'px',
                'width': '100%',
                'border-top': '1px dotted ' + o.activeOverlay,
                'z-index': '99999'
            });
        }

        // Scroll function
        $(window).on('scroll', function () {
            switch (o.animation) {
                case "fade":
                    $(($(window).scrollTop() > o.topDistance) ? $(scrollId).fadeIn(o.animationInSpeed) : $(scrollId).fadeOut(o.animationOutSpeed));
                    break;
                case "slide":
                    $(($(window).scrollTop() > o.topDistance) ? $(scrollId).slideDown(o.animationInSpeed) : $(scrollId).slideUp(o.animationOutSpeed));
                    break;
                default:
                    $(($(window).scrollTop() > o.topDistance) ? $(scrollId).show(0) : $(scrollId).hide(0));
            }
        });

        // To the top
        $(scrollId).on('click', function (event) {
            $('html, body').animate({scrollTop: 0}, o.topSpeed);
            event.preventDefault();
        });

    };

    $.scrollUp();


    /*----------------------------------------------------*/
    /*	Tabs #1
    /*----------------------------------------------------*/

    $('ul.tabs-1 li').on('click', function () {
        var tab_id = $(this).attr('data-tab');

        $('ul.tabs-1 li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#" + tab_id).addClass('current');
    });


    /*----------------------------------------------------*/
    /*	Single Image Lightbox
    /*----------------------------------------------------*/

    if($('.image-link').length > 0){
        $('.image-link').magnificPopup({
            type: 'image'
        });
    }

    /*----------------------------------------------------*/
    /*	Video Link #3 Lightbox
    /*----------------------------------------------------*/
    if ($('.video-popup3').length > 0) {
        $('.video-popup3').magnificPopup({
            type: 'iframe',
        });
    }


    /*----------------------------------------------------*/
    /*	Statistic Counter
    /*----------------------------------------------------*/

    $('.count-element').each(function () {
        $(this).appear(function () {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 4000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        }, {accX: 0, accY: 0});
    });


    /*----------------------------------------------------*/
    /*	Testimonials Rotator
    /*----------------------------------------------------*/

    if ($('.reviews-holder').length > 0){
        var owl = $('.reviews-holder');
        owl.owlCarousel({
            items: 3,
            loop: false,
            rtl: ($layout_type == 'rtl'),
            autoplay: true,
            navBy: 1,
            autoplayTimeout: 4500,
            autoplayHoverPause: true,
            smartSpeed: 1500,
            responsive: {
                0: {
                    items: 1
                },
                767: {
                    items: 1
                },
                768: {
                    items: 2
                },
                991: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        });
    }
    if ($('.webinar-carousel').length > 0){
        var owl = $('.webinar-carousel');
        owl.owlCarousel({
            items: 3,
            loop: false,
            // rtl: ($layout_type == 'rtl'),
            autoplay: false,
            navBy: 1,
            responsive: {
                0: {
                    items: 1
                },
                767: {
                    items: 1
                },
                768: {
                    items: 1
                },
                991: {
                    items:3
                },
                1000: {
                    items:4
                },
                1200: {
                    items:4
                }

            }
        });
    }

    /*----------------------------------------------------*/
    /*	Courses Carousel
    /*----------------------------------------------------*/
    if ($('.courses-carousel').length > 0){
        var owl = $('.courses-carousel');
        owl.owlCarousel({
            items: 4,
            loop: false,
            rtl: ($layout_type == 'rtl'),
            autoplay: true,
            navBy: 1,
            nav: true,
            dots: false,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            smartSpeed: 900,
            responsive: {
                0: {
                    items: 1
                },
                550: {
                    items: 1
                },
                767: {
                    items: 2
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1100: {
                    items: 4
                }
            }
        });
    }


    /*----------------------------------------------------*/
    /*	Categories Carousel
    /*----------------------------------------------------*/
    if ($('.categories-carousel').length > 0){
        var owl = $('.categories-carousel');
        owl.owlCarousel({
            items: 5,
            loop: false,
            rtl: ($layout_type == 'rtl'),
            autoplay: true,
            navBy: 1,
            nav: true,
            dots: false,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            smartSpeed: 1100,
            responsive: {
                0: {
                    items: 1
                },
                550: {
                    items: 2
                },
                767: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1100: {
                    items: 5
                }
            }
        });
    }


    /*----------------------------------------------------*/
    /*	Teachers Carousel
    /*----------------------------------------------------*/

    if ($('.team-carousel').length > 0){
        var owl = $('.team-carousel');
        owl.owlCarousel({
            items: 4,
            loop: false,
            rtl: ($layout_type == 'rtl'),
            autoplay: true,
            navBy: 1,
            nav: true,
            dots: false,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            smartSpeed: 900,
            responsive: {
                0: {
                    items: 1
                },
                550: {
                    items: 2
                },
                767: {
                    items: 2
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1100: {
                    items: 4
                }
            }
        });
    }

    /*----------------------------------------------------*/
    /*	Brands Logo Rotator
    /*----------------------------------------------------*/
    if ($('.brands-carousel').length > 0){
        var owl = $('.brands-carousel');
        owl.owlCarousel({
            items: 5,
            loop: false,
            rtl: ($layout_type == 'rtl'),
            autoplay: false,
            navBy: 1,
            autoplayTimeout: 4000,
            autoplayHoverPause: false,
            smartSpeed: 2000,
            responsive: {
                0: {
                    items: 2
                },
                550: {
                    items: 3
                },
                767: {
                    items: 3
                },
                768: {
                    items: 4
                },
                991: {
                    items: 4
                },
                1000: {
                    items: 5
                }
            }
        });
    }


    /*----------------------------------------------------*/
    /*	Masonry Grid
    /*----------------------------------------------------*/

    if ($('.grid-loaded').length > 0){
        $('.grid-loaded').imagesLoaded(function () {

            // filter items on button click
            $('.masonry-filter').on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });

            // change is-checked class on buttons
            $('.masonry-filter button').on('click', function () {
                $('.masonry-filter button').removeClass('is-checked');
                $(this).addClass('is-checked');
                var selector = $(this).attr('data-filter');
                $grid.isotope({
                    filter: selector
                });
                return false;
            });

            // init Isotope
            var $grid = $('.masonry-wrap').isotope({
                itemSelector: '.masonry-item',
                percentPosition: true,
                transitionDuration: '0.7s',
                masonry: {
                    // use outer width of grid-sizer for columnWidth
                    columnWidth: '.masonry-item',
                }
            });
        });
    }

    // js for category dropdown
    $(".category-dropdown").on('mouseover', function () {
        $('.category-dropdown').removeClass('active');
        $(this).addClass('active');
        $(".category-courses-dropdown").hide();
        if ($("." + $(this).data('show_class')).length > 0) {
            $("." + $(this).data('show_class')).show();
        }
    });
    $("#navbarDropdown").on('mouseover', function () {
        $(".category-level-1").show();
    }).on('mouseleave', function () {
        $(".category-level-1").hide();
        $(".category-courses-dropdown").hide();
    });
});
