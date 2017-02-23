@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Settings - {{ $business->name }}</div>

                <div class="panel-body">
                    Welcome!
                    {!! Form::open() !!}
                        {!! Form::label('publishable_key', 'Stripe Public Key') !!}
                        {!! Form::text('publishable_key') !!}
                        <br>

                        {!! Form::label('secret_key', 'Stripe Secret Key') !!}
                        {!! Form::text('secret_key') !!}

                        <br>
                        {!! Form::submit('Save Changes') !!}

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
