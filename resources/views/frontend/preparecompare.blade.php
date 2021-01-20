@extends('layouts.site')

@section('content')
<!--Error-404-->
<section class="faq section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div>
                    <img id=carImage1 style="width: 100%; max-height:180px; height:auto;" src="{{asset('images/def-car.png')}}">
                </div>
                <div class="faq_text">
                    <h4>Select a car</h4>
                    <div class="form-group select">
                        <select id=carModel1 class="form-control" onchange="getCars(1)">
                            <option value=0 disabled selected>Select A Model</option>
                            @foreach($models as $model)
                            <option value="{{$model->id}}">{{$model->BRND_NAME}}: {{$model->MODL_NAME}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group select">
                        <select id=car1 class="form-control" onchange="checkCompare()" disabled>
                            <option value=0 disabled selected>Select A Car</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div>
                    <img id=carImage2 style="width: 100%; max-height:180px; height:auto;" src="{{asset('images/def-car.png')}}">
                </div>
                <div class="faq_text">
                    <h4>Select a car</h4>
                    <div class="form-group select">
                        <select id=carModel2 class="form-control" onchange="getCars(2)">
                            <option value=0 disabled selected>Select A Model</option>
                            @foreach($models as $model)
                            <option value="{{$model->id}}">{{$model->BRND_NAME}}: {{$model->MODL_NAME}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group select">
                        <select id=car2 class="form-control" onchange="checkCompare()" disabled>
                            <option value=0 disabled selected>Select A Car</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div>
                    <img id=carImage3 style="width: 100%; max-height:180px; height:auto;" src="{{asset('images/def-car.png')}}">
                </div>
                <div class="faq_text">
                    <h4>Select a car</h4>
                    <div class="form-group select">
                        <select id=carModel3 class="form-control" onchange="getCars(3)">
                            <option value=0 disabled selected>Select A Model</option>
                            @foreach($models as $model)
                            <option value="{{$model->id}}">{{$model->BRND_NAME}}: {{$model->MODL_NAME}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group select">
                        <select id=car3 class="form-control" onchange="checkCompare()" disabled>
                            <option value=0 disabled selected>Select A Car</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div>
                    <img id=carImage4 style="width: 100%; max-height:180px; height:auto;" src="{{asset('images/def-car.png')}}">
                </div>
                <div class="faq_text">
                    <h4>Select a car</h4>
                    <div class="form-group select">
                        <select id=carModel4 class="form-control" onchange="getCars(4)">
                            <option value=0 disabled selected>Select A Model</option>
                            @foreach($models as $model)
                            <option value="{{$model->id}}">{{$model->BRND_NAME}}: {{$model->MODL_NAME}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group select">
                        <select id=car4 class="form-control" onchange="checkCompare()" disabled>
                            <option value=0 disabled selected>Select A Car</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <form method="post" action="{{$compareURL}}">
            <div class="row">
                @csrf
                <input type="hidden" name=car1 id=carInput1 value=0>
                <input type="hidden" name=car2 id=carInput2 value=0>
                <input type="hidden" name=car3 id=carInput3 value=0>
                <input type="hidden" name=car4 id=carInput4 value=0>
                <button id=compareBut class="btn" disabled>Compare Cars</button>
            </div>
        </form>
    </div>
</section>
<!-- /Error-404-->

<script>
    function getCars(i, modelID){
        var modelSel = document.getElementById('carModel' + i)
        var modelID = modelSel.value;
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
                    console.log("get hna")
                    loadCars(i, ret)
                } catch(e) {
                    ret = false;
                }
            }
        };
        http.send(formdata);
        return ret;
    }

    function loadCars(i, carsArr){
        var carSel = document.getElementById('car' + i);

        carsArr.forEach(carItem => {
    
            var option = document.createElement("option");
            option.text = carItem.CAR_CATG;
            option.value = carItem.id;
            carSel.add(option)
        });
        carSel.disabled = false

    }

    function checkCompare(){
        var carSel1 = document.getElementById("car" + 1)
        var carSel2 = document.getElementById("car" + 2)
        var carSel3 = document.getElementById("car" + 3)
        var carSel4 = document.getElementById("car" + 4)

        count = 0

        if(carSel1.value != 0){
            var carInput1 = document.getElementById("carInput" + 1).value = carSel1.value
            count++
        }
        if(carSel2.value != 0){
            var carInput2 = document.getElementById("carInput" + 2).value = carSel2.value
            count++
        }
        if(carSel3.value != 0){
            var carInput3 = document.getElementById("carInput" + 3).value = carSel3.value
            count++
        }
        if(carSel4.value != 0){
            var carInput4 = document.getElementById("carInput" + 4).value = carSel4.value
            count++
        }

        if(count > 1) 
            document.getElementById('compareBut').disabled = false
    }

</script>
@endsection