@extends('layouts.app')

@section('title', 'مرحباً بك في المدونة - Blog Platform')

@section('content')
<style>
    .hero-section {
        position: relative;
        min-height: 85vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        overflow: hidden;
    }
    
    /* Animated background shapes */
    .hero-section::before {
        content: '';
        position: absolute;
        width: 300%;
        height: 300%;
        background: radial-gradient(circle, rgba(255,255,255,0.05) 1%, transparent 1%);
        background-size: 50px 50px;
        animation: shimmer 30s linear infinite;
        top: -100%;
        left: -100%;
    }
    
    @keyframes shimmer {
        from {
            transform: translate(0, 0);
        }
        to {
            transform: translate(100px, 100px);
        }
    }
    
    /* Floating shapes */
    .floating-shape {
        position: absolute;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }
    
    .shape-1 {
        width: 300px;
        height: 300px;
        top: -100px;
        right: -100px;
        animation-delay: 0s;
    }
    
    .shape-2 {
        width: 200px;
        height: 200px;
        bottom: 50px;
        left: -50px;
        animation-delay: 2s;
    }
    
    .shape-3 {
        width: 150px;
        height: 150px;
        bottom: 100px;
        right: 100px;
        animation-delay: 4s;
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(10deg);
        }
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }
    
    .hero-title {
        font-size: 4.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #fff 0%, #f0f0f0 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 2px 2px 20px rgba(0,0,0,0.1);
        animation: fadeInUp 0.8s ease-out;
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
        color: rgba(255,255,255,0.9);
        margin-bottom: 2rem;
        animation: fadeInUp 1s ease-out;
    }
    
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
    
    .btn-custom-primary {
        background: white;
        color: #667eea;
        padding: 12px 35px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        margin: 0 10px;
        animation: fadeInUp 1.2s ease-out;
    }
    
    .btn-custom-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        color: #764ba2;
    }
    
    .btn-custom-outline {
        background: transparent;
        border: 2px solid white;
        color: white;
        padding: 12px 35px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        margin: 0 10px;
        animation: fadeInUp 1.4s ease-out;
    }
    
    .btn-custom-outline:hover {
        background: white;
        color: #667eea;
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    
    /* Stats Section */
    .stats-section {
        background: rgba(255,255,255,0.95);
        border-radius: 30px;
        margin-top: -70px;
        position: relative;
        z-index: 10;
        padding: 40px 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        backdrop-filter: blur(10px);
    }
    
    .stat-item {
        text-align: center;
        padding: 20px;
        transition: all 0.3s ease;
    }
    
    .stat-item:hover {
        transform: translateY(-5px);
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stat-label {
        color: #666;
        font-size: 1rem;
        margin-top: 10px;
    }
    
    /* Features Section */
    .features-section {
        padding: 80px 0;
        background: #f8f9fa;
    }
    
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        height: 100%;
    }
    
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(102,126,234,0.2);
    }
    
    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        transition: all 0.3s ease;
    }
    
    .feature-card:hover .feature-icon {
        transform: scale(1.1) rotate(360deg);
    }
    
    .feature-icon i {
        font-size: 2rem;
        color: white;
    }
    
    .feature-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: #333;
    }
    
    .feature-description {
        color: #666;
        line-height: 1.6;
    }
    
    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 80px 0;
        text-align: center;
    }
    
    .cta-title {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        margin-bottom: 20px;
    }
    
    .cta-text {
        color: rgba(255,255,255,0.9);
        font-size: 1.1rem;
        margin-bottom: 30px;
    }
    
    .btn-cta {
        background: white;
        color: #667eea;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }
    
    .btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        color: #764ba2;
    }
    
    /* Latest Blogs Section */
    .latest-blogs-section {
        padding: 80px 0;
        background: white;
    }
    
    .blog-card-mini {
        background: #f8f9fa;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        margin-bottom: 30px;
    }
    
    .blog-card-mini:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .blog-card-mini img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    
    .blog-card-mini .content {
        padding: 20px;
    }
    
    .blog-card-mini .title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #333;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-subtitle {
            font-size: 1rem;
        }
        
        .btn-custom-primary,
        .btn-custom-outline {
            padding: 8px 20px;
            font-size: 0.9rem;
            margin: 5px;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
        
        .stat-number {
            font-size: 1.8rem;
        }
        
        .features-section,
        .latest-blogs-section,
        .cta-section {
            padding: 50px 0;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>
    <div class="floating-shape shape-3"></div>
    
    <div class="container hero-content">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="hero-title mb-4">
                    <i class="fas fa-blog me-3"></i>
                    مرحباً بك في المشروع
                </h1>
                <h2 class="hero-subtitle">
                    Laravel Blog & Admin System
                </h2>
                <p class="hero-subtitle" style="font-size: 1.1rem;">
                    منصة متكاملة لإدارة المحتوى والمدونات بطريقة احترافية
                </p>
                <div class="mt-5">
                    <a href="{{ route('blogs.index') }}" class="btn btn-custom-primary">
                        <i class="fas fa-newspaper me-2"></i>استعرض المدونات
                    </a>
                    <a href="{{ route('blogs.create') }}" class="btn btn-custom-outline">
                        <i class="fas fa-plus-circle me-2"></i>أنشئ مدونة جديدة
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="container">
    <div class="stats-section">
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="stat-item">
                    <div class="stat-number">
                        <span class="counter" data-target="{{ $totalBlogs ?? 0 }}">0</span>
                    </div>
                    <div class="stat-label">
                        <i class="fas fa-blog me-1"></i>إجمالي المدونات
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="stat-item">
                    <div class="stat-number">
                        <span class="counter" data-target="{{ $totalImages ?? 0 }}">0</span>
                    </div>
                    <div class="stat-label">
                        <i class="fas fa-images me-1"></i>إجمالي الصور
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-item">
                    <div class="stat-number">
                        <span class="counter" data-target="{{ $totalViews ?? 1000 }}">0</span>+
                    </div>
                    <div class="stat-label">
                        <i class="fas fa-eye me-1"></i>إجمالي المشاهدات
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="features-section">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-6">
                <h2 class="section-title">مميزات المنصة</h2>
                <p class="text-muted">نقدم لك أفضل الأدوات لإدارة محتوى المدونات بكل سهولة واحترافية</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <h3 class="feature-title">إدارة المحتوى بسهولة</h3>
                    <p class="feature-description">
                        قم بإنشاء وتعديل وحذف المدونات بكل سهولة من خلال واجهة مستخدم مبسطة
                    </p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-images"></i>
                    </div>
                    <h3 class="feature-title">معرض الصور المتقدم</h3>
                    <p class="feature-description">
                        أضف صوراً متعددة لكل مدونة مع إمكانية عرضها في معرض صور احترافي
                    </p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-language"></i>
                    </div>
                    <h3 class="feature-title">دعم اللغات</h3>
                    <p class="feature-description">
                        دعم كامل للغتين العربية والإنجليزية مع إمكانية التبديل بينهما بسهولة
                    </p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="feature-title">بحث متقدم</h3>
                    <p class="feature-description">
                        نظام بحث متطور للعثور على المدونات بسرعة وسهولة
                    </p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="feature-title">تصميم متجاوب</h3>
                    <p class="feature-description">
                        تصميم عصري متجاوب مع جميع الأجهزة والشاشات المختلفة
                    </p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">نظام آمن</h3>
                    <p class="feature-description">
                        نظام متكامل للتحكم في الصلاحيات وحماية المحتوى
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Latest Blogs Section -->
@if(isset($latestBlogs) && $latestBlogs->count() > 0)
<div class="latest-blogs-section">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-6">
                <h2 class="section-title">آخر المدونات</h2>
                <p class="text-muted">أحدث المقالات والمدونات المضافة من قبل المستخدمين</p>
            </div>
        </div>
        
        <div class="row">
            @foreach($latestBlogs as $blog)
            <div class="col-md-4">
                <div class="blog-card-mini">
                    <img src="{{ asset('storage/' . $blog->main_image) }}" alt="{{ $blog->title_en }}">
                    <div class="content">
                        <h4 class="title">{{ Str::limit($blog->title_en, 50) }}</h4>
                        <p class="text-muted small">{{ Str::limit($blog->description_en, 80) }}</p>
                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-sm btn-primary rounded-pill">
                            اقرأ المزيد <i class="fas fa-arrow-left me-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                عرض جميع المدونات <i class="fas fa-arrow-left me-2"></i>
            </a>
        </div>
    </div>
</div>
@endif

<!-- CTA Section -->
<div class="cta-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="cta-title">جاهز لبدء رحلتك مع المدونات؟</h2>
                <p class="cta-text">
                    انضم إلينا الآن وابدأ في نشر محتواك بطريقة احترافية
                </p>
                <a href="{{ route('blogs.create') }}" class="btn btn-cta">
                    <i class="fas fa-rocket me-2"></i>ابدأ الآن مجاناً
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Counter animation
function animateCounter(element, target) {
    let current = 0;
    const increment = target / 50;
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 20);
}

// Start counter animation when element is visible
const observerOptions = {
    threshold: 0.5
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const counters = entry.target.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                if (target > 0) {
                    animateCounter(counter, target);
                }
            });
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

const statsSection = document.querySelector('.stats-section');
if (statsSection) {
    observer.observe(statsSection);
}

// Add animation on scroll
const animateOnScroll = () => {
    const elements = document.querySelectorAll('.feature-card, .blog-card-mini');
    elements.forEach(element => {
        const position = element.getBoundingClientRect().top;
        const screenPosition = window.innerHeight;
        if (position < screenPosition) {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }
    });
}

// Set initial styles for animation
document.querySelectorAll('.feature-card, .blog-card-mini').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'all 0.6s ease-out';
});

window.addEventListener('scroll', animateOnScroll);
window.addEventListener('load', animateOnScroll);
</script>
@endsection