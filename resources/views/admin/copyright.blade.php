@php
    $title = 'CopyRight';
@endphp

@extends('layouts.app')
@section('content')
  <div class="container">
      <h2 class="title">CopyRight<h2>
      <div class="row mt-3">
          <div class="col-md-6 offset-md-3">
          <?php
                $name = '';
                if(isset($data[0]->name)){$name = $data[0]->name;}
              ?>
              <div class="mb-3">
                  <label for="group_name" class="form-label">Copyright Message</label>
                  <textarea class="form-control mt-3" placeholder="Write Your Message" id="copy_right" style="height: 200px">{{$name}}</textarea>
              </div>
              <div class="d-grid gap-2 col-6 mx-auto">
                  <button class="btn btn-success clicked" id="save_copy_right" type="button">Save</button>
              </div>
          </div>
      </div>
  </div>
  <script>
    let _token           = $('input[name="_token"]').val();
    $('#save_copy_right').on('click', function() {
        let copy =$('#copy_right').val();
        $.ajax({
            url     :"{{route('admin.save.copyright')}}",
            method  : 'post',
            enctype : "multipart/form-data",
            data:
            {
              _token,
              copy,
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
