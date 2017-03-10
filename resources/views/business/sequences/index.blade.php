@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column is-10 is-offset-1">
            @foreach($sequences as $sequence)
                @if(($loop->index % 3) == 0)
                    <div class="columns">
                @endif
                <div class="column is-one-third">
                    <div class="card">
                        <header class="card-header">
                          <p class="card-header-title">
                            {{$sequence->name}}
                          </p>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <p><strong>Pending: </strong>XXX</p>
                                <p><strong>Receovered: </strong>XXX</p>
                                <p><strong>Failed:</strong> XXX</p>
                            </div>
                        </div>
                        <footer class="card-footer">
                          <a class="card-footer-item" href="{{businessUrl('sequence/' . $sequence->id . '/edit')}}">Edit</a>
                          <a class="card-footer-item">Delete</a>
                        </footer>
                    </div>
                </div>
                @if(($loop->iteration % 3) === 0)
                    </div>
                @endif
            @endforeach
            <a href="{{ businessUrl('sequence/create', $business) }}" class="btn btn-primary">Add New Sequence</a>
        </div>
    </div>
</div>
@endsection
