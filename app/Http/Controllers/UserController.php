<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


use App\Models\Programa;
use App\Models\Facultade;
use App\Models\Archivo;
use App\Models\Role;
use App\Models\Persona;
use App\Models\User;


use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        
        $programas=Programa::all();

        $facultades = Facultade::all();

        $roles = Role::all();
        
        $usuarios= \DB::select('call usuarios()');
        
       //return($usuarios); ->whit('message', 'store');

       //return view("usuarios.usuarios");
        return view("usuarios.usuarios",['usuarios'   =>  $usuarios,
                                         'roles'      =>  $roles,
                                         'programas'  =>  $programas,
                                         'facultades' => $facultades])->with('message', 'store');
         

    }


   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
   

        $request->validate([
            'Nombre'                 => ['required', 'string', 'min:3', 'max:25'],
            'Apellido'               => ['required', 'string', 'min:3', 'max:25'],
            'Correo'                 => ['required', 'unique:users,email'],
         
            'Archivo'                => ['image'],
            'password'               => ['required','string','min:8','max:15', 'confirmed'],
            
        ]);

     

if($foto=$request->file('Archivo')){

      //cambio de ruta del archivo 
       //$max_id = Persona::find(DB::table('personas')->max('id'));
        $max_id =  Persona::max('id'); 
        $max_usuario = User::max('id');
    //  $max_persona = \DB::select('call max_id_personas()');

    $nombre_foto = $foto->getClientOriginalName();
    $foto->move('imagenes_recursos', $nombre_foto);

    $arrayPalabras = explode(" ",$request->Nombre);
    $arrayPalabras2 = explode(" ",$request->Apellido);

   for ($i=0; $i < 3; $i++) { 

    $nom = $arrayPalabras[0];

    if(empty($arrayPalabras[1])){

        $nom2 = $arrayPalabras[1] =" ";
    }else{
        $nom2 = $arrayPalabras[1];
    }
}
for ($i=0; $i < 3; $i++) { 

    $ape = $arrayPalabras2[0];

    if(empty($arrayPalabras2[1])){

        $ape2 = $arrayPalabras2[1] =" ";
    }else{
        $ape2 = $arrayPalabras2[1];
    }
    
}  


         $name            = $nom;
         $email           = $request->Correo;
         $contra          = Hash::make($request->password);
         $id_persona      = $max_id + 1;
         $id_usuario      = $max_usuario + 1;
         $id_programa     = $request->Programa;
         $semestre        = $request->Semestre;
         $foto            = $nombre_foto;
         $fecha           = date('Y-m-d H:i:s', strtotime("-1 day"));
         $rol             = $request->Rol;
         $ruta            = "App\Models\User"; 
      
        

      \DB::beginTransaction();

          try {
            $asignar_rol      = \DB::insert('call asignar_rol_usuario(?,?,?)',array($rol, $ruta, $id_usuario));

            $insertar_persona = \DB::insert('call insertar_personas(?,?,?,?)',array($nom, $nom2, $ape, $ape2));
    
            $insertar_usuario  = \DB::insert('call insertar_usuarios(?,?,?,?,?,?,?,?)',array($name, $email, $contra,
            $id_persona, $id_programa, $semestre, $foto, $fecha));;

       \DB::commit();
    // all good
    return redirect('/usuarios')->with('alert-success', 'El usuario se registro exitosamente');
             } catch (\Exception $e) {
         \DB::rollback();
    // something went wrong
    return redirect('/usuarios')->with('alert-danger', 'Error en el registro');
         }
                    
                    
                    return redirect('/usuarios');

}else{

            
      //cambio de ruta del archivo 
       //$max_id = Persona::find(DB::table('personas')->max('id'));
        $max_id =  Persona::max('id'); 
        $max_usuario = User::max('id');
    //  $max_persona = \DB::select('call max_id_personas()');

  

    $arrayPalabras = explode(" ",$request->Nombre);
    $arrayPalabras2 = explode(" ",$request->Apellido);

   for ($i=0; $i < 3; $i++) { 

    $nom = $arrayPalabras[0];

    if(empty($arrayPalabras[1])){

        $nom2 = $arrayPalabras[1] =" ";
    }else{
        $nom2 = $arrayPalabras[1];
    }
}
for ($i=0; $i < 3; $i++) { 

    $ape = $arrayPalabras2[0];

    if(empty($arrayPalabras2[1])){

        $ape2 = $arrayPalabras2[1] =" ";
    }else{
        $ape2 = $arrayPalabras2[1];
    }
    
}  


         $name            = $nom;
         $email           = $request->Correo;
         $contra          = Hash::make($request->password);
         $id_persona      = $max_id + 1;
         $id_usuario      = $max_usuario + 1;
         $id_programa     = $request->Programa;
         $semestre        = $request->Semestre;
         $foto            = "foto";
         $fecha           = date('Y-m-d H:i:s', strtotime("-1 day"));
         $rol             = $request->Rol;
         $ruta            = "App\Models\User"; 
      
        

      \DB::beginTransaction();

             try {
                     $asignar_rol      = \DB::insert('call asignar_rol_usuario(?,?,?)',array($rol, $ruta, $id_usuario));

                     $insertar_persona = \DB::insert('call insertar_personas(?,?,?,?)',array($nom, $nom2, $ape, $ape2));
    
                    $insertar_usuario  = \DB::insert('call insertar_usuarios(?,?,?,?,?,?,?,?)',array($name, $email, $contra,
                    $id_persona, $id_programa, $semestre, $foto, $fecha));;

                    \DB::commit();
    // all good
    return redirect('/usuarios')->with('alert-success', 'El usuario se registro exitosamente');
                } catch (\Exception $e) {
                     \DB::rollback();
    // something went wrong

    return redirect('/usuarios')->with('alert-danger', 'Error en el registro');
                }
                    
                    
                    





}

     
    

                      
       




       //retornar a una vista






    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        
        $facultades = Facultade::all();

        $roles = Role::all();
        $archivos   =  Archivo::all();

        $programas  =  Programa::all();

       
        $usuarios= \DB::select('call usuarios_id(?)', array($id));
      
     
        //mandando lo datos a la vista 
       

        //return view('admin.recursos',$archivos,$recursos,$programas);
       return view("usuarios.modificar_usuario",['archivos'  => $archivos,
                                                'facultades' => $facultades,
                                                'roles'      => $roles,
                                                'programas' => $programas,
                                               'usuarios'   => $usuarios]);

        //$recurso = Recurso::findOrFail($id);
        //return view('admin.modificar_recursos',compact('recurso'));

   
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)] 'required|email|unique:users,email,'.$user->id,

        $user    =  User::findOrFail($id);
         
        $request->validate([
            'Nombre'                 => ['required', 'string', 'min:3', 'max:25'],
            'Apellido'               => ['required', 'string', 'min:3', 'max:25'],
            'Correo'                 => ['required', 'unique:users,email,'.$user->id],
         
            'Archivo'                => ['image'],
            'password'               => ['confirmed'],
            
        ]);


       

        if($foto=$request->file('Archivo')){

      //cambio de ruta del archivo 
       //$max_id = Persona::find(DB::table('personas')->max('id'));
       
    //  $max_persona = \DB::select('call max_id_personas()');

    $nombre_foto = $foto->getClientOriginalName();
    $foto->move('imagenes_recursos', $nombre_foto);

    $arrayPalabras = explode(" ",$request->Nombre);
    $arrayPalabras2 = explode(" ",$request->Apellido);

   for ($i=0; $i < 3; $i++) { 

    $nom = $arrayPalabras[0];

    if(empty($arrayPalabras[1])){

        $nom2 = $arrayPalabras[1] =" ";
    }else{
        $nom2 = $arrayPalabras[1];
    }
}
for ($i=0; $i < 3; $i++) { 

    $ape = $arrayPalabras2[0];

    if(empty($arrayPalabras2[1])){

        $ape2 = $arrayPalabras2[1] =" ";
    }else{
        $ape2 = $arrayPalabras2[1];
    }
    
}  

         $name            = $nom;
         $email           = $request->Correo;
         $contra          = Hash::make($request->password);
        
         $id_programa     = $request->Programa;
         $semestre        = $request->Semestre;
         $fecha           = date('Y-m-d H:i:s', strtotime("-1 day"));
         $rol             = $request->Rol;

         //verificando si el campo contraseña esta vacio
        if(empty($contra)){

             $contraseña = $user->password;

        }else{
            $contraseña = $contra;
        }

        $insertar_persona = \DB::insert('call update_usuario(?,?,?,?,?,?,?,?,?,?,?,?)',
        array($id, $nom, $nom2, $ape, $ape2, $name, $email, $contraseña, $id_programa, $semestre, $nombre_foto, $rol ));
    
        
}else{

    $arrayPalabras = explode(" ",$request->Nombre);
    $arrayPalabras2 = explode(" ",$request->Apellido);

   for ($i=0; $i < 3; $i++) { 

    $nom = $arrayPalabras[0];

    if(empty($arrayPalabras[1])){

        $nom2 = $arrayPalabras[1] =" ";
    }else{
        $nom2 = $arrayPalabras[1];
    }
}
for ($i=0; $i < 3; $i++) { 

    $ape = $arrayPalabras2[0];

    if(empty($arrayPalabras2[1])){

        $ape2 = $arrayPalabras2[1] =" ";
    }else{
        $ape2 = $arrayPalabras2[1];
    } 


}        
                      
         $name            = $nom;
         $email           = $request->Correo;
         $contra          = Hash::make($request->password);
        
         $id_programa     = $request->Programa;
         $semestre        = $request->Semestre;
         $foto            = $user->foto;
         $fecha           = date('Y-m-d H:i:s', strtotime("-1 day"));
         $rol             = $request->Rol;

         //verificando si el campo contraseña esta vacio
        if(empty($contra)){

             $contraseña = $user->password;

        }else{
            $contraseña = $contra;
        }

        $insertar_persona = \DB::insert('call update_usuario(?,?,?,?,?,?,?,?,?,?,?,?)',
        array($id, $nom, $nom2, $ape, $ape2, $name, $email, $contraseña, $id_programa, $semestre, $foto, $rol ));
    }
    
       return redirect("/usuarios")->with('alert-success', 'El usuario se actualizo exitosamente');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $usuario   =  User::findOrFail($id);

        $id_persona = $usuario->id_persona;
        
         User::destroy($id);
         Persona::destroy($id_persona);
        \DB::delete('call eliminar_rol_usuario(?)', array($id));

         return redirect("/usuarios");
    }
}
