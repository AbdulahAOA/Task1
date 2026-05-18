@extends('layouts.app')

@section('content')

<div class="card">

    <h1 class="mb-4">
        Trash
    </h1>

    {{-- Tabs --}}

    <ul class="nav nav-pills mb-4">

        <li class="nav-item">

            <button class="nav-link active"
                    data-bs-toggle="pill"
                    data-bs-target="#blogs">

                Blogs

            </button>

        </li>

        <li class="nav-item">

            <button class="nav-link"
                    data-bs-toggle="pill"
                    data-bs-target="#admins">

                Admins

            </button>

        </li>

        <li class="nav-item">

            <button class="nav-link"
                    data-bs-toggle="pill"
                    data-bs-target="#users">

                Users

            </button>

        </li>

    </ul>

    <div class="tab-content">

        {{-- Blogs --}}

        <div class="tab-pane fade show active"
             id="blogs">

            <table class="table table-bordered text-center bg-white">

                <tr>

                    <th>ID</th>

                  <th>Image</th>

                    <th>Deleted At</th>

                </tr>

                @foreach($blogs as $blog)

                    <tr>

                        <td>{{ $blog->id }}</td>

                        <td>{{ $blog->title_en }}</td>
                         <td>

                        <img src="{{ asset('storage/' . $blog->main_image) }}"
                         width="100">

                       </td>
                        <td>{{ $blog->deleted_at }}</td>

                    </tr>

                @endforeach

            </table>

        </div>

        {{-- Admins --}}

        <div class="tab-pane fade"
             id="admins">

            <table class="table table-bordered text-center bg-white">

                <tr>

                    <th>ID</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Deleted At</th>

                </tr>

                @foreach($admins as $admin)

                    <tr>

                        <td>{{ $admin->id }}</td>

                        <td>

                            {{ $admin->first_name }}

                            {{ $admin->last_name }}

                        </td>

                        <td>{{ $admin->email }}</td>

                        <td>{{ $admin->deleted_at }}</td>

                    </tr>

                @endforeach

            </table>

        </div>

        {{-- Users --}}

        <div class="tab-pane fade"
             id="users">

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

    </div>

</div>

@endsection