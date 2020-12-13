<!doctype html>
<html lang="en">
  <head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="_token" content="{{ csrf_token() }}">
   <!-- <script src="{{asset('js/script.js')}}"></script> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css')}}" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/estudiantes.css')}}">
      <link rel="stylesheet" href="{{asset('css/ver_recursos.css')}}">
      <link rel="shortcut icon" href="{{asset('assets/images/corposucre-logo.png')}}" />
      <link href="{{asset('https://file.myfontastic.com/tiYM9gFcZqAG2HHEWBGMv7/icons.css')}}" rel="stylesheet">
    
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
          <a class="dropdown-item" href="#">Perfil</a>
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
    
           <li class="login"><a href="{{ route('login') }}">Login</a></li>

                        @if (Route::has('register'))
                           <li class="registre"><a href="{{ route('register') }}">Register</a> </li> 
                        @endif
                    @endif
           </ul>
    </ul>
   @endif
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

    <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js')}}"></script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
 
    
    <script src="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->


    <div class="d_body">
 @foreach($recursos as $recurso)
 @endforeach
 @foreach($likes as $like)
 @endforeach
 @foreach($vistas as $vista)
 @endforeach

 

        <div class="columna">
            <div class="tipo_archivo">
                    <h4>{{$recurso->tipo}}</h4>
                    <div class="icon-eye">
                    <a href="">{{ $vista->vistas }}</a>
                    </div>
            </div>
            <iframe src="{{asset('imagenes_recursos/'.$recurso->archivo)}}" frameborder="0"></iframe>
            
            <div class="pie_recurso">
                   
            <div class="pie1">
                  <div class="icon-download"> 
                   
                 </div><a href="{{ route('downloadfile', $recurso->id )}}">Descargar</a>

            </div>
             <div class="pie2">
                
            <form action="{{url('gusto')}}" method="post" id="formu">
                 <input type="hidden" id="txtNombre" value="{{ $recurso->id }}" required />

                    <botton class="icon-thumbs-up" type="submit" id="enviar"></botton>

                 </form>
                   
                    <a id="y" href="">{{ $like->gusto }}</a>
                    <a id="x" href="">{{ $like->gusto }}</a>

                    <a id="listar" href=""></a>
                            </div>   
            
                 
            </div>
        </div>
        
        <script language="javascript">
	var x;
      document.getElementById("y").style.display="none";
	x = document.getElementById("y").textContent;
 
	if(x >= 1)
	{
		document.getElementById("enviar").style.color = "#1E90FF";
	}
 
</script>

<script type="text/javascript" >

$(document).ready(function() {

    $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });
  });

  $("#enviar").click(function(e){

e.preventDefault();
 
    var nombres = $('#txtNombre').val();
  
    
    $.ajax({

  type:'POST',
  url:"{{url('/gusto')}}",
 
  data:{nombres: nombres},

  success:function(data){

    document.getElementById("x").style.display = "none";
    
    $('#listar').empty().html(data.mensaje);
    $('#y').empty().html(data.mensaje2);
        //alert("hola"+data.mensaje);


  },error: function(){
        alert("mal");
  },
  

});

 });
 
</script>

        <div class="columna d">
            <h4>TEMA</h4>
            <h4>{{$recurso->tema}}</h4>
            <h4>Resumen</h4>
            <p>{{$recurso->descripcion}}</p>
            <h4>Año</h4>
            <h5>{{$recurso->año}}</h5>
            <h4>Institucion</h4>
            <h5>{{$recurso->institucion}}</h5>
            <h4>Autor</h4>
            <h5>{{$recurso->autores}}</h5>
        </div>
    </div>

    <div class="d_body2">
<br>
    <h3>Tambien te puede gustar!!</h3>

@foreach($recomendaciones as $recomendacione)
    <div class="recurso">
          <div class="header_recurso">
               <h4>{{ $recomendacione->tema }}</h4>
          </div>

          <div class="foto_recurso">
               <img src="{{asset('imagenes_recursos/'.$recomendacione->foto)}}" alt="">

          </div>
          <div class="descripcion_recurso">
               <p>{{  $recomendacione->descripcion }}</p>
          </div>
          <div class="footer_recurso">
               <div class="footer_re">
                    <h6>visto {{  $recomendacione->vistas }}</h6>
               </div>
               <div class="footer_re e">
                    @if (Auth::check())
                    <a href="{{url('/estudiante/recurso/'.$recomendacione->id)}}">ver</a>
                    @else
                    <a href="{{url('/')}}">ver</a>
                    @endif
               </div>
          </div>
</div>

@endforeach
   </div>
   
     
     
  </body>
</html>