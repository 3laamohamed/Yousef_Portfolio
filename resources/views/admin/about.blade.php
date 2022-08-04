@php
    $title = 'About';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
  <h2 class="title">About<h2>
  <div class="row mt-5">
    <div class="col-md-10 offset-md-1">
    <form id="form_save_item" action=" " method="POST" multiple enctype="multipart/form-data">
      @csrf
      <div class="row">
       <div class="col-md-6">
          <div class="mb-3">
              @csrf
              <label for="brand_name" class="form-label">Brand Name</label>
              <?php
                 $name = '';
                 $disc = '';
                 $image = '';
                if(isset($data[0]->name)){$name = $data[0]->name;}
                if(isset($data[0]->disc)){$name = $data[0]->disc;}
                if(isset($data[0]->image)){$name = $data[0]->image;}
              ?>
              <input type="text" value='{{$name}}' class="form-control" name='brand' id="brand_name" placeholder="Please Enter Brand Name">
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="group_name" class="form-label">Discibtion</label>
            <textarea class="form-control mt-3" name='disc' placeholder="Write Your Discribtion" id="discribtion" style="min-height: 250px;height: 250px">{{$disc}}</textarea>
          </div>
        </div>
        <div class="col-md-6">
          <!-- Upload Image -->
          <div class='text-center'>
            <i class="file-image">
              <input autocomplete="off" id="image" name="image" type="file" onchange="readImage(this)" title="" />
              <i class="reset" onclick="resetImage(this.previousElementSibling)"></i>
              <div id='item-image'>
                <label for="image" class="image" data-label="Add Image"></label>
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
          success: function (data)
          {

          }
        });
    });
</script>
@stop
