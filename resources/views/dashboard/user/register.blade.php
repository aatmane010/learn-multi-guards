<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4" style="margin-top: 45px;">
                  <h4>User Register</h4><hr>
                  
                  <form action="{{route('user.create')}}" method="POST" autocomplete="off">
                    @if(Session::get('success'))
                      <div class="alert alert-success">
                          {{Session::get('success')}}
                      </div>
                    @endif
                    @if(Session::get('fail'))
                      <div class="alert alert-danger">
                          {{Session::get('fial')}}
                      </div>
                    @endif

                    @csrf
                      <div class="form-group mb-3">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" name="name" placeholder="Enter full name" value="{{old('name')}}">
                          <span class="text-danger">@error ('name'){{$message}} @enderror</span>
                      </div>
                      <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{old('email')}}">
                        <span class="text-danger">@error ('email'){{$message}} @enderror</span>
                    </div>
                      <div class="form-group mb-3">
                          <label for="password">Password</label>
                          <input type="password" class="form-control" name="password" placeholder="Enter password">
                          <span class="text-danger">@error ('password'){{$message}} @enderror</span>
                      </div>
                      <div class="form-group mb-3">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" class="form-control" name="cpassword" placeholder="Enter confirm password">
                        <span class="text-danger">@error ('cpassword'){{$message}} @enderror</span>
                    </div>
                      <div class="form-group mb-3">
                          <button type="submit" class="btn btn-primary">Register</button>
                      </div>
                      <br>
                      <a href="{{ route('user.login') }}">I already have an account</a>
                  </form>
            </div>
        </div>
    </div>
    
</body>
</html>