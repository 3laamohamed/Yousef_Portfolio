@php
    $title = 'Services';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
  <h2 class="title">Services<h2>
  <div class="row mt-3">
    <div class="col-md-10 offset-md-1">
    <form id="form_save_service" action=" " method="POST" multiple enctype="multipart/form-data">
      @csrf
      <div class="row align-items-start about">
        <div class="col-md-6">
          <div class="mb-3">
              <label for="brand_name" class="form-label">Service Name</label>
              <input type="text"  class="form-control" name='name' id="name" placeholder="Please Enter Brand Name">
          </div>
          <div class="mb-3">
            <label for="group_name" class="form-label">description</label>
            <textarea class="form-control mt-3" name='disc' placeholder="Write Your Discribtion" id="discribtion" style="min-height: 250px;height: 250px"></textarea>
          </div>
        </div>
        <div class="col-md-6">
          <!-- Upload Image -->
          <div class='text-center'>
            <i class="file-image">
              <input autocomplete="off" id="image" name="image" type="file" onchange="readImage(this)" title="" />
              <i class="reset" onclick="resetImage(this.previousElementSibling)"></i>
              <div id='item-image'>
                <label for="image" class="image"  data-label="Add Image"></label>
              </div>
            </i>
          </div>
        </div>
      </div>
    </form>
      <div class="d-grid gap-2 col-6 mx-auto mt-4">
        <button class="btn btn-success clicked" id="save_service" type="button">Save</button>
      </div>
      <table class="table mt-4 text-center shadow-lg">
        <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Service</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-light">
                @foreach($services as $service)
                <tr id="{{$service->id}}">
                    <td>{{$service->id}}</td>
                    <td>{{$service->title}}</td>
                    <td>
                        <button class="table-buttons" id='delete_service'>
                            <ion-icon class="text-danger" name="trash-outline"></ion-icon>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
</div>
<script>
      $('#save_service').on('click', function() {
    let formData = new FormData($('#form_save_service')[0]);
    $.ajax({
      url:"{{route('admin.save.service')}}",
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
                title: 'Saved Service',
                showConfirmButton: false,
                timer: 1500
              })
          }
      }
    });
  });
  $('body').on('click','#delete_service', function () {
    let _token = $('input[name="_token"]').val();
    let service = $(this).parents('tr').attr('id');

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't delete this service",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: 'e#d33',
      confirmButtonText: 'Yes, dlete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
            url     :"{{route('admin.delete.service')}}",
            method  : 'post',
            enctype : "multipart/form-data",
            data:
            {
              _token,
              service,
            },
            success: function (data) {
              $(`tr#${service}`).remove();
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: data.msg,
                showConfirmButton: false,
                timer: 1500
              })
            }
        });
      }
    });
  });
</script>
@stop