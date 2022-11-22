(function($) {   
    "use strict";
    $('.slide-3').slick({
        infinite: true,
        speed: 300,
        dots: true,
        navs:false,
        slidesToShow: 3,
        slidesToScroll: 1,
        nav:true,
        margin:15 ,       
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
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    autoplay: true,
                    autoplaySpeed: 2000
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
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

    // if ($(window).width() <= 767) {
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 200) {
                $(".navbar").addClass("darkHeader");
            } else {
                $(".navbar").removeClass("darkHeader");
            }
        });
    // }
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
    // click offset
    $(document).ready(function(){
  // Add smooth scrolling to all links
  $("nav a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top - 80
      }, 1000, function(){
   
        
      });
       return false;
    } // End if
  });
});
})(jQuery)
