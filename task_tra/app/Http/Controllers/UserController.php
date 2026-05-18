<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function destroy(User $user)
{
    $user->delete();

    return redirect()->route('users.index');
}
   # Users List


    public function index()
    {
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }

    public function trash()
{
    $users = User::onlyTrashed()->latest()->get();

    return view('users.trash', compact('users'));
}
    #Create User
   

    public function create()
    {
        return view('users.create');
    }

    #Store User
  
 public function store(Request $request)
{
    $request->validate([

        'first_name' => 'required',

        'last_name' => 'required',

        'email' => 'required|email|unique:users,email',

        'phone' => 'nullable|unique:users,phone',

        'password' => 'required|min:6',

    ]);

    User::create([

        'first_name' => $request->first_name,

        'last_name' => $request->last_name,

        'email' => $request->email,

        'phone' => $request->phone,

        'password' => bcrypt($request->password),

    ]);

    return redirect()
        ->route('users.index')
        ->with('success', 'User Created Successfully');
}

   #Show User Details


    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
}