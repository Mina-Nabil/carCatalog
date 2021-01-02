@extends('layouts.site')

@section('content')
<!--Error-404-->
<section class="error_404 section-padding">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-5">
        <div class="error_text_m">
          <h2>4<span>0</span>4</h2>
          <div class="background_icon"><i class="fa fa-road" aria-hidden="true"></i></div>
        </div>
      </div>
      <div class="col-md-6 col-sm-7">
        <div class="not_found_msg">
          <div class="error_icon"> <i class="fa fa-smile-o" aria-hidden="true"></i> </div>
          <div class="error_msg_div">
            <h3>Oops, <span>Page Can't be Found</span></h3>
            <p>Looks like we sent you the wrong way, let us guide you back ;)</p>
            <a href="{{url('')}}" class="btn">Back to Home <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Error-404-->
@endsection