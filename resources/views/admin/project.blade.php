@php
    $title = 'Project';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
    {{-- <div class="d-none" id='counter_group' value='{{$counter}}'></div> --}}
    <h2 class="title">Projects</h2>
    <div class="row mt-5">
        <div class="col-md-10 offset-md-1">
            <form  id="project_form" action=" " method="POST" multiple enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                      @csrf
                      <label for="project_name" class="form-label">Project Name</label>
                      <input type="text" class="form-control" name="label" id="project_name" placeholder="Please Enter Project Name" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="group" class="form-label">Select Group</label>
                  <select class="form-select" id='group' name="group" required>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="Discibtion" class="form-label">Discibtion</label>
                    <textarea class="form-control mt-3" name='disc' placeholder="Write Your Discribtion" id="discribtion" required style="min-height: 250px;height: 250px"></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <!-- Upload Image -->
                  <div class='text-center'>
                    <i class="file-image">
                      <input autocomplete="off" id="image" name="thumbnail" type="file" onchange="readImage(this)" title="" required />
                      <i class="reset" onclick="resetImage(this.previousElementSibling)"></i>
                      <div id='item-image'>
                        <label for="image" class="image" data-label="Add thumbnail"></label>
                      </div>
                    </i>
                  </div>
                </div>
                <hr>
                <div id="album_container" class="d-flex flex-wrap" style="gap: 10px">
                  <!-- Upload Image -->
                  <div class='text-center'>
                    <i class="file-image m-0">
                      <input multiple autocomplete="off" id="album" type="file" onchange="createAlbum(this, document.getElementById('album_container'))" title="" />
                      <i class="reset" onclick="resetImage(this.previousElementSibling)"></i>
                      <div id='item-image'>
                        <label for="album" class="image" data-label="Add Album"></label>
                      </div>
                    </i>
                  </div>
                </div>
              </div>
            </form>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-success clicked" id="save_project" type="button">Save</button>
            </div>
            <table class="table mt-4 text-center shadow-lg">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Group Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-light">
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
  $('#save_project').on('click', function(e) {
    e.preventDefault();
    let formData      = new FormData($('#project_form')[0]);
        $.ajax({
          url:"{{route('admin.save.project')}}",
          method:'post',
          enctype:"multipart/form-data",
          processData:false,
          cache : false,
          contentType:false,
          'data' : formData,
          success: function (data)
          {
            console.log(data)
          }
        });
  });
</script>
@stop
