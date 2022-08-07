@php
$title = 'Group';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-none" id='counter_group' value='{{$counter}}'></div>
    <h2 class="title">group</h2>
    <div class="row mt-3">
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
                    <tr id="{{$group->id}}">
                        <td>{{$group->id}}</td>
                        <td>{{$group->group}}</td>
                        <td>
                            <button class="table-buttons" onclick="getRow({{$group->id}})">
                                <ion-icon class="text-primary" name="create-outline"></ion-icon>
                            </button>
                            <button class="table-buttons" id='delete_group'>
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
    let _token = $('input[name="_token"]').val();
    let action = '';
    let mood = 'create';

    $('body').on('click', '#save_group',function() {
        let groupName =$('#group_name').val();
        let groupId = $("#counter_group").attr('value');
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
                  title: 'Saved Group',
                  showConfirmButton: false,
                  timer: 1500
                })
                  html += `<tr id="${groupId}">
                              <td>${groupId}</td>
                              <td>${groupName}</td>
                              <td>
                                  <button class="table-buttons" onclick="getRow(${groupId})">
                                      <ion-icon class="text-primary" name="create-outline"></ion-icon>
                                  </button>
                                  <button class="table-buttons" id='delete_group'>
                                      <ion-icon class="text-danger" name="trash-outline"></ion-icon>
                                  </button>
                              </td>
                          </tr>`;
                  $("#counter_group").attr('value', +groupId+1)
                  $('tbody').html(html);
                  $('#group_name').val('')
              }
            }
        });
    });
    $('body').on('click', '#update_group', function() {
        let groupName = $('#group_name');
        action = 'update';
        $.ajax({
            url     :"{{route('admin.save.group')}}",
            method  : 'post',
            enctype : "multipart/form-data",
            data:
            {
              _token,
              groupId: groupName.attr('row'),
              groupName: groupName.val(),
              action
            },
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
                $(`tr#${groupName.attr('row')}`).find('td:nth-child(2)').text(groupName.val())
                mood = 'create'
                $('#update_group').html(mood === 'create' ? 'Save' : 'Update').removeClass('btn-primary').addClass('btn-success').attr('id', 'save_group')
                groupName.val('')
              }
            }
        });
    });
    $('body').on('click','#delete_group', function() {
        action = 'del';
        let groupId = $(this).parents('tr').attr('id');
        console.log(groupId)

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
                  $(`tr#${groupId}`).remove();
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
    function getRow(id) {
      let groupName = $(`tr#${id}`).find('td:nth-child(2)').text();
      $('#group_name').val(groupName).focus().attr('row', id);
      mood = 'update'
      $('#save_group').html(mood === 'update' ? 'Update' : 'Save').addClass('btn-primary').removeClass('btn-success').attr('id', 'update_group')
    }
</script>
@stop
