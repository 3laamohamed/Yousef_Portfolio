"use strict";
function createAlbum(input, parent) {
  if (input.files.length >= 1 && input.files) {
    if (window.File && window.FileReader && window.FileList && window.Blob) {
      //CHECK IF FILE API IS SUPPORTED
      const files = input.files; //FILE LIST OBJECT CONTAINING UPLOADED FILES
      input.previousElementSibling.value = files.length
      // console.log(input.previousElementSibling)
      for (let i = 0; i < files.length; i++) {
        // LOOP THROUGH THE FILE LIST OBJECT

        if (!files[i].type.match("image") && !files[i].type.match("video"))
          continue; // ONLY PHOTOS (SKIP CURRENT ITERATION IF NOT A PHOTO)
        const picReader = new FileReader(); // RETRIEVE DATA URI
        picReader.addEventListener("load", function (event) {
          // LOAD EVENT FOR DISPLAYING PHOTOS
          const picFile = event.target;
          if (files[i].type.match("image")) {
            let image = `<div class='text-center'>
                            <i class="file-image">
                              <input autocomplete="off" id="image${i}" name="image[]" type="file""
                                title="${files[i].name}" />
                              <i class="reset" onclick="deleteImage(this.previousElementSibling)"></i>
                              <div id='item-image'>
                                <label for="image${i}" style='background-image: url("${picFile.result}' class="image unvisibile" data-label="Add Image"></label>
                              </div>
                            </i>
                          </div>
              `;
            parent.innerHTML += image;
          } else {
            let video = `<video controls="controls" src=" ${picFile.result} " type="video/mp4" width="400px" height="200px"></video>`;
            parent.innerHTML += video;
          }
        });
        picReader.readAsDataURL(files[i]); //READ THE IMAGE
      }
    }
  }
}

function deleteImage(input) {
  var receiver = input.nextElementSibling.nextElementSibling.firstElementChild;
  input.value = "";
  // input.onchange();
  receiver.parentElement.parentElement.remove();
}

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
