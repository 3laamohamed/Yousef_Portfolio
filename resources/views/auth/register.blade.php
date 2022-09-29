@php
    $title = 'Register'; $chnge_req = 'required';
@endphp

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              @if(isset($user_update))
                <div class="card-header">{{ __('Update User') }}</div>
              @else
                <div class="card-header">{{ __('New User') }}</div>
              @endif

                <div class="card-body">
                    @if(isset($user_update))
                      @php $chnge_req = ''; @endphp
                    <form method="POST" id="save_update" action=" " method="POST" multiple enctype="multipart/form-data">
                    @else
                    <form method="POST" action="{{ route('register') }}">
                    @endif
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="text" name="id" value="@if(isset($user_update)){{$user_update->id}}@endif" class="d-none">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="@if(isset($user_update)){{$user_update->name}}@endif" autocomplete="off" required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="@if(isset($user_update)){{$user_update->email}}@endif" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" {{$chnge_req}}>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" {{$chnge_req}} autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                          @if(isset($user_update))
                            <div class="col-md-6 offset-md-4">
                              <button id="update_user" type="submit" class="btn btn-primary">
                                {{ __('Update User') }}
                              </button>
                            </div>
                          @else
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                {{ __('Save User') }}
                              </button>
                            </div>
                          @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  let _token=$("input[name=\"_token\"]").val()
  $("#update_user").on("click",function(t){
    t.preventDefault();
    let data = new FormData($("#save_update")[0]);
    $.ajax({
      url:"{{route('update_user_now')}}",
      method:"post",
      enctype:"multipart/form-data",
      processData:!1,
      cache:!1,
      contentType:!1,
      data:data,
      success:function(t){
        Swal.fire({
          position:"center",
          icon:"success",
          title:t.msg,
          showConfirmButton:!1,
          timer:1500
        })
      }
    })
  });
</script>
@endsection
