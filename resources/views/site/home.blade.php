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
              <div class="car-info-box"> <a href="#"><img  src="{{(isset($car->model->MODL_IMGE)) ? asset( 'storage/'. $car->model->MODL_IMGE ) : 'assets/images/600x380.jpg'}}" class="img-fluid" alt="image"></a>
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

{{--  --}}

@endsection