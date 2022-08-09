@extends('layouts.main')
@section('content')
<main>
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-md">
      <div class="container">
        <a class="navbar-brand" href="#">
            @if(isset($about->image))
            <img src="{{asset('Admin/About/' . $about->logo)}}" alt="" width="80" height="50">
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
          <ul class="navbar-nav mb-2 mb-lg-0">
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
              <a class="nav-link" href="#contact" data-scroll="contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#copyright" data-scroll="copyright">Copyright</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <header class="check-scroll" id='Home'>
      <div class="container">
        <div class="home-content">
          @if(isset($about->name))
          <h1>I'm <span>{{$about->name}}</span></h1>
          @endif
          @if(isset($about->disc))
          <p>{{$about->disc}}</p>
          @endif
        </div>
        <div class="home-image">
            @if(isset($about->image))
            <img src="{{asset('Admin/About/' . $about->image)}}" alt="About">
            @endif
        </div>
      </div>
    </header>
  </main>
  <!-- Modal -->
  <div class="modal fade modal-xl" id="project_modal" tabindex="-1" aria-labelledby="project_modal_label"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-5">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="discription text-center">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consectetur blanditiis totam nemo possimus
                  dolor accusantium quia quo esse numquam placeat, ducimus dignissimos delectus ea optio molestiae
                  minima beatae inventore quae?</p>
              </div>
            </div>
            <div class="col-md-6">
              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-sec1-tab" data-bs-toggle="pill" data-bs-target="#pills-sec1"
                    type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-sec2-tab" data-bs-toggle="pill" data-bs-target="#pills-sec2"
                    type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-sec3-tab" data-bs-toggle="pill" data-bs-target="#pills-sec3"
                    type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
                </li>
              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-sec1" role="tabpanel" tabindex="0">
                  <div class="image-container" id="lightgallery">
                    <a href="{{asset('Admin/Details/1659811039191.jpg')}}">
                        <img src="{{asset('Admin/Details/1659811039191.jpg')}}">
                    </a>
                    <a href="{{asset('Admin/Details/1659986354987.jpg')}}">
                        <img src="{{asset('Admin/Details/1659986354987.jpg')}}">
                    </a>
                    <a href="{{asset('Admin/Details/1659910817493.jpg')}}">
                        <img src="{{asset('Admin/Details/1659910817493.jpg')}}">
                    </a>
                  </div>
                </div>
                <div class="tab-pane fade" id="pills-sec2" role="tabpanel" tabindex="0">
                </div>
                <div class="tab-pane fade" id="pills-sec3" role="tabpanel" tabindex="0">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Start Services -->
  <section id="services" class="services pb-5 check-scroll">
    <h2 class="special-title">Services</h2>
    <div class="container">
      <div class="row align-items-center">
        @foreach($services as $service)
        <div class="col-md-4">
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
    </div>
  </section>
  <!-- End Services -->

  <!-- Start Projects -->
  <section id='projects' class="projects pb-5 check-scroll">
    <h2 class="special-title">Projects</h2>
    <div class="container">
      <ul class="categories">
        <li class="category active" value='all' data-filter="all">all</li>
        @foreach($groups as $group)
        <li class="category" value='{{$group->id}}' data-filter="{{$group->group}}">{{$group->group}}</li>
        @endforeach
      </ul>
      <div class="cards-container">
        <div class="card mt-3 shadow-lg border-0 cards drone" data-bs-toggle="modal" data-bs-target="#project_modal">
          <div class="card-image">
            <img src="./imgs/drone1.jpg" class="card-img-top" alt="drone1">
          </div>
          <div class="card-body bg-dark">
            <p class="card-text text-white">Some quick example text to build on the card title and make up the bulk of
              the
              card's
              content.
            </p>
          </div>
        </div>
        <div class="card mt-3 shadow-lg border-0 cards drone" data-bs-toggle="modal" data-bs-target="#project_modal">
          <div class="card-image">
            <img src="./imgs/drone2.jpg" class="card-img-top" alt="drone2">
          </div>
          <div class="card-body bg-dark">
            <p class="card-text text-white">Some quick example text to build on the card title and make up the bulk of
              the
              card's
              content.
            </p>
          </div>
        </div>
        <div class="card mt-3 shadow-lg border-0 cards electric" data-bs-toggle="modal" data-bs-target="#project_modal">
          <div class="card-image">
            <img src="./imgs/elec1.jpg" class="card-img-top" alt="elec1">
          </div>
          <div class="card-body bg-dark">
            <p class="card-text text-white">Some quick example text to build on the card title and make up the bulk of
              the
              card's
              content.
            </p>
          </div>
        </div>
        <div class="card mt-3 shadow-lg border-0 cards electric" data-bs-toggle="modal" data-bs-target="#project_modal">
          <div class="card-image">
            <img src="./imgs/elec2.jpg" class="card-img-top" alt="elec2">
          </div>
          <div class="card-body bg-dark">
            <p class="card-text text-white">Some quick example text to build on the card title and make up the bulk of
              the
              card's
              content.
            </p>
          </div>
        </div>
        <div class="card mt-3 shadow-lg border-0 cards print" data-bs-toggle="modal" data-bs-target="#project_modal">
          <div class="card-image">
            <img src="./imgs/print1.jpg" class="card-img-top" alt="print1">
          </div>
          <div class="card-body bg-dark">
            <p class="card-text text-white">Some quick example text to build on the card title and make up the bulk of
              the
              card's
              content.
            </p>
          </div>
        </div>
        <div class="card mt-3 shadow-lg border-0 cards print" data-bs-toggle="modal" data-bs-target="#project_modal">
          <div class="card-image">
            <img src="./imgs/print2.jpg" class="card-img-top" alt="print2">
          </div>
          <div class="card-body bg-dark">
            <p class="card-text text-white">Some quick example text to build on the card title and make up the bulk of
              the
              card's
              content.
            </p>
          </div>
        </div>
        <div class="card mt-3 shadow-lg border-0 cards print" data-bs-toggle="modal" data-bs-target="#project_modal">
          <div class="card-image">
            <img src="./imgs/print3.jpg" class="card-img-top" alt="print3">
          </div>
          <div class="card-body bg-dark">
            <p class="card-text text-white">Some quick example text to build on the card title and make up the bulk of
              the
              card's
              content.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Projects -->

  <!-- Start Clients -->
  <section class="clients pb-5 check-scroll" id="clients">
    <h2 class="special-title">Clients</h2>
    <div class="container">
      <div class="clients-container">
        @foreach($clients as $client)
        <img src="{{asset('Admin/Clients/'.$client->image)}}" alt="client1">
        @endforeach
      </div>
    </div>
  </section>
  <!-- End Clients -->

  <!-- Start Contact -->
  <section class="contact pb-5 bg-light check-scroll" id="contact">
    <h2 class="special-title">Contact</h2>
    <div class="container">
      <div class="row">
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
        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-success clicked" id="save_message" type="button">Save</button>
        </div>
      </div>
    </div>
  </section>
  <!-- End Contact -->

  <!-- Start CopyRight -->
  <section class="copyright pb-5 check-scroll" id="copyright">
    <h2 class="special-title">&copy; Copyright</h2>
    <div class="container">
        @if(isset($copyright->name))
        <pre class="fs-5 text-center">{{$copyright->name}}</pre>
        @endif
    </div>
  </section>
  <!-- End CopyRight -->

  <!-- Start Footer -->
  <footer class="p-4 bg-dark text-center">
    @if(isset($social->facebook))
    <a href="{{$social->facebook}}"><i class="fa-brands fa-fw fa-facebook-f"></i></a>
    @endif
    @if(isset($social->whats))
    <a href="https://api.whatsapp.com/send?phone={{$social->whats}}"><i class="fa-brands fa-fw fa-whatsapp"></i></a>
    @endif
    @if(isset($social->gmail))
    <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{$social->gmail}}"><i class="fa-solid fa-fw fa-at"></i></a>
    @endif
    @if(isset($social->linkedin))
    <a href="{{$social->linkedin}}"><i class="fa-brands fa-fw fa-linkedin-in"></i></a>
    @endif
    @if(isset($social->twitter))
    <a href="{{$social->twitter}}"><i class="fa-brands fa-fw fa-twitter"></i></a>
    @endif
  </footer>
  <!-- End Footer -->

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
                $('#user_name').val(' ');
                $('#user_email').val(' ');
                $('#user_phone').val(' ');
                $('#message').val(' ');
              }
            }
        });
    });
  </script>
  @stop
