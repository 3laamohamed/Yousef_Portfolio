@php
  $title = 'Social';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
  <h2 class="title">Social</h2>
  <div class="row mt-3">
    <div class="col-md-6 offset-md-3">
      <div class="mb-3">
        @csrf
        <label for="facebook" class="form-label">Facebook</label>
        @if(isset($social->facebook))
        <input type="text" value='{{$social->facebook}}' class="form-control" id="facebook" placeholder="https://www.facebook.com/userName" required>
        @else
        <input type="text" class="form-control" id="facebook" placeholder="https://www.facebook.com/userName" required>
        @endif
      </div>
      <div class="mb-3">
        <label for="gmail" class="form-label">Gmail</label>
        @if(isset($social->gmail))
        <input type="text" value='{{$social->gmail}}' class="form-control" id="gmail" placeholder="Example123@gmail.com">
        @else
        <input type="text" class="form-control" id="gmail" placeholder="Example123@gmail.com">
        @endif
      </div>
      <div class="mb-3">
        <label for="linked_in" class="form-label">Linked in</label>
        @if(isset($social->linkedin))
        <input type="text" value='{{$social->linkedin}}' class="form-control" id="linked_in" placeholder="https://www.linkedin.com/in/userName">
        @else
        <input type="text" class="form-control" id="linked_in" placeholder="https://www.linkedin.com/in/userName">
        @endif
      </div>
      <div class="mb-3">
        <label for="whatsapp" class="form-label">whatsapp</label>
        @if(isset($social->whats))
        <input type="text" value='{{$social->whats}}' class="form-control" id="whatsapp" placeholder="+201000000000">
        @else
        <input type="text" class="form-control" id="whatsapp" placeholder="+201000000000">
        @endif
      </div>
      <div class="mb-3">
        <label for="twitter" class="form-label">twitter</label>
        @if(isset($social->twitter))
        <input type="text" value='{{$social->twitter}}' class="form-control" id="twitter" placeholder="https://www.twitter.com/userName">
        @else
        <input type="text" class="form-control" id="twitter" placeholder="https://www.twitter.com/userName">
        @endif
      </div>
      <div class="d-grid gap-2 col-6 mx-auto">
        <button class="btn btn-success clicked" id="save_social" type="button">Save</button>
      </div>
    </div>
  </div>
</div>
<script>
  let _token = $('input[name="_token"]').val();
  $('#save_social').on('click', function() {
    let facebook  =$('#facebook').val();
    let gmail     =$('#gmail').val();
    let linked_in =$('#linked_in').val();
    let whatsapp  =$('#whatsapp').val();
    let twitter   =$('#twitter').val();
    $.ajax({
        url     :"{{route('admin.save.social')}}",
        method  : 'post',
        enctype : "multipart/form-data",
        data:
        {
          _token,
          facebook,
          gmail,
          linked_in,
          whatsapp,
          twitter,
          
        },
        success: function (data)
        {
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
