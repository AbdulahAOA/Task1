@extends('layouts.app')

@section('title', 'Create User')

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

    .btn-save{
        background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
        color:white;
        border:none;
        padding:12px 30px;
        border-radius:50px;
        font-weight:bold;
    }

    .btn-save:hover{
        opacity:.9;
    }

</style>

<div class="create-card">

    <h1 class="page-title">

        <i class="fas fa-user-plus text-primary me-2"></i>

        Create User

    </h1>

    <form action="{{ route('users.store') }}"
          method="POST">

        @csrf

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    First Name

                </label>

                <input type="text"
                       name="first_name"
                       class="form-control"
                       required>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Last Name

                </label>

                <input type="text"
                       name="last_name"
                       class="form-control"
                       required>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Email

                </label>

                <input type="email"
                       name="email"
                       class="form-control"
                       required>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Phone

                </label>

                <input type="text"
                       name="phone"
                       class="form-control">

            </div>

            <div class="col-md-12 mb-4">

                <label class="form-label">

                    Password

                </label>

                <input type="password"
                       name="password"
                       class="form-control"
                       required>
<small class="text-muted">

    كلمة المرور يجب أن تكون 8 خانات أو أكثر

</small>

@error('password')

    <div class="text-danger mt-1">

        {{ $message }}

    </div>

@enderror
            </div>

        </div>

        <button type="submit"
                class="btn btn-save">

            <i class="fas fa-save me-2"></i>

            Create User

        </button>

    </form>

</div>

@endsection