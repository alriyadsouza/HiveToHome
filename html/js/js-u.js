 jQuery(document).ready(function($) {

     $('ul#mastmenu li:nth-child(1) a, .footer-menu li:nth-child(3) a').on('click', function(event) {
         event.preventDefault();
         /* Act on the event */

         $('html, body').animate({
             scrollTop: -100 + $('section#menu').offset().top
         }, 1000);
     });

     $('ul#mastmenu li:nth-child(2) a').on('click', function(event) {
         event.preventDefault();
         /* Act on the event */

         $('html, body').animate({
             scrollTop: -100 + $('section#meetchef').offset().top
         }, 1000);
     });
     $('ul#mastmenu li:nth-child(3) a').on('click', function(event) {
       //  event.preventDefault();
         /* Act on the event */

        // $('html, body').animate({
          //   scrollTop: -100 + $('section#blog').offset().top
        // }, 1000);
     });
     $('ul#mastmenu li:nth-child(4) a, .footer-menu li:nth-child(4) a').on('click', function(event) {
         event.preventDefault();
         /* Act on the event */

         $('html, body').animate({
             scrollTop: -100 + $('section#gallery').offset().top
         }, 1000);
     });
     $('ul#mastmenu li:nth-child(5) a, .footer-menu li:nth-child(5) a').on('click', function(event) {
         event.preventDefault();
         /* Act on the event */

         $('html, body').animate({
             scrollTop: -100 + $('section#testimonials').offset().top
         }, 1000);
     });
     $('ul#mastmenu li:nth-child(6) a, .footer-menu li:nth-child(6) a').on('click', function(event) {
         event.preventDefault();
         /* Act on the event */

         $('html, body').animate({
             scrollTop: -100 + $('section#about').offset().top
         }, 1000);
     });

     $('.footer-menu li:nth-child(2) a').on('click', function(event) {
         event.preventDefault();
         /* Act on the event */

         $('html, body').animate({
             scrollTop: -100 + $('section#about').offset().top
         }, 1000);
     });

     $('section#introduce button.btn-link').on('click', function(event) {
         event.preventDefault();
         /* Act on the event */

         $('html, body').animate({
             scrollTop: -100 + $('section#contact').offset().top
         }, 1000);
     });

     $('#slider-menu').slick({
         slidesToShow: 4,
         slidesToScroll: 4,
         dots: true,
         autoplay: false,
         autoplaySpeed: 2000,
         adaptiveHeight: true,
         infinite: false,
         responsive: [{
                 breakpoint: 992,
                 settings: {
                     slidesToShow: 2,
                     slidesToScroll: 2
                 }
             },
             {
                 breakpoint: 575,
                 settings: {
                     slidesToShow: 1,
                     slidesToScroll: 1
                 }
             }
             // You can unslick at a given breakpoint now by adding:
             // settings: "unslick"
             // instead of a settings object
         ]
     });

     $('#slider-blog').slick({
         slidesToShow: 3,
         slidesToScroll: 3,
         dots: true,
         autoplay: false,
         autoplaySpeed: 2000,
         adaptiveHeight: true,
         infinite: false,
         responsive: [{
                 breakpoint: 992,
                 settings: {
                     slidesToShow: 2,
                     slidesToScroll: 2
                 }
             },
             {
                 breakpoint: 575,
                 settings: {
                     slidesToShow: 1,
                     slidesToScroll: 1
                 }
             }
             // You can unslick at a given breakpoint now by adding:
             // settings: "unslick"
             // instead of a settings object
         ]
     });

     $('.qasa-insta-images').slick({
         infinite: true,
         slidesToShow: 4,
         slidesToScroll: 6,
         dots: false,
         autoplay: false,
         autoplaySpeed: 2000,
         adaptiveHeight: true,
         centerMode: true,
         arrows: false,
         responsive: [{
                 breakpoint: 992,
                 settings: {
                     slidesToShow: 2,
                     slidesToScroll: 4
                 }
             },
             {
                 breakpoint: 576,
                 settings: {
                     slidesToShow: 1,
                     slidesToScroll: 1
                 }
             }
             // You can unslick at a given breakpoint now by adding:
             // settings: "unslick"
             // instead of a settings object
         ]
     });

     $('section#introduce .icon-video button').on('click', function(event) {
         $('.section-header.bigsub').addClass('active');
         $('.contact-video').addClass('active');
     });
     $('.contact-video').on('click', function(event) {
         $('.section-header.bigsub').removeClass('active');
         $('.contact-video').removeClass('active');
     });
 })