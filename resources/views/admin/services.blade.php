@php
    $title = 'Services';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
  <h2 class="title">Services</h2>
  <div class="row mt-3">
    <div class="col-md-10 offset-md-1">
    <form id="form_save_service" action=" " method="POST" multiple enctype="multipart/form-data">
      @csrf
      <div class="row align-items-start about">
        <div class="col-md-6">
          <div class="mb-3">
              <input type="hidden" name="service_id" value="" id='service_id'>
              <label for="service_name" class="form-label">Service Name</label>
              <input type="text"  class="form-control" name='name' id="service_name" placeholder="Please Enter Brand Name">
          </div>
          <div class="mb-3">
            <label for="discription" class="form-label">description</label>
            <textarea class="form-control mt-3" name='disc' placeholder="Write Your Discription" id="discription" style="min-height: 250px;height: 250px"></textarea>
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
        <button class="btn btn-primary clicked d-none" id="update_service" type="button">Update</button>
      </div>
      <table class="table mt-4 text-center shadow-lg" style="font-size: 1rem;">
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
              <button class="table-buttons" onclick="getRow({{$service->id}})">
                <ion-icon class="text-primary" name="create-outline"></ion-icon>
              </button>
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
let rowId,_token=$("input[name=\"_token\"]").val();$("#save_service").on("click",function(){let a=new FormData($("#form_save_service")[0]),b=$("tbody").html();$.ajax({url:"{{route('admin.save.service')}}",method:"post",enctype:"multipart/form-data",processData:!1,cache:!1,contentType:!1,data:a,success:function(a){"true"==a.status&&(b+=`<tr id="${a.msg}"><td>${a.msg}</td><td>${$("#service_name").val()}</td><td><button class="table-buttons" onclick="getRow(${a.msg})"><ion-icon class="text-primary" name="create-outline"></ion-icon></button><button class="table-buttons" id='delete_service'><ion-icon class="text-danger" name="trash-outline"></ion-icon></button></td></tr>`,$("tbody").html(b),document.getElementById("form_save_service").reset(),$(".reset").click(),Swal.fire({position:"center",icon:"success",title:"Saved Service",showConfirmButton:!1,timer:1500}))}})}),$("body").on("click","#delete_service",function(){let a=$("input[name=\"_token\"]").val(),b=$(this).parents("tr").attr("id");Swal.fire({title:"Are you sure?",text:"You won't delete this service",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"e#d33",confirmButtonText:"Yes, dlete it!"}).then(c=>{c.isConfirmed&&$.ajax({url:"{{route('admin.delete.service')}}",method:"post",enctype:"multipart/form-data",data:{_token:a,service:b},success:function(a){$(`tr#${b}`).remove(),Swal.fire({position:"center",icon:"success",title:a.msg,showConfirmButton:!1,timer:1500})}})})}),$("#update_service").on("click",function(a){a.preventDefault();let b=new FormData($("#form_save_service")[0]);$.ajax({url:"{{route('admin.update.services')}}",method:"post",enctype:"multipart/form-data",processData:!1,cache:!1,contentType:!1,data:b,success:function(a){"true"===a.status&&($(`tr#${rowId}`).find("td:nth-child(2)").text($("#service_name").val()),$("#save_service").removeClass("d-none"),$("#update_service").addClass("d-none"),document.getElementById("form_save_service").reset(),$(".reset").click(),Swal.fire({position:"center",icon:"success",title:a.msg,showConfirmButton:!1,timer:1500}))}})});function getRow(a){$.ajax({url:"{{route('admin.get.update.services')}}",method:"post",enctype:"multipart/form-data",data:{_token,id:a},success:function(b){"true"===b.status&&(rowId=a,$("#save_service").addClass("d-none"),$("#update_service").removeClass("d-none"),$("#service_id").val(rowId),$("#service_name").val(b.msg.title),$("#discription").val(b.msg.disc),$("#image").attr("title",b.msg.image),$("#item-image").html(`<label for="image" class="image unvisibile" data-label="Add Image" style="background-image:url({{ URL::asset('Admin/Services') }}/${b.msg.image})"></label>`),window.scrollTo({top:0,behavior:"smooth"}))}})}
</script>
@stop
