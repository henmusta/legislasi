/*-----------------------------------------------------------------------------------

    Theme Name: Fabrex - Onepage Agency HTML Template
    Description: Onepage Agency HTML Template
    Author: Chitrakoot Web
    
    ---------------------------------- */    

$(function(){"use strict";var n=$(window);$("#preloader").fadeOut("normall",function(){$(this).remove()}),$.scrollIt({upKey:38,downKey:40,easing:"swing",scrollTime:600,activeClass:"active",onPageChange:null,topOffset:-70}),n.on("scroll",function(){600<n.width()&&(600<n.scrollTop()?$("#back-to-top").addClass("reveal"):$("#back-to-top").removeClass("reveal"))}),$("#back-to-top").on("click",function(){return $("html, body").animate({scrollTop:0},1e3),!1}),$("#sidebar_toggle").length&&($("body").addClass("sidebar-menu"),$("#sidebar_toggle").on("click",function(){$(".sidebar-menu").toggleClass("active"),$(".side-menu").addClass("side-menu-active"),$("#close_sidebar").fadeIn(700)}),$("#close_sidebar").on("click",function(){$(".side-menu").removeClass("side-menu-active"),$(this).fadeOut(200),$(".sidebar-menu").removeClass("active")}),$("#btn_sidebar_colse").on("click",function(){$(".side-menu").removeClass("side-menu-active"),$("#close_sidebar").fadeOut(200),$(".sidebar-menu").removeClass("active")})),n.on("scroll",function(){var a=n.scrollTop(),e=$(".navbar"),o=$(".blog-nav .logo> img"),l=$(".bg-black .logo> img"),s=$(".navbar .logo> img");100<a?(e.addClass("nav-scroll"),s.attr("src","img/logo-dark.png"),l.attr("src","img/logo-light.png")):(e.removeClass("nav-scroll"),s.attr("src","img/logo-light.png"),o.attr("src","img/logo-dark.png"))}),n.width()<=991&&$(".navbar-nav .nav-link").on("click",function(){$(".navbar-collapse.show").removeClass("show"),$(".navbar .navbar-toggler").addClass("collapsed")}),$(".bg-img, section, footer").each(function(a){$(this).attr("data-background")&&$(this).css("background-image","url("+$(this).data("background")+")")}),$(".countup").counterUp({delay:25,time:2e3}),$(window).on("load",function(){var a=$(window);n.stellar(),$(".portfolio-gallery").lightGallery(),a.stellar()}),$(".current-year").text((new Date).getFullYear())});