<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous" defer>
    </script> 
    <style>
        footer {
            width: 75%;
            position: fixed;
            bottom:0;        
        }
    </style>   
</head>
<body>
    <div class="container">
        {{-- MENU --}}        
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    Fluxo de Caixa
                    - {{ Auth::user()->nome }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavFluxo"
                    aria-controls="navbarNavFluxo" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavFluxo">
                    <div class="navbar-nav">
                        <a class="nav-link" href="#">
                           <i class="bi bi-house-door-fill"></i>
                           Home
                        </a>
                        <a class="nav-link" href="{{ route('lancamento.index') }}">
                            <i class="bi bi-piggy-bank-fill"></i>
                            Lancamentos
                        </a>
                        <a class="nav-link" href="{{ route('centro.index') }}">
                            <i class="bi bi-basket-fill"></i>
                            Centro de Custo
                        </a>                        
                        <a class="nav-link" href="{{ route('tipo.index') }}">
                            <i class="bi bi-arrow-down-up"></i>
                            Tipos
                        </a>                        
                        <a class="nav-link" href="{{ route('logout') }}">
                            <i class="bi bi-box-arrow-right"></i>
                            Sair
                        </a>
                    </div>
                </div>
            </div>
        </nav>        
        {{-- /MENU --}}

        {{-- CONTEÚDO --}}
        <div class="row mt-2 mb-4">
            @yield('conteudo')
        </div>
        {{-- CONTEÚDO --}}
        {{-- RODAPÉ --}}        
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-12 d-flex align-items-center">
                <span class="mb-3 mb-md-0 text-muted">© Todos os direitos reservados {{ date('Y') }}</span>
                &nbsp;
                <a href="https://thomasmelo.com.br" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                 - Thomas Melo  
                </a>
            </div>
        </footer>
        {{-- RODAPÉ --}}
    </div>    
</body>
@yield('script')
</html>