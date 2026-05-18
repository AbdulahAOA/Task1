@extends('layouts.app')

@section('content')

<div class="card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>
            Deleted Blogs
        </h1>

        <a href="{{ route('blogs.index') }}">

            <button>
                Back To Blogs
            </button>

        </a>

    </div>

    <table class="table table-bordered text-center bg-white">

        <tr>

            <th>ID</th>

            <th>Title</th>

            <th>Image</th>

            <th>Deleted At</th>

        </tr>

        @foreach($blogs as $blog)

            <tr>

                <td>
                    {{ $blog->id }}
                </td>

                <td>
                    {{ $blog->title_en }}
                </td>

                <td>

                    <img src="{{ asset('storage/' . $blog->main_image) }}"
                         width="100">

                </td>

                <td>
                    {{ $blog->deleted_at }}
                </td>

            </tr>

        @endforeach

    </table>

</div>

@endsection