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
   yield("aside")
      <div class="mdc-drawer__header">
        <a href="principal.html" class="brand-logo">
          <img src="{{asset('assets/images/LOGO%20CORPOSUCRE%20HORIZONTAL.jpg')}}" class="logo" alt="logo">
        </a>
      </div>
      <div class="mdc-drawer__content">
        <div class="user-info">
          <p class="name">Jose Gonzalez</p>
          <p class="email">josealiss21@gmail.com</p>
        </div>
        <div class="mdc-list-group">
          <nav class="mdc-list mdc-drawer-menu">
            <div class="mdc-list-item mdc-drawer-item no_select">
              <a class="mdc-drawer-link" href="{{url('admin/')}}l">
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
              <a class="mdc-drawer-link" href="{{url('admin/usuarios')}}">
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
             <div class="boton_crear"><a href="#openModal" >
               Crear
              </a></div>
             <div class="menu-button-container menu-profile d-none d-md-block">
              
              
               <button class="mdc-button mdc-menu-button">
               
                <span class="d-flex align-items-center">
                  <span class="figure">
                    <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="user" class="user">
                  </span>
                  <span class="user-name">Jose Gonzalez</span>
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
                      <h6 class="item-subject font-weight-normal">Logout</h6>
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
                      <h6 class="item-subject font-weight-normal"><a href="login.html">Logout</a></h6>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- partial -->
      <div class="page-wrapper mdc-toolbar-fixed-adjust">
       
        <main class="content-wrapper">
         
   
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
                        
                        <div class="campos">
                               <div class="campo1">
                                   <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input" id="text-field-hero-input">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Tema</label>
                                   </div>
                               </div>
                               <div class="campo1">
                                   
                    <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                      <input type="hidden" name="enhanced-select">
                      <i class="mdc-select__dropdown-icon"></i>
                      <div class="mdc-select__selected-text"></div>
                      <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                        <ul class="mdc-list">
                          <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
                          </li>
                          <li class="mdc-list-item" data-value="grains">
                            Ing. sistema
                          </li>
                          <li class="mdc-list-item" data-value="vegetables">
                            Admin empresa
                          </li>
                          <li class="mdc-list-item" data-value="fruit">
                            Psicologia
                          </li>
                        </ul>
                      </div>
                      <span class="mdc-floating-label">Programa</span>
                      <div class="mdc-line-ripple"></div>
                    </div>
                 
                               </div>
                                <div class="campo1">
                                    
                                    
                                    <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                      <input type="hidden" name="enhanced-select">
                      <i class="mdc-select__dropdown-icon"></i>
                      <div class="mdc-select__selected-text"></div>
                      <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                        <ul class="mdc-list">
                          <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
                          </li>
                          <li class="mdc-list-item" data-value="grains">
                            Ing. sistema
                          </li>
                          <li class="mdc-list-item" data-value="vegetables">
                            Admin empresa
                          </li>
                          <li class="mdc-list-item" data-value="fruit">
                            Psicologia
                          </li>
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
                                         <textarea class="mdc-text-field__input" id="text-field-hero-input" name="" id="" cols="30" rows="10"></textarea>
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Descripcion</label>
                                   </div>
                           </div>
                        </div>
                        <div class="campos">
                            
                            <div class="campo1"> <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input" id="text-field-hero-input">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Intitucion</label>
                                   </div></div>
                            <div class="campo1"> <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input" id="text-field-hero-input">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Año</label>
                                   </div></div>
                            <div class="campo1"> <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input" id="text-field-hero-input">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Enfoque</label>
                                   </div></div>
                        </div>
                        
                        <div class="campos">
                            
                            <div class="campo1">
                            
                            <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                      <input type="hidden" name="enhanced-select">
                      <i class="mdc-select__dropdown-icon"></i>
                      <div class="mdc-select__selected-text"></div>
                      <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                        <ul class="mdc-list">
                          <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
                          </li>
                          <li class="mdc-list-item" data-value="grains">
                            Ing. sistema
                          </li>
                          <li class="mdc-list-item" data-value="vegetables">
                            Admin empresa
                          </li>
                          <li class="mdc-list-item" data-value="fruit">
                            Psicologia
                          </li>
                        </ul>
                      </div>
                      <span class="mdc-floating-label">Tipo</span>
                      <div class="mdc-line-ripple"></div>
                    </div></div>
                            <div class="campo1"> 
                            
                            <button>
                                <h4>subir</h4>
                            </button>
                            
                            </div>
                            <div class="campo1"> <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input" id="text-field-hero-input">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Url</label>
                                   </div></div>
                        </div>
                        
                        
                        <div class="campos">
                            <div class="campo1">
                                <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input" id="text-field-hero-input">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Autor</label>
                                   </div>
                            </div>
                            <div class="campo1">
                                <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input" id="text-field-hero-input">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Parabras Claves</label>
                                   </div>
                            </div>
                            
                        </div>
                        
                        <div class="campos">
                            <div class="campo1">
                                <button><h4>aceptar</h4></button>
                            </div>
                            <div class="campo1">
                                <button><h4>cancelar</h4></button>
                            </div>
                        </div>
                       
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