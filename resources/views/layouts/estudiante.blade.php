<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css')}}" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/estudiantes.css')}}">
    <link rel="stylesheet" href="{{asset('css/buscar.css')}}">
      <link rel="shortcut icon" href="{{asset('assets/images/corposucre-logo.png')}}" />
      <link rel="stylesheet" href="{{asset('assets/css/demo/style.css')}}">
    <title>Corposucre estudiantes</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    @yield('header')
  <a class="navbar-brand" href="{{url('/')}}">Corposucre</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/')}}">Principal <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Ayuda</a>
      </li>
    
    </ul>
    @if (Route::has('login'))
     <ul class="usuario">
    @auth
   
    <li class="foto" ><img src="{{asset('imagenes_recursos/'.Auth::user()->foto)}}" alt=""></li>
     <li class="nav-item dropdown nombre">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         {{ Auth::user()->name }}
        </a>
       <div class="dropdown-menu" aria-labelledby="navbarDropdown">
         <a class="dropdown-item" href="{{url('/estudiante/perfil/'.Auth::user()->id.'/edit')}}">Perfil</a>

         
          <a class="dropdown-item"  href="{{ route('logout') }}"
          onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
          >Salir</a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
           </form>
        </div>
      </li>
     @else
    
           <li class="login"><a href="{{ route('login') }}">Iniciar sesion</a></li>

                        @if (Route::has('register'))
                           <li class="registre"><a href="{{url('/estudiante/registro')}}">Registrarse</a> </li> 
                        @endif
                    @endif
           </ul>
    </ul>
   @endif
    <form class="form-inline my-2 my-lg-0" action="{{url('/buscar')}}" method="post">
    {{ csrf_field()}}
      <input class="form-control mr-sm-2  @error('buscar') is-invalid @enderror" type="search" placeholder="Buscar" name="buscar"aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
  </div>
</nav>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    
    <script src="{{asset('https://code.jquery.com/jquery-3.5.1.slim.min.js')}}" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
    

     
<div class="buscar">
@yield('buscar')
</div>


@if (Route::has('login'))
    @auth
    <div class="cuerpo_r">
     @yield('historial')
     <div class="cuerpo">
      
      </div>
    </div>

    <div class="cuerpo_r">
     @yield('cuerpo')
         <div class="cuerpo">
      
      </div>    
    </div>

    <div class="cuerpo_r">
     @yield('popular')
       <div class="cuerpo">
      
      </div>
    </div>

    
 @else
  
             @if(session()->has('alert-success')) 
              <div class="alert alert-success"> 
              @yield('cuerpo2')
            {{ session()->get('alert-success') }} 
             </div> 
           @endif


    <div class="cuerpo_r">
    
      @yield('cuerpo3')
      
      <div class="cuerpo">
      
      </div>
      

    </div>

    <div class="cuerpo_r">
      @yield('cuerpo4')
         <div class="cuerpo">
      
      </div>
    </div>

    <div class="cuerpo_r">
      @yield('cuerpo5')
         <div class="cuerpo">
      
      </div>
    </div>

    <div class="cuerpo_r">
      @yield('psicologia')
         <div class="cuerpo">
      
      </div>
    </div>

    <div class="cuerpo_r">
    @yield('login')
    </div>
     @endif
     @endif
  </body>
</html>