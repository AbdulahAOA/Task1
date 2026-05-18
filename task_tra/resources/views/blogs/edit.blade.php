@extends('layouts.app')

@section('content')

<div class="card">

    <h1>
        Edit Blog
    </h1>

    <br>

    <form action="{{ route('blogs.update', $blog->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <label>
            Title AR
        </label>

        <input type="text"
               name="title_ar"
               value="{{ $blog->title_ar }}">

        <label>
            Title EN
        </label>

        <input type="text"
               name="title_en"
               value="{{ $blog->title_en }}">

        <label>
            Description AR
        </label>

        <textarea name="description_ar">{{ $blog->description_ar }}</textarea>

        <label>
            Description EN
        </label>

        <textarea name="description_en">{{ $blog->description_en }}</textarea>

        <label>
            Current Main Image
        </label>

        <br><br>

        <img src="{{ asset('storage/' . $blog->main_image) }}"
             width="200">

        <br><br>

        <label>
            New Main Image
        </label>

        <input type="file" name="main_image">

        <button type="submit">
            Update Blog
        </button>

    </form>

</div>

@endsection