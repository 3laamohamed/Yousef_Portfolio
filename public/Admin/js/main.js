"use strict";
function previewImages(a, b) {
  (b.innerHTML = ""),
    a.files &&
      [].forEach.call(a.files, function (a) {
        if (!/\.(jpe?g|png|gif)$/i.test(a.name))
          return alert(a.name + " is not an image");
        let c = new FileReader();
        c.addEventListener("load", function () {
          let c = new Image();
          (c.height = 150),
            (c.width = 150),
            (c.title = a.name),
            (c.src = this.result),
            b.appendChild(c);
        }),
          c.readAsDataURL(a);
      });
}
function readImage(a) {
  var b = a.nextElementSibling.nextElementSibling.firstElementChild;
  if (a.files && a.files[0]) {
    a.setAttribute("title", a.value.replace(/^.*[\\/]/, ""));
    var c = new FileReader();
    (c.onload = function (a) {
      b.style.backgroundImage = `url("${a.target.result}")`;
    }),
      c.readAsDataURL(a.files[0]);
  }
  b.classList.add("unvisibile");
}
function resetImage(a) {
  var b = a.nextElementSibling.nextElementSibling.firstElementChild;
  (a.value = ""),
    a.onchange(),
    a.setAttribute("title", ""),
    b.classList.remove("unvisibile"),
    (b.style.backgroundImage = "none");
}
