"use strict";$(document).ready(function(){function a(){10<window.scrollY?b&&($("nav.navbar").addClass("fixed-top nav-fixed"),b=!1):($("nav.navbar").removeClass("fixed-top nav-fixed"),b=!0)}$(window).on("load",function(){$(".loading").fadeOut(),$("body").css("overflow","auto")});let b=!0;$(".navbar-nav .nav-link").on("click",function(){$(this).addClass("active").parent().siblings().find(".nav-link").removeClass("active"),$("#close-nav").click()}),$(window).on("scroll",function(){a(),$(".check-scroll").each(function(){if($(window).scrollTop()>=$(this).offset().top-75){let a=$(this).attr("id");$(`.navbar-nav .nav-link[data-scroll="${a}"]`).addClass("active").parent().siblings().find(".nav-link").removeClass("active")}})}),a();const c=$(".navbar-collapse");$("#open-nav").on("click",function(){c.addClass("open")}),$("#close-nav").on("click",function(){c.removeClass("open")}),$(window).on("scroll",function(){500<window.scrollY?$("button.up").addClass("show"):$("button.up").removeClass("show")}),$("button.up").on("click",function(){$(window).scrollTop({top:0,behavior:"smooth"})}),$(".category").on("click",function(){$(this).addClass("active").siblings().removeClass("active");let a=$(this).attr("data-filter");"all"==a?$(".cards").show(500):($(".cards").not("."+a).hide(400),$(".cards").filter("."+a).show(500))});let d=$(".services .carousel-inner")[0].scrollWidth,e=$(".services .carousel-item").width(),f=0;$(".services .carousel-control-next").on("click",function(){f<d-4*e&&(f+=e,$(".services .carousel-inner").animate({scrollLeft:f},600))}),$(".services .carousel-control-prev").on("click",function(){0<f&&(f-=e,$(".services .carousel-inner").animate({scrollLeft:f},600))});let g=document.querySelector("#servicesCarousel");if(window.matchMedia("(min-width: 768px)").matches){new bootstrap.Carousel(g,{interval:!1})}else $(g).addClass("slide"),$(".services .carousel-item").first().addClass("active")});