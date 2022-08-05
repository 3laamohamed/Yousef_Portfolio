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
                <th>Project Name</th>
                <th>Section</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <tr id="1">
                <td>1</td>
                <td>Drone 356</td>
                <td>Sec1</td>
                <td>
                    <button class="table-buttons" onclick="getRow()">
                        <ion-icon class="text-primary" name="create-outline"></ion-icon>
                    </button>
                    <button class="table-buttons" id='delete_group'>
                        <ion-icon class="text-danger" name="trash-outline"></ion-icon>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script>
  $('#save_details').on('click', function(e) {
    e.preventDefault();
    let formData = new FormData($('#details_form')[0]);
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
</script>
@stop
