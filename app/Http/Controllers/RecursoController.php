<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Recurso;
use App\Models\Programa;
use App\Models\Archivo;
use App\Models\Visto;


class RecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $archivos=Archivo::all();

        $programas=Programa::all();
        
        //$recursos=Recurso::all();

        $recursos= \DB::select('call recursos()');

        //mandando lo datos a la vista 
       

        //return view('admin.recursos',$archivos,$recursos,$programas);
        return view("admin.recursos",['archivos'=>  $archivos,
                                      'programas'=> $programas,
                                      'recursos'=>  $recursos]);
         
        //$tecnico = Technician::all();
        //$secretaria = Secretarie::all();
        //$direccion = Direction::all();
        //$unidad = Unit::all();
        //return view("registro.soporte", 
          //          ['tecnicos' => $tecnico, 
            //        'secretarias' => $secretaria, 
              //      'direcciones' => $direccion, 
                //    'unidades' => $unidad]);
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
            'tema'                 => ['required', 'string', 'min:3', 'max:90'],
           'descripcion'           => ['required', 'string', 'min:10', 'max:255'],
           'institucion'           => ['required', 'string', 'min:5', 'max:50'],
           'año'                   => ['required', 'string', 'min:4', 'max:4'],
           'archivo'               => ['file', 'max:100000'],
           'url'                   => ['required', 'url'],
           'foto'                  => ['image']

            
        ]);

         
           
           
           
        //
         //$datosRecursos=request()->except('_token');
         //Recursos::insert($datosRecursos);
        
         $recursos = new Recurso;

if($archivo=$request->file('archivo')){

      //cambio de ruta del archivo 
      $nombre = $archivo->getClientOriginalName();
    $archivo->move('imagenes_recursos', $nombre);
if( $archivo2=$request->file('foto')){


      $nombre2 = $archivo2->getClientOriginalName();
    $archivo2->move('imagenes_recursos', $nombre2);
}
    

    

         $recursos->tema            = $request->tema;
         $recursos->id_programa     = number_format($request->programa);
         $recursos->semestre        = number_format($request->semestre);
         $recursos->descripcion     = $request->descripcion;
         $recursos->institucion     = $request->institucion;
         $recursos->año             = $request->año;
         $recursos->id_tipo_archivo = number_format($request->tipo);
         $recursos->url             = $request->url;
         $recursos->autores         = $request->autor;
         $recursos->archivo         = $nombre;
         $recursos->foto            = $nombre2;
}



         $recursos->save();

     $visto = new Visto;
           $max_re  = Recurso::max('id');
           $user = Auth::user()->id;

          $visto->id_user     = 1;
          $visto->id_recurso  = $max_re;
 
         
          $visto->save();
       //retornar a una vista
          return redirect('/admin')->with('alert-success', 'Recurso Creado exitosamente');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recurso  $recurso
     * @return \Illuminate\Http\Response
     */
    public function show(Recurso $recurso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recurso  $recurso
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        
        $archivos   =  Archivo::all();

        $programas  =  Programa::all();

       
        
        $recurso    =  Recurso::findOrFail($id);

     
        //mandando lo datos a la vista 
       

        //return view('admin.recursos',$archivos,$recursos,$programas);
        return view("admin.modificar_recursos",['archivos'  => $archivos,
                                                'programas' => $programas,
                                                'recurso'   => $recurso]);

        //$recurso = Recurso::findOrFail($id);
        //return view('admin.modificar_recursos',compact('recurso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recurso  $recurso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([
            'tema'                 => ['required', 'string', 'min:3', 'max:90'],
           'descripcion'           => ['required', 'string', 'min:10', 'max:255'],
           'institucion'           => ['required', 'string', 'min:5', 'max:50'],
           'año'                   => ['required', 'string', 'min:4', 'max:4'],
           'archivo'               => ['file', 'max:10000'],
           'foto'                  => ['image'],
           'url'                   => ['required', 'url'],
           'autor'                 => ['required', 'string', 'min:4', 'max:50'],
     
            
        ]);

     if($archivo=$request->file('archivo')){

        $recurso = Recurso::findOrFail($id);

        $nombre = $archivo->getClientOriginalName();
        $archivo->move('imagenes_recursos', $nombre);
     
        if( $archivo2=$request->file('foto')){


            $nombre2 = $archivo2->getClientOriginalName();
            $archivo2->move('imagenes_recursos', $nombre2);
}
        $recurso->tema     = $request->tema;
        $recurso->id_programa = $request->programa;
        $recurso->semestre = $request->semestre;
        $recurso->descripcion = $request->descripcion;
        $recurso->institucion = $request->institucion;
        $recurso->año = $request->año;
        $recurso->id_tipo_archivo = $request->tipo;
        $recurso->url = $request->url;
        $recurso->autores = $request->autor;
        $recurso->archivo = $nombre;
        $recurso->foto    = $nombre2;
         
     
     }else{
         
        $recurso = Recurso::findOrFail($id);
        
        $recurso->tema     = $request->tema;
        $recurso->id_programa = $request->programa;
        $recurso->semestre = $request->semestre;
        $recurso->descripcion = $request->descripcion;
        $recurso->institucion = $request->institucion;
        $recurso->año = $request->año;
        $recurso->id_tipo_archivo = $request->tipo;
        $recurso->url = $request->url;
        $recurso->autores = $request->autor;
        $recurso->archivo = $request->archivo2;
        $recurso->foto = $request->foto2;
     }
        
    
       $recurso->update();

       
         $max_re  = Recurso::max('id');
           
           $visto = new Visto;

           $user = Auth::user()->id;

          $visto->id_user     = $user;
          $visto->id_recurso  = $max_re;
 
          $visto->save();
      return redirect('/admin')->with('alert-success', 'Recurso se Actualizo exitosamente');
      
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recurso  $recurso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        //
         Recurso::destroy($id);
    
         return redirect("/admin");
    }
}
