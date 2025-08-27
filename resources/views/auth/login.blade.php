<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg">
        <div class="card-body">
          <h3 class="text-center mb-4">Login</h3>

          @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
          @endif

       @if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
       @endif

          <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
              @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
              @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button  type="submit" class="btn btn-primary w-100">Login </button>



          </form>

          <p class="text-center mt-3">
            Don’t have an account? <a href="{{ route('signup') }}">Signup here</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

</body>



</html>
