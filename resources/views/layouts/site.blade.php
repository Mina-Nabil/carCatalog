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
              <div class="logo"> <a href="{{url('')}}"><img src="{{asset('assets/frontend/images/logo.png')}}" alt="image" /></a> </div>

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
                <li><a href="{{$aboutusURL}}">About Us</a></li>
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
            <img src="{{(isset($frontendData['Landing Image']['Slide Image 1'])) ? asset('storage/' . $frontendData['Landing Image']['Slide Image 1'] ) : asset('assets/frontend/images/1920x830.jpg')}}" class="img-fluid" alt="image" style="height: 830px">
            <div class="carousel-caption">
              <div class="banner_text text-center div_zindex white-text">
                <h1>{{(isset($frontendData['Landing Image']['Slide Title 1'])) ?? "Find Your Dream Car."}} </h1>
                <h3>{{(isset($frontendData['Landing Image']['Slide Subtitle 2'])) ?? "Find Your Dream Car."}} </h3>
                @isset($frontendData['Landing Image']['Slide Button 1'])
                <?php 
                $buttonArr = explode($frontendData['Landing Image']['Slide Button 1'], "->");
                ?>
                <a href="#" class="btn">Read More</a>
                @endisset
              </div>
            </div>
          </div>

          <!--item-2-->
          <div class="carousel-item">
            <img src="{{(isset($frontendData['Landing Image']['Slide Image 2'])) ? asset('storage/' . $frontendData['Landing Image']['Slide Image 2'] ) : asset('assets/frontend/images/1920x830.jpg')}}" alt="image" class="img-fluid">
            <div class="carousel-caption">
              <div class="banner_text text-center div_zindex white-text">
                <h1>{{(isset($frontendData['Landing Image']['Slide Title 2'])) ?? "Find Your Dream Car."}} </h1>
                <h3>{{(isset($frontendData['Landing Image']['Slide Subtitle 2'])) ?? "Find Your Dream Car."}}</h3>
                @isset($frontendData['Landing Image']['Slide Button 2'])
                <?php  ?>
                <a href="#" class="btn">Read More</a>
                @endisset
              </div>
            </div>
          </div>
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
    <section class="page-header" style="background-image: url('{{$headerImage ?? asset('assets/frontend/images/1920x250.jpg')}}');">
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
              <h6>About Us</h6>
              <ul>
                @if(isset($aboutUs['phone1']) && strlen($aboutUs['phone1'])>0 )
                <li><a href="tel:{{$aboutUs['phone1']}}">Call us: {{$aboutUs['phone1']}}</a></li>
                @endif
                @if(isset($aboutUs['phone2']) && strlen($aboutUs['phone2'])>0 )
                <li><a href="tel:{{$aboutUs['phone2']}}">Call us: {{$aboutUs['phone2']}}</a></li>
                @endif
                @if(isset($aboutUs['email']) && strlen($aboutUs['email'])>0 )
                <li><a href="mailto:{{$aboutUs['email']}}">Our Mail: {{$aboutUs['email']}}</a></li>
                @endif
                @if(isset($aboutUs['address']) && strlen($aboutUs['address'])>0 )
                <li><a href="{{ 'javascript::void(0)'}}">Visit Us on <br>{{$aboutUs['address']}}</a></li>
                @endif
                @if(isset($aboutUs['map']) && strlen($aboutUs['map']) )
                <?=$aboutUs['map']?>
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
                  @if(isset($aboutUs['facebook']) && strlen($aboutUs['facebook'])>0 )
                  <li><a href="https://www.facebook.com/{{$aboutUs['facebook']}}"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                  @endif
                  @if(isset($aboutUs['twitter']) && strlen($aboutUs['twitter'])>0 )
                  <li><a href="https://www.twitter.com/{{$aboutUs['twitter']}}"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                  @endif
                  @if(isset($aboutUs['linkedin']) && strlen($aboutUs['linkedin'])>0 )
                  <li><a href="https://www.linkedin.com/in/{{$aboutUs['facebook']}}"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                  @endif
                  @if(isset($aboutUs['youtube']) && strlen($aboutUs['youtube'])>0 )
                  <li><a href="https://www.youtube.com/c/{{$aboutUs['youtube']}}"><i class="fa fa-youtube-square" aria-hidden="true"></i></a></li>
                  @endif
                  @if(isset($aboutUs['instagram']) && strlen($aboutUs['instagram'])>0 )
                  <li><a href="https://www.instagram.com/{{$aboutUs['instagram']}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
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
                        text: 'You can now visit the compare page to check the latest 3 cars marked for comparison.',
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
</body>

</html>