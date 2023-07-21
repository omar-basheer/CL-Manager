<!-- resources/views/clients/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="app">
    <h2>CL Software</h2>
    <div >
        @foreach ($clients as $client)
        <div class="card">
            <div class="card-header">
                <img class="avatar" src="{{ $client->avatar }}" alt="Avatar" width="100" height="100">
            </div>
            <p> {{ $client->first_name }} {{ $client->last_name }}</p>
            <p> {{ $client->email }}</p>
            <p>{{ $client->phone }}</p>
            <div class="card-buttons">
                <button>Edit</button>
                <button>Delete</button>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection