@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column is-10 is-offset-1">
            <h2>Create New Sequence</h2>
            <sequence-editor source-plans='{!!$plans->toJson()!!}'></sequence-editor>
        </div>
    </div>
</div>
@endsection
