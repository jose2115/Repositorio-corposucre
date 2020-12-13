@extends('layouts.perfil')


@section('header')
   
@endsection


@section('cuerpo')

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
<div class="d_body">
<div class="d_foto">

<br>
</div>

<form  action="{{url('/estudiante/registrarse')}}" method="post" enctype="multipart/form-data" id="formCheckPassword">

{{ csrf_field()}}
 
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputNombre4">Nombres</label>
      <input type="text" class="form-control @error('Nombre') is-invalid @enderror" id="inputNombre4" name="Nombre">
    
      @error('Nombre')
       <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>

    <div class="form-group col-md-6">
      <label for="inputNombre4">Apellidos</label>
      <input type="text" class="form-control @error('Apellido') is-invalid @enderror" id="string" name="Apellido">
   
     @error('Apellido')
       <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>

      <div class="form-group col-md-4">
   

                      <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                      <input  type="hidden" name="facultad" type="text"  required autocomplete="facultad">
                     
                      
                      <i class="mdc-select__dropdown-icon"></i>
                      <div class="mdc-select__selected-text"></div>
                      <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                        <ul class="mdc-list">
                          <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
                          </li>
                            @foreach($facultades as $facultad)
                          <li class="mdc-list-item" data-value="{{$facultad->id}}">
                            {{ $facultad->facutad }}
                          </li>
                          @endforeach>
                        </ul>
                      </div>
                      <span class="mdc-floating-label">Facultad</span>
                      <div class="mdc-line-ripple"></div>
                    </div>
    </div>

      <div class="form-group col-md-4">
  

                    <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                      <input type="hidden" name="Programa" type="text"  required autocomplete="Programa">
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


    <div class="form-group col-md-4">
    
                      <div class="mdc-select demo-width-class " data-mdc-auto-init="MDCSelect">
                      <input type="hidden" name="Semestre"  required autocomplete="Semestre">
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

   <div class="form-row">
   

    <div class="form-group col-md-6">
      <label for="inputEmail4">Correo</label>
      <input type="email" class="form-control  @error('Correo') is-invalid @enderror" id="inputEmail44" name="Correo">
   @error('Correo')
       <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>


    <div class="form-group col-md-6">
      
      
      <input  type="file" name="foto" class="custom-file-input  @error('foto') is-invalid @enderror" id="customFileLang" lang="es">
      <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
         @error('foto')
       <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>


  </div>

  <div class="form-row">
    

    <div class="form-group col-md-6">
      <label for="inputPassword4">Contraseña</label>
      <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" id="password" >

      @error('password')
       <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>


    <div class="form-group col-md-6">
      <label for="inputPassword4">Confirmar contraseña</label>
      <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password_confirmation" id="password-confirm" >
       @error('password')
       <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>

  </div>

  <button type="submit" class="btn btn-primary">Registrarse</button>
</form>

  <script>
                          $("#formCheckPassword").validate({
           rules: {
               password: { 
                 required: true,
                    minlength: 8,
                    maxlength: 15,

               } , 

                   cfmPassword: { 
                    equalTo: "#password",
                     minlength: 8,
                     maxlength: 15
               }


           },
     messages:{
         password: { 
                 required:"Es necesario una contraseña",
                 minlength: "Minimo 8 caracteres",
                 maxlength: "Maximo 15 caracteres"
               },
       cfmPassword: { 
         equalTo: "Las contraseñas no coinciden",
         minlength: "Minimo 8 caracteres",
         maxlength: "Maximo 15 caracteres"
       }
     }

});
                        </script>
<br>
<br>
<br>
</div>

@endsection

 