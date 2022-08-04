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
                    <tr>
                        <td>1</td>
                        <td>Group 1</td>
                        <td>
                            <button class="table-buttons">
                                <ion-icon class="text-primary" name="create-outline"></ion-icon>
                            </button>
                            <button class="table-buttons">
                                <ion-icon class="text-danger" name="trash-outline"></ion-icon>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    'use strict';
    let groupName = document.getElementById('group_name');
    let saveButton = document.getElementById('save_group');

    $('#save_group').on('click', function() {
      console.log('hi')
    });
</script>
@stop
