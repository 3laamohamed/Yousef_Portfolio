"use strict";
function readImage(input) {
  var receiver = input.nextElementSibling.nextElementSibling.firstElementChild;
  if (input.files && input.files[0]) {
    input.setAttribute("title", input.value.replace(/^.*[\\/]/, ""));
    var reader = new FileReader();
    reader.onload = function (e) {
      receiver.style.backgroundImage = `url("${e.target.result}")`;
    };
    reader.readAsDataURL(input.files[0]);
  }
  receiver.classList.add("unvisibile");
}

function resetImage(input) {
  var receiver = input.nextElementSibling.nextElementSibling.firstElementChild;
  input.value = "";
  input.onchange();
  input.setAttribute("title", "");
  receiver.classList.remove("unvisibile");
  receiver.style.backgroundImage = "none";
}
