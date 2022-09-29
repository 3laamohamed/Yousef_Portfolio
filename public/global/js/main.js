"use strict";
$(window).on("load", function () {
  $(".loading").fadeOut(), $("body").css("overflow", "auto");
});
$(document).ready(function () {
  function a() {
    10 < window.scrollY
      ? b && ($("nav.navbar").addClass("fixed-top nav-fixed"), (b = !1))
      : ($("nav.navbar").removeClass("fixed-top nav-fixed"), (b = !0));
  }
  let b = !0;
  $(".navbar-nav .nav-link").on("click", function () {
    $(this)
      .addClass("active")
      .parent()
      .siblings()
      .find(".nav-link")
      .removeClass("active"),
      $("#close-nav").click();
  }),
    $(window).on("scroll", function () {
      a(),
        $(".check-scroll").each(function () {
          if ($(window).scrollTop() >= $(this).offset().top - 75) {
            let a = $(this).attr("id");
            $(`.navbar-nav .nav-link[data-scroll="${a}"]`)
              .addClass("active")
              .parent()
              .siblings()
              .find(".nav-link")
              .removeClass("active");
          }
        });
    }),
    a();
  const c = $(".navbar-collapse");
  $("#open-nav").on("click", function () {
    c.addClass("open");
  }),
    $("#close-nav").on("click", function () {
      c.removeClass("open");
    }),
    $(window).on("scroll", function () {
      500 < window.scrollY
        ? $("button.up").addClass("show")
        : $("button.up").removeClass("show");
    }),
    $("button.up").on("click", function () {
      $(window).scrollTop({ top: 0, behavior: "smooth" });
    }),
    $(".category").on("click", function () {
      $(this).addClass("active").siblings().removeClass("active");
      let a = $(this).attr("data-filter");
      "all" == a
        ? $(".cards").show(500)
        : ($(".cards")
            .not("." + a)
            .hide(400),
          $(".cards")
            .filter("." + a)
            .show(500));
    });
  let owl = $(".services-carousel");
  owl.owlCarousel({
    nav: !0,
    loop: !0,
    margin: 10,
    autoplay: !0,
    autoplayTimeout: 2e3,
    autoplayHoverPause: !0,
    responsive: {
      0: { items: 1 },
      576: { items: 2 },
      768: { items: 3 },
      992: { items: 4 },
    },
  });
});
