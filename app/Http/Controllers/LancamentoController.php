<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\{
                Lancamento,
                CentroCusto,
                User,
                Tipo
            };

class LancamentoController extends Controller
{
    /**
     * Mostra os lançamentos do usuário
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $pesquisar = $request->pesquisar;
        $dt_inicio = null;
        $dt_fim = null;
        if ( $request->dt_inicio ||  $request->dt_fim){
            // data de inicio
            if ($request->dt_inicio) {
                $dt_inicio = $request->dt_inicio;
            } else {
                $dt = new Carbon($request->dt_fim);
                $dt->subDays(10);
                $dt_inicio = $dt;
            }
            // data de fim
            if ($request->dt_fim){
                $dt_fim = $request->dt_fim;
            } else {
                $dt = new Carbon($request->dt_inicio);
                $dt->addDays(10);
                $dt_fim = $dt;
            }           
        }

        $lancamentos = Lancamento::where( function( $query ) use ($pesquisar,$dt_inicio,$dt_fim){
                    $query->where('id_user',Auth::user()->id_user);
                    
                    if($pesquisar){
                        $query->where('descricao','like',"%{$pesquisar}%");
                    }

                    if($dt_inicio || $dt_fim){
                        $query->whereBetween('dt_faturamento', [$dt_inicio, $dt_fim]);
                    }
        })->with(['centroCusto.tipo'])
            ->orderBy('dt_faturamento', 'desc')
            ->paginate(5); 
          
        return view('lancamento.index')
                    ->with(compact('lancamentos'));
    }

    /**
     * Encaminha para o FORM de cadastro.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lancamento = null;
        $centrosDeCusto = CentroCusto::orderBy('centro_custo');
        $entradas = CentroCusto::where('id_tipo',1)
                                ->orderBy('centro_custo');
        $saidas = CentroCusto::where('id_tipo',2)
                                ->orderBy('centro_custo');
        return view('lancamento.form')
                ->with(compact('entradas','saidas','lancamento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lancamento = new Lancamento();
        $lancamento->fill($request->all());
        $lancamento->id_user = Auth::user()->id_user;
        $lancamento->save();
        return redirect()
                ->route('lancamento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function show(Lancamento $lancamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $lancamento = Lancamento::find($id);
        $centrosDeCusto = CentroCusto::orderBy('centro_custo');
        $entradas = CentroCusto::where('id_tipo',1)
                                ->orderBy('centro_custo');
        $saidas = CentroCusto::where('id_tipo',2)
                                ->orderBy('centro_custo');
        return view('lancamento.form')
                ->with(compact('entradas','saidas','lancamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $lancamento = Lancamento::find($id);
        $lancamento->fill($request->all());        
        $lancamento->save();
        return redirect()
                ->route('lancamento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lancamento $lancamento)
    {
        //
    }
}
