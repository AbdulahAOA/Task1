@extends('layouts.app')

@section('title', 'إدارة الأدمن')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1%, transparent 1%);
        background-size: 50px 50px;
        animation: shimmer 20s linear infinite;
        pointer-events: none;
    }
    
    @keyframes shimmer {
        from {
            transform: translate(0, 0);
        }
        to {
            transform: translate(50px, 50px);
        }
    }
    
    .admin-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #667eea;
        padding: 2px;
    }
    
    .avatar-placeholder {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        font-weight: bold;
    }
    
    .table-custom {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }
    
    .table-custom thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .table-custom thead th {
        padding: 15px;
        border: none;
        font-weight: 600;
    }
    
    .table-custom tbody tr {
        transition: all 0.3s ease;
    }
    
    .table-custom tbody tr:hover {
        background: #f8f9fa;
        transform: scale(1.01);
    }
    
    .badge-active {
        background: #28a745;
        color: white;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
    }
    
    .badge-inactive {
        background: #dc3545;
        color: white;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
    }
    
    .btn-action {
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 20px;
    }
    
    .empty-state i {
        font-size: 4rem;
        color: #667eea;
        margin-bottom: 20px;
    }
    
    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 1.5rem;
        }
        
        .table-custom {
            font-size: 0.85rem;
        }
        
        .btn-action {
            padding: 3px 10px;
            font-size: 0.75rem;
        }
    }
</style>

<div class="page-header">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="text-white mb-2">
                <i class="fas fa-users-cog me-3"></i>
                إدارة الأدمن
            </h1>
            <p class="text-white-50 mb-0">إدارة حسابات المديرين والصلاحيات</p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <a href="{{ route('admins.create') }}" class="btn btn-light rounded-pill px-4">
                <i class="fas fa-plus-circle me-2"></i>
                إضافة أدمن جديد
            </a>
            <a href="{{ route('trash') }}" class="btn btn-outline-light rounded-pill px-4 ms-2">
                <i class="fas fa-trash-alt me-2"></i>
                سلة المحذوفات
            </a>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

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
                <th>تاريخ التسجيل</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>
                    @if($admin->image)
                        <img src="{{ asset('storage/' . $admin->image) }}" 
                             class="admin-avatar" 
                             alt="{{ $admin->first_name }}">
                    @else
                        <div class="avatar-placeholder">
                            {{ strtoupper(substr($admin->first_name, 0, 1)) }}
                        </div>
                    @endif
                </td>
                <td>
                    <strong>{{ $admin->first_name }} {{ $admin->last_name }}</strong>
                 </td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->phone ?? '—' }}</td>
                <td>
                    @if($admin->state == 'active')
                        <span class="badge-active">
                            <i class="fas fa-check-circle me-1"></i> نشط
                        </span>
                    @else
                        <span class="badge-inactive">
                            <i class="fas fa-ban me-1"></i> غير نشط
                        </span>
                    @endif
                 </td>
                <td>{{ $admin->created_at ? $admin->created_at->format('Y-m-d') : '—' }}</td>
                <td>
                    <button type="button" 
                            class="btn btn-danger btn-action" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteModal{{ $admin->id }}">
                        <i class="fas fa-trash-alt me-1"></i> حذف
                    </button>
                 </td>
             </tr>
            
            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal{{ $admin->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">
                                <i class="fas fa-exclamation-triangle me-2"></i>تأكيد الحذف
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-0">هل أنت متأكد من حذف "<strong>{{ $admin->first_name }} {{ $admin->last_name }}</strong>"؟</p>
                            <small class="text-muted">سيتم نقل الأدمن إلى سلة المحذوفات</small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <form action="{{ route('admins.destroy', $admin->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">نعم، احذف</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <tr>
                <td colspan="8">
                    <div class="empty-state">
                        <i class="fas fa-users-slash"></i>
                        <h4 class="mt-3">لا يوجد أدمن</h4>
                        <p class="text-muted">قم بإضافة أول أدمن الآن</p>
                        <a href="{{ route('admins.create') }}" class="btn btn-primary rounded-pill mt-2">
                            <i class="fas fa-plus-circle me-2"></i>إضافة أدمن
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection