@php
    $title = 'Data View';
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
  <h2 class="title">View Data</h2>
  <div class="cards-grid mt-3 pt-lg-5 pl-lg-4 col-md-8 offset-md-2" >
  <form  id="save_form" action=" " method="POST" multiple enctype="multipart/form-data">
    <div class="form-check form-switch" style="font-size:25px">
      @csrf
      @if(isset($data->status_v))
        @if($data->status_v == 0)
          <input class="form-check-input" name="visitors" type="checkbox" id="visitors" vlaue='0'>
        @else
          <input class="form-check-input" name="visitors" type="checkbox" id="visitors"  vlaue='1' checked>
        @endif
        <label class="form-check-label" for="visitors"><span style="font-size:25px">Counter Visitors</span><span style="color:#ffa500;font-size:25px"> | {{$data->visitors}}</span></label>
      @endif
    </div>
    <div class="form-check form-switch" style="font-size:25px">
      @if(isset($data->status_p))
        @if($data->status_p == 0)
          <input class="form-check-input" name="project" type="checkbox" id="project">
        @else
          <input class="form-check-input" name="project" type="checkbox" id="project" checked>
        @endif
        <label class="form-check-label" for="project"><span style="font-size:25px">Counter Projects</span><span style="color:#ffa500;font-size:25px"> | {{$data->projects}}</span></label>
      @endif
    </div>
  </div>
  </form>
  <div class="d-grid gap-2 col-6 mx-auto pt-lg-5 pl-lg-4">
    <button class="btn btn-success" type="button" id="save_data">Save</button>
  </div>
  <hr>
  <div class="buttons-filter">
    <button class='btn btn-light filter-btn' data-value='today'>today</button>
    <button class='btn btn-light filter-btn' data-value='yesterday'>yesterday</button>
    <button class='btn btn-light filter-btn' data-value='this-week'>this week</button>
    <button class='btn btn-light filter-btn' data-value='last-week'>last week</button>
    <button class='btn btn-light filter-btn' data-value='this-month'>this month</button>
    <button class='btn btn-light filter-btn' data-value='last-month'>last month</button>
    <button class='btn btn-light filter-btn' data-value='this-year'>this year</button>
    <button class='btn btn-light filter-btn filter-custom'>custom</button>
    <div class="input-group mb-3 mt-5 d-none">
      <span class="input-group-text">From</span>
      <input type="date" class="form-control" id="from">
      <span class="input-group-text">To</span>
      <input type="date" id="to" class="form-control">
      <button class="btn btn-primary filter-btn" data-value='custom' type="button" id="search">Search</button>
    </div>
  </div>
  <table class="table mt-4 text-center shadow-lg">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>IP</th>
            <th>Device</th>
            <th>OS</th>
            <th>Browser</th>
            <th>Date &amp; Time</th>
        </tr>
    </thead>
    <tbody class="table-light">
      @php $count=1; @endphp
      @foreach($counter as $vis)
        <tr>
            <td>{{$count}}</td>
            <td>{{$vis->mac}}</td>
            <td>{{$vis->device}}</td>
            <td>{{$vis->os}}</td>
            <td>{{$vis->browser}}</td>
            <td>{{$vis->created_at}}</td>
        </tr>
        @php $count++; @endphp
        @endforeach
    </tbody>
</table>
<script>
  let _token=$("input[name=\"_token\"]").val();
$("#save_data").on("click",function(t){t.preventDefault();t=new FormData($("#save_form")[0]);$.ajax({url:"{{route('admin.save_datasheet')}}",method:"post",enctype:"multipart/form-data",processData:!1,cache:!1,contentType:!1,data:t,success:function(t){Swal.fire({position:"center",icon:"success",title:t.msg,showConfirmButton:!1,timer:1500})}})});
$('.filter-btn').on('click', function() {
  $(this).addClass('btn-primary').removeClass('btn-light').siblings('.btn').removeClass('btn-primary').addClass('btn-light');
  if ($(this).hasClass('filter-custom')) {
    $(this).next('.input-group').removeClass('d-none');
  } else {
    $(this).siblings('.input-group').addClass('d-none');
    let type = $(this).data('value');
    let from = $('#from').val();
    let to   = $('#to').val();
    let tableContent = ''
    $('tbody').html(tableContent)
    $.ajax({
      url: "{{route('admin.search.vis')}}",
      method: 'post',
      enctype: "multipart/form-data",
      data: {
        _token,
        type,
        from,
        to
      },
      success: function (data) {
        if(data.status == 'true')
        {
          let count = 0
          for (let i = 0; i < data.msg.length; i++) {
            let myDate = new Date(data.msg[i].created_at)
            count++
            tableContent += `<tr>
              <td>${count}</td>
              <td>${data.msg[i].mac}</td>
              <td>${data.msg[i].device}</td>
              <td>${data.msg[i].os}</td>
              <td>${data.msg[i].browser}</td>
              <td>${myDate.toLocaleString().replace(',' , ' ')}</td>
              </tr>`;
          }
          $('tbody').html(tableContent)
        }
      }
    });
  }
});
</script>
@stop
