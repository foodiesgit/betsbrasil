$(function() {
	'use strict'
	
	// ______________LOADER
	$("#global-loader").fadeOut("slow");
	
	
	// This template is mobile first so active menu in navbar
	// has submenu displayed by default but not in desktop
	// so the code below will hide the active menu if it's in desktop
	if (window.matchMedia('(min-width: 992px)').matches) {
		$('.main-navbar .active').removeClass('show');
		$('.main-header-menu .active').removeClass('show');
	}
	// Shows header dropdown while hiding others
	$('.main-header .dropdown > a').on('click', function(e) {
		e.preventDefault();
		$(this).parent().toggleClass('show');
		$(this).parent().siblings().removeClass('show');
		$(this).find('.drop-flag').removeClass('show');
	});
	$('.country-flag1').on('click', function(e){
		$('.main-header .dropdown > a').parent().siblings().removeClass('show');
	});
	
	// ______________Full screen
	$(document).on("click", ".full-screen", function toggleFullScreen() {
		$('html').addClass('fullscreen-button');
		if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
			if (document.documentElement.requestFullScreen) {
				document.documentElement.requestFullScreen();
			} else if (document.documentElement.mozRequestFullScreen) {
				document.documentElement.mozRequestFullScreen();
			} else if (document.documentElement.webkitRequestFullScreen) {
				document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
			} else if (document.documentElement.msRequestFullscreen) {
				document.documentElement.msRequestFullscreen();
			}
		} else {
			$('html').removeClass('fullscreen-button');
			if (document.cancelFullScreen) {
				document.cancelFullScreen();
			} else if (document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if (document.webkitCancelFullScreen) {
				document.webkitCancelFullScreen();
			} else if (document.msExitFullscreen) {
				document.msExitFullscreen();
			}
		}
	})

	// ______________ RATING STAR
	var ratingOptions = {
		selectors: {
			starsSelector: '.rating-stars',
			starSelector: '.rating-star',
			starActiveClass: 'is--active',
			starHoverClass: 'is--hover',
			starNoHoverClass: 'is--no-hover',
			targetFormElementSelector: '.rating-value'
		}
	};
	$(".rating-stars").ratingStars(ratingOptions);
	
	
	// ______________Cover Image
	$(".cover-image").each(function() {
		var attr = $(this).attr('data-image-src');
		if (typeof attr !== typeof undefined && attr !== false) {
			$(this).css('background', 'url(' + attr + ') center center');
		}
	});
	
	
	// ______________Toast
	$(".toast").toast();	
	
	/* Headerfixed */
	$(window).on("scroll", function(e){
		if ($(window).scrollTop() >= 66) {
			$('main-header').addClass('fixed-header');
		}
		else {
			$('.main-header').removeClass('fixed-header');
		}
    });
	
	// ______________Search
	$('body, .main-header form[role="search"] button[type="reset"]').on('click keyup', function(event) {
		if (event.which == 27 && $('.main-header form[role="search"]').hasClass('active') ||
		$(event.currentTarget).attr('type') == 'reset') {
		closeSearch();
		}
	});
	function closeSearch() {
		var $form = $('.main-header form[role="search"].active')
		$form.find('input').val('');
		$form.removeClass('active');
	}
	// Show Search if form is not active // event.preventDefault() is important, this prevents the form from submitting
	$(document).on('click', '.main-header form[role="search"]:not(.active) button[type="submit"]', function(event) {
		event.preventDefault();
		var $form = $(this).closest('form'),
		$input = $form.find('input');
		$form.addClass('active');
		$input.focus();
	});
	// if your form is ajax remember to call `closeSearch()` to close the search container
	$(document).on('click', '.main-header form[role="search"].active button[type="submit"]', function(event) {
		event.preventDefault();
		var $form = $(this).closest('form'),
		$input = $form.find('input');
		$('#showSearchTerm').text($input.val());
		closeSearch()
	});
	
	
	
	/* ----------------------------------- */
	
	// Showing submenu in navbar while hiding previous open submenu
	$('.main-navbar .with-sub').on('click', function(e) {
		e.preventDefault();
		$(this).parent().toggleClass('show');
		$(this).parent().siblings().removeClass('show');
	});
	// this will hide dropdown menu from open in mobile
	$('.dropdown-menu .main-header-arrow').on('click', function(e) {
		e.preventDefault();
		$(this).closest('.dropdown').removeClass('show');
	});
	// this will show navbar in left for mobile only
	$('#mainNavShow, #azNavbarShow').on('click', function(e) {
		e.preventDefault();
		$('body').addClass('main-navbar-show');
	});
	// this will hide currently open content of page
	// only works for mobile
	$('#mainContentLeftShow').on('click touch', function(e) {
		e.preventDefault();
		$('body').addClass('main-content-left-show');
	});
	// This will hide left content from showing up in mobile only
	$('#mainContentLeftHide').on('click touch', function(e) {
		e.preventDefault();
		$('body').removeClass('main-content-left-show');
	});
	// this will hide content body from showing up in mobile only
	$('#mainContentBodyHide').on('click touch', function(e) {
		e.preventDefault();
		$('body').removeClass('main-content-body-show');
	})
	// navbar backdrop for mobile only
	$('body').append('<div class="main-navbar-backdrop"></div>');
	$('.main-navbar-backdrop').on('click touchstart', function() {
		$('body').removeClass('main-navbar-show');
	});
	// Close dropdown menu of header menu
	$(document).on('click touchstart', function(e) {
		e.stopPropagation();
		// closing of dropdown menu in header when clicking outside of it
		var dropTarg = $(e.target).closest('.main-header .dropdown').length;
		if (!dropTarg) {
			$('.main-header .dropdown').removeClass('show');
		}
		// closing nav sub menu of header when clicking outside of it
		if (window.matchMedia('(min-width: 992px)').matches) {
			// Navbar
			var navTarg = $(e.target).closest('.main-navbar .nav-item').length;
			if (!navTarg) {
				$('.main-navbar .show').removeClass('show');
			}
			// Header Menu
			var menuTarg = $(e.target).closest('.main-header-menu .nav-item').length;
			if (!menuTarg) {
				$('.main-header-menu .show').removeClass('show');
			}
			if ($(e.target).hasClass('main-menu-sub-mega')) {
				$('.main-header-menu .show').removeClass('show');
			}
		} else {
			//
			if (!$(e.target).closest('#mainMenuShow').length) {
				var hm = $(e.target).closest('.main-header-menu').length;
				if (!hm) {
					$('body').removeClass('main-header-menu-show');
				}
			}
		}
	});
	$('#mainMenuShow').on('click', function(e) {
		e.preventDefault();
		$('body').toggleClass('main-header-menu-show');
	})
	$('.main-header-menu .with-sub').on('click', function(e) {
		e.preventDefault();
		$(this).parent().toggleClass('show');
		$(this).parent().siblings().removeClass('show');
	})
	$('.main-header-menu-header .close').on('click', function(e) {
		e.preventDefault();
		$('body').removeClass('main-header-menu-show');
	})
	
	$(".card-header-right .card-option .fe fe-chevron-left").on("click", function() {
		var a = $(this);
		if (a.hasClass("icofont-simple-right")) {
			   a.parents(".card-option").animate({
				width: "35px",
			})
		} else {
		   a.parents(".card-option").animate({
			width: "180px",
			})
		}
		$(this).toggleClass("fe fe-chevron-right").fadeIn("slow")
	});
	
	 // ___________TOOLTIP	
	$('[data-toggle="tooltip"]').tooltip();
	// colored tooltip
	$('[data-toggle="tooltip-primary"]').tooltip({
		template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="arrow"><\/div><div class="tooltip-inner"><\/div><\/div>'
	});
	$('[data-toggle="tooltip-secondary"]').tooltip({
		template: '<div class="tooltip tooltip-secondary" role="tooltip"><div class="arrow"><\/div><div class="tooltip-inner"><\/div><\/div>'
	});
	
	// __________POPOVER
	$('[data-toggle="popover"]').popover();
	$('[data-popover-color="head-primary"]').popover({
		template: '<div class="popover popover-head-primary" role="tooltip"><div class="arrow"><\/div><h3 class="popover-header"><\/h3><div class="popover-body"><\/div><\/div>'
	});
	$('[data-popover-color="head-secondary"]').popover({
		template: '<div class="popover popover-head-secondary" role="tooltip"><div class="arrow"><\/div><h3 class="popover-header"><\/h3><div class="popover-body"><\/div><\/div>'
	});
	$('[data-popover-color="primary"]').popover({
		template: '<div class="popover popover-primary" role="tooltip"><div class="arrow"><\/div><h3 class="popover-header"><\/h3><div class="popover-body"><\/div><\/div>'
	});
	$('[data-popover-color="secondary"]').popover({
		template: '<div class="popover popover-secondary" role="tooltip"><div class="arrow"><\/div><h3 class="popover-header"><\/h3><div class="popover-body"><\/div><\/div>'
	});
	$(document).on('click', function(e) {
		$('[data-toggle="popover"],[data-original-title]').each(function() {
			//the 'is' for buttons that trigger popups
			//the 'has' for icons within a button that triggers a popup
			if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
				(($(this).popover('hide').data('bs.popover') || {}).inState || {}).click = false // fix for BS 3.3.6
			}
		});
	});
	
	// Enable Eva-icons with SVG markup
	eva.replace();
	
	
	// ______________Horizontal-menu Active Class
	$(document).ready(function() {
		$(".horizontalMenu-list li a").each(function() {
			var pageUrl = window.location.href.split(/[?#]/)[0];
			if (this.href == pageUrl) {
				$(this).addClass("active");
				$(this).parent().addClass("active"); // add active to li of the current link
				$(this).parent().parent().prev().addClass("active"); // add active class to an anchor
				$(this).parent().parent().prev().click(); // click the item to make it drop
			}
		});
	});
	
	
	// ______________Active Class
	$(document).ready(function() {
		$(".horizontalMenu-list li a").each(function() {
			var pageUrl = window.location.href.split(/[?#]/)[0];
			if (this.href == pageUrl) {
				$(this).addClass("active");
				$(this).parent().addClass("active"); // add active to li of the current link
				$(this).parent().parent().prev().addClass("active"); // add active class to an anchor
				$(this).parent().parent().prev().click(); // click the item to make it drop
			}
		});
		$(".horizontal-megamenu li a").each(function() {
			var pageUrl = window.location.href.split(/[?#]/)[0];
			if (this.href == pageUrl) {
				$(this).addClass("active");
				$(this).parent().addClass("active"); // add active to li of the current link
				$(this).parent().parent().parent().parent().parent().parent().parent().prev().addClass("active"); // add active class to an anchor
				$(this).parent().parent().prev().click(); // click the item to make it drop
			}
		});
		$(".horizontalMenu-list .sub-menu .sub-menu li a").each(function() {
			var pageUrl = window.location.href.split(/[?#]/)[0];
			if (this.href == pageUrl) {
				$(this).addClass("active");
				$(this).parent().addClass("active"); // add active to li of the current link
				$(this).parent().parent().parent().parent().prev().addClass("active"); // add active class to an anchor
				$(this).parent().parent().prev().click(); // click the item to make it drop
			}
		});
	});
	
	
	// ______________ Back to Top
	$(window).on("scroll", function(e) {
		if ($(this).scrollTop() > 0) {
			$('#back-to-top').fadeIn('slow');
		} else {
			$('#back-to-top').fadeOut('slow');
		}
	});
	$("#back-to-top").on("click", function(e) {
		$("html, body").animate({
			scrollTop: 0
		}, 600);
		return false;
	});
	
	
		
	// ______________Switcher
	
	
	/*Skin modes*/
	$(document).on("click", '#myonoffswitch7', function () {    
		if (this.checked) {
			$('body').addClass('body-default');
			$('body').removeClass('body-style1');
			localStorage.setItem("body-default", "True");
		}
		else {
			$('body').removeClass('body-default');
			localStorage.setItem("body-default", "false");
		}
	});
	$(document).on("click", '#myonoffswitch6', function () {    
		if (this.checked) {
			$('body').addClass('body-style1');
			$('body').removeClass('body-default');
			localStorage.setItem("body-style1", "True");
		}
		else {
			$('body').removeClass('body-style1');
			localStorage.setItem("body-style1", "false");
		}
	});
	
	/*Horizontal Styles*/
	$(document).on("click", '#myonoffswitch2', function () {    
		if (this.checked) {
			$('body').addClass('horizontal-light');
			$('body').removeClass('horizontal-color');
			$('body').removeClass('horizontal-dark');
			$('body').removeClass('horizontal-gradient');
			localStorage.setItem("horizontal-light", "True");
		}
		else {
			$('body').removeClass('horizontal-light');
			localStorage.setItem("horizontal-light", "false");
		}
	});
	$(document).on("click", '#myonoffswitch3', function () {    
		if (this.checked) {
			$('body').addClass('horizontal-color');
			$('body').removeClass('horizontal-light');
			$('body').removeClass('horizontal-dark');
			$('body').removeClass('horizontal-gradient');
			localStorage.setItem("horizontal-color", "True");
		}
		else {
			$('body').removeClass('horizontal-color');
			localStorage.setItem("horizontal-color", "false");
		}
	});
	$(document).on("click", '#myonoffswitch4', function () {    
		if (this.checked) {
			$('body').addClass('horizontal-dark');
			$('body').removeClass('horizontal-color');
			$('body').removeClass('horizontal-light');
			$('body').removeClass('horizontal-gradient');
			localStorage.setItem("horizontal-dark", "True");
		}
		else {
			$('body').removeClass('horizontal-dark');
			localStorage.setItem("horizontal-dark", "false");
		}
	});
	$(document).on("click", '#myonoffswitch5', function () {    
		if (this.checked) {
			$('body').addClass('horizontal-gradient');
			$('body').removeClass('horizontal-color');
			$('body').removeClass('horizontal-light');
			$('body').removeClass('horizontal-dark');
			localStorage.setItem("horizontal-gradient", "True");
		}
		else {
			$('body').removeClass('horizontal-gradient');
			localStorage.setItem("horizontal-gradient", "false");
		}
	});	
	$(document).on("click", '#myonoffswitch8', function () {    
		if (this.checked) {
			$('body').addClass('reset');
			$('body').removeClass('horizontal-color');
			$('body').removeClass('horizontal-light');
			$('body').removeClass('horizontal-dark');
			$('body').removeClass('horizontal-gradient');
			$('body').removeClass('themestyle');
			localStorage.setItem("reset", "True");
		}
		else {
			$('body').removeClass('reset');
			localStorage.setItem("reset", "false");
		}
	});
	
	/*Leftmenu Styles*/
	$(document).on("click", '#myonoffswitch9', function () {    
		if (this.checked) {
			$('body').addClass('leftmenu-light');
			$('body').removeClass('leftmenu-color');
			$('body').removeClass('leftmenu-dark');
			$('body').removeClass('leftmenu-gradient');
			localStorage.setItem("leftmenu-light", "True");
		}
		else {
			$('body').removeClass('leftmenu-light');
			localStorage.setItem("leftmenu-light", "false");
		}
	});
	$(document).on("click", '#myonoffswitch10', function () {    
		if (this.checked) {
			$('body').addClass('leftmenu-color');
			$('body').removeClass('leftmenu-light');
			$('body').removeClass('leftmenu-dark');
			$('body').removeClass('leftmenu-gradient');
			localStorage.setItem("leftmenu-color", "True");
		}
		else {
			$('body').removeClass('leftmenu-color');
			localStorage.setItem("leftmenu-color", "false");
		}
	});
	$(document).on("click", '#myonoffswitch11', function () {    
		if (this.checked) {
			$('body').addClass('leftmenu-dark');
			$('body').removeClass('leftmenu-color');
			$('body').removeClass('leftmenu-light');
			$('body').removeClass('leftmenu-gradient');
			localStorage.setItem("leftmenu-dark", "True");
		}
		else {
			$('body').removeClass('leftmenu-dark');
			localStorage.setItem("leftmenu-dark", "false");
		}
	});
	$(document).on("click", '#myonoffswitch12', function () {    
		if (this.checked) {
			$('body').addClass('leftmenu-gradient');
			$('body').removeClass('leftmenu-color');
			$('body').removeClass('leftmenu-light');
			$('body').removeClass('leftmenu-dark');
			localStorage.setItem("leftmenu-gradient", "True");
		}
		else {
			$('body').removeClass('leftmenu-gradient');
			localStorage.setItem("leftmenu-gradient", "false");
		}
	});	
	$(document).on("click", '#myonoffswitch13', function () {    
		if (this.checked) {
			$('body').addClass('reset');
			$('body').removeClass('leftmenu-color');
			$('body').removeClass('leftmenu-light');
			$('body').removeClass('leftmenu-dark');
			$('body').removeClass('leftmenu-gradient');
			$('body').removeClass('leftbgimage1');
			$('body').removeClass('leftbgimage2');
			$('body').removeClass('leftbgimage3');
			$('body').removeClass('leftbgimage4');
			$('body').removeClass('leftbgimage5');
			$('body').removeClass('leftbgimage6');
			$('body').removeClass('leftbgimage7');
			$('body').removeClass('leftbgimage8');
			$('body').removeClass('leftbgimage9');
			$('body').removeClass('leftbgimage10');
			$('body').removeClass('body-style1');
			localStorage.setItem("reset", "True");
		}
		else {
			$('body').removeClass('reset');
			localStorage.setItem("reset", "false");
		}
	});
	
	
	
	/*Left-menu-style1*/
	$(document).on("click", '#myonoffswitch16', function () {    
		if (this.checked) {
			$('body').addClass('default-leftmenu');
			$('body').removeClass('style1-leftmenu');
			localStorage.setItem("default-leftmenu", "True");
		}
		else {
			$('body').removeClass('default-leftmenu');
			localStorage.setItem("default-leftmenu", "false");
		}
	});
	$(document).on("click", '#myonoffswitch17', function () {    
		if (this.checked) {
			$('body').addClass('style1-leftmenu');
			$('body').removeClass('default-leftmenu');
			localStorage.setItem("default-leftmenu", "True");
		}
		else {
			$('body').removeClass('style1-leftmenu');
			localStorage.setItem("style1-leftmenu", "false");
		}
	});

	
	/*--- Left-menu Image --*/
	$('#leftmenuimage1').on('click', function() {
	  $('body').removeClass('leftbgimage2');
	  $('body').removeClass('leftbgimage3');
	  $('body').removeClass('leftbgimage4');
	  $('body').removeClass('leftbgimage5');
	  $('body').removeClass('leftbgimage6');
	  $('body').removeClass('leftbgimage7');
	  $('body').removeClass('leftbgimage8');
	  $('body').removeClass('leftbgimage9');
	  $('body').removeClass('leftbgimage10');
	  $('body').addClass('leftbgimage1');
	  return false;
	});
	
	$('#leftmenuimage2').on('click', function() {
	  $('body').removeClass('leftbgimage1');
	  $('body').removeClass('leftbgimage3');
	  $('body').removeClass('leftbgimage4');
	  $('body').removeClass('leftbgimage5');
	  $('body').removeClass('leftbgimage6');
	  $('body').removeClass('leftbgimage7');
	  $('body').removeClass('leftbgimage8');
	  $('body').removeClass('leftbgimage9');
	  $('body').removeClass('leftbgimage10');
	  $('body').addClass('leftbgimage2');
	  return false;
	});
	
	$('#leftmenuimage3').on('click', function() {
	  $('body').removeClass('leftbgimage1');
	  $('body').removeClass('leftbgimage2');
	  $('body').removeClass('leftbgimage4');
	  $('body').removeClass('leftbgimage5');
	  $('body').removeClass('leftbgimage6');
	  $('body').removeClass('leftbgimage7');
	  $('body').removeClass('leftbgimage8');
	  $('body').removeClass('leftbgimage9');
	  $('body').removeClass('leftbgimage10');
	  $('body').addClass('leftbgimage3');
	  return false;
	});
	
	$('#leftmenuimage4').on('click', function() {
	  $('body').removeClass('leftbgimage1');
	  $('body').removeClass('leftbgimage2');
	  $('body').removeClass('leftbgimage3');
	  $('body').removeClass('leftbgimage5');
	  $('body').removeClass('leftbgimage6');
	  $('body').removeClass('leftbgimage7');
	  $('body').removeClass('leftbgimage8');
	  $('body').removeClass('leftbgimage9');
	  $('body').removeClass('leftbgimage10');
	  $('body').addClass('leftbgimage4');
	  return false;
	});
	
	$('#leftmenuimage5').on('click', function() {
	  $('body').removeClass('leftbgimage1');
	  $('body').removeClass('leftbgimage2');
	  $('body').removeClass('leftbgimage3');
	  $('body').removeClass('leftbgimage4');
	  $('body').removeClass('leftbgimage6');
	  $('body').removeClass('leftbgimage7');
	  $('body').removeClass('leftbgimage8');
	  $('body').removeClass('leftbgimage9');
	  $('body').removeClass('leftbgimage10');
	  $('body').addClass('leftbgimage5');
	  return false;
	});
	
	$('#leftmenuimage6').on('click', function() {
	  $('body').removeClass('leftbgimage1');
	  $('body').removeClass('leftbgimage2');
	  $('body').removeClass('leftbgimage3');
	  $('body').removeClass('leftbgimage4');
	  $('body').removeClass('leftbgimage5');
	  $('body').removeClass('leftbgimage7');
	  $('body').removeClass('leftbgimage8');
	  $('body').removeClass('leftbgimage9');
	  $('body').removeClass('leftbgimage10');
	  $('body').addClass('leftbgimage6');
	  return false;
	});
	
	$('#leftmenuimage7').on('click', function() {
	  $('body').removeClass('leftbgimage1');
	  $('body').removeClass('leftbgimage2');
	  $('body').removeClass('leftbgimage3');
	  $('body').removeClass('leftbgimage4');
	  $('body').removeClass('leftbgimage5');
	  $('body').removeClass('leftbgimage6');
	  $('body').removeClass('leftbgimage8');
	  $('body').removeClass('leftbgimage9');
	  $('body').removeClass('leftbgimage10');
	  $('body').addClass('leftbgimage7');
	  return false;
	});
	
	$('#leftmenuimage8').on('click', function() {
	  $('body').removeClass('leftbgimage1');
	  $('body').removeClass('leftbgimage2');
	  $('body').removeClass('leftbgimage3');
	  $('body').removeClass('leftbgimage4');
	  $('body').removeClass('leftbgimage5');
	  $('body').removeClass('leftbgimage6');
	  $('body').removeClass('leftbgimage7');
	  $('body').removeClass('leftbgimage9');
	  $('body').removeClass('leftbgimage10');
	  $('body').addClass('leftbgimage8');
	  return false;
	});
	
	$('#leftmenuimage9').on('click', function() {
	  $('body').removeClass('leftbgimage1');
	  $('body').removeClass('leftbgimage2');
	  $('body').removeClass('leftbgimage3');
	  $('body').removeClass('leftbgimage4');
	  $('body').removeClass('leftbgimage5');
	  $('body').removeClass('leftbgimage6');
	  $('body').removeClass('leftbgimage7');
	  $('body').removeClass('leftbgimage8');
	  $('body').removeClass('leftbgimage10');
	  $('body').addClass('leftbgimage9');
	  return false;
	});
	
	$('#leftmenuimage10').on('click', function() {
	  $('body').removeClass('leftbgimage1');
	  $('body').removeClass('leftbgimage2');
	  $('body').removeClass('leftbgimage3');
	  $('body').removeClass('leftbgimage4');
	  $('body').removeClass('leftbgimage5');
	  $('body').removeClass('leftbgimage6');
	  $('body').removeClass('leftbgimage7');
	  $('body').removeClass('leftbgimage8');
	  $('body').removeClass('leftbgimage9');
	  $('body').addClass('leftbgimage10');
	  return false;
	});
	
	
	
});
	