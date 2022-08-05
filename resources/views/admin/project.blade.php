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
                    @foreach($groups as $group)
                    <option value="{{$group->id}}">{{$group->group}}</option>
                    @endforeach
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
              </div>
            </form>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-success clicked" id="save_project" type="button">Save</button>
            </div>
            <table class="table mt-4 text-center shadow-lg">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-light">
                  @foreach($projects as $project)
                  <tr id="{{$project->id}}">
                        <td>{{$project->id}}</td>
                        <td>{{$project->title}}</td>
                        <td>
                            <button class="table-buttons" onclick="getRow({{$project->id}})">
                                <ion-icon class="text-primary" name="create-outline"></ion-icon>
                            </button>
                            <button class="table-buttons" id='delete_project'>
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
  let _token           = $('input[name="_token"]').val();
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
            if(data.status == 'true') {
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
  $('#update_project').on('click', function(e) {
    e.preventDefault();
    let formData      = new FormData($('#project_form')[0]);
        $.ajax({
          url:"{{route('admin.update.project')}}",
          method:'post',
          enctype:"multipart/form-data",
          processData:false,
          cache : false,
          contentType:false,
          'data' : formData,
          success: function (data)
          {
            if(data.status == 'true') {
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
  $('#group').on('change',function (){
    let group = $('#group').val();
    $.ajax({
        url     :"{{route('admin.all.search.project')}}",
        method  : 'post',
        enctype : "multipart/form-data",
        data:
        {
          _token,
          group
        },
        success: function (data){
          if (data.status == 'true') {
            let html = '';
            for(var count = 0 ; count < data.msg.length ; count ++)
            {
              html+=`<tr id="${data.msg[count].id}">
                <td>${data.msg[count].id}</td>
                <td>${data.msg[count].title}</td>
                <td>
                    <button class="table-buttons" onclick="getRow(${data.msg[count].id})">
                        <ion-icon class="text-primary" name="create-outline"></ion-icon>
                    </button>
                    <button class="table-buttons" id='delete_project'>
                        <ion-icon class="text-danger" name="trash-outline"></ion-icon>
                    </button>
                </td>
              </tr>`
            }$('tbody').html(html)
          }
        }
      });
  });
  $('body').on('click','#delete_project', function() {
        let project = $(this).parents('tr').attr('id');
        console.log(project)
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't delete this group",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: 'e#d33',
          confirmButtonText: 'Yes, dlete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
                url     :"{{route('admin.del.project')}}",
                method  : 'post',
                enctype : "multipart/form-data",
                data:
                {
                  _token,
                  project,
                },
                success: function (data) {
                  if(data.status = 'true'){
                    $(`tr#${project}`).remove();
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
          }
        });
    });
</script>
@stop
