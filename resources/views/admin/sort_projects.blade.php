@php
    $title = 'Sort Projects';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
    <h2 class="title">Sort</h2>
    <div class="row">
      <div class="sort-projects">
        <ul id="sortable">
          @foreach ($projects as $project)
          <li class="ui-state-default" data-id="{{$project->id}}">
            <img src="{{asset('Admin/Projects/' . $project->image)}}"/>
            <h1>{{$project->title}}</h1>
          </li>
          @endforeach
        </ul>
      </div>
      <div class="col-md-6 mx-auto">
        <button class="btn btn-success w-100" id="save_sort"> Save </button>
      </div>
    </div>
</div>

<script>
  $(function () {
      $("#sortable").sortable();
      $("#sortable").disableSelection();

      $('#save_sort').on('click', function() {
        let sortArr = []
        $('#sortable li').each(function () {
            sortArr.push($(this).attr('data-id'));
        });
        console.log(sortArr)
      });
  });
</script>
@stop
