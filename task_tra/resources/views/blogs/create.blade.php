@extends('layouts.app')

@section('title', 'Create Blog')

@section('content')

<style>

    .create-card{
        background:white;
        border-radius:20px;
        padding:40px;
        box-shadow:0 10px 30px rgba(0,0,0,0.1);
    }

    .page-title{
        text-align:center;
        margin-bottom:35px;
        font-weight:bold;
        color:#333;
    }

    .form-label{
        font-weight:600;
        margin-bottom:8px;
        color:#444;
    }

    .form-control{
        border-radius:12px;
        padding:12px;
    }

    textarea.form-control{
        min-height:120px;
    }

    .btn-save{
        background:linear-gradient(
            135deg,
            #667eea 0%,
            #764ba2 100%
        );
        color:white;
        border:none;
        padding:12px 30px;
        border-radius:50px;
        font-weight:bold;
    }

    .btn-save:hover{
        opacity:.9;
        color:white;
    }

</style>

<div class="create-card">

    <h1 class="page-title">

        <i class="fas fa-blog text-primary me-2"></i>

        Create Blog

    </h1>

    <form action="{{ route('blogs.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Title AR

                </label>

                <input type="text"
                       name="title_ar"
                       class="form-control"
                       placeholder="ادخل العنوان بالعربي"
                       required>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Title EN

                </label>

                <input type="text"
                       name="title_en"
                       class="form-control"
                       placeholder="Enter title in english"
                       required>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Description AR

                </label>

                <textarea name="description_ar"
                          class="form-control"
                          placeholder="ادخل الوصف بالعربي"
                          required></textarea>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Description EN

                </label>

                <textarea name="description_en"
                          class="form-control"
                          placeholder="Enter description in english"
                          required></textarea>

            </div>

            <div class="col-md-6 mb-4">

                <label class="form-label">

                    Main Image

                </label>

                <input type="file"
                       name="main_image"
                       class="form-control"
                       required>

            </div>

            <div class="col-md-6 mb-4">

                <label class="form-label">

                    Multiple Images

                </label>

                <input type="file"
                       name="images[]"
                       class="form-control"
                       multiple>

            </div>

        </div>

        <button type="submit"
                class="btn btn-save">

            <i class="fas fa-save me-2"></i>

            Create Blog

        </button>

    </form>

</div>

@endsection