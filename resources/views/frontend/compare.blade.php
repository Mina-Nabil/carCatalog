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
        @if(isset($cars[3]))
        vs ({{$cars[3]->model->MODL_NAME}} {{$cars[3]->CAR_CATG}} {{$cars[3]->model->MODL_YEAR}})
        @endif
      </h4>
      <div class="compare_product_img">
        <div class="inventory_info_list">
          <ul>
            <li id="filter_toggle" class="search_other_inventory" style="height:auto; width:{{$headerWidth}}%; max-height: 145px"><i class="fa fa-search" style="color: white;" aria-hidden="true"></i>
              Search Other Inventory</li>
            <li style="width:{{$headerWidth}}%"><a href="{{url('car/' . $cars[0]->id)}}"><img
                  src="{{(isset($cars[0]->image)) ? asset( 'storage/'. $cars[0]->image ) : asset('assets/frontend/images/600x380.jpg')}}" style="max-height: 145px" alt="image"></a></li>
            @if(isset($cars[1]))
            <li style="width:{{$headerWidth}}%"><a href="{{url('car/' . $cars[1]->id)}}"><img
                  src="{{(isset($cars[1]->image)) ? asset( 'storage/'. $cars[1]->image ) : asset('assets/frontend/images/600x380.jpg')}}" style="max-height: 145px" alt="image"></a></li>
            @endif
            @if(isset($cars[2]))
            <li style="width:{{$headerWidth}}%"><a href="{{url('car/' . $cars[2]->id)}}"><img
                  src="{{(isset($cars[2]->image)) ? asset( 'storage/'. $cars[2]->image ) : asset('assets/frontend/images/600x380.jpg')}}" style="max-height: 145px" alt="image"></a></li>
            @endif
            @if(isset($cars[3]))
            <li style="width:{{$headerWidth}}%"><a href="{{url('car/' . $cars[3]->id)}}"><img
                  src="{{(isset($cars[3]->image)) ? asset( 'storage/'. $cars[3]->image ) : asset('assets/frontend/images/600x380.jpg')}}" style="max-height: 145px" alt="image"></a></li>
            @endif
          </ul>
        </div>

      </div>
      <div class="compare_product_title gray-bg">
        <div class="inventory_info_list">
          <ul>
            <li class="listing_heading" style="width:{{$headerWidth}}%">Compare <br>
              Cars <span class="td_divider"></span></li>
            <li style="width:{{$headerWidth}}%"><a href="{{url('car/' . $cars[0]->id)}}">{{$cars[0]->model->MODL_NAME}} {{$cars[0]->CAR_CATG}} {{$cars[0]->model->MODL_YEAR}}</a>
              <p class="price">{{number_format($cars[0]->CAR_PRCE)}}</p>
              @if(isset($cars[1]))
              <span class="vs">V/s</span>
              @endif
            </li>
            @if(isset($cars[1]))
            <li style="width:{{$headerWidth}}%"><a href="{{url('car/' . $cars[1]->id)}}">{{$cars[1]->model->MODL_NAME}} {{$cars[1]->CAR_CATG}} {{$cars[1]->model->MODL_YEAR}}</a>
              <p class="price">{{number_format($cars[1]->CAR_PRCE)}}</p>
              @if(isset($cars[2]))
              <span class="vs">V/s</span>
              @endif
            </li>
            @endif
            @if(isset($cars[2]))
            <li style="width:{{$headerWidth}}%"><a href="{{url('car/' . $cars[2]->id)}}">{{$cars[2]->model->MODL_NAME}} {{$cars[2]->CAR_CATG}} {{$cars[2]->model->MODL_YEAR}}</a>
              <p class="price">{{number_format($cars[2]->CAR_PRCE)}}</p>
              @if(isset($cars[3]))
              <span class="vs">V/s</span>
              @endif
            </li>
            @endif
            @if(isset($cars[3]))
            <li style="width:{{$headerWidth}}%"><a href="{{url('car/' . $cars[3]->id)}}">{{$cars[3]->model->MODL_NAME}} {{$cars[3]->CAR_CATG}} {{$cars[3]->model->MODL_YEAR}}</a>
              <p class="price">{{number_format($cars[3]->CAR_PRCE)}}</p>
            </li>
            @endif
          </ul>
        </div>
      </div>
      <div class="compare_product_info">
        <!--Basic-Info-Table-->
        <div class="inventory_info_list">
          <table>
            <thead>
              <tr>
                <th style="width:{{$headerWidth}}%">BASIC INFO</th>
                <th style="width:{{$headerWidth}}%">&nbsp;</th>
                @isset($cars[1])
                <th style="width:{{$headerWidth}}%">&nbsp;</th>
                @endisset
                @isset($cars[2])
                <th style="width:{{$headerWidth}}%">&nbsp;</th>
                @endisset
                @isset($cars[3])
                <th style="width:{{$headerWidth}}%">&nbsp;</th>
                @endisset
              </tr>
            </thead>
            <tbody>
              <tr>
                <td  style="width:{{$headerWidth}}%" >Model Year</td>
                <td  style="width:{{$headerWidth}}%" >{{$cars[0]->model->MODL_YEAR}}</td>
                @isset($cars[1])
                <td  style="width:{{$headerWidth}}%" >{{$cars[1]->model->MODL_YEAR}}</td>
                @endisset
                @isset($cars[2])
                <td  style="width:{{$headerWidth}}%" >{{$cars[2]->model->MODL_YEAR}}</td>
                @endisset
                @isset($cars[3])
                <td  style="width:{{$headerWidth}}%" >{{$cars[3]->model->MODL_YEAR}}</td>
                @endisset
              </tr>
              <tr>
                <td  style="width:{{$headerWidth}}%" >Car Type</td>
                <td  style="width:{{$headerWidth}}%" >{{$cars[0]->model->type->TYPE_NAME}}</td>
                @isset($cars[1])
                <td  style="width:{{$headerWidth}}%" >{{$cars[1]->model->type->TYPE_NAME}}</td>
                @endisset
                @isset($cars[2])
                <td  style="width:{{$headerWidth}}%" >{{$cars[2]->model->type->TYPE_NAME}}</td>
                @endisset
                @isset($cars[3])
                <td  style="width:{{$headerWidth}}%" >{{$cars[3]->model->type->TYPE_NAME}}</td>
                @endisset
              </tr>
              <tr>
                <td  style="width:{{$headerWidth}}%" >Transmission</td>
                <td  style="width:{{$headerWidth}}%" >{{$cars[0]->CAR_TRNS}}</td>
                @isset($cars[1])
                <td  style="width:{{$headerWidth}}%" >{{$cars[1]->CAR_TRNS}}</td>
                @endisset
                @isset($cars[2])
                <td  style="width:{{$headerWidth}}%" >{{$cars[2]->CAR_TRNS}}</td>
                @endisset
                @isset($cars[3])
                <td  style="width:{{$headerWidth}}%" >{{$cars[3]->CAR_TRNS}}</td>
                @endisset
              </tr>
              <tr>
                <td  style="width:{{$headerWidth}}%" >Fuel Type</td>
                <td  style="width:{{$headerWidth}}%" >Petrol 92, 95</td>
                @isset($cars[1])
                <td  style="width:{{$headerWidth}}%" >Petrol 92, 95</td>
                @endisset
                @isset($cars[2])
                <td  style="width:{{$headerWidth}}%" >Petrol 92, 95</td>
                @endisset
                @isset($cars[3])
                <td  style="width:{{$headerWidth}}%" >Petrol 92, 95</td>
                @endisset
              </tr>
            </tbody>
          </table>
        </div>

        <!--Technical-Specification-Table-->
        <div class="inventory_info_list">
          <table>
            <thead>
              <tr>
                <th>Technical Specification</th>
                <th>&nbsp;</th>
                @isset($cars[1])
                <th>&nbsp;</th>
                @endisset
                @isset($cars[2])
                <th>&nbsp;</th>
                @endisset
                @isset($cars[3])
                <th>&nbsp;</th>
                @endisset
              </tr>
            </thead>
            <tbody>
              <tr>
                <td  style="width:{{$headerWidth}}%" >Engine Horse Power</td>
                <td  style="width:{{$headerWidth}}%" >{{$cars[0]->CAR_HPWR}}</td>
                @isset($cars[1])
                <td  style="width:{{$headerWidth}}%" >{{$cars[1]->CAR_HPWR}}</td>
                @endisset
                @isset($cars[2])
                <td  style="width:{{$headerWidth}}%" >{{$cars[2]->CAR_HPWR}}</td>
                @endisset
                @isset($cars[3])
                <td  style="width:{{$headerWidth}}%" >{{$cars[3]->CAR_HPWR}}</td>
                @endisset
              </tr>
              <tr>
                <td  style="width:{{$headerWidth}}%" >Engine Torque</td>
                <td  style="width:{{$headerWidth}}%" >{{$cars[0]->CAR_TORQ}}kW</td>
                @isset($cars[1])
                <td  style="width:{{$headerWidth}}%" >{{$cars[1]->CAR_TORQ}}kW</td>
                @endisset
                @isset($cars[2])
                <td  style="width:{{$headerWidth}}%" >{{$cars[2]->CAR_TORQ}}kW</td>
                @endisset
                @isset($cars[3])
                <td  style="width:{{$headerWidth}}%" >{{$cars[3]->CAR_TORQ}}kW</td>
                @endisset
              </tr>
              <tr>
                <td  style="width:{{$headerWidth}}%" >Top Speed</td>
                <td  style="width:{{$headerWidth}}%" >{{$cars[0]->CAR_TPSP}}km/h</td>
                @isset($cars[1])
                <td  style="width:{{$headerWidth}}%" >{{$cars[1]->CAR_TPSP}}km/h</td>
                @endisset
                @isset($cars[2])
                <td  style="width:{{$headerWidth}}%" >{{$cars[2]->CAR_TPSP}}km/h</td>
                @endisset
                @isset($cars[3])
                <td  style="width:{{$headerWidth}}%" >{{$cars[3]->CAR_TPSP}}km/h</td>
                @endisset
              </tr>
              <tr>
                <td  style="width:{{$headerWidth}}%" >Acceleration</td>
                <td  style="width:{{$headerWidth}}%" >{{$cars[0]->CAR_ACC}}s to 100km/h</td>
                @isset($cars[1])
                <td  style="width:{{$headerWidth}}%" >{{$cars[1]->CAR_ACC}}s to 100km/h</td>
                @endisset
                @isset($cars[2])
                <td  style="width:{{$headerWidth}}%" >{{$cars[2]->CAR_ACC}}s to 100km/h</td>
                @endisset
                @isset($cars[3])
                <td  style="width:{{$headerWidth}}%" >{{$cars[3]->CAR_ACC}}s to 100km/h</td>
                @endisset
              </tr>
              <tr>
                <td  style="width:{{$headerWidth}}%" >Gas Trunk</td>
                <td  style="width:{{$headerWidth}}%" >{{$cars[0]->CAR_TRNK}}L</td>
                @isset($cars[1])
                <td  style="width:{{$headerWidth}}%" >{{$cars[1]->CAR_TRNK}}L</td>
                @endisset
                @isset($cars[2])
                <td  style="width:{{$headerWidth}}%" >{{$cars[2]->CAR_TRNK}}L</td>
                @endisset
                @isset($cars[3])
                <td  style="width:{{$headerWidth}}%" >{{$cars[3]->CAR_TRNK}}L</td>
                @endisset
              </tr>
              <tr>
                <td  style="width:{{$headerWidth}}%" >Seats</td>
                <td  style="width:{{$headerWidth}}%" >{{$cars[0]->CAR_SEAT}}</td>
                @isset($cars[1])
                <td  style="width:{{$headerWidth}}%" >{{$cars[1]->CAR_SEAT}}</td>
                @endisset
                @isset($cars[2])
                <td  style="width:{{$headerWidth}}%" >{{$cars[2]->CAR_SEAT}}</td>
                @endisset
                @isset($cars[3])
                <td  style="width:{{$headerWidth}}%" >{{$cars[3]->CAR_SEAT}}</td>
                @endisset
              </tr>
              <tr>
                <td  style="width:{{$headerWidth}}%" >Ground Clearance</td>
                <td  style="width:{{$headerWidth}}%" >{{$cars[0]->CAR_HEIT}}</td>
                @isset($cars[1])
                <td  style="width:{{$headerWidth}}%" >{{$cars[1]->CAR_HEIT}}</td>
                @endisset
                @isset($cars[2])
                <td  style="width:{{$headerWidth}}%" >{{$cars[2]->CAR_HEIT}}</td>
                @endisset
                @isset($cars[3])
                <td  style="width:{{$headerWidth}}%" >{{$cars[3]->CAR_HEIT}}</td>
                @endisset
              </tr>
              <tr>
                <td  style="width:{{$headerWidth}}%" >Car Dimensions</td>
                <td  style="width:{{$headerWidth}}%" >{{$cars[0]->CAR_DIMN}}</td>
                @isset($cars[1])
                <td  style="width:{{$headerWidth}}%" >{{$cars[1]->CAR_DIMN}}</td>
                @endisset
                @isset($cars[2])
                <td  style="width:{{$headerWidth}}%" >{{$cars[2]->CAR_DIMN}}</td>
                @endisset
                @isset($cars[3])
                <td  style="width:{{$headerWidth}}%" >{{$cars[3]->CAR_DIMN}}</td>
                @endisset
              </tr>
            </tbody>
          </table>
        </div>
        <!--Accessories-->
        <div class="inventory_info_list">
          <table>
            <thead>
              <tr>
                <th>Accessories</th>
                <th></th>
                @isset($cars[1])
                <th></th>
                @endisset
                @isset($cars[2])
                <th></th>
                @endisset
                @isset($cars[3])
                <th></th>
                @endisset
              </tr>
            </thead>
            <tbody>
              @foreach($cars[0]['accessories'] as $key => $accessory)
              @if(
              $cars[1]['accessories'][$key]['isAvailable'] ||
              (isset($cars[1]) && $cars[1]['accessories'][$key]['isAvailable'] ) ||
              (isset($cars[2]) && $cars[2]['accessories'][$key]['isAvailable'] ) ||
              (isset($cars[3]) && $cars[3]['accessories'][$key]['isAvailable'] ) )
              <tr>
                <td  style="width:{{$headerWidth}}%" >{{$accessory['ACSR_NAME']}}/{{$accessory['ACSR_ARBC_NAME']}}</td>
                <td  style="width:{{$headerWidth}}%" ><i class="{{($accessory['isAvailable']) ? 'fa fa-check' : 'fa fa-close'}}" aria-hidden="true"> </i> &nbsp; {{$accessory['ACCR_VLUE'] ?? ''}}</td>
                @isset($cars[1])
                <td  style="width:{{$headerWidth}}%" ><i class="{{($cars[1]['accessories'][$key]['isAvailable']) ? 'fa fa-check' : 'fa fa-close'}}" aria-hidden="true"> </i> &nbsp; {{$cars[1]['accessories'][$key]['ACCR_VLUE'] ?? ''}}
                </td>
                @endisset
                @isset($cars[2])
                <td  style="width:{{$headerWidth}}%" ><i class="{{($cars[2]['accessories'][$key]['isAvailable']) ? 'fa fa-check' : 'fa fa-close'}}" aria-hidden="true"> </i> &nbsp; {{$cars[2]['accessories'][$key]['ACCR_VLUE'] ?? ''}}
                </td>
                @endisset
                @isset($cars[3])
                <td  style="width:{{$headerWidth}}%" ><i class="{{($cars[3]['accessories'][$key]['isAvailable']) ? 'fa fa-check' : 'fa fa-close'}}" aria-hidden="true"> </i> &nbsp; {{$cars[3]['accessories'][$key]['ACCR_VLUE'] ?? ''}}
                </td>
                @endisset
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="inventory_info_list text-center">
          <ul>
            <li style="width:{{$headerWidth}}%;align-content: center;">&nbsp;</li>
            <li class=justify-content-center style="width:{{$headerWidth}}%"><a href="{{url('car/' . $cars[0]->id)}}" class="btn">View Car Details</a></li>
            @isset($cars[1])
            <li style="width:{{$headerWidth}}%;align-content: center;"><a href="{{url('car/' . $cars[1]->id)}}" class="btn">View Car Details</a></li>
            @endisset
            @isset($cars[2])
            <li style="width:{{$headerWidth}}%;align-content: center;"><a href="{{url('car/' . $cars[2]->id)}}" class="btn">View Car Details</a></li>
            @endisset
            @isset($cars[3])
            <li style="width:{{$headerWidth}}%;align-content: center;"><a href="{{url('car/' . $cars[3]->id)}}" class="btn">View Car Details</a></li>
            @endisset
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/Compare-->

@endsection