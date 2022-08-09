"use strict";

// Create One More Image
// function createAlbum(
//   input,
//   parent = document.querySelector(".album-container")
// ) {
//   if (input.files.length >= 1 && input.files) {
//     if (window.File && window.FileReader && window.FileList && window.Blob) {
//       const files = input.files; //FILE LIST OBJECT CONTAINING UPLOADED FILES
//       for (let i = 0; i < files.length; i++) {
//         if (!files[i].type.match("image") && !files[i].type.match("video"))
//           continue;
//         const picReader = new FileReader(); // RETRIEVE DATA URI
//         picReader.addEventListener("load", function (event) {
//           // LOAD EVENT FOR DISPLAYING PHOTOS
//           if (files[i].type.match("image")) {
//             let image = `<img src="${event.target.result}"/>`;
//             parent.innerHTML += image;
//           }
//         });
//         picReader.readAsDataURL(files[i]); //READ THE IMAGE
//       }
//     }
//   }
// }

function previewImages(input, preview) {
  preview.innerHTML = "";
  if (input.files) {
    [].forEach.call(input.files, readAndPreview);
  }
  function readAndPreview(file) {
    // Make sure `file.name` matches our extensions criteria
    if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
      return alert(file.name + " is not an image");
    } // else...
    let reader = new FileReader();
    reader.addEventListener("load", function () {
      let image = new Image();
      image.height = 150;
      image.width = 150;
      image.title = file.name;
      image.src = this.result;
      preview.appendChild(image);
    });
    reader.readAsDataURL(file);
  }
}

// function deleteImage(img) {
//   img.parentElement.remove();
//   console.log(document.getElementById("album").files);
// }

// Create One Image
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
