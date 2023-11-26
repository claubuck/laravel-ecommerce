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

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('fontawesome6/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome6/css/all.min.css') }}">


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
                 <li class="nav-item">
                    <a class="nav-link" href="#about">Sobre Nosotros</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#gallary">Categorias</a>
                </li> --}}
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
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contactanos</a>
                </li>
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



    <!--  gallary Section  -->
    {{-- <div id="gallary" class="text-center has-height-md middle-items wow fadeIn">
        <h2 class="text-dark">Categorias</h2>
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
    </div> --}}


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
    <div id="blog" class="container-fluid text-light py-5 text-center wow fadeIn">
        <h2 class="text-dark py-5">PRODUCTOS DISPONIBLES</h2>

        <ul class="nav nav-tabs" role="tablist">
            @foreach ($categories as $category)
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab"
                        data-id="{{ $category->id }}" href="#{{ $category->name }}" role="tab"
                        aria-controls="{{ $category->name }}" aria-selected="true">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
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

    <div class="container">
        <div class="row col-12">
            <!-- Elementos generados a partir del JSON -->
            <main id="items" class="col-9 col-sm-9 row"></main>
            <!-- Carrito -->
            <aside class="col-sm-3">
                <h2>Orden de compra</h2>
                <!-- Elementos del carrito -->
                <ul id="carrito" class="list-group"></ul>
                <hr>
                <!-- Precio total -->
                <p class="text-right">Total: <span id="total"></span>&euro;</p>
                <button id="boton-vaciar" class="btn btn-danger">Vaciar</button>
                <button id="boton-abrir-modal" class="btn btn-success">Enviar Pedido</button>

            </aside>
            <button class="btn btn-outline-primary" type="button" id="anterior">
                << Anterior</button>
                    <button class="btn btn-outline-primary" type="button" id="siguiente">Siguiente >></button>

        </div>
        <br>
        {{-- Modal --}}

        <!-- Modal para ingresar información -->
        <div class="modal fade" id="modalInformacion" tabindex="-1" role="dialog"
            aria-labelledby="modalInformacionLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="text-secondary" id="modalInformacionLabel">Ingresa tus datos para enviar el pedido
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí puedes agregar tus campos de nombre, teléfono y dirección -->
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Tu nombre">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" class="form-control" id="telefono"
                                placeholder="Ejemplo: 1234567890">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" placeholder="Tu dirección">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="boton-enviar-pedido-modal">Enviar
                            Pedido</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  About Section  -->
    <div id="about" class="container-fluid wow fadeIn" id="about"data-wow-duration="1.5s">
        <h1 class="mb-4 text-center">Sobre Nosotros</h1>

        <div class="container mt-4">
            <h2 class="heading">Trabajamos con marcas de primera calidad</h2>
            <p class="paragraph">Trabajamos con productos de marcas nacionales, concienciados y apoyando el desarrollo
                de productores locales que elaboran productos de una calidad excelente.</p>
            <div class="row mt-4 text-center">
                <div class="col-md-3">
                    <i class="fa-solid fa-handshake fa-5x" style="color: #fbc246;"></i>
                    <p class="paragraph"><h3>SOSTENIBLE</h3></p>
                </div>
                <div class="col-md-3">
                    <i class="fa-solid fa-medal fa-5x" style="color: #fbc246;"></i>
                    <p class="paragraph"><h3>DE CALIDAD</h3></p>
                </div>
                <div class="col-md-3">
                    <i class="fa-solid fa-heart-circle-check fa-5x" style="color: #fbc246;"></i>
                    <p class="paragraph"><h3>HECHAS CON AMOR</h3></p>
                </div>
                <div class="col-md-3">
                    <i class="fa-solid fa-bowl-food fa-5x" style="color: #fbc246;"></i>
                    <p class="paragraph"><h3>AUTÉNTICAS</h3></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 has-img-bg"></div>
            <div class="col-lg-6">
                <div class="row justify-content-center">
                    <div class="col-sm-8 py-5 my-5">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, quisquam accusantium
                            nostrum modi, nemo, officia veritatis ipsum facere maxime assumenda voluptatum enim! Labore
                            maiores placeat impedit, vero sed est voluptas!Lorem ipsum dolor sit amet, consectetur
                            adipisicing elit. Expedita alias dicta autem, maiores doloremque quo perferendis, ut
                            obcaecati harum, <br><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum
                            necessitatibus iste,
                            nulla recusandae porro minus nemo eaque cum repudiandae quidem voluptate magnam voluptatum?
                            <br>Nobis, saepe sapiente omnis qui eligendi pariatur. quis voluptas. Assumenda facere
                            adipisci quaerat. Illum doloremque quae omnis vitae.
                        </p>
                        <p><b>Lonsectetur adipisicing elit. Blanditiis aspernatur, ratione dolore vero asperiores
                                explicabo.</b></p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos ab itaque modi, reprehenderit
                            fugit soluta, molestias optio repellat incidunt iure sed deserunt nemo magnam rem explicabo
                            vitae. Cum, nostrum, quidem.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  add section  -->
    <div class="row">
        <div class="col-md-6">
            <!-- Columna para el texto -->
            <div class="section col-md-10 float-right pl-4">
                <h2 class="heading">Una propuesta imparable</h2>
                <p class="paragraph">Jimmy Churri nace en respuesta a una necesidad de nuestra gente: comer diferente,
                    de
                    forma sencilla y con un producto saludable elaborado al horno. Si a esto le añades que puedes
                    comerlas
                    al momento o llevártelas a casa y compartirlas con quién quieras, estamos hablando de un producto
                    perfecto para nuestro día a día.</p>
                <p class="paragraph">Además, completamos el servicio llevándotelas donde quieras. El delivery es una de
                    las
                    claves que nuestro público más valora.</p>

                <div class="row">
                    <!-- Columna izquierda -->
                    <div class="section col-md-6 float-left">
                        <h2 class="heading mt-4">Claves del negocio</h2>
                        <ul class="list-disc ml-6">
                            <li>Franquicia Rentable</li>
                            <li>Fácil gestión</li>
                            <li>Empanadas</li>
                            <li>Formación continuada</li>
                            <li>Baja inversión</li>
                            <li>Tendencia en alza</li>
                        </ul>
                    </div>

                    <!-- Columna derecha -->
                    <div class="section col-md-6 float-right">
                        <h2 class="heading mt-4">Organización y expansión</h2>
                        <ul class="list-disc ml-6">
                            <li>Creación de empresa: 2021</li>
                            <li>Inicio de la expansión: 2022</li>
                            <li>Red de España: 2</li>
                            <li>Nacionalidad: España</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <!-- Columna para la imagen -->
            <img src="imgs/blog-1.jpg" alt="template by DevCRID http://www.devcrud.com/"
                class="rounded-0 card-img-top mg-responsive">
        </div>
    </div>


    <div class="container mt-5">
        <h1 class="text-center">Unete a nosotros</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="section col-md-2 float-left">
                    <h2><i class="fa-solid fa-chart-line fa-fade fa-2xl" style="color: #f9d51f;"></i></h2>
                </div>
                <div class="section col-md-10 float-right">
                    <h2 class="heading">Tendencia al alza</h2>
                    <p class="paragraph">Crece la demanda por una comida de calidad, que puedas comer al momento y en
                        cualquier parte. Saludable, fácil de compartir y con la posibilidad de enviar a domicilio.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="section col-md-2 float-left">
                    <h2><i class="fa-solid fa-people-roof fa-fade fa-2xl" style="color: #f9d51f;"></i></h2>
                </div>
                <div class="section col-md-10 float-right">
                    <h2 class="heading">Somos una familia</h2>
                    <p class="paragraph">Jimmy Churri es un concepto de tienda de empanadas argentinas abierto y con la
                        idea de crecer juntos. Contamos contigo para cambiar el mundo.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="section col-md-2 float-left">
                    <h2><i class="fa-solid fa-money-bill-trend-up fa-fade fa-2xl" style="color: #f9d51f;"></i></h2>
                </div>
                <div class="section col-md-10 float-right">
                    <h2 class="heading">Inversión mínima</h2>
                    <p class="paragraph">Nuestro modelo no requiere de grandes inversiones. Tenemos un plan de negocio
                        rentable y escalable para ti.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="section col-md-2 float-left">
                    <h2><i class="fa-solid fa-store fa-fade fa-2xl" style="color: #f9d51f;"></i></h2>
                </div>
                <div class="section col-md-10 float-right">
                    <h2 class="heading">Plan de negocio</h2>
                    <p class="paragraph">Somos especialistas en la venta de empanadas argentinas y no dependemos de una
                        local grande que precise espacio para comer en el mismo, ni salida de humos (por ejemplo).</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="section col-md-2 float-left">
                    <h2><i class="fa-solid fa-bullhorn fa-fade fa-2xl" style="color: #f9d51f;"></i></h2>
                </div>
                <div class="section section col-md-10 float-right">
                    <h2 class="heading">Imagen y Marketing</h2>
                    <p class="paragraph">Hemos elaborado un manual de identidad corporativa con el cual seguir nuestras
                        pautas de imagen y comunicación. Generamos comunidad y creamos campañas de publicidad en redes
                        sociales.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="section col-md-2 float-left">
                    <h2><i class="fa-solid fa-handshake fa-fade fa-2xl" style="color: #f9d51f;"></i></h2>
                </div>
                <div class="section section col-md-10 float-right">
                    <h2 class="heading">Emprende junto a nosotros</h2>
                    <p class="paragraph">Nuestro modelo de negocio busca asociados que trabajen en su propia tienda de
                        Jimmy Churri. Minimiza los riesgos y consigue tu propio negocio de la mano de nuestra marca.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTACT Section  -->
    <div id="contact" class="container-fluid bg-dark text-light border-top wow fadeIn">

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
    </div>



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
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtme10pzgKSPeJVJrG1O3tjR6lk98o4w8&callback=initMap"></script>

    <!-- FoodHut js -->
    <script src="{{ asset('js/foodhut.js') }}"></script>

    {{-- shoping-card --}}
    <script type="module" src="{{ asset('js/shoping/shoping-card.js') }}"></script>

    {{-- sweet alert --}}
    <script src="{{ asset('js/sweetalert.js') }}"></script>

    <script src="{{ asset('fontawesome6/js/all.js') }}"></script>
    <script src="{{ asset('fontawesome6/js/all.min.js') }}"></script>






</body>

</html>
