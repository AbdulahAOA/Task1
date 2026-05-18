@extends('layouts.app')

@section('content')

<div class="card">

    <h1>
        Admin Details
    </h1>

    <br>

    <img src="{{ asset('storage/' . $admin->image) }}"
         width="200">

    <br><br>

    <h3>

        {{ $admin->first_name }}

        {{ $admin->last_name }}

    </h3>

    <br>

    <p>

        <strong>Email:</strong>

        {{ $admin->email }}

    </p>

    <br>

    <p>

        <strong>Phone:</strong>

        {{ $admin->phone }}

    </p>

    <br>

    <p>

        <strong>Status:</strong>

        {{ $admin->state == 1 ? 'Active' : 'Inactive' }}

    </p>

</div>

@endsection