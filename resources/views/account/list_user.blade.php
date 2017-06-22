@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-12">            
                <h2 class="letras_titulos">Users</h2>
            </div>
        </div>    
        <div class="row">
            <div class="col-md-12">
	        <div align="right">
                    <a id="regresar" name="regresar" class="btn btn-danger" href="{{ url('account') }}">Regresar</a>
	        </div>
	    </div>
        </div>

        <ul>
            <div class='table-responsive fondo_blanco'>
                <table class="table table-hover table-striped">
                    <thead>
                        <th class="encabezado_tabla">Usuario</th>
                        <th class="encabezado_tabla">Nombre Completo</th>
                        <th class="encabezado_tabla">Email</th>
                        
                        <th class="encabezado_tabla" colspan="2" style="text-align: center">Acción</th>			
                    </thead>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->username}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            
                            <td><input type="checkbox" value="{{$user->active}}"></td>
                            
                            <td span="2" align="center">
                                <a id="editar_usuario" name="editar_usuario" class="glyphicon glyphicon-pencil btn btn-primary" href="{{ url('user/edite/'.$user->id) }}" title="Editar Usuario"></a>
                                <a id="eliminar_usuario" name="eliminar_usuario" class="glyphicon glyphicon-erase btn btn-danger" href="{{ url('user/delete/'.$user->id) }}" title="Eliminar Cliente" data-toggle="modal" data-target="#modal"></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </ul>
         
        {!! $users->render() !!}
        
    </div>
</div>
@endsection
