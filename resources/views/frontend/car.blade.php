@extends('layouts.site')

@section('content')
<section class="listing_detail_header" @if(isset($car->model->MODL_BGIM) && strlen($car->model->MODL_BGIM) > 0 )
    style="background-image: url('{{asset('storage/' . $car->model->MODL_BGIM )}}')"
    @endif
    >
    <div class="container">
        <div class="listing_detail_head white-text div_zindex row">
            <div class="col-md-9">
                <h2>{{$car->model->MODL_NAME}} {{$car->CAR_CATG}}</h2>
                <div class="car-location"><span> {{$car->model->brand->BRND_NAME}} {{$car->model->MODL_NAME}} {{$car->CAR_CATG}} {{$car->model->MODL_YEAR}}</span></div>
                <div class="add_compare">
                    <div class="checkbox">
                        <input value="" id="compare14" type="checkbox" onchange="addToCompare(compare14, '{{$car->id}}')" @if(in_array($car->id, $compareArr))
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
            </div>


            <!--Side-Bar-->
            <aside class="col-md-3">
                <div class="sidebar_widget">
                    <div class="widget_heading">
                        <h5><i class="fa fa-calculator" aria-hidden="true"></i> Loan Calculator </h5>
                    </div>
                    <div class="financing_calculatoe">
                        <div class="row">

                            <div class="form-group col-md-12">
                                <label>Car Price</label>
                                <input class="form-control" title="Car Price" id=priceInput type="text" value={{$car->CAR_PRCE - $car->CAR_DISC }} disabled readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Downpayment</label>
                                <div class="select">
                                    <select class="form-control" id=downpaymentSel title="Downpayment" onchange="getYears()">
                                        <option value="0" disabled selected>20%-70% </option>
                                        @foreach($downpayments as $down)
                                        <option value="{{$down->id}}">{{$down->DOWN_VLUE}}%</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Years</label>
                                <div class="select">
                                    <select class="form-control" id="yearsSel" title="Installament Years" disabled onchange="getPlans()">
                                        <option value="0" disabled selected> Available options</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Loan Guarantee </label>
                                <div class=row>
                                    <div class="col-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="employeeRadio" name="customRadio" class="custom-control-input" onchange="getPlans()">
                                            <label class="custom-control-label" for="employeeRadio">Employee</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="selfRadio" name="customRadio" class="custom-control-input" onchange="getPlans()">
                                            <label class="custom-control-label" for="selfRadio">Self-Employed</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Paid</label>
                                <input class="form-control" title="Amount to be paid as the downpayment" id=paidInput type="text" disabled readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Remaining</label>
                                <input class="form-control" title="Remaining Payment After Downpayment" id=remainingInput type="text" disabled readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Plan</label>
                                <div class="select">
                                    <select class="form-control" id=plansSel onchange="setPlan()" disabled>
                                        <option value="0" disabled selected>Loan Plans Available </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6 align-self-center">
                                <label>Monthly Payments</label>
                            </div>
                            <div class="form-group col-md-6">
                                <input class="form-control" id=monthlyPayments type="text" disabled readonly>
                            </div>

                            <div class="col-6 align-self-center">
                                <label>Bank Expenses</label>
                            </div>
                            <div class="form-group col-md-6">
                                <input class="form-control" id=expensesInput type="text" disabled readonly>
                            </div>


                            <div class="form-group col-md-6" id=insuranceDiv1 style="display: none">
                                <div class="select" id=insuranceSel onchange="calculateInsurance()">
                                    <select class="form-control">
                                        <option value="0" disabled selected>Insurance </option>
                                        @foreach($insurances as $insurance)
                                        <option value="{{$insurance->INSR_VLUE}}">{{$insurance->INSR_NAME}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6" id=insuranceDiv2 style="display: none">
                                <input class="form-control" id=insuranceInput type="text" disabled readonly>
                            </div>


                            <div class="col-md-3"></div>
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-block" id=printButton onclick="print()" disabled><i class="fa fa-print" aria-hidden="true"></i> </button>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>


            </aside>
        </div>

        <div class=row>
            <div class="col-12">
                <div class="listing_more_info">
                    <div class="listing_detail_wrap">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs gray-bg" role="tablist">
                            <li role="presentation"><a class="active" href="#colors" aria-controls="colors" role="tab" data-toggle="tab">Colors</a></li>
                            <li role="presentation"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab"> Brochure </a></li>
                            <li role="presentation"><a href="#specification" aria-controls="specification" role="tab" data-toggle="tab">Technical Specs</a></li>
                            <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Options</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="colors">
                                <section class="listing-detail">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="listing_images">
                                                    <div id="listing_images_slider2" class="listing_images_slider">
                                                        @foreach($car->model->colorImages as $carImage)
                                                        <div><img height="560px" title="{{$carImage->MOIM_COLR}}"
                                                                src="{{($carImage->MOIM_URL) ? asset('storage/' . $carImage->MOIM_URL) : asset('assets/frontend/images/900x560.jpg')}}" alt="image">
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div id="listing_images_slider_nav2" class="listing_images_slider_nav">
                                                        @foreach($car->model->colorImages as $carImage)
                                                        <div>
                                                            <img width="300px" src="{{($carImage->MOIM_URL) ? asset('storage/' . $carImage->MOIM_URL) : asset('assets/frontend/images/900x560.jpg')}}"
                                                                alt="image">
                                                            <label>{{$carImage->MOIM_COLR}}</label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <!-- vehicle-overview -->
                            <div role="tabpanel" class="tab-pane" id="vehicle-overview">
                                @if(isset($car->model->MODL_BRCH))
                                <iframe style="border: 1px solid #777; width:100% " src="https://indd.adobe.com/embed/{{$car->model->MODL_BRCH}}?startpage=1&allowFullscreen=false" height="371px"
                                    frameborder="0" allowfullscreen=""></iframe>
                                @elseif(isset($car->model->MODL_PDF))
                                <iframe style="border: 1px solid #777; width:100% " src="{{asset('storage/' . $car->model->MODL_PDF)}}" height="371px" frameborder="0" allowfullscreen=""></iframe>
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
                                            <th colspan="2">Car Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($carAccessories as $accessory)
                                        @if($accessory['isAvailable'])
                                        <tr>
                                            <td>{{$accessory['ACSR_NAME']. "/" .$accessory['ACSR_ARBC_NAME']}}</td>
                                            <td><i class="{{($accessory['isAvailable']) ? 'fa fa-check' : 'fa fa-close'}}" aria-hidden="true"> </i> &nbsp; {{$accessory['ACCR_VLUE'] ?? ''}}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                        <div class="product-listing-img"> <a href="{{url('car/' . $simCar->id)}}"><img
                                    src="{{($simCar->image) ? asset('storage/' . $simCar->image) : asset('assets/frontend/images/600x380.jpg')}}" class="img-fluid" alt="image" /> </a>
                            <div class="compare_item">
                                <div class="checkbox">
                                    <input type="checkbox" id="compare13" onchange="addToCompare(this, '{{$simCar->id}}'" @if(in_array($simCar->id, $compareArr))
                                    checked
                                    @endif
                                    >
                                    <label for="compare13">Compare</label>
                                </div>
                            </div>
                        </div>
                        <div class="product-listing-content">
                            <h5><a href="{{url('car/' . $simCar->id)}}">{{$simCar->model->MODL_NAME}} - {{$simCar->CAR_CATG}}</a></h5>
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
    <form id="invisible_form" action="{{$printLoanURL}}" method="post" target="_blank">
        @csrf
        <input id="carIDHidden" name="carID" type="hidden">
        <input id="planIDHidden" name="planID" type="hidden">
        <input id="loanGuaranteeHidden" name="loanGuarantee" type="hidden">
        <input id="downIDHidden" name="downID" type="hidden">
        <input id="paidHidden" name="paid" type="hidden">
        <input id="remainingHidden" name="remaining" type="hidden">
        <input id="yearsHidden" name="years" type="hidden">
        <input id="rateHidden" name="rate" type="hidden">
        <input id="installHidden" name="install" type="hidden">
        <input id="adminFeesHidden" name="adminFees" type="hidden">
        <input id="insuranceCompHidden" name="insuranceComp" type="hidden">
        <input id="insuranceFeesHidden" name="insuranceFees" type="hidden">
    </form>
</section>

<script>
    function getYears(){
      
      var downID = $('#downpaymentSel :selected').val();
      setRemaining()
    
      var http = new XMLHttpRequest();
      var url = "{{$getYearsURL}}" ;
      var ret = false;
      var formdata = new FormData();

      formdata.append('_token','{{ csrf_token() }}');
      formdata.append('downID', downID);

 

      http.open('POST', url, true);

      http.onreadystatechange = function(ret) {
          if (this.readyState == 4 && this.status == 200) {
              try {
                  ret = JSON.parse(this.responseText)
                  loadYears(ret)
              } catch(e) {
                  ret = false;
              }
          }
      };
      http.send(formdata);
      return ret;
    }

    function loadYears(yearsArr){
        var yearsSel = document.getElementById('yearsSel');
        var length = yearsSel.options.length;
        for (i = length-1; i >= 1; i--) {
            //clearing list
            yearsSel.options[i] = null;
        }
        yearsArr.forEach(year => {
    
            var option = document.createElement("option");
            option.text = year.PLAN_YEAR;
            option.value = year.PLAN_YEAR;
            yearsSel.add(option)
        });
        yearsSel.disabled = false
        resetPlan()
        if(yearsArr.length > 0)
            $.toast({
                heading: 'Years Loaded',
                text: 'You can select from the years options available for this downpayment.',
                position: 'top-right',
                loaderBg:'blue',
                icon: 'success',
                hideAfter: 5000, 
                stack: 6,
                type: 'success'
            });
        else
            $.toast({
                heading: 'No Years Found',
                text: 'Please select another downpayment option.',
                position: 'top-right',
                loaderBg:'red',
                icon: 'warning',
                hideAfter: 5000, 
                stack: 6,
                type: 'success'
            });
    }

    function setRemaining(){
        var percentage = $('#downpaymentSel :selected').text().substr(0,4)
        if($('#priceInput').val() > 0 && percentage>0){
            var remaining = $('#priceInput').val() - ($('#priceInput').val() * parseFloat(percentage) / 100 )
            $('#remainingInput').val( remaining )
            $('#paidInput').val( $('#priceInput').val() - remaining )
        }
        setPlan()
    }

    function getPlans(){
        resetPlan()
        var downID = $('#downpaymentSel :selected').val();
        var year = $('#yearsSel :selected').val();

        var isEmployed = $('#employeeRadio:checked').val();
        var selfEmployed = $('#selfRadio:checked').val();

        if(isEmployed == "on"){
                isEmployed = 1
            } else if(selfEmployed == "on") {
                isEmployed = 0
            } else {
                isEmployed = undefined
            }
        if(downID > 0 && year > 0 && isEmployed != undefined ) {

            var http = new XMLHttpRequest();
            var url = "{{$getPlansURL}}" ;
            var ret = false;
            var formdata = new FormData();

            formdata.append('_token','{{ csrf_token() }}');
            formdata.append('downID', downID);
            formdata.append('year', year);
            formdata.append('isEmployed', isEmployed);

            http.open('POST', url, true);

            http.onreadystatechange = function(ret) {
                if (this.readyState == 4 && this.status == 200) {
                    try {
                        ret = JSON.parse(this.responseText)
                        loadPlans(ret)
                    } catch(e) {
                        ret = false;
                    }
                }
            };
            http.send(formdata);
            return ret;
        }
        
    }

    function loadPlans(plansArr){

        var plansSel = document.getElementById('plansSel');
        var length = plansSel.options.length;
        for (i = length-1; i >= 1; i--) {
            //clearing list
            plansSel.options[i] = null;
        }
        plansArr.forEach(plan => {
            var option = document.createElement("option");
            option.text = plan.BANK_NAME + " - Interest: " + plan.PLAN_INTR + "% ";
            if(plan.PLAN_INSR == 1){
                option.text += " (Mandatory Insurance)"
            } else {
                option.text += " (Optional Insurance)"
            }
            option.value = plan.PLAN_INTR + "%&%" + plan.BANK_EXPN + "%&%" + plan.PLAN_INSR + "%&%" + plan.id;
            plansSel.add(option)
        });
        plansSel.disabled = false
        setPlan()
        if(plansArr.length > 0)
            $.toast({
                heading: 'Plans Loaded',
                text: 'You can select the desired plan and get the full installements plan.',
                position: 'top-right',
                loaderBg:'blue',
                icon: 'success',
                hideAfter: 8000, 
                stack: 6,
                type: 'success'
            });
        else
            $.toast({
                heading: 'No Plans Available',
                text: 'Please try another option.',
                position: 'top-right',
                loaderBg:'red',
                icon: 'warning',
                hideAfter: 8000, 
                stack: 6,
                type: 'success'
            });
        
    }

    function setPlan(){
        var remaining = parseFloat($('#remainingInput').val())
        var years = parseInt($('#yearsSel').val())
        planString = $('#plansSel').val()
        if(planString != undefined) {
            var planData =   planString.split("%&%")
            var interest = parseFloat(planData[0]) ?? 0
            var expenses = parseFloat(planData[1]) ?? 0
            var insurance = parseFloat(planData[2]) ?? 0
    
            if(remaining > 0 && interest>0 && expenses>=0 && years>0){
                var installament = (remaining + (remaining*(interest/100)*years) ) / (12*years)
                $('#monthlyPayments').val(round5(installament))
                $('#expensesInput').val(round5(expenses/100*remaining))
                if(insurance == 1){
                    showInsurance()
                    calculateInsurance()
                } else {
                    hideInsurance()
                    $('#printButton').removeAttr('disabled')
                }
            }
        }

    }

    function resetPlan(){
        var plansSel = document.getElementById('plansSel');
        var length = plansSel.options.length;
        for (i = length-1; i >= 1; i--) {
            //clearing list
            plansSel.options[i] = null;
        }
        $('#monthlyPayments').val("")
        $('#expensesInput').val("")
        hideInsurance()
        $('#printButton').attr('disabled')
    }

    function hideInsurance(){
        $('#insuranceDiv1').css("display" ,"none")
        $('#insuranceDiv2').css("display" ,"none")
    }

    function showInsurance(){
        $('#insuranceDiv1').css("display" ,"block")
        $('#insuranceDiv2').css("display" ,"block")
        calculateInsurance();
    }

    function calculateInsurance(){
        var insurance = parseFloat($('#insuranceSel :selected').val())
        var remaining = parseFloat($('#remainingInput').val())
        if(insurance > 0 && remaining > 0) {
            $('#insuranceInput').val(round5(insurance/100*remaining))
            $('#printButton').removeAttr('disabled')
        }
    }

    function round5(x)
    {
        return Math.ceil(x/5)*5;
    }

    function print(){
        //print request

        $('#carIDHidden').val( {{$car->id}} )

        $('#downIDHidden').val( $('#downpaymentSel :selected').val())
        $('#remainingHidden').val( parseFloat($('#remainingInput').val()))
        $('#yearsHidden').val( parseInt($('#yearsSel').val()))
        $('#installHidden').val( $('#monthlyPayments').val())
        $('#adminFeesHidden').val( $('#expensesInput').val())
        $('#paidHidden').val( $('#paidInput').val())
        $('#insuranceFeesHidden').val(  $('#insuranceInput').val())
        $('#insuranceCompHidden').val(  $('#insuranceSel :selected').html())

        var planString = $('#plansSel').val()
        var planData =   planString.split("%&%")
       
        $('#rateHidden').val(parseFloat(planData[0]) ?? 0)
        $('#planIDHidden').val(parseFloat(planData[3]) ?? 0)

        var isEmployed = $('#employeeRadio:checked').val();
        var selfEmployed = $('#selfRadio:checked').val();

        if(isEmployed == "on"){
            $('#loanGuaranteeHidden').val( 1 )
        } else if(selfEmployed == "on") {
            $('#loanGuaranteeHidden').val( 0 )
        } else {
                isEmployed = undefined
        }
        
        $('#invisible_form').submit();
    }

</script>
@endsection