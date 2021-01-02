@extends('layouts.site')

@section('content')
<!-- Filter-Form -->
<section id="filter_form2">
  <div class="container">
    <div class="main_bg white-text">
      <h3>Find Your Dream Car</h3>

      <form action="#" method="get">
        <div class="row">
          <div class="form-group col-md-3 col-sm-6">
            <div class="select">
              <select class="form-control">
                <option value=0>All Car Types </option>
                @foreach($types as $type)
                <option value="{{$type->id}}">{{$type->TYPE_NAME}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group col-md-3 col-sm-6">
            <div class="select">
              <select class="form-control">
                <option>All Brands</option>
                @foreach($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->BRND_NAME}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group col-md-3 col-sm-6">
            <div class="select">
              <select class="form-control">
                <option>All Models</option>
                @foreach($models as $model)
                <option value="{{$model->id}}">{{$model->MODL_NAME}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group col-md-3 col-sm-6">
            <div class="select">
              <select class="form-control">
                <option>Year of Model </option>
                @foreach($years as $year)
                <option value="{{$year}}">{{$year}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group col-md-9 col-sm-6">
            <label class="form-label">Price Range ($) </label>
            <input id="price_range" type="text" class="span2" value="" data-slider-min="50" data-slider-max="6000" data-slider-step="5" data-slider-value="[1000,5000]" />
          </div>


          <div class="form-group col-md-3 col-sm-6">
            <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car </button>
          </div>
        </div>
      </form>

    </div>
  </div>
</section>
<!-- /Filter-Form -->
@if(isset($frontendData['Top Models']) && $frontendData['Top Models']['Active'])

<section class="about-us-section section-padding">
  <div class="container">
    <div class="section-header text-center">
      <h2>Welcome <span>to CarForYou</span></h2>
      <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly
        believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
    </div>
    <div class="row">
      @foreach ($mainModels as $model)
      <div class="col-lg-6 col-sm-6">
        <div class="looking-car">
          <div class="looking-cat-image"> <img src="{{ ($model->MODL_IMGE) ? asset( 'storage/'. $model->MODL_IMGE ) : asset('assets/frontend/images/346x224.png')}}" alt="Image" /> </div>
          <div class="looking-car-content">
            <h3>{{$model->brand->BRND_NAME}} <span>{{ $model->MODL_NAME}}</span></h3>
            <p>{{ $model->MODL_OVRV}}</p>
            <a href="" class="btn">View Listing<i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif
@if(isset($frontendData['Top Car Types']) && $frontendData['Top Car Types']['Active'])
{{-- Car Types --}}
<section class="section-padding gray-bg">
  <div class="container">
    <div class="section-header text-center">
      <h2>Find the Best <span>Deals For You</span></h2>
      <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly
        believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
    </div>
    <div class="row">

      <!-- Nav tabs -->
      <div class="recent-tab">
        <ul class="nav nav-tabs" role="tablist">
          <?php $i=0 ?>
          @foreach ($types as $type)
          @if ($type->TYPE_MAIN)

          <li role="presentation"><a href="#type{{$type->id}}" {{ ($i==0) ? 'class=active' : ''}} role="tab" data-toggle="tab">{{$type->TYPE_NAME}}</a></li>
          <?php $i++ ?>
          @endif
          @endforeach
        </ul>
      </div>
      <!-- Recently Listed New Cars -->
      <div class="tab-content">
        @foreach ($types as $type)
        @if ($type->TYPE_MAIN)
        <div role="tabpanel" class="tab-pane active" id="type{{$type->id}}">
          @foreach ($type->cars as $car)
          <div class="col-list-3">
            <div class="recent-car-list">
              <div class="car-info-box"> <a href="#"><img src="{{(isset($car->model->MODL_IMGE)) ? asset( 'storage/'. $car->model->MODL_IMGE ) : 'assets/images/600x380.jpg'}}" class="img-fluid"
                    alt="image"></a>
                <div class="compare_item">
                  <div class="checkbox">
                    <input type="checkbox" id="compare4">
                    <label for="compare4">Compare</label>
                  </div>
                </div>
                <ul>
                  <li><i class="fa fa-road" aria-hidden="true"></i>20,000 km</li>
                  <li><i class="fa fa-calendar" aria-hidden="true"></i>2005 Model</li>
                  <li><i class="fa fa-map-marker" aria-hidden="true"></i>Colorado, USA</li>
                </ul>
              </div>
              <div class="car-title-m">
                <h6><a href="#">Car Name</a></h6>
                <span class="price">$45,000</span>
              </div>
              <div class="inventory_info_m">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        @endif
        @endforeach
      </div>
    </div>
  </div>
</section>
@endif

@if(isset($frontendData['Showroom stats']) && $frontendData['Showroom stats']['Active'])
<section class="fun-facts-section" style='background-image: {{ ($frontendData['Showroom stats']['background']) ? 
 'url(' . asset('storage/' . $frontendData['Showroom stats']['background']) . ')' :
 'url(' . asset('assets/frontend/images/1920x400.jpg') . ')' }} !important'>
  <div class="container div_zindex">
    <div class="row">
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-calendar" aria-hidden="true"></i>40+</h2>
            <p>Years In Business</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-car" aria-hidden="true"></i>1200+</h2>
            <p>New Cars For Sale</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-car" aria-hidden="true"></i>1000+</h2>
            <p>Used Cars For Sale</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i>600+</h2>
            <p>Satisfied Customers</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
@endif

@if( isset($frontendData['Offers']) && $frontendData['Offers']['Active'])
<section class="section-padding">
  <div class="container">
    <div class="section-header text-center">
      <h2>Featured Cars <span>Special Offers</span></h2>
      <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly
        believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. </p>
    </div>
    <div class="row">
      @foreach($offers as $offerCar)
      <div class="col-list-3">
        <div class="featured-car-list">
          <div class="featured-car-img"> <a href=""><img src="{{ ($offerCar->mainImage()) ? assets('storage' . $offerCar->mainImage())  : assets('assets/frontend/images/600x380.jpg')}}"
                class="img-fluid" alt="Image"></a>
            @if($offerCar->CAR_DISC > 0)
            <div class="label_icon">- {{$offerCar->CAR_DISC}}</div>
            @endif
            <div class="compare_item">
              <div class="checkbox">
                <input type="checkbox" id="compare">
                <label for="compare">Compare</label>
              </div>
            </div>
          </div>
          <div class="featured-car-content">
            <h6><a href="{{url('car/' . $trendCar->id)}}">{{$offerCar->MODL_NAME}} {{$offerCar->CAR_CATG}}</a></h6>
            <div class="price_info">
              <p class="featured-price">{{$offerCar->CAR_PRCE}}EGP</p>
            </div>
            <ul>
              <li><i class="fas fa-database" aria-hidden="true"></i>{{$offerCar->CAR_ENCC}} cc</li>
              <li><i class="fa fa-calendar" aria-hidden="true"></i>{{$offerCar->MODL_YEAR}} model</li>
              <li><i class="fas fa-horse" aria-hidden="true"></i>{{$offerCar->CAR_HPWR}} hp</li>
              <li><i class="fa fa-tachometer" aria-hidden="true"></i>{{$offerCar->CAR_ACC}}sec to 0-100km/hr</li>
              <li><i class="fa fa-superpowers" aria-hidden="true"></i>{{$offerCar->CAR_TORQ}} kW</li>
              <li><i class="fa fa-car" aria-hidden="true"></i>{{$offerCar->CAR_DIMN}}</li>
            </ul>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif

@if( isset($frontendData['Trending cars']) && $frontendData['Trending cars']['Active'])
<section class="section-padding gray-bg">
  <div class="container">
    <div class="section-header text-center">
      <h2>Trending <span>Cars</span></h2>
      <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly
        believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. </p>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div id="trending_slider">
          @foreach($trends as $trendCar)
          <div class="trending-car-m">
            <div class="trending-car-img"> <img src="{{ ($trendCar->mainImage()) ? assets('storage' . $trendCar->mainImage())  : assets('assets/frontend/images/600x380.jpg')}}" alt="Image"
                class="img-fluid" /> </div>
            <div class="trending-hover">
              <h4><a href="{{url('car/' . $trendCar->id)}}">{{$trendCar->MODL_NAME}} {{$trendCar->CAR_CATG}}</a></h4>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endif

@if($frontendData['Customers']['Active'])
<section class="section-padding testimonial-section parallex-bg">
  <div class="container div_zindex">
    <div class="section-header white-text text-center">
      <h2>Our Satisfied <span>Customers</span></h2>
      <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly
        believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. </p>
    </div>
    <div class="row">
      <div id="testimonial-slider">
        @foreach($customers as $customer)
        @if($customer->CUST_ACTV)
        <div class="testimonial-m">
          <div class="testimonial-img"> <img src="{{ ($customer->CUST_IMGE) ? assets('storage' . $customer->CUST_IMGE)  : assets('assets/frontend/images/300x300.jpg')}}" alt="images" /> </div>
          <div class="testimonial-content">
            <div class="testimonial-heading">
              <h5>{{$customer->CUST_NAME}}</h5>
              <span class="client-designation">{{$customer->CUST_TTLE}}</span>
            </div>
            <p>{{$customer->CUST_TEXT}}</p>
          </div>
        </div>
        @endif
        @endforeach
      </div>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
@endif

@endsection