@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column is-10 is-offset-1">
            <div class="panel">
                <div class="panel-heading">Dashboard - {{ $business->name }}</div>

                <div class="panel-block">
                    Welcome!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
