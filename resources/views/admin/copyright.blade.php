@php
    $title = 'CopyRight';
@endphp

@extends('layouts.app')
@section('content')
  <div class="container">
      <h2 class="title">CopyRight<h2>
      <div class="row mt-5">
          <div class="col-md-6 offset-md-3">
              <div class="mb-3">
                  <label for="group_name" class="form-label">Copyright Message</label>
                  <textarea class="form-control mt-3" placeholder="Write Your Message" id="copy_right" style="height: 200px"></textarea>
              </div>
              <div class="d-grid gap-2 col-6 mx-auto">
                  <button class="btn btn-success clicked" id="save_copy_right" type="button">Save</button>
              </div>
          </div>
      </div>
  </div>
@stop
