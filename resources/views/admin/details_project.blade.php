@php
$title = 'Details';
@endphp

@extends('layouts.app')
@section('content')
    <div class="container">
        {{-- <div class="d-none" id='counter_group' value='{{$counter}}'></div> --}}
        <h2 class="title">Details</h2>
        <div class="row mt-3">
            <form id="details_form" action=" " method="POST" multiple enctype="multipart/form-data">
                <div class="row align-items-end">
                    <div class="col-md-4 mt-3">
                        <label for="project" class="form-label">Select Project</label>
                        <select class="form-select" id='project' name="project" required>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div>
                            @csrf
                            <input type="hidden" name="section_id" value="" id='section_id'>
                            <label for="project_name" class="form-label">Project Section</label>
                            <input type="text" class="form-control" name="label" id="section_name"
                                placeholder="Please Enter Project Section" required>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <input multiple id="album" name="images[]" type="file" />
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
                @foreach ($sections as $section)
                    <tr id="{{ $section->id }}">
                        <td>{{ $section->id }}</td>
                        <td>{{ $section->name }}</td>
                        <td>
                            <button class="table-buttons" onclick="getRow({{ $section->id }})">
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

    <div class="modal fade upload-loading" id="upload" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body d-flex align-items-center py-5">
            <div class='three mx-auto'>
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script>
        let rowId, _token = $("input[name=\"_token\"]").val(),
            projectId = $("#project").find("option:first-child").attr("value"),
            loading = false;
        $("#project").on("change", function() {
            let a = $("#project").val();
            $.ajax({
                url: "{{ route('admin.search.all.section') }}",
                method: "post",
                enctype: "multipart/form-data",
                data: {
                    _token,
                    project: a
                },
                success: function(a) {
                    if ("true" == a.status) {
                        let c = "";
                        for (var b = 0; b < a.msg.length; b++) c +=
                            `<tr id="${a.msg[b].id}"><td>${a.msg[b].id}</td><td>${a.msg[b].name}</td><td><button class="table-buttons" onclick="getRow(${a.msg[b].id})"><ion-icon class="text-primary" name="create-outline"></ion-icon></button><button class="table-buttons" id='delete_section'><ion-icon class="text-danger" name="trash-outline"></ion-icon></button></td></tr>`;
                        $("tbody").html(c)
                    }
                }
            })
        }), $("#save_details").on("click", function(a) {
            a.preventDefault();
            loading = true
            let b = $("tbody").html(),
                c = new FormData($("#details_form")[0]);
            $.ajax({
                url: "{{ route('admin.save.details.project') }}",
                method: "post",
                enctype: "multipart/form-data",
                processData: !1,
                cache: !1,
                contentType: !1,
                data: c,
                success: function(a) {
                    "true" == a.status && ($("#preview").html(""), b +=
                        `<tr id="${a.msg}"><td>${a.msg}</td><td>${$("#section_name").val()}</td><td><button class="table-buttons" onclick="getRow(${a.msg})"><ion-icon class="text-primary" name="create-outline"></ion-icon></button><button class="table-buttons" id='delete_group'><ion-icon class="text-danger" name="trash-outline"></ion-icon></button></td></tr>`,
                        $("tbody").html(b), document.getElementById("details_form").reset(), $(
                            "#project").val(projectId).change(), Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Saved Section",
                            showConfirmButton: !1,
                            timer: 1500
                        }))
                }
            })
        }), $("body").on("click", "#delete_section", function() {
            let a = $(this).parents("tr").attr("id");
            Swal.fire({
                title: "Are you sure?",
                text: "You won't delete this section",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "e#d33",
                confirmButtonText: "Yes, dlete it!"
            }).then(b => {
                b.isConfirmed && $.ajax({
                    url: "{{ route('admin.del.section') }}",
                    method: "post",
                    enctype: "multipart/form-data",
                    data: {
                        _token,
                        section: a
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
            let b = "";
            $.ajax({
                url: "{{ route('admin.get.update.details') }}",
                method: "post",
                enctype: "multipart/form-data",
                data: {
                    _token,
                    id: a
                },
                success: function(c) {
                    "true" === c.status && (rowId = a, $("#section_name").val(c.section), $("#save_details")
                        .addClass("d-none"), $("#update_details").removeClass("d-none"), $("#section_id")
                        .val(rowId), c.images.forEach(a => {
                          if (a.image.split('.')[1] != 'mp4') {
                            b += `<div class='text-center flex-grow-1'>
                              <i class="file-image">
                                <input autocomplete="off" type="file" title="${a.image}" />
                                <i class="reset" onclick="delDetailsImg('${a.image}', ${a.id}, this)"></i>
                                <div id='item-image'>
                                  <label for="image" class="image unvisibile" style="background-image: url({{ URL::asset('Admin/Details/${a.image}') }})"></label>
                                </div>
                              </i>
                            </div>`
                          } else {
                            b += `<div class='text-center flex-grow-1'>
                              <i class="file-image">
                                <input autocomplete="off" type="file" title="${a.image}" />
                                <i class="reset" onclick="delDetailsImg('${a.image}', ${a.id}, this)"></i>
                                <div id='item-image'>
                                  <video src="{{ asset('Admin/Details/${a.image}') }}" controls controlsList="nodownload"></video>
                                </div>
                              </i>
                            </div>`
                          }

                        }), $("#preview").html(b), window.scrollTo({
                            top: 0,
                            behavior: "smooth"
                        }))
                }
            })
        }

        $(document).on({
            ajaxStart: function() {
              if (loading) {
                $('#upload').modal('show')
              }
            },
            ajaxStop: function() {
              if (loading) {
                $('#upload').modal('hide')
                loading = false
              }
            }
        });

        function delDetailsImg(a, b, c) {
            let d = c.parentElement.parentElement;
            Swal.fire({
                title: "Are you sure?",
                text: "You won't delete this Image",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "e#d33",
                confirmButtonText: "Yes, dlete it!"
            }).then(c => {
                c.isConfirmed && $.ajax({
                    url: "{{ route('admin.del.image.details') }}",
                    method: "post",
                    enctype: "multipart/form-data",
                    data: {
                        _token,
                        id: b,
                        image: a
                    },
                    success: function(a) {
                        (a.status = "true") && (Swal.fire({
                            position: "center",
                            icon: "success",
                            title: a.msg,
                            showConfirmButton: !1,
                            timer: 1500
                        }), d.remove())
                    }
                })
            })
        }
        $("body").on("click", "#update_details", function() {
            let a = new FormData($("#details_form")[0]);
            loading = true
            $.ajax({
                url: "{{ route('admin.update.image.details') }}",
                method: "post",
                enctype: "multipart/form-data",
                processData: !1,
                cache: !1,
                contentType: !1,
                data: a,
                success: function(a) {
                    "true" == a.status && (Swal.fire({
                            position: "center",
                            icon: "success",
                            title: a.msg,
                            showConfirmButton: !1,
                            timer: 1500
                        }), $("#project").val(projectId).change(), $(`tr#${rowId}`).find(
                            "td:nth-child(2)").html($("#section_name").val()), $("#save_details")
                        .removeClass("d-none"), $("#update_details").addClass("d-none"), $(
                            "#preview").html(""), document.getElementById("details_form").reset())
                }
            })
        });
        $body = $("body");
    </script>
@stop
