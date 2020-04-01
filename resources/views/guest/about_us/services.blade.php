@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area">
    <div class="container">
        <div class="row">
          <div class="col-lg-8">
            {{ Breadcrumbs::render('aboutUs_services') }}
          </div>
          <div class="col-lg-8 posts-list">
            <div class="single-post row">


              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="text-heading title_color">SERVICE PLEDGE</h3>
                <p class="sample-text">
                  <b>W</b>e, the Officials and Employees of the Sugar Regulatory Administration, in the pursuit of high quality standards of
                  service to our clientele, do hereby pledge to commit ourselves to perform our duties and responsibilities with utmost
                  integrity, competence and dedication in order to work for the upliftment of the social and economic status of the sugar
                  industry and its workers.
                </p>
                <p class="sample-text">
                  <b>W</b>e offer our collective and relentless efforts to subscribe to the thrust of our government towards improving the
                  performance and cost efficiency of our agency in order to help elevate the sugar industry in the arena of global
                  competitiveness.
                </p>
                <p class="sample-text">
                  <b>W</b>e adhere to the principle of transparency and accountability. We will see to it that national interest prevails over
                  personal motives and eradicate graft and corruption.
                </p>
                <p class="sample-text">
                  <b>W</b>e support the government's goal in sustaining the development of the sugar industry in order to generate more
                  job opportunities and help develop the countryside by undertaking effective and relevant regulatory functions and
                  research and extension programs in coordination with the private sector that our clients could benefit from.
                </p>
                <p class="sample-text">
                  <b>W</b>e uphold the dignity of our Agency by crossing the road of excellence and people empowerment in developing
                  sound careers in public service through continuing programs of personnel growth and development. We will pursue our
                  goals objectively to attain office efficiency and good governance gearing towards responsiveness.
                </p>
                <p class="sample-text">... So help us God! </p>
              </div>


              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="text-heading title_color">SERVICES OFFERED</h3>
                <div class="">
                  <ul>

                    <li>RESEARCH DEVELOPMENT AND EXTENSION OFFICE (RDE)
                      <ul>
                        <li>Issuance of Certificate of Eligibility for Conversion of Sugarcance Land</li>
                        <li>Soil Analysis</li>
                        <li>Juice Analysis</li>
                        <li>Sugar Analysis</li>
                        <li>Micropropagated Plantlets</li>
                        <li>Trichogramma Strips</li>
                        <li>Information Dissemination</li>
                        <li>Training and Workshop</li>
                        <li>Microbiological Analyses</li>
                        <li>Technical Survey and Evaluation</li>
                        <li>Environmental Monitoring of Sugar Mills and Refiniries</li>
                        <li>Survey/Identification/Validation of Expansion Areas for Ethanol Production</li>
                        <li>Technology Transfer and Commercialization of SRA-generated Technologies</li>
                        <li>Technical Audit / Evaluation of sugar factories and refineries</li>
                        <li>Technical Inquiries</li>
                        <li>Technical Data Dissemination</li>
                        <li>Sale of Information Materials</li>
                      </ul>
                    </li>
                    <br>

                    <li>REGULATION DEPARTMENT
                      <ul>
                        <li>Requirements for SRA Shipping Permit</li>
                        <li>Sugar Trader</li>
                        <li>Muscovado Converter/Trader</li>
                        <li>Processors/Manufacturers of Sugar-Based Products for Export</li>
                      </ul>
                    </li>
                    <br>

                    <li>CLEARANCES
                      <ul>
                        <li>ISSUANCE OF LICENSE TO MILLS/REFINERIES</li>
                        <li>ISSUANCE OF CLEARANCE FOR RELEASE OF IMPORTED SUGAR</li>
                        <li>ISSUANCE OF SHIPPING PERMIT</li>
                        <li>ISSUANCE OF CLEARANCE TO EXPORT MOLASSES/MUSCOVADO</li>
                        <li>ISSUANCE OF SUGAR EXPORT CLEARANCE</li>
                        <li>ISSUANCE OF CERTIFICATE OF EXCHANGE AUTHORITY (CEA) ON SWAPPING OF TWO DIFFERENT CLASSES OF SUGAR</li>
                        <li>ISSUANCE OF LICENSE TO SUGAR/MOLASSES AND MUSCOVADO TRADERS</li>
                        <li>ISSUANCE OF CERTIFICATE OF SUGAR REQUIREMENT OF PROCESSORS OF SUGAR-BASED PRODUCTS</li>
                        <li>ISSUANCE OF PREMIX COMMODITY RELEASE CLEARANCE</li>
                      </ul>
                    </li>

                  </ul>
                </div>
              </div>


              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="text-heading title_color">SERVICE GUIDE</h3>
                  <ul>

                    <li>ADMINISTRATIVE AND FINANCE DEPARTMENT
                      <ul>
                        <li><a href="{{ route('guest.about_us.view_service_guide', 'dQU2Elbu2rwDPkTP') }}" class="link-default" target="__blank">ACCOUNTING (6177)</a></li>
                        <li><a href="{{ route('guest.about_us.view_service_guide', 'SanSH4jsBGlO5nvE') }}" class="link-default" target="__blank">BUDGET & TREASURY (2229)</a></li>
                        <li><a href="{{ route('guest.about_us.view_service_guide', 'FwbAnovlU4kmhxsi') }}" class="link-default" target="__blank">HUMAN RESOURCE DEPEARTMENT (1534)</a></li>
                        <li><a href="{{ route('guest.about_us.view_service_guide', 'G5O6i0I3TLzdmz8q') }}" class="link-default" target="__blank">LIBRARY (1245)</a></li>
                        <li><a href="{{ route('guest.about_us.view_service_guide', 'BpR5tsvuxEGaDsot') }}" class="link-default" target="__blank">RECORDS (1140)</a></li>
                      </ul>
                    </li>
                    <br>

                    <li>INTERNAL AUDIT DEPARTMENT
                      <ul>
                        <li><a href="{{ route('guest.about_us.view_service_guide', 'wKAAEvFxditJ147O') }}" class="link-default" target="__blank">INTERNAL AUDIT DEPARTMENT (1262)</a></li>
                      </ul>
                    </li>
                    <br>

                    <li>LEGAL DEPARTMENT
                      <ul>
                        <li><a href="{{ route('guest.about_us.view_service_guide', 'TDW71ajKhHwBXqRR') }}" class="link-default" target="__blank">LEGAL DEPARTMENT (1236)</a></li>
                      </ul>
                    </li>
                    <br>

                    <li>PLANNING AND POLICY DEPARTMENT
                      <ul>
                        <li><a href="{{ route('guest.about_us.view_service_guide', 'FqKX8qzrAXAe57DC') }}" class="link-default" target="__blank">MANAGEMENT INFORMATION SYSTEM (1431)</a></li>
                        <li><a href="{{ route('guest.about_us.view_service_guide', 'vnl9HpgrR1GiQh1C') }}" class="link-default" target="__blank">PLANNING (1163)</a></li>
                        <li><a href="{{ route('guest.about_us.view_service_guide', 'OcDRZVp2qmhPGZEV') }}" class="link-default" target="__blank">SPECIAL PROJECT & PROJECT MONITORING & EVALUATION (1267)</a></li>
                      </ul>
                    </li>
                    <br>

                    <li>REGULATION DEPARTMENT
                      <ul>
                        <li><a href="{{ route('guest.about_us.view_service_guide', 'm4KlKNaBqtfdY0qb') }}" class="link-default" target="__blank">LICENSING AND MONITORING (2344)</a></li>
                        <li><a href="{{ route('guest.about_us.view_service_guide', '74088fFY3FVR7J2s') }}" class="link-default" target="__blank">SUGAR REGULATION AND ENFORCEMENT (3444)</a></li>
                        <li><a href="{{ route('guest.about_us.view_service_guide', 'sARophOruKscyiAa') }}" class="link-default" target="__blank">SUGAR TRANSACTION (4176)</a></li>
                        <li><a href="{{ route('guest.about_us.view_service_guide', 'DunMB4pjYECxE5kp') }}" class="link-default" target="__blank">VISAYAS (3088)</a></li>
                      </ul>
                    </li>
                    <br>

                    <li>RESEARCH DEVELOPMENT & EXTENSION DEPARTMENT
                      <ul>
                        <li><a href="{{ route('guest.about_us.view_service_guide', '3UVx9GAh6qNk9OSz') }}" class="link-default" target="__blank">LUZON AGRICULTURAL RESEARCH CENTER (1247)</a></li>
                        <li><a href="{{ route('guest.about_us.view_service_guide', 'weZkpnMv10nuXZmq') }}" class="link-default" target="__blank">LUZON AND MINDANAO (1702)</a></li>
                        <li><a href="{{ route('guest.about_us.view_service_guide', 'Xtt3O3guarGNkppx') }}" class="link-default" target="__blank">VISAYAS (1243)</a></li>
                      </ul>
                    </li>
                    <br>

                  </ul>
              </div>

              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="text-heading title_color">SERVICE FEES AND CHARGES</h3>  
                <a href="{{ route('guest.about_us.view_service_fees') }}" class="link-default" target="__blank">
                  DOWNLOAD
                </a>
                <object
                  type="application/pdf" 
                  data="{{ route('guest.about_us.view_service_fees') }}#toolbar=0" 
                  width="750" 
                  height="550"
                >
                </object>
              </div>

            </div>            
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>

@endsection


