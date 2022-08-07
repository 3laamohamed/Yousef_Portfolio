@php
    $title = 'About';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
  <h2 class="title">About<h2>
  <div class="row mt-3">
    <div class="col-md-10 offset-md-1">
    <form id="form_save_item" action=" " method="POST" multiple enctype="multipart/form-data">
      @csrf
      <div class="row align-items-start about">
        <div class="col-md-6">
          <div class="mb-3">
              @csrf
              <label for="brand_name" class="form-label">Brand Name</label>
              @if(isset($data->name))
              <input type="text" value='{{$data->name}}' class="form-control" name='brand' id="brand_name" placeholder="Please Enter Brand Name">
              @else
              <input type="text"  class="form-control" name='brand' id="brand_name" placeholder="Please Enter Brand Name">
              @endif
          </div>
          <div class="mb-3">
            <label for="group_name" class="form-label">description</label>
            @if(isset($data->disc))
            <textarea class="form-control mt-3" name='disc' placeholder="Write Your Discribtion" id="discribtion" style="min-height: 250px;height: 250px">{{$data->disc}}</textarea>
            @else
            <textarea class="form-control mt-3" name='disc' placeholder="Write Your Discribtion" id="discribtion" style="min-height: 250px;height: 250px"></textarea>
            @endif
          </div>
        </div>
        <div class="col-md-6">
          <!-- Upload Image -->
          <div class='text-center'>
            <i class="file-image">
              <input autocomplete="off" id="image" name="image" type="file" onchange="readImage(this)" title="{{$data->image}}" />
              <i class="reset" onclick="resetImage(this.previousElementSibling)"></i>
              <div id='item-image'>
                @if(isset($data->image))
                <label for="image" class="image unvisibile"  data-label="Add Image" style="background-image: url({{ URL::asset('Admin/About/' . $data->image) }})"></label>
                @else
                <label for="image" class="image"  data-label="Add Image"></label>
                @endif
              </div>
            </i>
          </div>
        </div>
      </div>
    </form>
      <div class="d-grid gap-2 col-6 mx-auto mt-4">
        <button class="btn btn-success clicked" id="save_copy_right" type="button">Save</button>
      </div>
    </div>
  </div>
</div>
<script>
    // let _token           = $('input[name="_token"]').val();
    $('#save_copy_right').on('click', function() {
      let formData      = new FormData($('#form_save_item')[0]);
      $.ajax({
        url:"{{route('admin.save.about')}}",
        method:'post',
        enctype:"multipart/form-data",
        processData:false,
        cache : false,
        contentType:false,
        'data' : formData,
        success: function (data) {
          if(data.status == 'true'){
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: data.msg,
                showConfirmButton: false,
                timer: 1500
              })
          }
        }
      });
    });
</script>
@stop
