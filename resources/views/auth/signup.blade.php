<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Signup</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg">
        <div class="card-body">
          <h3 class="text-center mb-4">Signup</h3>

         @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
         @endif

        @if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

          <form method="POST" action="{{ route('signup.post') }}">
            @csrf
            <div class="mb-3">
              <label>Name</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
              @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

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

            <div class="mb-3">
              <label>Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Signup</button>
          </form>

          <p class="text-center mt-3">
            Already have an account? <a href="{{ route('login') }}">Login here</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
