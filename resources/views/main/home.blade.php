@extends('layouts.main')
@section('content')
    <!-- End Navbar -->
    <header>
      <div class="container">
        <div class="home-content">
          @if(isset($about->name))
          <h1>I'm <span>{{$about->name}}</span></h1>
          @endif
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis a ducimus illum namnobis officia
            pariatur minima dolorum nemo cum rem deleniti iusto maxime, ex voluptatum doloremque suscipit laudantium
            est!
          </p>
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
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="discription">
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
                <div class="tab-pane fade show active" id="pills-sec1" role="tabpanel" tabindex="0"> Sec 1 </div>
                <div class="tab-pane fade" id="pills-sec2" role="tabpanel" tabindex="0"> Sec 2 </div>
                <div class="tab-pane fade" id="pills-sec3" role="tabpanel" tabindex="0"> Sec 3 </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>l,
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Start Services -->
  <section id="services" class="services py-5">
    <h2 class="special-title">Services</h2>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4">
          <div class="service">
            <div class="image">
              <img src="./imgs/ser1.jpg" alt="">
            </div>
            <h3> tell us your idea</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta animi iusto optio veniam facere explicabo.
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service">
            <div class="image">
              <img src="./imgs/ser2.png" alt="">
            </div>
            <h3> tell us your idea</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta animi iusto optio veniam facere explicabo.
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service">
            <div class="image">
              <img src="./imgs/ser3.png" alt="">
            </div>
            <h3> tell us your idea</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta animi iusto optio veniam facere explicabo.
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service">
            <div class="image">
              <img src="./imgs/ser4.jpg" alt="">
            </div>
            <h3> tell us your idea</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta animi iusto optio veniam facere explicabo.
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service">
            <div class="image">
              <img src="./imgs/ser1.jpg" alt="">
            </div>
            <h3> tell us your idea</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta animi iusto optio veniam facere explicabo.
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service">
            <div class="image">
              <img src="./imgs/ser2.png" alt="">
            </div>
            <h3> tell us your idea</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta animi iusto optio veniam facere explicabo.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Services -->

  <!-- Start Projects -->
  <section id='projects' class="projects py-5">
    <h2 class="special-title">Projects</h2>

    <div class="container">
      <ul class="categories">
        <li class="category active" data-filter="all">all</li>
        <li class="category" data-filter="drone">drone</li>
        <li class="category" data-filter="electric">electric</li>
        <li class="category" data-filter="print">print</li>
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
  <section class="clients py-5" id="clients">
    <h2 class="special-title">Clients</h2>
    <div class="container">
      <div class="clients-container">
        <img src="./imgs/clients/client1.png" alt="client1">
        <img src="./imgs/clients/client2.png" alt="client2">
        <img src="./imgs/clients/client3.png" alt="client3">
        <img src="./imgs/clients/client4.png" alt="client4">
        <img src="./imgs/clients/client5.png" alt="client5">
        <img src="./imgs/clients/client6.png" alt="client6">
        <img src="./imgs/clients/client7.png" alt="client7">
        <img src="./imgs/clients/client8.png" alt="client8">
        <img src="./imgs/clients/client9.png" alt="client9">
        <img src="./imgs/clients/client10.png" alt="client10">
      </div>
    </div>
  </section>
  <!-- End Clients -->

  <!-- Start Contact -->
  <section class="contact py-5 bg-light" id="contact">
    <h2 class="special-title">Contact</h2>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="mb-3">
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
            <input type="text" maxlength="11" class="form-control" id="user_phone"
              placeholder="please Enter Your Phone">
          </div>
        </div>
        <div class="col-12">
          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" rows="8" placeholder="please Enter Your Message"></textarea>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Contact -->

  <section class="copyright py-5" id="copyright">
    <h2 class="special-title">Copyright</h2>
    <div class="container">
      <p class="fs-4 text-center lh-lg">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit.<br />
        Quasi officiis modi dicta fuga ex adipisci, quisquam<br />
        pariatur, soluta est harum natus neque, illo ab laboriosam nobis alias! Eligendi, sit quam?</p>
    </div>
  </section>
<!-- Start Footer -->
    <footer class="p-4 bg-dark text-center">
    <i class="fa-brands fa-fw fa-facebook-f"></i>
    <i class="fa-brands fa-fw fa-whatsapp"></i>
    <i class="fa-solid fa-fw fa-at"></i>
    <i class="fa-brands fa-fw fa-linkedin-in"></i>
    <i class="fa-brands fa-fw fa-twitter"></i>
  </footer>
  <!-- End Footer -->
  @stop