<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Respositorio Corposucre</title>
  <!-- plugins:css -->
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
            <div class="mdc-list-item mdc-drawer-item ">
              <a class="mdc-drawer-link" href="principal.html">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
                Dashboard
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item select">
              <a class="mdc-drawer-link" href="{{url('/admin')}}">
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
              <a class="mdc-drawer-link" href="../../pages/charts/chartjs.html">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">settings</i>
                Configuracion
              </a>
            </div>
           
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="https://www.bootstrapdash.com/demo/material-admin-free/jquery/documentation/documentation.html" target="_blank">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">description</i>
                Documentation
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
    <div class="main-wrapper mdc-drawer-app-content fonto1 ">
      <!-- partial:../../partials/_navbar.html -->
      <header class="mdc-top-app-bar">
        <div class="mdc-top-app-bar__row">
          <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler">menu</button>
           
            
          </div>
          <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
           
             <div class="menu-button-container menu-profile d-none d-md-block">
              
              
               <button class="mdc-button mdc-menu-button">
              
                <span class="d-flex align-items-center">
                  <span class="figure">
                    <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="user" class="user">
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
                      <h6 class="item-subject font-weight-normal">Editar perfil</h6>
                    </div>
                  </li>
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only">
                      <i class="mdi mdi-settings-outline text-primary"></i>                      
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
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
          >Logout   </a>
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
      
      <div class="cuerpo_m">
          <div class="cuerpo1_m_">
            <div class="cuerpo1_1_m">
              <img class="imagen" src="{{asset('imagenes_recursos/'.$recurso->foto)}}" alt="">
            </div>
              <div class="cuerpo1_1_m">
            <iframe src="{{asset('imagenes_recursos/'.$recurso->archivo)}}" frameborder="0">

            </iframe>     
          
              </div>
              
              <div class="cuerpo1_2_m">
                
                  

              </div>
              
          </div>
          <div class="cuerpo2_m_">
          
        <div class="cuerpo_modal">

              
              <div class="contenido_modal">
                         <form action="/admin/{{ $recurso->id }}" method="post" enctype="multipart/form-data">
              {{ csrf_field()}}
             {{ method_field('PATCH')}}
                        <div class="campos primeros">
                               <div class="campo1 ">
                                   <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input form-control @error('tema') is-invalid @enderror" id="text-field-hero-input" name="tema" type="text" value="{{ $recurso->tema }}" require>
                                        <div class="mdc-line-ripple">
                                        </div>
                                        <label for="text-field-hero-input" class="mdc-floating-label ">Tema
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
                      <input type="hidden" name="programa" type="text" value="{{ $recurso->id_programa}}" require>
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
                          @endforeach>
                        </ul>
                      </div>
                      <span class="mdc-floating-label">Programa</span>
                      <div class="mdc-line-ripple"></div>
                    </div>
                 
                               </div>
                                <div class="campo1">
                                    
                                    
                                    <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                      <input type="hidden" name="semestre" value="{{ $recurso->semestre}}" require>
                      <i class="mdc-select__dropdown-icon"></i>
                      <div class="mdc-select__selected-text"></div>
                      <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                        <ul class="mdc-list semestres">
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
                        
                        <div class="campos segundos">
                            
                           <div class="campo2">
                               
                                <div class="mdc-text-field w-100">
                                         <textarea class="mdc-text-field__area form-control @error('descripcion') is-invalid @enderror" id="text-field-hero-input" name="descripcion" cols="30" rows="10" value="{{$recurso->descripcion}}">{{$recurso->descripcion}}</textarea>
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
                        <div class="campos terceros">
                            
                            <div class="campo1 c"> 
                              <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input form-control @error('institucion') is-invalid @enderror" name="institucion" id="text-field-hero-input" value="{{ $recurso->institucion}}" require>
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Intitucion
                                           @error('institucion')
                                          <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                            </span>
                                               @enderror
                                        </label>
                                   </div></div>
                            <div class="campo1 c"> <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input  form-control @error('año') is-invalid @enderror" name="año" id="text-field-hero-input" value="{{ $recurso->año}}" require>
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Año
                                           @error('año')
                                          <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                            </span>
                                               @enderror
                                        </label>
                                   </div></div>
                            <div class="campo1 c"> <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input " name="archivo2" id="text-field-hero-input" value="{{ $recurso->archivo}}" require>
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Archivo</label>
                                   </div></div>
                        </div>
                        
                        <div class="campos">
                            
                            <div class="campo1">
                            
                            <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                      <input type="hidden" name="tipo" value="{{ $recurso->id_tipo_archivo}}" require>
                      <i class="mdc-select__dropdown-icon"></i>
                      <div class="mdc-select__selected-text"></div>
                      <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                        <ul class="mdc-list">
                          <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
                          </li>
                          @foreach($archivos as $archivo)
                          <li class="mdc-list-item" data-value="{{ $archivo->id}}">
                            {{$archivo->tipo}}
                          </li>
                          @endforeach
                         
                        </ul>
                      </div>
                      <span class="mdc-floating-label">Tipo</span>
                      <div class="mdc-line-ripple"></div>
                    </div></div>
                            <div class="campo1"> 
                            
                            <div class="mdc-text-field w-100">
                              <input class="form-control @error('archivo') is-invalid @enderror" type="file" name="archivo" id="">
                                  <label class="custom-file-label" for="customFileLang">Archivo</label>
                                        @error('archivo')
                                          <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                            </span>
                                               @enderror
                                               <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Archivo</label>
                                  </div>
                            </div>

                            <div class="campo1"> 
                            
                            <div class="mdc-text-field w-100">
                              <input class="form-control @error('foto') is-invalid @enderror" type="file" name="foto" id="">
                                  <label class="custom-file-label" for="customFileLang">Foto   </label>
                                        @error('foto')
                                          <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                            </span>
                                               @enderror
                                               <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Foto</label>
                                  </div>
                            </div>
                          


                        </div>
                        
                        
                        <div class="campos">
                            <div class="campo1">
                                <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input form-control @error('autor') is-invalid @enderror" name="autor" id="text-field-hero-input" value="{{ $recurso->autores}}" require>
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

                             <div class="campo1 c"> <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input" name="foto2" id="text-field-hero-input" value="{{ $recurso->foto}}" require>
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Foto</label>
                                   </div></div>

                             <div class="campo1"> <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input form-control @error('url') is-invalid @enderror" name="url" id="text-field-hero-input" value="{{ $recurso->url}}" require>
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Url
                                           @error('url')
                                          <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                            </span>
                                               @enderror
                                        </label>
                              </div>
                              </div>
                            
                        </div>
                        
                        <div class="campos">
                            <div class="campo1">
                                
                                 <input class="boton_actualizar" type="submit" value="Actualizar">
                              
                            </div>
                            
                        </div>
                       
                    </div>
              </form>
          </div>
         
          
      </div>
</div>
</div>
        <!-- partial:../../partials/_footer.html -->
       
        <!-- partial -->
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
  
  
  <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="{{asset('table/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('table/popper/popper.min.js')}}"></script>
    <script src="{{asset('table/bootstrap/js/bootstrap.min.js')}}"></script>

      
    <!-- datatables JS -->
    <script type="text/javascript" src="{{asset('table/datatables/datatables.min.js')}}"></script>    
     
    <script type="text/javascript" src="{{asset('table/main.js')}}"></script> 

     <script src="{{asset('assets/js/preloader.js')}}"></script>

</html>