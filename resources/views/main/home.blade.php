@extends('layouts.main')
@section('content')
<!-- Start Loader -->
<div class="loading">
  <div class="dot"></div>
  <div class="dot"></div>
  <div class="dot"></div>
</div>
<!-- End Loader -->

<main>
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-md">
      <div class="container">
        <a class="navbar-brand" href="#">
            @if(isset($about->image))
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
                <p id="project_disc">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consectetur blanditiis totam nemo possimus
                  dolor accusantium quia quo esse numquam placeat, ducimus dignissimos delectus ea optio molestiae
                  minima beatae inventore quae?</p>
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
  <section id="services" class="services py-5 check-scroll">
    <h2 class="special-title">Services</h2>
    <div class="container">
    <div id="servicesCarousel" class="carousel" data-bs-ride="carousel">
      <div class="carousel-inner">
        @foreach($services as $service)
        <div class="carousel-item">
          <div class="service">
            <div class="image">
              <img src="{{asset('Admin/services/' . $service->image)}}" alt="">
            </div>
            <h3>{{$service->title}}</h3>
            <p>{{$service->disc}}</p>
          </div>
        </div>
        @endforeach

      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#servicesCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#servicesCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    </div>
  </section>
  <!-- End Services -->

  <!-- Start Projects -->
  <section id='projects' class="projects py-5 check-scroll">
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
  <section class="clients py-5 check-scroll" id="clients">
    <h2 class="special-title">Clients</h2>
    <div class="container">
          <div id="clientCarousel" class="carousel" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{asset('Admin/Clients/1660401145115.png')}}" alt="">
        </div>
        @foreach($clients as $client)
        <div class="carousel-item">
          <img src="{{asset('Admin/Clients/'.$client->image)}}" alt="$client->image">
        </div>
        @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#clientCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#clientCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    </div>
  </section>
  <!-- End Clients -->

  <!-- Start CopyRight -->
  <section class="copyright py-5 check-scroll" id="copyright">
    <h2 class="special-title">&copy; Copyright</h2>
    <div class="container">
        @if(isset($copyright->name))
        <pre class="fs-5 text-center">{{$copyright->name}}</pre>
        @endif
    </div>
  </section>
  <!-- End CopyRight -->

  <!-- Start Contact -->
  <section class="contact py-5 check-scroll" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-6 stats">
          <h2 class="special-title">Awesome Stats</h2>
          <div class="box">
            <i class="fa-solid fa-users"></i>
            <h3 class="count-number">50</h3>
            <h4 class="gradi-color">Users</h4>
          </div>
          <div class="box">
            <i class="fa-solid fa-gears"></i>
            <h3 class="count-number">50</h3>
            <h4 class="gradi-color">Projects</h4>
          </div>
        </div>
        <div class="col-md-6">
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
                <button class="btn btn-primary clicked" id="save_message" type="button">Send</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Contact -->

  <!-- Start Footer -->
  <footer class="p-4 bg-dark text-center">
    @if(isset($social->facebook))
    <a href="{{$social->facebook}}" class="text-decoration-none"><i class="fa-brands fa-fw fa-facebook-f"></i></a>
    @endif
    @if(isset($social->whats))
    <a href="https://api.whatsapp.com/send?phone={{$social->whats}}" class="text-decoration-none"><i class="fa-brands fa-fw fa-whatsapp"></i></a>
    @endif
    @if(isset($social->gmail))
    <a href="mailto:{{$social->gmail}}" class="text-decoration-none"><i class="fa-solid fa-fw fa-at"></i></a>
    @endif
    @if(isset($social->linkedin))
    <a href="{{$social->linkedin}}" class="text-decoration-none"><i class="fa-brands fa-fw fa-linkedin-in"></i></a>
    @endif
    @if(isset($social->twitter))
    <a href="{{$social->twitter}}" class="text-decoration-none"><i class="fa-brands fa-fw fa-twitter"></i></a>
    @endif
  </footer>
  <!-- End Footer -->

  <!-- Start Up Button -->
  <button class="up">
    <i class="fa-solid fa-chevron-up"></i>
  </button>
  <!-- End Up Button -->

  <script>
    let _token = $('input[name="_token"]').val();
    $('body').on('click', '#save_message',function() {
        let name    =$('#user_name').val();
        let email   =$('#user_email').val();
        let phone   =$('#user_phone').val();
        let message =$('#message').val();
        action = 'save';
        let html = $('tbody').html();
        $.ajax({
            url     :"{{route('save.message')}}",
            method  : 'post',
            enctype : "multipart/form-data",
            data:
            {
              _token,
              name,
              email,
              phone,
              message,
            },
            success: function (data)
            {
              if (data.status == 'true') {
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Saved Message',
                  showConfirmButton: false,
                  timer: 1500
                })
                $('#user_name').val('');
                $('#user_email').val('');
                $('#user_phone').val('');
                $('#message').val('');
              }
            }
        });
    });
    const projectModal = document.getElementById("project_modal");
    projectModal.addEventListener("show.bs.modal", (event) => {
      const button = event.relatedTarget;
      const projectTitle = button.querySelector('p').textContent;
      const projectDisc = button.querySelector('span').textContent;
      const projectId = button.dataset.id
      document.getElementById('modal_title').textContent = projectTitle
      document.getElementById('project_disc').textContent = projectDisc;
      $.ajax({
        url     :"{{route('get.sections')}}",
        method  : 'post',
        enctype : "multipart/form-data",
        data:
        {
          _token,
          id:projectId,
        },
        success: function (data)
        {
          if (data.status === 'true') {
            let items = '';
            let pillList = document.getElementById('details-tab')
            data.sections.forEach(sec => {
              items += `<li class="nav-item">
                <button class="nav-link" data-id="${sec.id}" type="button"  data-bs-toggle="pill" >${sec.name}</button>
              </li>`;
            });
            pillList.innerHTML = items;
            pillList.querySelectorAll('.nav-link')[0].click();
          }
        }
      });
    });

    $('body').on('click', "#details-tab .nav-link", function() {
      let id = $(this).attr('data-id');
      let images = '';
      $.ajax({
        url     :"{{route('get.details')}}",
        method  : 'post',
        enctype : "multipart/form-data",
        data:
        {
          _token,
          id,
        },
        success: function (data) {
          if (data.status === 'true') {
            for(let count= 0 ; count<data.details.length ; count++){
              images += `<a href="{{asset('Admin/Details/${data.details[count].image}')}}">
                        <img src="{{asset('Admin/Details/${data.details[count].image}')}}">
            </a>`;
            }
            $('#lightgallery').html(images);
            lightGallery(document.getElementById("lightgallery"));
          }
        }
      });
    });
    projectModal.addEventListener('hidden.bs.modal', event => {
      document.getElementById('lightgallery').innerHTML = '';
    });
  </script>
  @stop
