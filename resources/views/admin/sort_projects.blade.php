@php
    $title = 'Sort Projects';
@endphp

@extends('layouts.app')
@section('content')
  @foreach ($projects as $project)
    <h1>{{$project->title}}</h1>
    <img src="{{asset('Admin/Projects/' . $project->image)}}" width="80" height="80"/>
  @endforeach

<script>
</script>
@stop
