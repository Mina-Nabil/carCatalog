@extends('layouts.site')

@section('content')

<section class="listing-page">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
        <div class="mobile_search">
          <div class="sidebar_widget">
            <div class="widget_heading">
              <h5><i class="fa fa-filter" aria-hidden="true"></i> Find Your Dream Car </h5>
            </div>
            <div class="sidebar_filter">
              <form action="#" method="get">
                <div class="form-group select">
                  <select class="form-control">
                    <option>Select Location</option>
                    <option>Location 1</option>
                    <option>Location 2</option>
                    <option>Location 3</option>
                    <option>Location 4</option>
                  </select>
                </div>
                <div class="form-group select">
                  <select class="form-control">
                    <option>Select Brand</option>
                    <option>Brand 1</option>
                    <option>Brand 2</option>
                    <option>Brand 3</option>
                    <option>Brand 4</option>
                  </select>
                </div>
                <div class="form-group select">
                  <select class="form-control">
                    <option>Select Model</option>
                    <option>Series 1</option>
                    <option>Series 2</option>
                    <option>Series 3</option>
                    <option>Series 4</option>
                  </select>
                </div>
                <div class="form-group select">
                  <select class="form-control">
                    <option>Year of Model </option>
                    <option>2016</option>
                    <option>2015</option>
                    <option>2014</option>
                    <option>2013</option>
                  </select>
                </div>

                <div class="form-group">
                  <label class="form-label">Price Range ($)</label>
                  <input id="price_range1" type="text" class="span2" value="" data-slider-min="50" data-slider-max="6000" data-slider-step="5" data-slider-value="[1000,5000]" />
                </div>
                <div class="form-group select">
                  <select class="form-control">
                    <option>Type of Car </option>
                    <option>New Car</option>
                    <option>Used Car</option>
                  </select>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        {{-- <div class="result-sorting-wrapper">
            <div class="sorting-count">
              <p>1 - 8 <span>of 50 Listings</span></p>
            </div>
            <div class="result-sorting-by">
              <p>Sort by:</p>
              <form action="#" method="post">
                <div class="form-group select sorting-select">
                  <select class="form-control ">
                    <option>Price (low to high)</option>
                    <option>$100 to $500</option>
                    <option>$500 to $1000</option>
                    <option>$1000 to $1500</option>
                    <option>$1500 to $2000</option>
                  </select>
                </div>
              </form>
            </div>
          </div> --}}
        @foreach($model->cars as $car)
        <div class="product-listing-m gray-bg">
          <div class="product-listing-img"> <a href="#"><img src="{{($car->image) ? asset('storage/' . $car->image) : asset('assets/frontend/images/600x380.jpg')}}" class="img-fluid" alt="image" />
            </a>
            <div class="label_icon">New</div>
            <div class="compare_item">
              <div class="checkbox">
                <input type="checkbox" value="" id="compare22">
                <label for="compare22">Compare</label>
              </div>
            </div>
          </div>
          <div class="product-listing-content">
            <h5><a href="#">Car Name Text</a></h5>
            <p class="list-price">$90,000</p>
            <ul>
              <li><i class="fa fa-database" aria-hidden="true"></i>{{$car->CAR_ENCC}} cc</li>
              <li><i class="fa fa-calendar" aria-hidden="true"></i>{{$car->MODL_YEAR}} model</li>
              <li><i class="fa fa-horse" aria-hidden="true"></i>{{$car->CAR_HPWR}} hp</li>
              <li><i class="fa fa-tachometer" aria-hidden="true"></i>{{$car->CAR_ACC}}sec to 0-100km/hr</li>
              <li><i class="fa fa-superpowers" aria-hidden="true"></i>{{$car->CAR_TORQ}} kW</li>
              <li><i class="fa fa-car" aria-hidden="true"></i>{{$car->CAR_DIMN}}</li>
            </ul>
            <a href="#" class="btn">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
            <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Colorado, USA</span></div>
          </div>
        </div>

        @endforeach

        {{--           
          <div class="pagination">
            <ul>
              <li class="current">1</li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
            </ul>
          </div> --}}
      </div>

      <!--Side-Bar-->
      <aside class="col-md-3 col-md-pull-9">
        <div class="sidebar_widget sidebar_search_wrap">
          <div class="widget_heading">
            <h5><i class="fa fa-filter" aria-hidden="true"></i> Find Your Dream Car </h5>
          </div>
          <div class="sidebar_filter">
            <form action="#" method="get">
              <div class="form-group select">
                <select class="form-control">
                  <option value=0>Select Brand</option>
                  @foreach($brands as $brand)
                  <option value="{{$brand->id}}">{{$brand->BRND_NAME}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control">
                  <option value=0>Select Model</option>
                  @foreach($models as $model)
                  <option value="{{$model->id}}">{{$model->MODL_NAME}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control">
                  <option value=0>Year of Model </option>
                  @foreach($years as $year)
                  <option value="{{$year}}">{{$year}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control">
                  <option value=0>Type of Car </option>
                  @foreach($types as $type)
                  <option value="{{$type->id}}">{{$type->TYPE_NAME}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">Price Range ($)</label>
                <input id="price_range" type="text" class="span2" value="" data-slider-min="50" data-slider-max="6000" data-slider-step="5" data-slider-value="[1000,5000]" />
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car</button>
              </div>
            </form>
          </div>
        </div>
      </aside>
      <!--/Side-Bar-->
    </div>
  </div>
</section>

@endsection