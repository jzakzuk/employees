@extends('layouts.app')

@section('css-links')
    <link href="{{ asset('bootstrap/custom/dashboard.css') }}" rel="stylesheet">
@endsection

@section('custom-css')
    <style>
        .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        }

        @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
        }
    </style>
@endsection

@section('content')

<!---nav bar--->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top" aria-label="Third navbar example">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Personal</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
    
          <div class="collapse navbar-collapse" id="navbarsExample03">
            <ul class="navbar-nav me-0 mb-2 mb-sm-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Salir</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
<!--- end nav bar--->

<div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
            @include('dashboard.menu')
        </div>
      </nav>
  
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2" id="dashboard-option-title">Dashboard</h1>
        </div>

        <div id="main_content_target"></div>

      </main>
    </div>
  </div>

































@endsection