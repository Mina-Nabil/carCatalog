@extends('layouts.site')

@section('content')
<section class="listing-detail">

  <section class="listing-page">
    <div class="container">
      @isset($model)
      <section class="listing-detail">
        <div class="container">
          <div class="row">
            <div class="col-md-9">
              <div class="listing_images">
                <div id="listing_images_slider" class="listing_images_slider">
                  @foreach($model->colorImages as $carImage)
                  <div><img height="560px" data-toggle="tooltip" data-placement="top" title="{{$carImage->MOIM_COLR}}" src="{{($carImage->MOIM_URL) ? asset('storage/' . $carImage->MOIM_URL) : asset('assets/frontend/images/900x560.jpg')}}" alt="image"></div>
                  @endforeach
                </div>
                <div id="listing_images_slider_nav" class="listing_images_slider_nav">
                  @foreach($model->colorImages as $carImage)
                  <div><img width="300px" data-toggle="tooltip" data-placement="top" title="{{$carImage->MOIM_COLR}}" src="{{($carImage->MOIM_URL) ? asset('storage/' . $carImage->MOIM_URL) : asset('assets/frontend/images/900x560.jpg')}}" alt="image"></div>
                  @endforeach
                </div>
              </div>
            </div>
            <!--Side-Bar-->
            <aside class="col-md-3 col-md-pull-9">
              <div class="sidebar_widget sidebar_search_wrap">
                <div class="widget_heading">
                  <h5><i class="fa fa-filter" aria-hidden="true"></i> Find Your Dream Car </h5>
                </div>
                <div class="sidebar_filter">
                  <form action="{{$searchURL}}" method="post">
                    @csrf
                    <div class="form-group select">
                      <select class="form-control" name=brandID>
                        <option value=0>Select Brand</option>
                        @foreach($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->BRND_NAME}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group select">
                      <select class="form-control" name=modelID>
                        <option value=0>Select Model</option>
                        @foreach($models as $model)
                        <option value="{{$model->id}}">{{$model->MODL_NAME}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group select">
                      <select class="form-control" name=year>
                        <option value=0>Year of Model </option>
                        @foreach($years as $year)
                        <option value="{{$year}}">{{$year}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group select">
                      <select class="form-control" name=typeID>
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

                    <div class="form-group" style="margin-top:4em">
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
      @endisset
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
                    <select class="form-control" name=brandID>
                      <option value=0>Select Brand</option>
                      @foreach($brands as $brand)
                      <option value="{{$brand->id}}">{{$brand->BRND_NAME}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group select">
                    <select class="form-control" name=modelID>
                      <option value=0>Select Model</option>
                      @foreach($models as $model)
                      <option value="{{$model->id}}">{{$model->MODL_NAME}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group select">
                    <select class="form-control" name=year>
                      <option value=0>Year of Model </option>
                      @foreach($years as $year)
                      <option value="{{$year}}">{{$year}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group select">
                    <select class="form-control" name=typeID>
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

                  <div class="form-group" style="margin-top:4em">
                    <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <x-car-list :cars="$carList" :compareArr="$compareArr" />
    </div>
  </section>

  @endsection