@extends('layouts.app')

@section('title', $blog->title_en)

@section('content')

<div class="card p-4">

    <h1 class="mb-3">

        {{ $blog->title_en }}

    </h1>

    <h3 class="text-muted mb-4">

        {{ $blog->title_ar }}

    </h3>

    <img src="{{ asset('storage/' . $blog->main_image) }}"
         class="img-fluid rounded mb-4"
         style="max-height:400px;object-fit:cover;">

    <h4 class="mb-2">
        Description EN
    </h4>

    <p class="mb-4">

        {{ $blog->description_en }}

    </p>

    <h4 class="mb-2">
        Description AR
    </h4>

    <p>

        {{ $blog->description_ar }}

    </p>

    @if($blog->images->count() > 0)

        <hr>

        <h3 class="mb-4">
            Gallery
        </h3>

        <div class="row">

            @foreach($blog->images as $image)

                <div class="col-md-3 mb-3">

                    <img src="{{ asset('storage/' . $image->image) }}"
                         class="img-fluid rounded shadow">

                </div>

            @endforeach

        </div>

    @endif

</div>

@endsection