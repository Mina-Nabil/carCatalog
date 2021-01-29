@extends('layouts.site')

@section('css_content')
<link rel="stylesheet" href="{{asset('assets/frontend/css/home-new.css')}}" type="text/css">
@endsection

@section('content')
<section id="intro-3" @isset($frontendData['Calculator Page']['Calculator Background Image'])
    style="background-image: url({{asset('storage/' . $frontendData['Calculator Page']['Calculator Background Image'])}}) !important" @endisset>
    <div class="container">
        <div class="row">
            <div class="col-md-5">

                <div class="sidebar_widget sidebar_3">
                    <div class="widget_heading">
                        <h5><i class="fa fa-calculator" aria-hidden="true"></i>Loan Calculator</h5>
                    </div>

                    <div class="sidebar_filter">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="select" id=modelCalcSel onchange="getCars()">
                                    <select class="form-control">
                                        <option value="0" disabled selected>Select Model </option>
                                        @foreach($models as $model)
                                        <option value="{{$model->id}}">{{$model->MODL_NAME}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="select">
                                    <select class="form-control" id=carsSel onchange="setPrice()">
                                        <option value=0 disabled selected>Select Car</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Car Price</label>
                                <input class="form-control" title="Car Price" id=priceInput type="text" disabled readonly>
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
                                        <option value="0" disabled selected> Please set downpayment</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Loan Guarantee </label>
                                <div class=row>
                                    <div class="col-6">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="employeeRadio" name="customRadio" class="custom-control-input" onchange="getPlans()">
                                            <label class="custom-control-label" for="employeeRadio">Employee</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="selfRadio" name="customRadio" class="custom-control-input"  onchange="getPlans()">
                                            <label class="custom-control-label" for="selfRadio">Self-Employed</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Remaining Payment</label>
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
                                        <option value="0" disabled selected>Select Insurance </option>
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
                                <button type="submit" class="btn btn-block" id=printButton disabled><i class="fa fa-print" aria-hidden="true"></i> &nbsp; Print </button>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-7">
                <div class="intro-img-wp">
                    <img @if(isset($frontendData['Calculator Page']['Calculator Car Image']) && str_len($frontendData['Calculator Page']['Calculator Car Image'])>0)
                    src="{{asset('storage.' . $frontendData['Calculator Page']['Calculator Car Image'])}}"
                    @else
                    src="{{asset('assets/frontend/images/1243x532.png')}}"
                    @endif

                    alt="image">
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function getCars(){
      
        var modelID = $('#modelCalcSel :selected').val();
        console.log( modelID  )
        var http = new XMLHttpRequest();
        var url = "{{$getCarsURL}}" ;
        var ret = false;
        var formdata = new FormData();

        formdata.append('_token','{{ csrf_token() }}');
        formdata.append('modelID', modelID);

   

        http.open('POST', url, true);

        http.onreadystatechange = function(ret) {
            if (this.readyState == 4 && this.status == 200) {
                try {
                    ret = JSON.parse(this.responseText)
                    loadCars(ret)
                } catch(e) {
                    ret = false;
                }
            }
        };
        http.send(formdata);
        return ret;
    }

    function loadCars(carsArr){
        var carSel = document.getElementById('carsSel');
        var length = carSel.options.length;
        for (i = length-1; i >= 1; i--) {
            //clearing list
            carSel.options[i] = null;
        }
        carsArr.forEach(carItem => {
    
            var option = document.createElement("option");
            option.text = carItem.CAR_CATG;
            option.value = carItem.CAR_PRCE - carItem.CAR_DISC;
            carSel.add(option)
        });
        carSel.disabled = false

        $.toast({
            heading: 'Cars Loaded',
            text: 'You can select a car from the model categories.',
            position: 'top-right',
            loaderBg:'blue',
            icon: 'success',
            hideAfter: 2000, 
            stack: 6,
            type: 'success'
        });
    }

    function setPrice(){
        console.log($('#carsSel :selected').val() )
        $('#priceInput').val( $('#carsSel :selected').val() )
        setRemaining()

    }

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
        percentage = $('#downpaymentSel :selected').text().substr(0,4)
        if($('#priceInput').val() > 0 && percentage>0)
        $('#remainingInput').val( $('#priceInput').val() - ($('#priceInput').val() * parseFloat(percentage) / 100 ) )
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
            }
            option.value = plan.PLAN_INTR + "%&%" + plan.BANK_EXPN + "%&%" + plan.PLAN_INSR;
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
    
            if(remaining > 0 && interest>0 && expenses>0 && years>0){
                var installament = (remaining + (remaining*(interest/100)*years) ) / (12*years)
                $('#monthlyPayments').val(installament)
                $('#expensesInput').val(expenses/100*remaining)
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
            $('#insuranceInput').val(insurance/100*remaining)
            $('#printButton').removeAttr('disabled')
        }
    }



</script>

@endsection