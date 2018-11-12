$(function() {
	$(".back-btn").on('click', function(){
		window.history.back();
	});

	$(".search-form").submit(function(){
	    var val = $.trim($("#text_keyword_search").val());
	    if (val === '' || val === undefined) {
	        return false;
        }
        return true;
    });
    $(document).on('click', '.tagheader__show-tags', function() {
        $('.tag-list ').css('height','auto');
        $('.tagheader__show-tags').css('display','none');
    });

  var wMode = '';
  var effect = 'on'; //on/off effect
  $(window).on('resize', function() {
      var w = $(window).width();
      if (w < 544) {
          wMode = 1;
      } else if (w < 768) {
          wMode = 2;
      } else if (w < 992) {
          wMode = 3;
      } else if (w < 1200) {
          wMode = 4;
      } else {
          wMode = 5;
      }
      if (2 < wMode) {
          $('header').removeClass('nav-open');
      }
  });
  // On/Off effect
  if(effect=='on'){
    $('.category-list .list-item').addClass('effect');
  }
  // Btn search on Mobile
  $('header .search-sm-btn').on('click', function(){
      if($('header').hasClass('nav-open')){
          // $('header').removeClass('nav-open');
      } else {
          $(this).parents('header').toggleClass('search-open');
      }

      // if($('.nav-sm-btn').hasClass('active')){
      //     $('.nav-sm-btn').removeClass('active');
      // }
  });
  $('header .nav-sm-btn').on('click', function(){
    if($('header').hasClass('search-open')){ 
         $('header').removeClass('search-open');
     }
    $(this).parents('header').toggleClass('nav-open');
    $('.nav-sm-btn').toggleClass('active');
  });

  // Clone Navigation
  $(window).on('load', function() {
      $('#global-category ul li').clone(true).appendTo('header #nav-sm ul');
  });

  var isCenterMode = false;
  // if ($('ul.slider li').length > 1) {
  //   isCenterMode = true;
  // }
  // main slider 
	$('.slider').slick({
    arrows: false,
    centerMode: isCenterMode,
    // centerPadding: '100px',
    slidesToShow: 1,
    dots: true,
    autoplay: true,
    autoplaySpeed: 5000,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          dots: true,
          arrows: false,
          centerMode: false,
          slidesToShow: 1
        }
      },
      {
        breakpoint: 550,
        settings: {
          dots: true,
          arrows: false,
          centerMode: false,
          slidesToShow: 1
        }
      }
    ]
  });
    if($('.tag-list').outerHeight() <= 40){
        $('.tagheader__show-tags').css('display', 'none');
    }
    $('.list-tag-category ').height($('.list-tag-category .tag').outerHeight() + 2);

    $("body").on("contextmenu", "img", function(e) {
        return false;
    });

});
