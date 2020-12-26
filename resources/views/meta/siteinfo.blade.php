@extends('layouts.app')

@section('content')

<script>
    function addNewField(){
        var http = new XMLHttpRequest();
        var url = "{{$addFieldURL}}" ;
        var formdata = new FormData();
        var fieldName = document.getElementById('fieldName').value;
        var sectionSel = document.getElementById('sectionSel');
        selectedSection = sectionSel.options[sectionSel.selectedIndex].value
        var fieldTypeSel = document.getElementById('fieldTypeSel');
        selectedType = fieldTypeSel.options[fieldTypeSel.selectedIndex].value

        //validation
        if(!(selectedSection > 0)){
            Swal.fire({
                title: "Invalid Entry!",
                text: "Please select one of the sections",
                icon: "warning"
            })
            return
        }
        if(selectedType != 1 && selectedType != 2 && selectedType != 3){
            Swal.fire({
                title: "Invalid Entry!",
                text: "Please select one of the fields type",
                icon: "warning"
            })
            return
        }
        if(!(fieldName.length > 2)){
            Swal.fire({
                title: "Invalid Entry!",
                text: "Please enter a field name more than 2 characters",
                icon: "warning"
            })
            return
        }

        formdata.append('section',selectedSection);
        formdata.append('type',selectedType);
        formdata.append('field',fieldName);
        formdata.append('_token','{{ csrf_token() }}');
   
        http.open('POST', url, true);

        http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText=='1'){
                Swal.fire({
                title: "Success!",
                text: "Info successfully updated",
                icon: "success"
            }).then( (val)=>
            location.reload()
            )
            } else if(this.responseText=='0') {
                Swal.fire({
                title: "No Change!",
                text: "Field already exists in the selected section",
                icon: "warning"
            })
            } else {
                Swal.fire({
                title: "No Change!",
                text: "Something went wrong.. Please refresh",
                icon: "warning"
            })
            }

            } else {
                Swal.fire({
                    title: "Error!",
                    text: "Something went wrong.. Please refresh",
                    icon: "error"
                })
            }
        };

        http.send(formdata, true);   
    }

    function updateField(id, isFile){
        var http = new XMLHttpRequest();
        var url = "{{$formURL}}" ;
        var formdata = new FormData();
        formdata.append('_token','{{ csrf_token() }}');
        var contentField = document.getElementById('Field'+id);
        formdata.append('id',id);
        if(isFile){
            content = contentField.files[0]
            formdata.append('content',content);
        } else {
            content = contentField.value
            formdata.append('content',content);
        }
   
        http.open('POST', url, true);

        http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText=='1'){
                Swal.fire({
                title: "Success!",
                text: "Info successfully updated",
                icon: "success"
            })
            } else {
                Swal.fire({
                title: "No Change!",
                text: "Something went wrong.. Please refresh",
                icon: "warning"
            })
            }

        } else {
                Swal.fire({
                    title: "Error!",
                    text: "Something went wrong.. Please refresh",
                    icon: "error"
                })
            }
        };

        http.send(formdata, true);
    }

    function toggleSection(id){

        var http = new XMLHttpRequest();
        var url = "{{$toggleSectionURL}}" +"/" +id ;

        http.open('GET', url);

        http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText=='1'){
                Swal.fire({
                title: "Success!",
                text: "Section successfully updated",
                icon: "success"
            })
            } else {
                Swal.fire({
                title: "No Change!",
                text: "Something went wrong.. Please refresh",
                icon: "warning"
            })
            }

        } else {
                Swal.fire({
                    title: "Error!",
                    text: "Something went wrong.. Please refresh",
                    icon: "error"
                })
            }
        };

        http.send();
    }
</script>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Field</h4>
                <div class="form-group">
                    <label>Section</label>
                    <div class="input-group mb-3">
                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id=sectionSel>
                            <option value="" disabled selected>Pick From Sections</option>
                            @foreach($siteSections as $section)
                            <option value="{{ $section->id }}">{{$section->SECT_NAME}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Field</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <select class="select form-control custom-select" style="width: 100%; height:36px;" id=fieldTypeSel>
                                <option value="" disabled selected>Field Type</option>
                                <option value="1">One Line Text</option>
                                <option value="2">Paragraph</option>
                                <option value="3">Image</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" placeholder="Field Name, e.g Mission, Landing Image" id=fieldName>
                    </div>

                </div>
                <button type="button" onclick="addNewField()" class="btn btn-success mr-2">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $formTitle }}</h3>
                @foreach($siteSections as $section)
                <hr>
                <div class=row>
                    <div class="col-9">
                        <h4 class="card-title">{{ $section->SECT_NAME }}</h4>
                    </div>
                    <div class="col-3">
                        <div class="form-group bt-switch align-self-end"  >
                            <input type="checkbox" data-size="large" {{($section->SECT_ACTV) ? 'checked' : ''}} data-on-color="success" data-off-color="danger" data-on-text="Active" onchange="toggleSection('{{$section->id}}')"     data-off-text="Hidden" id="isActive" >
                        </div>
                    </div>

                </div>
                @foreach ($maindata[$section->id] as $row)
                @switch($row->MAIN_TYPE)
                @case(2)
                <div class="form-group">
                    <label>{{$row->MAIN_ITEM}}</label>
                    <div class=row>
                        <div class="col-9 input-group mb-3">
                            <textarea class="form-control" rows="4" id="Field{{$row->id}}" name=content>{{ $row->MAIN_CNTN ?? '' }}</textarea>
                        </div>
                        <div class="col-3">
                            <button type="button" onclick="updateField('{{$row->id}}',false)" class="btn btn-success mr-2">Update</button>
                        </div>
                    </div>
                </div>
                @break
                @case(3)
                <div class="form-group">
                    <div class=row>
                        <div class="col-9">
                            <label for="input-file-now-custom-1">{{$row->MAIN_ITEM}}</label>
                            <div class="input-group mb-3">
                                <input type="file" name=photo class="dropify" id="Field{{$row->id}}" data-default-file="{{ (isset($row->MAIN_ITEM)) ? asset( 'storage/'. $row->MAIN_CNTN ) : ''}}" />
                            </div>
                        </div>
                        <div class="col-3 align-self-end">
                            <button type="button" onclick="updateField('{{$row->id}}',true)" class="btn btn-success mr-2">Update</button>
                        </div>
                    </div>
                </div>
                @break
                @default
                <div class="form-group">
                    <label>{{$row->MAIN_ITEM}}</label>
                    <div class=row>
                        <div class="col-9 input-group mb-3">
                            <input type="text" class="form-control" id="Field{{$row->id}}" name=content value="{{ $row->MAIN_CNTN ?? '' }}">
                        </div>
                        <div class="col-3">
                            <button type="button" onclick="updateField('{{$row->id}}',false)" class="btn btn-success mr-2">Update</button>
                        </div>
                    </div>
                </div>
                @endswitch
                @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection