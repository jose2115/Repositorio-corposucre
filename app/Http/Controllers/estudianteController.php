<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Recurso;
use App\Models\Visto;
use App\Models\Gusto;
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


class estudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::check()){
       
             $user = Auth::user()->id;
        
        $id_programas = \DB::select('call consulta_programa_usuario(?)', array($user));
        foreach($id_programas as $id_programa){
                $programa = $id_programa->id_programa;
        }

        $recursos= \DB::select('call recursos_estudiantes(?)', array($programa));
        $historiales= \DB::select('call recurso_historial(?)', array($user));
         $psicologias= \DB::select('call recurso_psicologia()');
        $ingenierias= \DB::select('call recurso_ingenieria()');
        $contadores= \DB::select('call recurso_contador()');
        $comunicaciones= \DB::select('call recurso_comunicacion()');
        
        $populares= \DB::select('call recursos_populares()');

        return view("estudiantes.estudiante", ['recursos' => $recursos,
                                               'psicologias' => $psicologias,
                                               'ingenierias' => $ingenierias,
                                               'contadores' =>  $contadores,
                                               'comunicaciones' => $comunicaciones,
                                               'historiales' => $historiales,
                                               'populares' => $populares]);

        }else{
        
        $recursos= \DB::select('call recursos_estudiantes(?)', array(1));
        $historiales= \DB::select('call recurso_historial(?)', array(1));
         $psicologias= \DB::select('call recurso_psicologia()');
        $ingenierias= \DB::select('call recurso_ingenieria()');
        $contadores= \DB::select('call recurso_contador()');
        $comunicaciones= \DB::select('call recurso_comunicacion()');
        
        $populares= \DB::select('call recursos_populares()');

        return view("estudiantes.estudiante", ['recursos' => $recursos,
                                               'psicologias' => $psicologias,
                                               'ingenierias' => $ingenierias,
                                               'contadores' =>  $contadores,
                                               'comunicaciones' => $comunicaciones,
                                               'historiales' => $historiales,
                                               'populares' => $populares]);

        }
        
        
       

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
       //
     
        $request->validate([
            'Nombre'                 => ['required', 'string', 'min:3', 'max:25'],
            'Apellido'               => ['required', 'string', 'min:3', 'max:25'],
             'Correo'                 => ['required', 'unique:users,email'],
            'foto'                   => ['image'],
            'password'               => ['required','string','min:8','max:15', 'confirmed'],
            
        ]);
     
if($foto=$request->file('foto')){

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
        $max_id =  Persona::max('id'); 
        $max_usuario = User::max('id');
        

         $name            = $nom;
         $email           = $request->Correo;
         $contra          = Hash::make($request->password);
        $id_persona      = $max_id + 1;
         $id_usuario      = $max_usuario + 1;
         $id_programa     = $request->Programa;
         $semestre        = $request->Semestre;
         $foto            = $nombre_foto;
         $fecha           = date('Y-m-d H:i:s', strtotime("-1 day"));
         $rol = 1;
         $ruta            = "App\Models\User"; 
      
        

      \DB::beginTransaction();

          try {
            

            $insertar_persona = \DB::insert('call insertar_personas(?,?,?,?)',array($nom, $nom2, $ape, $ape2));
            
            $insertar_usuario  = \DB::insert('call insertar_usuarios(?,?,?,?,?,?,?,?)',array($name, $email, $contra,
            $id_persona, $id_programa, $semestre, $foto, $fecha));

            $asignar_rol      = \DB::insert('call asignar_rol_usuario(?,?,?)',array($rol, $ruta, $id_usuario));

       \DB::commit();
    // all good
    return redirect('/')->with('alert-success', 'El usuario se registro exitosamente'); 
             } catch (\Exception $e) {
         \DB::rollback();
    // something went wrong
    return redirect('/')->with('alert-success', 'Error en el registro');
         }
                    

                   

}else{

            
      //cambio de ruta del archivo 
       //$max_id = Persona::find(DB::table('personas')->max('id'));
   
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
        $max_id =  Persona::max('id'); 
        $max_usuario = User::max('id');

         $name            = $nom;
         $email           = $request->Correo;
         $contra          = Hash::make($request->password);
         $id_persona      = $max_id + 1;
         $id_usuario      = $max_usuario + 1;
         $id_programa     = $request->Programa;
         $semestre        = $request->Semestre;
         $foto            = "foto";
         $fecha           = date('Y-m-d H:i:s', strtotime("-1 day"));
        $rol = 1;
         $ruta            = "App\Models\User"; 
      
        

      \DB::beginTransaction();

             try {
                     

                     $insertar_persona = \DB::insert('call insertar_personas(?,?,?,?)',array($nom, $nom2, $ape, $ape2));
                     
                    
                     $insertar_usuario  = \DB::insert('call insertar_usuarios(?,?,?,?,?,?,?,?)',array($name, $email, $contra,
                    $id_persona, $id_programa, $semestre, $foto, $fecha));

                     $asignar_rol      = \DB::insert('call asignar_rol_usuario(?,?,?)',array($rol, $ruta, $id_usuario));


                    \DB::commit();
    // all good
   return redirect('/')->with('alert-success', 'El usuario se registro exitosamente');  
                } catch (\Exception $e) {
                     \DB::rollback();
    // something went wrong
    return redirect('/')->with('alert-success', 'Error en el registro'); 
                }
                    
                    
                    


    }

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
       

        //genera vistas en el video 
        
        $visto = new Visto;

        $user = Auth::user()->id;

        $visto->id_user     = $user;
        $visto->id_recurso  = $id;

        $visto->save();
        
        $id_programas = \DB::select('call consulta_programa_usuario(?)', array($user));
       
        

        $recursos =    \DB::select('call id_recurso(?)',array($id));
        //  $recurso    =  Recurso::findOrFail($id);
         foreach($recursos as $recurso){
                $programa = $recurso->id_programa;
        }

        $recomendaciones =    \DB::select('call recomendacion_recurso(?,?,?)',array($programa, $user, $id));

        $likes = \DB::select('call like_de_Recurso(?)', array($id));

        $vistas = \DB::select('call vistas_recurso(?)', array($id));
        //mandando lo datos a la vista 
       
        //verificando si existe un me gusta 
        $existes = \DB::select('call existe_like(?,?)', array($user, $id));
        
      
        //return view('admin.recursos',$archivos,$recursos,$programas);
        return view("estudiantes.ver_recursos",['recursos'   => $recursos,
                                                'likes'       => $likes,
                                                'vistas'      => $vistas,
                                                'existes'     => $existes,
                                                'recomendaciones' =>$recomendaciones]);

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

        
          
        return view("estudiantes.perfil",['archivos'  => $archivos,
                                                'facultades' => $facultades,
                                                'programas' => $programas,
                                               'usuarios'   => $usuarios]);

        //return view("estudiantes.perfil");
        
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
        //
          $user = Auth::user()->id;
        
        $request->validate([
            'Nombre'                 => ['required', 'string', 'min:3', 'max:25'],
            'Apellido'               => ['required', 'string', 'min:3', 'max:25'],
            'Correo'                 => ['required', 'unique:users,email,'.$user],
            'foto'                   => ['image'],
            'password'               => ['max:15', 'confirmed'],
            
        ]);
     
        

        $user    =  User::findOrFail($id);

        if($foto=$request->file('foto')){

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

        $insertar_persona = \DB::insert('call update_estudiante(?,?,?,?,?,?,?,?,?,?,?)',
        array($nom, $nom2, $ape, $ape2, $name, $email, $contraseña, $id_programa, $semestre, $nombre_foto,$id));
    
        
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

        $insertar_persona = \DB::insert('call update_estudiante(?,?,?,?,?,?,?,?,?,?,?)',
        array($nom, $nom2, $ape, $ape2, $name, $email, $contraseña, $id_programa, $semestre, $foto, $id));
    }
    
return redirect("/")->with('alert-success', 'El usuario se actualizo exitosamente');
      

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
    }

    public function downloadFile($id){
    
    
        //$recursos =    \DB::select('call id_recurso(?)',array($id));
        // $d1 = Recurso::find($id);

        //return Storage::download('public/imagenes_recursos/'. $d1->archivo);

       // return response()->download('public/imagenes_recursos', $d1->archivo);

       $archivo = Recurso::find($id);

        $pathToFile = "imagenes_recursos/".$archivo->archivo;

        return response()->download($pathToFile);

       
    }

    public function gusto(Request $request){

            $id_recurso = $request->nombres;


             $user = Auth::user()->id;

             $existe_like = \DB::select('call existe_like(?,?)', array($user, $id_recurso));

         if(empty($existe_like)){

                $gusto = new Gusto;

                $gusto->id_user     = $user;
                $gusto->id_recurso  = $id_recurso;

                $gusto->save();
           
             }else{

                 $eliminar_like = \DB::delete('call eliminar_like(?,?)', array($user, $id_recurso));

             }

             $likes = \DB::select('call like_de_Recurso(?)', array($id_recurso));

             foreach($likes as $like){
                   $a =  $like->gusto;
             }

        if($request->ajax()){
                return response()->json(['mensaje'=>$a]);
                return response()->json(['mensaje2'=>$existe_like]);
        }
       
        
        
    }
}
