@extends('layouts.app')

@section('title', 'إدارة المستخدمين')

@section('content')

<style>

    .page-header{
        background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
        border-radius:20px;
        padding:30px;
        margin-bottom:30px;
        position:relative;
        overflow:hidden;
    }

    .page-header::before{
        content:'';
        position:absolute;
        top:-50%;
        right:-50%;
        width:200%;
        height:200%;
        background:radial-gradient(circle,rgba(255,255,255,0.1) 1%,transparent 1%);
        background-size:50px 50px;
        animation:shimmer 20s linear infinite;
        pointer-events:none;
    }

    @keyframes shimmer{
        from{
            transform:translate(0,0);
        }
        to{
            transform:translate(50px,50px);
        }
    }

    .user-avatar{
        width:50px;
        height:50px;
        border-radius:50%;
        object-fit:cover;
        border:3px solid #667eea;
        padding:2px;
    }

    .avatar-placeholder{
        width:50px;
        height:50px;
        border-radius:50%;
        background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
        display:flex;
        align-items:center;
        justify-content:center;
        color:white;
        font-size:1.2rem;
        font-weight:bold;
    }

    .table-custom{
        background:white;
        border-radius:15px;
        overflow:hidden;
        box-shadow:0 5px 20px rgba(0,0,0,0.08);
    }

    .table-custom thead{
        background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
        color:white;
    }

    .table-custom thead th{
        padding:15px;
        border:none;
    }

    .badge-active{
        background:#28a745;
        color:white;
        padding:5px 12px;
        border-radius:50px;
        font-size:.75rem;
    }

    .badge-inactive{
        background:#dc3545;
        color:white;
        padding:5px 12px;
        border-radius:50px;
        font-size:.75rem;
    }

    .btn-action{
        padding:5px 15px;
        border-radius:50px;
        font-size:.85rem;
    }

    .empty-state{
        text-align:center;
        padding:60px 20px;
        background:white;
        border-radius:20px;
    }

</style>

<div class="page-header">

    <div class="row align-items-center">

        <div class="col-md-6">

            <h1 class="text-white mb-2">

                <i class="fas fa-users me-3"></i>

                إدارة المستخدمين

            </h1>

            <p class="text-white-50 mb-0">

                إدارة حسابات المستخدمين

            </p>

        </div>

        <div class="col-md-6 text-md-end mt-3 mt-md-0">

            <a href="{{ route('users.create') }}"
               class="btn btn-light rounded-pill px-4">

                <i class="fas fa-plus-circle me-2"></i>

                إضافة مستخدم جديد

            </a>

            <a href="{{ route('trash') }}"
               class="btn btn-outline-light rounded-pill px-4 ms-2">

                <i class="fas fa-trash-alt me-2"></i>

                سلة المحذوفات

            </a>

        </div>

    </div>

</div>

<div class="table-responsive">

    <table class="table table-custom table-hover">

        <thead>

            <tr>

                <th>#</th>

                <th>الصورة</th>

                <th>الاسم الكامل</th>

                <th>البريد الإلكتروني</th>

                <th>رقم الهاتف</th>

                <th>الحالة</th>

                <th>الإجراءات</th>

            </tr>

        </thead>

        <tbody>

            @forelse($users as $user)

                <tr>

                    <td>{{ $user->id }}</td>

                    <td>

                        @if($user->image)

                            <img src="{{ asset('storage/' . $user->image) }}"
                                 class="user-avatar">

                        @else

                            <div class="avatar-placeholder">

                                {{ strtoupper(substr($user->first_name,0,1)) }}

                            </div>

                        @endif

                    </td>

                    <td>

                        <strong>

                            {{ $user->first_name }}

                            {{ $user->last_name }}

                        </strong>

                    </td>

                    <td>{{ $user->email }}</td>

                    <td>{{ $user->phone ?? '—' }}</td>

                    <td>

                        @if($user->state == 'active')

                            <span class="badge-active">

                                نشط

                            </span>

                        @else

                            <span class="badge-inactive">

                                غير نشط

                            </span>

                        @endif

                    </td>

                    <td>

                        <form action="{{ route('users.destroy', $user->id) }}"
                              method="POST">

                            @csrf

                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-action">

                                <i class="fas fa-trash-alt me-1"></i>

                                حذف

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7">

                        <div class="empty-state">

                            <h4>

                                لا يوجد مستخدمين

                            </h4>

                            <a href="{{ route('users.create') }}"
                               class="btn btn-primary rounded-pill mt-3">

                                إضافة مستخدم

                            </a>

                        </div>

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection