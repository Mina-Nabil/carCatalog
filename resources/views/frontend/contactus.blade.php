@extends('layouts.site')

@section('content')
<!--Contact-us-->
<section class="contact_us section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Get in touch using the form below</h3>
                <div class="contact_form gray-bg">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Full Name <span>*</span></label>
                        <input type="text" class="form-control white_bg" id="name" value="{{old('name')}}" required>
                        <small class="text-danger">{{$errors->first('name')}}</small>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email Address <span>*</span></label>
                        <input type="email" class="form-control white_bg" id="email" value="{{old('email')}}" required>
                        <small class="text-danger">{{$errors->first('email')}}</small>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Phone Number <span>*</span></label>
                        <input type="text" class="form-control white_bg" id="phone" value="{{old('phone')}}" required>
                        <small class="text-danger">{{$errors->first('phone')}}</small>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Message <span>*</span></label>
                        <textarea class="form-control white_bg" rows="4" id="message" >{{old('message')}}</textarea>
                        <small class="text-danger">{{$errors->first('message')}}</small>
                    </div>
                    <div class="g-recaptcha form-group" data-sitekey="WEBSITEKEYHERE" data-theme="light" data-size="normal" data-image="image"></div>
                    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                    <div class="form-group">
                        <button class="btn" type="button" onclick="sendEmail()">Send Message <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Contact Info</h3>
                <div class="contact_detail">
                    <ul>
                        @if(isset($contactUs['address']) && strlen($contactUs['address'])>0 )
                        <li>
                            <div class="icon_wrap"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                            <div class="contact_info_m">{{$contactUs['address'] ?? ''}}</div>
                        </li>
                        @endif
                        @if(isset($contactUs['phone1']) && strlen($contactUs['phone1'])>0 )
                        <li>
                            <div class="icon_wrap"><i class="fa fa-phone" aria-hidden="true"></i></div>
                            <div class="contact_info_m"><a target="_blank" href="tel:{{$contactUs['phone1']}}">{{$contactUs['phone1']}}</a></div>
                        </li>
                        @endif
                        @if(isset($contactUs['phone2']) && strlen($contactUs['phone2'])>0 )
                        <li>
                            <div class="icon_wrap"><i class="fa fa-phone" aria-hidden="true"></i></div>
                            <div class="contact_info_m"><a target="_blank" href="tel:{{$contactUs['phone2']}}">{{$contactUs['phone2']}}</a></div>
                        </li>
                        @endif
                        @if(isset($contactUs['email']) && strlen($contactUs['email'])>0 )
                        <li>
                            <div class="icon_wrap"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                            <div class="contact_info_m"><a target="_blank" href="mailto:{{$contactUs['email']}}">{{$contactUs['email']}}</a></div>
                        </li>
                        @endif
                        @if(isset($contactUs['facebook']) && strlen($contactUs['facebook'])>0 )
                        <li>
                            <div class="icon_wrap"><i class="fa fa-facebook-square" aria-hidden="true"></i></div>
                            <div class="contact_info_m"><a target="_blank" href="https://www.fb.com/{{$contactUs['facebook']}}">Check out our Facebook Page</a></div>
                        </li>
                        @endif
                        @if(isset($contactUs['instagram']) && strlen($contactUs['instagram'])>0 )
                        <li>
                            <div class="icon_wrap"><i class="fa fa-instagram-square" aria-hidden="true"></i></div>
                            <div class="contact_info_m"><a target="_blank" href="https://www.fb.com/{{$contactUs['instagram']}}">Check out our Instagram Page</a></div>
                        </li>
                        @endif
                        @if(isset($contactUs['twitter']) && strlen($contactUs['twitter'])>0 )
                        <li>
                            <div class="icon_wrap"><i class="fa fa-twitter-square" aria-hidden="true"></i></div>
                            <div class="contact_info_m"><a target="_blank" href="https://www.twitter.com/{{$contactUs['twitter']}}">Check out our Twitter Page</a></div>
                        </li>
                        @endif
                        @if(isset($contactUs['linkedin']) && strlen($contactUs['linkedin'])>0 )
                        <li>
                            <div class="icon_wrap"><i class="fa fa-linkedin-square" aria-hidden="true"></i></div>
                            <div class="contact_info_m"><a target="_blank" href="https://www.linkedin.com/in/{{$contactUs['linkedin']}}">Check out our Twitter Page</a></div>
                        </li>
                        @endif
                        @if(isset($contactUs['youtube']) && strlen($contactUs['youtube'])>0 )
                        <li>
                            <div class="icon_wrap"><i class="fa fa-youtube-square" aria-hidden="true"></i></div>
                            <div class="contact_info_m"><a target="_blank" href="https://www.youtube.com/c/{{$contactUs['youtube']}}">Check out our Youtube Channel</a></div>
                        </li>
                        @endif
                    </ul>
                    <div class="map_wrap">
                        <?=$contactUs['map']?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Contact-us-->
<script>
    function sendEmail(){
        var http = new XMLHttpRequest();
        var url = "{{$sendMailURL}}" ;

        var name    =  document.getElementById('name');
        var phone   =   document.getElementById('phone');
        var email   =   document.getElementById('email');
        var message    =  document.getElementById('message');

        formBool = name.reportValidity();
        if(!formBool) return;
        formBool = formBool && phone.reportValidity();
        if(!formBool) return;
        formBool = formBool && email.reportValidity();
        if(!formBool) return;
        formBool = formBool && (message.value.length>20);
  
        if(formBool) {
            var formdata = new FormData();
            formdata.append('_token','{{ csrf_token() }}');
            formdata.append('name',name.value);
            formdata.append('phone',phone.value);
            formdata.append('email',email.value);
            formdata.append('message',message.value);
   
            http.open('POST', url, true);
            //Send the proper header information along with the request

            http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText=='1'){
                    Swal.fire({
                    title: "Sent!",
                    text: "Thank you for contacting us, we will get back to you as soon as possible!",
                    icon: "success"
                })
            
                } else {
                    Swal.fire({
                    title: "Sending Failed!",
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
        } else if(message.value.length<=20) {
                Swal.fire({
                    title: "Error!",
                    text: "Very short message, please use more than 20 characters",
                    icon: "error"
                })
        }
        
    }
</script>
@endsection