@php
$title = 'Project';
@endphp

@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="title">Projects</h2>
        <div class="row mt-3 project">
            <div class="col-md-10 offset-md-1">
                <form id="project_form" action=" " method="POST" multiple enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                @csrf
                                <input type="hidden" name="project_id" value="" id='project_id'>
                                <label for="project_name" class="form-label">Project Name</label>
                                <input type="text" class="form-control" name="label" id="project_name"
                                    placeholder="Please Enter Project Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="group" class="form-label">Select Group</label>
                            <select class="form-select" id='group' name="group" required>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->group }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="description" class="form-label">description</label>
                                <textarea class="form-control" name='disc' placeholder="Write Your Description" id="description" required
                                    style="min-height: 250px;height: 250px"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Upload Image -->
                            <div class='text-center'>
                                <i class="file-image">
                                    <input autocomplete="off" id="image" name="thumbnail" type="file"
                                        onchange="readImage(this)" title="" required />
                                    <i class="reset" onclick="resetImage(this.previousElementSibling)"></i>
                                    <div id='item-image'>
                                        <label for="image" class="image" data-label="Add thumbnail"></label>
                                    </div>
                                </i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="project_name" class="form-label">Activation</label>
                            <div class="form-check form-switch" style="font-size:25px">
                                <input class="form-check-input" name="project_active" type="checkbox" id="project_active">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button class="btn btn-success clicked" id="save_project" type="button">Save</button>
                    <button class="btn btn-primary clicked d-none" id="update_project" type="button">Update</button>
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
                        @foreach ($projects as $project)
                            <tr id="{{ $project->id }}">
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->title }}</td>
                                <td>
                                    <button class="table-buttons" onclick="getRow({{ $project->id }})">
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
        let rowId, _token = $("input[name=\"_token\"]").val(),
            groupId = $("#group").find("option:first-child").attr("value");
        $("#group").on("change", function() {
            let a = $("#group").val();
            $.ajax({
                url: "{{ route('admin.all.search.project') }}",
                method: "post",
                enctype: "multipart/form-data",
                data: {
                    _token,
                    group: a
                },
                success: function(a) {
                    if ("true" == a.status) {
                        let c = "";
                        for (var b = 0; b < a.msg.length; b++) c +=
                            `<tr id="${a.msg[b].id}"><td>${a.msg[b].id}</td><td>${a.msg[b].title}</td><td><button class="table-buttons" onclick="getRow(${a.msg[b].id})"><ion-icon class="text-primary" name="create-outline"></ion-icon></button><button class="table-buttons" id='delete_project'><ion-icon class="text-danger" name="trash-outline"></ion-icon></button></td></tr>`;
                        $("tbody").html(c)
                    }
                }
            })
        }), $("#save_project").on("click", function(a) {
            a.preventDefault();
            let b = new FormData($("#project_form")[0]),
                c = $("tbody").html();
            $.ajax({
                url: "{{ route('admin.save.project') }}",
                method: "post",
                enctype: "multipart/form-data",
                processData: !1,
                cache: !1,
                contentType: !1,
                data: b,
                success: function(a) {
                    "true" == a.status && (c +=
                        `<tr id="${a.msg}"><td>${a.msg}</td><td>${$("#project_name").val()}</td><td><button class="table-buttons" onclick="getRow(${a.msg})"><ion-icon class="text-primary" name="create-outline"></ion-icon></button><button class="table-buttons" id='delete_project'><ion-icon class="text-danger" name="trash-outline"></ion-icon></button></td></tr>`,
                        $("tbody").html(c), $("#group").val(groupId).change(), Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Saved Project",
                            showConfirmButton: !1,
                            timer: 1500
                        }), document.getElementById("project_form").reset(), $(".reset").click())
                }
            })
        }), $("#update_project").on("click", function(a) {
            a.preventDefault();
            let b = new FormData($("#project_form")[0]);
            $.ajax({
                url: "{{ route('admin.update.project') }}",
                method: "post",
                enctype: "multipart/form-data",
                processData: !1,
                cache: !1,
                contentType: !1,
                data: b,
                success: function(a) {
                    "true" === a.status && ($(`tr#${rowId}`).find("td:nth-child(2)").text($(
                            "#project_name").val()), $("#save_project").removeClass("d-none"), $(
                            "#update_project").addClass("d-none"), document.getElementById(
                            "project_form").reset(), $(".reset").click(), $("#group").val(groupId)
                        .change(), Swal.fire({
                            position: "center",
                            icon: "success",
                            title: a.msg,
                            showConfirmButton: !1,
                            timer: 1500
                        }))
                }
            })
        }), $("body").on("click", "#delete_project", function() {
            let a = $(this).parents("tr").attr("id");
            Swal.fire({
                title: "Are you sure?",
                text: "You won't delete this group",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "e#d33",
                confirmButtonText: "Yes, dlete it!"
            }).then(b => {
                b.isConfirmed && $.ajax({
                    url: "{{ route('admin.del.project') }}",
                    method: "post",
                    enctype: "multipart/form-data",
                    data: {
                        _token,
                        project: a
                    },
                    success: function(b) {
                        (b.status = "true") && ($(`tr#${a}`).remove(), Swal.fire({
                            position: "center",
                            icon: "success",
                            title: b.msg,
                            showConfirmButton: !1,
                            timer: 1500
                        }))
                    }
                })
            })
        });

        function getRow(a) {
            $.ajax({
                url: "{{ route('admin.get.update.project') }}",
                method: "post",
                enctype: "multipart/form-data",
                data: {
                    _token,
                    id: a
                },
                success: function(data) {
                    if (data.status === "true") {
                        rowId = a;
                        $('#save_project').addClass('d-none');
                        $('#update_project').removeClass('d-none');
                        $('#project_id').val(rowId);
                        $('#project_name').val(data.msg.title);
                        $('#description').val(data.msg.disc);
                        $('#image').attr('title', data.msg.image)
                        $('#item-image').html(
                            `<label for="image" class="image unvisibile" data-label="Add thumbnail" style="background-image:url({{ URL::asset('Admin/projects') }}/${data.msg.image})"></label>`
                            );
                        if (data.msg.activation == 1) {
                          $('#project_active').prop('checked', true)
                        } else {
                          $('#project_active').prop('checked', false)
                        }
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    }

                }
            })
        }
    </script>
@stop
