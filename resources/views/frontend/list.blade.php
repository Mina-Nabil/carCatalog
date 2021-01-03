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
              <form action="{{$searchURL}}" method="post">
                @csrf
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
                  <label class="form-label">Price Range ({{number_format($carsMin)}} to {{number_format($carsMax)}} EGP)</label>
                  <input id="price_range" type="text" name="priceRange" data-slider-min="{{$carsMin}}" data-slider-max="{{$carsMax}}" data-slider-step="5"
                    data-slider-value="[{{$carsMin+$carsShwya}},{{$carsMax-$carsShwya}}]" />
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <x-car-list :cars="$carList" />
      </div>

      <!--Side-Bar-->
      <aside class="col-md-3 col-md-pull-9">
        <div class="sidebar_widget sidebar_search_wrap">
          <div class="widget_heading">
            <h5><i class="fa fa-filter" aria-hidden="true"></i> Find Your Dream Car </h5>
          </div>
          <div class="sidebar_filter">
            <form action="{{$searchURL}}" method="post">
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
                <label class="form-label">Price Range ({{number_format($carsMin)}} to {{number_format($carsMax)}} EGP)</label>
                <input id="price_range1" type="text" name="priceRange" data-slider-min="{{$carsMin}}" data-slider-max="{{$carsMax}}" data-slider-step="5"
                  data-slider-value="[{{$carsMin+$carsShwya}},{{$carsMax-$carsShwya}}]" />
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