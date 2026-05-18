@extends('layouts.app')

@section('title', 'إضافة أدمن جديد')

@section('content')
<style>
    .form-container {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    
    .form-control, .form-select {
        border-radius: 10px;
        border: 2px solid #e0e0e0;
        padding: 12px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102,126,234,0.25);
    }
    
    .image-preview {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        margin-top: 10px;
        border: 3px solid #667eea;
        padding: 3px;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 40px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 18px;
        transition: all 0.3s ease;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102,126,234,0.4);
    }
    
    .avatar-placeholder {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        font-weight: bold;
        margin-top: 10px;
    }
</style>

<div class="form-container">
    <h2 class="text-center mb-4">
        <i class="fas fa-user-plus text-primary me-2"></i>
        إضافة أدمن جديد
    </h2>
    
    <form action="{{ route('admins.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first_name" class="form-label">
                    <i class="fas fa-user me-1"></i> الاسم الأول
                </label>
                <input type="text" 
                       class="form-control @error('first_name') is-invalid @enderror" 
                       id="first_name" 
                       name="first_name" 
                       value="{{ old('first_name') }}"
                       placeholder="أدخل الاسم الأول"
                       required>
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="last_name" class="form-label">
                    <i class="fas fa-user me-1"></i> الاسم الأخير
                </label>
                <input type="text" 
                       class="form-control @error('last_name') is-invalid @enderror" 
                       id="last_name" 
                       name="last_name" 
                       value="{{ old('last_name') }}"
                       placeholder="أدخل الاسم الأخير"
                       required>
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope me-1"></i> البريد الإلكتروني
                </label>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       placeholder="admin@example.com"
                       required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">
                    <i class="fas fa-phone me-1"></i> رقم الهاتف
                </label>
                <input type="text" 
                       class="form-control @error('phone') is-invalid @enderror" 
                       id="phone" 
                       name="phone" 
                       value="{{ old('phone') }}"
                       placeholder="05xxxxxxxx">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">
                    <i class="fas fa-lock me-1"></i> كلمة المرور
                </label>
                <input type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       id="password" 
                       name="password" 
                       placeholder="********"
                       required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="password_confirmation" class="form-label">
                    <i class="fas fa-check-circle me-1"></i> تأكيد كلمة المرور
                </label>
                <input type="password" 
                       class="form-control" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       placeholder="********"
                       required>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="state" class="form-label">
                    <i class="fas fa-toggle-on me-1"></i> الحالة
                </label>
                <select class="form-select @error('state') is-invalid @enderror" id="state" name="state">
                    <option value="active" selected>نشط</option>
                    <option value="inactive">غير نشط</option>
                </select>
                @error('state')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="image" class="form-label">
                    <i class="fas fa-image me-1"></i> الصورة الشخصية (اختياري)
                </label>
                <input type="file" 
                       class="form-control @error('image') is-invalid @enderror" 
                       id="image" 
                       name="image" 
                       accept="image/*"
                       onchange="previewImage(this)">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div id="imagePreview"></div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-submit">
                <i class="fas fa-save me-2"></i> إنشاء الأدمن
            </button>
            <a href="{{ route('admins.index') }}" class="btn btn-secondary ms-2">
                <i class="fas fa-times me-2"></i> إلغاء
            </a>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    const previewContainer = document.getElementById('imagePreview');
    previewContainer.innerHTML = '';
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'image-preview';
            previewContainer.appendChild(img);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection