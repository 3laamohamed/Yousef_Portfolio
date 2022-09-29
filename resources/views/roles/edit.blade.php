@extends('layouts.app')

@section('content')
  <div class="container">
    <h2 class="title">Edit Role</h2>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> something went wrong.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission:</strong>
              <div class="row">
                @foreach($permission as $value)
                  <div class="col-md-3">
                    <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                        {{ $value->name }}</label>
                  </div>
                @endforeach
              </div>
            </div>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
    {!! Form::close() !!}


@endsection
