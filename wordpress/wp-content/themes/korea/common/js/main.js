$(document).ready(function() {
	$(window).on('load', function() {
		var w = $('.sale_off .content').width() - $('.sale_off .images').width();
		$('.sale_off .content_main').css({
			width: w
		});

		function myResizeFunction() {
			var w = $('.sale_off .content').width() - $('.sale_off .images').width();
			$('.sale_off .content_main').css({
				width: w
			});
		}
		myResizeFunction();
		$(window).resize(myResizeFunction).trigger('resize');
	});
	// $(window).on('resize', function(){
	//     var win = $(this); //this = window
	//         if (win.height() >= 820) { /* ... */ }
	//         if (win.width() >= 1280) { /* ... */ }
	// });
	// navtop
	$(window)
		.scroll(function() {
			var hnav = $('header > .wraper').height();
			var scrollDistance = $(window).scrollTop();
			if (scrollDistance >= hnav) {
				$('header').addClass('scrollTop').css({
					'margin-bottom': $('header nav').height()
				});
			}
			if (scrollDistance <= hnav) {
				$('header').removeClass('scrollTop').css({
					'margin-bottom': 0
				});
			}
		})
		.scroll();

	// toggle
	$('.toggle_parents').each(function() {
		if ($(this).hasClass('active')) {
			$(this).find('.toggle_content').slideDown();
		} else {
			$(this).find('.toggle_content').slideUp();
		}
		$(this).find('.toggle_btn').click(function() {
			$(this).parents('.toggle_parents').toggleClass('active');
			$(this).parents('.toggle_parents').find('.toggle_content').slideToggle();
			$(this).parents('.toggle_parents').siblings().removeClass('active').find('.toggle_content').slideUp();
		});
	});

	// tab
	$('.tab_parents').each(function() {
		$('.tab_parents .tab_nav li:first-child, .tab_parents .tab_main .tab_content:first-child').addClass('current');
		$('.tab_parents .tab_nav li').click(function() {
			$(this).addClass('current').siblings().removeClass('current');
			var panel = $(this).attr('data-tab');
			$(this).parents('.tab_parents').find(panel).addClass('current').siblings().removeClass('current');
			return false;
		});
	});

	$('.tab_video .tab_nav li').click(function() {
		var videoAuthor = $(this).children().attr('data-author');
		var videoExcerpt = $(this).children().attr('data-excerpt');
		var videoDate = $(this).children().attr('data-date');
		var videoTitle = $(this).children().find('h5').attr('data-title');
		var videoThumb = $(this).children().find('img').attr('src');
		$('.tab_content h4').html(videoTitle);
		$('.tab_content .name').html(videoAuthor);
		$('.tab_content .date').html(videoDate);
		$('.tab_content .text').html(videoExcerpt);
		$('.tab_content img').attr('src', videoThumb);
	});

	$('.tab_hover').each(function() {
		$('.tab_nav li').hover(function() {
			$(this).addClass('current').siblings().removeClass('current');
			var panel = $(this).attr('data-tab');
			$(this).parents('.tab_hover').find(panel).addClass('current').siblings().removeClass('current');
			return true;
		});
	});

	/* -------------------------------
    video
    --------------------------------- */
	$('.video_production').each(function() {
		var src = $(this).find('iframe').attr('src');
		$(this).find('iframe').attr('data-src', src).attr('src', ' ');
		$(this).click(function() {
			$(this).addClass('show');
			$(this).find('iframe').show().attr('src', src);
			$(this).find('.img_bg').fadeOut(1500);
		});
	});
});
