/*-----------------------------------------------------------------------------------

 Template Name:Multimart
 Description: multimart | The Online Mega store
 Author: Pixelstrap
 Author URI: https://themeforest.net/user/pixelstrap

 -----------------------------------------------------------------------------------*/

// 1.0 Tap on top JS
// 2.0  Pre Loader
// 3.0 blog scripts
// 4.0  Footer according js
// 5.0 category page
// 6.0 filter js
// 7.0 Quantity Counter
// 8.0 Image to background js
// 9.0 Add to cart
// 10 Add to wishlist
// 11. Top banner
// 12. Add to cart quantity Counter
// 13. Filter js
// 14 Menu & search js
// 15. Age verify modal
// 16. Sidebar settings options


flag = true;
(function($) {
    "use strict";

    /*----------------------------------------
     1.0 Tap on top JS
     ----------------------------------------*/
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 200) {
            $('.tap-top').fadeIn();
        } else {
            $('.tap-top').fadeOut();
        }
    });
    $('.tap-top').on('click', function() {
        $("html, body").animate({
            scrollTop: 0
        }, 50);
        return false;
    });

    /*----------------------------------------
     2.0  Pre Loader
     ----------------------------------------*/
    $('.loader-wrapper').fadeOut('slow', function() {
            $(this).remove();
        });


    /*--------------------------
     3.0 blog scripts
     ----------------------------*/
    $('.slide-1').slick({
        infinite: true,
        margin:5
    });

    $('.slide-2').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2,
        margin:15,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                    // margin:0
                }
            }
        ]
    });

    $('.slide-3').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        nav:true,
        margin:15,
        responsive: [
            {
                breakpoint: 1220,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 1210,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    autoplay: true,
                    autoplaySpeed: 2000
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    autoplay: true,
                    autoplaySpeed: 2000
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    autoplay: true,
                    autoplaySpeed: 2000
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000
                }
            }

        ]
    });

    $('.slide-4').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    autoplay: true,
                    autoplaySpeed: 2000
                }
            },
            {
                breakpoint: 586,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    margin:0,
                    autoplay: true,
                    autoplaySpeed: 2000
                }
            }
        ]
    });

    $('.team-4').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        margin:15,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    autoplay: true,
                    autoplaySpeed: 2000
                }
            },
            {
                breakpoint: 586,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000
                }
            }
        ]
    });

    $('.slide-5').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 5,
        responsive: [
            {
                breakpoint: 1367,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    autoplay: true,
                    autoplaySpeed: 2000
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    autoplay: true,
                    autoplaySpeed: 2000
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    autoplay: true,
                    autoplaySpeed: 2000
                }
            }
        ]
    });

    $('.slide-6').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 6,
        slidesToScroll: 6,
        responsive: [
            {
                breakpoint: 1367,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    infinite: true
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    infinite: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true
                }
            },
            {
                breakpoint: 420,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    margin:0,
                    autoplay: true,
                    autoplaySpeed: 2000
                }
            }

        ]
    });

    $('.slide-7').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 7,
        slidesToScroll: 7,
        responsive: [
            {
                breakpoint: 1367,
                settings: {
                    slidesToShow: 6,
                    slidesToScroll: 6
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    infinite: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    autoplay: true,
                    autoplaySpeed: 2000
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    autoplay: true,
                    autoplaySpeed: 2000
                }
            }
        ]
    });

    $('.slide-8').slick({
        infinite: true,
        slidesToShow: 8,
        slidesToScroll: 8,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 6,
                    slidesToScroll: 6
                }
            }
        ]
    });

    $('.product-slick').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        asNavFor: '.slider-nav'
    });

    $('.slider-nav').slick({
        vertical: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.product-slick',
        arrows: false,
        dots: false,
        focusOnSelect: true
    });

    $("#tab-1").css("display", "Block");
    $(".default").css("display", "Block");

    $(".tabs li a").on('click' , function(event) {
        event.preventDefault();
        $('.tab_product_slider').slick('unslick');
        $('.product-4').slick('unslick');
        $('.product-2').slick('unslick');
        $('.product-6').slick('unslick');
        $('.tab-slide-3').slick('unslick');
        $(this).parent().parent().find("li").removeClass("current");
        $(this).parent().addClass("current");
        var currunt_href = $(this).attr("href");
        $('#' + currunt_href).show();
        $(this).parent().parent().parent().find(".tab-content").not('#' + currunt_href).css("display", "none");
        var slider_class = $(this).parent().parent().parent().find(".tab-content").children().attr("class").split(' ').pop();

        $(".product-4").slick({
            arrows: true,
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint:991,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 420,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $('.tab-slide-3').slick({
            infinite: true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            nav:true,
            margin:15,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        margin:0
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });

    });

    $('.product-4').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow:2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 420,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.tab-slide-3').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        nav:true,
        margin:15,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    margin:0
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }

        ]
    });
    /* Collection banner */

    $('.tabs li:first-child a').trigger("click");
    //toggle menu
    $(".toggle-nav").on('click' , function(){
        $('nav .sm-horizontal').css("right","0px");
    });
    $(".back-btn").on('click' ,function(){
        $('nav .sm-horizontal').css("right","-300px");
    });

    var contentwidth = jQuery(window).width();
    if ((contentwidth) < '1183') {
        jQuery('.tgl-sm h5').append('<span class="according-menu"></span>');
        jQuery('.tgl-sm').on('click' , function () {
            jQuery('.tgl-sm').removeClass('active');
            jQuery('.menu-content').slideUp('normal');
            if (jQuery(this).next().is(':hidden') == true) {
                // console.log(this);
                jQuery(this).addClass('active');
                jQuery(this).next().slideDown('normal');
            }
        });
        jQuery('.menu-content').hide();
    } else {
        jQuery('.menu-content').show();
    }
    $('.category-dropdown .transparant').on('click', function(e) {
        $('.category-list.show').css("left","0px");
    });

    /*----------------------------
     4.0  Footer according js
     ------------------------------*/
    var contentwidth = $(window).width();
    if ((contentwidth) <= '750') {
        $('.footer-title h4').append('<span class="according-menu"></span>');
        $('.footer-title').click(function () {
            $('.footer-title').removeClass('active');
            $('.footer-contant').slideUp('normal');
            if ($(this).next().is(':hidden') == true) {
                $(this).addClass('active');
                $(this).next().slideDown('normal');
            }
        });
        $('.footer-contant').hide();
    } else {
        $('.footer-contant').show();
    }


    /*=====================
     5.0 category page
     ==========================*/
    $('.collapse-block-title').on('click', function(e) {
        e.preventDefault;
        var speed = 300;
        var thisItem = $(this).parent(),
            nextLevel = $(this).next('.collection-collapse-block-content');
        if (thisItem.hasClass('open')){
            thisItem.removeClass('open');
            nextLevel.slideUp(speed);
        }
        else {
            thisItem.addClass('open');
            nextLevel.slideDown(speed);
        }
    });
    $('.color-selector li').on('click', function(e) {
        $(".color-selector li").removeClass("active");
        $(this).addClass("active");
    });
    //list layout view
    $('.list-layout-view').on('click', function(e) {
        $('.collection-grid-view').css('opacity', '0');
        $(".product-wrapper-grid").css("opacity","0.2");
        $('.shop-cart-ajax-loader').css("display","block");
        $('.product-wrapper-grid').addClass("list-view");
        $(".product-wrapper-grid").children().children().children().removeClass();
        $(".product-wrapper-grid").children().children().children().addClass("col-lg-12");
        setTimeout(function(){
            $(".product-wrapper-grid").css("opacity","1");
            $('.shop-cart-ajax-loader').css("display","none");
        }, 500);
    });
    //grid layout view
    $('.grid-layout-view').on('click', function(e) {
        $('.collection-grid-view').css('opacity', '1');
        $('.product-wrapper-grid').removeClass("list-view");
        $(".product-wrapper-grid").children().children().children().removeClass();
        $(".product-wrapper-grid").children().children().children().addClass("col-lg-3");

    });
    $('.product-2-layout-view').on('click', function(e) {
        if($('.product-wrapper-grid').hasClass("list-view")) {}
        else{
            $(".product-wrapper-grid").children().children().children().removeClass();
            $(".product-wrapper-grid").children().children().children().addClass("col-lg-6");
        }
    });
    $('.product-3-layout-view').on('click', function(e) {
        if($('.product-wrapper-grid').hasClass("list-view")) {}
        else{
            $(".product-wrapper-grid").children().children().children().removeClass();
            $(".product-wrapper-grid").children().children().children().addClass("col-lg-4");
        }
    });
    $('.product-4-layout-view').on('click', function(e) {
        if($('.product-wrapper-grid').hasClass("list-view")) {}
        else{
            $(".product-wrapper-grid").children().children().children().removeClass();
            $(".product-wrapper-grid").children().children().children().addClass("col-lg-3");
        }
    });
    $('.product-6-layout-view').on('click', function(e) {
        if($('.product-wrapper-grid').hasClass("list-view")) {}
        else{
            $(".product-wrapper-grid").children().children().children().removeClass();
            $(".product-wrapper-grid").children().children().children().addClass("col-lg-2");
        }
    });

    /*=====================
     6.0 filter js
     ==========================*/
    $('.filter-btn').on('click', function(e) {
        $('.collection-filter').css("left","-15px");
    });
    $('.filter-back').on('click', function(e) {
        $('.collection-filter').css("left","-365px");
    });
    // sidebar popup
    $('.sidebar-popup').on('click', function(e) {
        $('.open-popup').toggleClass('open');
        $('.collection-filter').css("left","-15px");
    });
    $('.filter-back').on('click', function(e) {
        $('.collection-filter').css("left","-365px");
        $('.sidebar-popup').trigger('click');
    });

    $('.account-sidebar').on('click', function(e) {
        $('.dashboard-left').css("left","0");
    });
    $('.filter-back').on('click', function(e) {
        $('.dashboard-left').css("left","-365px");
    });

    $('.product-right-slick').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        asNavFor: '.slider-right-nav'
    });
    if ($(window).width() > 575) {
        $('.slider-right-nav').slick({
            vertical: true,
            verticalSwiping: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.product-right-slick',
            arrows: false,
            infinite: true,
            dots: false,
            centerMode: false,
            focusOnSelect: true
        });
    }else{
        $('.slider-right-nav').slick({
            vertical: false,
            verticalSwiping: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.product-right-slick',
            arrows: false,
            infinite: true,
            centerMode: false,
            dots: false,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }

    /*=====================
     7.0 Quantity Counter
     ==========================*/
    $('.quantity-right-plus').on('click', function () {
        var $qty = $('.qty-box .input-number');
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal)) {
            $qty.val(currentVal + 1);
        }
    });
    $('.quantity-left-minus').on('click', function () {
        var $qty = $('.qty-box .input-number');
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal) && currentVal > 1) {
            $qty.val(currentVal - 1);
        }
    });

    $('#main-menu').smartmenus({
        subMenusSubOffsetX: 1,
        subMenusSubOffsetY: -8
    });
    $('#sub-menu').smartmenus({
        subMenusSubOffsetX: 1,
        subMenusSubOffsetY: -8
    });
    $('.elec-cat-show-btn').on('click' , function(e) {
        $('.electric-cat-show, .category-list').slideToggle("slow");
        $('.elec-cat-show-btn').toggleClass('active');
    });

    /*=====================
     8.0 Image to background js
     ==========================*/
    $(".bg-top").parent().addClass('b-top');
    $(".bg-bottom").parent().addClass('b-bottom');
    $(".bg-center").parent().addClass('b-center');
    $(".bg-right").parent().addClass('b-right');
    $(".bg-left").parent().addClass('b-left');
    $(".bg-size-content").parent().addClass('b_size_content');
    $(".img-to-bg").parent().addClass('bg-size');
    $(".img-to-bg.blur-up").parent().addClass('');

    jQuery('.img-to-bg').each(function() {

        var el = $(this),
            src = el.attr('src'),
            parent = el.parent();

        parent.css({
            'background-image': 'url(' + src + ')',
            'background-size': 'cover',
            'background-position': 'center',
            'background-repeat' : 'no-repeat',
            'display' : 'block'
        });

        el.hide();
    });

    /*=====================
     9.0 Add to cart
     ==========================*/
    $('.product-box button .icon-bag').on('click', function () {
        $.notify({
            icon: 'fa fa-check',
            title: 'Success!',
            message: 'Item Successfully added to your cart'
        },{
            element: 'body',
            position: null,
            type: "success",
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: true,
            placement: {
                from: "top",
                align: "right"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            icon_type: 'class',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
        });
    });


    /*=====================
     10 Add to wishlist
     ==========================*/
    $('.product-box i.icon-heart').on('click', function () {

        $.notify({
            icon: 'fa fa-check',
            title: 'Success!',
            message: 'Item Successfully added in wishlist'
        },{
            element: 'body',
            position: null,
            type: "info",
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: true,
            placement: {
                from: "top",
                align: "right"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            icon_type: 'class',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
        });
    });


    /*=====================
     11. Top banner
     ==========================*/
    function top_banner(){
        if(flag)
        {
            if (localStorage.getItem('visited') !== true) {
                $('.top-banner').show();
                sessionStorage.setItem('visited',false);
            }else{
                $('.top-banner').hide();
                sessionStorage.setItem('visited',true);
            }
            $(".close-button").on("click", function() {
                $(this).fadeOut(100);
                $('.top-banner').slideUp(1000);
                localStorage.setItem('visited',false);
            });
            $(window).on('beforeunload',function(){
                localStorage.removeItem('visited');
            });
        }
    }
    $(document).ready(function(){top_banner();});


    /*=====================
     12. Add to cart quantity Counter
     ==========================*/
    $("button.add-button").click(function(){
        $(this).next().addClass("open");
        $(".qty-input").val('1');
    });
    $('.quantity-right-plus').on('click',function(){
        var $qty = $(this).siblings(".qty-input");
        var currentVal = parseInt($qty.val());
        if (!isNaN(currentVal)) {
            $qty.val(currentVal + 1);
        }
    });
    $('.quantity-left-minus').on('click',function(){
        var $qty = $(this).siblings(".qty-input");
        var _val =  $($qty).val();
        if(_val == '1') {
            var _removeCls = $(this).parents('.cart_qty');
            $(_removeCls).removeClass("open");
        }
        var currentVal = parseInt($qty.val());
        if (!isNaN(currentVal) && currentVal > 0) {
            $qty.val(currentVal - 1);
        }
    });


    /*=====================
     13. Filter js
     ==========================*/
    $(".filter-button").click(function(){
        $(this).addClass('active').siblings('.active').removeClass('active');
        var value = $(this).attr('data-filter');
        if(value == "all")
        {
            $('.filter').show('1000');
        }
        else
        {
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
        }
    });

    $("#formButton").click(function(){
        $("#form1").toggle();
    });



})(jQuery);

/*=====================
 14. Menu & search js
 ==========================*/

function openSearch() {
    document.getElementById("search-overlay").style.display = "block";
}
function closeSearch() {
    document.getElementById("search-overlay").style.display = "none";
}
function openNav() {
    document.getElementById("mySidenav").classList.add('open-side');
}
function closeNav() {
    document.getElementById("mySidenav").classList.remove('open-side');
}
function openSidebarNav() {
    document.getElementById("mySidebarnav").classList.add('open-side');
}
function closebarNav() {
    document.getElementById("mySidebarnav").classList.remove('open-side');
}
function openCart() {
    console.log("GeeksforGeeks");
    document.getElementById("cart_side").classList.add('open-side');
}
function closeCart() {
    document.getElementById("cart_side").classList.remove('open-side');
}
if ($(window).width() > '1200') {
    $('#hover-cls').hover(
        function () {
            $('.sm').addClass('hover-unset');
            $('.navbar').addClass('hover-unset');
        }
    )

}


/*=====================
 15. Age verify modal
 ==========================*/
$(window).on('load',function(){
    $('#ageModal').modal('show');
});


/*====================================
 16 Sidebar settings options
 ====================================*/

/*======== Color Picker =============*/
(function($) {
    (function() {
        $('<div class="sidebar-btn color-picker ">' +
            '<a href="#" class="handle">' +
            // '<i class="fa fa-cog"></i>' +
            '<img src="../assets/images/color-pick.png" alt="picker">' +
            '</a><div class="sec-position">' +
            '<div class="section">' +
            '<div class="colors o-auto">' +
            '<a href="#" class="color1" title="Orange"></a>' +
            '<a href="#" class="color2" title="fallow"></a>' +
            '<a href="#" class="color3" title="Maya-blue"></a>' +
            '<a href="#" class="color4" title="charcoal"></a>' +
            '<a href="#" class="color5" title="Amaranth"></a>' +
            '<a href="#" class="color6" title="Orange Peel"></a>' +
            '<a href="#" class="color7" title="Brilliant Rose"></a>' +
            '<a href="#" class="color8" title="fallow"></a>' +
            '<a href="#" class="color9" title="lima"></a>' +
            '<a href="#" class="color10" title="black"></a>' +
            '<a href="#" class="color11" title="Brink pink"></a>' +
            '<a href="#" class="color12" title="wewak"></a>' +
            '<a href="#" class="color13" title="Tomato"></a>' +
            '<a href="#" class="color14" title="Wewak"></a>' +
            '<a href="#" class="color15" title="golden-brown"></a>' +
            '<a href="#" class="color16" title="Orange"></a>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>').appendTo($('body'));
    })();
    var body_event = $("body");
    body_event.on("click", ".color1", function() {
        $("#color" ).attr("href", "../assets/css/style4.css" );
        return false;
    });

    body_event.on("click", ".color2", function() {
        $("#color" ).attr("href", "../assets/css/style9.css" );
        return false;
    });

    body_event.on("click", ".color3", function() {
        $("#color" ).attr("href", "../assets/css/style18.css" );
        return false;
    });
    body_event.on("click", ".color4", function() {
        $("#color" ).attr("href", "../assets/css/style6.css" );
        return false;
    });
    body_event.on("click", ".color5", function() {
        $("#color" ).attr("href", "../assets/css/style7.css" );
        return false;
    });

    body_event.on("click", ".color6", function() {
        $("#color" ).attr("href", "../assets/css/style8.css" );
        return false;
    });

    body_event.on("click", ".color7", function() {
        $("#color" ).attr("href", "../assets/css/style1.css" );
        return false;
    });
    body_event.on("click", ".color8", function() {
        $("#color" ).attr("href", "../assets/css/style9.css" );
        return false;
    });

    body_event.on("click", ".color9", function() {
        $("#color" ).attr("href", "../assets/css/style3.css" );
        return false;
    });

    body_event.on("click", ".color10", function() {
        $("#color" ).attr("href", "../assets/css/style2.css" );
        return false;
    });

    body_event.on("click", ".color11", function() {
        $("#color" ).attr("href", "../assets/css/style10.css" );
        return false;
    });
    body_event.on("click", ".color12", function() {
        $("#color" ).attr("href", "../assets/css/style11.css" );
        return false;
    });
    body_event.on("click", ".color13", function() {
        $("#color" ).attr("href", "../assets/css/style12.css" );
        return false;
    });
    body_event.on("click", ".color14", function() {
        $("#color" ).attr("href", "../assets/css/style15.css" );
        return false;
    });
    body_event.on("click", ".color15", function() {
        $("#color" ).attr("href", "../assets/css/style13.css" );
        return false;
    });
    body_event.on("click", ".color16", function() {
        $("#color" ).attr("href", "../assets/css/style14.css" );
        return false;
    });
    $('.color-picker').animate({right: '-190px'});
    body_event.on("click", ".color-picker a.handle", function(e) {
        e.preventDefault();
        var div = $('.color-picker');
        if (div.css('right') === '-190px') {
            $('.color-picker').animate({right: '0px'});
        }
        else {
            $('.color-picker').animate({right: '-190px'});
        }
    });

    /*======== LTR & RTL =============*/
    (function() {
        $('<div class="sidebar-btn rtl-btn">' +
            '<div class="rtl-btn">'+
            '<div class="rtl-btn-name">RTL' +
            '</div>' +
            '</div>' +
            '</div>').appendTo($('body'));
    })();

    var body_event = $("body");
    body_event.on("click", ".rtl-btn-name", function() {
        //
        if($('body').hasClass('direction-rtl')){
            $('body').removeClass('direction-rtl');
            $('.pixelstrap').removeClass('sm-rtl');
            $('.rtl-btn-name').text('RTL');
        }else{
            $('body').addClass('direction-rtl');
            $('.rtl-btn-name').text('LTR');
            $('.pixelstrap').addClass('sm-rtl');

        }
    });

    /*======== Dark & Light =============*/
    (function() {
        $('<div class="sidebar-btn dark-light-btn">' +
            '<div class="dark-light">'+
            '<div class="theme-layout-version">Dark' +
            // '<div class="theme-layout-version"><img src=""../assets/images/toppro_sub1.png'> +
            '</div>' +
            '</div>' +
            '</div>').appendTo($('body'));
    })();

    var body_event = $("body");
    body_event.on("click", ".theme-layout-version" , function(){
        $(this).toggleClass('theme-dark');
        $('body').removeClass('theme-dark');
        if($('.theme-layout-version').hasClass('theme-dark')){
            var link = '<link rel="stylesheet" type="text/css" id="theme-dark" href="../assets/css/theme-dark.css">';
            $("head").append(link);
            $('.theme-layout-version').text('Light');
            $('body').addClass('theme-dark');
        }else{
            $('#theme-dark').remove();
            $('.theme-layout-version').text('Dark');
        }

        return false;
    });

    /*======== Feature button =============*/
    (function() {
        $('<div class="sidebar-btn fetred-btn">' +
            '<div class="fetred-pgs-list demo-right">' +
            '<a data-toggle="modal" data-target="#demo-modal">Demo</a>' +
            '</div>' +
            '<div class="modal fade bd-example-modal-xl theme-modal demo-modal" data-target=".bd-example-modal-xl" id="demo-modal" tabindex="-1" role="dialog" aria-hidden="true">'+
            '<div class="modal-dialog modal-lg modal-dialog-centered" role="document">'+
            '<div class="modal-content demo_modal">'+
            '<div class="modal-body">'+
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'+
            '<div id="demo-section" class="demo-section">'+
            '<div class="container">'+
            '<div class="row">'+
            '<div class="col-12">'+
            '<div class="title-text text-center">'+
            '<h3>More Theme <span>Layout</span></h3></div>'+
            '</div>'+
            '</div>'+
            '<div class="row">'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects">'+
            '<div class="set-position">'+
            '<div class="layout-container demo1"></div>'+
            '<div class="demo-text">'+
            '<h4>Fashion</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="html/index.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects">'+
            '<div class="set-position">'+
            '<div class="layout-container demo2"></div>'+
            '<div class="demo-text">'+
            '<h4>Fashion Two</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="fashion-two.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects">'+
            '<div class="set-position">'+
            '<div class="layout-container demo3"></div>'+
            '<div class="demo-text">'+
            '<h4>Fashion Three</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="fashion-three.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects">'+
            '<div class="set-position">'+
            '<div class="layout-container demo4"></div>'+
            '<div class="demo-text">'+
            '<h4>Electronic</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="electronics.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects">'+
            '<div class="set-position">'+
            '<div class="layout-container demo5"></div>'+
            '<div class="demo-text">'+
            '<h4>Electronic Two</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="electronics-two.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects">'+
            '<div class="set-position">'+
            '<div class="layout-container demo6"></div>'+
            '<div class="demo-text">'+
            '<h4>Electronic Three</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="electronics-three.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects">'+
            '<div class="set-position">'+
            '<div class="layout-container demo7"></div>'+
            '<div class="demo-text">'+
            '<h4>Cosmeics</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="cosmetics.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects">'+
            '<div class="set-position">'+
            '<div class="layout-container demo8"></div>'+
            '<div class="demo-text">'+
            '<h4>Furniture</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="furniture.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects">'+
            '<div class="set-position">'+
            '<div class="layout-container demo9"></div>'+
            '<div class="demo-text">'+
            '<h4>Vegetables</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="vegetables.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects">'+
            '<div class="set-position">'+
            '<div class="layout-container demo10"></div>'+
            '<div class="demo-text">'+
            '<h4>Shoes</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="shoes.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects">'+
            '<div class="set-position">'+
            '<div class="layout-container demo11"></div>'+
            '<div class="demo-text">'+
            '<h4>Bag</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="bag.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects">'+
            '<div class="set-position">'+
            '<div class="layout-container demo12"></div>'+
            '<div class="demo-text">'+
            '<h4>Flowers</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="flower.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects effect-2">'+
            '<div class="set-position">'+
            '<div class="layout-container demo13"></div>'+
            '<div class="demo-text">'+
            '<h4>Spices</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="spices.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects">'+
            '<div class="set-position">'+
            '<div class="layout-container demo14"></div>'+
            '<div class="demo-text">'+
            '<h4>Auto</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="auto.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects">'+
            '<div class="set-position">'+
            '<div class="layout-container demo15"></div>'+
            '<div class="demo-text">'+
            '<h4>Multicategory</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="multicategory.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects">'+
            '<div class="set-position">'+
            '<div class="layout-container demo16"></div>'+
            '<div class="demo-text">'+
            '<h4>Multicategory Two</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="multicategory-two.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-xl-3 col-lg-4 col-sm-6 col-12 text-center demo-effects">'+
            '<div class="set-position">'+
            '<div class="layout-container demo17"></div>'+
            '<div class="demo-text">'+
            '<h4>Instagram Shop</h4>'+
            '<div class="btn-group demo-btn" role="group" aria-label="Basic example">'+
            '<a href="instagram-shop.html" class="btn new-tab-btn" target="_blank">Preview</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>').appendTo($('body'));
    })();

})(jQuery);


