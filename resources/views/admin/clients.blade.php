@php
    $title = 'Client';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
  <h2 class="title">Client</h2>
  <div class="row mt-3">
    <div class="col-md-6 offset-md-3">
      <form id="form_save_client" action=" " method="POST" multiple enctype="multipart/form-data"class="mb-3">
        <!-- Upload Image -->
          <div class='text-center'>
            <i class="file-image">
              <input autocomplete="off" id="client" name="client" type="file" onchange="readImage(this)" title="" required />
              <i class="reset" onclick="resetImage(this.previousElementSibling)"></i>
              <div id='item-image'>
                <label for="client" class="image" data-label="Add Image"></label>
              </div>
            </i>
          </div>
      </form>
      <div class="d-grid gap-2 col-6 mx-auto">
        <button class="btn btn-success clicked" id="save_client" type="button">Save</button>
        <button class="btn btn-primary clicked d-none" id="update_client" type="button">Update</button>
      </div>
        <table class="table mt-4 text-center shadow-lg">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Client Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <tr id="1">
                    <td>1</td>
                    <td> <img width="200" src="{{asset('Admin/projects/165971974965.png')}}" alt=""> </td>
                    <td>
                      <button class="table-buttons" id='delete_client'>
                        <ion-icon class="text-danger" name="trash-outline"></ion-icon>
                      </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
  </div>
</div>
<script>
  $('#save_client').on('click', function() {
    let formData = new FormData($('#form_save_client')[0]);
    $.ajax({
      url:"{{route('admin.save.about')}}",
      method:'post',
      enctype:"multipart/form-data",
      processData:false,
      cache : false,
      contentType:false,
      'data' : formData,
      success: function (data) {
      }
    });
  });
  $('body').on('click','#delete_client', function () {
    let _token = $('input[name="_token"]').val();
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't delete this Client",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: 'e#d33',
      confirmButtonText: 'Yes, dlete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
            url     :"{{route('admin.delete.contact')}}",
            method  : 'post',
            enctype : "multipart/form-data",
            data:
            {
              _token,
            },
            success: function (data) {
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
