@php
  $title = 'Social';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
  <h2 class="title">Social</h2>
  <div class="row mt-3">
    <div class="col-md-6 offset-md-3">
      <div class="mb-3">
        @csrf
        <label for="facebook" class="form-label">Facebook</label>
        <input type="text" class="form-control" id="facebook" placeholder="https://www.facebook.com/userName">
      </div>
      <div class="mb-3">
        <label for="gmail" class="form-label">Gmail</label>
        <input type="text" class="form-control" id="gmail" placeholder="Example123@gmail.com">
      </div>
      <div class="mb-3">
        <label for="linked_in" class="form-label">Linked in</label>
        <input type="text" class="form-control" id="linked_in" placeholder="https://www.linkedin.com/in/userName">
      </div>
      <div class="mb-3">
        <label for="whatsapp" class="form-label">whatsapp</label>
        <input type="text" class="form-control" id="whatsapp" placeholder="+2010234567890">
      </div>
      <div class="mb-3">
        <label for="twitter" class="form-label">twitter</label>
        <input type="text" class="form-control" id="twitter" placeholder="https://www.twitter.com/userName">
      </div>
      <div class="d-grid gap-2 col-6 mx-auto">
        <button class="btn btn-success clicked" id="save_group" type="button">Save</button>
      </div>
    </div>
  </div>
</div>
@stop
