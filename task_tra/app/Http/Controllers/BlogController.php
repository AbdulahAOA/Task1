<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::with('images')->latest()->get();

        return view('blogs.index', compact('blogs'));
    }

    public function trash()
    {
        $blogs = Blog::onlyTrashed()->latest()->get();

        $admins = \App\Models\Admin::onlyTrashed()->latest()->get();

        $users = \App\Models\User::onlyTrashed()->latest()->get();

        return view('trash', compact(

            'blogs',
            'admins',
            'users'

        ));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(StoreBlogRequest $request)
    {

        // Main Image
        $mainImagePath = $request
            ->file('main_image')
            ->store('blogs/main', 'public');

        // Create Blog
        $blog = Blog::create([

            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,

            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,

            'main_image' => $mainImagePath,
        ]);

        // Multiple Images
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $imagePath = $image->store('blogs/images', 'public');

                BlogImage::create([
                    'blog_id' => $blog->id,
                    'image' => $imagePath,
                ]);
            }
        }

        return redirect()->route('blogs.index');
    }

    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {

        $data = [

            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,

            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
        ];

        // Update Main Image
        if ($request->hasFile('main_image')) {

            $mainImage = $request
                ->file('main_image')
                ->store('blogs/main', 'public');

            $data['main_image'] = $mainImage;
        }

        $blog->update($data);

        return redirect()->route('blogs.index');
    }
     public function show(Blog $blog)
      {
    return view('blogs.show', compact('blog'));
      }
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index');
    }
}