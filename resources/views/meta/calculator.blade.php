@extends('layouts.app')

@section('content')
<div class="row">
    {{-- <div class="col-lg-8 col-12">
        <x-datatable :id="$id??'myTable'" :title="$title" :subtitle="$subTitle" :cols="$cols" :items="$items" :atts="$atts" />
    </div> --}}

    <div class="col-lg-12 col-12">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="m-b-0 text-white">Add New Plan</h4>
            </div>
            <div class="card-body">
                <form class="form pt-3" id=planForm method="post" action="{{ url($addPlanURL) }}" enctype="multipart/form-data">
                    <input name=id id=planID type="hidden">
                    @csrf
                    <div class=row>
                        <div class=col-2>
                            <div class="form-group">
                                <select name=downpayment id=downSel class="select form-control custom-select" required>
                                    <option value="" disabled selected>Downpayments</option>
                                    @foreach($downpayments as $down)
                                    <option value="{{ $down->id }}" {{($down->id == old('bank')) ? 'selected' : '' }}>{{$down->DOWN_VLUE}}%</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{$errors->first('downpayment')}}</small>
                            </div>
                        </div>
                        <div class=col-2>
                            <div class="form-group">
                                <select name=bank id=bankSel class="select form-control custom-select" required>
                                    <option value="" disabled selected>Banks</option>
                                    @foreach($banks as $bank)
                                    <option id="bankOption{{$bank->id}}" value="{{ $bank->id }}" {{($bank->id == old('bank')) ? 'selected' : '' }}>{{$bank->BANK_NAME}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{$errors->first('bank')}}</small>
                            </div>
                        </div>
                        <div class=col-2>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="number" id=interestInput step=0.001 min=0 class="form-control" placeholder="Interest" name=interest value="{{old('interest')}}" required>
                                </div>
                                <small class="text-danger">{{$errors->first('interest')}}</small>
                            </div>
                        </div>
                        <div class=col-2>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="number" step=1 min=2 id=yearsInput class="form-control" placeholder="Years" name=years value="{{old('years')}}" required>
                                </div>
                                <small class="text-danger">{{$errors->first('years')}}</small>
                            </div>
                        </div>
                        <div class=col-2>
                            <div class="form-group bt-switch">
                                <div class=" m-b-15">
                                    <input type="checkbox" data-size="meduim" id=insuranceCheck checked data-on-color="success" data-off-color="danger" data-on-text="Insurance" data-off-text="No" name="isInsurance">
                                </div>
                            </div>
                        </div>
                        <div class=col-2>
                            <div class="form-group bt-switch">
                                <div class=" m-b-15">
                                    <input type="checkbox" data-size="small" id=employeeCheck checked data-on-color="success" data-off-color="danger" data-on-text="Employed" data-off-text="No" name="isEmployed">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=row>
                        <div class="col-3 m-r-2">
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                        </div>
                        <div id="cancelPlan" class="col-3 m-r-2" style="display: none">
                            <button type="button" onclick="cancelEditPlan()" class="btn btn-dark mr-2">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-12">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="m-b-0 text-white">Plans</h4>
            </div>
            <div class="card-body">
                <x-datatable :id="$id??'myTable'" :title="$title" :subtitle="$subTitle" :cols="$cols" :items="$items" :atts="$atts" />
            </div>
        </div>
    </div>


    <div class="col-lg-5 col-12">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="m-b-0 text-white">Add Banks</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class=row>
                        <input type="hidden" class="form-control" id=bankID value=0>
                        <div class=col-6>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon11"><i class="fas fa-donate"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Name*" id=bankName required>
                                </div>
                            </div>
                        </div>
                        <div class=col-6>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon11"><i class="far fa-money-bill-alt"></i></span>
                                    </div>
                                    <input type="number" step=0.001 class="form-control" placeholder="Expenses*" id=bankExpenses required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=row>
                        <div class="col-2 m-r-10">
                            <button type="button" onclick="submitBankForm()" class="btn btn-success">Submit</button>
                        </div>
                        <div class="col-2 m-r-10">
                            <button type="button" onclick="cancelBankForm()" class="btn btn-dark">Cancel</button>
                        </div>
                        <div class="col-2 m-r-10">
                            <button type="button" style="display: none" id="deleteBankButton" class="btn btn-danger mr-2">Delete</button>
                        </div>
                    </div>
                </form>
                <hr>
                <label>Available Banks</label>
                <ul class="list-group" id=bankList>
                    @foreach($banks as $bank)
                    <a id="bankItem{{$bank->id}}" href="javascript:void(0)" onclick="setupEditBank({{$bank->id}})" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 text-dark" id="bankName{{$bank->id}}">{{$bank->BANK_NAME}}</h5>
                            <small id="bankExpenses{{$bank->id}}">{{$bank->BANK_EXPN}}</small>
                        </div>
                    </a>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="m-b-0 text-white">Add Insurance Company</h4>
            </div>
            <div class="card-body">
                <form>
                    <input type="hidden" class="form-control" id=insuranceID value=0>
                    <div class=row>
                        <div class=col-6>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon11"><i class="fas fa-list"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Name*" id=insuranceName required>
                                </div>
                            </div>
                        </div>
                        <div class=col-6>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon11"><i class="fas fa-percent"></i></span>
                                    </div>
                                    <input type="number" step=0.001 class="form-control" placeholder="Interest*" id=insuranceRate required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=row>
                        <div class="col-2 m-r-10">
                            <button type="button" onclick="submitInsuranceForm()" class="btn btn-success mr-2">Submit</button>
                        </div>
                        <div class="col-2 m-r-10">
                            <button type="button" onclick="cancelInsuranceForm()" class="btn btn-dark mr-2">Cancel</button>
                        </div>
                        <div class="col-2 m-r-10">
                            <button type="button" style="display: none" id="deleteInsuranceButton" class="btn btn-danger mr-2">Delete</button>
                        </div>
                    </div>
                </form>
                <hr>
                <label>Available Companies</label>
                <ul class="list-group" id=insuranceList>
                    @foreach($insurances as $insurance)
                    <a id="insuranceItem{{$insurance->id}}" href="javascript:void(0)" onclick="setupEditInsurance({{$insurance->id}})"
                        class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 text-dark" id="insuranceName{{$insurance->id}}">{{$insurance->INSR_NAME}}</h5>
                            <small id="insuranceRate{{$insurance->id}}">{{$insurance->INSR_VLUE}}</small>
                        </div>
                    </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    ///////plan function
    function editPlan(id){
       $('#planID').val(id)
       $('#downSel').val( $('#planDown'+id).val() )
       $('#bankSel').val( $('#planBank'+id).val() )
       $('#interestInput').val( $('#planInterest'+id).val() )
       $('#yearsInput').val( $('#planYear'+id).val() )
       console.log($('#planInsurance'+id).val())
       
       if ($('#planInsurance'+id).val() == 1) {
            $('#insuranceCheck').bootstrapSwitch('state', true, true);
       } else {
            $('#insuranceCheck').bootstrapSwitch('state', false, true);
       }

       if ($('#planEmployed'+id).val() == 1) {
            $('#employeeCheck').bootstrapSwitch('state', true, true);
       } else {
            $('#employeeCheck').bootstrapSwitch('state', false, true);
       }
       
       $('#planForm').attr('action', '{{url($editPlanURL)}}')
 
       $('#cancelPlan').css("display", "block")

       $.toast({
            heading: 'Plan Data loaded',
            text: 'You can now edit plan data.',
            position: 'top-right',
            loaderBg:'blue',
            icon: 'success',
            hideAfter: 1000, 
            stack: 6,
            type: 'success'
        });
    }

    function cancelEditPlan(){
        $('#planID').val("")
        $('#downSel').val("")
        $('#bankSel').val( "" )
        $('#interestInput').val( "" )
        $('#yearsInput').val("")
        $('#insuranceCheck').bootstrapSwitch('state', true, true);
        $('#employeeCheck').bootstrapSwitch('state', true, true);
      
        $('#planForm').attr('action', '{{url($addPlanURL)}}')
    
        $('#cancelPlan').css("display", "none")

        $.toast({
                heading: 'Plan Data loaded',
                text: 'You can now edit plan data.',
                position: 'top-right',
                loaderBg:'blue',
                icon: 'success',
                hideAfter: 1000, 
                stack: 6,
                type: 'success'
            });
    }
    ///////banks functions
    function submitBankForm(){
        var bankID = document.getElementById('bankID')
        var bankName = document.getElementById('bankName')
        var bankExpenses = document.getElementById('bankExpenses')

        formBool = bankName.reportValidity();
        if(!formBool) return;
        formBool = formBool && bankExpenses.reportValidity();
        if(!formBool) return;

        var bankID = bankID.value
        var bankName = bankName.value
        var bankExpenses = bankExpenses.value

        var formData = new FormData();
        formData.append('_token','{{ csrf_token() }}');
        formData.append("name", bankName)
        formData.append("expenses", bankExpenses)
        var url;
        if(bankID > 0) {
            url = "{{$editBankURL}}"
            formData.append("id", bankID)
        }
        else 
            url = "{{$addBankURL}}"

        var http = new XMLHttpRequest();
        http.open("POST", url)

        http.onreadystatechange = function (){
            if(this.readyState=4 && this.status == 200 && IsNumeric(this.responseText) ){
                    Swal.fire({
                        title: "Success!",
                        text: "Bank successfully added",
                        icon: "success"
                    })
                    if(bankID > 0) {
                        editBankItem(bankID, bankName, bankExpenses)
                    } else {
                        console.log(bankExpenses)
                        addBankItem(this.responseText, bankName, bankExpenses)
                    }      
            } else {
                    Swal.fire({
                        title: "Error!",
                        text: "Oops Something went wrong!",
                        icon: "error"
                    })
                }
            }

        http.send(formData)

    }

    function addBankItem(id, name, rate){
        var bankList = document.getElementById('bankList')
        console.log(rate);
        bankList.innerHTML += '  <a id="bankItem'+id+'" href="javascript:void(0)" onclick="setupEditBank('+id+')"\
                class="list-group-item list-group-item-action flex-column align-items-start">\
                        <div class="d-flex w-100 justify-content-between">\
                            <h5 class="mb-1 text-dark" id="bankName'+id+'">'+name+'</h5>\
                            <small id="bankExpenses'+id+'">'+rate+'</small>\
                        </div>\
                    </a>';
        
        var bankSel = document.getElementById('bankSel');
        var newBankOption = document.createElement('option')
        newBankOption.value = id;
        newBankOption.id = "bankOption" + id;
        newBankOption.innerHTML = name;
        bankSel.appendChild(newBankOption)
        
        cancelBankForm(false)
    }

    function editBankItem(id, name, rate){
        var bankListItem = document.getElementById('bankItem' +id)
        bankListItem.innerHTML = ' <div class="d-flex w-100 justify-content-between">\
                            <h5 class="mb-1 text-dark" id="bankName'+id+'">'+name+'</h5>\
                            <small id="bankExpenses'+id+'">'+rate+'</small>\
                        </div>'
        var bankOption = document.getElementById("bankOption" + id)
        bankOption.innerHTML = name;
        cancelBankForm(false)
    }

    function setupEditBank(id){
        document.getElementById('bankID').value   = id
        document.getElementById('bankName').value = document.getElementById('bankName' + id).innerHTML
        document.getElementById('bankExpenses').value = document.getElementById('bankExpenses' + id).innerHTML

        var deleteBankButton = document.getElementById('deleteBankButton')
        deleteBankButton.style = "display: block"
        deleteBankButton.setAttribute( "onClick", "deleteBankItem(" + id + ")" );
        $.toast({
                    heading: 'Bank Data loaded',
                    text: 'You can now edit bank data.',
                    position: 'top-right',
                    loaderBg:'blue',
                    icon: 'success',
                    hideAfter: 1000, 
                    stack: 6,
                    type: 'success'
                    });
    }

    function deleteBankItem(id){
        Swal.fire({
                        title: "Warning!",
                        text: "Are you sure you want to delete this bank and all the related plans?",
                        icon: "warning"
                    }).then((confirmed) => {
                        if(confirmed.value) {
                            var bankListItem = document.getElementById('bankItem' +id)
                            var bankListOption = document.getElementById('bankOption' +id)
                            var formData = new FormData();
                            formData.append('_token','{{ csrf_token() }}');
                            formData.append("id", id)
                            var http = new XMLHttpRequest();
                            http.open("POST", "{{$delBankURL}}")
                            http.onreadystatechange = function (){
                                if(this.readyState=4 && this.status == 200 && IsNumeric(this.responseText) ){
                                        Swal.fire({
                                            title: "Success!",
                                            text: "Bank successfully deleted, please refresh to update the plans table",
                                            icon: "success"
                                        })    
                                        bankListItem.style = "display: none"
                                        bankListOption.remove()
                                } else {
                                        Swal.fire({
                                            title: "Error!",
                                            text: "Oops Something went wrong!",
                                            icon: "error"
                                        })
                                    }
                                }
                                http.send(formData)

                                cancelBankForm(false)
                        }
                    })
        
                }
        
    function cancelBankForm(showToast=true){
        document.getElementById('bankID').value   = 0
        document.getElementById('bankName').value = ""
        document.getElementById('bankExpenses').value = ""
        var deleteBankButton = document.getElementById('deleteBankButton')
        deleteBankButton.style = "display: none"
        deleteBankButton.onclick = ""
        if(showToast)
        $.toast({
                    heading: 'Bank Data cleared',
                    position: 'top-right',
                    loaderBg:'blue',
                    icon: 'success',
                    hideAfter: 1000, 
                    stack: 6,
                    type: 'success'
                    });
    }

    ///////insurance functions
    function submitInsuranceForm(){
        var insuranceID = document.getElementById('insuranceID')
        var insuranceName = document.getElementById('insuranceName')
        var insuranceRate = document.getElementById('insuranceRate')

        formBool = insuranceName.reportValidity();
        if(!formBool) return;
        formBool = formBool && insuranceRate.reportValidity();
        if(!formBool) return;

        var insuranceID = insuranceID.value
        var insuranceName = insuranceName.value
        var insuranceRate = insuranceRate.value

        var formData = new FormData();
        formData.append('_token','{{ csrf_token() }}');
        formData.append("name", insuranceName)
        formData.append("rate", insuranceRate)
        var url;
        if(insuranceID > 0) {
            url = "{{$editInsuranceURL}}"
            formData.append("id", insuranceID)
        }
        else 
            url = "{{$addInsuranceURL}}"

        var http = new XMLHttpRequest();
        http.open("POST", url)

        http.onreadystatechange = function (){
            if(this.readyState=4 && this.status == 200 && IsNumeric(this.responseText) ){
                    Swal.fire({
                        title: "Success!",
                        text: "Insurance successfully added",
                        icon: "success"
                    })
                    if(insuranceID > 0) {
                        editInsuranceItem(insuranceID, insuranceName, insuranceRate)
                    } else {
                        console.log(insuranceRate)
                        addInsuranceItem(this.responseText, insuranceName, insuranceRate)
                    }      
            } else {
                    Swal.fire({
                        title: "Error!",
                        text: "Oops Something went wrong!",
                        icon: "error"
                    })
                }
            }

        http.send(formData)

    }

    function addInsuranceItem(id, name, rate){
        var insuranceList = document.getElementById('insuranceList')
        console.log(rate);
        insuranceList.innerHTML += '  <a id="insuranceItem'+id+'" href="javascript:void(0)" onclick="setupEditInsurance('+id+')"\
                class="list-group-item list-group-item-action flex-column align-items-start">\
                        <div class="d-flex w-100 justify-content-between">\
                            <h5 class="mb-1 text-dark" id="insuranceName'+id+'">'+name+'</h5>\
                            <small id="insuranceRate'+id+'">'+rate+'</small>\
                        </div>\
                    </a>';
        
        cancelInsuranceForm(false)
    }

    function editInsuranceItem(id, name, rate){
        var insuranceListItem = document.getElementById('insuranceItem' +id)
        insuranceListItem.innerHTML = ' <div class="d-flex w-100 justify-content-between">\
                            <h5 class="mb-1 text-dark" id="insuranceName'+id+'">'+name+'</h5>\
                            <small id="insuranceRate'+id+'">'+rate+'</small>\
                        </div>'
        cancelInsuranceForm(false)
    }

    function setupEditInsurance(id){
        document.getElementById('insuranceID').value   = id
        document.getElementById('insuranceName').value = document.getElementById('insuranceName' + id).innerHTML
        document.getElementById('insuranceRate').value = document.getElementById('insuranceRate' + id).innerHTML
        console.log( document.getElementById('insuranceName'))
        var deleteInsuranceButton = document.getElementById('deleteInsuranceButton')
        deleteInsuranceButton.style = "display: block"
        deleteInsuranceButton.setAttribute( "onClick", "deleteInsuranceItem(" + id + ")" );
        $.toast({
                    heading: 'Insurance Data loaded',
                    text: 'You can now edit insurance data.',
                    position: 'top-right',
                    loaderBg:'blue',
                    icon: 'success',
                    hideAfter: 1000, 
                    stack: 6,
                    type: 'success'
                    });
    }

    function deleteInsuranceItem(id){
        var insuranceListItem = document.getElementById('insuranceItem' +id)
        var formData = new FormData();
        formData.append('_token','{{ csrf_token() }}');
        formData.append("id", id)
        var http = new XMLHttpRequest();
        http.open("POST", "{{$delInsuranceURL}}")
        http.onreadystatechange = function (){
            if(this.readyState=4 && this.status == 200 && IsNumeric(this.responseText) ){
                    Swal.fire({
                        title: "Success!",
                        text: "Insurance successfully deleted",
                        icon: "success"
                    })    
                    insuranceListItem.style = "display: none"
            } else {
                    Swal.fire({
                        title: "Error!",
                        text: "Oops Something went wrong!",
                        icon: "error"
                    })
                }
            }

        http.send(formData)

        cancelInsuranceForm(false)
    }

    function cancelInsuranceForm(showToast=true){
        document.getElementById('insuranceID').value   = 0
        document.getElementById('insuranceName').value = ""
        document.getElementById('insuranceRate').value = ""
        var deleteInsuranceButton = document.getElementById('deleteInsuranceButton')
        deleteInsuranceButton.style = "display: none"
        deleteInsuranceButton.onclick = ""
        if(showToast)
        $.toast({
                    heading: 'Insurance Data cleared',
                    position: 'top-right',
                    loaderBg:'blue',
                    icon: 'success',
                    hideAfter: 1000, 
                    stack: 6,
                    type: 'success'
                    });
    }

</script>
@endsection