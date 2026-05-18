<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // عرض كل الأدمن
    public function index()
    {
        $admins = Admin::latest()->get();

        return view('admin.index', compact('admins'));
    }

    // صفحة المحذوفات
    public function trash()
    {
        $admins = Admin::onlyTrashed()->latest()->get();

        return view('trash', compact('admins'));
    }

    // صفحة إضافة أدمن
    public function create()
    {
        return view('admin.create');
    }

    // حفظ أدمن جديد
    public function store(Request $request)
    {
        $request->validate([

            'first_name' => 'required|string|max:255',

            'last_name' => 'required|string|max:255',

            'email' => 'required|email|unique:admins,email',

            'phone' => 'nullable|string|max:20',

            'password' => 'required|min:8|confirmed',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            'state' => 'nullable|string|max:100',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store('admins', 'public');
        }

        Admin::create([

            'first_name' => $request->first_name,

            'last_name' => $request->last_name,

            'email' => $request->email,

            'phone' => $request->phone,

            'password' => Hash::make($request->password),

            'image' => $imagePath,

            'state' => $request->state ?? 'active',

            'time' => now(),
        ]);

        return redirect()
            ->route('admins.index')
            ->with(
                'success',
                'تم إضافة الأدمن بنجاح!'
            );
    }

    // حذف أدمن
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        // منع حذف نفسك
        if (
            Auth::guard('admin')->check() &&
            $admin->id === Auth::guard('admin')->id()
        ) {

            return back()->with(
                'error',
                'لا يمكنك حذف نفسك!'
            );
        }

        $admin->delete();

        return redirect()
            ->route('admins.index')
            ->with(
                'success',
                'تم نقل الأدمن إلى سلة المحذوفات!'
            );
    }

    // استعادة أدمن
    public function restore($id)
    {
        $admin = Admin::onlyTrashed()->findOrFail($id);

        $admin->restore();

        return redirect()
            ->route('trash')
            ->with(
                'success',
                'تم استعادة الأدمن بنجاح!'
            );
    }

    // حذف نهائي
    public function forceDelete($id)
    {
        $admin = Admin::onlyTrashed()->findOrFail($id);

        if (
            $admin->image &&
            file_exists(
                storage_path(
                    'app/public/' . $admin->image
                )
            )
        ) {

            unlink(
                storage_path(
                    'app/public/' . $admin->image
                )
            );
        }

        $admin->forceDelete();

        return redirect()
            ->route('trash')
            ->with(
                'success',
                'تم حذف الأدمن نهائياً!'
            );
    }

    // صفحة تسجيل الدخول
    public function loginForm()
    {
        return view('admin.login');
    }

    // تسجيل الدخول
    public function login(Request $request)
    {
        $request->validate([

            'email' => 'required|email',

            'password' => 'required',
        ]);

        $credentials = $request->only(
            'email',
            'password'
        );

        if (
            Auth::guard('admin')
                ->attempt($credentials)
        ) {

            return redirect()
                ->route('blogs.index')
                ->with(
                    'success',
                    'مرحباً بك!'
                );
        }

        return back()->with(
            'error',
            'البريد الإلكتروني أو كلمة المرور غير صحيحة!'
        );
    }

    // تسجيل الخروج
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()
            ->route('admin.login')
            ->with(
                'success',
                'تم تسجيل الخروج بنجاح!'
            );
    }
}