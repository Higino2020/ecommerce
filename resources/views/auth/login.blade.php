<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}">
</head>
<body>
   <div class="base">
        <div class="container-xxl base2">
            <div class="form">
                <div class="titulo">
                    <h4>Login</h4>
                    <h5>Mestres da Moda </h5>
                </div>
                <form action="{{route('login')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">E-mail</label>
                        <div class="input-form">
                            <input type="text" name="email" id="email" placeholder="" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Senha</label>
                        <div class="input-form">
                            <input type="password" name="password" id="password" placeholder="" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-form">
                            <button class="btn btn-success" type="submit">Entrar</button>                            
                        </div>
                    </div>

                </form>
            </div>
        </div>
   </div>
</body>
</html>