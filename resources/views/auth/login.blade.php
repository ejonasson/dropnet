@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column is-10 is-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="content">
                    <form class="" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <label for="email" class="label">E-Mail Address</label>

                        <p class="control">
                            <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help is-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </p>

                        <label for="password" class="label">Password</label>
                        <p class="control">
                            <input id="password" type="password" class="input" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help is-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </p>

                        <p class="control">
                            <label class="radio">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </p>

                        <p class="control">
                            <input type="submit" value="Login" class="button is-primary">
                        </p>


                        <p class="control">
                            <a class="button" href="{{ url('/password/reset') }}">
                                Forgot Your Password?
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
