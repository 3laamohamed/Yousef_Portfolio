"use strict";

$(document).ready(function () {
  // ==================== Start Loader =====================
  $(window).on("load", function () {
    $(".loading").fadeOut();
    $("body").css("overflow", "auto");
  });
  // ==================== End Loader =====================

  // ==================== Start Navbar =====================
  let fixed = true;

  $(".navbar-nav .nav-link").on("click", function () {
    $(this)
      .addClass("active")
      .parent()
      .siblings()
      .find(".nav-link")
      .removeClass("active");
  });

  function getScroll() {
    if (window.scrollY > 10) {
      if (fixed) {
        $("nav.navbar").addClass("fixed-top nav-fixed");
        fixed = false;
      }
    } else {
      $("nav.navbar").removeClass("fixed-top nav-fixed");
      fixed = true;
    }
  }

  $(window).on("scroll", function () {
    getScroll();

    $(".check-scroll").each(function () {
      if ($(window).scrollTop() >= $(this).offset().top - 75) {
        let mySection = $(this).attr("id");
        $(`.navbar-nav .nav-link[data-scroll="${mySection}"]`)
          .addClass("active")
          .parent()
          .siblings()
          .find(".nav-link")
          .removeClass("active");
      }
    });
  });
  getScroll();
  // ==================== End Navbar =====================

  // ==================== Start Button Up  =====================
  $(window).on("scroll", function () {
    if (window.scrollY > 500) {
      $("button.up").addClass("show");
    } else {
      $("button.up").removeClass("show");
    }
  });
  $("button.up").on("click", function () {
    $(window).scrollTop({
      top: 0,
      behavior: "smooth",
    });
  });
  // ==================== End Button Up  =====================

  // ==================== Start Filter =====================
  $(".category").on("click", function () {
    $(this).addClass("active").siblings().removeClass("active");

    let filter = $(this).attr("data-filter");

    if (filter == "all") {
      $(".cards").show(500);
    } else {
      $(".cards")
        .not("." + filter)
        .hide(400);
      $(".cards")
        .filter("." + filter)
        .show(500);
    }
  });
  // ==================== End Filter =====================

  // ==================== Start Services Carsoual =====================
  let carouselWidth = $(".services .carousel-inner")[0].scrollWidth;
  let cardWidth = $(".services .carousel-item").width();
  let scrollPosition = 0;

  $(".services .carousel-control-next").on("click", function () {
    if (scrollPosition < carouselWidth - cardWidth * 4) {
      //check if you can go any further
      scrollPosition += cardWidth; //update scroll position
      $(".services .carousel-inner").animate(
        { scrollLeft: scrollPosition },
        600
      ); //scroll left
    }
  });
  $(".services .carousel-control-prev").on("click", function () {
    if (scrollPosition > 0) {
      scrollPosition -= cardWidth;
      $(".services .carousel-inner").animate(
        { scrollLeft: scrollPosition },
        600
      );
    }
  });
  let multipleCardCarousel = document.querySelector("#servicesCarousel");

  if (window.matchMedia("(min-width: 768px)").matches) {
    //rest of the code
    let carousel = new bootstrap.Carousel(multipleCardCarousel, {
      interval: false,
    });
  } else {
    $(multipleCardCarousel).addClass("slide");
    $(".services .carousel-item").first().addClass("active");
  }
  // ==================== End Services Carsoual =====================
});
