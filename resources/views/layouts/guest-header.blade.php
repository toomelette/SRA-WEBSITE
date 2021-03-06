<header class="header_area">
  <div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span> <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse offset content-margin" id="navbarSupportedContent">
          <ul class="nav navbar-nav menu_nav mr-auto">

            <li class="nav-item">
              <a class="nav-link" href="https://www.gov.ph/" target="__blank">GOVPH</a>
            </li>

            <li class="nav-item active">
              <a class="nav-link" href="{{ route('guest.home.index') }}">Home</a>
            </li>

            <li class="nav-item submenu dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                About us
              </a>
              <ul class="dropdown-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('guest.about_us.mandate') }}">Mandate</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('guest.about_us.services') }}">Services</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('guest.about_us.charter') }}">Charter</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('guest.about_us.org_chart') }}">Organizational Chart</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('guest.about_us.corp_objectives') }}">Corp. Objectives</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('guest.about_us.history') }}">History</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('guest.about_us.officials') }}">Officials</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('guest.about_us.administrators') }}">Administrators</a>
                </li>
              </ul>
            </li>

            <li class="nav-item submenu dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Downloads
              </a>
              <ul class="dropdown-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('guest.downloads.application_forms') }}">Application Forms</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('guest.downloads.sms_forms') }}">SMS Forms</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('guest.downloads.historical_data') }}">Historical Data</a>
                </li>
              </ul>
            </li>

            <li class="nav-item submenu dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                About Sugarcane
              </a>
              <ul class="dropdown-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('guest.about_sugarcane.varieties') }}">Sugarcane Varieties</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('guest.about_sugarcane.researches') }}">Researches</a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('guest.stakeholders.index') }}">Stakeholders</a>
            </li>

            {{-- <li class="nav-item submenu dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Industry Update <i class="ti-angle-down"></i>
              </a>
              <ul class="dropdown-menu">
                <li class="nav-item">
                  <a class="nav-link" href="">Sugar Supply and Demand Situation</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Millsite Prices</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Bioethanol Reference Price</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Metro Manila Prices</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Sugar Statistics</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Road Map</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Expired Import Clearances</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Milling Schedule</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Block Farm</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Crop Estimates and Statistics</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Vacant Positions</a>
                </li>
              </ul>
            </li>

            <li class="nav-item submenu dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Policy <i class="ti-angle-down"></i>
              </a>
              <ul class="dropdown-menu">
                <li class="nav-item">
                  <a class="nav-link" href="">Sugar Order</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Circular Letter</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Memorandum Order</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Memorandum Circular</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Molasses Order</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Muscovado Order</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href=""><p>General Administrative Order</p></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Sugar Laws</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Bioenergy</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">ASEAN</a>
                </li>
              </ul>
            </li>

            <li class="nav-item submenu dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                SIDA <i class="ti-angle-down"></i>
              </a>
              <ul class="dropdown-menu">
                <li class="nav-item">
                  <a class="nav-link" href="">SIDA Updates</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">SIDA Guidelines</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">SIDA Laws</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">SIDA Fund Utilization</a>
                </li>
              </ul>
            </li>
            
            <li class="nav-item submenu dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Bid Corner <i class="ti-angle-down"></i>
              </a>
              <ul class="dropdown-menu">
                <li class="nav-item">
                  <a class="nav-link" href="">Invitation to Bid</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Supplemental Bid</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Notice of Award</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Notice to Proceed</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Philgeps Posting</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Minutes of the Bid</a>
                </li>
              </ul>
            </li> --}}
            
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>


<section class="sample-text-area content-margin">
  
  <div class="container-fluid" style="margin-top:-30px; margin-bottom:-80px;">
    <div class="single_feature">
      <div class="row">
        <div>
          <img src="{{ asset('images/sra-logo.png') }}" style="height:85px;">
        </div>
        <div class="col-md-6">
          <h3>Sugar Regulatory Administration</h3>
          <span> Sugar Center Bldg., North Avenue, Diliman, Quezon City </span><br>
          <span> (02) 455-3524 | (02) 455-2135 | (02) 455-1589 </span>
        </div>
        <div class="col-md-4">
          <img src="{{ asset('images/food-secure-slogan.svg') }}" style="height:75px;">
        </div>
      </div>
    </div>
  </div>

</section>