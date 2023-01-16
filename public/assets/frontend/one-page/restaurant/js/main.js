/*-----------------------------------------------------------------------------------

    Theme Name: Fabrex - Restaurant and Cafe HTML Template
    Description: Onepage Restaurant and Cafe HTML Template
    Author: Chitrakoot Web
    
    ---------------------------------- */    

$(function(){"use strict";var l=$(window);function a(){var e,a;e=$(".full-screen"),a=$(window).height(),e.css("min-height",a)}$("#preloader").fadeOut("normall",function(){$(this).remove()}),$.scrollIt({upKey:38,downKey:40,easing:"swing",scrollTime:600,activeClass:"active",onPageChange:null,topOffset:-70}),l.on("scroll",function(){600<l.width()&&(600<l.scrollTop()?$("#back-to-top").addClass("reveal"):$("#back-to-top").removeClass("reveal"))}),$("#back-to-top").on("click",function(){return $("html, body").animate({scrollTop:0},1e3),!1}),$("#sidebar_toggle").length&&($("body").addClass("sidebar-menu"),$("#sidebar_toggle").on("click",function(){$(".sidebar-menu").toggleClass("active"),$(".side-menu").addClass("side-menu-active"),$("#close_sidebar").fadeIn(700)}),$("#close_sidebar").on("click",function(){$(".side-menu").removeClass("side-menu-active"),$(this).fadeOut(200),$(".sidebar-menu").removeClass("active")}),$("#btn_sidebar_colse").on("click",function(){$(".side-menu").removeClass("side-menu-active"),$("#close_sidebar").fadeOut(200),$(".sidebar-menu").removeClass("active")})),l.on("scroll",function(){var e=l.scrollTop(),a=$(".navbar"),o=$(".blog-nav .logo> img"),t=$(".bg-black .logo> img"),i=$(".navbar .logo> img");100<e?(a.addClass("nav-scroll"),i.attr("src","img/logo-dark.png"),t.attr("src","img/logo-light.png")):(a.removeClass("nav-scroll"),i.attr("src","img/logo-light.png"),o.attr("src","img/logo-dark.png"))}),l.width()<=991&&$(".navbar-nav .nav-link").on("click",function(){$(".navbar-collapse.show").removeClass("show"),$(".navbar .navbar-toggler").addClass("collapsed")}),$(".bg-img, section, footer").each(function(e){$(this).attr("data-background")&&$(this).css("background-image","url("+$(this).data("background")+")")}),new WOW({boxClass:"wow",animateClass:"animated",offset:0,mobile:!1,live:!0}).init(),$(".gallery").magnificPopup({delegate:".popimg",type:"image",gallery:{enabled:!0}}),$(".story-video").magnificPopup({delegate:".video",type:"iframe"}),$(".form_date").datetimepicker({language:"en",weekStart:1,todayBtn:1,autoclose:1,todayHighlight:1,startView:2,minView:2,forceParse:0}),$(".form_time").datetimepicker({language:"en",weekStart:1,todayBtn:1,autoclose:1,todayHighlight:1,startView:1,minView:0,maxView:1,forceParse:0}),0!==$(".horizontaltab").length&&$(".horizontaltab").easyResponsiveTabs({type:"default",width:"auto",fit:!0,tabidentify:"hor_1",activate:function(e){var a=$(this),o=$("#nested-tabInfo");$("span",o).text(a.text()),o.show()}}),$(window).on("load",function(){$(window).stellar(),$(".portfolio-gallery").lightGallery()}),$(window).resize(function(e){setTimeout(function(){a()},500),e.preventDefault()}),a(),$(document).ready(function(){var e=$(".header .owl-carousel");$(".slider-fade .owl-carousel").owlCarousel({items:1,loop:!0,margin:0,autoplay:!0,smartSpeed:500,mouseDrag:!1,animateIn:"fadeIn",animateOut:"fadeOut"}),$(".delicious-menu .owl-carousel").owlCarousel({items:1,loop:!0,margin:0,autoplay:!0,smartSpeed:500}),$(".chef-section .owl-carousel").owlCarousel({items:3,loop:!0,margin:30,autoplay:!1,dots:!1,smartSpeed:500,responsive:{0:{items:1,autoplay:!0,margin:10},768:{items:2,autoplay:!0,margin:15},992:{items:3,margin:15}}}),$(".testimonials .owl-carousel").owlCarousel({items:1,loop:!0,margin:0,autoplay:!0,smartSpeed:500}),$(".owl-carousel").owlCarousel({items:1,loop:!0,margin:0,autoplay:!0,smartSpeed:500}),$(".slider .owl-carousel").owlCarousel({items:1,loop:!0,margin:0,mouseDrag:!1,autoplay:!0,smartSpeed:500}),e.on("changed.owl.carousel",function(e){e=e.item.index-2;$("h3").removeClass("animated fadeInUp"),$("h1").removeClass("animated fadeInUp"),$("p").removeClass("animated fadeInUp"),$(".btn").removeClass("animated fadeInUp"),$(".owl-item").not(".cloned").eq(e).find("h3").addClass("animated fadeInUp"),$(".owl-item").not(".cloned").eq(e).find("h1").addClass("animated fadeInUp"),$(".owl-item").not(".cloned").eq(e).find("p").addClass("animated fadeInUp"),$(".owl-item").not(".cloned").eq(e).find(".btn").addClass("animated fadeInUp")})}),$(".current-year").text((new Date).getFullYear())});