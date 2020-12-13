<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.0.0.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/validate.js')}}"></script>
  
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
          <p class="email">josealiss21@gmail.com</p>
        </div>
        <div class="mdc-list-group">
          <nav class="mdc-list mdc-drawer-menu">
            <div class="mdc-list-item mdc-drawer-item select">
              <a class="mdc-drawer-link" href="principal.html">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
                Dashboard
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item ">
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
           
          
          </nav>
        </div>
        <div class="profile-actions">
          <a href="javascript:;">Settings</a>
          <span class="divider"></span>
          <a href="javascript:;">Logout</a>
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
           
             <div class="menu-button-container menu-profile d-none d-md-block">
              
              
               <button class="mdc-button mdc-menu-button">
               
                <span class="d-flex align-items-center">
                  <span class="figure">
                    <img src="assets/images/faces/face1.jpg" alt="user" class="user">
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
          >Logout   </a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
           </form>
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
          <div class="cuerpo1_m">
              <div class="foto_mo">
                @foreach($usuarios as $usuario)

              {{$usuario->id}}
                  @endforeach
                  
                  <img src="{{asset('imagenes_recursos/'.$usuario->foto)}}" alt="">
                 

          
              </div>
              <div class="cuerpo1_2_m">
                  
                  
              </div>
              
          </div>
          <div class="cuerpo2_m">
          <div class="cuerpo_modal">
                     
                    
                    <div class="contenido_modal2">
                        <form action="/usuarios/{{ $usuario->id }}" method="post" enctype="multipart/form-data" id="formCheckPassword">
                 {{ csrf_field()}}
                  {{ method_field('PATCH')}}
                        <div class="campos_c">
                               <div class="campo1_">
                                   <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input form-control @error('Nombre') is-invalid @enderror" id="text-field-hero-input" name="Nombre" value="{{$usuario->primer_nombre}} {{$usuario->segundo_nombre}}">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Nombre

                                         @error('Nombre')
                                          <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                            </span>
                                               @enderror
                                        </label>
                                   </div>
                               </div>
                                <div class="campo1_1">
                                   <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input @error('Apellido') is-invalid @enderror" id="text-field-hero-input" name="Apellido" value="{{$usuario->primer_apellido}} {{$usuario->segundo_apellido}}">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Apellido

                                        @error('Apellido')
                                          <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                            </span>
                                               @enderror
                                        </label>
                                   </div>
                               </div>
                        </div>
                       
                        
                          <div class="campos_c">
                            
                           
                           
                           <div class="campo1_combo">
                            
                            <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                      <input type="hidden" name="Facultad" value="{{$usuario->id_facultad}}">
                      <i class="mdc-select__dropdown-icon"></i>
                      <div class="mdc-select__selected-text"></div>
                      <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                        <ul class="mdc-list">
                          <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
                          </li>
                          @foreach($facultades as $facultad)
                          <li class="mdc-list-item" data-value="{{$facultad->id}}">
                            {{$facultad->facutad}}
                          </li>
                          @endforeach
                        </ul>
                      </div>
                      <span class="mdc-floating-label">Facultad</span>
                      <div class="mdc-line-ripple"></div>
                    </div>
                           </div>
                            
                            <div class="campo2_combo">
                            
                            <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                      <input type="hidden" name="Programa" value="{{ $usuario->programa }}">
                      <i class="mdc-select__dropdown-icon"></i>
                      <div class="mdc-select__selected-text"></div>
                      <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                        <ul class="mdc-list">
                          <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
                          </li>
                          @foreach($programas as $programa)
                          <li class="mdc-list-item" data-value="{{$programa->id}}">
                            {{$programa->nombre}}
                          </li>
                         @endforeach
                        </ul>
                      </div>
                      <span class="mdc-floating-label">Programa</span>
                      <div class="mdc-line-ripple"></div>
                    </div>
                           </div>
                            
                            <div class="campo3_combo">
                            
                            <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                      <input type="hidden" name="Semestre" value="{{$usuario->semestre}}">
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
                            
                           <div class="campo4_combo">
                            
                            <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                      <input type="hidden" name="Rol" value="{{$usuario->role_id}}">
                      <i class="mdc-select__dropdown-icon"></i>
                      <div class="mdc-select__selected-text"></div>
                      <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                        <ul class="mdc-list">
                          <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
                          </li>
                          @foreach($roles as $rol)
                          <li class="mdc-list-item" data-value="{{$rol->id}}">
                            {{$rol->name}}
                          </li>
                         @endforeach
                        </ul>
                      </div>
                      <span class="mdc-floating-label">Rol</span>
                      <div class="mdc-line-ripple"></div>
                    </div>
                           </div>
                        </div>
                        <div class="campos">
                            
                            <div class="campo1">
                             <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input @error('email') is-invalid @enderror" type="email" id="text-field-hero-input" name="Correo" required autocomplete="email" value="{{$usuario->email}}">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Correo
                                          @error('email')
                                          <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                            </span>
                                               @enderror
                                        </label>
                                   </div> </div>


                            <div class="campo1"> 
                            
                             <input  class="custom-file-input @error('foto') is-invalid @enderror" type="file" name="foto" id="">
                             @error('foto')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                 </span>
                              @enderror
                            
                            </div>
                           
                        </div>

                   
                        <div class="campos_c">
                               <div class="campo1_">
                                   <div class="mdc-text-field w-100">
                                        <input type="password" class="mdc-text-field__input form-control  @error('password') is-invalid @enderror" name="password" id="password" >
                                       @error('password')
                                           <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                                     </span>
                                             @enderror
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Contraseña</label>
                                   </div>
                               </div>
                             
                                <div class="campo1_1">
                                   <div class="mdc-text-field w-100">
                                        <input type="password" class="mdc-text-field__input  @error('password') is-invalid @enderror" name="password_confirmation" id="password-confirm" >
                                        @error('password')
                                           <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                                     </span>
                                             @enderror
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Repetir Contraseña</label>
                                   </div>
                               </div>
                        </div>
                        
                        
                      
                        
                        <div class="campos">
                            <div class="campo1">
                                 <input class="crear_usuario"type="submit" value="crear">
                            </div>
                            
                        </div>
                       </form> 
                       <div class="campo1">
                                 
                                <form method="post" action="{{url('/usuarios/'.$usuario->id)}}">
                                  {{csrf_field()}}
                                   {{ method_field('DELETE')}}

                                    <button class="eliminar_usuario" type="submit" onclick="return confirm('¿borrar?')">Borrar</button>
                
                                </form>
                  
                            </div>
	       
            </div>
           

      </div>
      </div>

     
        <!-- partial:../../partials/_footer.html -->
        <footer>
          <div class="mdc-layout-grid">
            <div class="mdc-layout-grid__inner">
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
               
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop d-flex justify-content-end">
                <div class="d-flex align-items-center">
                
                  <span class="vertical-divider"></span>
                  
                </div>
              </div>
            </div>
          </div>
        </footer>
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