@extends('layouts.app')

@section('content')

<div class="card">

    <h1>
        Deleted Users
    </h1>

    <br>

    <table class="table table-bordered text-center bg-white">

        <tr>

            <th>ID</th>

            <th>Name</th>

            <th>Email</th>

            <th>Deleted At</th>

        </tr>

        @foreach($users as $user)

            <tr>

                <td>{{ $user->id }}</td>

                <td>

                    {{ $user->first_name }}

                    {{ $user->last_name }}

                </td>

                <td>{{ $user->email }}</td>

                <td>{{ $user->deleted_at }}</td>

            </tr>

        @endforeach

    </table>

</div>

@endsection