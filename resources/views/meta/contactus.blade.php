@extends('layouts.app')

@section('content')

<script>
    function updateField(item){
        var http = new XMLHttpRequest();
        var url = "{{$formURL}}" ;
        var formdata = new FormData();
        formdata.append('_token','{{ csrf_token() }}');
        var content = document.getElementById(item+'Field').value;
        formdata.append('item',item);
        formdata.append('content',content);
   
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
</script>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $formTitle }}</h4>
                <hr>
                <div class="form-group">
                    <label>Email</label>
                    <div class=row>
                        <div class="col-9 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="fas fa-at"></i></span>
                            </div>
                            <input type="email" class="form-control" placeholder="Email Address" id=emailField name=content value="{{ $email ?? '' }}" required>
                        </div>
                        <div class="col-3">
                            <button type="button" onclick="updateField('email')" class="btn btn-success mr-2">Update</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label>Phone Number #1</label>
                    <div class=row>
                        <div class="col-9 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Phone Number" id=phone1Field value="{{ $phone1 ?? '' }}" required>
                        </div>
                        <div class="col-3">
                            <button type="button" onclick="updateField('phone1')" class="btn btn-success mr-2">Update</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label>Phone Number #2</label>
                    <div class=row>
                        <div class="col-9 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Phone Number" id=phone2Field value="{{ $phone2 ?? '' }}" required>
                        </div>
                        <div class="col-3">
                            <button type="button" onclick="updateField('phone2')" class="btn btn-success mr-2">Update</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label>Map</label>
                    <div class=row>
                        <div class="col-9 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="fas fa-map"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Map Pin Longitude Value" id=mapField value="{{ $map ?? '' }}" required>
                        </div>
                        <div class="col-3">
                            <button type="button" onclick="updateField('map')" class="btn btn-success mr-2">Update</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label>Address</label>
                    <div class=row>
                        <div class="col-9 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Showroom Address" id=addressField value="{{ $address ?? '' }}" required>
                        </div>
                        <div class="col-3">
                            <button type="button" onclick="updateField('address')" class="btn btn-success mr-2">Update</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label>Facebook</label>
                    <div class=row>
                        <div class="col-9 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="fab fa-facebook"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Facebook Page ID" id=facebookField value="{{ $facebook ?? '' }}" required>
                        </div>
                        <div class="col-3">
                            <button type="button" onclick="updateField('facebook')" class="btn btn-success mr-2">Update</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label>Youtube Channel</label>
                    <div class=row>
                        <div class="col-9 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="fab fa-youtube"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Youtube Channel ID" id=youtubeField value="{{ $youtube ?? '' }}" required>
                        </div>
                        <div class="col-3">
                            <button type="button" onclick="updateField('youtube')" class="btn btn-success mr-2">Update</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label>Instagram Channel</label>
                    <div class=row>
                        <div class="col-9 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="fab fa-instagram"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Instagram Channel ID" id=instagramField value="{{ $instagram ?? '' }}" required>
                        </div>
                        <div class="col-3">
                            <button type="button" onclick="updateField('instagram')" class="btn btn-success mr-2">Update</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label>Twitter Page</label>
                    <div class=row>
                        <div class="col-9 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="fab fa-twitter"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Twitter Page ID" id=twitterField value="{{ $twitter ?? '' }}" required>
                        </div>
                        <div class="col-3">
                            <button type="button" onclick="updateField('twitter')" class="btn btn-success mr-2">Update</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label>LinkedIn Page</label>
                    <div class=row>
                        <div class="col-9 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon11"><i class="fab fa-linkedin"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="LinkedIn Page ID" id=linkedinField value="{{ $linkedin ?? '' }}" required>
                        </div>
                        <div class="col-3">
                            <button type="button" onclick="updateField('linkedin')" class="btn btn-success mr-2">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection