<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with FoodHut landing page.">
    <meta name="author" content="Devcrud">
    <title>Poncho Empanadas</title>

    <!-- font icons -->
    <link rel="stylesheet" href="{{ asset('vendors/themify-icons/css/themify-icons.css') }}">

    <link rel="stylesheet" href="{{ asset('vendors/animate/animate.css') }}">

    <!-- Bootstrap + FoodHut main styles -->
    <link rel="stylesheet" href="{{ asset('css/foodhut.css') }}">

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
    <style>
        .bg-difuminado {
            background-color: rgba(128, 128, 128, 0.6);
            padding: 10px;
            border-radius: 5px;
        }
    </style>
    <!-- Navbar -->
    <nav class="custom-navbar navbar navbar-expand-lg navbar-dark fixed-top" data-spy="affix" data-offset-top="10">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
               {{--  <li class="nav-item">
                    <a class="nav-link" href="#about">Sobre Nosotros</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="#gallary">Categorias</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#book-table">Book-Table</a>
                </li> --}}
            </ul>
            <a class="navbar-brand m-auto" href="#">
                {{-- <img src="imgs/logo.svg" class="brand-img" alt=""> --}}
                <span class="brand-txt">Poncho Empanadas Argentinas</span>
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#blog">Compras<span class="sr-only">(current)</span></a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#testmonial">Reviews</a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#contact">Contactanos</a>
                </li> --}}
                <li class="nav-item">
                    @if (Route::has('login'))
                        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary ml-xl-4">Dashboard</a>
                                {{-- <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a> --}}
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary ml-xl-4">Login</a>
                                {{-- <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a> --}}

                                @if (Route::has('register'))
                                    {{-- <a href="{{ route('register') }}" class="btn btn-primary ml-xl-4">Register</a> --}}
                                    {{-- <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a> --}}
                                @endif
                            @endauth
                        </div>
                    @endif

                </li>
            </ul>
        </div>
    </nav>
    <!-- header -->
    <header id="home" class="header">
        <div class="overlay text-white text-center">
            <h1 class="display-2 font-weight-bold my-3">Poncho</h1>
            <h2 class="display-4 mb-5">Empanadas Argentinas</h2>
            <a class="btn btn-lg btn-primary" href="#gallary">Productos</a>
        </div>
    </header>

    <!--  About Section  -->
    {{-- <div id="about" class="container-fluid wow fadeIn" id="about"data-wow-duration="1.5s">
        <div class="row">
            <div class="col-lg-6 has-img-bg"></div>
            <div class="col-lg-6">
                <div class="row justify-content-center">
                    <div class="col-sm-8 py-5 my-5">
                        <h2 class="mb-4">Sobre Nosotros</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, quisquam accusantium nostrum modi, nemo, officia veritatis ipsum facere maxime assumenda voluptatum enim! Labore maiores placeat impedit, vero sed est voluptas!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita alias dicta autem, maiores doloremque quo perferendis, ut obcaecati harum, <br><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum necessitatibus iste,
                        nulla recusandae porro minus nemo eaque cum repudiandae quidem voluptate magnam voluptatum? <br>Nobis, saepe sapiente omnis qui eligendi pariatur. quis voluptas. Assumenda facere adipisci quaerat. Illum doloremque quae omnis vitae.</p>
                        <p><b>Lonsectetur adipisicing elit. Blanditiis aspernatur, ratione dolore vero asperiores explicabo.</b></p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos ab itaque modi, reprehenderit fugit soluta, molestias optio repellat incidunt iure sed deserunt nemo magnam rem explicabo vitae. Cum, nostrum, quidem.</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!--  gallary Section  -->
    <div id="gallary" class="text-center bg-dark text-light has-height-md middle-items wow fadeIn">
        <h2 class="section-title">Categorias</h2>
    </div>
    <div class="gallary row">
        @isset($categories)
            @foreach ($categories as $category)
                <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
                    <div style="position: relative;">
                        <img src="{{ asset('storage/' . $category->image) }}" alt="" class="gallary-img">
                        <a href="#" class="gallary-overlay">
                            <i class="gallary-icon ti-plus"></i>
                        </a>
                        <div class="gallary-item-text"
                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white;">
                            <div class="gallary-item-content bg-difuminado">
                                <h2>{{ $category->name }}</h2>
                                <p>{{ $category->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endisset
    </div>

    <!-- book a table Section  -->
    {{-- <div class="container-fluid has-bg-overlay text-center text-light has-height-lg middle-items" id="book-table">
        <div class="">
            <h2 class="section-title mb-5">BOOK A TABLE</h2>
            <div class="row mb-5">
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="email" id="booktable" class="form-control form-control-lg custom-form-control" placeholder="EMAIL">
                </div>
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="number" id="booktable" class="form-control form-control-lg custom-form-control" placeholder="NUMBER OF GUESTS" max="20" min="0">
                </div>
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="time" id="booktable" class="form-control form-control-lg custom-form-control" placeholder="EMAIL">
                </div>
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="date" id="booktable" class="form-control form-control-lg custom-form-control" placeholder="12/12/12">
                </div>
            </div>
            <a href="#" class="btn btn-lg btn-primary" id="rounded-btn">FIND TABLE</a>
        </div>
    </div> --}}

    <!-- BLOG Section  -->
    <div id="blog" class="container-fluid bg-dark text-light py-5 text-center wow fadeIn">
        <h2 class="section-title py-5">PRODUCTOS DISPONIBLES</h2>
        <div class="row justify-content-center">
            <div class="col-sm-7 col-md-4 mb-5">
                <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $category->name }}-tab"
                                data-toggle="pill" href="#{{ $category->name }}" role="tab"
                                aria-controls="{{ $category->name }}"
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{-- <div class="row justify-content-center">
            <div class="col-sm-7 col-md-4 mb-5">
                <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#foods" role="tab"
                            aria-controls="pills-home" aria-selected="true">Foods</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#juices" role="tab"
                            aria-controls="pills-profile" aria-selected="false">Juices</a>
                    </li>
                </ul>
            </div>
        </div> --}}
        <div class="tab-content" id="pills-tabContent">
            @foreach ($categories as $category)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $category->name }}"
                    role="tabpanel" aria-labelledby="{{ $category->name }}-tab">
                    <div class="row">
                        @foreach ($category->products as $product)
                            <div class="col-md-4">
                                <div class="card bg-transparent border my-3 my-md-0">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="template by DevCRID http://www.devcrud.com/"
                                        class="rounded-0 card-img-top mg-responsive">
                                    <div class="card-body">
                                        <h1 class="text-center mb-4">
                                            <a href="#" class="badge badge-primary">${{ $product->sell_price }}</a>
                                        </h1>
                                        <h4 class="pt20 pb20">{{ $product->name }}</h4>
                                        <p class="text-white">{{ $product->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            {{-- <div class="tab-pane fade" id="Empanadas" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="row">
                    <div class="col-md-4 my-3 my-md-0">
                        <div class="card bg-transparent border">
                            <img src="imgs/blog-4.jpg" alt="template by DevCRID http://www.devcrud.com/"
                                class="rounded-0 card-img-top mg-responsive">
                            <div class="card-body">
                                <h1 class="text-center mb-4"><a href="#" class="badge badge-primary">$15</a>
                                </h1>
                                <h4 class="pt20 pb20">Consectetur Adipisicing Elit</h4>
                                <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa
                                    provident illum officiis fugit laudantium voluptatem sit iste delectus qui ex. </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div> --}}
        </div>
    </div>

    {{--  <div class="tab-content" id="pills-tabContent">
        @foreach ($categories as $category)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                 id="{{ $category->slug }}" 
                 role="tabpanel" 
                 aria-labelledby="{{ $category->slug }}-tab">
                <div class="row">
                    @foreach ($category->products as $product)
                        <div class="col-md-4">
                            <div class="card bg-transparent border my-3 my-md-0">
                                <img src="imgs/blog-1.jpg" 
                                     alt="template by DevCRID http://www.devcrud.com/" 
                                     class="rounded-0 card-img-top mg-responsive">
                                <div class="card-body">
                                    <h1 class="text-center mb-4">
                                        <a href="#" class="badge badge-primary">${{ $product->price }}</a>
                                    </h1>
                                    <h4 class="pt20 pb20">{{ $product->name }}</h4>
                                    <p class="text-white">{{ $product->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div> --}}


    <!-- REVIEWS Section  -->
    {{-- <div id="testmonial" class="container-fluid wow fadeIn bg-dark text-light has-height-lg middle-items">
        <h2 class="section-title my-5 text-center">REVIEWS</h2>
        <div class="row mt-3 mb-5">
            <div class="col-md-4 my-3 my-md-0">
                <div class="testmonial-card">
                    <h3 class="testmonial-title">John Doe</h3>
                    <h6 class="testmonial-subtitle">Web Designer</h6>
                    <div class="testmonial-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum nobis eligendi, quaerat accusamus ipsum sequi dignissimos consequuntur blanditiis natus. Aperiam!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 my-3 my-md-0">
                <div class="testmonial-card">
                    <h3 class="testmonial-title">Steve Thomas</h3>
                    <h6 class="testmonial-subtitle">UX/UI Designer</h6>
                    <div class="testmonial-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum minus obcaecati cum eligendi perferendis magni dolorum ipsum magnam, sunt reiciendis natus. Aperiam!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 my-3 my-md-0">
                <div class="testmonial-card">
                    <h3 class="testmonial-title">Miranda Joy</h3>
                    <h6 class="testmonial-subtitle">Graphic Designer</h6>
                    <div class="testmonial-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, nam. Earum nobis eligendi, dignissimos consequuntur blanditiis natus. Aperiam!</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- CONTACT Section  -->
    {{-- <div id="contact" class="container-fluid bg-dark text-light border-top wow fadeIn">
        <div class="row">
            <div class="col-md-6 px-0">
                <div id="map" style="width: 100%; height: 100%; min-height: 400px"></div>
            </div>
            <div class="col-md-6 px-5 has-height-lg middle-items">
                <h3>DIRECCION</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, laboriosam doloremque odio delectus,
                    sunt magnam laborum impedit molestiae, magni quae ipsum, ullam eos! Alias suscipit impedit et,
                    adipisci illo quam.</p>
                <div class="text-muted">
                    <p><span class="ti-location-pin pr-3"></span> 12345 Fake ST NoWhere, AB Country</p>
                    <p><span class="ti-support pr-3"></span> (123) 456-7890</p>
                    <p><span class="ti-email pr-3"></span>info@website.com</p>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- page footer  -->
    {{-- <div class="container-fluid bg-dark text-light has-height-md middle-items border-top text-center wow fadeIn">
        <div class="row">
            <div class="col-sm-4">
                <h3>EMAIL</h3>
                <P class="text-muted">info@website.com</P>
            </div>
            <div class="col-sm-4">
                <h3>TELEFONO</h3>
                <P class="text-muted">(123) 456-7890</P>
            </div>
            <div class="col-sm-4">
                <h3>DIRECCION</h3>
                <P class="text-muted">12345 Fake ST NoWhere AB Country</P>
            </div>
        </div>
    </div> --}}
    <div class="bg-dark text-light text-center border-top wow fadeIn">
        <p class="mb-0 py-3 text-muted small">&copy; Copyright
            <script>
                document.write(new Date().getFullYear())
            </script> Poncho Empanadas Argentinas
        </p>
    </div>
    <!-- end of page footer -->

    <!-- core  -->
    <script src="{{ asset('vendors/jquery/jquery-3.4.1.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/bootstrap.bundle.js') }}"></script>

    <!-- bootstrap affix -->
    <script src="{{ asset('vendors/bootstrap/bootstrap.affix.js') }}"></script>

    <!-- wow.js -->
    <script src="{{ asset('vendors/wow/wow.js') }}"></script>

    <!-- google maps -->
    {{-- <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtme10pzgKSPeJVJrG1O3tjR6lk98o4w8&callback=initMap"></script> --}}

    <!-- FoodHut js -->
    <script src="{{ asset('js/foodhut.js') }}"></script>

</body>

</html>
