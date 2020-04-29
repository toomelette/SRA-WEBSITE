{{-- Side Bar --}}
<div class="col-lg-3">
  <div class="blog_right_sidebar">

    {{-- Industry Update --}}
    <aside class="single_sidebar_widget post_category_widget">
      <h4 class="widget_title">Industry Update</h4>
      <ul class="list cat-list">
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.industry_update.ssads') }}">Sugar Supply and Demand Situation</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.industry_update.millsite_prices') }}">Millsite Prices</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.industry_update.ber_price') }}">Bioethanol Reference Price</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.industry_update.mm_prices') }}">Metro Manila Prices</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.industry_update.sugar_statistics') }}">Sugar Statistics</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.industry_update.roadmap') }}">Road Map</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.industry_update.eic') }}">Expired Import Clearances</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.industry_update.milling_schedule') }}">Milling Schedule</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.industry_update.block_farm') }}">Block Farm</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.industry_update.ces') }}">Crop Estimates and Statistics</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.industry_update.vacant_position') }}">Vacant Positions</a>
        </li>
      </ul>
      <div class="br"></div>
    </aside>

    {{-- Policy --}}
    <aside class="single_sidebar_widget post_category_widget">
      <h4 class="widget_title">Policy</h4>
      <ul class="list cat-list">
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.policies.sugar_order') }}">Sugar Order</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.policies.circular_letter') }}">Circular Letter</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.policies.memo_order') }}">Memorandum Order</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.policies.memo_cir') }}">Memorandum Circular</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.policies.molasses_order') }}">Molasses Order</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.policies.muscovado_order') }}">Muscovado Order</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.policies.ga_order') }}"><p>General Administrative Order</p></a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.policies.sugar_law') }}">Sugar Laws</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.policies.bioenergy') }}">Bioenergy</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.policies.asean') }}">ASEAN</a>
        </li>
      </ul>
      <div class="br"></div>
    </aside>

    {{-- SIDA --}}
    <aside class="single_sidebar_widget post_category_widget">
      <h4 class="widget_title">SIDA</h4>
      <ul class="list cat-list">
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.sida.sida_updates') }}">SIDA Updates</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.sida.sida_guideline') }}">SIDA Guidelines</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.sida.sida_law') }}">SIDA Laws</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.sida.sida_fu') }}">SIDA Fund Utilization</a>
        </li>
      </ul>
      <div class="br"></div>
    </aside>

    {{-- Bid Corner --}}
    <aside class="single_sidebar_widget post_category_widget">
      <h4 class="widget_title">Bid Corner</h4>
      <ul class="list cat-list">
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.bid.itb') }}">Invitation to Bid</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.bid.supp_bid') }}">Supplemental Bid</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.bid.noa') }}">Notice of Award</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.bid.ntp') }}">Notice to Proceed</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.bid.philgeps_posting') }}">Philgeps Posting</a>
        </li>
        <li>
          <a class="d-flex justify-content-between" href="{{ route('guest.bid.mob') }}">Minutes of the Bid</a>
        </li>
      </ul>
      <div class="br"></div>
    </aside>

    {{-- Logo's --}}
    {{-- <aside class="single_sidebar_widget author_widget" style="margin-bottom:10px;">  
      <a href="">
        <img src="{{ asset('images/citizen-charter.png') }}" style="height:200px; margin-right:23px;">
      </a><br>
    </aside>
    <aside class="single_sidebar_widget author_widget" style="margin-bottom:10px;">
      <a href="">
        <img src="{{ asset('images/transparency-seal.png') }}" style="height:150px; ">
      </a><br>
    </aside>
    <aside class="single_sidebar_widget author_widget" style="margin-bottom:10px;">
      <a href="">
        <img src="{{ asset('images/gcg-logo.png') }}" style="height:160px; ">
      </a><br>
    </aside>
    <aside class="single_sidebar_widget author_widget" style="margin-bottom:10px;">
      <a href="">
        <img src="{{ asset('images/foi-logo.png') }}" style="height:170px; ">
      </a><br>
    </aside>
    <aside class="single_sidebar_widget author_widget" style="margin-bottom:10px;">
      <a href="">
        <img src="{{ asset('images/iso-sra-qr-code.jpg') }}" style="height:90px; ">
      </a><br>
    </aside>
    <div class="br"></div> --}}

    {{-- News --}}
    {{-- <aside class="single_sidebar_widget popular_post_widget">
      <h3 class="widget_title">News</h3>
      <div class="media post_item">
        <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
        <div class="media-body">
            <a href="blog-details.html">
                <h3>Space The Final Frontier</h3>
            </a>
            <p>02 Hours ago</p>
        </div>
      </div>
      <div class="media post_item">
        <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
        <div class="media-body">
            <a href="blog-details.html">
                <h3>Space The Final Frontier</h3>
            </a>
            <p>02 Hours ago</p>
        </div>
      </div>
      <div class="media post_item">
        <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
        <div class="media-body">
            <a href="blog-details.html">
                <h3>Space The Final Frontier</h3>
            </a>
            <p>02 Hours ago</p>
        </div>
      </div>
      <div style="margin-top: 20px;">
        <a href="#" style="text-align: center;">
          <p style="color:#002347;">View All News <i class="ti-arrow-right ml-1"></i></p>
        </a>
      </div>
    </aside>
    <div class="br"></div> --}}

    {{-- Announcements --}}
    {{-- <aside class="single_sidebar_widget popular_post_widget">
      <h3 class="widget_title">Announcements</h3>
      <div class="media post_item">
        <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
        <div class="media-body">
            <a href="blog-details.html">
                <h3>Space The Final Frontier</h3>
            </a>
            <p>02 Hours ago</p>
        </div>
      </div>
      <div class="media post_item">
        <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
        <div class="media-body">
            <a href="blog-details.html">
                <h3>Space The Final Frontier</h3>
            </a>
            <p>02 Hours ago</p>
        </div>
      </div>
      <div class="media post_item">
        <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
        <div class="media-body">
            <a href="blog-details.html">
                <h3>Space The Final Frontier</h3>
            </a>
            <p>02 Hours ago</p>
        </div>
      </div>
      <div style="margin-top: 20px;">
        <a href="#" style="text-align: center;">
          <p style="color:#002347;">View All Announcements <i class="ti-arrow-right ml-1"></i></p>
        </a>
      </div>
    </aside>
    <div class="br"></div>
--}}
    {{-- Newsletter --}}
    {{-- <aside class="single_sidebar_widget popular_post_widget">
      <h3 class="widget_title">Newsletter</h3>
      <div class="media post_item">
        <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
        <div class="media-body">
            <a href="blog-details.html">
                <h3>Space The Final Frontier</h3>
            </a>
            <p>02 Hours ago</p>
        </div>
      </div>
      <div class="media post_item">
        <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
        <div class="media-body">
            <a href="blog-details.html">
                <h3>Space The Final Frontier</h3>
            </a>
            <p>02 Hours ago</p>
        </div>
      </div>
      <div class="media post_item">
        <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
        <div class="media-body">
            <a href="blog-details.html">
                <h3>Space The Final Frontier</h3>
            </a>
            <p>02 Hours ago</p>
        </div>
      </div>
      <div style="margin-top: 20px;">
        <a href="#" style="text-align: center;">
          <p style="color:#002347;">View All Newsletters <i class="ti-arrow-right ml-1"></i></p>
        </a>
      </div>
    </aside>
    <div class="br"></div> --}}

  </div>
</div>