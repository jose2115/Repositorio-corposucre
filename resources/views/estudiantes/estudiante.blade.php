@extends('layouts.estudiante')

@section('header')
   
@endsection



@section('historial')

<h3>Historial</h3>

@foreach($historiales as $historiale)
<div class="recurso">
          <div class="header_recurso">
               <h4>{{ $historiale->tema }}</h4>
          </div>

          <div class="foto_recurso">
               <img src="{{asset('imagenes_recursos/'.$historiale->foto)}}" alt="">

          </div>
          <div class="descripcion_recurso">
               <p>{{  $historiale->descripcion }}</p>
          </div>
          <div class="footer_recurso">
               <div class="footer_re">
                    <h6>visto {{  $historiale->vistas }}</h6>
               </div>

               <div class="footer_re e">

                @if (Auth::check())
                   <form action="{{url('/estudiante/recurso/'.$historiale->id)}}">
                      <button class="info_buscar_pie" type="submit">Ver</button>
                    </form>
                    @else
                    <form action="{{url('/')}}">
                        <button class="info_buscar_pie" type="submit" onclick="return confirm('Inicia sesion primero')">Ver</button>
                    </form>
                    @endif
                  
               </div>
          </div>
</div>


@endforeach


@endsection

@section('cuerpo')


@foreach($recursos as $recurso)
<div class="recurso">
          <div class="header_recurso">
               <h4>{{ $recurso->tema }}</h4>
          </div>

          <div class="foto_recurso">
               <img src="{{asset('imagenes_recursos/'.$recurso->foto)}}" alt="">

          </div>
          <div class="descripcion_recurso">
               <p>{{  $recurso->descripcion }}</p>
          </div>
          <div class="footer_recurso">
               <div class="footer_re">
                    <h6>visto {{  $recurso->vistas }}</h6>
               </div>
               <div class="footer_re e">

                    @if (Auth::check())
                   <form action="{{url('/estudiante/recurso/'.$recurso->id)}}">
                      <button class="info_buscar_pie" type="submit">Ver</button>
                    </form>
                    @else
                    <form action="{{url('/')}}">
                        <button class="info_buscar_pie" type="submit" onclick="return confirm('Inicia sesion primero')">Ver</button>
                    </form>
                    @endif
               </div>
          </div>
</div>


@endforeach


@endsection

@section('popular')
<h3>Lo mas visto</h3>

@foreach($populares as $populare)

<div class="recurso">
          <div class="header_recurso">
               <h4>{{ $populare->tema }}</h4>
          </div>

          <div class="foto_recurso">
               <img src="{{asset('imagenes_recursos/'.$populare->foto)}}" alt="">

          </div>
          <div class="descripcion_recurso">
               <p>{{  $populare->descripcion }}</p>
          </div>
          <div class="footer_recurso">
               <div class="footer_re">
                    <h6>visto {{  $populare->vistas }}</h6>
               </div>
               <div class="footer_re e">
                    @if (Auth::check())
                   <form action="{{url('/estudiante/recurso/'.$populare->id)}}">
                      <button class="info_buscar_pie" type="submit">Ver</button>
                    </form>
                    @else
                    <form action="{{url('/')}}">
                        <button class="info_buscar_pie" type="submit" onclick="return confirm('Inicia sesion primero')">Ver</button>
                    </form>
                    @endif
               </div>
          </div>
</div>


@endforeach
@endsection


@section('cuerpo3')
<h3>Ingeneria</h3>

@foreach($ingenierias as $ingenieria)

<div class="recurso">
          <div class="header_recurso">
               <h4>{{ $ingenieria->tema }}</h4>
          </div>

          <div class="foto_recurso">
               <img src="{{asset('imagenes_recursos/'.$ingenieria->foto)}}" alt="">

          </div>
          <div class="descripcion_recurso">
               <p>{{  $ingenieria->descripcion }}</p>
          </div>
          <div class="footer_recurso">
               <div class="footer_re">
                    <h6>visto {{  $ingenieria->vistas }}</h6>
               </div>
               <div class="footer_re e">
                  
                    @if (Auth::check())
                   <form action="{{url('/estudiante/recurso/'.$ingenieria->id)}}">
                      <button class="info_buscar_pie" type="submit">Ver</button>
                    </form>
                    @else
                    <form action="{{url('/')}}">
                        <button class="info_buscar_pie" type="submit" onclick="return confirm('Inicia sesion primero')">Ver</button>
                    </form>
                    @endif
               </div>
          </div>
</div>


@endforeach
@endsection


@section('cuerpo4')
<h3>Contabilidad</h3>

@foreach($contadores as $contadore)

<div class="recurso">
          <div class="header_recurso">
               <h4>{{ $contadore->tema }}</h4>
          </div>

          <div class="foto_recurso">
               <img src="{{asset('imagenes_recursos/'.$contadore->foto)}}" alt="">

          </div>
          <div class="descripcion_recurso">
               <p>{{  $contadore->descripcion }}</p>
          </div>
          <div class="footer_recurso">
               <div class="footer_re">
                    <h6>visto {{  $contadore->vistas }}</h6>
               </div>
               <div class="footer_re e">
                    @if (Auth::check())
                   <form action="{{url('/estudiante/recurso/'.$contadore->id)}}">
                      <button class="info_buscar_pie" type="submit">Ver</button>
                    </form>
                    @else
                    <form action="{{url('/')}}">
                        <button class="info_buscar_pie" type="submit" onclick="return confirm('Inicia sesion primero')">Ver</button>
                    </form>
                    @endif
               </div>
          </div>
</div>


@endforeach
@endsection


@section('cuerpo5')
<h3>Comunicacion</h3>

@foreach($comunicaciones as $comunicacione)

<div class="recurso">
          <div class="header_recurso">
               <h4>{{ $comunicacione->tema }}</h4>
          </div>

          <div class="foto_recurso">
               <img src="{{asset('imagenes_recursos/'.$comunicacione->foto)}}" alt="">

          </div>
          <div class="descripcion_recurso">
               <p>{{  $comunicacione->descripcion }}</p>
          </div>
          <div class="footer_recurso">
               <div class="footer_re">
                    <h6>visto {{  $comunicacione->vistas }}</h6>
               </div>
               <div class="footer_re e">
                    @if (Auth::check())
                   <form action="{{url('/estudiante/recurso/'.$comuniccione->id)}}">
                      <button class="info_buscar_pie" type="submit">Ver</button>
                    </form>
                    @else
                    <form action="{{url('/')}}">
                        <button class="info_buscar_pie" type="submit" onclick="return confirm('Inicia sesion primero')">Ver</button>
                    </form>
                    @endif
               </div>
          </div>
</div>


@endforeach
@endsection

@section('psicologia')
<h3>Psicologia</h3>

@foreach($psicologias as $psicologia)

<div class="recurso">
          <div class="header_recurso">
               <h4>{{ $psicologia->tema }}</h4>
          </div>

          <div class="foto_recurso">
               <img src="{{asset('imagenes_recursos/'.$psicologia->foto)}}" alt="">

          </div>
          <div class="descripcion_recurso">
               <p>{{  $psicologia->descripcion }}</p>
          </div>
          <div class="footer_recurso">
               <div class="footer_re">
                    <h6>visto {{  $psicologia->vistas }}</h6>
               </div>
               <div class="footer_re e">
                    @if (Auth::check())
                   <form action="{{url('/estudiante/recurso/'.$psicologia->id)}}">
                      <button class="info_buscar_pie" type="submit">Ver</button>
                    </form>
                    @else
                    <form action="{{url('/')}}">
                        <button class="info_buscar_pie" type="submit" onclick="return confirm('Inicia sesion primero')">Ver</button>
                    </form>
                    @endif
               </div>
          </div>
</div>


@endforeach
@endsection