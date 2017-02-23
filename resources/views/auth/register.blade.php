@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column is-10 is-offset-1">
            <div class="panel">
                <div class="panel-heading">Register</div>
                <div class="content">
                    <div class="columns">
                        <div class="column">
                            <form role="form" method="POST" action="{{ url('/register') }}">
                                {{ csrf_field() }}

                                <label for="business" class="label">Business</label>
                                <p class="control">
                                    <input id="business" type="text" class="input" name="business" value="{{ old('business') }}" required autofocus>
                                    @if ($errors->has('business'))
                                        <span class="help is-danger">
                                            <strong>{{ $errors->first('business') }}</strong>
                                        </span>
                                    @endif
                                </p>

                                <label for="email" class="label">E-Mail Address</label>
                                <p class="control">
                                    <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" required>
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

                                <label for="password-confirm" class="label">Confirm Password</label>
                                <input id="password-confirm" type="password" class="input" name="password_confirmation" required>
                                <br>
                                <div class="control">
                                    <p class="control">
                                        <button type="submit" class="button is-primary">
                                            Register
                                        </button>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
