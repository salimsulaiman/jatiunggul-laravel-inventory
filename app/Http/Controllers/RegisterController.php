<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.auth.register.index', [
            'title' => 'Register',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|unique:users,email|min:5',
        'password' => 'required|min:5|max:15',
        'confirmPassword' => 'required|same:password',
    ], [
        'name.required' => 'Nama harus diisi',
        'name.min' => 'Nama minimal harus 3 huruf',
        'email.required' => 'Email harus diisi',
        'email.min' => 'Email minimal harus 5 huruf',
        'email.unique' => 'Email sudah digunakan',
        'password.required' => 'Password harus diisi',
        'confirmPassword.same' => 'Konfirmasi password tidak cocok',
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'email_verified_at' => now(),
        'password' => bcrypt($request->password),
        'profile' => 'https://api.dicebear.com/9.x/initials/svg?seed=' . urlencode($request->name),
        'role' => 'user',
    ];


    $register = User::create($data);

    if (!$register) {
        return redirect()->route('register')->with('failedRegist', 'Failed to create account');
    }

    return redirect()->route('register')->with('successRegist', 'Account created successfully');
}


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}