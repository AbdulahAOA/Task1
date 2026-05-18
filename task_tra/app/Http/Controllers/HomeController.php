<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalBlogs = Blog::count();
        $totalImages = Blog::with('images')->get()->sum(function($blog) {
            return $blog->images->count();
        });
        $latestBlogs = Blog::with('images')->latest()->take(3)->get();
        $totalViews = 1247; // يمكنك تعديل هذا الرقم أو جعله ديناميكياً
        
        return view('home', compact('totalBlogs', 'totalImages', 'latestBlogs', 'totalViews'));
    }
}