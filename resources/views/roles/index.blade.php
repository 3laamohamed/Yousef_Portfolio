@extends('layouts.app')

@section('content')
  <div class="container">
    <h2 class="title">Roles Management</h2>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right mb-2">
              <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role </a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
          <script>
            Swal.fire({position:"center",icon:"success",title:'Saved Data',showConfirmButton:!1,timer:1500})
          </script>
    @endif


    <table class="table table-bordered">
        <tr class="table-dark">
            <th>No</th>
            <th>Name</th>
            <th width="200px">Action</th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                  <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                  {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                  {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>

    {!! $roles->render() !!}
  </div>
@endsection
