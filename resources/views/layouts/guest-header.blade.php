

<header class="header_area">
  <div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span> <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
          <ul class="nav navbar-nav menu_nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="https://www.gov.ph/" target="__blank">GOVPH</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('guest.home.index') }}">Home</a>
            </li>
            <li class="nav-item submenu dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Pages
              </a>
              <ul class="dropdown-menu">
                <li class="nav-item">
                  <a class="nav-link" href="courses.html">Courses</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="course-details.html">
                    Course Details
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="elements.html">Elements</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>

<section class="sample-text-area">
  <div class="container single_feature">
    <div class="row">
      <div>
        <img src="{{ asset('images/sra-logo.png') }}" style="height:85px;">
      </div>
      <div class="col-md-6">
        <h3>Sugar Regulatory Administration</h3>
        <span> Sugar Center Bldg., North Avenue, Diliman, Quezon City </span><br>
        <span> (02) 455-3524 | (02) 455-2135 | (02) 455-1589 </span>
      </div>
      <div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="">
          <img src="{{ asset('images/transparency-seal.png') }}" style="height:85px; ">
        </a>
      </div>
    </div>
  </div>
</section>