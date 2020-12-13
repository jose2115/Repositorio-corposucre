<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Respositorio Corposucre</title>
  
 <link rel="stylesheet" href="{{asset('css/stilos.css')}}">

   <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="{{asset('table/main.css')}}">  
      
      
   <!--datables CSS básico-->
      
     <link rel="stylesheet" href="{{asset('table/bootstrap/css/bootstrap.min.css')}}">  
    <link rel="stylesheet" type="text/css" href="{{asset('table/datatables/datatables.min.css')}}"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="{{asset('table/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css')}}">
  
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">

  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="{{asset('assets/css/demo/style.css')}}">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{asset('assets/images/corposucre-logo.png')}}" />
</head>
<body>
<script src="{{asset('assets/js/preloader.js')}}"></script>

 
 
  <div class="body-wrapper">
    <!-- partial:../../partials/_sidebar.html -->
    <aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
   
      <div class="mdc-drawer__header">
        <a href="principal.html" class="brand-logo">
          <img src="{{asset('assets/images/LOGO%20CORPOSUCRE%20HORIZONTAL.jpg')}}" class="logo" alt="logo">
        </a>
      </div>
      <div class="mdc-drawer__content">
        <div class="user-info">
          <p class="name">{{ Auth::user()->name }}</p>
          <p class="email">{{ Auth::user()->email }}</p>
        </div>
        <div class="mdc-list-group">
          <nav class="mdc-list mdc-drawer-menu">
            <div class="mdc-list-item mdc-drawer-item no_select">
              <a class="mdc-drawer-link" href="{{url('/admin')}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
                Dashboard
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item select">
              <a class="mdc-drawer-link" href="{{url('admin/recursos')}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon " aria-hidden="true">library_books</i>
                Recursos
              </a>
            </div>
            
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{url('/usuarios')}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">person</i>
                Usuarios
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">settings</i>
                Configuracion
              </a>
            </div>
           
            
          </nav>
        </div>
        <div class="profile-actions">
          <a href="javascript:;">Settings</a>
          <span class="divider"></span>
          <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
          >Salir</a>
        </div>
       
      </div>
    </aside>
    <!-- partial -->
    <div class="main-wrapper mdc-drawer-app-content">

     
      <!-- partial:../../partials/_navbar.html -->
      <header class="mdc-top-app-bar">
    
        <div class="mdc-top-app-bar__row">
          <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler">menu</button>
           
            
          </div>
          <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
             @can('crear_recurso')
             <div class="boton_crear"><a href="#openModal" >
               Crear
              </a></div>
              @endcan
             <div class="menu-button-container menu-profile d-none d-md-block">
              
              
               <button class="mdc-button mdc-menu-button">
               
                <span class="d-flex align-items-center">
                  <span class="figure">
                    <img src="{{asset('imagenes_recursos/'.Auth::user()->foto)}}" alt="user" class="user">
                  </span>
                  <span class="user-name">{{ Auth::user()->name }}</span>
                </span>
              </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only">
                      <i class="mdi mdi-account-edit-outline text-primary"></i>
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal"><a href="modificar_usuario.html">Editar perfil</a></h6>
                    </div>
                  </li>
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only">
                      <i class="mdi mdi-settings-outline text-primary"></i>                      
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="item-subject font-weight-normal">
                       <a class="item-subject font-weight-normal" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();"
                        >Logout   </a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
           </form>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="divider d-none d-md-block"></div>
            <div class="menu-button-container d-none d-md-block">
             
             
            </div>
            
            
            
            <div class="menu-button-container d-none d-md-block">
              <button class="mdc-button mdc-menu-button">
                <i class="mdi mdi-arrow-down-bold-box"></i>
              </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only">
                      <i class="mdi mdi-lock-outline text-primary"></i>
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal">Lock screen</h6>
                    </div>
                  </li>
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only">
                      <i class="mdi mdi-logout-variant text-primary"></i>                      
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal">
                      <a class="item-subject font-weight-normal" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                        >Logout</a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
           </form>
                      
                      </h6>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- partial -->
      @if(session()->has('alert-success')) 
 <div class="alert alert-success"> 
  {{ session()->get('alert-success') }} 
 </div> 
@endif

@if(session()->has('alert-danger')) 
 <div class="alert alert-danger"> 
  {{ session()->get('alert-success') }} 
 </div> 
@endif

@if(Session::has('message'))
   {!! Session::get('message') !!}
@endif
        @if($errors->any())
        <div class="alert alert-danger"> 
        <ul>
            @foreach ($errors->all() as $error)
                  <li>
                    {{ $error }}
                  </li>
            @endforeach
        </ul>
        </div> 
        
        @endif
     
      <div class="page-wrapper mdc-toolbar-fixed-adjust">
       
        <main class="content-wrapper">
         
         <div class="container">
        <div class="row">

                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>FACULTAD</th>
                                <th>PROGRAMA</th>
                                <th>TIPO</th>
                                <th>AUTOR</th>
                                @can('editar_recurso')
                                <th>MODIFICAR</th>
                                @endcan()
                                @can('eliminar_recurso')
                                <th>ELIMINAR</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($recursos as $recurso)
                            <tr>
                                <td>{{ $recurso->tema }}</td>
                                <td>{{ $recurso->facutad }}</td>
                                <td>{{ $recurso->nombre }}</td>
                                <td>{{ $recurso->tipo}}</td>
                                <td>{{ $recurso->autores}}</td>

                                @can('editar_recurso')
                                <td><div class="boton_modificar"><label for="" class="label_m_e"><a href="{{url('/admin/'.$recurso->id.'/edit')}}">Modificar</a></label></div></td>
                                @endcan

                                @can('eliminar_recurso')
                                <td>
                                
                                <form method="post" action="{{url('/admin/'.$recurso->id)}}">
                                  {{csrf_field()}}
                                   {{ method_field('DELETE')}}

                                    <button class="eliminar" type="submit" onclick="return confirm('¿borrar?')">Borrar</button>
                
                                </form>
                               
                                </td>
                                @endcan()
                                
                                
                               
                            </tr>
                      @endforeach
                        </tbody>        
                       </table>                  
                    </div>
                </div>
        </div>  
   
   
    </div> 
       
         
        </main>
        
         
        <!-- partial:../../partials/_footer.html -->
        <footer>
          <div class="mdc-layout-grid">
            <div class="mdc-layout-grid__inner">
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                <span class="tx-14">Copyright © 2019 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop d-flex justify-content-end">
                <div class="d-flex align-items-center">
                  <a href="">Documentation</a>
                  <span class="vertical-divider"></span>
                  <a href="">FAQ</a>
                </div>
              </div>
            </div>
          </div>
          
         
        </footer>
        <!-- partial -->
      
      <!--ventana modad -->
       <div id="openModal" class="modalDialog">
	          
	               
	                <div class="cuerpo_modal2">
                    
                    <header class="b">
                         <div class="header1">
	                    
	                    </div>
	                    <div class="header2">
	                       <a href="#close" title="Close" class="close">X</a> 
	                    </div>
	                   
                    </header>
                    <div class="contenido_modal2">
                       <form action="{{url('/admin')}}" method="post" enctype="multipart/form-data">
                 {{ csrf_field()}}
                        <div class="campos">
                               <div class="campo1">
                                   <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input form-control @error('tema') is-invalid @enderror" id="text-field-hero-input" name="tema" >
                                         
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Tema
                                          @error('tema')
                                          <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                            </span>
                                               @enderror
                                        </label>
                                   </div>
                               </div>
                               <div class="campo1">
                                   
                    <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                      <input type="hidden" name="programa"  required>
                      <i class="mdc-select__dropdown-icon"></i>
                      <div class="mdc-select__selected-text"></div>
                      <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                        <ul class="mdc-list">
                          <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
                          </li>
                          @foreach($programas as $programa)
                          <li class="mdc-list-item" data-value="{{$programa->id}}">
                            {{ $programa->nombre }}
                          </li>
                          @endforeach
                        </ul>
                      </div>
                      <span class="mdc-floating-label">Programa</span>
                      <div class="mdc-line-ripple"></div>
                    </div>
                 
                               </div>
                                <div class="campo1">
                                    
                                    
                                    <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                      <input type="hidden" name="semestre" >
                      <i class="mdc-select__dropdown-icon"></i>
                      <div class="mdc-select__selected-text"></div>
                      <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                        <ul class="mdc-list">
                        
                          <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
                          </li>
                         @for ($i = 1; $i <= 10; $i++)
                          <li class="mdc-list-item" data-value="{{ $i }}">
                           {{ $i }}
                          </li>
                          @endfor
                        
                        
                        </ul>
                     

                      </div>
                      <span class="mdc-floating-label">Semestre</span>
                      <div class="mdc-line-ripple"></div>
                    </div>
                                    
                                </div>
                            
                        </div>
                        
                        <div class="campos">
                            
                           <div class="campo2">
                               
                                <div class="mdc-text-field w-100">
                                         <textarea class="mdc-text-field__input  @error('descripcion') is-invalid @enderror" id="text-field-hero-input" name="descripcion" id="" cols="30" rows="10"></textarea>
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Descripcion
                                          @error('descripcion')
                                          <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                           </span>
                                               @enderror
                                        </label>
                                   </div>
                           </div>
                        </div>
                        <div class="campos">
                            
                            <div class="campo1"> <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input form-control @error('institucion') is-invalid @enderror" id="text-field-hero-input" name="institucion" require>
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Intitucion
                                           @error('institucion')
                                          <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                            </span>
                                               @enderror
                                        </label>
                                   </div></div>
                            <div class="campo1"> <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input form-control @error('año') is-invalid @enderror" id="text-field-hero-input" name="año" require>
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Año
                                           @error('año')
                                          <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                            </span>
                                               @enderror
                                        </label>
                                   </div></div>
                            <div class="campo1"> <div class="mdc-text-field w-100">
                                        <input class ="custom-file-input @error('año') is-invalid @enderror" type="file" name="archivo" id="">
                                        <label class="custom-file-label" for="customFileLang"> Archivo</label>
                                        @error('archivo')
                                          <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                            </span>
                                               @enderror
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Archivo</label>
                                   </div></div>
                        </div>
                        
                        <div class="campos">
                            
                            <div class="campo1">
                            
                            <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                      <input type="hidden" name="tipo" require>
                      <i class="mdc-select__dropdown-icon"></i>
                      <div class="mdc-select__selected-text"></div>
                      <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                        <ul class="mdc-list">
                          <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
                          </li>
                          @foreach($archivos as $archivo)
                          <li class="mdc-list-item" data-value="{{$archivo->id}}">
                            {{ $archivo->tipo }}
                          </li>
                          @endforeach
                        </ul>
                      </div>
                      <span class="mdc-floating-label">Tipo</span>
                      <div class="mdc-line-ripple"></div>
                    </div></div>
                            
                            <div class="campo1"> <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input form-control @error('url') is-invalid @enderror" id="text-field-hero-input" name="url">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Url
                                           @error('url')
                                          <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                            </span>
                                               @enderror
                                        </label>
                                   </div></div>
                        </div>
                        
                        
                        <div class="campos">
                            <div class="campo1">
                                <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input form-control @error('autor') is-invalid @enderror" id="text-field-hero-input" name="autor" require>
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Autor
                                           @error('autor')
                                          <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                            </span>
                                               @enderror
                                        </label>
                                   </div>
                            </div>

                             <div class="campo1"> 
                               <div class="mdc-text-field w-100">
                                        <input class ="custom-file-input form-control @error('foto') is-invalid @enderror" type="file" name="foto" id="">
                                        <label class="custom-file-label" for="customFileLang">Seleccionar Foto</label>
                                        @error('foto')
                                          <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                            </span>
                                               @enderror
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Foto</label>
                                   </div></div>
                            
                        </div>
                        
                        <div class="campos">
                            <div class="campo1">
                                  <input class="boton_crear2"type="submit" value="crear">
                            </div>
                            <div class="campo1">
                                <button class="boton_cancelar"><h4><a href="#close">cancelar</a> </h4></button>
                            </div>
                        </div>
                        </form>
                    </div>
                    

	                
                 
	                    
	                </div>
                 
	        
	            
	            
      
          </div>
      
    </div>
  </div>
  <!-- plugins:js -->
  <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('assets/js/material.js')}}"></script>
  <script src="{{asset('assets/js/misc.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->

  

</body>


<!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="{{asset('table/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('table/popper/popper.min.js')}}"></script>
    <script src="{{asset('table/bootstrap/js/bootstrap.min.js')}}"></script>

      
    <!-- datatables JS -->
    <script type="text/javascript" src="{{asset('table/datatables/datatables.min.js')}}"></script>    
     
    <script type="text/javascript" src="{{asset('table/main.js')}}"></script> 

     <script src="{{asset('assets/js/preloader.js')}}"></script>

</html>