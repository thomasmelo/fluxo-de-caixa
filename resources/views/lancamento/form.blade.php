@extends('layouts.base')
@section('conteudo')
    <h1>
        <i class="bi bi-piggy-bank-fill"></i>
        @if($lancamento)
            Atualizar Lançamento
        @else
            Novo Lançamento
        @endif
    </h1>
    @if ($lancamento)        
        <form action="{{ route('lancamento.update', ['id'=>$lancamento->id_lancamento]) }}" method="post">        
    @else
        <form action="{{ route('lancamento.store') }}" method="post">        
    @endif
        @csrf
       <div class="row"> 

            <div class="form-group col-md-4">
                <label for="id_centro_custo" class="form-label"> Centro de Custo*</label>
                <select name="id_centro_custo" id="id_centro_custo" class="form-control"
                required >
                <option value="">Selecione</option>

                <optgroup label="Saídas">
                    @foreach ($saidas->get() as $centroCusto)
                        <option value="{{ $centroCusto->id_centro_custo}}" 
                          {{ 
                            (
                                $lancamento 
                                && 
                                $lancamento->id_centro_custo == $centroCusto->id_centro_custo
                            )
                            ? 
                            'selected'
                            :
                            ''
                          }}
                            >
                            {{ $centroCusto->centro_custo}}
                        </option>
                    @endforeach
                </optgroup>

                <optgroup label="Entradas">
                    @foreach ($entradas->get() as $centroCusto)
                        <option value="{{ $centroCusto->id_centro_custo}}" 
                          {{ 
                            (
                                $lancamento 
                                && 
                                $lancamento->id_centro_custo == $centroCusto->id_centro_custo
                            )
                            ? 
                            'selected'
                            :
                            ''
                          }}
                            >
                            {{ $centroCusto->centro_custo}}
                        </option>
                    @endforeach
                </optgroup>           
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="dt_faturamento" class="form-label">DT Faturamento*</label>
                <input type="date" name="dt_faturamento" id="dt_faturamento"
                class="form-control"
                value="{{ $lancamento ? $lancamento->dt_faturamento->format('Y-m-d') : old('dt_faturamento') }}"
                required>
            </div>
            <div class="form-group col-md-2">
                <label for="valor" class="form-label">Valor*</label>
                <input type="number" name="valor" id="valor"
                class="form-control"
                min="0"
                value ="{{ $lancamento ? $lancamento->valor : old('valor') }}"
                required>
            </div>
            <div class="form-group col-md-12">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea name="descricao" id="descricao" rows="3" 
                class="form-control"> {{ $lancamento ? $lancamento->descricao : old('descricao') }} </textarea> 
            </div>           
            <div class="form-group col-md-2">
                <label for="btn-enviar" class="form-label">&nbsp;</label>
                <input type="submit" value="{{ $lancamento ? 'Atualizar' : 'Cadastrar' }}" 
                 id="btn-enviar"  class="btn btn-primary form-control">
            </div>
       </div>
    </form>
@endsection