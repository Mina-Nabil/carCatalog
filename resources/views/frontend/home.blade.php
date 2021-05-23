@extends('layouts.site')

@section('content')
<!-- Filter-Form -->
<section id="filter_form2">
  <div class="container">
    <div class="main_bg white-text">
      <h3>Browse Our Cars</h3>
      <form action="{{$searchURL}}" method="post">
        @csrf
        <div class="row">
          <div class="form-group col-md-3 col-sm-6">
            <div class="select">
              <select class="form-control" name="typeID">
                <option value=0>Type Of Car </option>
                @foreach($types as $type)
                <option value="{{$type->id}}">{{$type->TYPE_NAME}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group col-md-3 col-sm-6">
            <div class="select">
              <select class="form-control" name=modelID>
                <option value=0>Select Model</option>
                @foreach($models as $model)
                <option value="{{$model->id}}">{{$model->MODL_NAME}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group col-md-3 col-sm-6">
            <div class="select">
              <select class="form-control" name=year>
                <option value=0>Year of Model </option>
                @foreach($years as $year)
                <option value="{{$year}}">{{$year}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group col-md-3 col-sm-6">
            <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car </button>
          </div>

          <div class="form-group col-md-9 col-sm-6">
            <label class="form-label">Price Range ($) </label>
            <input id="price_range" type="text" class="span2" name="priceRange" data-slider-min="{{$carsMin}}" data-slider-max="{{$carsMax}}" data-slider-step="5"
              data-slider-value="[{{$carsMin+$carsShwya}},{{$carsMax-$carsShwya}}]" />
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
      <h2>{{$frontendData['Top Models']['Top Models Section Title'] ?? ''}}</h2>
      <p>{{$frontendData['Top Models']['Top Models Section Text'] ?? ''}}</p>
    </div>
    <div class="row">
      @foreach ($mainModels as $model)
      <div class="col-lg-6 col-sm-6">
        <div class="looking-car">
          <div class="looking-cat-image"> <img src="{{ ($model->MODL_IMGE) ? asset( 'storage/'. $model->MODL_IMGE ) : asset('assets/frontend/images/346x224.png')}}" alt="Image" /> </div>
          <div class="looking-car-content">
            <h3>{{$model->brand->BRND_NAME}} <span>{{ $model->MODL_NAME}}</span></h3>
            <p>{{ $model->MODL_OVRV}}</p>
            <a href="{{url('model/' . $model->id)}}" class="btn">View Listing<i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
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
      <h2>{{$frontendData['Top Car Types']['Top Cars Section Title'] ?? ''}}</h2>
      <p>{{$frontendData['Top Car Types']['Top Cars Section Text'] ?? ''}}</p>
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
    </div>
    <!-- Recently Listed New Cars -->
    <div class="row">
      <div class="tab-content" style="width: 100%">
        <?php $i=0?>
        @foreach ($types as $type)
        @if ($type->TYPE_MAIN)
        <div role="tabpanel" class="tab-pane {{($i==0) ? 'active' : ''}}" id="type{{$type->id}}">
          <?php $i++?>
          @foreach ($type->active_cars as $car)
          <div class="col-list-3">
            <div class="recent-car-list">
              <div class="car-info-box"> <a href="{{url('car/' . $car->id)}}"><img style="max-width: 346px; width: auto; height:224px; display:block; object-fit:fill "
                    src="{{(isset($car->image)) ? asset( 'storage/'. $car->image ) : asset( 'assets/images/600x380.jpg' )}}"></a>
                <div class="compare_item">
                  <div class="checkbox">
                    <input type="checkbox" id="compare{{$car->id}}" onchange="addToCompare(this, '{{$car->id}}')" @if(in_array($car->id, $compareArr))
                    checked
                    @endif
                    >
                    <label for="compare{{$car->id}}">Compare</label>
                  </div>
                </div>
                <ul>
                  <li><i class="fa fa-database" aria-hidden="true"></i>{{$car->CAR_ENCC}}</li>
                  <li><i class="fa fa-calendar" aria-hidden="true"></i>{{$car->MODL_YEAR}}</li>
                  <li><i class="fa fa-rocket" aria-hidden="true"></i>{{$car->CAR_HPWR}} hp</li>
                </ul>
              </div>
              <div class="car-title-m">
                <h6><a href="{{url('car/' . $car->id)}}">{{$car->model->MODL_NAME}} {{$car->CAR_CATG}}</a></h6>
                <span class="price">{{number_format($car->CAR_PRCE)}}EGP</span>
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
<section class="fun-facts-section" style='opacity: 0.4; background-image: {{ (isset($frontendData['Showroom stats']['Background Image'])) ? 
 'url(' . asset('storage/' . $frontendData['Showroom stats']['Background Image']) . ')' :
 'url(' . asset('assets/frontend/images/1920x400.jpg') . ')' }} !important'>
  <div class="container div_zindex ">
    <div class="row">
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-calendar" aria-hidden="true"></i>{{$frontendData['Showroom stats']['Years In Business - Stats'] ?? ''}}+</h2>
            <p>Years In Business</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-car" aria-hidden="true"></i>{{$frontendData['Showroom stats']['New Cars for Sale - Stats'] ?? ''}}+</h2>
            <p>New Cars For Sale</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-car" aria-hidden="true"></i>{{$frontendData['Showroom stats']['Number of Sold Cars - Stats'] ?? ''}}+</h2>
            <p>Number of Sold Cars</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i>{{$frontendData['Showroom stats']['Number of clients - Stats'] ?? ''}}+</h2>
            <p>Number of clients</p>
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
      <h2>{{$frontendData['Offers']['Offers Section Title'] ?? ''}}</h2>
      <p>{{$frontendData['Offers']['Offer Section Subtitle'] ?? ''}} </p>
    </div>
    <div class="row">
      @foreach($offers as $offerCar)
      <div class="col-list-3">
        <div class="featured-car-list">
          <div class="featured-car-img"> <a href="{{url('car/' . $offerCar->id)}}"><img
                src="{{ ($offerCar->image) ? asset('storage/' . $offerCar->image )  : asset('assets/frontend/images/600x380.jpg')}}" class="img-fluid" alt="Image"></a>
            @if($offerCar->CAR_DISC > 0)
            <div class="label_icon">- {{$offerCar->CAR_DISC}}</div>
            @endif
            <div class="compare_item">
              <div class="checkbox">
                <input type="checkbox" id="compare{{$offerCar->id}}" onchange="addToCompare(this, '{{$offerCar->id}}')" @if(in_array($offerCar->id, $compareArr))
                checked
                @endif
                >
                <label for="compare{{$offerCar->id}}">Compare</label>
              </div>
            </div>
          </div>
          <div class="featured-car-content">
            <h6><a href="{{url('car/' . $offerCar->id)}}">{{$offerCar->MODL_NAME}} {{$offerCar->CAR_CATG}}</a></h6>
            <div class="price_info">
              <p class="featured-price">{{number_format($offerCar->CAR_PRCE)}}EGP</p>
            </div>
            <ul>
              <li><i class="fas fa-database" aria-hidden="true"></i>{{$offerCar->CAR_ENCC}}</li>
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
      <h2>{{$frontendData['Trending cars']['Trending Section Title'] ?? ''}}</h2>
      <p>{{$frontendData['Trending cars']['Trending Section Subtitle'] ?? ''}} </p>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div id="trending_slider">
          @foreach($trends as $trendCar)
          <div class="trending-car-m">
            <div class="trending-car-img"> <img src="{{ ($trendCar->image) ? asset('storage/' . $trendCar->image)  : asset('assets/frontend/images/600x380.jpg')}}" alt="Image" class="img-fluid" />
            </div>
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

@if(isset($frontendData['Customers']) && $frontendData['Customers']['Active'])
<section class="section-padding testimonial-section parallex-bg">
  <div class="container div_zindex">
    <div class="section-header white-text text-center">
      <h2>{{$frontendData['Customers']['Customers Section Title']}}</h2>
      <p>{{$frontendData['Customers']['Customers Section Subtitle']}}</p>
    </div>
    <div class="row">
      <div id="testimonial-slider">
        @foreach($customers as $customer)
        @if($customer->CUST_ACTV)
        <div class="testimonial-m">
          <div class="testimonial-img"> <img src="{{ ($customer->CUST_IMGE) ? asset('storage' . $customer->CUST_IMGE)  : asset('assets/frontend/images/300x300.jpg')}}" alt="images" /> </div>
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