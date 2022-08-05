@php
    $title = 'Details';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
    {{-- <div class="d-none" id='counter_group' value='{{$counter}}'></div> --}}
    <h2 class="title">Details</h2>
    <div class="row mt-5">
      <form  id="details_form" action=" " method="POST" multiple enctype="multipart/form-data">
        <div class="row align-items-end">
          <div class="col-md-4">
            <label for="project" class="form-label">Select Project</label>
            <select class="form-select" id='project' name="project" required>
              @foreach($projects as $project)
              <option value="{{$project->id}}">{{$project->title}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <div>
                @csrf
                <label for="project_name" class="form-label">Project Section</label>
                <input type="text" class="form-control" name="label" id="section_name" placeholder="Please Enter Project Section" required>
            </div>
          </div>
          <div class="col-md-4">
            <input multiple id="album" name="images[]" type="file" onchange="previewImages(this, this.parentElement.nextElementSibling)"/>
          </div>
          <div id="preview" class="d-flex flex-wrap mt-3 mb-5" style='gap: 10px'></div>
          {{-- <div class="album-container">
            <!-- Upload Image -->
          </div> --}}
        </div>
      </form>
      <div class="d-grid gap-2 col-6 mx-auto">
          <button class="btn btn-success clicked" id="save_details" type="button">Save</button>
      </div>
    </div>
    <table class="table mt-4 text-center shadow-lg">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Section</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-light">
          @foreach($sections as $section)
            <tr id="{{$section->id}}">
                <td>{{$section->id}}</td>
                <td>{{$section->name}}</td>
                <td>
                    <button class="table-buttons" onclick="getRow({{$section->id}})">
                        <ion-icon class="text-primary" name="create-outline"></ion-icon>
                    </button>
                    <button class="table-buttons" id='delete_section'>
                        <ion-icon class="text-danger" name="trash-outline"></ion-icon>
                    </button>
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
</div>
<script>
  let _token = $('input[name="_token"]').val();
  $('#save_details').on('click', function(e) {
    e.preventDefault();
    let formData = new FormData($('#details_form')[0]);
    $.ajax({
      url:"{{route('admin.save.details.project')}}",
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
          title: 'Saved Section',
          showConfirmButton: false,
          timer: 1500
          })
        }
      }
    });
  });

  
  $('#project').on('change',function (){
    let project = $('#project').val();
    $.ajax({
        url     :"{{route('admin.search.all.section')}}",
        method  : 'post',
        enctype : "multipart/form-data",
        data:
        {
          _token,
          project
        },
        success: function (data){
          if (data.status == 'true') {
            let html = '';
            for(var count = 0 ; count < data.msg.length ; count ++)
            {
              html+=`<tr id="${data.msg[count].id}">
                <td>${data.msg[count].id}</td>
                <td>${data.msg[count].name}</td>
                <td>
                    <button class="table-buttons" onclick="getRow(${data.msg[count].id})">
                        <ion-icon class="text-primary" name="create-outline"></ion-icon>
                    </button>
                    <button class="table-buttons" id='delete_section'>
                        <ion-icon class="text-danger" name="trash-outline"></ion-icon>
                    </button>
                </td>
              </tr>`
            }$('tbody').html(html)
          }
        }
      });
  });

  $('body').on('click','#delete_section', function() {
    let section = $(this).parents('tr').attr('id');
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't delete this section",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: 'e#d33',
      confirmButtonText: 'Yes, dlete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
            url     :"{{route('admin.del.section')}}",
            method  : 'post',
            enctype : "multipart/form-data",
            data:
            {
              _token,
              section,
            },
            success: function (data) {
              if(data.status = 'true'){
                $(`tr#${section}`).remove();
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
