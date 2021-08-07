@extends('layout.main')

@section('title', 'Projeto Treinamento Ftt')

@section('content')
    <div class="container mt-5">
        <h1>TELA DE LOGIN</h1>

        <!-- Success message -->
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif

        <form action="" method="post" action="{{ url('/login') }}">

            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}" name="email"
                       id="email">

                @if ($errors->has('email'))
                    <div class="error">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control {{ $errors->has('password') ? 'error' : '' }}" name="password"
                       id="password">

                @if ($errors->has('password'))
                    <div class="error">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>

            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>
    </div>
@endsection
