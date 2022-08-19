@extends('layouts.main')
@section('content')
<!-- Start Loader -->
<div class="loading">
  <div class="dot"></div>
  <div class="dot"></div>
  <div class="dot"></div>
</div>
<!-- End Loader -->
@if(isset($about->image))
<main style="background-image: url({{asset('Admin/About/' . $about->image)}})">
@endif
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-md">
      <div class="container">
        <a class="navbar-brand" href="#">
            @if(isset($about->logo))
            <img src="{{asset('Admin/About/' . $about->logo)}}" alt="" width="80" height="50">
            @endif
        </a>
        <button id="open-nav" class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <div class="navbar-collapse">
          <ul class="navbar-nav mb-2 mb-lg-0">
            <div class="close-nav d-block d-md-none" id="close-nav">
              <span></span>
              <span></span>
            </div>
            <li class="nav-item">
              <a class="nav-link active" href="#Home" data-scroll="Home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#services" data-scroll="services">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#projects" data-scroll="projects">Projects</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#clients" data-scroll="clients">Clients</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#copyright" data-scroll="copyright">Copyright</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact" data-scroll="contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <header class="check-scroll" id='Home'>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-9 text-center">
            <div class="text-contant">
              @if(isset($about->name))
              <h4>I'm {{$about->name}} </h4>
              @endif
              @if(isset($about->disc))
              <h1>{{$about->disc}}</h1>
              @endif
            </div>
          </div>
        </div>
      </div>
    </header>
</main>
  <!-- Modal -->
  <div class="modal fade modal-xl" id="project_modal" tabindex="-1" aria-labelledby="project_modal_label"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-5">
          <div class="row">
            <div class="col-md-4">
              <div class="discription text-center">
                <p id="project_disc"></p>
              </div>
            </div>
            <div class="col-md-8">
              <ul class="nav nav-pills mb-3" id="details-tab" role="tablist"></ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="image-container" id="lightgallery"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Start Services -->
  <section id="services" class="services check-scroll">
    <h2 class="special-title">Services</h2>
    <div class="container">
      <div class="owl-carousel services-carousel">
        @foreach($services as $service)
          <div class="item">
            <div class="service">
              <div class="image">
                <img src="{{asset('Admin/Services/' . $service->image)}}" alt="">
              </div>
              <h3>{{$service->title}}</h3>
              <p>{{$service->disc}}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- End Services -->

  <!-- Start Projects -->
  <section id='projects' class="projects  check-scroll">
    <h2 class="special-title">Projects</h2>
    <div class="container">
      <ul class="categories">
        <li class="category active" value='all' data-filter="all">all</li>
        @foreach($groups as $group)
        @php
        $newgroup = str_replace(' ','_',$group->group);
        echo "<li class='category' value='$group->id' data-filter='$newgroup'>$group->group</li>";
        @endphp
        @endforeach
      </ul>
      <div class="cards-container">
        @foreach($projects as $project)
        @php
        $newgroup = str_replace(' ','_',$project->groupname);
        echo "<div data-id='$project->id' class='card shadow-lg cards $newgroup' data-bs-toggle='modal' data-bs-target='#project_modal'>";
        @endphp
          <div class="card-image">
            <img src="{{asset('Admin/Projects/' . $project->image)}}" class="card-img-top" alt="{{$project->image}}">
          </div>
          <div class="card-body">
            <p class="card-text text-white">{{$project->title}}</p>
            <span class="d-none">{{$project->disc}}</span>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- End Projects -->

  <!-- Start Clients -->
  <section class="clients  check-scroll" id="clients">
    <h2 class="special-title">Clients</h2>
    <div class="container">
      <div class="owl-carousel clients-carousel">
        @foreach($clients as $client)
        <div class="item">
          <img src="{{asset('Admin/Clients/' .$client->image)}}" alt="{{$client->image}}">
        </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- End Clients -->

  <!-- Start CopyRight -->
  <section class="copyright  check-scroll" id="copyright">
    <h2 class="special-title">&copy; Copyright</h2>
    <div class="container">
        @if(isset($copyright->name))
        <pre class="fs-5 text-center">{{$copyright->name}}</pre>
        @endif
    </div>
  </section>
  <!-- End CopyRight -->

  <!-- Start Contact -->
  <section class="contact check-scroll" id="contact">
    <div class="container">
      <div class="row">
        @if($get_data->status_v == 1 || $get_data->status_p == 1)
        <div class="col-md-6 py-5">
        @else
        <div class="col-md-8 offset-md-2 py-5">
        @endif
          <div class="row">
            <h2 class="special-title">Contact</h2>
            <div class="col-12">
              <div class="mb-3">
                @csrf
                <label for="user_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="user_name" placeholder="please Enter Your Name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="user_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="user_email" placeholder="please Enter Your Email">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="user_phone" class="form-label">Phone</label>
                <input type="text" maxlength="11" class="form-control" id="user_phone" placeholder="please Enter Your Phone">
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" rows="8" placeholder="please Enter Your Message"></textarea>
              </div>
            </div>
            <div class="d-grid gap-2 col-12 col-lg-4 col-md-6 mx-auto">
                <button class="clicked" id="save_message" type="button">Send</button>
            </div>
          </div>
        </div>
        @if($get_data->status_v == 1 || $get_data->status_p == 1)
        <div class="col-md-6 stats py-5">
          <h2 class="special-title">Awesome Stats</h2>
          @if(asset($get_data->status_v))
            @if($get_data->status_v == 1)
            <div class="box">
              <i class="fa-solid fa-users"></i>
              <h3 class="count-number">{{$get_data->visitors + 1}}</h3>
              <h4 class="gradi-color">Users</h4>
            </div>
            @endif
          @endif
          @if(asset($get_data->status_p))
            @if($get_data->status_p == 1)
          <div class="box">
            <i class="fa-solid fa-gears"></i>
            <h3 class="count-number">{{$get_data->projects}}</h3>
            <h4 class="gradi-color">Projects</h4>
          </div>
            @endif
          @endif
        </div>
        @endif
      </div>
    </div>
  </section>
  <!-- End Contact -->

  <!-- Start Footer -->
  <footer class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 left-footer">
          <p>Copyright &copy; @if(isset($about->name)){{$about->name}}@endif</p>
        </div>
        <div class="col-sm-6">
          <div class="right-footer">
            @if(isset($social->facebook))
            <a href="{{$social->facebook}}" class="text-decoration-none"><i class="fa-brands fa-fw fa-facebook-f"></i></a>
            @endif
            @if(isset($social->whats))
            <a href="https://api.whatsapp.com/send?phone={{$social->whats}}" class="text-decoration-none"><i class="fa-brands fa-fw fa-whatsapp"></i></a>
            @endif
            @if(isset($social->gmail))
            <a href="mailto:{{$social->gmail}}" class="text-decoration-none"><i class="fa-brands fa-google-plus-g"></i></a>
            @endif
            @if(isset($social->linkedin))
            <a href="{{$social->linkedin}}" class="text-decoration-none"><i class="fa-brands fa-fw fa-linkedin-in"></i></a>
            @endif
            @if(isset($social->twitter))
            <a href="{{$social->twitter}}" class="text-decoration-none"><i class="fa-brands fa-fw fa-twitter"></i></a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->

  <!-- Start Up Button -->
  <button class="up">
    <i class="fa-solid fa-chevron-up"></i>
  </button>
  <!-- End Up Button -->

  <script>
let _token=$("input[name=\"_token\"]").val();$("body").on("click","#save_message",function(){let a=$("#user_name").val(),b=$("#user_email").val(),c=$("#user_phone").val(),d=$("#message").val();action="save";$("tbody").html();$.ajax({url:"{{route('save.message')}}",method:"post",enctype:"multipart/form-data",data:{_token,name:a,email:b,phone:c,message:d},success:function(a){"true"==a.status&&(Swal.fire({position:"center",icon:"success",title:"Saved Message",showConfirmButton:!1,timer:1500}),$("#user_name").val(""),$("#user_email").val(""),$("#user_phone").val(""),$("#message").val(""))}})});const projectModal=document.getElementById("project_modal");projectModal.addEventListener("show.bs.modal",a=>{const b=a.relatedTarget,c=b.querySelector("p").textContent,d=b.querySelector("span").textContent,e=b.dataset.id;document.getElementById("modal_title").textContent=c,document.getElementById("project_disc").textContent=d,$.ajax({url:"{{route('get.sections')}}",method:"post",enctype:"multipart/form-data",data:{_token,id:e},success:function(a){if("true"===a.status){let b="";b+=`<li class="nav-item">
                <button class="nav-link" projectid='${e}' data-id="all" type="button"  data-bs-toggle="pill" >all</button>
              </li>`;let c=document.getElementById("details-tab");a.sections.forEach(a=>{b+=`<li class="nav-item">
                <button class="nav-link" projectid='${e}' data-id="${a.id}" type="button"  data-bs-toggle="pill" >${a.name}</button>
              </li>`}),c.innerHTML=b,c.querySelectorAll(".nav-link")[0].click()}}})}),$("body").on("click","#details-tab .nav-link",function(){let a=$(this).attr("data-id"),b=$(this).attr("projectid"),c="";$.ajax({url:"{{route('get.details')}}",method:"post",enctype:"multipart/form-data",data:{_token,id:a,pro:b},success:function(a){if("true"===a.status){for(let b=0;b<a.details.length;b++)c+=`<a href="{{asset('Admin/Details/${a.details[b].image}')}}">
                        <img src="{{asset('Admin/Details/${a.details[b].image}')}}">
            </a>`;$("#lightgallery").html(c),lightGallery(document.getElementById("lightgallery"))}}})}),projectModal.addEventListener("hidden.bs.modal",()=>{document.getElementById("lightgallery").innerHTML=""});let clinetOwl=$(".clients-carousel");clinetOwl.owlCarousel({loop:!0,margin:10,autoplay:!0,autoplayTimeout:2e3,autoplayHoverPause:!0,nav:!0,responsive:{0:{items:1},576:{items:2},768:{items:4},992:{items:5}}});
  </script>
  @stop
