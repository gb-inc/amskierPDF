var menuHideTimer;
var sigDrawn = false;

$(document).ready(function() {
	bindMenus();
});
function bindMenus() {
	$(".mnav li.main-nav").bind("mouseover", function(e) {
		clearTimeout(menuHideTimer);
		$(".drop-menu").hide();
		var id = $(this).attr("id");
		if (id.match(/^menu_(\d+)$/)) {
			var idx = RegExp.$1;
			$("#drop_"+idx).show();
		}
	});
	$(".mnav li.main-nav").bind("mouseout", function(e) {
		clearTimeout(menuHideTimer);
		menuHideTimer = setTimeout("$('.drop-menu').hide()", 500);
	});
}
function toggleMenu(m) {
	var state = $("#drop_"+m).css("display");
	if (state == "none") {
		$("#drop_"+m).show();
	}
	else {
		$("#drop_"+m).hide();
	}
}
function tablet_toggleMenu() {
	$(".th-menu-sub").hide();
	var body = $("body");
	var theader = $("#tablet_header");
	var menu = $(".th-menu");
	var transitionEnd = 'transitionend webkitTransitionEnd otransitionend MSTransitionEnd';
	body.addClass("animating");
	if (body.hasClass("menu-visible")) {
		body.addClass("up");
	}
	else {
		body.addClass("down");
	}
	theader.on(transitionEnd, function() {
		body.removeClass("animating up down").toggleClass("menu-visible");
		theader.off(transitionEnd);
	});
}
function tablet_toggleSubmenu(m) {
	if ($("#tab_sub_"+m).css("display") == "none") {
		$(".th-menu-sub").not("#tab_sub_"+m).hide();
		$(".th-menu img").not("#tab_arrow_"+m).attr("src", "/graphics/thin-arrow-right.png");
		$("#tab_sub_"+m).show();
		$("#tab_arrow_"+m).attr("src", "/graphics/thin-arrow-down.png");
	}
	else {
		$("#tab_sub_"+m).hide();
		$("#tab_arrow_"+m).attr("src", "/graphics/thin-arrow-right.png");
	}
}