<!DOCTYPE HTML>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <title>Motorcity Showroom</title>
  <!--Bootstrap -->
  <link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap.min.css')}}" type="text/css">
  <!--Custome Style -->
  <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('assets/frontend/colors/blue.css')}}" type="text/css">
  <!--OWL Carousel slider-->
  <link rel="stylesheet" href="{{asset('assets/frontend/css/owl.carousel.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('assets/frontend/css/owl.transitions.css')}}" type="text/css">
  <!--slick-slider -->
  <link href="{{asset('assets/frontend/css/slick.css')}}" rel="stylesheet">
  <!--bootstrap-slider -->
  <link href="{{asset('assets/frontend/css/bootstrap-slider.min.css')}}" rel="stylesheet">
  <!--FontAwesome Font Style -->
  <link href="{{asset('assets/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
  {{-- Toaster CSS --}}
  <link href="{{ asset('assets/frontend/extensions/toast-master/css/jquery.toast.css') }}" rel="stylesheet" type="text/css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  @yield('css_content')

  <!-- Custom Colors -->
  {{-- <link rel="stylesheet" href="{{asset('assets/frontend/colors/red.css')}}"> --}}
  <!--<link rel="stylesheet" href="{{asset('assets/frontend/colors/orange.css')}}">-->

  <!--<link rel="stylesheet" href="{{asset('assets/frontend/colors/pink.css')}}">-->
  <!--<link rel="stylesheet" href="{{asset('assets/frontend/colors/green.css')}}">-->
  <!--<link rel="stylesheet" href="{{asset('assets/frontend/colors/purple.css')}}">-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('assets/frontend/images/favicon-icon/apple-touch-icon-144-precomposed.png')}}">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('assets/frontend/images/favicon-icon/apple-touch-icon-114-precomposed.png')}}">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('assets/frontend/images/favicon-icon/apple-touch-icon-72-precomposed.png')}}">
  <link rel="apple-touch-icon-precomposed" href="{{asset('assets/frontend/images/favicon-icon/apple-touch-icon-57-precomposed.png')}}">
  <link rel="shortcut icon" href="{{asset('assets/frontend/images/favicon-icon/favicon.png')}}">
  <!-- Google-Font-->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

  <!--Header-->
  <header>
    <!--Header-->
    <header class="header_style2 nav-stacked affix-top" data-spy="affix" data-offset-top="1">
      <!-- Navigation -->
      <nav id="navigation_bar" class="navbar navbar-expand-lg">
        <div class="container">
          <div class="row header-row">
            <div class="navbar-header">
              <div class="logo"> <a href="{{url('')}}"><img @if(isset($frontendData['Header']['Logo']) && (strlen($frontendData['Header']['Logo'])>0) )
                  src="{{asset('storage/' . $frontendData['Header']['Logo'])}}"
                  @else
                  src="{{asset('assets/frontend/images/logo.png')}}"
                  @endif
                  alt="image" /></a> </div>

              <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggler" type="button">
                <i class="fa fa-bars"></i>
              </button>
            </div>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="nav navbar-nav">
                <li><a href="{{url('/')}}">Home</a></li>


                <li class="dropdown"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cars</a>
                  <ul class="dropdown-menu">
                    @foreach ($models as $model)
                    <li><a href="{{url('model/' . $model->id)}}">{{$model->MODL_NAME}} - {{$model->MODL_YEAR}}</a></li>
                    @endforeach
                  </ul>
                </li>
                <li><a href="{{$compareURL}}">Compare</a></li>
                <li><a href="{{$calculateURL}}">Calculate Loan</a></li>
                <li><a href="{{$contactusURL}}">Contact Us</a></li>
              </ul>
            </div>
            <div class="header_wrap">
            </div>
          </div>
        </div>
      </nav>
      <!-- Navigation end -->

    </header>
    <!-- /Header -->
    @if($isHeader)
    @if(isset($carouselHeader) && $carouselHeader && $frontendData['Landing Image']['Active'])
    <section id="banner2">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <!--item-1-->
          <div class="carousel-item active">
            <img
              src="{{(isset($frontendData['Landing Image']['Slide Image 1'])) ? asset('storage/' . $frontendData['Landing Image']['Slide Image 1'] ) : asset('assets/frontend/images/1920x830.jpg')}}"
              class="img-fluid" alt="image" style="max-height: 830px; height:auto; width:100%">
            <div class="carousel-caption">
              <div class="banner_text text-center div_zindex white-text">
                <h1>{{$frontendData['Landing Image']['Slide Title 1'] ?? "" }}</h1>
                <h3 style="margin-top: 5px"  >{{$frontendData['Landing Image']['Slide Subtitle 1'] ?? "" }}</h3>
                @if(($frontendData['Landing Image']['Slide Button 1']) && (strlen($frontendData['Landing Image']['Slide Button 1'])>0) )
                <?php 
                $buttonArr = explode("->", $frontendData['Landing Image']['Slide Button 1']);
                ?>
                <a style="margin-top: 5px" href="{{url($buttonArr[1])}}" class="btn">{{$buttonArr[0]}}</a>
                @endif
              </div>
            </div>
          </div>

          <!--item-2-->
          <div class="carousel-item">
            <img
              src="{{(isset($frontendData['Landing Image']['Slide Image 2'])) ? asset('storage/' . $frontendData['Landing Image']['Slide Image 2'] ) : asset('assets/frontend/images/1920x830.jpg')}}"
              alt="image" class="img-fluid" style="max-height: 830px; height:auto; width:100%">
            <div class="carousel-caption">
              <div class="banner_text text-center div_zindex white-text">
                <h1>{{$frontendData['Landing Image']['Slide Title 2'] ?? ""}}</h1>
                <h3>{{$frontendData['Landing Image']['Slide Subtitle 2'] ?? "" }}</h3>
                @if(($frontendData['Landing Image']['Slide Button 2']) && strlen($frontendData['Landing Image']['Slide Button 2']))
                <?php 
                $buttonArr = explode( "->", $frontendData['Landing Image']['Slide Button 2']);
                ?>
                <a href="{{url($buttonArr[1])}}" class="btn">{{$buttonArr[0]}}</a>
                @endif
              </div>
            </div>
          </div>

          @if(isset($frontendData['Landing Image']['Slide Image 3']) && (strlen($frontendData['Landing Image']['Slide Image 3'])>0) )
          <div class="carousel-item">
            <img
              src="{{(isset($frontendData['Landing Image']['Slide Image 3'])) ? asset('storage/' . $frontendData['Landing Image']['Slide Image 3'] ) : asset('assets/frontend/images/1920x830.jpg')}}"
              alt="image" class="img-fluid" style="max-height: 830px; height:auto; width:100%">
            <div class="carousel-caption">
              <div class="banner_text text-center div_zindex white-text">
                <h1>{{$frontendData['Landing Image']['Slide Title 3'] ?? ""}} </h1>
                <h3>{{$frontendData['Landing Image']['Slide Subtitle 3'] ?? ""}}</h3>
                @if(($frontendData['Landing Image']['Slide Button 3']) && strlen($frontendData['Landing Image']['Slide Button 3'])>0 )
                <?php 
                $buttonArr = explode( "->", $frontendData['Landing Image']['Slide Button 3']);
                ?>
                <a href="{{url($buttonArr[1])}}" class="btn">{{$buttonArr[0]}}</a>
                @endif
              </div>
            </div>
          </div>
          @endif

          @if(isset($frontendData['Landing Image']['Slide Image 4']) && (strlen($frontendData['Landing Image']['Slide Image 4'])>0) )
          <div class="carousel-item">
            <img
              src="{{(isset($frontendData['Landing Image']['Slide Image 4'])) ? asset('storage/' . $frontendData['Landing Image']['Slide Image 4'] ) : asset('assets/frontend/images/1920x830.jpg')}}"
              alt="image" class="img-fluid" style="max-height: 830px; height:auto; width:100%">
            <div class="carousel-caption">
              <div class="banner_text text-center div_zindex white-text">
                <h1>{{$frontendData['Landing Image']['Slide Title 4'] ?? ""}} </h1>
                <h3>{{$frontendData['Landing Image']['Slide Subtitle 4'] ?? ""}}</h3>
                @if(($frontendData['Landing Image']['Slide Button 4']) && strlen($frontendData['Landing Image']['Slide Button 4'])>0)
                <?php 
                $buttonArr = explode("->", $frontendData['Landing Image']['Slide Button 4']);
                ?>
                <a href="{{url($buttonArr[1])}}" class="btn">{{$buttonArr[0]}}</a>
                @endif
              </div>
            </div>
          </div>
          @endif

          @if(isset($frontendData['Landing Image']['Slide Image 5']) && (strlen($frontendData['Landing Image']['Slide Image 5'])>0) )
          <div class="carousel-item">
            <img
              src="{{(isset($frontendData['Landing Image']['Slide Image 5'])) ? asset('storage/' . $frontendData['Landing Image']['Slide Image 5'] ) : asset('assets/frontend/images/1920x830.jpg')}}"
              alt="image" class="img-fluid" style="max-height: 830px; height:auto; width:100%">
            <div class="carousel-caption">
              <div class="banner_text text-center div_zindex white-text">
                <h1>{{$frontendData['Landing Image']['Slide Title 5'] ?? ""}} </h1>
                <h3>{{$frontendData['Landing Image']['Slide Subtitle 5'] ?? ""}}</h3>
                @if(($frontendData['Landing Image']['Slide Button 5']) && strlen($frontendData['Landing Image']['Slide Button 5'])>0 )
                <?php 
                $buttonArr = explode( "->", $frontendData['Landing Image']['Slide Button 5']);
                ?>
                <a href="{{url($buttonArr[1])}}" class="btn">{{$buttonArr[0]}}</a>
                @endif
              </div>
            </div>
          </div>
          @endif
        </div>

        <!-- Controls -->
        <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
      </div>
    </section>
    @elseif($frontendData['Header']['Active'])
    <!--Page Header-->
    <section class="page-header" style="background-image: url('{{$headerImage ?? asset('assets/frontend/images/1920x250.jpg')}}');" style="height: 250px">
      <div class="container">
        <div class="page-header_wrap">
          <div class="page-heading">
            <h1>{{$pageTitle}}</h1>
          </div>
          @if($pageSubtitle)
          <ul class="coustom-breadcrumb">
            <li>{{$pageSubtitle}}</li>
          </ul>
          @endif
        </div>
      </div>
      <!-- Dark Overlay-->
      <div class="dark-overlay"></div>
    </section>
    <!-- /Page Header-->

    @endif
    @endif

    @yield('content')

    <!--Brands-->
    <section class="brand-section gray-bg">
      <div class="container">
        <div class="brand-hadding">
          <h5>Popular Brands</h5>
        </div>
        <div class="brand-logo-list">
          <div id="popular_brands">
            @foreach ($partners as $partner)
            <div><a href="http://{{$partner->PRTR_URL}}"><img style='height:60px'
                  src="{{ (isset($partner->PRTR_IMGE)) ? asset( 'storage/'. $partner->PRTR_IMGE ) : asset('assets/frontend/images/100x60.png')}}" class="img-fluid" alt="image"></a></div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
    <!-- /Brands-->

    <!--Footer -->
    <footer>
      <div class="footer-top">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-sm-6">
              <h6>Top Cars</h6>
              <ul>
                @foreach ($topCars as $car)
                <li><a href="{{url('car/' .  $car->id)}}">{{$car->model->brand->BRND_NAME}}: {{$car->model->MODL_NAME}}-{{$car->CAR_CATG}} {{$car->model->MODL_YEAR}}</a></li>

                @endforeach
              </ul>
            </div>
            <div class="col-md-4 col-sm-6">
              <h6>Contact Us</h6>
              <ul>
                @if(isset($contactUs['phone1']) && strlen($contactUs['phone1'])>0 )
                <li><a href="tel:{{$contactUs['phone1']}}">Call us: {{$contactUs['phone1']}}</a></li>
                @endif
                @if(isset($contactUs['phone2']) && strlen($contactUs['phone2'])>0 )
                <li><a href="tel:{{$contactUs['phone2']}}">Call us: {{$contactUs['phone2']}}</a></li>
                @endif
                @if(isset($contactUs['email']) && strlen($contactUs['email'])>0 )
                <li><a href="mailto:{{$contactUs['email']}}">Our Mail: {{$contactUs['email']}}</a></li>
                @endif
                @if(isset($contactUs['address']) && strlen($contactUs['address'])>0 )
                <li><a href="{{ 'javascript::void(0)'}}">Visit Us on <br>{{$contactUs['address']}}</a></li>
                @endif
                @if(isset($contactUs['map']) && strlen($contactUs['map']) )
                <?=$contactUs['map']?>
                @endif
              </ul>
            </div>
            <div class="col-md-4 col-sm-0">
              <h6>Partners</h6>
              <ul>
                @foreach ($partners as $partner)
                <li><a href="http://{{$partner->PRTR_URL}}">{{$partner->PRTR_NAME}}</a></li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="container">
          <div class="row">

            <div class="col-md-6 ">
              <p class="copy-right">Copyright &copy; 2021 mSquare Apps. All Rights Reserved</p>
            </div>
            <div class="col-md-6 text-right">
              <div class="footer_widget">
                <p>Connect with Us:</p>
                <ul>
                  @if(isset($contactUs['facebook']) && strlen($contactUs['facebook'])>0 )
                  <li><a href="https://www.facebook.com/{{$contactUs['facebook']}}"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                  @endif
                  @if(isset($contactUs['instagram']) && strlen($contactUs['instagram'])>0 )
                  <li><a href="https://www.instagram.com/{{$contactUs['instagram']}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                  @endif
                  @if(isset($contactUs['twitter']) && strlen($contactUs['twitter'])>0 )
                  <li><a href="https://www.twitter.com/{{$contactUs['twitter']}}"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                  @endif
                  @if(isset($contactUs['linkedin']) && strlen($contactUs['linkedin'])>0 )
                  <li><a href="https://www.linkedin.com/in/{{$contactUs['linkedin']}}"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                  @endif
                  @if(isset($contactUs['youtube']) && strlen($contactUs['youtube'])>0 )
                  <li><a href="https://www.youtube.com/c/{{$contactUs['youtube']}}"><i class="fa fa-youtube-square" aria-hidden="true"></i></a></li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- /Footer-->

    <!--Back to top-->
    <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
    <!--/Back to top-->

    <!-- Scripts -->
    <script src="{{asset('assets/frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/interface.js')}}"></script>
    <!--bootstrap-slider-JS-->
    <script src="{{asset('assets/frontend/js/bootstrap-slider.min.js')}}"></script>
    <!--Slider-JS-->
    <script src="{{asset('assets/frontend/js/slick.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/frontend/extensions/toast-master/js/jquery.toast.js') }}"></script>

    <script>
      function addToCompare(checkaya, carID){
          var http = new XMLHttpRequest();
        if(checkaya.checked==true){
          var url = "{{$addToCompareURL}}" ;
        } else {
          var url = "{{$removeFromCompareURL}}" ;
        }
          var formdata = new FormData();
          formdata.append('carID',carID);
          formdata.append('_token','{{ csrf_token() }}');
          http.open('POST', url, true);
          http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              if(checkaya.checked==true){
                $.toast({
                        heading: 'Car ready for Compare',
                        text: 'You can now visit the compare page to check the latest 4 cars marked for comparison.',
                        position: 'top-right',
                        loaderBg:'blue',
                        icon: 'success',
                        hideAfter: 5000, 
                        stack: 6,
                        type: 'success'
                    });
              }
          }
          }
          
          http.send(formdata, true);
      }

    </script>

    <script>
      $(function () {
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>

    @yield('js_content')
</body>

</html>