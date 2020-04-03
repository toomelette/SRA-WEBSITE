@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-9 posts-list">
            {{ Breadcrumbs::render('aboutUs_mandate') }}
            <div class="single-post row">


              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="text-heading title_color">MANDATE</h3>
                <p class="sample-text">
                  The legal mandate of SRA is embodied in Executive Order No. 18  dated  May 28, 1986 creating the Sugar Regulatory Administration.  It states that the policy of the State is to promote the growth & development of the sugar industry through greater participation of the private sector and to improve the working conditions of the laborers.
                </p>
                <p class="sample-text">
                  RA 10659 or the Sugarcane Industry Development Act of 2015 further declares the policy of the State to promote the competitiveness of the sugarcane industry and maximize the utilization of sugarcane resources, and improve the incomes of farmers and farm workers, through improved productivity, product diversification, job generation, and increased efficiency of sugar mills.
                </p>
                <p class="sample-text">
                  RA 9367 or the Biofuels Act of 2006 mandated SRA as member of the National Biofuel Board (NBB) to develop and implement policies supporting the Philippine Biofuel Program and ensure bioethanol feedstock supply and security of domestic sugar supply.
                </p>
              </div>


              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="mb-30 title_color">VISION</h3>
                <div class="row">
                  <div class="col-lg-12">
                    <blockquote class="generic-blockquote">
                      "By 2040, the Philippines shall have a globally competitive sugarcane industry that supports the food, power, and other related industries through an institutionally competent SRA and committed stakeholders, for a secured future for Filipinos."
                    </blockquote>
                  </div>
                </div>
              </div>


              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="mb-30 title_color">MISSION</h3>
                <div class="row">
                  <div class="col-lg-12">
                    <blockquote class="generic-blockquote">
                      "SRA is a Government Owned and Controlled Corporation which formulates responsive development and regulatory policies, and provides RD & E services to ensure sufficient supply of sugarcane for a diversified, sustainable and competitive industry that improves productivity and profitability of sugarcane farmers and processing industries, and provides decent income for workers towards enhancing the quality of life of Filipinos."
                    </blockquote>
                  </div>
                </div>
              </div>


              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="mb-20 title_color">CORE VALUES</h3>
                <div class="">
                  <ul class="unordered-list">
                    <li>Integrity</li>
                    <li>Innovativeness</li>
                    <li>Competence</li>
                    <li>Professionalism</li>
                    <li>Accountability</li>
                  </ul>
                </div>
              </div>


              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="mb-30 title_color">QUALITY POLICY</h3>
                <div class="row">
                  <div class="col-lg-12">
                    <blockquote class="generic-blockquote">
                      "SRA is committed to promote the advancement and competitiveness of the sugarcane industry amidst global challenges. It shall continue to improve the way it does its business, in an effort to meet the expectations of its clientele while maintaining compliance, to applicable legal requirements. It shall ensure the continual improvement of its human resource capabilities, as response to the current and strategic needs of the industry."
                    </blockquote>
                  </div>
                </div>
              </div>

          </div>
            
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>

@endsection


