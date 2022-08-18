@php
    $title = 'Contact';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
  <h2 class="title"> Contact </h2>
  <div class="cards-grid mt-3">
    @foreach($contacts as $contact)
    <div class="card shadow" cardId="{{$contact->id}}">
      <ion-icon class="icon-back"  name="chatbubbles-outline"></ion-icon>
      <div class="card-header d-flex align-items-center justify-content-between">
        <small class="text-muted">{{$contact->created_at}}</small>
        <button id="del-mesg" class="d-flex align-items-center justify-content-center p-2">
          <ion-icon class="text-white" name="trash-outline"></ion-icon>
        </button>
      </div>
      <div class="card-body">
        <h3 class="card-title">{{$contact->name}}</h3>
        <h5>{{$contact->email}}</h5>
        <h5>{{$contact->phone}}</h5>
        <blockquote class="blockquote mb-0">
        <p class="blockquote-footer mt-2">{{$contact->disc}}</p>
        </blockquote>
      </div>
    </div>
    @endforeach
  </div>
</div>
<script>
$("body").on("click","#del-mesg",function(){let e=$(this).parents(".card");var o=$('input[name="_token"]').val();Swal.fire({title:"Are you sure?",text:"You won't delete this Message",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"e#d33",confirmButtonText:"Yes, dlete it!"}).then(t=>{t.isConfirmed&&$.ajax({url:"{{route('admin.delete.contact')}}",method:"post",enctype:"multipart/form-data",data:{_token:o,cardId:e.attr("cardId")},success:function(t){e.remove(),Swal.fire({position:"center",icon:"success",title:t.msg,showConfirmButton:!1,timer:1500})}})})});
</script>
@stop
