@php
    $title = 'Details';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
    {{-- <div class="d-none" id='counter_group' value='{{$counter}}'></div> --}}
    <h2 class="title">Details</h2>
    <div class="row mt-3">
      <form  id="details_form" action=" " method="POST" multiple enctype="multipart/form-data">
        <div class="row align-items-end">
          <div class="col-md-4 mt-3">
            <label for="project" class="form-label">Select Project</label>
            <select class="form-select" id='project' name="project" required>
              @foreach($projects as $project)
              <option value="{{$project->id}}">{{$project->title}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4 mt-3">
            <div>
                @csrf
                <input type="hidden" name="section_id" value="" id='section_id'>
                <label for="project_name" class="form-label">Project Section</label>
                <input type="text" class="form-control" name="label" id="section_name" placeholder="Please Enter Project Section" required>
            </div>
          </div>
          <div class="col-md-4 mt-3">
            <input multiple id="album" name="images[]" type="file" onchange="previewImages(this, this.parentElement.nextElementSibling)"/>
          </div>
          <div id="preview" class="d-flex flex-wrap mt-3 mb-5" style='gap: 10px'></div>
        </div>
      </form>
      <div class="d-grid gap-2 col-6 mx-auto">
          <button class="btn btn-success clicked" id="save_details" type="button">Save</button>
          <button class="btn btn-primary clicked d-none" id="update_details" type="button">Update</button>
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
    let projectId = $('#project').find('option:first-child').attr('value');
  let rowId;
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
  $('#save_details').on('click', function(e) {
    e.preventDefault();
    let html = $('tbody').html();
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
          $('#preview').html('');
          html += `<tr id="${data.msg}">
                        <td>${data.msg}</td>
                        <td>${$('#section_name').val()}</td>
                        <td>
                          <button class="table-buttons" onclick="getRow(${data.msg})">
                                <ion-icon class="text-primary" name="create-outline"></ion-icon>
                                </button>
                            <button class="table-buttons" id='delete_group'>
                              <ion-icon class="text-danger" name="trash-outline"></ion-icon>
                              </button>
                        </td>
                    </tr>
          `;
          $('tbody').html(html);
          document.getElementById('details_form').reset();
          $('#project').val(projectId).change();
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
  function getRow(id) {
    let imagesCont = '';
    $.ajax({
      url     :"{{route('admin.get.update.details')}}",
      method  : 'post',
      enctype : "multipart/form-data",
      data: {
        _token,
        id
      },
      success: function(data) {
        if(data.status === "true") {
          rowId = id;
          $('#section_name').val(data.section)
          $('#save_details').addClass('d-none');
          $('#update_details').removeClass('d-none');
          $('#section_id').val(rowId);
          data.images.forEach(img => {
            imagesCont += `<div class='text-center flex-grow-1'>
                  <i class="file-image">
                    <input autocomplete="off" type="file" title="${img.image}" />
                    <i class="reset" onclick="delDetailsImg('${img.image}', ${img.id}, this)"></i>
                    <div id='item-image'>
                      <label for="image" class="image unvisibile" style="background-image: url({{ URL::asset('Admin/Details/${img.image}') }})"></label>
                    </div>
                  </i>
                </div>`
          });
          $('#preview').html(imagesCont);
          window.scrollTo({
            top: 0,
            behavior: 'smooth'
          });
        }
      },
    });
  }
  function delDetailsImg(imgLabel, id, btn) {
    let imgParent = btn.parentElement.parentElement;

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't delete this Image",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: 'e#d33',
      confirmButtonText: 'Yes, dlete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url     :"{{route('admin.del.image.details')}}",
          method  : 'post',
          enctype : "multipart/form-data",
          data: {
            _token,
            id,
            image: imgLabel
          },
          success: function(data) {
            if(data.status = 'true'){
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: data.msg,
              showConfirmButton: false,
              timer: 1500
            })
            imgParent.remove()
          }
          }
        });
      }
    });
  }
  $('body').on('click', '#update_details', function() {
    let formData = new FormData($('#details_form')[0]);
    $.ajax({
      url:"{{route('admin.update.image.details')}}",
      method:'post',
      enctype:"multipart/form-data",
      processData:false,
      cache : false,
      contentType:false,
      'data' : formData,
      success: function(data) {
        if(data.status == 'true'){
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: data.msg,
              showConfirmButton: false,
              timer: 1500
            });
            $('#project').val(projectId).change();
            $(`tr#${rowId}`).find('td:nth-child(2)').html($('#section_name').val());
            $('#save_details').removeClass('d-none');
            $('#update_details').addClass('d-none');
            $('#preview').html('');
            document.getElementById('details_form').reset();
          }
      }
    });

  });
</script>
@stop
