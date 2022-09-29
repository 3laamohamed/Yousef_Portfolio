@extends('layouts.app')


@section('content')
  <div class="container">
    <h2 class="title">Users Management</h2>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success mb-2" href="{{ route('users.create') }}"> Create New User </a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
      <script>
        Swal.fire({position:"center",icon:"success",title:'Saved Data',showConfirmButton:!1,timer:1500})
      </script>
    @endif


    <table class="table">
        <tr class="table-dark">
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            @if($v == 'Admin')
                            <label class="badge bg-success">{{ $v }}</label>
                            @else
                            <label class="badge bg-secondary">{{ $v }}</label>
                            @endif
                        @endforeach
                    @endif
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>


    {!! $data->render() !!}
  </div>
  </div>

@endsection
