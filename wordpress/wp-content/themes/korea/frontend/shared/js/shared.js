/*!
 * ScriptName: shared.js
 *
 * FoodConnection
 * http://foodconnection.jp/
 * http://foodconnection.vn/
 *
 */

$(function () {
	$(".toggleMenu").click(function () {
		if ($('body').hasClass('navOpen')) {
			$('body').addClass('navClose');
			$('body').removeClass('navOpen');
			$('body').css('position', 'static');
			$(window).scrollTop(offsetY);
			$(".toggleMenu").addClass('active');
		} else {
			$('body').addClass('navOpen');
			$('body').removeClass('navClose');
			offsetY = window.pageYOffset;
			$('body').css({
				position: 'fixed',
				width: '100%',
				'top': -offsetY + 'px'
			});
			$(".toggleMenu").removeClass('active');
			return false;
		}
	});
	$(".header_menu .g_nav li a").click(function () {
		$('body').removeClass('navOpen');
		$('body').addClass('navClose');
		$(".toggleMenu").removeClass('active');
		$('body').css('position', 'static');
	});
});

$(document).ready(function () {
	"use strict";
	$('#tabs-nav input[type="radio"]').click(function () {
		var demovalue = $(this).val();
		$("div.myDiv").hide();
		$("#show" + demovalue).show();
	});
});



$(document).ready(function () {
	"use strict";
	var ww = document.body.clientWidth;
	$(".toggleMenu").click(function (e) {
		e.preventDefault();
		$(this).toggleClass("active");
		$(".box_nav").fadeToggle();
		//$(".g_nav").fadeToggle();
	});

	$(".g_nav > li > span").each(function () {
		$(this).addClass("parent");
	})
	adjustMenu(ww);
});

function adjustMenu(ww) {
	"use strict";
	if (ww <= 1000) { //767ﾃδ､ﾃつｻﾃつ･ﾃδ､ﾃつｸﾃ｢竄ｬﾂｹ=ﾃδ｣ﾃ｢竄ｬﾅ｡ﾃつｹﾃδ｣ﾃ�凖�ｾﾃδ｣ﾃ�凖｢竄ｬﾂｺ
		$(".toggleMenu img").css("display", "inline-block");
		if (!$(".toggleMenu").hasClass("active")) {
			$(".box_nav").hide();
		} else {
			$(".box_nav").css("display", "block");
		}
		$(".g_nav>li").unbind('mouseenter mouseleave');
		$(".g_nav li span.parent").unbind("click");
		$(".g_nav li span.parent").click(function (e) {
			e.preventDefault();
			$(this).parent("li").toggleClass('hover');
		});

		var defPos = 0;
		$(window).scroll(function () {
			var currentPos = $(this).scrollTop();
			if (currentPos > defPos) {
				if ($(window).scrollTop() >= 250) {
					var hh = $("#header").height();
					$("#header").css("top", "-" + hh + "px");
				}
			} else {
				$("#header").css("top", 0 + "px");
			}
			defPos = currentPos;
		});


	} else { //768ﾃδ､ﾃつｻﾃつ･ﾃδ､ﾃつｸﾃ� =PC,ﾃδ｣ﾃ｢竄ｬﾅ｡ﾃつｿﾃδ｣ﾃ�凖｢竄ｬ窶愿δ｣ﾃ�凖つｬﾃδ｣ﾃ�凖�凖δ｣ﾃ�凖銀�
		$(".toggleMenu img").css("display", "none");
		$(".box_nav").removeAttr("style");

		var defPos = 0;
		$(window).scroll(function () {
			var currentPos = $(this).scrollTop();
			if (currentPos > defPos) {
				if ($(window).scrollTop() >= 250) {
					var hh = $("#header").height();
				}
			} else {
				$("#header").css("top", 0 + "px");
			}
			defPos = currentPos;
		});

	}
}
$(window).bind('resize orientationchange', function () {
	//ww = document.body.clientWidth;
	ww = window.innerWidth;
	adjustMenu(ww);
});



//iPhone縺ｧ逕ｻ髱｢繧呈綾縺｣縺滄圀縺ｫ繝｡繝九Η繝ｼ縺梧ｮ九ｋ迴ｾ雎｡繧貞屓驕ｿ
$("#header .g_nav li a").click(function () {
	if ($(window).width() < 768) {
		$(".toggleMenu").removeClass("active");
		$("#header .box_nav").fadeOut("500");
	}
});
