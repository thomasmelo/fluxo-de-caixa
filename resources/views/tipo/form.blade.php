@extends('layouts.base')
@section('conteudo')
    <h1>
        @if($tipo)
            Atualizar Tipo
        @else
            Novo Tipo
        @endif
    </h1>
    @if ($tipo)        
        <form action="{{ route('tipo.update', ['id'=>$tipo->id_tipo]) }}" method="post">        
    @else
        <form action="{{ route('tipo.store') }}" method="post">        
    @endif
        @csrf
       <div class="row">
            <div class="form-group col-md-6">
                <label for="tipo" class="form-label">Tipo*</label>
                <input type="text" name="tipo" id="tipo"
                    value="{{ $tipo ? $tipo->tipo : old('tipo') }}" required
                class="form-control">
            </div>
            <div class="form-group col-md-2">
                <label for="btn-enviar" class="form-label">&nbsp;</label>
                <input type="submit" value="{{ $tipo ? 'Atualizar' : 'Cadastrar' }}" 
                 id="btn-enviar"  class="btn btn-primary form-control">
            </div>
       </div>
    </form>
@endsection