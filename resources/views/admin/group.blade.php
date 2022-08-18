@php
$title = 'Group';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
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
let _token=$("input[name=\"_token\"]").val(),action="",mood="create";$("body").on("click","#save_group",function(){let a=$("#group_name").val();action="save";let b=$("tbody").html();$.ajax({url:"{{route('admin.save.group')}}",method:"post",enctype:"multipart/form-data",data:{_token,groupName:a,action},success:function(c){"true"==c.status&&(Swal.fire({position:"center",icon:"success",title:"Saved Group",showConfirmButton:!1,timer:1500}),b+=`<tr id="${c.msg}"><td>${c.msg}</td><td>${a}</td><td><button class="table-buttons" onclick="getRow(${c.msg})"><ion-icon class="text-primary" name="create-outline"></ion-icon></button><button class="table-buttons" id='delete_group'><ion-icon class="text-danger" name="trash-outline"></ion-icon></button></td></tr>`,$("tbody").html(b),$("#group_name").val(""))}})}),$("body").on("click","#update_group",function(){let a=$("#group_name");action="update",$.ajax({url:"{{route('admin.save.group')}}",method:"post",enctype:"multipart/form-data",data:{_token,groupId:a.attr("row"),groupName:a.val(),action},success:function(b){"true"==b.status&&(Swal.fire({position:"center",icon:"success",title:b.msg,showConfirmButton:!1,timer:1500}),$(`tr#${a.attr("row")}`).find("td:nth-child(2)").text(a.val()),mood="create",$("#update_group").html("create"===mood?"Save":"Update").removeClass("btn-primary").addClass("btn-success").attr("id","save_group"),a.val(""))}})}),$("body").on("click","#delete_group",function(){action="del";let a=$(this).parents("tr").attr("id");Swal.fire({title:"Are you sure?",text:"You won't delete this group",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"e#d33",confirmButtonText:"Yes, dlete it!"}).then(b=>{b.isConfirmed&&$.ajax({url:"{{route('admin.save.group')}}",method:"post",enctype:"multipart/form-data",data:{_token,groupId:a,action},success:function(b){$(`tr#${a}`).remove(),Swal.fire({position:"center",icon:"success",title:b.msg,showConfirmButton:!1,timer:1500})}})})});function getRow(a){let b=$(`tr#${a}`).find("td:nth-child(2)").text();$("#group_name").val(b).focus().attr("row",a),mood="update",$("#save_group").html("update"===mood?"Update":"Save").addClass("btn-primary").removeClass("btn-success").attr("id","update_group")}
</script>
@stop
