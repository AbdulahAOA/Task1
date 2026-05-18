@extends('layouts.app')

@section('content')

<div class="card">

    <h1>
        User Details
    </h1>

    <br>

    <h3>

        {{ $user->first_name }}

        {{ $user->last_name }}

    </h3>

    <br>

    <p>

        <strong>Email:</strong>

        {{ $user->email }}

    </p>

    <br>

    <p>

        <strong>Phone:</strong>

        {{ $user->phone }}

    </p>

    <br>

    <p>

        <strong>Status:</strong>

        {{ $user->state == 1 ? 'Active' : 'Inactive' }}

    </p>

</div>

@endsection