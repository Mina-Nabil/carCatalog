@extends('layouts.site')

@section('content')

<!-- Filter-Form -->
<section id="filter_form" class="inner-filter gray-bg">
  <div class="container">
    <h3>Find Your Dream Car <span>(Easy search from here)</span></h3>
    <div class="row">
      <form action="{{$searchURL}}" method="post">
        @csrf
        <div class="row">
          <div class="form-group col-md-3 col-sm-6 black_input">
            <div class="select">
              <select class="form-control" name=typeID>
                <option value=0>Type of Car </option>
                @foreach($types as $type)
                <option value="{{$type->id}}">{{$type->TYPE_NAME}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group col-md-3 col-sm-6 black_input">
            <div class="select">
              <select class="form-control" name=brandID>
                <option value=0>Select Brand</option>
                @foreach($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->BRND_NAME}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group col-md-3 col-sm-6 black_input">
            <div class="select">
              <select class="form-control" name=modelID>
                <option value=0>Select Model</option>
                @foreach($models as $model)
                <option value="{{$model->id}}">{{$model->MODL_NAME}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group col-md-3 col-sm-6 black_input">
            <div class="select">
              <select class="form-control" name=year>
                <option value=0>Year of Model </option>
                @foreach($years as $year)
                <option value="{{$year}}">{{$year}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group col-md-9 col-sm-6 black_input">
            <label class="form-label">Price Range ({{number_format($carsMin)}} to {{number_format($carsMax)}} EGP)</label>
            <input id="price_range" type="text" name="priceRange" data-slider-min="{{$carsMin}}" data-slider-max="{{$carsMax}}" data-slider-step="5"
              data-slider-value="[{{$carsMin+$carsShwya}},{{$carsMax-$carsShwya}}]" />
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




<!--Compare-->
<section class="compare-page inner_pages">
  <div class="container">
    <div class="compare_info">
      <h4>
        Compare ({{$cars[0]->model->MODL_NAME}} {{$cars[0]->CAR_CATG}} {{$cars[0]->model->MODL_YEAR}})
        @if(isset($cars[1]))
        vs ({{$cars[1]->model->MODL_NAME}} {{$cars[1]->CAR_CATG}} {{$cars[1]->model->MODL_YEAR}})
        @endif
        @if(isset($cars[2]))
        vs ({{$cars[2]->model->MODL_NAME}} {{$cars[2]->CAR_CATG}} {{$cars[2]->model->MODL_YEAR}})
        @endif
      </h4>
      <div class="compare_product_img">
        <div class="inventory_info_list">
          <ul>
            <li id="filter_toggle" class="search_other_inventory"><i class="fa fa-search" style="color: white" aria-hidden="true"></i> Search Other Inventory</li>
            <li><a href="{{url('car/' . $cars[0]->id)}}"><img src="{{(isset($cars[0]->image)) ? asset( 'storage/'. $cars[0]->image ) : 'assets/images/600x380.jpg'}}" alt="image"></a></li>
            @if(isset($cars[1]))
            <li><a href="{{url('car/' . $cars[1]->id)}}"><img src="{{(isset($cars[1]->image)) ? asset( 'storage/'. $cars[1]->image ) : 'assets/images/600x380.jpg'}}" alt="image"></a></li>
            @endif
            @if(isset($cars[2]))
            <li><a href="{{url('car/' . $cars[2]->id)}}"><img src="{{(isset($cars[2]->image)) ? asset( 'storage/'. $cars[2]->image ) : 'assets/images/600x380.jpg'}}" alt="image"></a></li>
            @endif
          </ul>
        </div>

      </div>
      <div class="compare_product_title gray-bg">
        <div class="inventory_info_list">
          <ul>
            <li class="listing_heading">Compare <br>
              Cars <span class="td_divider"></span></li>
            <li><a href="{{url('car/' . $cars[0]->id)}}">{{$cars[0]->model->MODL_NAME}} {{$cars[0]->CAR_CATG}} {{$cars[0]->model->MODL_YEAR}}</a>
              <p class="price">{{number_format($cars[0]->CAR_PRCE)}}</p>
              @if(isset($cars[1]))
              <span class="vs">V/s</span>
              @endif
            </li>
            @if(isset($cars[1]))
            <li><a href="{{url('car/' . $cars[1]->id)}}">{{$cars[1]->model->MODL_NAME}} {{$cars[1]->CAR_CATG}} {{$cars[1]->model->MODL_YEAR}}</a>
              <p class="price">{{number_format($cars[1]->CAR_PRCE)}}</p>
              @if(isset($cars[2]))
              <span class="vs">V/s</span>
              @endif
            </li>
            @endif
            @if(isset($cars[2]))
            <li><a href="{{url('car/' . $cars[2]->id)}}">{{$cars[2]->model->MODL_NAME}} {{$cars[2]->CAR_CATG}} {{$cars[2]->model->MODL_YEAR}}</a>
              <p class="price">{{number_format($cars[2]->CAR_PRCE)}}</p>
            </li>
            @endif
          </ul>
        </div>
      </div>
      <div class="compare_product_info">
        <!--Basic-Info-Table-->
        <div class="inventory_info_list">
          <div class="listing_heading">
            <div>BASIC INFO</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
          </div>
          <ul>
            <li class="info_heading">
              <div>Model Year</div>
              <div>Car Type</div>
              <div>Transmission</div>
              <div>Fuel Type</div>
            </li>
            <li>
              <div>{{$cars[0]->model->MODL_YEAR}}</div>
              <div>{{$cars[0]->model->type->TYPE_NAME}}</div>
              <div>{{$cars[0]->CAR_TRNS}}</div>
              <div>Petrol 92, 95</div>
            </li>
            <li>
              @isset($cars[1])
              <div>{{$cars[1]->model->MODL_YEAR}}</div>
              <div>{{$cars[1]->model->type->TYPE_NAME}}</div>
              <div>{{$cars[1]->CAR_TRNS}}</div>
              <div>Petrol 92, 95</div>
              @endisset
            </li>
            <li>
              @isset($cars[2])
              <div>{{$cars[2]->model->MODL_YEAR}}</div>
              <div>{{$cars[2]->model->type->TYPE_NAME}}</div>
              <div>{{$cars[2]->CAR_TRNS}}</div>
              <div>Petrol 92, 95</div>
              @endisset
            </li>
          </ul>
        </div>

        <!--Technical-Specification-Table-->
        <div class="inventory_info_list">
          <div class="listing_heading">
            <div>Technical Specification</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
          </div>
          <ul>
            <li class="info_heading">
              <div>Engine Horse Power</div>
              <div>Engine Torque</div>
              <div>Top Speed</div>
              <div>Acceleration</div>
              <div>Seats</div>
              <div>Ground Clearance</div>
              <div>Car Dimensions</div>
            </li>
            <li>
              <div>{{$cars[0]->CAR_HPWR}}</div>
              <div>{{$cars[0]->CAR_TORQ}}kW</div>
              <div>{{$cars[0]->CAR_TPSP}}km/h</div>
              <div>{{$cars[0]->CAR_ACC}} sec to 100km/h</div>
              <div>{{$cars[0]->CAR_TRNK}}L</div>
              <div>{{$cars[0]->CAR_SEAT}}</div>
              <div>{{$cars[0]->CAR_HEIT}}</div>
              <div>{{$cars[0]->CAR_DIMN}}</div>
            </li>
            <li>
              @isset($cars[1])
              <div>{{$cars[1]->CAR_HPWR}}</div>
              <div>{{$cars[1]->CAR_TORQ}}kW</div>
              <div>{{$cars[1]->CAR_TPSP}}km/h</div>
              <div>{{$cars[1]->CAR_ACC}} sec to 100km/h</div>
              <div>{{$cars[1]->CAR_TRNK}}L</div>
              <div>{{$cars[1]->CAR_SEAT}}</div>
              <div>{{$cars[1]->CAR_HEIT}}</div>
              <div>{{$cars[1]->CAR_DIMN}}</div>
              @endisset
            </li>
            <li>
              @isset($cars[2])
              <div>{{$cars[2]->CAR_HPWR}}</div>
              <div>{{$cars[2]->CAR_TORQ}}kW</div>
              <div>{{$cars[2]->CAR_TPSP}}km/h</div>
              <div>{{$cars[2]->CAR_ACC}} sec to 100km/h</div>
              <div>{{$cars[2]->CAR_TRNK}}L</div>
              <div>{{$cars[2]->CAR_SEAT}}</div>
              <div>{{$cars[2]->CAR_HEIT}}</div>
              <div>{{$cars[2]->CAR_DIMN}}</div>
              @endisset
            </li>
          </ul>
        </div>

        <!--Accessories-->
        <div class="inventory_info_list">
          <div class="listing_heading">
            <div>Accessories</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
          </div>
          <ul>
            <li class="info_heading">
              @foreach($cars[0]['accessories'] as $accessory)
              <div>{{$accessory['ACSR_NAME']}}</div>
              @endforeach
            </li>
            <li>
              @foreach($cars[0]['accessories'] as $accessory)
              <div><i  class="{{($accessory['isAvailable']) ? 'fa fa-check' : 'fa fa-close'}}" aria-hidden="true"> </i> &nbsp; {{$accessory['ACCR_VLUE'] ?? ''}}</div>
              @endforeach
            </li>
            @isset($cars[1])
            <li>
              @foreach($cars[1]['accessories'] as $accessory)
              <div><i  class="{{($accessory['isAvailable']) ? 'fa fa-check' : 'fa fa-close'}}" aria-hidden="true"> </i> &nbsp; {{$accessory['ACCR_VLUE'] ?? ''}}</div>
              @endforeach
            </li>
            @endisset
            @isset($cars[2])
            <li>
              @foreach($cars[2]['accessories'] as $accessory)
              <div><i  class="{{($accessory['isAvailable']) ? 'fa fa-check' : 'fa fa-close'}}" aria-hidden="true"> </i> &nbsp; {{$accessory['ACCR_VLUE'] ?? ''}}</div>
              @endforeach
            </li>
            @endisset
          </ul>
        </div>
        <div class="inventory_info_list text-center">
          <ul>
            <li>&nbsp;</li>
            <li><a href="{{url('car/' . $cars[0]->id)}}" class="btn">View Detail</a></li>
            @isset($cars[1])
            <li><a href="{{url('car/' . $cars[1]->id)}}" class="btn">View Detail</a></li>
            @endisset
            @isset($cars[2])
            <li><a href="{{url('car/' . $cars[2]->id)}}" class="btn">View Detail</a></li>
            @endisset
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/Compare-->

@endsection