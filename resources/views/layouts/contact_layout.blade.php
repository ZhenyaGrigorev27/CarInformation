<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title>@yield('title')</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<link rel="shortcut icon" href="{{asset('assets/front/images/favicon.ico')}}" type="image/x-icon" />
<link rel="apple-touch-icon" href="{{asset('assets/front/mages/apple-touch-icon.png')}}">
<link rel="stylesheet" href="{{asset('assets/front/css/front.css')}}">
<!-- Design fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>

<div id="wrapper">
    @include('layouts.navbar')

    @yield('page_title')

    <section class="section lb">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="sidebar">
                        <div class="widget-no-style">
                            <div class="newsletter-widget text-center align-self-center">
                                <h3>Подпишитесь на нас!</h3>
                                <p>Подпишитесь на нашу еженедельную рассылку новостей и получайте обновления по электронной почте</p>
                                <div class="col-12">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success">
                                            {{session('success')}}
                                        </div>
                                    @endif
                                </div>
                                <form action="{{route('subscription.store')}}" class="form-inline" method="post">
                                    @csrf
                                    <input type="email" name="email" class="form-control" placeholder="Введите ваш Email" value="{{old('email')}}" required>
                                    <input type="submit" value="Подписаться" class="btn btn-default btn-block" />
                                </form>
                            </div><!-- end newsletter -->
                        </div>

                        <div id="" class="widget">
                            <h2 class="widget-title">Реклама</h2>
                            <div class="banner-spot clearfix">
                                <div class="banner-img">
                                    <a href="https://www.kia.ru/models/ceed/desc/"><img src="/assets/front/images/kia-ceed-20.jpg" alt="" class="img-fluid"></a>
                                </div><!-- end banner-img -->
                            </div><!-- end banner -->
                            <p class="lead">Новый KIA Ceed 2020 уже в продаже</p>
                        </div><!-- end widget -->

                    </div><!-- end sidebar -->
                </div><!-- end col -->

                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">

                    @yield('content')

                </div><!-- end col -->

            </div><!-- end row -->
        </div><!-- end container -->
    </section>

    @include('layouts.footer')

    <div class="dmtop">Вернуться наверх</div>

</div><!-- end wrapper -->
<script src="{{asset('assets/front/js/front.js')}}"></script>

</body>
</html>





