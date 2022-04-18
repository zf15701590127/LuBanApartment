<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>鲁班寓</title>

  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <style>
    html,body {
      height: 100%;
    }

    body {
      display: flex;
      align-items: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }

    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: auto;
    }

    .form-signin .checkbox {
      font-weight: 400;
    }

    .form-signin .form-floating:focus-within {
      z-index: 2;
    }

    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
  </style>
</head>
<body class="text-center">
  <main class="form-signin">
    <form action="{{ route('login') }}" method="POST">
      {{ csrf_field() }}
      <img src="https://getbootstrap.com/docs/5.1/assets/brand/bootstrap-logo.svg" width="72" height="57">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(session()->has($msg))
          <div class="flash-message">
            <p class="alert alert-{{ $msg }}">
              {{ session()->get($msg) }}
            </p>
          </div>
        @endif
      @endforeach
      <div class="form-floating">
        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="Email address" required value="{{ old('email') }}">
        <label for="floatingInput">Email address</label>
        @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-floating">
        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" required>
        <label for="floatingPassword">Password</label>
        @error('password')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" name="remember"> 记住我
        </label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">登陆</button>
      <p class="mt-5 mb-3 text-mute">© 2022–2022</p>
    </form>
  </main>

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
