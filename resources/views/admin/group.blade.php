@php
$title = 'Group';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
    <h2 class="title">group</h2>
    <div class="row mt-5">
        <div class="col-md-6 offset-md-3">
            <div class="mb-3">
                @csrf
                <label for="group_name" class="form-label">Group Name</label>
                <input type="text" class="form-control" id="group_name" placeholder="Please Enter Group Name">
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-success clicked" id="save_group" type="button">Save</button>
            </div>
            <table class="table mt-4 text-center shadow-lg">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Group Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-light">
                    @foreach($groups as $group)
                    <tr>
                        <td>{{$group->id}}</td>
                        <td>{{$group->group}}</td>
                        <td>
                            <button class="table-buttons">
                                <ion-icon class="text-primary" name="create-outline"></ion-icon>
                            </button>
                            <button class="table-buttons">
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
    let action = '';

    $('#save_group').on('click', function() {
        let groupName =$('#group_name').val();
        let rowLength = $('tbody').children().length;
        action = 'save';
        let html = $('tbody').html();
        $.ajax({
            url     :"{{route('admin.save.group')}}",
            method  : 'post',
            enctype : "multipart/form-data",
            data:
            {
              _token,
              groupName,
              action
            },
            success: function (data)
            {
              if (data.status == 'true') {
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Your work has been saved',
                  showConfirmButton: false,
                  timer: 1500
                })
                  html += `<tr id="group_${rowLength + 1}">
                              <td>${rowLength + 1}</td>
                              <td>${groupName}</td>
                              <td>
                                  <button class="table-buttons">
                                      <ion-icon class="text-primary" name="create-outline"></ion-icon>
                                  </button>
                                  <button class="table-buttons" id='delete_group'>
                                      <ion-icon class="text-danger" name="trash-outline"></ion-icon>
                                  </button>
                              </td>
                          </tr>`
                  $('tbody').html(html);
              }
            }
        });
    });
    $('#update_group').on('click', function() {
        let groupId =$('#group_name').val();
        let groupName =$('#group_name').val();
        action = 'update';
        $.ajax({
            url     :"{{route('admin.save.group')}}",
            method  : 'post',
            enctype : "multipart/form-data",
            data:
            {
              _token,
              groupId,
              groupName,
              action
            },
            success: function (data)
            {

            }
        });
    });
    $('#delete_group').on('click', function() {
        let groupId =$('#group_name').val();
        action = 'del';
        let rowId = $(this).parents('tr').attr('id');

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't delete this group",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
                url     :"{{route('admin.save.group')}}",
                method  : 'post',
                enctype : "multipart/form-data",
                data:
                {
                  _token,
                  groupId,
                  action
                },
                success: function (data) {
                  $(this).parents('tr').remove()
                }
            });
          }
        });
    });
</script>
@stop
