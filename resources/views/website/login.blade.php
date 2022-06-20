@extends('layouts.app')

@section('css-links')
  <link href="{{ asset('bootstrap/custom/signin.css') }}" rel="stylesheet">
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
  <body class="text-center">
    <main class="form-signin">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <img class="mb-4" src="{{ asset('img/working-work-svgrepo-com.svg') }}" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    
        <div class="form-floating">
          <input name="email" type="email" class="form-control text-secondary" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput" class="text-secondary">Email address</label>
        </div>
        <div class="form-floating">
          <input name="password" type="password" class="form-control text-secondary" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword" class="text-secondary">Password</label>
        </div>
    
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
      </form>
    </main> 
  </body>
@endsection
