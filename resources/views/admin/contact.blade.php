@php
    $title = 'Contact';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
  <h2 class="title"> Contact </h2>
  <div class="cards-grid mt-4">
    <div class="card shadow" cardId="1">
      <ion-icon class="icon-back"  name="chatbubbles-outline"></ion-icon>
      <div class="card-header d-flex align-items-center justify-content-between">
        <small class="text-muted">8/10/2022</small>
        <button id="del-mesg" class="d-flex align-items-center justify-content-center p-2">
          <ion-icon class="text-white" name="trash-outline"></ion-icon>
        </button>
      </div>
      <div class="card-body">
        <h3 class="card-title">Ibrahim Fares</h3>
        <h5>ibrahimfares511@gmail.com</h5>
        <h5>01007218535</h5>
        <blockquote class="blockquote mb-0">
          <p class="blockquote-footer mt-2">انا عايزك ضرورى جداا فى شغل ياريت تتصل عليا وتتواصل معايا عشان محتاجك اوى اوى اوى اوى اوى وربنا يصلح لينا الحال</p>
        </blockquote>
      </div>
    </div>
  </div>
</div>
<script>
  $('#del-mesg').on('click', function () {
    let card = $(this).parents('.card');

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't delete this Message",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: 'e#d33',
      confirmButtonText: 'Yes, dlete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
            url     :"{{route('admin.save.group')}}",
            method  : 'post',
            enctype : "multipart/form-data",
            data:
            {
              _token,
              cardId: card.attr('cardId')
            },
            success: function (data) {
              card.remove();
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: data.msg,
                showConfirmButton: false,
                timer: 1500
              })
            }
        });
      }
    });
  });
</script>
@stop
