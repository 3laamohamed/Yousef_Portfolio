@php
    $title = 'Data View';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
  <h2 class="title">View Data</h2>
  <div class="cards-grid mt-3 pt-lg-5 pl-lg-4 col-md-8 offset-md-2" >
  <form  id="save_form" action=" " method="POST" multiple enctype="multipart/form-data">
    <div class="form-check form-switch" style="font-size:25px">
      @csrf
      @if(isset($data->status_v))
        @if($data->status_v == 0)
          <input class="form-check-input" name="visitors" type="checkbox" id="visitors" vlaue='0'>
        @else
          <input class="form-check-input" name="visitors" type="checkbox" id="visitors"  vlaue='1' checked>
        @endif
        <label class="form-check-label" for="visitors"><span style="font-size:25px">Counter Visitors</span><span style="color:#ffa500;font-size:25px"> | {{$data->visitors}}</span></label>
      @endif
    </div>
    <div class="form-check form-switch" style="font-size:25px">
      @if(isset($data->status_p))
        @if($data->status_p == 0)
          <input class="form-check-input" name="project" type="checkbox" id="project">
        @else 
          <input class="form-check-input" name="project" type="checkbox" id="project" checked>
        @endif
        <label class="form-check-label" for="project"><span style="font-size:25px">Counter Projects</span><span style="color:#ffa500;font-size:25px"> | {{$data->projects}}</span></label>
      @endif
    </div>
  </div>
  </form>
  <div class="d-grid gap-2 col-6 mx-auto pt-lg-5 pl-lg-4">
    <button class="btn btn-success" type="button" id="save_data">Save</button>
  </div>
</div>
<script>
$("#save_data").on("click",function(t){t.preventDefault();t=new FormData($("#save_form")[0]);$.ajax({url:"{{route('admin.save_datasheet')}}",method:"post",enctype:"multipart/form-data",processData:!1,cache:!1,contentType:!1,data:t,success:function(t){Swal.fire({position:"center",icon:"success",title:t.msg,showConfirmButton:!1,timer:1500})}})});
</script>
@stop
