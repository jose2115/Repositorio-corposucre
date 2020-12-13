

<!DOCTYPE html>
<html lang="es">  
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
    <body class="align">
             <script src="assets/js/preloader.js"></script>
  <div class="grid">

    <div id="login">

      <h2><span class="fontawesome-lock"></span>Inicio  de Sesion</h2>

      <form action="principal.html" method="POST">

        <fieldset>

          <div class="campo1_login">
                                   <div class="mdc-text-field w-100">
                                        <input class="mdc-text-field__input" id="text-field-hero-input">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Usuario</label>
                                   </div>
                               </div>

           <div class="campo1_login">
                                   <div class="mdc-text-field w-100">
                                        <input type="password" class="mdc-text-field__input" id="text-field-hero-input">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Contraseña</label>
                                   </div>
                               </div>
          <p><input type="submit" value="Entrar"></p>

        </fieldset>

      </form>

    </div> <!-- end login -->

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

  
</body>	  
</html>