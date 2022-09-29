@extends('layouts.base')

@section('conteudo')

    <h1> 
        <i class="bi bi-piggy-bank-fill"></i>
        Lançamentos 
        - 
        <a href="{{ route('lancamento.create') }}" class="btn btn-dark">
            Novo
        </a>
    </h1>
    <h2>
        Usuário:  {{ Auth::user()->nome }}
        - 
        Total de Lançamentos - {{ $lancamentos->count() }}
        - 
        R$ {{ $lancamentos->sum('valor') }}
    </h2>
    {{-- FORMULARIO DE PESQUISA --}}
    <form action="{{ route('lancamento.index') }}" method="get">
        {{-- @csrf --}}
        {{-- search --}}       
        <input type="text" 
            name="pesquisar" 
            id="pesquisar"
            value="{{ old('pesquisar') }}"
            placeholder="Digite o termo a ser pesquisado...">

            <input type="date" 
            name="dt_inicio" 
            id="dt_inicio"
            placeholder="inicio">
            <input type="date" 
            name="dt_fim" 
            id="dt_fim"
            placeholder="fim">
        <input type="submit" value="Pesquisar">
    </form>
    {{-- /FORMULARIO DE PESQUISA --}}

    <table class="table table-striped table-border">
        <thead>
            <tr>
                <th>Ações</th>
                <th>ID</th>
                <th>Data de Faturamento</th>
                <th>R$ Valor</th>
                <th>Tipo</th>
                <th>lancamento de Custo</th>
                <th>Descrição</th>
                <th>Data de Lançamento</th>
                <th>Data de Atualização</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lancamentos as $lancamento)                
            <tr>
                <td>
                    <a href="{{ route('lancamento.edit', ['id'=>$lancamento->id_lancamento]) }}" class="btn btn-success">
                        Editar
                    </a>
                </td>
                <td>{{ $lancamento->id_lancamento }}</td>
                <td>{{ $lancamento->dt_faturamento->format('d/m/Y') }}</td>
                <td>{{ $lancamento->valor }}</td>
                <td>{{ $lancamento->centroCusto->tipo->tipo }}</td>
                <td>{{ $lancamento->centroCusto->centro_custo }}</td>
                <td>{{ $lancamento->descricao }}</td>
                <td>{{ $lancamento->created_at->format('d/m/Y') }}</td>
                <td>{{ $lancamento->updated_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

        <div class="py-4">
            {{ $lancamentos->appends([ 'pesquisar' => request()->get('pesquisar', '')])->links() }}
        </div>
    
@endsection