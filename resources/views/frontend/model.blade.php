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
          <div class="product-listing-img"> <a href="{{url('car/' . $car->id)}}"><img src="{{($car->image) ? asset('storage/' . $car->image) : asset('assets/frontend/images/600x380.jpg')}}" class="img-fluid" alt="image" />
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
            <h5><a href="#">{{$car->model->MODL_NAME}} {{$car->CAR_CATG}}</a></h5>
            <p class="list-price">{{number_format($car->CAR_PRCE)}}EGP</p>
            <ul>
              <li><i class="fa fa-database" aria-hidden="true"></i>{{$car->CAR_ENCC}}</li>
              <li><i class="fa fa-calendar" aria-hidden="true"></i>{{$car->MODL_YEAR}}</li>
              <li><i class="fa fa-rocket" aria-hidden="true"></i>{{$car->CAR_HPWR}} hp</li>
              <li><i class="fa fa-tachometer" aria-hidden="true"></i>{{$car->CAR_ACC}} sec to 100km/h</li>
              <li><i class="fa fa-superpowers" aria-hidden="true"></i>{{$car->CAR_TORQ}} kW</li>
              <li><i class="fa fa-car" aria-hidden="true"></i>{{$car->CAR_DIMN}}</li>
            </ul>
            <a href="{{url('car/' . $car->id)}}" class="btn">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
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