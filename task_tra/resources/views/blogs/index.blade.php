@extends('layouts.app')

@section('title', 'All Blogs - Blog Platform')

@section('content')
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --card-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .blog-header {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.95) 0%, rgba(118, 75, 162, 0.95) 100%);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .blog-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1%, transparent 1%);
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

        .blog-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            margin-bottom: 30px;
            border: none;
            position: relative;
            height: 100%;
        }

        .blog-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 45px -15px rgba(0, 0, 0, 0.2);
        }

        .card-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 10;
        }

        [dir="rtl"] .card-badge {
            left: auto;
            right: 20px;
        }

        .badge-custom {
            background: var(--primary-gradient);
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 500;
            letter-spacing: 0.5px;
            color: white;
        }

        .main-image-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            height: 250px;
        }

        .main-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .blog-card:hover .main-image-wrapper img {
            transform: scale(1.05);
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .blog-card:hover .image-overlay {
            opacity: 1;
        }

        .btn-custom {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            transition: var(--transition);
            font-weight: 500;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-outline-custom {
            border: 2px solid #667eea;
            background: transparent;
            color: #667eea;
            padding: 8px 20px;
            border-radius: 50px;
            transition: var(--transition);
            font-weight: 500;
        }

        .btn-outline-custom:hover {
            background: var(--primary-gradient);
            border-color: transparent;
            color: white;
            transform: translateY(-2px);
        }

        .gallery-thumb {
            position: relative;
            cursor: pointer;
            border-radius: 10px;
            overflow: hidden;
            transition: var(--transition);
        }

        .gallery-thumb img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            transition: var(--transition);
        }

        .gallery-thumb:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .search-box {
            background: white;
            border-radius: 50px;
            padding: 5px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .search-input {
            border: none;
            padding: 12px 20px;
            border-radius: 50px;
            outline: none;
        }

        .search-input:focus {
            box-shadow: none;
        }

        .search-btn {
            background: var(--primary-gradient);
            border: none;
            border-radius: 50px;
            padding: 8px 30px;
            color: white;
            transition: var(--transition);
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        @media (max-width: 768px) {
            .main-image-wrapper {
                height: 200px;
                margin-bottom: 20px;
            }

            .blog-header h1 {
                font-size: 1.8rem;
            }

            .blog-header {
                padding: 30px 20px;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .blog-card {
            animation: fadeInUp 0.6s ease-out both;
        }
    </style>

    <!-- Hero Section -->
    <div class="blog-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="text-white display-4 fw-bold mb-3">
                    <i class="fas fa-blog me-3"></i>المدونات
                </h1>
                <p class="text-white-50 lead mb-0">
                    اكتشف قصصاً مذهلة ورؤى من مجتمعنا المبدع
                </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
          <a href="{{ route('blogs.create') }}"
   style="
        background:white;
        padding:15px 25px;
        border-radius:50px;
        text-decoration:none;
        color:black;
        display:inline-block;
   ">

    <i class="fas fa-plus-circle"></i>

    إنشاء مدونة جديدة

</a>
<a href="{{ route('trash') }}"
   style="
        background:#dc3545;
        padding:15px 25px;
        border-radius:50px;
        text-decoration:none;
        color:white;
        display:inline-block;
        margin-right:10px;
   ">

    <i class="fas fa-trash"></i>

    المحذوفات

</a>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="row mb-5">
        <div class="col-md-6 mx-auto">
            <div class="search-box d-flex">
                <input type="text" id="searchInput" class="search-input flex-grow-1" placeholder="ابحث عن المدونات...">
                <button class="search-btn" id="searchBtn">
                    <i class="fas fa-search me-2"></i>بحث
                </button>
            </div>
        </div>
    </div>

    <!-- Blogs Grid -->
    <div class="row" id="blogsContainer">
        @forelse ($blogs as $index => $blog)
            <div class="col-lg-6 col-md-12 mb-4 blog-item"
                data-title="{{ strtolower($blog->title_en . ' ' . $blog->title_ar) }}">
                <div class="blog-card" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="card-badge">
                        <span class="badge-custom">
                            <i class="far fa-calendar-alt me-1"></i>
                            {{ $blog->created_at->format('d M, Y') }}
                        </span>
                    </div>

                    <div class="row g-0">
                        <div class="col-md-5">
                            <div class="main-image-wrapper">
                                <img src="{{ asset('storage/' . $blog->main_image) }}" alt="{{ $blog->title_en }}">
                                <div class="image-overlay">
                                    <a href="{{ asset('storage/' . $blog->main_image) }}" target="_blank"
                                        class="btn btn-light btn-sm rounded-circle mx-1">
                                        <i class="fas fa-search-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="card-body p-4">
                                <h3 class="card-title fw-bold mb-2">{{ $blog->title_en }}</h3>
                                <h5 class="text-muted mb-3">{{ $blog->title_ar }}</h5>

                                <p class="card-text text-muted mb-3">
                                    {{ Str::limit($blog->description_en, 120) }}
                                </p>

                                @if ($blog->images->count() > 0)
                                    <div class="mb-3">
                                        <small class="text-primary">
                                            <i class="fas fa-images me-1"></i>
                                            {{ $blog->images->count() }} صورة إضافية
                                        </small>
                                    </div>
                                @endif

                                <div class="d-flex gap-2 mt-3">
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-outline-custom btn-sm">
                                        <i class="fas fa-edit me-1"></i> تعديل
                                    </a>

                                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $blog->id }}">
                                        <i class="fas fa-trash-alt me-1"></i> حذف
                                    </button>

                                    <button type="button" class="btn btn-custom btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#galleryModal{{ $blog->id }}">
                                        <i class="fas fa-images me-1"></i> معرض
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery Modal -->
            <div class="modal fade" id="galleryModal{{ $blog->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">
                                <i class="fas fa-images me-2"></i>{{ $blog->title_en }} - معرض الصور
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-12 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <h6 class="text-primary mb-2">الصورة الرئيسية</h6>
                                            <img src="{{ asset('storage/' . $blog->main_image) }}"
                                                class="img-fluid rounded" style="max-height: 300px;">
                                        </div>
                                    </div>
                                </div>

                                @if ($blog->images->count() > 0)
                                    <div class="col-md-12">
                                        <h6 class="text-primary mb-3">الصور الإضافية ({{ $blog->images->count() }})</h6>
                                        <div class="row g-2">
                                            @foreach ($blog->images as $image)
                                                <div class="col-6 col-md-4 col-lg-3">
                                                    <div class="gallery-thumb" data-bs-toggle="modal"
                                                        data-bs-target="#imageModal"
                                                        data-image="{{ asset('storage/' . $image->image) }}">
                                                        <img src="{{ asset('storage/' . $image->image) }}"
                                                            class="img-fluid rounded">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="fas fa-camera-slash fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">لا توجد صور إضافية</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal{{ $blog->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">
                                <i class="fas fa-exclamation-triangle me-2"></i>تأكيد الحذف
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-0">هل أنت متأكد من حذف "<strong>{{ $blog->title_en }}</strong>"؟ هذا الإجراء لا
                                يمكن التراجع عنه.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">نعم، احذف</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-blog fa-5x text-muted mb-4"></i>
                    <h3 class="text-muted">لا توجد مدونات بعد</h3>
                    <p class="text-muted">ابدأ بإنشاء أول مدونة لك!</p>
                    <a href="{{ route('blogs.create') }}" class="btn btn-custom mt-3">
                        <i class="fas fa-plus-circle me-2"></i>إنشاء أول مدونة
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Full Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body text-center">
                    <img src="" id="fullImage" class="img-fluid rounded shadow-lg" style="max-height: 80vh;">
                    <button type="button" class="btn btn-light mt-3" data-bs-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Search functionality
        document.getElementById('searchBtn').addEventListener('click', function() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const blogItems = document.querySelectorAll('.blog-item');
            let visibleCount = 0;

            blogItems.forEach(item => {
                const title = item.getAttribute('data-title');
                if (title.includes(searchTerm)) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            // Show message if no results
            const existingMsg = document.querySelector('.no-results-msg');
            if (existingMsg) existingMsg.remove();

            if (visibleCount === 0 && blogItems.length > 0) {
                const msg = document.createElement('div');
                msg.className = 'col-12 text-center no-results-msg';
                msg.innerHTML = `
            <div class="alert alert-info mt-4">
                <i class="fas fa-search me-2"></i>
                لا توجد نتائج مطابقة لـ "${searchTerm}"
            </div>
        `;
                document.getElementById('blogsContainer').appendChild(msg);
            }
        });

        // Search on Enter key
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('searchBtn').click();
            }
        });

        // Full image modal
        const imageModal = document.getElementById('imageModal');
        if (imageModal) {
            imageModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const imageUrl = button.getAttribute('data-image');
                const fullImage = document.getElementById('fullImage');
                if (fullImage && imageUrl) {
                    fullImage.src = imageUrl;
                }
            });
        }

        // Reset search button (optional)
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('focus', function() {
                const noResults = document.querySelector('.no-results-msg');
                if (noResults) noResults.remove();
            });
        }
    </script>
@endsection
