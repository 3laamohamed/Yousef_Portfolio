"use strict";

$(document).ready(function () {
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
    if (window.scrollY > 50) {
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

  lightGallery(document.getElementById("lightgallery"));
});


