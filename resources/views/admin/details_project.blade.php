@php
    $title = 'Details';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
    {{-- <div class="d-none" id='counter_group' value='{{$counter}}'></div> --}}
    <h2 class="title">Details</h2>
    <div class="row mt-5">
        <div class="col-md-10 offset-md-1">
            <form  id="project_form" action=" " method="POST" multiple enctype="multipart/form-data">
              <div class="row">
              <div class="col-md-6">
                  <label for="group" class="form-label">Select Group</label>
                  <select class="form-select" id='group' name="group" required>
                    @foreach($projects as $project)
                    <option value="{{$project->id}}">{{$project->title}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                      @csrf
                      <label for="project_name" class="form-label">Project Section</label>
                      <input type="text" class="form-control" name="label" id="section_name" placeholder="Please Enter Project Section" required>
                  </div>
                </div>
              </div>
            </form>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-success clicked" id="save_project" type="button">Save</button>
            </div>
        </div>
    </div>
</div>
@stop