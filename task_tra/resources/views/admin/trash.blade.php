@extends('layouts.app')

@section('title', 'سلة المحذوفات')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
    }
    
    .table-custom thead {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }
    
    .admin-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #dc3545;
        padding: 2px;
    }
    
    .avatar-placeholder {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        font-weight: bold;
    }
    
    .btn-restore {
        background: #28a745;
        color: white;
        padding: 5px 15px;
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    
    .btn-restore:hover {
        background: #218838;
        transform: translateY(-2px);
    }
</style>

<div class="page-header">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="text-white mb-2">
                <i class="fas fa-trash-alt me-3"></i>
                سلة المحذوفات
            </h1>
            <p class="text-white-50 mb-0">الأدمن الذين تم حذفهم مؤقتاً</p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <a href="{{ route('admin.index') }}" class="btn btn-light rounded-pill px-4">
                <i class="fas fa-arrow-left me-2"></i>
                العودة إلى الأدمن
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

<div class="table-responsive">
    <table class="table table-custom table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>الصورة</th>
                <th>الاسم الكامل</th>
                <th>البريد الإلكتروني</th>
                <th>رقم الهاتف</th>
                <th>تاريخ الحذف</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($trashedAdmins as $admin)
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
                <td>{{ $admin->first_name }} {{ $admin->last_name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->phone ?? '—' }}</td>
                <td>{{ $admin->deleted_at ? $admin->deleted_at->format('Y-m-d H:i') : '—' }}</td>
                <td>
                    <form action="{{ route('admin.restore', $admin->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-restore">
                            <i class="fas fa-trash-restore me-1"></i> استعادة
                        </button>
                    </form>
                    
                    <button type="button" 
                            class="btn btn-danger btn-action" 
                            data-bs-toggle="modal" 
                            data-bs-target="#forceDeleteModal{{ $admin->id }}">
                        <i class="fas fa-ban me-1"></i> حذف نهائي
                    </button>
                 </td>
             </tr>
            
            <!-- Force Delete Modal -->
            <div class="modal fade" id="forceDeleteModal{{ $admin->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">
                                <i class="fas fa-exclamation-triangle me-2"></i>حذف نهائي
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-0">تحذير! هذا الإجراء لا يمكن التراجع عنه. هل أنت متأكد من حذف "<strong>{{ $admin->first_name }} {{ $admin->last_name }}</strong>" بشكل نهائي؟</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <form action="{{ route('admin.forceDelete', $admin->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">نعم، احذف نهائياً</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <tr>
                <td colspan="7">
                    <div class="text-center py-5">
                        <i class="fas fa-trash-alt fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">سلة المحذوفات فارغة</h4>
                        <p class="text-muted">لا يوجد أدمن محذوفين</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection