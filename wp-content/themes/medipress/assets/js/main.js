!(function($){
	"use strict";
	jQuery(document).ready(function($) {
		//Search in menu
		function ROSearchInMenu() {
		    $('#ro-search-form').addClass('hidden_search');  
			$('#ro-search-form').on('click', function() {
			     if($(this).hasClass('hidden_search')){
			         $(this).removeClass('hidden_search');
					 $(this).addClass('show_search');
			     }else if($(this).hasClass('show_search')){
			          $(this).addClass('hidden_search');
                      $(this).removeClass('show_search');
			     }
				$('#ro-search-form-popup').toggleClass('ro-show');
				$('#ro-search-form-popup .search-field').focus();
			});
		}
		ROSearchInMenu();
        
		//Canvas menu
		function ROCanvasMenu() {
			$('#ro-canvas-menu').addClass('hidden_canvas_menu');
			$('#ro-canvas-menu').on('click', function(e) {
				if($(this).hasClass('hidden_canvas_menu')){
					$(this).removeClass('hidden_canvas_menu');
					$(this).addClass('show_canvas_menu');
					$('.ro-menu-canvas').addClass('show_menu_canvas');
				}else if($(this).hasClass('show_canvas_menu')){
					$(this).removeClass('show_canvas_menu');
					$(this).addClass('hidden_canvas_menu');
					$('.ro-menu-canvas').removeClass('show_menu_canvas');
				}
				$('body').toggleClass('ro-cm-open');
			});
		}
		ROCanvasMenu();

		function ROTogglemenu(){
			$(document).on('click','body', function(e) {
				if($('body').hasClass('ro-cm-open') && !$(e.target).parent().hasClass('show_canvas_menu') 
					&& !$(e.target).hasClass('show_menu_canvas')){
					console.log($(e.target).parent());
					$('body').removeClass('ro-cm-open');
					$('#ro-canvas-menu').removeClass('show_canvas_menu');
					$('.ro-menu-canvas').removeClass('show_menu_canvas');
					$('#ro-canvas-menu').addClass('hidden_canvas_menu');
				}	
			});	
		}
		ROTogglemenu();	
        //Mobile version menu
        function ROmobilemenu(){
            var window_width= $( window ).width();
            $('.menu-item a').on('click', function(e){
                if(window_width < 992 && $(e.target).parent().hasClass('menu-item-has-children')){
                    return false;
                }
            });
        }
        ROmobilemenu();

		//Back top
		function ROBackTop() {
			$('#ro-backtop').on('click', function() {
				$('html,body').animate({
					scrollTop: 0
				}, 400);
				return false;
			});

			if ($(window).scrollTop() > 300) {
				$('#ro-backtop').addClass('ro-show');
			} else {
				$('#ro-backtop').removeClass('ro-show');
			}

			$(window).on('scroll', function() {

				if ($(window).scrollTop() > 300) {
					$('#ro-backtop').addClass('ro-show');
				} else {
					$('#ro-backtop').removeClass('ro-show');
				}
			});
		}
		ROBackTop();
		//Date picker
		function RODatePicker() {
			if ($('.ro-date-picker').length) {
				$('.ro-date-picker').datepicker({
					minDate: new Date()
				});
			}
		}
		RODatePicker();
		//useful var
		var $window = $(window);
		var mainMenuHeight = $('#ro-main-menu').height();
		/* Make easing scroll when click a link in page */
		function ROEasingMoving() {
			var $root = $('html, body');
			$('.ro-easing-link-group a , .ro-easing-link').on('click', function() {
				var href = $.attr(this, 'href');
				$root.animate({
					scrollTop: ($(href).offset().top - mainMenuHeight)
				}, 500, function() {
					window.location.hash = href;
				});
				return false;
			});
		}
		ROEasingMoving();
		/* Make video scale like background-size:cover */
		function ROVideoCover(VideoRatio) {
			$('.ro-video-bg-wrapper').each(function() {
				var $this = $(this);
				if ($this.height() * VideoRatio > $this.width())
					$(this).addClass('ro-video-h');
				else
					$(this).removeClass('ro-video-h');
				$(window).on('resize', function() {
					if ($this.height() * VideoRatio > $this.width())
						$this.addClass('ro-video-h');
					else
						$this.removeClass('ro-video-h');
				});
			});
		}
		ROVideoCover(16 / 9);
		/* Open the hide menu */
		function ROOpenMenu() {
			$('#ro-hamburger').on('click', function() {
				$('.ro-menu-list').toggleClass('hidden-xs');
				$('.ro-menu-list').toggleClass('hidden-sm');
			});
		}
		ROOpenMenu();
		/* Header V1 Stick */
		function ROHeaderStick() {
			var header_h = $('.ro-header-stick').outerHeight();
			$('header').css('height', header_h);
			
			if ($window.scrollTop() > header_h) {
				$('body').addClass('ro-stick-active');
			} else {
				$('body').removeClass('ro-stick-active');
			}

			$window.on('scroll', function() {
				
				if ($window.scrollTop() > header_h) {
					$('body').addClass('ro-stick-active');
				} else {
					$('body').removeClass('ro-stick-active');
				}
			});
		}
		ROHeaderStick();
		$( window ).resize(function() { ROHeaderStick(); });
		
		/* Header V2 Stick */
		function ROMenuStick() {
			if ( $( 'header > div' ).hasClass( "ro-header-v2" ) ) {
				var topPosMenu = $('.ro-header-v2 .ro-section-menu').position().top;
			
				if ($window.scrollTop() >= topPosMenu) {
					$('body').addClass('ro-stick-active');
				} else {
					$('body').removeClass('ro-stick-active');
				}

				$window.on('scroll', function() {
					if ($window.scrollTop() >= topPosMenu) {
						$('body').addClass('ro-stick-active');
					} else {
						$('body').removeClass('ro-stick-active');
					}
				});
			}
		}
		ROMenuStick();
		
		/* Active welcome slider */
		function ROWelcomeSlider() {
			$('.ro-welcome-slider').flexslider({
				animationSpeed: 700,
				animation: "slide",
				slideshow: false, 
				controlNav: false,
				directionNav: true,
			});
		}
		ROWelcomeSlider();
		
		/* Active blog slider */
		function ROBlogSlider() {
			$('.ro-blog-slider').flexslider({
				animationSpeed: 700,
				animation: "slide",
				controlNav: false,
				directionNav: true,
				prevText: "",
				nextText: "",
				itemWidth: 384,
				itemMargin: 0,
				minItems: 1, 
				maxItems: 5,
				move: 1,
			});
		}
		ROBlogSlider();
		$( window ).resize(function() { ROBlogSlider(); });
		
		/* Active doctor slider */
		function RODoctorSlider() {
			$('.tpl1 .ro-doctor-slider').slick({
			 	infinite: true,
			 	slidesToShow: 4,
				slidesToScroll: 1,
				prevArrow: '<i class="slick-btn-prev fa fa-angle-left"></i>',
				nextArrow: '<i class="slick-btn-next fa fa-angle-right"></i>',
				responsive: [
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 2,
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
						}
					}
				]
			});
		}
		RODoctorSlider();
		
		function RODoctorSlider2() {
			$('.tpl2 .ro-doctor-slider').slick({
			 	infinite: true,
			 	slidesToShow: 4,
				slidesToScroll: 1,
				prevArrow: '<i class="slick-btn-prev fa fa-angle-left"></i>',
				nextArrow: '<i class="slick-btn-next fa fa-angle-right"></i>',
				responsive: [
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 2,
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
						}
					}
				]
			});
		}
		RODoctorSlider2();
		
		function RODoctorSlider3() {
			$('.ro-doctor-related .ro-doctor-slider').slick({
			 	infinite: true,
			 	slidesToShow: 4,
				slidesToScroll: 1,
				prevArrow: '<i class="slick-btn-prev fa fa-angle-left"></i>',
				nextArrow: '<i class="slick-btn-next fa fa-angle-right"></i>',
				responsive: [
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 2,
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
						}
					}
				]
			});
		}
		RODoctorSlider3();
		
		/* Active latest news slider */
		function ROLatestNewsSlider() {
			$('.ro-latest-news-slider').flexslider({
				animationSpeed: 700,
				animation: "slide",
				controlNav: false,
				directionNav: true,
				prevText: "",
				nextText: "",
			});
		}
		ROLatestNewsSlider();
		
		/* Active testimonial slider */
		function ROTestimonalSlider() {
			$('.tpl1 .ro-testimonial-slider').flexslider({
				animationSpeed: 700,
				animation: "slide",
				direction: "horizontal", 
				controlNav: false,
				directionNav: true,
			});
		}
		ROTestimonalSlider();
		
		function ROTestimonalSlider2() {
			$('.tpl2 .ro-testimonial-slider').flexslider({
				animationSpeed: 700,
				animation: "slide",
				direction: "horizontal", 
				controlNav: true,
				directionNav: false,
			});
		}
		ROTestimonalSlider2();
		
		function ROTestimonalSlider3() {
			$('.tpl3 .ro-testimonial-slider').slick({
			 	infinite: true,
			 	slidesToShow: 3,
				slidesToScroll: 1,
				arrows: false,
				dots: true,
				responsive: [
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 2,
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
						}
					}
				]
			});
		}
		ROTestimonalSlider3();
		
		function ROAwardSlider() {
			$('.ro-award-slider').slick({
			 	infinite: true,
			 	slidesToShow: 3,
				slidesToScroll: 1,
				prevArrow: '<i class="slick-btn-prev fa fa-long-arrow-left"></i>',
				nextArrow: '<i class="slick-btn-next fa fa-long-arrow-right"></i>',
			});
		}
		ROAwardSlider();
		
		//Canvas menu
		function ROFindDoctorReset() {
			$('.ro-find-doctor-form .ro-reset').on('click', function() {
				$('.ro-find-doctor-form select.ro-doctor-department option').each(function() {
					$( this ).removeAttr( "selected" );
				});
				$('.ro-find-doctor-form input.ro-doctor-name').attr("value", "");
				$('.ro-find-doctor-form .ro-doctor-name-alphabet span').each(function() {
					$('.ro-find-doctor-form .ro-doctor-name-alphabet span input').removeAttr( "checked" );
				});
				$('.ro-find-doctor-form input.ro-doctor-hospital').each(function() {
					$(this).removeAttr( "checked" );
				});
			});
		}
		ROFindDoctorReset();
		
		/* Edit Newletter*/
		function ROEditNewLetter() {
			var _newletter_form = $('.ro-footer .tnp-widget form');
			_newletter_form.find('.tnp-field-firstname').find('label').html("&#xf007;");
			_newletter_form.find('.tnp-field-firstname').find('.tnp-firstname').attr("placeholder","Full Name");
			_newletter_form.find('.tnp-field-email').find('label').html("&#xf0e0;");
			_newletter_form.find('.tnp-field-email').find('.tnp-email').attr("placeholder","Email address");

		}
		ROEditNewLetter();
		
		/* Counter Up */
		function ROCounterUp() {
			if($( ".ro-number" ).length > 0) {
				$('.ro-number').counterUp({
					delay: 10,
					time: 1000
				});
			}
		}
		ROCounterUp();
		
		/* Mixitup */
		if ($.fn.mixItUp) { $('#Container').mixItUp(); }

		$('.ro-pricing-grid-wrapper').hover(function(){
			$(this).find('.item-featured').removeClass('item-featured').addClass('item-active');
			},function(){
				$(this).find('.item-active').removeClass('item-active').addClass('item-featured');
		});
		$('.btn-search-close').click(function(){
			$(this).closest('.ro-search-form').removeClass('ro-show');
		});
		$('.search-overlay').click(function(){
			$(this).closest('.ro-search-form').removeClass('ro-show');
		});
		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			show_title: false,
		});
		
	});
	$(window).load(function(){
		// Same Height
		$('.vc_row.same-height .row.main-row').each(function() {
			var MaxHeight = 0;
			var width_sc = $(window).width();
			if(width_sc > 767){
				$(this).children().each(function() {
					var height = $(this).outerHeight();
					if(MaxHeight < height) {
						MaxHeight = height;
					}
				});
				$(this).children().each(function() {
					$(this).css('min-height', MaxHeight);
				});
			}
		});
		$('.vc_row.blog-same-height .row.main-row').each(function() {
			var MaxHeight = 0;
			var width_sc = $(window).width();
			if(width_sc > 991){
				$(this).children().each(function() {
					var height = $(this).outerHeight();
					if(MaxHeight < height) {
						MaxHeight = height;
					}
				});
				$(this).children().each(function() {
					$(this).css('min-height', MaxHeight);
				});
			}
		});
	});
})(jQuery);