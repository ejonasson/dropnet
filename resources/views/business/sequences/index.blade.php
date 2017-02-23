@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column is-10 is-offset-1">
            <div class="panel">
                <div class="panel-heading">Sequences - {{ $business->name }}</div>

                <div class="panel-block">
                    <a href="{{ businessUrl('sequence/create', $business) }}" class="btn btn-primary">Add New Sequence</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
