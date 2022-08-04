@php
    $title = 'About';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
  <h2 class="title">About<h2>
  <div class="row mt-5">
    <div class="col-md-10 offset-md-1">
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="group_name" class="form-label">Discibtion</label>
            <textarea class="form-control mt-3" placeholder="Write Your Discribtion" id="discribtion" style="min-height: 250px;height: 250px"></textarea>
          </div>
        </div>
        <div class="col-md-6">
          <!-- Upload Image -->
          <div class='text-center'>
            <i class="file-image">
              <input autocomplete="off" id="image" name="image" type="file" onchange="readImage(this)" title="" />
              <i class="reset" onclick="resetImage(this.previousElementSibling)"></i>
              <div id='item-image'>
                <label for="image" class="image" data-label="Add Image"></label>
              </div>
            </i>
          </div>
        </div>
      </div>
      <div class="d-grid gap-2 col-6 mx-auto mt-4">
        <button class="btn btn-success clicked" id="save_copy_right" type="button">Save</button>
      </div>
    </div>
  </div>
</div>
@stop
