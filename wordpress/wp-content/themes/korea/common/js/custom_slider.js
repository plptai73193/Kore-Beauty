$(document).ready(function() {
	// slider servide hot
	$('.service_hot .slider').slick({
		infinite: true,
		speed: 300,
		autoplay: true,
		slidesToShow: 1,
		fade: true,
		speed: 1500
	});
	$('.about_video .slider').slick({
		infinite: true,
		speed: 300,
		autoplay: true,
		slidesToShow: 1,
		fade: true,
		speed: 1500
	});

	$('.slider_video').slick({
		infinite: true,
		speed: 300,
		autoplay: false,
		slidesToShow: 1,
		fade: true,
		speed: 1500,
		arrows: false,
		asNavFor: '.slider_nav',
		slidesToScroll: 1
	});

	$('.slider_nav').slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		dots: true,
		centerMode: false,
		focusOnSelect: false,
		vertical: true,
		asNavFor: '.slider_video',
		centerMode: true,
		focusOnSelect: true,
		autoplay: false
	});

	$('.donate .slider').slick({
		infinite: true,
		speed: 300,
		autoplay: true,
		slidesToShow: 1,
		fade: true,
		speed: 1500
	});
	$('.service_sub .slider').slick({
		infinite: true,
		speed: 300,
		autoplay: true,
		slidesToShow: 1,
		fade: true,
		speed: 1500,
		dots: true,
		arrows: false
	});
	$('.images_before_after .slider')
		.slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			arrows: true,
			dots: false,
			autoplay: true,
			centerMode: true,
			variableWidth: true,
			loop: true,
			infinite: true,
			speed: 1000,
			autoSpeed: 1500,
			// focusOnSelect: true,
			// cssEase: 'linear',
			// touchMove: true,
			prevArrow: '<button class="slick-prev"> < </button>',
			nextArrow: '<button class="slick-next"> > </button>'
		})
		.on('beforeChange', (event, slick, currentSlide, nextSlide) => {
			if (currentSlide !== nextSlide) {
				document.querySelectorAll('.slick-center + .slick-cloned').forEach((next) => {
					// timeout required or Slick will overwrite the classes
					setTimeout(() => next.classList.add('slick-current', 'slick-center'));
				});
			}
		});
	var imgs = $('.images_before_after .slider img');
	imgs.each(function() {
		var item = $(this).closest('.item .images .imgDrop');
		item.css({
			'background-image': 'url(' + $(this).attr('src') + ')',
			'background-position': 'center',
			'-webkit-background-size': 'cover',
			'background-size': 'cover'
		});
		$(this).hide();
	});

	$('.feedback .slider').slick({
		infinite: true,
		slidesToShow: 3,
		speed: 300,
		autoplay: false,
		// slidesToShow: 1,
		fade: false,
		speed: 1500,
		responsive: [
			{
				breakpoint: 767,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});
});
