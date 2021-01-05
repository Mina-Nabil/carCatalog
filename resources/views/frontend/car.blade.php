@extends('layouts.site')

@section('content')
<section class="listing_detail_header">
    <div class="container">
      <div class="listing_detail_head white-text div_zindex row">
        <div class="col-md-9">
          <h2>{{$car->model->MODL_NAME}} {{$car->CAR_CATG}}</h2>
          <div class="car-location"><span> {{$car->model->brand->BRND_NAME}} {{$car->model->MODL_NAME}} {{$car->CAR_CATG}} {{$car->model->MODL_YEAR}}</span></div>
          <div class="add_compare">
            <div class="checkbox">
              <input value="" id="compare14" type="checkbox" onchange="addToCompare(compare14, '{{$car->id}}')"
              @if(in_array($car->id, $compareArr)) 
              checked
              @endif
              >
              <label for="compare14">Add to Compare</label>
            </div>
        
          </div>
        </div>
        <div class="col-md-3">
          <div class="price_info">
            <p>{{number_format($car->CAR_PRCE-$car->CAR_DISC)}}EGP</p>
            @if($car->CAR_DISC > 0)
            <p class="old_price">{{number_format($car->CAR_PRCE)}}EGP</p>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="dark-overlay"></div>
  </section>
<section class="listing_other_info secondary-bg">
    <div class="container">
        <div id="filter_toggle" class="search_other"> <i class="fa fa-filter" aria-hidden="true"></i> Search Cars </div>
        <div id="other_info"><i class="fa fa-info-circle" aria-hidden="true"></i></div>
        {{-- <div id="info_toggle">
        <button type="button" data-toggle="modal" data-target="#schedule"> <i class="fa fa-car" aria-hidden="true"></i> Schedule Test Drive </button>
        <button type="button" data-toggle="modal" data-target="#make_offer"> <i class="fa fa-money" aria-hidden="true"></i> Make an Offer </button>
        <button type="button" data-toggle="modal" data-target="#email_friend"> <i class="fa fa-envelope" aria-hidden="true"></i> Email to a Friend </button>
        <button type="button" data-toggle="modal" data-target="#more_info"> <i class="fa fa-file-text-o" aria-hidden="true"></i> Request More Info </button>
      </div> --}}
    </div>
</section>
<section id="filter_form" class="inner-filter gray-bg">
    <div class="container">
        <h3>Find Your Dream Car <span>(Easy search from here)</span></h3>

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
                    <input id="price_range" type="text" name="priceRange" data-slider-min="{{$carsMin}}" data-slider-max="{{$carsMax}}" data-slider-step="5" data-slider-value="[{{$carsMin+$carsShwya}},{{$carsMax-$carsShwya}}]" />
                </div>
                <div class="form-group col-md-3 col-sm-6">
                    <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car </button>
                </div>
            </div>
        </form>

    </div>
</section>
<section class="listing-detail">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="listing_images">
                    <div id="listing_images_slider" class="listing_images_slider">
                        @foreach($car->images as $carImage)
                        <div><img height="560px" src="{{($carImage->CIMG_URL) ? asset('storage/' . $carImage->CIMG_URL) : asset('assets/frontend/images/900x560.jpg')}}" alt="image"></div>
                        @endforeach
                    </div>
                    <div id="listing_images_slider_nav" class="listing_images_slider_nav">
                        @foreach($car->images as $carImage)
                        <div><img width="300px" src="{{($carImage->CIMG_URL) ? asset('storage/' . $carImage->CIMG_URL) : asset('assets/frontend/images/900x560.jpg')}}" alt="image"></div>
                        @endforeach
                    </div>
                </div>
                <div class="main_features">
                    <ul>
                        <li> <i class="fa fa-tachometer" aria-hidden="true"></i>
                            <h5>{{$car->CAR_ACC}}</h5>
                            <p>Acceleration</p>
                        </li>
                        <li> <i class="fa fa-calendar" aria-hidden="true"></i>
                            <h5>{{$car->model->MODL_YEAR}}</h5>
                            <p>Reg.Year</p>
                        </li>
                        <li> <i class="fa fa-cogs" aria-hidden="true"></i>
                            <h5>{{$car->CAR_TORQ}}</h5>
                            <p>Engine Torque</p>
                        </li>
                        <li> <i class="fa fa-superpowers" aria-hidden="true"></i>
                            <h5>{{$car->CAR_ENCC}}</h5>
                            <p>Engine CC</p>
                        </li>
                        <li> <i class="fa fa-car" aria-hidden="true"></i>
                            <h5>{{$car->CAR_HEIT}}</h5>
                            <p>Ground Clearance</p>
                        </li>
                        <li> <i class="fa fa-database" aria-hidden="true"></i>
                            <h5>{{$car->CAR_TRNK}}L</h5>
                            <p>Gas Trunk</p>
                        </li>
                    </ul>
                </div>
                <div class="listing_more_info">
                    <div class="listing_detail_wrap">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs gray-bg" role="tablist">
                            <li role="presentation"><a class="active" href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab"> Brochure </a></li>
                            <li role="presentation"><a href="#specification" aria-controls="specification" role="tab" data-toggle="tab">Technical Specs</a></li>
                            <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Accessories</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- vehicle-overview -->
                            <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
                                @if(isset($model->MODL_BRCH))
                                <iframe style="border: 1px solid #777; width:100% " src="https://indd.adobe.com/embed/{{$model->MODL_BRCH}}?startpage=1&allowFullscreen=false" height="371px"
                                    frameborder="0" allowfullscreen=""></iframe>
                                @endif
                            </div>

                            <!-- Technical-Specification -->
                            <div role="tabpanel" class="tab-pane" id="specification">
                                <div class="table-responsive">
                                    <!--Basic-Info-Table-->
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="2">BASIC INFO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Model Year</td>
                                                <td>{{$car->model->MODL_YEAR}}</td>
                                            </tr>
                                            <tr>
                                                <td>Car Type</td>
                                                <td>{{$car->model->type->TYPE_NAME}}</td>
                                            </tr>
                                            <tr>
                                                <td>Transmission</td>
                                                <td>{{$car->CAR_TRNS}}</td>
                                            </tr>
                                            <tr>
                                                <td>Fuel Type</td>
                                                <td>Petrol 92, 95</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <!--Technical-Specification-Table-->
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="2">Specification</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Engine Horse Power</td>
                                                <td>{{$car->CAR_HPWR}}</td>
                                            </tr>
                                            <tr>
                                                <td>Engine Torque</td>
                                                <td>{{$car->CAR_TORQ}}kW</td>
                                            </tr>
                                            <tr>
                                                <td>Top Speed</td>
                                                <td>{{$car->CAR_TPSP}}</td>
                                            </tr>
                                            <tr>
                                                <td>Acceleration</td>
                                                <td>{{$car->CAR_ACC}} sec to 100km/h</td>
                                            </tr>  
                                            <tr>
                                                <td>Fuel Tank Capacity</td>
                                                <td>{{$car->CAR_TRNK}}</td>
                                            </tr>
                                            <tr>
                                                <td>Seating Capacity</td>
                                                <td>{{$car->CAR_SEAT}}</td>
                                            </tr>
                                            <tr>
                                                <td>Ground Clearance</td>
                                                <td>{{$car->CAR_HEIT}}</td>
                                            </tr>
                                            <tr>
                                                <td>Car Dimensions</td>
                                                <td>{{$car->CAR_DIMN}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Accessories -->
                            <div role="tabpanel" class="tab-pane" id="accessories">
                                <!--Accessories-->
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan="2">Accessories</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($carAccessories as $accessory)
                                        <tr>
                                            <td>{{$accessory['ACSR_NAME']. "/" .$accessory['ACSR_ARBC_NAME']}}</td>
                                            <td><i  class="{{($accessory['isAvailable']) ? 'fa fa-check' : 'fa fa-close'}}" aria-hidden="true"> </i> &nbsp; {{$accessory['ACCR_VLUE'] ?? ''}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!--Side-Bar-->
            <aside class="col-md-3">
                <div class="sidebar_widget">
                    <div class="widget_heading">
                        <h5><i class="fa fa-calculator" aria-hidden="true"></i> Financing Calculator </h5>
                    </div>
                    <div class="financing_calculatoe">
                        <form action="#" method="get">
                            <div class="form-group">
                                <label class="form-label">Vehicle Price ($)</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Down Price ($)</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Interest Rate</label>
                                <div class="select">
                                    <select class="form-control select">
                                        <option>12%</option>
                                        <option>13%</option>
                                        <option>14%</option>
                                        <option>15%</option>
                                        <option>16%</option>
                                        <option>17%</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Period in Years</label>
                                <div class="select">
                                    <select class="form-control">
                                        <option>3 Year</option>
                                        <option>4 Year</option>
                                        <option>5 Year</option>
                                        <option>6 Year</option>
                                        <option>7 Year</option>
                                        <option>8 Year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block">Calcuate</button>
                            </div>
                        </form>
                    </div>
                </div>


            </aside>
            <!--/Side-Bar-->

        </div>
        <div class="space-20"></div>
        <div class="divider"></div>

        <!--Similar-Cars-->
        <div class="similar_cars">
            <h3>Other Categories</h3>
            <div class="row">
                @foreach($similar as $simCar)
                <div class="col-md-3 grid_listing">
                    <div class="product-listing-m gray-bg">
                        <div class="product-listing-img"> <a href="#"><img src="{{($car->image) ? asset('storage/' . $car->image) : asset('assets/frontend/images/600x380.jpg')}}" class="img-fluid"
                                    alt="image" /> </a>
                            <div class="compare_item">
                                <div class="checkbox">
                                    <input type="checkbox" id="compare13" onchange="addToCompare(this, '{{$car->id}}'" 
                                    @if(in_array($car->id, $compareArr)) 
                                    checked
                                    @endif
                                    >
                                    <label for="compare13">Compare</label>
                                </div>
                            </div>
                        </div>
                        <div class="product-listing-content">
                            <h5><a href="#">{{$simCar->model->MODL_NAME}} - {{$simCar->CAR_CATG}}</a></h5>
                            <p class="list-price">{{number_format($simCar->CAR_PRCE)}}</p>
                            <ul class="features_list">
                                <li><i class="fa fa-database" aria-hidden="true"></i>{{$simCar->CAR_ENCC}}</li>
                                <li><i class="fa fa-calendar" aria-hidden="true"></i>{{$simCar->MODL_YEAR}}</li>
                                <li><i class="fa fa-rocket" aria-hidden="true"></i>{{$simCar->CAR_HPWR}} hp</li>
                                <li><i class="fa fa-tachometer" aria-hidden="true"></i>{{$simCar->CAR_ACC}} sec to 100km/h</li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!--/Similar-Cars-->

    </div>
</section>
@endsection