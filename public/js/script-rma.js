function stickyHeader() {
  // Sticky Header
  if ($(window).scrollTop() >= 300) {
      $('body').addClass('sticky-header');
  }
  else {
      $('body').removeClass('sticky-header');
    }
}
// Back to top button
function toTop() {
  if ($('#back-to-top').length) {
      var scrollTrigger = 500, // px
      backToTop = function () {
          var scrollTop = $(window).scrollTop();
          if (scrollTop > scrollTrigger) {
              $('#back-to-top').addClass('show');
          } else {
              $('#back-to-top').removeClass('show');
          }
      };
      // backToTop();
      $(window).on('scroll', function () {
          backToTop();
      });
      $('#back-to-top').on('click', function (e) {
          e.preventDefault();
          $('html,body').animate({
              scrollTop: 0
          }, 550);
          return false;
      });
  }
}
// Inner page title 
$(document).on('click', '.dropdown-menu', function (e) {
  e.stopPropagation();
});
$("#inner_title").text($("title").text());
// Nested Navigation
if ($(window).width() >= 1200) {
  $('.ds-nav-continue-1').hover(function() {
      $('.megamenu.show .ds-data-nav-cover').addClass('d-none')
      $('.ds-data-nav, .ds-data-nav2').removeClass('active')
      $('.ds-data-nav[ds-data-nav="'+$(this).text()+'"]').addClass('active')

      $('.ds-nav-continue-1, .ds-nav-continue-2').removeClass('ds-active')
      $(this).addClass('ds-active')
  })
  $('.ds-nav-continue-2').hover(function() {
      $('.ds-data-nav2').removeClass('active')
      $('.ds-data-nav2[ds-data-nav2="'+$(this).text()+'"]').addClass('active')

      $('.ds-nav-continue-2').removeClass('ds-active')
      $(this).addClass('ds-active')
  })
}
if ($(window).width() < 1200) {
  $('#mobile-nav-overlay').on('click', function() {
    $('#page-header .navbar-dark .navbar-toggler').trigger('click');
  })
  $('.ds-nav-continue-1').on('click', function(e) {
      e.preventDefault();
      e.stopPropagation(); 
      $('.megamenu.show .ds-data-nav-cover').addClass('d-none')
      $('.ds-data-nav, .ds-data-nav2').removeClass('active')
      $('.ds-data-nav[ds-data-nav="'+$(this).text()+'"]').addClass('active')

      $('.ds-nav-continue-1, .ds-nav-continue-2').removeClass('ds-active')
      $(this).addClass('ds-active')
  })

  $('.ds-nav-continue-2').on('click', function(e) {
    e.preventDefault();
    e.stopPropagation(); 
    $('.ds-data-nav2').removeClass('active')
    $('.ds-data-nav2[ds-data-nav2="'+$(this).text()+'"]').addClass('active')

    $('.ds-nav-continue-2').removeClass('ds-active')
    $(this).addClass('ds-active')
  })
}
// Circle Counter 2
$(".circle_percent").each(function() {
    var $this = $(this),
    $dataV = $this.data("percent"),
    $dataDeg = $dataV * 3.6,
    $round = $this.find(".round_per");
  $round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)"); 
  $this.append('<div class="circle_inbox"><span class="percent_text"></span></div>');
  $this.prop('Counter', 0).animate({Counter: $dataV},
  {
    duration: 2000, 
    easing: 'swing', 
    step: function (now) {
            $this.find(".percent_text").text(Math.ceil(now)+"%");
        }
    });
  if($dataV >= 51){
    $round.css("transform", "rotate(" + 360 + "deg)");
    setTimeout(function(){
      $this.addClass("percent_more");
    },1000);
    setTimeout(function(){
      $round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");
    },1000);
  } 
});
// Testimonials 1
$('.slider').slick({
  dots: true,
  prevArrow: false,
  nextArrow: false,
  infinite: true,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
// Testimonials 2
$('.testimonial-carousel').slick({
  dots: true,
  arrows: true,
  prevArrow: '<button class="ds-arrow ds-testimonial-arrow slide-arrow prev-arrow"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></button>',
  nextArrow: '<button class="ds-arrow ds-testimonial-arrow slide-arrow next-arrow"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></button>',
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false
      }
    }
  ]
});
// Testimonials 3
$('.slider-testimonials2').slick({
  dots: true,
  prevArrow: false,
  nextArrow: false,
  infinite: true,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
// Testimonials 2
$('.ds-progress-slide').slick({
  dots: true,
  arrows: false,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  slidesToScroll: 1
});
    
$('.ds-progress-slide .slick-slide:not(.slick-cloned)').each(function() {
  var title = '<div class="ds-slick-dot"><span></span></div><div class="ds-slick-title">'+$(this).find('h3').text()+'</div>'
  var index = $(this).index() - 1;
  $('.ds-progress-slide .slick-dots > li').eq(index).html(title)

})
// Categories
$('.slider2').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  arrows: true,
  prevArrow: '<button class="ds-arrow slide-arrow prev-arrow"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></button>',
  nextArrow: '<button class="ds-arrow slide-arrow next-arrow"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></button>',
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3
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
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
$('.customer-logos').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1500,
    arrows: true,
    dots: false,
    pauseOnHover: false,
    responsive: [{
        breakpoint: 768,
        settings: {
            slidesToShow: 4
        }
    }, {
        breakpoint: 520,
        settings: {
            slidesToShow: 3
        }
    }]
});
$(document).ready(function(){
    toTop()
});
$(window).scroll(function(){
    stickyHeader()
});